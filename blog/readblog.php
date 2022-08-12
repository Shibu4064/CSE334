<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>
<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "dbconfig.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM blog WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["name"];
                $design = $row["design"];
                $description = $row["description"];
                $images=$row["images"];
                

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- <h1 class="mt-5 mb-3">BLOG</h1> -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    
                    <br>
                    <br>
                    <br>
                    <br>
                    
                    
                    <div class="form-group">
                        <!-- <label>Title</label> -->
                        <p style="text-align:center;color: #594568;font-size: 30px;"><b><?php echo $row["name"]; ?></b></p>
                    </div>
                    <br>
                    
                    <div class="form-group">
                        <!-- <label>Detail</label> -->
                        <img src="blogpage/upload/<?php  echo $row['images']; ?>" class="card-img-top" width="" height="" alt="">
                    </div>
                    
                    <div class="form-group">
                        <!-- <label>Detail</label> -->
                        <p><?php echo $row["description"]; ?></p>
                    </div>

                    <div class="form-group">
                        <!-- <label>Detail</label> -->
                        <p style="text-align:right;"><?php echo $row["date"]; ?></p>
                    </div>
                    
                    

                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

    <?php
    include('includes/footer.php');
    ?>