<?php
require_once "../includes/ivote.php";
$vote = new Database();




$disk= "CREATE TABLE  disk(
                      id int primary key auto_increment,
                      eka varchar(30),
                      dvi varchar (30),
                      tri varchar (30),
                      catur varchar (30),
                      panc varchar (30),
                      username varchar (30),
                      status varchar (30),
                      time timestamp()
                      )";

$query=$vote->query($passport);
if($query===TRUE){
    echo "<h4>passport table created ok </h4>";
}

else{
    echo "<h4>passport table not created </h4>";
}
?>