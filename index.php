<?php 
session_start();
//error_reporting(0);
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
       <div class="container">
           <p>Birlikten Güç Doğar</p>
          <div class="box">
            <div class="box-1">
                 <img src="images/sorag.png">
                 <a href="questionform.php">Yardım al</a> 
            </div>
            <div class="box-2">
                 <img src="images/open-book.png" style="color: white;">
                 <a href="#">Yararlı Kaynaklar</a> 
            </div>
          </div>
       </div>
 </main>
</body>
</html>