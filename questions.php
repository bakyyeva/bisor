<?php 
session_start();
//error_reporting(0);

include "includes/dbconn.inc.php";

$sql ="select question.*, users.name, users.surname from question inner join users on question.user = users.id";
$stmt = $db->prepare($sql);
$stmt->execute();
$pcs = $stmt->rowCount(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BÖTE</title>
    <link rel="stylesheet" href="style/sorular.css">
</head>
<body>
<header>
  <div class="logo">
    <a href="index.php"><p>BÖTE</p>
    <p style="font-size: 1.2rem; margin-top: 0;">öğrencileri</p> </a>
  </div>
 <nav>
     <ul class="nav-list">
        <form action="search.php" method="GET" class="search">
            <input type="text" name="ifade" placeholder="Aranacak ifade...">
            <input type="submit" value="Ara">
        </form>
      <li>
        <a href="index.php">Anasayfa</a>
      </li>
      <li>
        <a href="aboutme.php">Hakkımda</a>
      </li>
      <li>
        <a href="questions.php">Sorular</a>
      </li>
      <li>
        <p style="font-size: 3rem;"> | </p>
       </li>
       <li>
         <p class="nav-login">
            <?php  
                if(isset($_SESSION['auth']) and $_SESSION['auth'] == true) {
                    echo htmlentities($_SESSION['name']);
                    echo " ";
                    echo htmlentities($_SESSION['surname']);
                    echo " ";
                    echo "<a href='logout.php' style='margin-left:2rem'> <img src='images/logout.png'>  </a>";
                } else {
            ?>
         </p>
        </li>
        <li>
           <a href="loginform.php">Giriş</a>
        </li>
        <li>
            <a href="signupform.php">Üye ol</a>
         </li>
         <?php
            }
          ?>
    </ul>
 </nav>
</header>
<main>
    <div class="baslik">
    <h1>Sorular</h1>
    <?php
    echo "<p> $pcs soru </p>";
    ?>
 </div>
 <hr style="height:1px;border-width:0;color:cyan;background-color:lightgray; margin: 20px 40px;">
 <?php
        while ($question = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='sonuc'>";
            echo "<a href='question.php?id=";
            echo $question["id"]; 
            echo "'>";
            echo htmlentities($question['title']);
            echo "</a>";
            echo "<p>";
            echo htmlentities($question['description']);
            echo"</p>";
             if(isset($_SESSION["id"]) and ($_SESSION["id"] == $question["user"])) {  
  ?>
            <span> 
              <form action="updateform.php" method="POST">
                <input type="hidden" name="update_id" value=" <?php echo $question["id"] ?>">
                <input type="submit" name="formdangelen" value="Düzelt">
              </form>
              <form action="delete.php" method="POST">
                    <input type="hidden" name="delete_id" value=" <?php echo $question["id"] ?>">
                    <input type="submit" name="formdangelen" value="Sil">
               </form>
            </span>
          <?php  }  
            echo "</div>";
        }
             $db = null;
          ?>
</main>   
</body>
</html>