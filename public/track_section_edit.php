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


    //$section = getById('section','SectionID',$_POST["id"]);
    $my_track = getByIdJoin('trackhassection','track','TrackID','TrackSectionID',$t_id);
    $my_students = getAll2(array('students.*','studenttaketrack.StudentId'), 'students','studenttaketrack','StudentID',array('studenttaketrack.TrackID' => $t_id),null,null);
    $coaches = getAll2(array('rwccoachteachtrack.*', 'rwccoach.*'),'rwccoachteachtrack','rwccoach','CoachID',array('rwccoachteachtrack.TrackID' => $t_id),null,null);
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
                        <li class=""><a href="#coaches" data-toggle="tab" aria-expanded="false">Coach</a>
                        </li>
                        <li class=""><a href="#students" data-toggle="tab" aria-expanded="true">Students</a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="general">
                            <input aria-hidden="true" hidden id="sID" name="id" value="<?php echo $t_id; ?>">
                            <h4><?php echo $my_track['Title']; ?></h4>

                        </div>
                        <div class="tab-pane fade" id="coaches">

                            <h4>Section Coaches</h4>

                            <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#coachModal">Add Coach </button>
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table  id="coaches_queue" width="100%" class="display table table-striped table-bordered table-hover">

                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    while ($coach = $coaches->fetch_assoc()) {
                                        ?>

                                        <tr>
                                            <td><?php echo $coach['Firstname'] ?></td>
                                            <td ><?php echo $coach['Lastname'] ?></td>
                                            <td><?php echo $coach['Email'] ?></td>
                                            <td> <form method="post">
                                                    <input type="submit" class="btn btn-warning" name="action" value="Remove">
                                                    <input type="hidden" name="id" value="<?php echo $coach['CoachID']; ?>"/>

                                                </form></td>

                                        </tr>

                                        <?php
                                    }
                                    ?>


                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <div class="tab-pane fade" id="students">
                            <h4>Students</h4>
                            <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentModal">Add Students </button>
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table  id="students_queue" width="100%" class="display table table-striped table-bordered table-hover">

                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    while ($student = $my_students->fetch_assoc()) {
                                        ?>

                                        <tr>
                                            <td><?php echo $student['Firstname'] ?></td>
                                            <td class="sorting_1"><?php echo $student['Lastname'] ?></td>
                                            <td><?php echo $student['Email'] ?></td>
                                            <td> <form method="post" action="studentEdit.php">
                                                    <input type="submit" class="btn btn-warning" name="action" value="Edit">
                                                    <input type="hidden" name="id" value="<?php echo $student['StudentID']; ?>"/>

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
include 'addCoachModal.php';
include 'addStudentModal.php';
?>

</body>

</html>

