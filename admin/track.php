<?php

session_start();
require_once "../includes/ivote.php";
$vote = new Database();

$targetpage = "track.php";
include "../includes/pager.php";



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

    <div style="margin-top: 0px;margin-left: 150px">
        <h1>Track Results</h1>
        <table style="width: 1300px;" border="0" cellspacing="0" cellpadding="5" align="center">

            <tr style="color: #a30d23;font-size: 15px;">
                <td>No.</td>
                <td>president</td>
                <td>gen sec</td>
                <td>financial sec</td>
                <td>organising sec</td>
                <td>username</td>
                <td>time</td>

                <?php
                $color = "1";

                $vote->query("SELECT *  FROM disk LIMIT $start,$limit");
                $vote->execute();
                $return = $vote->return_search();

                foreach($return as $row){
                    if($color == 1){

                        echo " <tr style='font-size: 15px' bgcolor='#F4F4F4'><td class='show'>$row[id]</td>
                <td class='show'>$row[eka]</td>
                <td class='show'>$row[tri]</td>
                <td class='show'>$row[catur]</td>
                <td class='show'>$row[panc]</td>
                <td class='show'>$row[username]</td>
                <td class='show'>$row[time]</td>



                </td>";

                        $color= "2";
                    }
                    else{
                        echo " <tr style='font-size: 15px' bgcolor='#dddddd'><td class='show'>$row[id]</td>
                 <td class='show'>$row[eka]</td>
                <td class='show'>$row[tri]</td>
                <td class='show'>$row[catur]</td>
                <td class='show'>$row[panc]</td>
                 <td class='show'>$row[username]</td>
                <td class='show'>$row[time]</td>

               </td>";
                        $color="1";
                    }
                }



                ?>

                <?php

                if(isset($username)){
                    session_destroy();
                    header("login.php");
                }
                ?>

            </tr>

            <?php echo $pagination;?>


        </table>
    </div>







</body>
</html>