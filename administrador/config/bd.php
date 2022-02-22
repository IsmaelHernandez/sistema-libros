<?php
/*   Database credentials.
    Establecer la conexion a la base de ddatos
 */
$host="localhost";
$bd="sistemphp";
$usuario="root";
$password="";

try{
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$password);
    if($conexion){
        echo "Conectado a bd del sistema";
    }
}catch(Exception $ex){
    echo $ex->getMessage();
}
?>