<?php
include '../includes/_headers.php'
?>

<div id="wrapper" xmlns: xmlns:>

    <!-- Navigation -->
    <?php include '../includes/_navbar.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-users fa-fw">Sections</i>
                    <i class="pull-right">
                        <a href="../public/coachreport.php">
                            <button type="button" class="btn btn-default btn-circle btn-md">
                                <i class="fa fa-times">
                                </i>
                            </button>
                        </a>
                    </i>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">

                    <?php
                    //here we check that the required values have been set in the post
                    $form = checkFormParams(array("sName", "sStart", "sEnd", "sLocation"));
                    if($form["cnt"] == 4){


                            //inserts values to the login table
                           $id = insertFields("section",
                                array("SectionName" => $form["sName"],
                                    "StartDate" => $form["sStart"],
                                    "EndDate" => $form["sEnd"],
                                    "Location" => $form["sLocation"],
                                    "CreationTime" => date("Y-m-d H:i:s"),
                                    "DeleteFlag" => "N"
                                        )
                            );

                            $error = "success";

                    } else {
                        $error = "";
                    }
                    ?>


                    <div class="panel-heading">
                        Register Coach
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" id="coachRegistration">
                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label for="sName">Section Name</label>
                                        <input class="form-control" id="sName" name="sName" required minlength="4">
                                    </div>
                                    <div class="form-group">
                                        <label for="sStart">Start Date</label>
                                        <input class="form-control" id="sStart" name="sStart" type="date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sEnd">End Date</label>
                                        <input class="form-control" id="sEnd" name="sEnd" type="date" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sLocation">Location</label>
                                        <input class="form-control" id="sLocation" name="sLocation" required>
                                    </div>


                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Section Tracks
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Track Title</th>
                                                        <th>Track Description</th>
                                                        <th>Coach</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>



                                </div>


                            </div>
                            <div class="col-md-16">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                <button type="reset" class="btn btn-warning btn-block">Reset</button>
                            </div>
                        </form>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>

<?php
include '../includes/_footer.php'
?>
