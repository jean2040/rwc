<?php
include '../includes/_headers.php';
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/22/2018
 * Time: 7:39 PM
 */
if (isset($_POST["action"]) && isset($_POST["id"])){
    $track = getById('track','TrackID',$_POST["id"]);
    $section = getById('section','SectionID',$track["SectionID"]);
    echo $track['Title'];
    echo "Here we are";
}

//here we check that the required values have been set in the post
$form = checkFormParams(array("trackTitle", "shortTitle", "trackDes"));
if($form["cnt"] == 3){
    //inserts values to the TRACK table
    //updateById('track','TrackID',$_POST[""])

    $error = "success";
}
else {
    $error = "";
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
                        <a href="../public/trackreport.php">
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
                    Track Information
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#general" data-toggle="tab" aria-expanded="false">General</a>
                        </li>
                        <li class=""><a href="#coaches" data-toggle="tab" aria-expanded="false">Coaches</a>
                        </li>
                        <li class=""><a href="#students" data-toggle="tab" aria-expanded="true">Students</a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="general">
                            <h4><?php echo $track['Title']; ?></h4>
                            <form role="form" method="post">
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
                                <div class="form-group">
                                    <label>Section</label>
                                    <input class="form-control" id="trackTitle" name="trackTitle" required value="<?php echo $section['SectionName']; ?>">
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    <button type="reset" class="btn btn-warning btn-block">Reset</button>
                                </div>

                            </form>
                        </div>
                        <div class="tab-pane fade" id="coaches">
                            <h4>Track Coaches</h4>
                            <p>Add coaches here</p>
                        </div>
                        <div class="tab-pane fade" id="students">
                            <h4>Students</h4>
                            <p> List of students, add students</p>
                        </div>

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
include '../includes/_footer.php'
?>



