<?php

require_once 'db.php';

class contact extends db {

    public function logIn($data){

            $this->setTbl('user_tbl');
            $userInfo=$this->searchContact('name',$data['name']);
            if ($userInfo['password']==$data['password']){
                    session_start();
                    $_SESSION['user']=$userInfo['name'];
                    header("location:dashbord.php?login=ok");
            }else{
                header("location:index.php?login=firest");
            }

    }

    public function addContact($field,$value){
        $this->setTbl('contact_tbl');
        $this->insertData($field,$value);
    }

    public function logOut(){
        session_destroy();
        header("location:index.php?logout=successful");
    }

}