<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/13/2018
 * Time: 5:44 PM
 */
include '../includes/_headers.php'
?>

<div id="wrapper" xmlns: xmlns:>

    <!-- Navigation -->
    <?php include '../includes/_navbar.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tracks</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">

                    <?php
                    //here we check that the required values have been set in the post
                    $form = checkFormParams(array("trackTitle", "shortTitle", "trackDes"));
                    if($form["cnt"] == 3){
                          //inserts values to the TRACK table
                            insertFields("track",
                                array("Title" => $form["trackTitle"],
                                    "ShortTitle" => $form["shortTitle"],
                                    "Description" => $form["trackDes"]

                                )
                            );
                            $error = "success";
                    }
                     else {
                        $error = "";
                    }
                    ?>


                    <div class="panel-heading">
                        Add a New Track
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" id="trackRegistration">
                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="form-group">
                                        <label>Track Title</label>
                                        <input class="form-control" id="trackTitle" name="trackTitle" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Short Title</label>
                                        <input class="form-control" id="shortTitle" name="shortTitle" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input class="form-control" id="trackDescrip" name="trackDes" type="text" required>
                                    </div>



                                </div>

                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                <button type="reset" class="btn btn-warning btn-block">Reset</button>
                            </div>
                        </form>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>

<?php
include '../includes/_footer.php'
?>


