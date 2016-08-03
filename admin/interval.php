<div style="margin-top: -250px;margin-left: 150px">

    <table style="width: 600px;" border="0" cellspacing="0" cellpadding="4" align="center">

        <tr style="color: #a30d23;font-size: 15px;">
            <td>No.</td>
            <td>Student Number</td>
            <td>Status</td>
            <td>Time</td>

            <?php
            $color = "1";

            $vote->query("SELECT id,username,status,time FROM disk");
            $vote->execute();
            $return = $vote->return_search();

            foreach($return as $row){
                if($color == 1){

                    echo " <tr style='font-size: 15px' bgcolor='#F4F4F4'><td class='show'>$row[id]</td>
                <td class='show'>$row[username]</td>
                <td class='show'>$row[status]</td>
               <td ><span class='result1'>$row[time]</span></td>



                </td>";

                    $color= "2";
                }
                else{
                    echo " <tr style='font-size: 15px' bgcolor='#dddddd'><td class='show'>$row[id]</td>
                <td class='show'>$row[username]</td>
                <td class='show'>$row[status]</td>
               <td ><span class='result1'>$row[time]</span></td>
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


    </table>
</div>