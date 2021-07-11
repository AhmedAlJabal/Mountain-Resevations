<?php

class Cars {
    //put your code here
    
    private $carID;
    private $type;
    private $make;
    private $model;
    private $year;
    private $picture;
    private $dailyPrice;
    
    function __construct() {
        $this->carID = Null;
        $this->type = Null;
        $this->make = Null;
        $this->model = Null;
        $this->year = Null;
        $this->picture = Null;
        $this->dailyPrice = Null;
    }
    
    function getCarID() {
        return $this->carID;
    }

    function getType() {
        return $this->type;
    }

    function getMake() {
        return $this->make;
    }

    function getModel() {
        return $this->model;
    }

    function getYear() {
        return $this->year;
    }

    function getPicture() {
        return $this->picture;
    }

    function getDailyPrice() {
        return $this->dailyPrice;
    }

    function setCarID($carID): void {
        $this->carID = $carID;
    }

    function setType($type): void {
        $this->type = $type;
    }

    function setMake($make): void {
        $this->make = $make;
    }

    function setModel($model): void {
        $this->model = $model;
    }

    function setYear($year): void {
        $this->year = $year;
    }

    function setPicture($picture): void {
        $this->picture = $picture;
    }

    function setDailyPrice($dailyPrice): void {
        $this->dailyPrice = $dailyPrice;
    }
    
    function initWithid($cid) {

        $connection = Database::getInstance()->getConnection();
        $SQLquery = "SELECT * FROM dbProj_Car WHERE CarID = ?";
        $query = $connection->prepare($SQLquery);
        $query->bind_param("i",$cid);
        $query->execute();
        $result= $query->get_result();
        $data = $result->fetch_object();
        $this->initWith($data->CarID, $data->Type, $data->Make, $data->Model, $data->Year, $data->Picture, $data->DailyPrice);
    }
    
    function initWith($carID,$type,$make,$model,$year,$picture,$dailyPrice){
        $this->carID = $carID;
        $this->type = $type;
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->picture = $picture;
        $this->dailyPrice = $dailyPrice;
        
    }
    
    function getAllCars($start,$end){
        $connection = Database::getInstance()->getConnection();
        $SQLquery="select * from dbProj_Car";
        if($start != 0){
            $start -=1;
        }
        $start *= $end;
        if (isset($start)){ 
            $SQLquery .= ' limit ' . $start . ',' . $end;
        }
        
        $query = $connection->prepare($SQLquery);
        $query->execute();
        $result= $query->get_result();
        $rows=[];
        while($lol = $result->fetch_assoc()){
            array_push($rows,$lol);
        }
        return $rows;    
    }

    function AddCar(){
        if($this->isValid()){
            try{      
            $connection = Database::getInstance()->getConnection();
            $SQLquery= "insert into dbProj_Car (`Type`, `Make`, `Model`, `Year`, `Picture`, `DailyPrice`)
                          Values(?, ?, ?, ?, ?, ?)";
            $query = $connection->prepare($SQLquery);
            $query->bind_param("sssssd", $this->type, $this->make, $this->model, $this->year, $this->picture, $this->dailyPrice);
            $query->execute();
            return true;
            } catch (Exception $e) {
                echo 'Exception: ' . $e;
                return false;
            }
        }else{
            return false;
        }
        
    }
    
    function searchCar($startDate, $endDate){
        $connection = Database::getInstance()->getConnection();
        $SQLquery="select * from dbProj_Car where CarID not in (select carID from dbProj_Reservation where startdate <= ? or enddate >= ?)";   
        
        $query = $connection->prepare($SQLquery);
        $query->bind_param("ss", $startDate,$endDate);
        $query->execute();
        $result= $query->get_result();
        $rows=[];
        while($lol = $result->fetch_assoc()){
            array_push($rows,$lol);
        }
        return $rows; 
    }
    
    function searchCarAdvanced($startDate, $endDate,$model,$make,$year,$type,$dailyPrice){
        $connection = Database::getInstance()->getConnection();
        
        //$SQLquery="select * from dbProj_Car where CarID not in (select carID from dbProj_Reservation where startdate <= '$startDate' or enddate >= '$endDate')";
        $SQLquery = "select * from dbProj_Car where CarID not in (select carID from dbProj_Reservation"
                . " where startdate BETWEEN '$startDate' and '$endDate' AND enddate BETWEEN '$startDate' and '$endDate')";
        
        
        if($model != ""){
           // $SQLquery .= " and Model = '$model'";
            $SQLquery .= " and match(Model) against('*$model*'IN BOOLEAN MODE)";           
        }
        if($make != ""){
            //$SQLquery .= " and Make = '$make'";
            $SQLquery .= " and match(Make) against('*$make*'IN BOOLEAN MODE)";
        }
        if($year != ""){
            //$SQLquery .= " and Year = '$year'";
             $SQLquery .= " and match(Year) against('*$year*'IN BOOLEAN MODE)";
        }
        if($type != ""){
            $SQLquery .= " and Type = '$type'";
        }
        if($dailyPrice != ""){
            $SQLquery .= " and DailyPrice = '$dailyPrice'";
        }
        
        //echo $SQLquery;
        //echo "$SQLquery";
        /*$query = $connection->prepare($SQLquery);
        $query->execute();
        $result= $query->get_result();*/
        $result = $connection->query($SQLquery);
        $rows=[];
        while($lol = $result->fetch_assoc()){
            array_push($rows,$lol);
        }
        return $rows; 
          
    }
    
    public function AdminSearchCarAdvanced($model, $make, $year, $type){
        $connection = Database::getInstance()->getConnection();
       
        $SQLquery="select * from dbProj_Car Where CarID in (select CarID from dbProj_Car) ";
        
        if($model != ""){
           // $SQLquery .= " and Model = '$model'";
            $SQLquery .= " and match(Model) against('*$model*'IN BOOLEAN MODE)";           
        }
            
        if($make != ""){
            
            //$SQLquery .= " and Make = '$make'";
            $SQLquery .= " and match(Make) against('*$make*'IN BOOLEAN MODE)";
        }
        if($year != ""){
            //$SQLquery .= " and Year = '$year'";
             $SQLquery .= " and match(Year) against('*$year*'IN BOOLEAN MODE)";
        }
        if($type != ""){
            $SQLquery .= " and Type = '$type'";
        }
        
        $result = $connection->query($SQLquery);
        $rows=[];
        while($lol = $result->fetch_assoc()){
            array_push($rows,$lol);
        }
        return $rows;
        
    }
    
    
    public function isValid(){
        $isFilled = true;
        
        if (empty($this->make))
            $isFilled = false;
        
        if (empty($this->model))
            $isFilled = false;
        
        if (empty($this->type))
            $isFilled = false;
        
        if (empty($this->year))
            $isFilled = false;
        
        if (empty($this->picture))
            $isFilled = false;
        
        if (empty($this->dailyPrice))
            $isFilled = false;
        
        return $isFilled; 
    }

    
    
}
