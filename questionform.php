<?php
 session_start();
 //error_reporting(0);

 include 'includes/function.inc.php';

 if(isset($_SESSION['auth']) and $_SESSION['auth'] == true) {
  
} else{
  git("Önce giriş yapmalısınız!", "loginform.php");
  exit;
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
 <div class="container-question">
   <h1>Yardım al</h1>
   <form enctype="multipart/form-data" action="upload.php?formgordu=1" method="POST">
         <div class="form-item">
           <label for="title">Başlık giriniz</label>
           <?php
            if(isset($_SESSION["title"])) {
           ?>
            <input type="text" name="title" id="title" value="<?php echo $_SESSION["title"]; unset($_SESSION["title"]); ?>" required>
          <?php } else{ ?>
            <input type="text" name="title" id="title" required>
            <?php } ?>
          </div>
         <div class="form-item">
           <label for="description">Açıklama giriniz</label>
           <?php
            if(isset($_SESSION["description"])) {
           ?>
           <textarea name="description" id="description" required><?php echo $_SESSION["description"]; unset($_SESSION["description"]); ?> </textarea>
           <?php } else { ?>
            <textarea name="description" id="description" required> </textarea>
           <?php } ?>
          </div>
         <div class="form-item">
            <label for="file">Dosya yükle</label>
            <input type="file" name="uploadedFile" id="file">
         </div>
         <?php
          if (isset($_SESSION["error"])) {
            echo "<p style='text-align: center; color: red; font-size: 1.6rem;'>";
            echo $_SESSION["error"];
            echo "</p>";
          }
          unset($_SESSION["error"]);
        ?>
          <div class="form-item" style="margin-top: 20px">
            <input type="submit" name="formdangelen" value="Yükle">
         </div>
     </form>
  </div>  
</main>
</body>
</html>