<link rel="stylesheet" href="style.css">
<nav class="navbar">
  <div class="logo">Logo</div>
  <div class="divNavLinks">
    <ul class="navLinks">
      <li><a href="#">Home</a></li>
      <li><a href="#">Post a job offer</a></li>
    </ul>
    <div class="headerButtonsDiv">
      <?php session_start();
      if (empty($_SESSION['user_id'])) {
      ?>
        <button onclick="location.href='signIn.php'" class="signHeaderButton">Sign Up</button>
      <?php } else { ?>
        <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
          <a onclick="location.href=''">Profile</a>
          <form action="logout.php" method="post">
            <button type="submit" class="signHeaderButton">logout</button>
          </form>
        </div>
      <?php } ?>
    </div>
  </div>
</nav>