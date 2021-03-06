<?php
include '../includes/_headers.php';
include '../php/sessionCheck.php';
// get sections data
$my_sections = getAll('section', array('DeleteFlag'=> "N"),null,null);
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
                            <i class="fa fa-calendar fa-fw">Sections</i>
                            <i class="pull-right">
                                <a href="../public/sectionreg.php">
                                    <button type="button" class="btn btn-default btn-circle btn-lg">
                                        <i class="fa fa-plus">
                                        </i>
                                    </button>
                                </a>
                            </i>
                        </h1>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table  id="sections" width="100%" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>More...</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while ($section = $my_sections->fetch_assoc()) {
                                            ?>

                                            <tr>

                                                <td class="sorting_1"><?php echo $section['SectionID'] ?></td>
                                                <td><?php echo $section['SectionName'] ?></td>
                                                <td><?php echo $section['Location'] ?></td>
                                                <td><?php echo $section['StartDate'] ?></td>
                                                <td><?php echo $section['EndDate'] ?></td>
                                                <td><form method="post" action="sectionEdit.php">
                                                        <input type="submit" class="btn btn-warning" name="action" value="Edit">
                                                        <input type="hidden" name="id" value="<?php echo $section['SectionID']; ?>"/>

                                                    </form></td>
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
                                            <div class="col-sm-3">Section Name:</div>
                                            <div class="col-sm-6" id="modal_name"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">Start Date:</div>
                                            <div class="col-sm-6" id="modal_location"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">End Date:</div>
                                            <div class="col-sm-6" id="modal_start"></div>
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
include '../includes/_footer_tables.php'
?>


<script>
    $(document).ready(function() {
        var table = $('#sections').DataTable({
            responsive: true,
            dom: 'Bflrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });
// this function will get  info form datadabe on click using ajax and then showing it to the modal

    });
</script>
</body>
</html>
