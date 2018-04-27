<?php
/**
 * Created by PhpStorm.
 * User: jeanp
 * Date: 4/26/2018
 * Time: 10:42 PM
 */
if (isset($_SESSION['Role'])){
    if ($_SESSION['Role'] !== 'admin'){
        header ('Location: ../public/coachDashBoard.php');
    }
}else{
    header ('Location: ../public/');
}