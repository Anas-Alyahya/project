<?php

$firstName = $_POST['firstName'];
$lastName =  $_POST['lastName'];
$email =     $_POST['email'];

$errors = [
    'firstNameError' => '',  
    'lastNameError' => '',
    'emailError' => '',     
];

if (isset($_POST['submit'])) {

//تحقق من الاسم الاول
if(empty($firstName)){
    $errors['firstNameError'] = '*الرجاء ادخال الاسم الاول';
  }

  //تحقق من الاسم الاخير
if(empty($lastName)){
    $errors['lastNameError'] = '*الرجاء ادخال الاسم الاخير';
  }

  //تحقق من البريد الالكتروني
if(empty($email)){
    $errors['emailError'] = '*الرجاء ادخال البرد الالكتروني';
  }
  elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['emailError'] = '*الرجاء ادخال البريد الالكتروني بشكل صحيح';
  }
  
  //تحقق من الارسال و الاخطاء 
  if(!array_filter($errors)){
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName =  mysqli_real_escape_string($conn, $_POST['lastName']);
    $email =     mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "INSERT INTO users(firstName, lastName, email) 
        VALUES ('$firstName', '$lastName', '$email')"; 

if(mysqli_query($conn, $sql)){
    header('location: ' . $_SERVER['PHP_SELF']);
}
else{
    echo 'Error: ' . mysqli_error($conn);
   }
  }
}
