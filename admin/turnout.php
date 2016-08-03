<?php

session_start();
require_once "../includes/ivote.php";
$vote = new Database();
$targetpage = "turnout.php";
include "../includes/pager.php";


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <link type="text/css" href="../css/style.css" rel="stylesheet"/>

    <script src="../js/jquery-latest.js"></script>
    <script type="text/javascript">

        $(function() {

            getStatus();

        });
        function getStatus() {

            $('div#refresh').load('re.php');
            setTimeout("getStatus()",5000);
        }

    </script>




</head>
<body>
<div id="refresh"></div>







</body>
</html>


