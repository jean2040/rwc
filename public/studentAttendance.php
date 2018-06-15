<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/13/2018
 * Time: 6:35 PM
 * This page Shows the List of students that are ready to get the attendance.
 * It will only show if tracksection has been set. Because this value is required, it will sendyou back to the dashboard
 */
session_start();
include '../includes/_headers.php';

if (isset($_POST['date'])){
    //If you are coming from the showAttendance View button, get the posted date
    $date=$_POST['date'];
    if (isset($_POST['TrackSection'])){
        //Track Section is a needed value for this page, if is not set, return to dashboard
        $TrackSectionID = $_POST['TrackSection'];
    }else{
        header ('Location: ../public/coachDashBoard.php');
    }

}else{
    $date = date('Y-m-d');
    //if you are coming from the Take Today's Attendance option get the value from the function to create an attendance
    if (isset($_SESSION['TrackSection'])){
        //Track Section is a needed value for this page, if is not set, return to dashboard
        $TrackSectionID = $_SESSION['TrackSection'];
    }else{
        header ('Location: ../public/coachDashBoard.php');
    }

}

// get students data from db

$my_students = getAll2(array('studentattendance.*','students.Firstname', 'students.Lastname'),'studentattendance' ,'students','StudentID',array('TrackSectionID'=> $TrackSectionID, 'Date' => $date),null,null,null);

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
                            <i class="fa fa-graduation-cap fa-fw"></i>
                            Students Attendance
                        </h1>
                        <!-- ADD ADD BUTTON-->
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form id="attendForm" name="attendForm">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <br>
                                <br>
                            <table  id="studentsAttendance" width="100%" class="table table-striped table-bordered table-hover">

                                <thead>
                                <tr>

                                    <th>First Name</th>
                                    <th hidden>ID</th>
                                    <th>Last Name</th>
                                    <th>Attendance</th>
                                    <th>Comments</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $count= 0;
                                while ($student = $my_students->fetch_assoc()) {

                                    ?>

                                    <tr>
                                        <td><?php echo $student['Firstname'] ?></td>
                                        <td hidden><input type="text" name="<?php echo 'st_ID'.$count?>" value="<?php echo $student['StudentID']?>">
                                            <input name="<?php echo 'track_section'.$count?>" value="<?php echo $TrackSectionID; ?>">
                                            <input name="<?php echo 'date'.$count?>" value="<?php echo $date; ?>">
                                        </td>
                                        <td><?php echo $student['Lastname'] ?></td>
                                        <td><select class="form-control" size="1" name="<?php echo 'select_option'.$count?>">
                                                <option value="present" <?php if ($student['Attendance']=='present'){echo 'selected';}?>>Present</option>
                                                <option value="late" <?php if ($student['Attendance']=='late'){echo 'selected';}?>>Late</option>
                                                <option value="absent" <?php if ($student['Attendance']=='absent'){echo 'selected';}?>>Absent</option>
                                             </select></td>
                                        <td><textarea  type="text" name="<?php echo 'comment'.$count?>" class="form-control" id="<?php echo "comment".$count?>" placeholder="Enter comment"><?php if ($student['Comments']!=''){echo $student['Comments'];}?></textarea></td>

                                    </tr>

                                    <?php
                                    $count ++;
                                }
                                ?>


                                </tbody>
                            </table>
                            </form>
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

<!-- Modal Notification -->

<div class="modal fade in" id="successModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Success</h4>
            </div>
            <div class="modal-body">
                Students Attendance has been update.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- End of Modal -->


<?php
//include datatables scripts
include '../includes/_footer_tables.php'
?>


<!--Custom Table Script for students -->

<script>
    $(document).ready(function() {

        var table = $('#studentsAttendance').DataTable({
            responsive: true
        });

        $('#attendForm').on('submit',function (e) {
            e.preventDefault();
            //var dataT = table.row( $(this).parents('tr') ).data();
            var data = table.$('input,select,textarea').serialize();

            //console.log(data);

            $.ajax({
                type: 'POST',
                url: '../php/ajax/addAttendance.php',
                data: {attend: data},
                success: function(data){
                    //console.log('Updated',data);
                    $('#successModal').modal('show')

                }
            });







            //$('#trackModal').modal('toggle');
            //alert( 'You clicked on '+data[0]+'\'s row' );
        } );

    });
</script>

</body>

</html>


