<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>assignment management system</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.html">Php Login System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php"> student Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">student Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"> teacher Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"> teacher register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>

      
     
    </ul>

  <div class="navbar-collapse collapse">
  <ul class="navbar-nav ml-auto">
  <li class="nav-item active">
        <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Welcome ". $_SESSION['username']?></a>
      </li>
  </ul>
  </div>


  </div>
</nav>

<div class="container mt-4">
<h3><?php echo "Welcome ". $_SESSION['username']?></h3>
<hr>

</div>
<div class="form">
<form action="#" method="post" enctype="multipart/form-data">
            <h1>Hindi Assignment Submit</h1>
            <div class="form-element">
         
                <label for="Business">
                    <span>Roll no</span>
                    <input type="number" name="rollno"   required  value="number">
                </label>
               
                
            </div>
            <div class="form-element">
                <span>Upload your assignment in pqf form</span>
                <input type="file" id="to" name="to">
            </div>
            <input type="submit" value="Upload file" name="submit">
        </form>
</div>

<?php


// if ($_SERVER['REQUEST_METHOD']== 'POST'){
 


// submit these to database

$servername ="localhost";
$username = "root";
$password = "";
$database = "feb";

// create a connection object
$conn = mysqli_connect($servername, $username, $password,$database);
// die if connection was not successful
if (isset($_POST['submit'])) { 
// $rollno = $_POST['rollno'];


// $sql ="INSERT INTO `fileupload`(`rollno`)
// //  VALUES ('$rollno') ";

// // $result= mysqli_query($conn, $sql);
   


// if($result){
//     echo "The db was created  successfully<br>";
// }
// else{
//     echo "The db was not  created  successfully becasue of this error ---->" . mysqli_error($conn);
// }



//  }
$filename = $_FILES['to']['name'];

// destination of the file on the server
$destination = 'uploads/' . $filename;
// $destination = 'https://drive.google.com/drive/folders/1FYI71dl8MN7Rx7LNU6CDtGmHvd7S7PIj' . $filename;

// get the file extension
$extension = pathinfo($filename, PATHINFO_EXTENSION);

// the physical file on a temporary uploads directory on the server
$file = $_FILES['to']['tmp_name'];
$size = $_FILES['to']['size'];
$rollno = $_POST['rollno'];

if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
    echo "You file extension must be .zip, .pdf or .docx";
}
 elseif ($_FILES['to']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
    echo "File too large!";
} else {
    // move the uploaded (temporary) file to the specified destination
    if (move_uploaded_file($file, $destination)) {
        $sql = "INSERT INTO files (name, size, downloads,rollno) VALUES ('$filename','$size', 0,'$rollno')";
        if (mysqli_query($conn, $sql)) {
            echo "File uploaded successfully";
        }
    } else {
        echo "Failed to upload file.";
    }
}
}



?>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
