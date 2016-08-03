<?php

require_once "../includes/ivote.php";
$vote = new Database();


$message="";
$row="";

if(isset($_POST['submit'])){
    $user= trim($vote->mysql_prep($_POST['username']));

    $vote->query("SELECT * FROM vregister WHERE username = :user");
    $vote->bind(':user',$user);
    $vote->execute();
    $check = $vote->single();
    $session = $check['session'];
    $voted = $check['status'];
    $name = $check['fullname'];
    $username = $check['username'];
    //$exists = $vote->rowCount($check);
    if($session == 'set' && $voted ==''){
        $message = $name.' '. 'currently in session.Please reset password';
    }

    elseif($session == 'set' && $voted =='voted'){
        $message = $name.' '.'you have already voted';
    }

    elseif($session == '' && $voted ==''){
        $message = $name .' '.'Has not yet voted';
    }


    else{
        $message = "An error occured try again";
    }

}


if(isset($_POST['reset'])){
    $user = trim(($vote->mysql_prep($_POST['reset'])));
    //$password = $vote->generate_password();

    $vote->query("UPDATE vregister SET status = '' WHERE username = :username ");
    $vote->bind(':username',$user);
    if($vote->execute()){

        $message = "Reset successfully";
    }
    else{
        $message = "An error occured";
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

</div>

<div id="login-container" style="height: 300px">
    <div class="form-head">
        <h2> Students Voting Portal</h2>
    </div>

    <span>*Please Provide Index Number below and hit Enter </span>
    <div class="error-box">
        <div class="warning" name="genError">*Please Provide Index Number below and hit Enter </div>

    </div>

    <div style="color: #db2b28;font-weight: bold;padding: 5;font-size:20px;margin-left: 70px" class="message">
        <?php echo $message;?>
    </div>
    <div class="form">


        <form action="reset.php" method="post" id="voting-portal">
            <label>Enter Index Number</label></br>
            <input type="text" placeholder="" name="username" id="username" required="required">
            <button style="width: 30px" name="submit">Go</button><br>
            <button name="reset">Reset Password</button>


        </form>
    </div>
</div>

</body>
