<?php

/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/13/2018
 * Time: 6:35 PM
 */

include '../includes/_headers.php';

if (isset($_POST['TrackSectionID'])){
    $CoachID = $_SESSION['UserID'];

    $current_section_track = $_POST['TrackSectionID'];
    $track_id = $_POST['track'];
// get students data from db
    $Coach = getById('rwccoach','CoachID',$CoachID);
    $my_attendances = getCountGroupBy('StudentID',array('Date','track.Title'),'studentattendance','track','TrackID',array('TrackSectionID' => $current_section_track),'Date');
}else{
    header ('Location: ../public/coachDashBoard.php');
}



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
                            <i class="fa fa-graduation-cap fa-fw">Tracks</i>
                        </h1>

                    </div>
                    <!-- /.panel-heading -->
                  <div class="panel-body">
                      <form method="post" action="../php/createAttendance.php">
                          <input hidden aria-hidden="true" name="track_section" value="<?php echo $current_section_track; ?>">
                          <button class="btn btn_primary" type="submit">Take Today's Attendance</button>
                      </form>

                      <br>
                      <br>
                        <div class="table-responsive">
                            <table  id="coachTracks" width="100%" class="table table-striped table-bordered table-hover">

                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Track Title</th>
                                    <th>Attendance</th>
                                    <th>View</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                while ($attend = $my_attendances->fetch_assoc()) {
                                    ?>

                                    <tr>
                                        <td><?php echo $attend['Date'] ?></td>
                                        <td><?php echo $attend['Title'] ?></td>
                                        <td><?php echo $attend['COUNT(StudentID)'] ?></td>
                                        <td><form method="post" action="studentAttendance.php">
                                                <input name="date" hidden aria-hidden="true" value="<?php echo $attend['Date'] ?>">
                                                <input name="TrackSection" hidden aria-hidden="true" value="<?php echo $current_section_track ?>">
                                                <button class="btn btn-success">View</button>
                                            </form></td>


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
        var table = $('#coachTracks').DataTable({
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


