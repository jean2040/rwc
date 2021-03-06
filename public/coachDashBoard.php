<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/13/2018
 * Time: 6:35 PM
 */
include '../includes/_headers.php';

if (!isset($_SESSION['Role'])) {
    header('Location: ../public/');
}


$CoachID = $_SESSION['UserID'];
// get students data from db
$Coach = getById('rwccoach','CoachID',$CoachID);
$my_tracks = getAll2(array('rwccoachteachtrack.TrackSectionID','track.TrackID', 'track.Title'),'rwccoachteachtrack' ,'track','TrackID',array('CoachID'=> $CoachID),null,null,null);

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
                        <div class="table-responsive">
                            <table  id="coachTracks" width="100%" class="table table-striped table-bordered table-hover">

                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Track Title</th>
                                    <th>Attendance</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                while ($track = $my_tracks->fetch_assoc()) {
                                    ?>

                                    <tr>
                                        <td><?php echo $track['TrackSectionID'] ?></td>
                                        <td><?php echo $track['Title'] ?></td>
                                        <td>
                                            <form method='post' action="showattendance.php">
                                                <input name="TrackSectionID" hidden value="<?php echo $track['TrackSectionID'] ?>">
                                                <input name="TrackID" hidden value="<?php echo $track['TrackID'] ?>">
                                                <button class="btn btn-success">View</button>
                                            </form>

                                            </td>


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


