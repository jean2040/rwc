<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 4/20/2018
 * Time: 9:26 PM
 * This is the user Login page.
 * It will recieve username and pasword and use AJAX to validate the data.
 */
include '../includes/_headers.php'
?>

    <div class="container">



            <div class="jumbotron" style="margin-top: 5%">
                 <img src="../includes/img/rwc_logo.PNG" alt="rwc logo" class="img-responsive center-block">

                <div class="text-center">
                <p style="margin-top: .5em">This portal is meant for coaches and admin staff from RWC.</p>
                
                <p><a href="login.php" class="btn btn-primary btn-lg" role="button">Sign In</a></p></div>
           </div>

            <div class="text-center">
            <p style="margin-top: .5em">Do you need to register as a coach?</p><a href="coachreg.php">Click Here</a>


    </div>


<?php
include '../includes/_footer_tables.php'
?>