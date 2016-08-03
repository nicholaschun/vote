<?php

session_start();
require_once "../includes/ivote.php";
$vote = new Database();

include "../includes/header.php";

if(!$vote->get_admin_session()){
    header("location:login.php");
}
$message = "";

define('MAX_FILE_SIZE',2114140);
$path = "";


$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
$max_file_size = 2114140;
$nw = $nh = 300; # image with # height

if(isset($_POST['submit'])){

    $name = $vote->mysql_prep($_POST['name']);
    $position = $vote->mysql_prep($_POST['position']);
    if($position == 'President'){
        $new = 'eka';
    }if($position == 'Vice President'){
        $new = 'dvi';
    }if($position == 'General Secretary'){
        $new = 'tri';
    }if($position == 'Financial Secretary'){
        $new = 'catur';
    }if($position == 'Organizing Secretary'){
        $new = 'panc';
    }if($position == 'Publicity Officer'){
        $new = 'sapta';
    }if($position == 'Women Commissioner'){
        $new = 'worm';
    }



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if ( isset($_FILES['passport']) ) {
    if (! $_FILES['passport']['error'] && $_FILES['passport']['size'] < $max_file_size) {
        $ext = strtolower(pathinfo($_FILES['passport']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $valid_exts)) {
            $path = '../images/'.$name . '.' .$ext;
            $size = getimagesize($_FILES['passport']['tmp_name']);

            $x = (int) $_POST['x'];
            $y = (int) $_POST['y'];
            $w = (int) $_POST['w'] ? $_POST['w'] : $size[0];
            $h = (int) $_POST['h'] ? $_POST['h'] : $size[1];

            $data = file_get_contents($_FILES['passport']['tmp_name']);
            $vImg = imagecreatefromstring($data);
            $dstImg = imagecreatetruecolor($nw, $nh);
            imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
            imagejpeg($dstImg, $path);
            imagedestroy($dstImg);
        }
    }
}
    $vote->query("SELECT name FROM candiregister WHERE name = :name");
    $vote->bind('name',$name);
    $vote->execute();
    $check = $vote->single();
    $num_rows = $vote->rowCount($check);

    if($num_rows > 0 ){
        $message = "Candidate already exits";

    }
    else{
        $vote->query("INSERT INTO candiregister (name,position,post,picture) VALUES (:candi_name,:position,:post,:picture)");
        $vote->bind('candi_name',$name);
        $vote->bind('position',$new);
        $vote->bind('post',$position);
        $vote->bind('picture',$path);
        if($vote->execute()){
            $message =  "Candidate added successfully";
        }
    }
}

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

    <div class="container">
        <div class="mini-container">
            <div class="mini-header">
                <p></p>
            </div>
            <div class="nav-bar">
                <ul>


                    <li><a href="insert_users.php">upload register </a></li>
                    <li><a href="insert_candi.php"> Insert candidates </a></li>
                    <li><a href="logout.php"> Logout </a></li>


                </ul>
            </div>

            <div class="insert">
                <div  style="color: #ba2926;font-weight: bold" class="message"><?php echo $message;?></div>
                <form action="insert_candi.php" method="post" enctype="multipart/form-data">
                    <label>
                        Candidate name
                    </label>
                    <input type="text" name="name" class="input-add" required="required" placeholder="Candidate name"><br>
                    <label>Select Position</label>
                    <select style="margin-left: 10px;" name="position" required="required" class="input-add">
                        <option value="">Select Position</option>
                        <option value="President">President</option>
                        <option value="Vice President"> Vice President</option>
                        <option value="General Secretary">General Secretary</option>
                        <option value="Financial Secretary">Financial Secretary</option>
                        <option value="Organizing Secretary">Organizing Secretary</option>
                        <option value="Publicity Officer">Publicity Officer</option>
                        <option value="Women Commissioner">Women Commissioner</option>
                    </select><br>
                    <label> <span>*</span> Upload Passport <span>(.jpg  .png  .gif only Max size is 2MB)</span></label> </br>

                    <input type="file" required="required" name="passport" id="passport" data-max-size="2114140mb" data-type="image"  onchange="ValidateFileUpload()"/>

                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />
                    <div class="error" id="pass_error"></div>
                    <button  type="submit" name="submit">Add Candidate</button>

                </form>
            </div>
        </div>
        <div class="user">
            <?php
            ?>
        </div>


    </div>
</div>
</body>
</html>