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
    <link rel="stylesheet" href="style/aboutme.css">
</head>
<body>
    <?php
      include "includes/header.inc.php";
    ?>
  <main>
       <div class="image">
         <div class="profile">
           <img src="images/profile.jpg"> 
         </div>
         <div class="icon">
            <a href="https://github.com/bakyyeva"><img src="images/github.png"></a> 
            <a href="https://www.linkedin.com/in/uzukbakyyeva/"><img src="images/linkedin.png"></a> 
            <a href="https://twitter.com/bakyyeva"><img src="images/twitter.png"></a> 
          </div>
       </div>
       <div class="text">
          <h2>Hakkımda</h2>
          <p>
             Merhaba ben Uzuk Bakyyeva. Marmara Üniverstesi 
             Bilgisayar ve Öğretim Teknolojileri Öğretmenliği bölümü öğrencisiyim. 
             Web Tabanlı Programlama dersi kapsamında yaptığım bu web sitesi BÖTE öğrencileri için.
             Bu sitenin amacı, BÖTE öğrencilerinin programlamada 
             karşılaştıkları hataları birbirleriyle paylaşarak yardımlaşabilmeleri için. 
           </p>
       </div>
  </main>  
</body>
</html>