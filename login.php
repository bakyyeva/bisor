<?php
session_start();
//error_reporting(0);

include 'includes/function.inc.php';

if(!isset($_POST["submit"])) {
    git("Önce formu doldurunuz!", "loginform.php");
}

//DB connection
include "includes/dbconn.inc.php";

$sql ="select * from users where username = :username";
$stmt = $db->prepare($sql);
$stmt->execute(Array(":username" => trim($_POST["username"]))); 
$user = $stmt->fetch(PDO::FETCH_ASSOC);                              

//Username control
if($user == false) {
  git("Kullanıcı adı veya şifre hatalı", "loginform.php");
  exit;
}
//Password control
if(!password_verify($_POST["pwd"], $user["password"])) {
    git("Kullanıcı adı veya şifre hatalı", "loginform.php");
    exit;
}

$_SESSION["auth"] = true;   
$_SESSION["id"] = $user["id"]; 
$_SESSION["name"] = $user["name"];
$_SESSION["surname"] = $user["surname"];
$_SESSION["email"] = $user["email"];

$db = null;

git("Başarıyla giriş yapıldı!", "index.php");
exit;
?>
<a href="index.php"> Ana sayfaya dön! </a>
