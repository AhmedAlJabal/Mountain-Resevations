<?php

class accessory {
    //put your code here
    private $accessoryID;
    private $accessoryName;
    private $accessoryPrice;
    
    function __construct() {
        
    }
    
    function getAccessoryID() {
        return $this->accessoryID;
    }

    function getAccessoryName() {
        return $this->accessoryName;
    }

    function getAccessoryPrice() {
        return $this->accessoryPrice;
    }

    function setAccessoryID($accessoryID): void {
        $this->accessoryID = $accessoryID;
    }

    function setAccessoryName($accessoryName): void {
        $this->accessoryName = $accessoryName;
    }

    function setAccessoryPrice($accessoryPrice): void {
        $this->accessoryPrice = $accessoryPrice;
    }

    function getAllAccessory(){
        $connection = Database::getInstance()->getConnection();
        $SQLquery="select * from dbProj_accessory";
        $query = $connection->prepare($SQLquery);
        $query->execute();
        $result= $query->get_result();
        $rows=[];
        while($lol = $result->fetch_assoc()){
            array_push($rows,$lol);
        }
        return $rows;    
    }
    
    function getAccessory($list){
        $x=0;
        foreach($list as $i){
           
            $id .= $i;
            $x++;
            if($x<count($list)){
                $id .= ",";
            }       
        }
        $connection = Database::getInstance()->getConnection();
        $SQLquery="select * from dbProj_accessory where AccessoryID in ($id)";
        $query = $connection->prepare($SQLquery);
        $query->bind_param("i", $id);
        $query->execute();
        $result= $query->get_result();
        $rows=[];
        while($lol = $result->fetch_assoc()){
            array_push($rows,$lol);
        }
        return $rows;      
    }
    
    function getTotal($list){      
        echo"<br>passed in data =$id<br>";
        $connection = Database::getInstance()->getConnection();
        $SQLquery="select * from dbProj_accessory where AccessoryID in (?)";
        echo "<br>".$SQLquery."<br>";
        $query = $connection->prepare($SQLquery);
        $query->bind_param("i", $id);
        $query->execute();
        $result= $query->get_result();
        $total =$result->fetch_assoc();
        return $total['AccessoryPrice'];
    }

    
    
}
