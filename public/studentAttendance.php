<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/13/2018
 * Time: 6:35 PM
 */
session_start();
include '../includes/_headers.php';

if (isset($_POST['date'])){
    $date=$_POST['date'];
    $TrackSectionID = $_POST['TrackSection'];
}else{
    $date = date('Y-m-d');
    $TrackSectionID = $_SESSION['TrackSection'];
}


// get students data from db

$my_students = getAll2(array('studentattendance.*','students.Firstname', 'students.Lastname'),'studentattendance' ,'students','StudentID',array('TrackSectionID'=> $TrackSectionID, 'Date' => $date),null,null);

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
                                    <th hidden>ID</th>
                                    <th>First Name</th>
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
                                        <td hidden><input type="text" name="<?php echo 'st_ID'.$count?>" value="<?php echo $student['StudentID']?>"></td>
                                        <td><?php echo $student['Firstname'] ?></td>
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


<?php
//include datatables scripts
include '../includes/_footer_tables.php'
?>


<!--Custom Table Script for students -->

<script>
    $(document).ready(function() {
        console.log('v37');
        var table = $('#studentsAttendance').DataTable({
            responsive: true,
            dom: 'Bflrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]

        });

        $('#attendForm').on('submit',function (e) {
            e.preventDefault();
            //var dataT = table.row( $(this).parents('tr') ).data();
            var data = table.$('input,select,textarea').serialize();

            console.log(data);

            $.ajax({
                type: 'POST',
                url: '../php/ajax/addAttendance.php',
                data: {attend: data},
                success: function(data){
                    console.log('Updated', data);
                }
            });







            //$('#trackModal').modal('toggle');
            //alert( 'You clicked on '+data[0]+'\'s row' );
        } );

    });
</script>

</body>

</html>


