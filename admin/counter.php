<?php

session_start();
require_once "../includes/ivote.php";
$vote = new Database();


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <link type="text/css" href="../css/style.css" rel="stylesheet"/>
    <link type="text/css" href="../css/jquery.validate.css" rel="stylesheet"/>

    <script src="../js/jquery-latest.js"></script>
    <script src="../js/jquery.validate.js"></script>
    <script src="../js/validate-forms.js"></script>
    <script>


        $(document).ready(function() {
            $.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
            setInterval(function() {
                $('#refresh').load('');
            }, 5000); // the "3000" here refers to the time to refresh the div.  it is in milliseconds.
        });
    </script>



</head>
<body>

<div id="refresh" >
    <div style="margin:auto" class="sum-box">

        <?php
        $vote->query("SELECT id FROM disk ORDER by id desc LIMIT 1");
        $vote->execute();
        $row = $vote->single();
        ?>
        <span style="color: #232a2f;margin-left: 200px;font-size: 30px;">Total Vote Casted:</span>
        <h1 class="casted"style="font-size: 400px; color: #000000;margin-left: 200px;margin-top: -20px"><?php echo $row['id']?></h1>

    </div>

                <?php
                if(isset($username)){
                    session_destroy();
                    header("login.php");
                }
                ?>

            </tr>


        </table>
    </div>
</div>






</body>
</html>