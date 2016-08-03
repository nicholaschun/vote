<?php

session_start();
require_once "../includes/ivote.php";
$vote = new Database();

include "../includes/header.php";

if(!$vote->get_student()){
    header("location:login.php");
}
$page = $_POST['pagination'];
$eka = $_POST['eka'];
$candidate = $_POST['scandidate'];

if($page!='3'){
    header('Location:prez.php');
    return false;
}
$p=4;

if($candidate == '100'){
    $tri = 'No vote';
}

else{
    $vote->query("SELECT * FROM candiregister WHERE candidate_id = :id");
    $vote->bind(':id',$candidate);
    $vote->execute();
    $show = $vote->single();
    $tri = $show['name'];
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
    <div class="title">Financial Secretary</div>

    <div class="container">
        <div class="mini-container">
            <div class="mini-header">
                <p>Click  Vote Button to vote for the your favourite candidate or click skip to continue</p>
            </div>
            <div class="sum-box">
                <p style="margin-bottom: -10px">Vote Summary</p>
                <div style="padding: 5px">
                    <img src="../images/bullet.gif" width="15" height="13"/><span style="color: #000034;font-size: 14px" id="positions">President:</span><?php echo '<div style= "color: red;font-size: 14px;font-weight:bold" >'.$eka.'</div>'; ?>
                    <img src="../images/bullet.gif" width="15" height="13"/><span style="color: #000034;font-size: 14px" id="positions">General Secretary:</span><?php echo '<div style= "color: red;font-size: 14px;font-weight:bold" >'.$tri.'</div>'; ?>
                </div>
            </div>
            <div class="content">
                <form action="panc.php" method="post" name="prezform">

                    <?php
                    $vote->query("SELECT * FROM candiregister WHERE position = :prez");
                    $vote->bind('prez','catur');
                    $vote->execute();
                    $return = $vote->return_search();
                    echo"<table style='width: 500px;float: left;margin-top: 0px'> <tr>";

                    foreach($return as $row){
                        echo "<td ><span class='tname'>$row[name]</span></td>";
                    }
                    echo"</tr>";
                    echo" <tr>";

                    foreach($return as $row1){

                        echo"<td ><img width=125 height=140 alt='Unable to View' src='$row1[picture]'/></td>";
                    }
                    echo"</tr>";
                    echo "<tr>";
                    foreach($return as $row2){

                        echo "<td><button class='vote' name='tcandidate' value='$row2[candidate_id]' id='vote-button'>Vote</button></td>";
                    }
                    echo "</tr>";
                    echo "</table> ";

                    echo " <div class='skip'>
        <button class='skip' name='tcandidate' value='100'>Skip</button>
    </div>";
                    echo "<input type='hidden' name='pagination' value='4'>";
                    echo "<input type='hidden' name='eka' value='$eka'>";
                    //echo "<input type='hidden' name='dvi' value='$dvi'>";
                    echo "<input type='hidden' name='tri' value='$tri'>";

                    ?>
                </form>
            </div>
        </div>
        <div class="user">
            <?php
            echo "<p> Logged in as"." ".$vote->stud()."</p>"
            ?>
        </div>


    </div>
</div>
</body>
</html>