<?php
include '../includes/_headers.php';


// get coaches data

$my_coaches = getAll('rwccoach', null,null,null);


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
                        <h1>Coaches Reports</h1>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table  id="coaches" width="100%" class="table table-striped table-bordered table-hover">

                                        <thead>
                                        <tr>
                                            <th> ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>More...</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        while ($coach = $my_coaches->fetch_assoc()) {
                                            ?>

                                            <tr>
                                                <td class="sorting_1"><?php echo $coach['CoachID'] ?></td>
                                                <td><?php echo $coach['Firstname'] ?></td>
                                                <td><?php echo $coach['Lastname'] ?></td>
                                                <td><?php echo $coach['Email'] ?></td>
                                                <td class="center"><?php echo $coach['Phone'] ?></td>
                                                <td><button type="button" class="btn btn-info">Open</button></td>
                                            </tr>

                                            <?php
                                            }
                                        ?>


                                        </tbody>
                                    </table>
                        </div>

                        <!-- Modal Coach -->

                        <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block; padding-right: 16px;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                    </div>
                                    <div class="modal-body">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
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
include '../includes/_footer_tables.php'
?>

