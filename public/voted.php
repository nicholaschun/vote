<?php

session_start();
require_once "../includes/ivote.php";
$vote = new Database();


if(isset($_POST['submit'])){

    $username = $vote->mysql_prep($_POST['username']);
    $password = $vote->mysql_prep($_POST['password']);

    $found = $vote->student($username,$password);
    if($found){
        if($vote->get_student()){
            header("location:".$vote->student_home());
        }
    }
    else{
        header("location:falselogin.php");
    }

}
?>




<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <link type="text/css" href="../css/style.css" rel="stylesheet"/>
    <link type="text/css" href="../css/jquery.validate.css" rel="stylesheet"/>

    <script src="../js/jquery-latest.js"></script>
    <script src="../js/jquery.validate.js"></script>
    <script src="../js/validate-forms.js"></script>

</head>
<body style="background: url(../background.jpg) no-repeat">

<div id="top-bar">
    <marquee direction="left"><p style="color: #ffffff;font-weight: bold;">Welcome Biological Science.. Voting ends at 5:00pm. Keep calm and cast your votes Thank you for using our services...</p></marquee>

</div>


<div id="login-container">
    <div class="form-head">
        <h2> Students Voting Portal</h2>
    </div>

    <span>*Please provide your index number and password </span>
    <div class="error-box">
        <div style="display:block" class="warning" name="genError">*You Have Already Voted or in session </div>

    </div>
    <div style="margin-top:-50px" class="form">


        <form action="login.php" method="post" id="voting-portal">
            <label>Enter Index Number</label></br>
            <input type="text" placeholder="" name="username" id="username"><br>
            <label>Enter Your Password</label><br>
            <input type="password" name="password"a placeholder="" id="password"><br>
            <button name="submit">Login</button>


        </form>
    </div>
</div>

</body>
