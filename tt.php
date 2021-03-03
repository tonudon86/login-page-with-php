<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

*{
    box-sizing: border-box;
}

body{
    font-family: 'Inter';
    height: 100%;
    background: #eee;
    display: flex;
    align-items: center;
    justify-content: center;
}
form{
    background: white;
    color: black;
    padding: 60px;

    width: 550px;
    max-width: calc(100%-60px);
    /* border-radius: 15px; */
}
.form-element{
    display: flex;
    flex-direction: column;
    margin-bottom: 30px;
 
}

.form-element span {
    margin-bottom: 10px;

}

input,textarea{
    border: 1px solid #d0d2e2;
    line-height: 2;
    padding: 5px;
    border-radius: 5px;
}

.radio button{
    margin: 10px;
    cursor: pointer;
}

form button{
    width:100% ;
    padding:20px;
    color: white;
    background: rgb(91, 146, 197);
    border-radius: 5px;
    border: none;
    font-size: 15px;
    
}


    </style>
</head>
<body>
    
    <section>
        
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Assignment Submit</h1>
            <p>The name and photo associated with your Google account will be recorded when you upload files and submit this form.
            </p>
            <hr>
            <div class="form-element">
                <span>Name</span>
                <input type="text" name="name"  required   placeholder="Name">
            </div>
            <div class="form-element">
                <span for="email">Email address</span>
                <input type="email" name="emailaddress"   required  placeholder="Email">
            </div>
            
            <div class="form-element radio-button">
             <!-- <span>What is your query about?</span>  -->
                <label for="rollno">
                    <span for="rollno">Roll no</span>
                    <input type="number" name="rollno"   required  value="number">
                </label>
               
                
            </div>
            <div class="form-element">
                <span for="file">Upload your assignment in pqf form</span>
               <input type="file" name="pdffile"   required >
            </div>
            <button  name="submit" type="submit">Submit</button>
        </form>
<?php

if ($_SERVER['REQUEST_METHOD']== 'POST'){
    $name = $_POST['name'];
    $emailid = $_POST['emailaddress'];
    $rollno = $_POST['rollno'];
    $files = $_FILES['pdffile'];

    $filename = $files['name'];
    $fileerro = $files['error'];
    $filetmp = $files['tmp_name'];

    $fileext = explode('.', $filename);
    $filecheck = strtolower(end($fileext));

    $fileextstored = array('pdf','txt','ppt','txt');

    

    if(in_array($filecheck,$fileextstored)){
        $destinationfile = 'upload/'.$filename ;
        move_uploaded_file($filetmp,$destinationfile);


        // $q = "INSERT INTO `fileupload`(`name`, `email`, `rollno`, `pdffile`)
        //  VALUES ('$name',' $emailid','$rollno','$filename',)";
    }
}
// submit these to database

$servername ="localhost";
$username = "root";
$password = "";
$database = "displayupload";
// create a connection object
$conn = mysqli_connect($servername, $username, $password,$database);
// die if connection was not successful
if(!$conn){
    die("Sorry we failed to connect : ". mysqli_connect_error());
}
else{
    echo  "Connection was successfully<br>";
}


$sql ="INSERT INTO `fileupload`( `name` , `email`,`rollno` , `pdffile`)
 VALUES ( '$name', '$emailid', '$rollno','$filename') ";

$result= mysqli_query($conn, $sql);
   


if($result){
    echo "The db was created  successfully<br>";
}
else{
    echo "The db was not  created  successfully becasue of this error ---->" . mysqli_error($conn);
}


?>

 </section>
</body>
</html>