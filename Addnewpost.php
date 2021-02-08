<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
    $PostTitle = $_POST["PostTitle"];
    $Category = $_POST["Category"];
    $Image = $_FILES["Image"]["name"];
    $Target = "Uploads/".basename($_FILES["Image"]["name"]);
    $PostText = $_POST["PostDescription"];
    $Admin = $_SESSION["UserName"];
    date_default_timezone_set("Asia/Kolkata");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H: %M: %S",$CurrentTime);


    if(empty($PostTitle)){
        $_SESSION["ErrorMessage"] = "Title Cannot be empty";
        Redirect_to("Addnewpost.php");
    }elseif (strlen($PostTitle)<5){
        $_SESSION["ErrorMessage"] = "Post title should be greater than 5 character";
        Redirect_to("Addnewpost.php");
    }elseif (strlen($PostText)>9999) {
        $_SESSION["ErrorMessage"] = "Post description should be less than 1000 character";
        Redirect_to("Addnewpost.php");
    }else{
        //Query to insert post in database when everything is good
        global $ConnectingDB;
        $sql = "INSERT INTO posts(datetime,title,category,author,image,post)VALUES(:dateTime,:postTitle,:categoryName,:adminName,:imageName,:postDescription)";
        $stmt = $ConnectingDB->prepare($sql);

        //binding the values
        $stmt->bindValue(':dateTime',$DateTime);
        $stmt->bindValue(':postTitle',$PostTitle);
        $stmt->bindValue(':categoryName',$Category);
        $stmt->bindValue(':adminName',$Admin);
        $stmt->bindValue(':imageName',$Image);
        $stmt->bindValue(':postDescription',$PostText);


        $Execute=$stmt->execute();
        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

        if($Execute){
            $_SESSION["SuccessMessage"]="post with id : ".$ConnectingDB->lastInsertId() ." Added Successfully";
            Redirect_to("Addnewpost.php");
        }else{
            $_SESSION["ErrorMessage"]= "something went wrong. Try Again !";
            Redirect_to("Addnewpost.php");
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scal=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/7f6ee3d237.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>Add New Post</title>
</head>
<body>
<?php  ?>
<!--NAVBAR STARTS-->
<div style="height: 10px; background: cornflowerblue"></div>
<div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a href="#" class="navbar-brand">THINK HARD</a>
        <button style="background-color: #BEC9F2;" class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#Rcollapse">
            <span class="navbar-toggle-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="Rcollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="MyProfile.php" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a>
                </li>
                <li class="nav-item">
                    <a href="Dashboard.php" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="Posts.php" class="nav-link">Posts</a>
                </li>
                <li class="nav-item">
                    <a href="Categories.php" class="nav-link">Categories</a>
                </li>

                <li class="nav-item">
                    <a href="Admins.php" class="nav-link">Manage Admins</a>
                </li>
                <li class="nav-item">
                    <a href="Comments.php" class="nav-link">Comments</a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link">GO Live</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="Logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

    </div>
</div>
<div style="height: 10px; background: cornflowerblue"></div>
<!--NAVBAR ENDS-->

<!--HEADER STARTS-->
<header class="bg-dark text-white py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fas fa-edit"></i> Add New Post</h1>
            </div>
        </div>
    </div>
</header>
<!--HEADER ENDS-->

<!--MAIN AREA-->
<section class="container py-2 mb-4">
    <div class="row">
        <div class="offset-lg-1 col-lg-10" style="min-height: 400px;">
            <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
            <form class="" action="Addnewpost.php" method="post" enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-body bg-dark">
                        <div class="form-group">
                            <label for="title"><span class="fieldinfo">Post Title :</span></label>
                            <input class="form-control" type="text" name="PostTitle" placeholder="Type title here">
                        </div>
                        <div class="form-group">
                            <label for="CategoryTitle"><span class="fieldinfo">Choose Category :</span></label>
                            <select class="form-control" id="CategoryTitle" name="Category">
                                <?php
                                    // fetching all the category from category table
                                global $ConnectingDB;
                                $sql = "SELECT id,title FROM category";
                                $stmt = $ConnectingDB->Query($sql);
                                while ($Datarows =$stmt->fetch()){
                                    $Id = $Datarows["id"];
                                    $CategoryName = $Datarows["title"];
                                    ?>
                                <option><?php echo $CategoryName; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                            <input class="custom-file-input"type="file" name="Image" id="imageselect" value="">
                                <label for="imageselect" class="custom-file-label">Select Image </label>
                           </div>
                        </div>
                        <div class="form-group">
                            <label for="Post"><span class="fieldinfo">Post :</span></label>
                            <textarea class="form-control" name="PostDescription" cols="80" rows="8" id="Post"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <a href="#" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back to dashboard</a>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <button type="Submit" name="Submit" class="btn btn-success btn-block">
                                    <i class="fas fa-check"></i> Publish
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!--FOOTER STARTS-->
<div style="height: 5px; background: cornflowerblue"></div>
<footer class="bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="lead text-center">THINK HARD  |  <span id="year"></span>&copy: -----All right reserved</p>
            </div>
        </div>
    </div>
</footer>
<!--FOOTER ENDS-->
<div style="height: 5px; background: cornflowerblue"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
    $('#year').text(new Date().getFullYear());
</script>
</body>
</html>


