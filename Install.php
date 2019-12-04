<?php

try {
    $servername = "localhost";
    $dbname = "camagru"; //database name
    $dbusername = "root";
    $dbpassword = "0P3nv13w";

    $dsn = "mysql:host=". $servername;
	$db = new PDO($dsn, $dbusername, $dbpassword); //connection to server
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connection to server successfull";
	$db->exec("CREATE DATABASE IF NOT EXISTS $dbname");
	echo "Database '$dbname' Userd successfully.<br>";
	$db->exec("use $dbname");
	$db->exec("CREATE TABLE IF NOT EXISTS users (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		email VARCHAR(255) NOT NULL,
		username VARCHAR(255) NOT NULL,
		passwrd VARCHAR(255) NOT NULL,
		hash VARCHAR(255) NOT NULL,
		admin INT(9) DEFAULT 0,
		active INT(9) DEFAULT 0)");
    echo "Table 'users' Userd successfully.<br>";
    } catch (PDOException $e) {
	echo $sql.'<br>'.$e->getMessage();
	/*
	$stmt = $db->prepare('INSERT INTO users (email, username, passwrd, hash, admin, active) VALUES (:email, :login, :passwrd, :hash, :admin, :active)');
	$mail = 'nthabiseng.map@gmail.com';
	$name = 'Mosa';
	$pass = 'cc8c74dc072e25db099cb60bc8683657736bc95f65f6a0164d52aae721c9367bdf06dfa8844107a815ab3e4c21c08bda71aaa7382a781696ece90d3e0ecae460';
	$token = 'd14220ee66aeec73c49038385428ec4c';
	$stmt->bindParam(':email', $mail);
	$stmt->bindParam(':username', $name);
	$stmt->bindParam(':passwrd', $pass);
	$stmt->bindParam(':hash', $token);
	//$stmt->bindParam(':admin', $zero);
	//$stmt->bindParam(':active', $one);
	$stmt->execute();*/
}
$db = null;
?>