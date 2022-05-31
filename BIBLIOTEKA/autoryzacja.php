<?php
$dbhost='localhost';
$dbuser='19_mlynarczyk';
$dbpass='mlynarczykWIERZ';
$dbname='19_mlynarczyk';

$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)
or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
?>