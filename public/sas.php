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
//$dvi = $_POST['dvi'];
$tri = $_POST['tri'];
$catur = $_POST['catur'];
$candidate = $_POST['ocandidate'];

if($page!='5'){
    header('Location:prez.php');
    return false;
}
$p=6;

if($candidate == '100'){
    $panc = 'No vote';
}

else{
    $vote->query("SELECT * FROM candiregister WHERE candidate_id = :id");
    $vote->bind(':id',$candidate);
    $vote->execute();
    $show = $vote->single();
    $panc = $show['name'];
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
        <div class="title">Click on submit votes</div>

        <div class="mini-container">
            <div class="mini-header">
                <p>Click  Submit Votes Button to submit your votes.....Thank you for using our services</p>
            </div>
            <div class="sum-box">
                <p style="margin-bottom: -10px">Vote Summary</p>
                <div style="padding: 5px">
                    <img src="../images/bullet.gif" width="15" height="13"/><span style="color: #000034;font-size: 14px" id="positions">President:</span><?php echo '<div style= "color: red;font-size: 14px;font-weight:bold" >'.$eka.'</div>'; ?>
                    <img src="../images/bullet.gif" width="15" height="13"/><span style="color: #000034;font-size: 14px" id="positions">General Secretary:</span><?php echo '<div style= "color: red;font-size: 14px;font-weight:bold" >'.$tri.'</div>'; ?>
                    <img src="../images/bullet.gif" width="15" height="13"/><span style="color: #000034;font-size: 14px" id="positions">Financial Secretary:</span><?php echo '<div style= "color: red;font-size: 14px;font-weight:bold" >'.$catur.'</div>'; ?>
                    <img src="../images/bullet.gif" width="15" height="13"/><span style="color: #000034;font-size: 14px" id="positions">Organising Secretary:</span><?php echo '<div style= "color: red;font-size: 14px;font-weight:bold" >'.$panc.'</div>'; ?>
                </div>
            </div>
            <div class="content">
                <form action="sapta.php" method="post" name="prezform">

                    <?php
                    $vote->query("SELECT * FROM candiregister WHERE name = :prez");
                    $vote->bind('prez',$eka);
                    $vote->execute();
                    $return = $vote->return_search();



                    $vote->query("SELECT * FROM candiregister WHERE name = :prez");
                    $vote->bind('prez',$tri);
                    $vote->execute();
                    $return2 = $vote->return_search();

                    $vote->query("SELECT * FROM candiregister WHERE name = :prez");
                    $vote->bind('prez',$catur);
                    $vote->execute();
                    $return3 = $vote->return_search();

                    $vote->query("SELECT * FROM candiregister WHERE name = :prez");
                    $vote->bind('prez',$panc);
                    $vote->execute();
                    $return4 = $vote->return_search();

                    echo"<table >";
                    echo "<tr>";
                    foreach($return as $row){

                        echo "<td>&nbsp;<span class='tname'>$row[post]</span></td>";
                    }


                    foreach($return2 as $row2){
                        echo "<td>&nbsp;<span class='tname'>$row2[post]</span></td>";
                    }
                    foreach($return3 as $row3){

                        echo "<td>&nbsp;<span class='tname'>$row3[post]</span></td>";
                    }
                    foreach($return4 as $row4){

                        echo "<td>&nbsp;<span class='tname'>$row4[post]</span></td>";
                    }
                        echo "</tr>";
                   echo "<tr>";
                    foreach($return as $row){

                        echo "<td width='150' rowspan='5'><img width=125 height=140 alt='Unable to View' src='$row[picture]'/></td>";
                    }

                    foreach($return2 as $row2){

                        echo "<td width='150' rowspan='5'><img width=125 height=140 alt='Unable to View' src='$row2[picture]'/></td>";
                    }
                    foreach($return3 as $row3){

                        echo "<td width='150' rowspan='5'><img width=125 height=140 alt='Unable to View' src='$row3[picture]'/></td>";
                    }
                    foreach($return4 as $row4){

                        echo "<td width='150' rowspan='5'><img width=125 height=140 alt='Unable to View' src='$row4[picture]'/></td>";
                    }
                        echo "</tr>";
                        echo "</table>";



                    echo " <div class='submit'>
        <button name='submit' value=''>Submit Votes</button>
    </div>";
                    echo "<input type='hidden' name='pagination' value='6'>";
                    echo "<input type='hidden' name='eka' value='$eka'>";
                    echo "<input type='hidden' name='tri' value='$tri'>";
                    echo "<input type='hidden' name='catur' value='$catur'>";
                    echo "<input type='hidden' name='panc' value='$panc'>";

                    ?>
                </form>
            </div>
            <div >
                <a  style="margin-top: 70px;position:absolute;margin-left: 520px;" href="">Go back</a>
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