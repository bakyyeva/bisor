<?php 
session_start();
//error_reporting(0);

include "includes/function.inc.php";

if(isset($_SESSION['auth']) and $_SESSION['auth'] == true) {
  git("Giriş yapmış durumdasınız!", "index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BÖTE</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
<main>
    <div class="login-box">
        <h2>Kullanıcı Girişi</h2>
        <form action="login.php" method="POST">
          <div class="user-box" style="margin-top: 25px;">
            <input type="text" name="username" placeholder="Kullanıcı adı" required>
          </div>
          <div class="user-box">
            <input type="password" name="pwd" placeholder="Şifre" required>
          </div>
          <div class="login-row" style="margin-top: 40px;">
            <div class="login-left">
                <p>Hesabınız yokmu?</p>
                <p>Hemen <a href="signupform.php">Üye ol</a></p>
            </div>
            <div class="login-right"><input type="submit" name="submit" value="Giriş yap"></div>
          </div>
        </form>
      </div>
</main>
</body>
</html>