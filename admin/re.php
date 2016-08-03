<?php
session_start();
require_once "../includes/ivote.php";
$vote = new Database();
$targetpage = "turnout.php";
include "../includes/pager.php";




?>

<div style="margin-top:0px;" class="sum-box">

    <?php
    $vote->query("SELECT id FROM disk ORDER by id desc LIMIT 1");
    $vote->execute();
    $row = $vote->single();
    ?>
    <span style="color: #232a2f;margin-left: 200px;font-size: 30px;">Total Vote Casted:</span>
    <h1 class="casted"style="font-size: 200px; color: #000000;margin-left: 200px;margin-top: -20px"><?php echo $row['id']?></h1>

</div>

<div style="margin-top:-400px;margin-left: 600px">

    <table style="width: 600px;" border="0" cellspacing="0" cellpadding="4" align="center">

        <tr style="color: #a30d23;font-size: 15px;">
            <td>No.</td>
            <td>Student Number</td>
            <td>Status</td>
            <td>Time</td>

            <?php


            $color = "1";

            $vote->query("SELECT id,username,status,time FROM disk ORDER BY id DESC LIMIT $start,$limit");
            $vote->execute();
            $return = $vote->return_search();

            foreach($return as $row){
                if($color == 1){

                    echo " <tr style='font-size: 12px' bgcolor='#F4F4F4'><td class='show'>$row[id]</td>
                <td class='show'>$row[username]</td>
                <td class='show'>$row[status]</td>
               <td ><span class='result1'>$row[time]</span></td>



                </td>";

                    $color= "2";
                }
                else{
                    echo " <tr style='font-size: 12px' bgcolor='#dddddd'><td class='show'>$row[id]</td>
                <td class='show'>$row[username]</td>
                <td class='show'>$row[status]</td>
               <td ><span class='result1'>$row[time]</span></td>
               </td>";
                    $color="1";
                }
            }
            echo $pagination;



            ?>



            <?php
            if(isset($username)){
                session_destroy();
                header("login.php");
            }
            ?>

        </tr>


    </table>
</div>