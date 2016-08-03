<?php

require_once("../includes/ivote.php");


$LS = new Database();

$message = "";
$execute = "";
$error_count ="";

if(isset($_POST['submit'])){

    $fullname =$LS->mysql_prep($_POST['fullname']);
    $user =$LS->mysql_prep($_POST['username']);
    $pass =$LS->mysql_prep($_POST['password']);

    $salt =$LS->createSalt();
    $hash =$LS->hash_pass($pass,$salt);

    if($fullname== "" ||  $user=="" && $pass==""){
        $message = "Please fill in required field";
        $error_count=true;
    }

    $stmt = $LS->query("SELECT username FROM admin WHERE username = :username");
    $LS->bind(':username',$user);
    $row = $LS->single();
    if(!empty($row['username'])){
        $message = "username already in use";
        $error_count=true;
    }

    else{
        $sql =$LS->query("INSERT INTO admin (username,password,password_salt,fullname) VALUES(:username,:password,:salt,:name)");

        $query=$LS->bind(':username',$user);
        $query=$LS->bind(':password',$hash);
        $query=$LS->bind(':salt',$salt);
        $query=$LS->bind(':name',$fullname);

        $execute = $LS->execute();
    }

    if($execute){
        header("Location:login.php");

    }
    else{

        $message = "Administrator Account Already Exists";
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
<body style="background: url(../images/background3.jpg) no-repeat">

<div id="top-bar">

</div>

<div id="login-container" style="height: 500px">
    <div class="form-head">
        <h2> Administrative  Portal</h2>
    </div>

    <span>*Please Fill the from below </span>
    <div class="error-box">
        <div class="warning" name="genError">*Please Provide Username and Password </div>

    </div>
    <div class="form">


        <form action="add_admin.php" method="post" id="voting-portal">
            <label>Fullname</label></br>
            <input type="text" placeholder="" name="fullname" id="fullname"><br>
            <label>Username</label></br>
            <input type="text" placeholder="" name="username" id="username"><br>
            <label>Password</label><br>
            <input type="password" name="password" placeholder="" id="password"><br>
            <button name="submit">Login</button>


        </form>
    </div>
</div>

</body>
