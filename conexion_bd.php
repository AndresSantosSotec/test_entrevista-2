<?php
$server="localhost";
$username="root";
$password="";
$dbname="test_entrevista";

$con= new mysqli($server,$username,$password,$dbname);

if ($con->connect_error){


    //valida si la conexionpuede llegar a fallalr esta me dara el error
die("conexion fallida" .$con->connect_error);
}

?>