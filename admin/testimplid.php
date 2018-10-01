<?php
//$a=array('A','B','C');
//var_dump($a);
//$b=implode(",",$a);
//var_dump($b);

//$con=mysqli_connect('localhost','root','','phonebook');
//$sql="SELECT * FROM user_tbl";
//$res=mysqli_query($con,$sql);
//$row=mysqli_fetch_assoc($res);
//var_dump($row);


$con=new PDO("mysql:host=localhost;dbname=phonebook",'root','');
$sql=$con->prepare("SELECT * FROM user_tbl");
$sql->execute();
$row=$sql->fetchAll(PDO::FETCH_OBJ);
var_dump($row);