<?php
session_start();
include('security.php');
$connection=mysqli_connect("localhost","root","","adminpanel");



//register's php code
if(isset($_POST['check_submit_btn']))
{
     $email=$_POST['email_id'];
     $email_query = "SELECT * FROM users WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
       echo "Email Already Exists. Please try another";
    }
    else
    {
        echo "It's Available";
    }
}


if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
  //  $user_type = $_POST['user_type'];

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
            $query = "INSERT INTO users (username,email,password) VALUES ('$username','$email','$password')";
            $query_run = mysqli_query($connection, $query);
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else
            {
                $_SESSION['status'] = "Admin Profile Not Added";
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


//Update's php code
if(isset($_POST['register_update_btn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $fname=$_POST['edit_fname'];
    $lname=$_POST['edit_lname'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $role_as=$_POST['role_as'];
   // $usertypeupdate=$_POST['update_usertype']; usertype='$usertypeupdate'

    $query = "UPDATE users SET username='$username', fname='$fname', lname='$lname', email='$email', password='$password', role_as='$role_as' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
}



//delete's php code
if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM users WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
}



// admin login php code
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
          $user_password=$data['password'];
          $role_as=$data['role_as'];
        }
      $_SESSION['auth']=true;
      $_SESSION['auth_role']="$role_as";  //1=admin, 0=user
      $_SESSION['auth_user']=[
          'user_id'=>$user_id,
          'user_name'=>$user_name,
          'user_email'=>$user_email,
          'user_password'=>$user_password,
        ];
       if($_SESSION['auth_role']=='1')
       {
           $_SESSION['status']="Welcome to dashboard";
           $_SESSION['status_code']="success";
           header('Location:index.php');
       }
       elseif($_SESSION['auth_role']=='0')
       {
        $_SESSION['status']="Logging Successful";
        $_SESSION['status_code']="success";
        header('Location:../index.php');
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
//logout's php code
if(isset($_POST['logout_btn']))
{
    session_destroy();
    unset($_SESSION['username']);
    header('Location: login.php');
}








//blog php code
if(isset($_POST['save_faculty']))
{
    $name=$_POST['faculty_name'];
    // $design=$_POST['faculty_designation'];
    $description=$_POST['faculty_description'];
    $images=$_FILES['faculty_image']['name'];
    $date=date("Y/m/d");

    $img_types=array('image/jpg','image/png','image/jpeg','image/webp');
    $validate_img_extension=in_array($_FILES["faculty_image"]['type'], $img_types);
    if($validate_img_extension){
       if(file_exists("upload/" .$_FILES["faculty_image"]["name"]))
           {
             $store=$_FILES['faculty_image']['name'];
             $_SESSION['status']="Image Already Exists. '.$store.' ";
             header('Location:blog.php');
           }
       else{
       $query="INSERT INTO blog(name,date,description,images) VALUES('$name','$date','$description','$images')";
       $query_run=mysqli_query($connection,$query);

       if($query_run){
          move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);
         $_SESSION['success']="Blog Added";
          header('Location:blog.php');
        }
        else{
        $_SESSION['status']="Blog Not Added";
        header('Location:blog.php');
        }
      }
    }
    else{
        $_SESSION['status']="Only PNG,JPG,JPEG,WEBP Images are allowed";
        header('Location:blog.php');
    }
}




//blog update php code
if(isset($_POST['update_btn']))
{
  $edit_id=$_POST['edit_id'];
  $edit_name=$_POST['edit_name'];
  $edit_date=date("Y/m/d");
  $edit_description=$_POST['edit_description'];
  $edit_faculty_image=$_FILES['faculty_image']['name'];

  $img_types=array('image/jpg','image/png','image/jpeg','image/webp');
  $validate_img_extension=in_array($_FILES["faculty_image"]['type'], $img_types);

  if($validate_img_extension){
        $faculty_query="SELECT * FROM blog WHERE id='$edit_id' ";
         $faculty_query_run=mysqli_query($connection,$faculty_query);
        foreach($faculty_query_run as $fa_row)
        {
             // echo $fa_row['images'];
           if($edit_faculty_image==NULL)
          {
              //update with existing image
             $image_data=$fa_row['images'];
          }
         else
          {
            //update with new image and delete with old image
            if($img_path="upload/".$fa_row['images'])
            {
               unlink($img_path);
               $image_data=$edit_faculty_image;
            }
          }
       }

  $query="UPDATE blog SET name='$edit_name', date='$edit_date', description='$edit_description', images='$image_data' WHERE id='$edit_id' ";
  $query_run=mysqli_query($connection,$query);

  if($query_run)
  {
        if($edit_faculty_image==NULL)
        {
           //update with existing image
            $_SESSION['success']="Blog Updated with existing image";
           header('Location:blog.php');
         }
      else
      {
          //update with new image and delete with old image
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success']="Blog Updated";
         header('Location:blog.php');
       }
    }
  else
     {
      $_SESSION['status']="Blog Not Updated";
      header('Location:blog.php');
     }
  }
  else{
    $_SESSION['status']="Only PNG,JPG,JPEG,WEBP Images are allowed";
    header('Location:blog.php');
    }
}




//blog delete php code
if(isset($_POST['faculty_delete_btn']))
{
    $id=$_POST['delete_id'];
    $query="DELETE FROM blog WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success']="Blog Deleted ";
        header('Location:blog.php');
    }
    else{
        $_SESSION['status']="Blog isn't Deleted";
        header('Location:blog.php');
    }
}


