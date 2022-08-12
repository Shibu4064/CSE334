<?php
session_start();
    if(isset($_SESSION['auth']))
    {
      $_SESSION['status']="You are already registered";
      header('Location:index.php');
    }
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="container mt-5">
<!-- Outer Row -->
<div class="row justify-content-center">
  <div class="col-xl-6 col-lg-6 col-md-6">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">

            <div class="p-5">
            <?php  // include('message.php');   ?>
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Register Here!</h1>
                <hr>
              </div>
                <form action="allcode.php" method="POST">

                <div class="form-group">
                    <input type="text" name="fname" class="form-control form-control-user" placeholder="Enter First Name..." required>
                    </div>
                    <div class="form-group">
                    <input type="text" name="lname" class="form-control form-control-user" placeholder="Enter Last Name..." required>
                    </div>
                    <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address..." required>
                    </div>
                    <div class="form-group mt-3">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                    </div>
                    <div class="form-group mt-3">
                    <input type="password" name="cpassword" class="form-control form-control-user" placeholder="Confirm Password" required>
                    </div>

                    <button type="submit" name="register_btn" class="btn btn-primary btn-user btn-block mt-5"> Register </button>

                </form>
                <div class="text-center mt-2">
                        <a class="small" href="login.php" style="text-decoration: none;" >Login Now</a>
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php

include('includes/scripts.php');

?>