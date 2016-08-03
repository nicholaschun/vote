<?php

session_start();
require "includes/ivote.php";
$vote = new Database();



$end = 211;
for($i=0; $i<$end;$i++){
 $result = $vote->generate_password();
    echo $result ."<br>";
}

?>


