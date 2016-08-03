<?php

session_start();
require_once "../includes/ivote.php";
$vote = new Database();

include "../includes/header.php";

if(!$vote->get_admin_session()){
    header("location:login.php");
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

    <div class="container">
        <div class="mini-container">
            <div class="mini-header">
                <p></p>
            </div>
            <div class="nav-bar">
                <ul>


                    <li><a href="insert_users.php"> upload register</a></li>
                    <li><a href="insert_candi.php"> Insert candidates </a></li>
                    <li><a href="logout.php"> Logout </a></li>


                </ul>
            </div>
        </div>
        <div class="user">
            <?php
            ?>
        </div>


    </div>
</div>
</body>
</html>