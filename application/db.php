<?

$servername = "localhost";
$username   = "root";
$password   = "mysql";
$dbname     = "socials";


$connection = new mysqli($servername, $username, $password, $dbname);

if($connection->connect_error){
    die ("Ошибка подключения к бд: " . $connection->connect_error);
}