<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/13/2018
 * Time: 6:35 PM
 */

include '../includes/_headers.php';


// get students data from db

$my_students = getAll('students', null,null,null);


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
                            <i class="fa fa-graduation-cap fa-fw">students</i>
                            <i class="pull-right">
                                <a href="../public/studentreg.php">
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
                            <table  id="students" width="100%" class="table table-striped table-bordered table-hover">

                                <thead>
                                <tr>
                                    <th>First</th>
                                    <th>Last</th>
                                    <th>Track</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                while ($student = $my_students->fetch_assoc()) {
                                    ?>

                                    <tr>
                                        <td class="sorting_1"><?php echo $student['Title'] ?></td>
                                        <td><?php echo $student['ShortTitle'] ?></td>
                                        <td><?php echo $student['Description'] ?></td>

                                    </tr>

                                    <?php
                                }
                                ?>


                                </tbody>
                            </table>
                        </div>

                        <!-- Modal Coach -->

                        <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; padding-right: 16px;">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel"></h4>
                                    </div>
                                    <div class="modal-body" id="modalbody">
                                        <div class="row">
                                            <div class="col-sm-3">Email:</div>
                                            <div class="col-sm-6" id="modal_email"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">Phone:</div>
                                            <div class="col-sm-6" id="modal_phone"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">Level:</div>
                                            <div class="col-sm-6" id="modal_level">3</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">Gender:</div>
                                            <div class="col-sm-6" id="modal_gender">3</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">Language:</div>
                                            <div class="col-sm-6" id="modal_language">3</div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-warning">Edit</button>
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
//include datatables scripts
include '../includes/_footer_tables.php'
?>


<!--Custom Table Script for students -->

<script>
    $(document).ready(function() {
        var table = $('#students').DataTable({
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


