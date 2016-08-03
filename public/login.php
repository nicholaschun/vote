<?php

session_start();
require "../includes/ivote.php";
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


}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
  <?php include "../includes/header.php"?>

</head>
<body style="background: url(../background.jpg) no-repeat">

<?php  include "../includes/head.php"?>

<div id="login-container">
<div class="form-head">
    <h2> Students Voting Portal</h2>
</div>

    <span>*Please provide your index number and password </span>
    <div class="error-box">
        <div class="warning" name="genError">*Please Provide Index Number and Password </div>

    </div>
    <div class="form">


        <form action="login.php" method="post" id="voting-portal">
        <label>Enter Index Number</label></br>
        <input type="text" required="required" placeholder="" name="username" ><br>
        <label>Enter Your Password</label><br>
        <input type="password" required="required" name="password"a placeholder="" ><br>
        <button name="submit">Login</button>


    </form>
</div>
</div>
</body>
</html>
