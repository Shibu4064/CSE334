<?php
   session_start();
    if(isset($_SESSION['auth']))
    {
      if(!isset($_SESSION['status']))
      {
        $_SESSION['status']="You are already Logged in";
      }
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
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
                <hr>
              </div>
                <form action="allcode.php" method="POST">

                    <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group mt-3">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Enter Password">
                    </div>

                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block mt-5"> Login </button>

                </form>
                <div class="text-center mt-2">
                        <a class="small" href="register.php" style="text-decoration: none;" >Create an Account!</a>
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