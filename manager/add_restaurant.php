<?php
   include('session_m.php');
   
   if(!isset($login_session)){
   header('Location: managerlogin.php'); // Redirecting To Home Page
   }
   
   if(isset($_POST['submit']))
   {

    if(empty($_POST['name'] || empty($_POST['email']) || empty($_POST['conatct']) || empty($_POST['address'])))
    {
      echo '<script>alert("Please enter all details.")</script>';
    }
   else
      {
    
   $check_res= mysqli_query($conn, "SELECT name FROM restaurants where name = '".$_POST['name']."' ");  
      if(mysqli_num_rows($check_res) > 0)
        {
         echo '<script>alert("Restaurant already exist!")</script>';
        }
      else{
      $M_ID=$_SESSION['login_user1'];
      $filename=$_FILES['res_img']['name'];
      $filetype=$_FILES['res_img']['type'];
      if($filetype=='image/jpeg' or $filetype=='image/png' or $filetype=='image/gif')
      {
         $filepath="images/".$filename;
         $sql = "INSERT into restaurants(name,email,contact,address,res_img,M_ID) VALUES('".$_POST['name']."','".$_POST['email']."','".$_POST['contact']."','".$_POST['address']."','".$filepath ."', '".$M_ID."')";
         $success = mysqli_query($conn, $sql);
         move_uploaded_file($_FILES['res_img']['tmp_name'],'images/'.$filename);
         if (!success) {
           echo '<script>alert("Please try again..");</script>';
         }
         else{
            echo '<script>alert("Restaurant Added Successfully.");</script>';
            header('Location: myrestaurant.php');
         }         
          }
          else {
         echo '<script>alert("image not added.");</script>';
       } 
       }  
   }
}

   
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
            <div class="col-lg-12">
               <div class="form-area" style="padding: 0px 100px 100px 100px;">
                  <form action="" method="POST" enctype="multipart/form-data">
                     <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> ADD RESTAURANT </h3>
                     <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Restaurant Name" required="">
                     </div>
                     <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Restaurant Email" required="">
                     </div>
                     <div class="form-group">
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number" required="">
                     </div>
                     <div class="form-group">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" required="">
                     </div>
                     <div class="form-group">
                        <label><b>Restaurant Image</b></label>
                        <input type="file" class="form-control" id="res_img" name="res_img" required="">
                     </div>
                     <div class="form-group">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right"> ADD RESTAURANT </button>    
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main.js"></script>
   </body>
</html>