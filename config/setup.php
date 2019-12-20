<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'database.php';

$pdo = new PDO("mysql:host=$host;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'CREATE DATABASE IF NOT EXISTS ' . $db .' CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$sql = 'USE ' . $db;
$stmt = $pdo->prepare($sql);
$stmt->execute();

$sql = "CREATE TABLE IF NOT EXISTS users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(100) NOT NULL,
    password VARCHAR(1000) NOT NULL,
	email VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
	`group` INT NOT NULL,
	salt VARCHAR(350) NOT NULL,
	confirmed TINYINT DEFAULT 0,
	joined DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `groups` (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	permissions TEXT) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$sql = "SELECT count(*) FROM `groups` WHERE name = 'Standard user'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$number_of_rows = $stmt->fetchColumn();
if(!$number_of_rows) {
	$sql = 'INSERT INTO `groups`(`name`) VALUES ("Standard user")';
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
}

$sql = "SELECT count(*) FROM `groups` WHERE name = 'Administrator'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$number_of_rows = $stmt->fetchColumn();
if(!$number_of_rows) {
	$sql = 'INSERT INTO `groups`(`name`, `permissions`) VALUES ("Administrator", \'{\r\n\"admin\": 1,\r\n\"mod\": 1\r\n}\')';
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
}
$sql = 'CREATE TABLE IF NOT EXISTS users_session (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT NOT NULL,
	hash VARCHAR(64) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci';
$stmt = $pdo->prepare($sql);
$stmt->execute();

$sql = 'CREATE TABLE IF NOT EXISTS images (
	image_id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT NOT NULL,
	image_name VARCHAR(100) NOT NULL,
	upload_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci';
$stmt = $pdo->prepare($sql);
$stmt->execute();

// $sql = 'CREATE TABLE IF NOT EXISTS comments (
// 	comment_id INT AUTO_INCREMENT PRIMARY KEY,
// 	picture_id INT NOT NULL,
// 	-- user_id INT NOT NULL,
// 	commentor_id INT NOT NULL,
// 	comment LONGBLOB NOT NULL,
// 	creation_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci';
// $stmt = $pdo->prepare($sql);
// $stmt->execute();

// $sql = 'CREATE TABLE IF NOT EXISTS likes (
// 	like_id INT AUTO_INCREMENT PRIMARY KEY,
// 	picture_id INT NOT NULL,
// 	-- user_id INT NOT NULL,
// 	liker_id INT NOT NULL,
// 	creation_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci';
// $stmt = $pdo->prepare($sql);
// $stmt->execute();
?>