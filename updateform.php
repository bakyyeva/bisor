<?php
 session_start();
 //error_reporting(0);

 include 'includes/function.inc.php';

if(isset($_SESSION['auth']) and $_SESSION['auth'] == true) {

} else{
  git("Önce giriş yapmalısınız!", "loginform.php");
}

if(isset($_POST["update_id"]) and is_numeric($_POST["update_id"])) {
  
} else {
  git("Önce soruyu seçiniz!", "questions.php");
}

include "includes/dbconn.inc.php";

$sql = "select * from question where id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(Array(":id"=>$_POST["update_id"]));
$question = $stmt->fetch(PDO::FETCH_ASSOC);

if($question == false) {
  git("Bellirttiğiniz ID 'ye ait soru bulunamadı!", "questions.php");
}

if($question["user"] != $_SESSION["id"]) {
  git("Bu soruyu güncellemeye yetkiniz yok!", "questions.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BÖTE</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
   <?php
     include 'includes/header.inc.php';
   ?>
<main>
 <div class="container-upt">
   <h1>Soruyu düzelt</h1>
   <form enctype="multipart/form-data" action="update.php" method="POST" id="duzelt">
       <input type="hidden" name="update_id" value="<?php echo $question["id"]; ?>">
         <div class="form-item">
           <label for="title">Başlık giriniz</label>
            <input type="text" name="title" id="title" value="<?php echo $question["title"]; ?>">
         </div>
         <div class="form-item">
           <label for="description">Açıklama giriniz</label>
           <textarea name="description" id="description"> <?php echo $question["description"]; ?> </textarea>
         </div>
         <div class="form-item" style="margin-top: 20px">
          <input type="submit" name="formdangelen" value="Düzelt">
         </div>
    </form>
  </div>  
</main>
</body>
</html>