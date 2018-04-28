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

include '../php/sessionCheck.php';
//here we check that the required values have been set in the post
$form = checkFormParams(array("trackTitle", "shortTitle", "trackDes"));

if($form["cnt"] == 3){
    //inserts values to the TRACK table
    updateById('track',array('TrackID'=>$_POST["id"]),
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

//if we post the form delete
if (isset($_POST['delete'])){
    updateById('track',array('TrackID'=>$_POST["delete"]),
        array(
            "DeleteFlag" => 'Y'

        )
    );
    header("Location: trackreport.php");

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
                    <i class="fa fa-road fa-fw">Track</i>
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
            <div class="panel panel-primary">
                <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">You are Editing Track: <?php echo $track['Title']; ?></h4>
                        <form class="pull-right" action="" method="post" role="form">
                            <input aria-hidden="true" hidden name="delete" value="<?php echo $t_id; ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
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
                                <button type="submit" class="btn btn-primary btn-block">Update</button>

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


