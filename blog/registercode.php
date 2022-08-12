<?php
 include('security.php');
 $connection=mysqli_connect("localhost","root","","adminpanel");
if(isset($_POST['register_btn']))
{
    $fname=mysqli_real_escape_string($connection,$_POST['fname']);
    $lname=mysqli_real_escape_string($connection,$_POST['lname']);
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
?>