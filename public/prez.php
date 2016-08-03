<?php

session_start();
require_once "../includes/ivote.php";
$vote = new Database();

include "../includes/header.php";

if(!$vote->get_student()){
    header("location:login.php");
}
$p=1;
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
<div class="title">President</div>

    <div class="container">
<div class="mini-container">
<div class="mini-header">
<p>Click  Vote Button to vote for the your favourite candidate or click skip to continue</p>
</div>
    <div class="sum-box">
<p>Vote Summary</p>
    </div>
    <div class="content">
    <form action="tri.php" method="post" name="prezform">

        <?php
        $vote->query("SELECT * FROM candiregister WHERE position = :prez");
        $vote->bind('prez','eka');
        $vote->execute();
        $return = $vote->return_search();
        echo"<table style='width: 500px;float: left;margin-top: 0px'> <tr>";

        foreach($return as $row){
       echo "<td><span class='tname'>$row[name]</span></td>";
        }
                echo"</tr>";
        echo" <tr>";

        foreach($return as $row1){

       echo"<td ><img width=125 height=140 alt='Unable to View' src='$row1[picture]'/></td>";
        }
echo"</tr>";
        echo "<tr>";
        foreach($return as $row2){

        echo "<td><button  class='vote' name='candidate' value='$row2[candidate_id]' id='vote-button'>Vote</button></td>";
        }
        echo "</tr>";
        echo "</table> ";

        echo " <div class='skip'>
        <button class='skip' name='candidate' value='100'>Skip</button>
    </div>";
        echo "<input type='hidden' name='pagination' value='1'>";
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