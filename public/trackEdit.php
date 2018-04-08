<?php
include '../includes/_headers.php';
include '../php/dbUpdate.php';
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/22/2018
 * Time: 7:39 PM
 * $_POST["action"]) &&
 */
//here we check that the required values have been set in the post
$form = checkFormParams(array("trackTitle", "shortTitle", "trackDes"));

if($form["cnt"] == 3){
    //inserts values to the TRACK table
    updateById('track','TrackID',$_POST["id"],
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
//Check for ID and load the form with latest data.
if (isset($_POST["id"])){
    $t_id = $_POST["id"];
    $track = getById('track','TrackID',$_POST["id"]);

}


?>


<div id="wrapper" xmlns: xmlns:>

    <!-- Navigation -->
    <?php include '../includes/_navbar.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-road fa-fw">Tracks</i>
                    <i class="pull-right">
                        <a href="trackreport.php">
                            <button type="button" class="btn btn-default btn-circle btn-md">
                                <i class="fa fa-times">
                                </i>
                            </button>
                        </a>
                    </i>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <h4>You are Editing Track: <?php echo $track['Title']; ?></h4>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" id="trackUpdate">
                            <input aria-hidden="true" hidden name="id" value="<?php echo $t_id; ?>">
                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="form-group">
                                        <label>Track Title</label>
                                        <input class="form-control" id="trackTitle" name="trackTitle" required value="<?php echo $track['Title']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Short Title</label>
                                        <input class="form-control" id="shortTitle" name="shortTitle" type="text" value="<?php echo $track['ShortTitle']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input class="form-control" id="trackDescrip" name="trackDes" type="text" required value="<?php echo $track['Description']; ?>">
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
include '../includes/_footer_tables.php';

?>

</body>

</html>


