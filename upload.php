<?php
session_start();
//error_reporting(0);

include 'includes/function.inc.php';

if(isset($_SESSION['auth']) and $_SESSION['auth'] == true) {

} else{
  git("Önce giriş yapmalısınız!", "loginform.php");
}

if(isset($_POST["formdangelen"])) {
  $_SESSION["title"] = $_POST["title"];
  $_SESSION["description"] = $_POST["description"];
} else{
  header("Location: questionform.php");
}

if(!isset($_POST["title"]) or strlen($_POST["title"])<4){
  $_SESSION["error"] = "Başlık bilgisi mutlaka girilmelidir ve en az 4 karakter olmalıdır";
  header("Location: questionform.php");
  exit;
} else{
  $title = trim($_POST["title"]);
}

if(!isset($_POST["description"]) or strlen($_POST["description"])<5){
  $_SESSION["error"] = "Açıklama bilgisi mutlaka girilmelidir ve en az 5 karakter olmalıdır";
  header("Location: questionform.php");
  exit;
} else{
  $description = trim($_POST["description"]);
}

if(isset($_GET["formgordu"]) and (!isset($_POST["formdangelen"]))) {
  git("Yüklemeye çalıştığınız dosya boyutu çok büyük!", "questionform.php");
}

if(!isset($_POST['formdangelen'])) {
    git("Soru sormak için önce soru sor formu doldurunuz!", "questionform.php");
}

if ($_FILES["uploadedFile"]["error"] != 0) {
  git("Dosya yüklerken bir hata oluştu!", "questionform.php");
  exit;
}

//File type control
$file_type = $_FILES["uploadedFile"]["type"];
$allowed = array("image/png", "image/jpeg", "image/jpg", "image/eps", "image/tif", "image/bamp",);
if(!in_array($file_type, $allowed)) {
  git("Yükleyeceğiniz dosya bir resim dosyası olmalıdır!", "questionform.php");
}   

$targetFolder = "uploads/";
$targetFolder .= time();
$targetFolder = $targetFolder.basename($_FILES['uploadedFile']['name']);

if (move_uploaded_file($_FILES["uploadedFile"]['tmp_name'], $targetFolder))
{

}else{
	git("Dosya yükleme işleminde bir hata oluştu!", "questionform.php");
}

include 'includes/dbconn.inc.php';
 
$sql = "insert into question (title, description, file, user)  values (:title, :description, :file, :user)";
$stmt = $db->prepare($sql);
$stmt->execute(Array(":title"=>$title, ":description"=>$description, ":file"=>$targetFolder, ":user"=>$_SESSION["id"]));

$db = null;

git("Soru başarıyla kaydedildi.", "questions.php");
?>
<a href="index.php"> Ana sayfaya dön! </a>