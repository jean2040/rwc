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
                    <i class="fa fa-users fa-fw">Coaches</i>
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
                    $form = checkFormParams(array("uName", "uPass", "fName", "lName"));
                    if($form["cnt"] == 4){
                        // verify if the user does not exists
                        $result = getById("logininfo", "UserName", $form['uName']);
                        // if the user exists send error
                        if(isset($result)){
                            $error = "duplicate";
                            echo "<div class=\"alert alert-danger\">Oops, The User Already exists.</div>";
                        } else {
                            // Generate a random ID with "co" as prefix.
                            $newID = getID("st");
                            //inserts values to the login table
                            insertFields("logininfo",
                                array("UserName" => $form["uName"],
                                    "Password" => password_hash($form["uPass"], PASSWORD_DEFAULT),
                                    "Role" => "student",
                                    "code" => "st",
                                    "Active" => "No",
                                    "CoachID" => NAN,
                                    "StudentID" => $newID
                                )
                            );
                            //insert values to the coach table Note that we are using same coach id
                            insertFields("students",
                                array(
                                    "StudentID" => $newID,
                                    "FirstName" => $_POST["fName"],
                                    "LastName" => $_POST["lName"],
                                    "Email" => $_POST['email'],
                                    "Phone" => $_POST['phone'],
                                    "Gender" => $_POST['gender'],
                                    "SchoolID" => $_POST['SchoolID'],
                                    "CreationTime" => date("Y-m-d H:i:s"),
                                    "DeleteFlag" => "N"

                                )
                            );

                            $error = "success";
                            echo "<div class=\"alert alert-success\">User Has been added</div>";
                        }
                    } else {
                        $error = "";
                    }
                    ?>


                    <div class="panel-heading">
                        Student Registration
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" id="studentRegistration">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>User Name</label>
                                        <input class="form-control" id="uName" name="uName" required minlength="4" value="<?php echo isset($_POST["uName"]) ? $_POST["uName"] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" id="uPass" name="uPass" type="password" required value="<?php echo isset($_POST["uPass"]) ? $_POST["uPass"] : ''; ?>">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control" id="fName" name="fName" required value="<?php echo isset($_POST["fName"]) ? $_POST["fName"] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" id="lName" name="lName" required value="<?php echo isset($_POST["lName"]) ? $_POST["lName"] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" type="tel" id="phone" name="phone" value="<?php echo isset($_POST["phone"]) ? $_POST["phone"] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" name="gender" class="form-control">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="schoolID">School ID</label>
                                        <input class="form-control" id="schoolID" name="schoolID">
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

