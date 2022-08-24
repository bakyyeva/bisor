<?php
session_start();
//error_reporting(0);

include "includes/function.inc.php";

if(isset($_SESSION['auth']) and $_SESSION['auth'] == true) {

} else{
    git("Önce giriş yapmalısınız!", "loginform.php");
  }
if(!isset($_POST['formdangelen'])) {
    git("Silmek için önce soru seçmelisiniz!", "sorular.php");
}

include "includes/dbconn.inc.php";
 
$stmt1 = $db->prepare("delete from answer where  question_id = :id");
$stmt1->execute(Array(":id"=>$_POST["delete_id"]));

$db = null;

include "includes/dbconn.inc.php";

$sql = "delete from question where  id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(Array(":id"=>$_POST["delete_id"]));

$db = null;

git("Soru başarıyla silindi!", "questions.php");

?>
<a href="index.php">Ana sayfaya dön!</a>