<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/13/2018
 * Time: 6:35 PM
 */

include '../includes/_headers.php';

include '../php/sessionCheck.php';

// get tracks data from db

$my_tracks = getAll('track', null,null,null);

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
                            <i class="fa fa-road fa-fw">Tracks</i>
                            <i class="pull-right">
                                <a href="../public/trackreg.php">
                                    <button type="button" class="btn btn-default btn-circle btn-md">
                                            <i class="fa fa-plus">
                                            </i>
                                        </button>
                                    </a>
                            </i> 
                        </h1>
                        <!-- ADD ADD BUTTON-->
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table  id="tracks" width="100%" class="table table-striped table-bordered table-hover">

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
                                        <td><?php echo $track['TrackID'] ?></td>
                                        <td class="sorting_1"><?php echo $track['Title'] ?></td>
                                        <td><?php echo $track['Description'] ?></td>
                                        <td> <form method="post" action="trackEdit.php">
                                                <input type="submit" class="btn btn-warning" name="action" value="Edit">
                                                <input type="hidden" name="id" value="<?php echo $track['TrackID']; ?>"/>

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


<!--Custom Table Script for Tracks -->

<script>
    $(document).ready(function() {
        var table = $('#tracks').DataTable({
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


