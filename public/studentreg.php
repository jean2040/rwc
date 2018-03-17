<?php
include '../includes/_headers.php'
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include '../includes/_navbar.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Student Dash Board</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Register Student
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form role="form">
                                    <div class="form-group">
                                        <label>First</label>
                                        <input class="form-control" placeholder="First name">
                                    </div>
                                    <div class="form-group">
                                        <label>Last</label>
                                        <input class="form-control" placeholder="Last name">
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input class="form-control" placeholder="Phone number">
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" placeholder="Email address">
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <input class="form-control" placeholder="Gender">
                                    </div>
                                    <div class="form-group">
                                        <label>Language</label>
                                        <input class="form-control" placeholder="Language skills">
                                    </div>
                                    <div class="form-group">
                                        <label>Grade</label>
                                        <input class="form-control" placeholder="Grade level">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                </form>
                            </div>
                        </div>
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
        <!-- /.row -->

    <!-- /#page-wrapper -->

<?php
include '../includes/_footer.php'
?>

