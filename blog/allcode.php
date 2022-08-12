<?php
session_start();
 include('security.php');
 $connection=mysqli_connect("localhost","root","","adminpanel");
 //register php code
if(isset($_POST['register_btn']))
{
    $fname=mysqli_real_escape_string($connection,$_POST['fname']);
    $lname=mysqli_real_escape_string($connection,$_POST['lname']);
   // $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email=mysqli_real_escape_string($connection,$_POST['email']);
    $password=mysqli_real_escape_string($connection,$_POST['password']);
    $cpassword=mysqli_real_escape_string($connection,$_POST['cpassword']);

    $email_query = "SELECT * FROM users WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO users (fname,lname,email,password,cpassword) VALUES ('$fname','$lname','$email','$password','$cpassword')";
            $query_run = mysqli_query($connection, $query);
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Registered Successfully";
                $_SESSION['status_code'] = "success";
                header('Location: login.php');
            }
            else
            {
                $_SESSION['status'] = "Something went Wrong!";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');
            }
        }
        else
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');
        }
    }
}
//login php code
if(isset($_POST['login_btn']))
{
    $email_login = $_POST['email'];
    $password_login = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email_login' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($connection, $query);

    if(mysqli_num_rows($query_run)>0)
    {
      foreach($query_run as $data)
       {
          $user_id=$data['id'];
          $user_name=$data['fname'].' '.$data['lname'];
          $user_email=$data['email'];
          $role_as=$data['role_as'];
        }
      $_SESSION['auth']=true;
      $_SESSION['auth_role']="$role_as";  //1=admin, 0=user
      $_SESSION['auth_user']=[
          'user_id'=>$user_id,
          'user_name'=>$user_name,
          'user_email'=>$user_email,
        ];
       if($_SESSION['auth_role']=='1')
       {
           $_SESSION['status']="Welcome to dashboard";
           $_SESSION['status_code']="success";
           header('Location:blogpage/index.php');
       }
       elseif($_SESSION['auth_role']=='0')
       {
        $_SESSION['status']="Logging Successful";
        $_SESSION['status_code']="success";
        header('Location:index.php');
       }
       else
       {
        $_SESSION['status'] = "Email / Password is Invalid";
        $_SESSION['status_code'] = "warning";
        header('Location: login.php');
       }
    }
   else
   {
    $_SESSION['status']="You are not allowed to access this file";
    $_SESSION['status_code']="warning";
    header('Location:login.php');
   }

}
//logout php code
if(isset($_POST['logout_btn']))
{
    unset($_SESSION['auth']);
    unset($_SESSION['auth_role']);
    unset($_SESSION['auth_user']);
    $_SESSION['status']="logged out successfully"; 
    $_SESSION['status_code']="success";
    header('Location:login.php');
}
?>