<head>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <nav class="navbar" style="display: flex;position: fixed;width: 100%;  overflow: hidden;">
    <div class="logo">Logo</div>
    <div class="divNavLinks">
      <ul class="navLinks">
        <li><a href="index.php">Home</a></li>
        <li><a href="createOffer.php">Post a job offer</a></li>
      </ul>
      <div class="headerButtonsDiv">
        <?php session_start();
        if (empty($_SESSION['user_id'])) {
        ?>
          <button onclick="location.href='signIn.php'" class="signHeaderButton">Sign Up</button>
        <?php } else { ?>
          <div style="display: flex; justify-content: center; align-items: center; gap: 30px;">
            <a href="profile.php"><img  width="30" height="30" src="https://img.icons8.com/ios-glyphs/60/4a90e2/user--v1.png" alt="user--v1" /></a>
            <form action="logout.php" method="post">
              <button type="submit" class="signHeaderButton">logout</button>
            </form>
          </div>
        <?php } ?>
      </div>
    </div>
  </nav>
</body>