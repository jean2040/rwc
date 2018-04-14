<?php
include '../includes/_headers.php';
include '../php/dbUpdate.php';
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/22/2018
 * Time: 7:39 PM
 * Description: This page will show section Details and allow an Admin to Add Tracks to the Section
 */
//here we check that the required values have been set in the post
$form = checkFormParams(array("sName", "sStart", "sEnd"));

if($form["cnt"] == 3){
    //inserts values to the Section table
    updateById('section','SectionID',$_POST["id"],
        array("SectionName" => $form["sName"],
            "StartDate" => $form["sStart"],
            "EndDate" => $form["sEnd"],
            "Location" => $_POST["sLocation"]
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

    $section = getById('section','SectionID',$_POST["id"]);
    $tracks = getById('trackhassection','SectionID',$_POST["id"]);
    $my_tracks = getAll2(array('track.*','trackhassection.TrackSectionID'), 'track','trackhassection','TrackID',array('trackhassection.SectionID' => $t_id),null,null);

}

?>


<div id="wrapper" xmlns: xmlns:>

    <!-- Navigation -->
    <?php include '../includes/_navbar.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-road fa-fw">Sections</i>
                    <i class="pull-right">
                        <a href="../public/sectionreport.php">
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
                    Section Information
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#general" data-toggle="tab" aria-expanded="false">General</a>
                        </li>
                        <li class=""><a href="#coaches" data-toggle="tab" aria-expanded="false">Tracks</a>
                        </li>


                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="general">
                            <h4><?php echo $section['SectionName']; ?></h4>
                            <form role="form" method="post">
                                <input aria-hidden="true" hidden id="sID" name="id" value="<?php echo $t_id; ?>">
                                <div class="form-group">
                                    <label for="trackTitle">Track Title</label>
                                    <input class="form-control" id="sName" name="sName" required value="<?php echo $section['SectionName']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="sStart">Start Date</label>
                                    <input class="form-control" id="sStart" name="sStart" type="date" required value="<?php echo $section['StartDate']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="sEnd">End Date</label>
                                    <input class="form-control" id="sEnd" name="sEnd" type="date" required value="<?php echo $section['EndDate']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="sLocation">Location</label>
                                    <input class="form-control" id="sLocation" name="sLocation" required value="<?php echo $section['Location']; ?>">
                                </div>



                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    <button type="reset" class="btn btn-warning btn-block">Reset</button>
                                </div>

                            </form>
                        </div>
                        <div class="tab-pane fade" id="coaches">

                                <h4>Section Tracks</h4>

                            <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#trackModal">Add Track </button>
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table  id="tracks_queue" width="100%" class="display table table-striped table-bordered table-hover">

                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    while ($track = $my_tracks->fetch_assoc()) {
                                        ?>

                                        <tr>
                                            <td><?php echo $track['TrackSectionID'] ?></td>
                                            <td class="sorting_1"><?php echo $track['Title'] ?></td>
                                            <td><?php echo $track['Description'] ?></td>
                                            <td> <form method="post" action="track_section_edit.php">
                                                    <input type="submit" class="btn btn-warning" name="action" value="Edit">
                                                    <input type="hidden" name="id" value="<?php echo $track['TrackSectionID']; ?>"/>

                                                </form></td>

                                        </tr>

                                        <?php
                                    }
                                    ?>


                                    </tbody>
                                </table>
                            </div>


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
include '../includes/_footer_tables.php';
include 'addTrackModal.php';
include 'addStudentModal.php';
?>

</body>

</html>


