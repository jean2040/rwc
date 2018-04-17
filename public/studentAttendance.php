<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/13/2018
 * Time: 6:35 PM
 */

include '../includes/_headers.php';

$TrackSectionID = 1;
// get students data from db

$my_students = getAll2(array('studenttaketrack.*','students.Firstname', 'students.Lastname'),'studenttaketrack' ,'students','StudentID',array('TrackSectionID'=> $TrackSectionID),null,null);

?>

<div id="wrapper" xmlns: xmlns:>

    <!-- Navigation -->
    <?php include '../includes/_navbar.php' ?>

    <div id="page-wrapper">
        <br>
        <br>

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <h1>
                            <i class="fa fa-graduation-cap fa-fw">Students Attendance</i>

                        </h1>
                        <!-- ADD ADD BUTTON-->
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table  id="studentsAttendance" width="100%" class="table table-striped table-bordered table-hover">

                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Attendance</th>
                                    <th>Comments</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                while ($student = $my_students->fetch_assoc()) {
                                    ?>

                                    <tr>
                                        <td><?php echo $student['StudentID'] ?></td>
                                        <td><?php echo $student['Firstname'] ?></td>
                                        <td><?php echo $student['Lastname'] ?></td>
                                        <td><div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-success">
                                                    <input type="radio" name="options" id="option1" autocomplete="off" checked> Present
                                                </label>
                                                <label class="btn btn-warning">
                                                    <input type="radio" name="options" id="option2" autocomplete="off"> Late
                                                </label>
                                                <label class="btn btn-danger">
                                                    <input type="radio" name="options" id="option3" autocomplete="off"> Absent
                                                </label>
                                            </div></td>
                                        <td><input class="form-control" placeholder="Enter comment"></td>

                                    </tr>

                                    <?php
                                }
                                ?>


                                </tbody>
                            </table>
                        </div>


                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->


<?php
//include datatables scripts
include '../includes/_footer_tables.php'
?>


<!--Custom Table Script for students -->

<script>
    $(document).ready(function() {
        var table = $('#studentsAttendance').DataTable({
            responsive: true,
            dom: 'Bflrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });


    });
</script>

</body>

</html>


