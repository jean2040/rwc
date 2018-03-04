<?php
include '../includes/_headers.php'
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include '../includes/_navbar.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Coaches</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Register Coach
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <form role="form" method="POST">
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label>User Name</label>
                                        <input class="form-control" placeholder="name">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" type="password">
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" id="role"  value="coach">
                                        <input class="form-control" id="active" value="No">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>

                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="" id="" class="form-control">
                                        <option value="male">Male</option>
                                        <option value="femeale">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Language</label>

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="english">English
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="spanish">Spanish
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="other">Other
                                                </label>
                                            </div>
                                            <div>
                                                <input type="text" id="other" name="other" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                </div>

                             </form>

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

</div>

<?php
include '../includes/_footer.php'
?>

