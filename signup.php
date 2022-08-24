<?php
session_start();
//error_reporting(0);

include 'includes/function.inc.php';

if(isset($_POST["submit"])) {
  $_SESSION["username"] = $_POST["username"];
  $_SESSION["name"] = $_POST["name"];
  $_SESSION["surname"] = $_POST["surname"];
  $_SESSION["email"] = $_POST["email"];
  $_SESSION["pwd"] = $_POST["pwd"];
} else{
  header("Location: signupform.php");
}

//DB connection
 include "includes/dbconn.inc.php";

$sql ="select username from users where username = :username";
$stmt = $db->prepare($sql);
$stmt->execute(Array(":username"=>$_POST["username"]));
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user != false) { 
  git("Bu kullanıcı adı daha önce alınmış!", "signupform.php");
   exit;
}

if(!isset($_POST["username"]) or !preg_match("/^[a-zA-Z0-9]*$/", $_POST["username"])){
  $_SESSION["error"] = "Kullanıcı adını doğru giriniz!";
  header("Location: signupform.php");
  exit;
}else {
  $username = trim($_POST["username"]);
}

if(!isset($_POST["name"]) or !preg_match("/^[a-zA-Z]*$/", $_POST["name"])){
  $_SESSION["error"] = "Adınızı doğru giriniz!";
  header("Location: signupform.php");
  exit;
}else {
  $name = trim($_POST["name"]);
}

if(!isset($_POST["surname"]) or !preg_match("/^[a-zA-Z]*$/", $_POST["surname"])){
  $_SESSION["error"] = "Soyadınızı doğru giriniz!";
  header("Location: signupform.php");
  exit;
}else {
  $surname = trim($_POST["surname"]);
}

$email = $_POST["email"];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION["error"] = "Emailinizi doğru formatında giriniz!";
  header("Location: signupform.php");
  exit;
} else{
  $eposta = $_POST["email"];
}

if($_POST["pwd"] != $_POST["pwdRepeat"]){
  $_SESSION["error"] = "Şifreler eşleşmiyor!";
  header("Location: signupform.php");
  exit;
} 

if(!isset($_POST["pwd"]) or strlen($_POST["pwd"])<3){
  $_SESSION["error"] = "Şifre en az 3 karakter olmalı!";
  header("Location: signupform.php");
  exit;
}

//DB connection
include "includes/dbconn.inc.php";

$password = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

$sql = "insert into users (username, name, surname, email, password) values (:username, :name, :surname, :email, :password)";
$stmt = $db->prepare($sql);
$stmt->execute(Array(":username"=>$username, ":name"=>$name, ":surname"=>$surname, ":email" =>$eposta, ":password"=>$password));

$db = null;

git("Kaydınız başarılı!", "loginform.php");
?>
<a href="index.php">Ana sayfaya dön!</a>