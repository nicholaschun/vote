<?php

session_start();
require_once "../includes/ivote.php";
$vote = new Database();

include "../includes/header.php";

if(!$vote->get_student()){
    header("location:login.php");
}
$username = $vote->stud();
$page = $_POST['pagination'];
$eka = $_POST['eka'];
$tri = $_POST['tri'];
$catur = $_POST['catur'];
$panc = $_POST['panc'];

if($page!='6'){
    header('Location:prez.php');
    return false;
}


else{
    $vote->query("INSERT INTO disk (id,eka,tri,catur,panc,username,status,time) VALUES ('',:eka,:tri,:catur,:panc,:username,:status,NOW())");
    $vote->bind(':eka',$eka);
    $vote->bind(':tri',$tri);
    $vote->bind(':catur',$catur);
    $vote->bind(':panc',$panc);
    $vote->bind(':username',$username);
    $vote->bind(':status','voted');
    $execute = $vote->execute();
if($execute){
    $vote->query("UPDATE vregister SET status = 'voted' WHERE  username = :username");
    $vote->bind(':username',$username);
    $vote->execute();

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
<body>

<div id="container">
    <div class="title"></div>

    <div class="container">
        <div class="mini-container">
            <div class="mini-header">
                </div>

               <?php
               if(isset($username)){
               session_destroy();
               header("refresh:3; url=login.php");
               }
               ?>

            <div align="center">
                <div class="confirm"><p>Your vote is successful</p>
                </div>
                <div><img src="../images/box.png" width="128" height="128"/></div>
                <div class="app">Thanks for using our service</div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>
