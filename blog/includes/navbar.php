<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand text-danger" href="\eris\index.php">Job Portal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <!-- <a class="nav-link" href="about.php">About</a> -->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blogs.php">Blogs</a>
        </li>
        

      </ul>
    
      <div class="d-flex align-items-center">

      

      <?php if(isset($_SESSION['auth_user']))  : ?>
      <div class="dropdown">
        <a  class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
            <?php    echo $_SESSION['auth_user']['user_name'];     ?>
        </span>
          <img src="img/profile.webp" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy"/>
        </a>
        <ul class="dropdown-menu dropdown-menu-end"  aria-labelledby="navbarDropdownMenuAvatar">
          <li>
            <a class="dropdown-item" href="#">My profile</a>
          </li>
          <li>
            <!-- <a class="dropdown-item" href="#">Settings</a> -->
          </li>
          <li>
            <form action="allcode.php" method="POST">
              <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
            </form>
          </li>
        </ul>
      </div>
      <?php  else :   ?>
      <li class="nav-item">
          <a class="nav-link" href="login.php">Join Now</a>
        </li>
    </div>
    <?php endif;  ?>

    </div>
  </div>
</nav>