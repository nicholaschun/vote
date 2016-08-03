<?php


require_once "ivote.php";
$vote = new Database();


$adjacents = 2;
$total = $vote->count_id();
$limit = 500;
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

if($page){
    $start = ($page -1) * $limit;
}
else{
    $start = 0;
}

if($page == 0){
    $page = 1;
}

$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total/$limit);
$lpm1 = $lastpage - 1;
$pagination = "";


if($lastpage >1){
    $pagination .="<div class='pagination'>";
    if($page > 1){
        $pagination .="<a href='$targetpage?page=$prev'>Prev</a>";
    }
    else{
        $pagination .="<span class='disable'>Prev</span>";
    }

    if ($lastpage < 1 + ($adjacents * 2)){

        for ($counter = 1; $counter <= $lastpage; $counter++){

            if ($counter == $page){
                $pagination.= "<span class='current'>$counter</span>";
            }
            else{
                $pagination.= "<a href='$targetpage?page=$counter'>$counter</a>";
            }
        }
    }

    elseif($lastpage > 5 + ($adjacents * 2))
    {
        if($page < 1 + ($adjacents * 2))
        {
            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
            {
                if ($counter == $page){
                    $pagination.= "<span class='current'>$counter</span>";
                }
                else{
                    $pagination.= "<a href='$targetpage?page=$counter'>$counter</a>";
                }
            }
            $pagination.= "...";
            $pagination.= "<a href='$targetpage?page=$lpm1'>$lpm1</a>";
            $pagination.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
        }

        elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
        {
            $pagination.= "<a href='$targetpage?page=1'>1</a>";
            $pagination.= "<a href='$targetpage?page=2'>2</a>";
            $pagination.= "...";
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class='current'>$counter</span>";
                else
                    $pagination.= "<a href='$targetpage?page=$counter'>$counter</a>";
            }
            $pagination.= "...";
            $pagination.= "<a href='$targetpage?page=$lpm1'>$lpm1</a>";
            $pagination.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
        }

        else
        {
            $pagination.= "<a href='$targetpage?page=1'>1</a>";
            $pagination.= "<a href='$targetpage?page=2'>2</a>";
            $pagination.= "...";
            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class='current'>$counter</span>";
                else
                    $pagination.= "<a href='$targetpage?page=$counter'>$counter</a>";
            }
        }

    }

    if ($page < $counter - 1){
        $pagination.= "<a href='$targetpage?page=$next'>Next</a>";
    }
    else{
        $pagination.= "<span class='disabled'>Prev</span>";
        $pagination.= "</div>\n";


    }


}
?>