<?php

include "includes/header.php";

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <link type="text/css" href="css/style.css" rel="stylesheet"/>

    <script>
        function launch(){
            popupWin = window.open('public/login.php','ivote','menubar=0,location=no,status=0,scrollbars=1,width=1000,height=900');
            window.open('','_self');
            window.close();
            }  function pilot(){
            popupWin = window.open('admin/login.php','ivote','menubar=0,location=no,status=0,scrollbars=1,width=1000,height=900');
            window.open('','_self');
            window.close();
            }
    </script>
</head>
<body style="background: url(background.jpg) no-repeat">

<div id="launch">
        <a class="pilot" href="javascript:pilot()">Pilot</a>
        <a class="launch" href="javascript:launch()">Launch Application</a>


</div>

</body>
