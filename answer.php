<?php
session_start();
//error_reporting(0);


include "includes/function.inc.php";

if(!isset($_SESSION["auth"]) and $_SESSION["auth"] == false) {
    git("Önce giriş yapmalısınız!", "loginform.php");
    exit;
}
if(!isset($_POST["cevapform"])) {
    git("Önce formu doldurunuz!", "sorular.php");
    exit;
}

include "includes/dbconn.inc.php";

$sql = "insert into answer (user_id, question_id, text)  values (:user_id, :question_id, :text)";
$stmt = $db->prepare($sql);
$stmt->execute(Array(":user_id"=>$_SESSION["id"], ":question_id"=>$_POST["questionID"], ":text"=>$_POST["answer"]));

$db = null;

$address = "Location: question.php?id=".$_POST["questionID"];
header($address);
?>
<a href="index.php"> Ana sayfaya dön! </a>