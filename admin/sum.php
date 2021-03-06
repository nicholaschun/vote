<?php

session_start();
require_once "../includes/ivote.php";
$vote = new Database();

include "../includes/header.php";

if(!$vote->get_admin_session()){
    header("location:login.php");
}


$vote->query("SELECT id FROM disk ORDER by id desc LIMIT 1");
$vote->execute();
$tc= $vote->single();
$total_count = $tc['id'];



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
        <div style="background: #ffffff" class="mini-container">
            <div class="mini-header">
                <p style="color: #ffffff;margin-left: 300px;">STATEMENTS OF RESULTS FOR RELIGIOUS STUDIES ASSOCIATION FOR THE 2015/2016 ACADEMIC YEAR</p>
            </div>

            <div class="content" style="margin-left: 10px">



                <table>
                    <tr><td><h1 style="margin-top:350px; margin-left:400px; color: #6592c8;width: 500px;"> President </h1></td></tr>

                    <?php


                    $vote->query("SELECT eka, count(*) FROM disk GROUP  BY eka ");
                    $vote->execute();
                    $eka = $vote->return_search();

                    $vote->query("SELECT eka, count(*) FROM disk WHERE eka = 'No vote'");
                    $vote->execute();
                    $no_vote = $vote->single();
                    $no_vote = $no_vote['count(*)'];

                    echo "<tr>";
                    foreach($eka as $row2){
                        $raw = $row2['count(*)'];
                        $ps =  ($raw / $total_count)*100;
                        $name = $row2['eka'];


                        //echo "<td><span style='color:darkred;font-weight: bold'>$raw</span></td>";
                        $vote->query("UPDATE candiregister SET total_votes ='$raw',percentage = '$ps' WHERE name = '$name'");
                        $vote->execute();

                    }



                    $vote->query("SELECT * FROM candiregister WHERE position = :prez");
                    $vote->bind('prez','eka');
                    $vote->execute();
                    $return = $vote->return_search();
                    echo"<table style='width: 900px;margin-left:10px;margin-top: -10px'> <tr>";

                    foreach($return as $row){
                        echo "<td><span class='tname'>$row[name]</span></td>";
                    }
                    echo"</tr>";
                    echo" <tr>";

                    foreach($return as $row1){

                        echo"<td ><img width=125 height=140 alt='Unable to View' src='$row1[picture]'/></td>";
                    }
                    echo"</tr>";

                    echo" <tr>";

                    foreach($return as $row1){
                        echo "<td>Total votes = <span class='tname'>$row1[total_votes]</span></td>";


                    }
                    echo"</tr>";

                    echo" <tr>";

                    foreach($return as $row1){
                        echo "<td>percentage = <span class='tname'>$row1[percentage]%</span></td>";


                    }
                    echo"</tr>";

                    echo "<tr>";


                    echo "<td><h3>No. of Votes Skiped = $no_vote </h3></td>";

                    echo "</tr>";




                    ?>
                </table>
                    <hr>




                <tr><td><h1 style="margin-top:50px; margin-left:400px; color: #6592c8; width: 500px;">General Secretary </h1></td></tr>

                <?php


                $vote->query("SELECT tri, count(*) FROM disk GROUP  BY tri ");
                $vote->execute();
                $eka = $vote->return_search();

                $vote->query("SELECT tri, count(*) FROM disk WHERE tri = 'No vote'");
                $vote->execute();
                $no_vote = $vote->single();
                $no_vote = $no_vote['count(*)'];

                echo "<tr>";
                foreach($eka as $row2){
                    $raw = $row2['count(*)'];
                    $ps =  ($raw / $total_count)*100;
                    $name = $row2['tri'];


                    //echo "<td><span style='color:darkred;font-weight: bold'>$raw</span></td>";
                    $vote->query("UPDATE candiregister SET total_votes ='$raw',percentage = '$ps' WHERE name = '$name'");
                    $vote->execute();

                }

                $vote->query("SELECT * FROM candiregister WHERE position = :prez");
                $vote->bind('prez','tri');
                $vote->execute();
                $return = $vote->return_search();
                echo"<table style='width: 900px;margin-left:10px;margin-top: -10px'> <tr>";

                foreach($return as $row){
                    echo "<td><span class='tname'>$row[name]</span></td>";
                }
                echo"</tr>";
                echo" <tr>";

                foreach($return as $row1){

                    echo"<td ><img width=125 height=140 alt='Unable to View' src='$row1[picture]'/></td>";
                }
                echo"</tr>";

                echo" <tr>";

                foreach($return as $row1){
                    echo "<td>Total votes = <span class='tname'>$row1[total_votes]</span></td>";


                }
                echo"</tr>";

                echo" <tr>";

                foreach($return as $row1){
                    echo "<td>percentage = <span class='tname'>$row1[percentage]%</span></td>";


                }
                echo"</tr>";

                echo "<tr>";


                echo "<td><h3>No. of Votes Skipped = $no_vote </h3></td>";

                echo "</tr>";



                echo "</table> ";

                ?>
                <hr>


                <tr><td><h1 style="margin-top:50px; margin-left:400px; color: #6592c8; width: 500px;">Financial  Secretary </h1></td></tr>

                <?php


                $vote->query("SELECT catur, count(*) FROM disk GROUP  BY catur ");
                $vote->execute();
                $eka = $vote->return_search();

                $vote->query("SELECT catur, count(*) FROM disk WHERE catur = 'No vote'");
                $vote->execute();
                $no_vote = $vote->single();
                $no_vote = $no_vote['count(*)'];

                echo "<tr>";
                foreach($eka as $row2){
                    $raw = $row2['count(*)'];
                    $ps =  ($raw / $total_count)*100;
                    $name = $row2['catur'];


                    //echo "<td><span style='color:darkred;font-weight: bold'>$raw</span></td>";
                    $vote->query("UPDATE candiregister SET total_votes ='$raw',percentage = '$ps' WHERE name = '$name'");
                    $vote->execute();

                }

                $vote->query("SELECT * FROM candiregister WHERE position = :prez");
                $vote->bind('prez','catur');
                $vote->execute();
                $return = $vote->return_search();
                echo"<table style='width: 900px;margin-left:10px;margin-top: -10px'> <tr>";

                foreach($return as $row){
                    echo "<td><span class='tname'>$row[name]</span></td>";
                }
                echo"</tr>";
                echo" <tr>";

                foreach($return as $row1){

                    echo"<td ><img width=125 height=140 alt='Unable to View' src='$row1[picture]'/></td>";
                }
                echo"</tr>";

                echo" <tr>";

                foreach($return as $row1){
                    echo "<td>Total votes = <span class='tname'>$row1[total_votes]</span></td>";


                }
                echo"</tr>";

                echo" <tr>";

                foreach($return as $row1){
                    echo "<td>percentage = <span class='tname'>$row1[percentage]%</span></td>";


                }
                echo"</tr>";

                echo "<tr>";


                echo "<td><h3>No. of Votes Skiped = $no_vote </h3></td>";

                echo "</tr>";



                echo "</table> ";

                ?>
                <hr>

                <tr><td><h1 style="margin-top:50px; margin-left:400px; color: #6592c8;width: 500px;">Organizing Secretary </h1></td></tr>

                <?php


                $vote->query("SELECT panc, count(*) FROM disk GROUP  BY panc ");
                $vote->execute();
                $eka = $vote->return_search();

                $vote->query("SELECT panc, count(*) FROM disk WHERE panc = 'No vote'");
                $vote->execute();
                $no_vote = $vote->single();
                $no_vote = $no_vote['count(*)'];

                echo "<tr>";
                foreach($eka as $row2){
                    $raw = $row2['count(*)'];
                    $ps =  ($raw / $total_count)*100;
                    $name = $row2['panc'];


                    //echo "<td><span style='color:darkred;font-weight: bold'>$raw</span></td>";
                    $vote->query("UPDATE candiregister SET total_votes ='$raw',percentage = '$ps' WHERE name = '$name'");
                    $vote->execute();

                }

                $vote->query("SELECT * FROM candiregister WHERE position = :prez");
                $vote->bind('prez','panc');
                $vote->execute();
                $return = $vote->return_search();
                echo"<table style='width: 900px;margin-left:10px;margin-top: -10px'> <tr>";

                foreach($return as $row){
                    echo "<td><span class='tname'>$row[name]</span></td>";
                }
                echo"</tr>";
                echo" <tr>";

                foreach($return as $row1){

                    echo"<td ><img width=125 height=140 alt='Unable to View' src='$row1[picture]'/></td>";
                }
                echo"</tr>";

                echo" <tr>";

                foreach($return as $row1){
                    echo "<td>Total votes = <span class='tname'>$row1[total_votes]</span></td>";


                }
                echo"</tr>";

                echo" <tr>";

                foreach($return as $row1){
                    echo "<td>percentage = <span class='tname'>$row1[percentage]%</span></td>";


                }
                echo"</tr>";

                echo "<tr>";


                echo "<td><h3>No. of Votes Skiped = $no_vote </h3></td>";

                echo "</tr>";



                echo "</table> ";

                ?>
                <hr>





                <?php

                echo "<td><h3>Total Votes= $total_count </h3></td>";
                echo "<div id='print'><button onclick=print()>Print & Save</button></div>
"


                ?>

            </div>


        </div>
    </div>
</div>


</body>


</body>
</html>