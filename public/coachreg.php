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
                            echo $newID;
                            //inserts values to the login table
                            insertFields("logininfo",
                                array("UserName" => $form["uName"],
                                    "Password" => password_hash($form["uPass"], PASSWORD_DEFAULT),
                                    "Role" => "coach",
                                    "code" => "test",
                                    "Active" => "No",
                                    "CoachID" => $newID,
                                    "StudentID" => NAN
                                )
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
                                    "LanguageSkill" => serialize($_POST['language'])

                                )
                            );

                            $error = "success";
                        }
                    } else {
                        $error = "";
                    }
                    ?>


                    <div class="panel-heading">
                        Register Coach
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <form role="form" method="POST" id="coachRegistration">
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <labuel>User Name</labuel>
                                        <input class="form-control" id="uName" name="uName" required minlength="4">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" id="uPass" name="uPass" type="password" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>

                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control" id="fName" name="fName" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" id="lName" name="lName" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input class="form-control" name="phone" pattern="[0-9]{3}[ -][0-9]{3}[ -][0-9]{4}">
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
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
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="language[]" value= "other">Other
                                                </label>
                                            </div>
                                            <div>
                                                <input type="text" name="language[]" name="other" class="form-control">
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

