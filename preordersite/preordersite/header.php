<!-- Header //-->
<!-- herunder findes alle hyperlinks til at navigere rundt på siden og den includer også functions fra filerne logout.inc.php, logout.inc.php og register.inc.php //-->
<?php
    error_reporting(E_ERROR | E_PARSE);
    session_start();
?>

<header>
  <nav>
    <div class="main-wrapper">
      <ul>
        <!-- hyperlinks til at navigere rundt på siden -->
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <?php
        //funktion til at tjekke om man er logget ind eller ej
        if(isset($_SESSION['u_id'])) {
          echo "<li><a href='profile.php'>Profile</a></li>";
        }
        ?>
      </ul>
      <div class="nav-login">
      <?php
          //funktion til at tjekke om man er logget ind eller ej
          if(isset($_SESSION['u_id'])){
            echo '<form action="include/logout.inc.php" method="POST">
              <button type="submit" name="submit">Logout</button>
            </form>';
          } else {
            //html der vises når man ikke er logget ind
            echo '<form action="include/login.inc.php" method="POST">
              <input type="text" name="uid" placeholder="Username/e-mail">
              <input type="password" name="pwd" placeholder="password">
              <button type="submit" name="submit">Login</button>
            </form>
              <a href="register.php" style="background-color:#262626; color:white;
        "> Register </a>';

          }
      ?>
      </div>
    </div>
  </nav>
</header>
<!-- Header //-->