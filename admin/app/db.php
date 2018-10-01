<?php

class db{

    protected $pdo;
    private $user;
    private $pass;
    private $db;
    private $tbl;



    public function __construct($db='phonebook',$user='root',$pass='')
    {
        $this->db=$db;
        $this->user=$user;
        $this->pass=$pass;
        $this->connection();
    }

    public function connection(){
        try{
            $this->pdo=new PDO("mysql:host=localhost;dbname=$this->db",$this->user,$this->pass);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
        $this->pdo->exec('SET NAMES UTF8');
    }

    public function setTbl($tbl){
        $this->tbl=$tbl;
    }

    public function selectData($data){

        if (is_array($data)){
            $name=implode(",",$data);
            $sql=$this->pdo->prepare("SELECT $name FROM $this->tbl");
        }else{
            $sql=$this->pdo->prepare("SELECT $data FROM $this->tbl");
        }
        $sql->execute();
        $row=$sql->fetchAll(PDO::FETCH_OBJ);

        return $row;

    }

    public function insertData($fields,$values){
        $field=implode(",",$fields);
        $value="'".implode("','",$values)."'";
        $sql=$this->pdo->prepare("INSERT INTO $this->tbl ($field) VALUES  ($value)");
        $sql->execute();
    }

    public function editTable($data,$id){
        foreach($data as $key=>$value) {
            $updatedata[] = $key . "='" . $value . "'";
        }
        $text=implode(",",$updatedata);
        $stmt=$this->pdo->prepare("UPDATE $this->tbl SET $text WHERE id='$id'");
        $stmt->execute();
    }

    public function delete($id){
        $stmt=$this->pdo->prepare("DELETE FROM $this->tbl WHERE id='$id'");
        $stmt->execute();

    }

    public function editData($id){

        $sql=$this->pdo->prepare("SELECT * FROM {$this->tbl} WHERE id='$id'");
        $sql->execute();
        $row=$sql->fetch(PDO::FETCH_OBJ);

        return $row;

    }


    public function searchContact($name,$value){
        $stmt=$this->pdo->prepare("SELECT * FROM {$this->tbl} WHERE $name='$value'");
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function likeContact($name,$value){
        $stmt=$this->pdo->prepare("SELECT * FROM $this->tbl WHERE $name LIKE '%$value%'");
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_OBJ);

        return $row;
    }



}
$obj=new db();
//$obj->setTbl('user_tbl');
//$dat=['name','lastname','password','email'];
//$dt=['ehsan','ahmadi','122','email@gmail.com'];
//$data=array("name"=>"saman","lastname"=>"ashkani","email"=>"fm@gmail.com");
//$obj->insertData($dat,$dt);
//$obj->selectData('name');
//$obj->editTable($data,1);
//$obj->delete(2);



