<?php

include('session_m.php');

if(!isset($login_session)){
header('Location: managerlogin.php'); 
}


$name = $conn->real_escape_string($_POST['name']);
$price = $conn->real_escape_string($_POST['price']);
$category_name = $conn->real_escape_string($_POST['category_name']);
$description = $conn->real_escape_string($_POST['description']);
// Storing Session
$user_check=$_SESSION['login_user1'];
$R_IDsql = "SELECT restaurants.R_ID, restaurants.name FROM restaurants, manager WHERE restaurants.M_ID='$user_check'";
$R_IDresult = mysqli_query($conn,$R_IDsql);
$R_IDrs = mysqli_fetch_array($R_IDresult, MYSQLI_BOTH);
$R_ID = $R_IDrs['R_ID'];
$R_Name = $R_IDrs['name'];

$filename=$_FILES['images_path']['name'];
$filetype=$_FILES['images_path']['type'];
if($filetype=='image/jpeg' or $filetype=='image/png' or $filetype=='image/gif')
{
$filepath="images/".$filename;

// $images_path = $conn->real_escape_string($_POST['images_path']);

$query = "INSERT INTO food(name,price,description,category_name,R_ID,R_Name,images_path) VALUES('" . $name . "','" . $price . "','" . $description . "','".$category_name ."','" . $R_ID ."','" . $R_Name ."','".$filepath ."')";
$success = $conn->query($query);
move_uploaded_file($_FILES['images_path']['tmp_name'],'images/'.$filename);

if (!$success){

	?>
  <!DOCTYPE html>
<html>
  <head>
    <title>Dashboard | FoodShala</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
    <div class="wrapper d-flex align-items-stretch">
    <?php
     include 'navbar1.php';
     ?>

<div class="container">
    <div class="jumbotron">
     <h1>Oops...!!! </h1>
     <p>Kindly enter your Restaurant details before adding food items.</p>
     <p><a href="myrestaurant.php"> Click Me </a></p>

    </div>
    </div>
    <br><br><br><br><br><br>
      
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>

	<?php
	
}
else {
	header('Location: view_food_items.php');
}
}
else {
    echo '<script>alert("Invaild image format.");</script>';
}

$conn->close();


?>