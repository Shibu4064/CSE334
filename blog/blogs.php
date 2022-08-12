<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>
    <!-- Start your project here-->
    <div class="container">
    <div class="container-fluid py-5"><br>
        <h1 class="text-center mt-3 text-info">All Blogs</h1>
        <div class="row mt-4">
        <?php
           require 'blogpage/dbconfig.php';
           $query="SELECT * FROM blog";
           $query_run=mysqli_query($connection,$query);
           $check_faculty=mysqli_num_rows($query_run)>0;

           if($check_faculty)
           {
              while($row=mysqli_fetch_array($query_run))
              {
                ?>
                 <div class="col-md-3 mt-3">
                  <div class="card">
                  <img src="blogpage/upload/<?php  echo $row['images']; ?>" class="card-img-top" width="250px" height="250px" alt="">
                    <div class="card-body">
                        <h5 class="card-title text-primary"> <?php echo $row['name'];  ?> </h5>
                        <p class="card-title"> <?php echo $row['date'];  ?> </p>
                        <button class="btn btn-outline-info" style="height: 50px;">
                        <?php

                        echo '<a style="text-decoration:none"; href="readblog.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><p style="font-size:20px;color:black;">READ</p></a>';

                           ?>
                        </button>
                    </div>
                </div>
            </div>
               <?php
              }
           }
           else
           {
               echo "No Record Found";
           }
          ?>
        </div>

    </div>
    </div>
    <!-- End your project here-->
    <!-- Copyright -->
 <!-- <div class="text-center text-dark p-3" style="background-color: rgba(127, 255, 219, 0.4);">
    © 2022 Copyright:
    <a class="text-info" style="text-decoration: none;" href="https://mdbootstrap.com/">Hrithik Majumdar</a> -->
  <!-- </div> -->
  <!-- Copyright -->

    <?php
    include('includes/footer.php');
    ?>