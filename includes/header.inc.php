<header>
  <div class="logo">
    <a href="index.php">
      <p>BÖTE</p> 
      <p style="font-size: 1.2rem; margin-top: 0;">öğrencileri</p>  
    </a>  
  </div>
 <nav>
    <ul class="nav-list">
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