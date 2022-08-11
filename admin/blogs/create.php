<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$title = $detail = "";
$title_err = $detail_err = "";
$date=date("Y-m-d H:i:s");
$author="Admin";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter a title.";
    } 
    else{
        $title = $input_title;
    }
    
    // Validate detail
    $input_detail = trim($_POST["detail"]);
    if(empty($input_detail)){
        $detail_err = "Please enter detail.";     
    } else{
        $detail = $input_detail;
    }
    
    
    // Check input errors before inserting in database
    if(empty($title_err) && empty($detail_err)){
        //insert statement
        $sql = "INSERT INTO tblblog (title,detail,author,date) VALUES (?, ?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_title, $param_detail, $param_author, $param_date);
            
            // Set parameters
            $param_title = $title;
            $param_detail = $detail;
            $param_author = $author;
            $param_date=$date;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Blogs</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                            <span class="invalid-feedback"><?php echo $title_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Detail</label>
                            <textarea name="detail" class="form-control <?php echo (!empty($detail_err)) ? 'is-invalid' : ''; ?>"><?php echo $detail; ?></textarea>
                            <span class="invalid-feedback"><?php echo $detail_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>