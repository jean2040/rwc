<?php
/**
 * Created by PhpStorm.
 * User: jeanp
 * Date: 4/22/2018
 * Time: 8:21 PM
 * This file will logout the user and redirect to index.php
 */

            session_start(); // initialize session
            session_destroy(); // destroy session
            setcookie("PHPSESSID","",time()-3600,"/"); // delete session cookie
            header ('Location: ../public/index.php');
