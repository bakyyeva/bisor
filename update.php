<?php
session_start();
//error_reporting(0);

include 'includes/function.inc.php';

if(isset($_SESSION['auth']) and $_SESSION['auth'] == true) {

} else{
  git("Önce giriş yapmalısınız!", "loginform.php");
}

if(!isset($_POST['formdangelen'])) {
  git("Güncellemek için önce soru seçiniz!", "questions.php");
}

include 'includes/dbconn.inc.php';
 
$sql = "update question set title = :title, description = :description where id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(Array(":title"=>$_POST["title"], ":description"=>$_POST["description"], ":id"=>$_POST["update_id"]));

$db = null;

git("Soru başarıyla güncellendi.", "questions.php");
?>
<a href="index.php"> Ana sayfaya dön! </a>