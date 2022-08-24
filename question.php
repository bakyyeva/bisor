<?php 
session_start();
//error_reporting(0);

include "includes/function.inc.php";

if (!isset($_GET["id"])) {
    git("Detayını görmek için önce soru seçmelisiniz!", "questions.php");
    exit;
}
if(!is_numeric($_GET["id"])){
    git("Böyle bir soru bulunamadı!", "questions.php");
    exit;
}

include "includes/dbconn.inc.php";

$sql ="select question.*, users.name, users.surname from question inner join users on question.user = users.id and question.id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(Array(":id"=>$_GET["id"]));
$question = $stmt->fetch(PDO::FETCH_ASSOC);

if ($question == false) {
    git("Böyle bir soru bulunamadı!", "questions.php");
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
    <link rel="stylesheet" href="style/soru.css">
</head>
<body>
  <?php
     include 'includes/header.inc.php';
   ?>
<main>
      <?php
            echo "<div class='left'>";
            echo "<h1>";
            echo htmlentities($question['title']);
            echo "</h1>";
            echo "<p class='name'> Soru soran: ";
            echo "<span>";
            echo htmlentities($question['name']);  echo " "; echo htmlentities($question['surname']);
            echo "</span>";
            echo "</p>";
            echo "<p class='name'> Zaman: ";
            echo "<span>";
            echo $question['time'];
            echo "</span>";
            echo "</p>";
            echo "<hr style='height:1px;border-width:0;color:lightgray;background-color:lightgray; margin:20px 30px'>";
            echo "<div class='sorag'>";
            echo "<img src='";
            echo $question["file"];
            echo "'>";
            echo "<p>";
            echo htmlentities($question['description']);
            echo "</p>";
            echo "</div>";
            echo "</div>";
            echo "<hr style='height:1px;border-width:0;color:lightgray;background-color:lightgray; margin:5px 30px;'>";
          $db = null; 
         if (isset($_SESSION["auth"]) and $_SESSION["auth"] == true) {
      ?>
          <div class="right">
              <p>Senin Cevabın</p> 
              <form action="answer.php" method="POST">
              <input type="hidden" name="questionID" value="<?php echo $question['id'];  ?>">
              <textarea name="answer"></textarea>
              <input type="submit" name="cevapform" value="Cevabını Gönder">
          </form> 
             </div> 
        <?php  }  else{
              echo "<div class='right2'>";
              echo  "<p style='color: rgb(175, 37, 37); font-size: 1.6rem; margin-left: 20px; margin-bottom: 20px;'> Cevap vermek için giriş yapınız! </p>";
              echo "</div>";
            } 

            include "includes/dbconn.inc.php";

            $sql ="select answer.*, users.name, users.surname from answer inner join users on users.id= answer.user_id and answer.question_id = :question_id order by time desc";
            $stmt = $db->prepare($sql);
            $stmt->execute(Array("question_id"=>$question["id"]));
  
            while ($question = $stmt->fetch(PDO::FETCH_ASSOC)) {   
                echo "<div class='cevap'>";
                echo '<p> <span style="font-weight: bold; color:#7e4722; font-size: 1.5rem">Cevaplayan: </span>';
                echo htmlentities($question["name"]);
                echo " ";
                echo htmlentities($question["surname"]);
                echo " </p>";
                echo '<p> <span style="font-weight: bold; color:#7e4722; font-size: 1.5rem">Zaman: </span>';
                echo $question["time"];
                echo '</p>';
                echo '<p style="margin-bottom: 10px;"> <span style="font-weight: bold; color:#7e4722; font-size: 1.5rem;">Cevap: </span>';
                echo htmlentities($question["text"]);
                echo '</p>';
                echo "</div>";
            }
            $db = null;
        ?>
</main>
</body>
</html>
