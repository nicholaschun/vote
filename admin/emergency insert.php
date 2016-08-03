<?php

require_once "../includes/ivote.php";
$vote = new Database();
$message = "";


if(isset($_POST['add'])){
    $name = $_POST['name'];
    $index_number = $_POST['index_number'];
    $password = $_POST['pass'];

    $vote->query("INSERT INTO vregister (fullname,username,password) VALUES (:fullname,:username,:password)");
    $vote->bind("fullname",$name);
    $vote->bind("username",$index_number);
    $vote->bind("password",$password);
    if($vote->execute()){
        $message = "Data added successfully";
    }





}

?>

<form action="emergency%20insert.php" name="add" method="post">
    <div><?php echo $message;?></div>
    <label>Fullname:</label>
    <input type="text" name="name" required><br>
    <label>Index Number</label>
    <input type="text" name="index_number" required><br>
    <label>Password</label>
    <input type="text" name="pass" required><br>
    <button name="add" type="submit">Add</button>

</form>


