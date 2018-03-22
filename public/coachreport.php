<?php
include '../includes/_headers.php';


// get coaches data

$my_coaches = getAll('rwccoach', null,null,null);
$my_coaches2 = getAll2(array("logininfo.UserName", "rwccoach.*"),'rwccoach',"logininfo","coachID",null,null,null)

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
                            <i class="fa fa-users fa-fw">Coaches</i>
                            <i class="pull-right">
                                <a href="../public/coachreg.php">
                                    <button type="button" class="btn btn-default btn-circle btn-md">
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
                            <table  id="coaches" width="100%" class="table table-striped table-bordered table-hover">

                                <thead>
                                <tr>
                                    <th style="display:none"> ID</th>
                                    <th>User Name</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <!-- <th>More...</th> -->
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                while ($coach = $my_coaches2->fetch_assoc()) {
                                    ?>

                                    <tr>
                                        <td><?php echo $coach['CoachID'] ?></td>
                                        <td class="sorting_1" style="display:none"><?php echo $coach['UserName'] ?></td>
                                        <td><?php echo $coach['Firstname'] ?></td>
                                        <td><?php echo $coach['Lastname'] ?></td>
                                        <td><?php echo $coach['Email'] ?></td>
                                        <td class="center"><?php echo $coach['Phone'] ?></td>
                                        <!-- <td><button type="button" class="btn btn-info">Open</button></td> -->
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
                                        <h4 class="modal-title" id="myModalLabel2"></h4>
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
include '../includes/_footer_tables.php'
?>


<script>
    $(document).ready(function() {
        var table = $('#coaches').DataTable({
            responsive: true,
            dom: 'Bflrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            "columnDefs":[
                {
                    "targets":[0],
                    "visible": false,
                    "searchable":false
                }
            ]

        });
// this function will get  info form database on click using ajax and then showing it to the modal
        $('#coaches tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            console.log(data);
            $.ajax({
                type: "POST",
                url: "../php/getUser.php",
                data: { user_id: data[0]},
                dataType: "json",
                success: function(data) {

                    //and from data you can retrieve your user details and show them in the modal
                    $('#myModal').modal();
                    $('#myModalLabel2').text(data['Firstname']+""+data['Lastname']);
                    $('#modal_email').text(data['Email']);
                    $('#modal_gender').text(data['Gender']);
                    $('#modal_phone').text(data['Phone']);
                    $('#modal_level').text(data['Level']);
                    $('#modal_language').text(data['LanguageSkill']);
                    console.log(data);
                }});


            //alert( 'You clicked on '+data[0]+'\'s row' );
        } );
    });
</script>

</body>

</html>