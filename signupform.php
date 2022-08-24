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
    <link rel="stylesheet" href="style/signup.css">
</head>
<body>
<main>
    <div class="login-box">
        <h2>Kullanıcı Kaydı</h2>
        <form action="signup.php" method="POST">
          <div class="user-box" style="margin-top: 25px;">
          <?php if(isset($_SESSION["username"])) { ?>
            <input type="text" name="username" value="<?php echo $_SESSION['username']; unset($_SESSION['username']);  ?>" required>
          <?php } else { ?>
            <input type="text" name="username" placeholder="Kullanıcı adı" required>
          <?php  } ?>  
          </div>
          <div class="user-box">
          <?php if(isset($_SESSION["name"])) { ?>
            <input type="text" name="name" value="<?php echo $_SESSION['name']; unset($_SESSION['name']);  ?>" required>
          <?php } else { ?>
            <input type="text" name="name" placeholder="Ad" required>
          <?php  } ?>  
          </div>
          <div class="user-box">
          <?php if(isset($_SESSION["surname"])) { ?>
            <input type="text" name="surname" value="<?php echo $_SESSION['surname']; unset($_SESSION['surname']);  ?>" required>
          <?php } else { ?>
            <input type="text" name="surname" placeholder="Soyad" required>
          <?php  } ?>    
          </div>
          <div class="user-box">
          <?php if(isset($_SESSION["email"])) { ?>
            <input type="email" name="email" value="<?php echo $_SESSION['email']; unset($_SESSION['email']);  ?>" required>
          <?php } else { ?>
            <input type="email" name="email" placeholder="E-Posta" required>
          <?php  } ?>   
          </div>
          <div class="user-box">
            <input type="password" name="pwd" placeholder="Şifre" required>
          </div>
          <div class="user-box">
            <input type="password" name="pwdRepeat" placeholder="Şifre(Tekrar)" required>
          </div>
          <?php
          if (isset($_SESSION["error"])) {
            echo "<p style='text-align: center; color: red; font-size: 1.6rem;'>";
            echo $_SESSION["error"];
            echo "</p>";
          }
          unset($_SESSION["error"]);
        ?>
          <div class="login-row" style="margin-top: 40px;">
            <div class="login-left">
              <a href="loginform.php">Giriş sayfası</a>
            </div>
            <div class="login-right"><input type="submit" name="submit" value="Kayıt ol"></div>
          </div>
        </form>
      </div>
</main>
</body>
</html>