<?php
class Login extends Users {
    //put your code here
    public $ok;
    public $salt;
    public $domain;

    function __construct() {
        parent::__construct();
        $this->ok = false;
        $this->salt = 'ENCRYPT';
        $this->domain = '';

        if (!$this->check_session())
            $this->check_cookie();

        return $this->ok;
    }

    function check_session() {

        if (!empty($_SESSION['uid'])) {
            $this->ok = true;
            return true;
        }
        else
            return false;
    }

    function check_cookie() {
        if (!empty($_COOKIE['uid'])) {
            $this->ok = true;
            return $this->check($_COOKIE['uid']);
        }
        else
            return false;
    }

    function check($uid) {
        $this->initWithid($uid);
        if ($this->getUid() != null && $this->getUid() == $uid) {
            $this->ok = true;
            $_SESSION['uid'] = $this->getUid();
            $_SESSION['name'] = $this->getFirstName(). ' '.$this->getLastName();
            $_SESSION['isAdmin'] = $this->getIsAdmin();
            $_SESSION['mail'] = $this->getEmail();
            
            setcookie('uid', $_SESSION['uid'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
            setcookie('name', $_SESSION['name'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
            setcookie('isAdmin', $_SESSION['isAdmin'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
            setcookie('mail', $_SESSION['mail'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
            return true;
        }
        else
            $error[] = 'Wrong Username';


        return false;
    }

    function login($email, $password) {

        try {  
            
            
            if ($this->checkUser($email, $password)) {         
                $this->ok = true;  
                $_SESSION['uid'] = $this->getUID();
                $_SESSION['name'] = $this->getFirstName().' '. $this->getLastName();
                $_SESSION['isAdmin'] = $this->getIsAdmin();

                
                setcookie('uid', $_SESSION['uid'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
                setcookie('name', $_SESSION['name'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
                
                return true;
            } else {
                
                $error[] = 'Wrong Email OR password';
            }
            return false;
        } catch (Exception $e) {
            $error[] = $e->getMessage();
        }

        return false;
    }

    function logout() {
        $this->ok = false;
        $_SESSION['uid'] = '';
        $_SESSION['name'] = '';
        setcookie('uid', '', time() - 3600, '/', $this->domain);
        setcookie('name', '', time() - 3600, '/', $this->domain);
        session_destroy();
    }
    
    
}
