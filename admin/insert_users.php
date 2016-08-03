<?php


session_start();
require_once "../includes/ivote.php";
$vote = new Database();

include "../includes/header.php";
include '../includes/PHPExcel/IOFactory.php';

if(!$vote->get_admin_session()){
    header("location:login.php");
}

$message = '';
$uploadedStatus = 0;

if ( isset($_POST["submit"]) ) {
    if ( isset($_FILES["file"])) {
//if there was an error uploading the file
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
        else {
            if (file_exists($_FILES["file"]["name"])) {
                unlink($_FILES["file"]["name"]);
            }
            $storagename = "voter register/register.xlsx";
            move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
            $uploadedStatus = 1;
        }
    } else {
        echo "No file selected <br />";
    }



$storagename  = "voter register/register.xlsx";
try {
    $objPHPExcel = PHPExcel_IOFactory::load($storagename);
}
catch(Exception $e) {
    die('Error loading file "'.pathinfo($storagename,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


for($i=3;$i<=$arrayCount;$i++){
$fullname = trim($allDataInSheet[$i]["A"]);
$index_number = trim($allDataInSheet[$i]["B"]);
$password = trim($allDataInSheet[$i]["C"]);

    $vote->query("SELECT fullname FROM vregister WHERE fullname = :name");
    $vote->bind('name',$fullname);
    $vote->execute();
    $check = $vote->single();
    $num_rows = $vote->rowCount($check);

    if($num_rows > 0 ){
        $message = "Voter Register  already exits";
    }

    else{

    $vote->query("INSERT INTO vregister (fullname,username,password) VALUES (:fullname,:index_number,:password)");
    $vote->bind('fullname',$fullname);
    $vote->bind('index_number',$index_number);
    $vote->bind('password',$password);
    if($vote->execute()){
        $message = 'voter register created successfully';
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


                    <li><a href="insert_users.php"> upload register </a></li>
                    <li><a href="insert_candi.php"> Insert candidates </a></li>
                    <li><a href="logout.php"> Logout </a></li>


                </ul>
            </div>

            <div class="insert">
                <div  style="color: #ba2926;font-weight: bold" class="message"><?php echo $message;?></div>
                <form action="insert_users.php" method="post" enctype="multipart/form-data">

                    <label> <span>*</span> Upload Excel file </label> </br>
                    <input type="file" required="required" name="file" id="passport" data-max-size="2114140mb" data-type="image"  onchange="ValidateFileUpload()"/><br>
                    <button  type="submit" name="submit">Upload Register</button>

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