<?php
include '../includes/_headers.php';



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
                            echo "<div class=\"alert alert-danger\">
                                Oops, The User Already exists.
                            </div>";
                        } else {
                            // Generate a random ID with "co" as prefix.
                            $newID = getID("co");
                            //echo $newID;
                            //inserts values to the login table
                            $user = insertFields("logininfo",
                                array("UserName" => $form["uName"],
                                    "Password" => password_hash($form["uPass"], PASSWORD_DEFAULT),
                                    "Role" => "coach",
                                    "code" => "test",
                                    "Active" => "No",
                                    "CoachID" => $newID,
                                    "StudentID" => NAN
                                ), null
                            );
                            //insert values to the coach table Note that we are using same coach id
                            insertFields("rwccoach",
                                array(
                                    "CoachID" => $newID,
                                    "FirstName" => $form["fName"],
                                    "LastName" => $form["lName"],
                                    "Email" => $_POST['email'],
                                    "Phone" => $_POST['phone'],
                                    "Level" => "",
                                    "Gender" => $_POST['gender'],
                                    "LanguageSkill" => serialize($_POST['language']),
                                    "CreationTime" => date("Y-m-d H:i:s"),
                                    "DeleteFlag" => "N"

                                ), null
                            );

                            $error = "success";
                            echo '<script type="text/javascript">window.location = "coachreport.php";</script>';

                        }
                    } else {
                        $error = "";
                    }
                    ?>


                    <div class="panel-heading">
                        Register Coach
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" id="coachRegistration" data-toggle="validator">
                        <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label for="uName">User Name</label>
                                        <input type="text" class="form-control nospace" id="uName" name="uName" required
                                               data-minlength="4"
                                               data-error="User Name required with Minimum of 4 Characters">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="uPass">Password</label>
                                        <input class="form-control" id="uPass" name="uPass" type="password" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="rePass">Repeat password</label>
                                        <input data-match="#uPass" class="form-control" id="rePass" name="rePass" type="password"
                                               data-match-error="Whoops, these don't match" required>
                                        <div class="help-block with-errors"></div>
                                    </div>



                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control" id="fName" name="fName" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" id="lName" name="lName" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required placeholder="email@email.com">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input  id="phone"
                                                class="form-control"
                                                type="tel"
                                                name="phone"
                                                placeholder="(845)555-1212"
                                                data-minlength="10"
                                                data-error="Hey, does not a valid Phone Number">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select id="gender" name="gender" class="form-control">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Language</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="language[]" value="english">English
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="language[]" value="spanish">Spanish
                                                </label>
                                            </div>
                                            <div>
                                                <input type="text" name="language[]" placeholder="Other" class="form-control">
                                            </div>
                                        </div>
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

