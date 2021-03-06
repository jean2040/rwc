<?php
include '../includes/_headers.php';
include '../php/dbUpdate.php';
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/22/2018
 * Time: 7:39 PM
 * $_POST["action"]) &&
 */
include '../php/sessionCheck.php';


//here we check that the required values have been set in the post
$form = checkFormParams(array("Firstname", "Lastname"));

if($form["cnt"] == 2){
    //inserts values to the TRACK table
    if (!empty($_POST['password'])){

       updateById('logininfo',array('CoachID'=>$_POST["id"]),
           array("Password" => password_hash($_POST["password"], PASSWORD_DEFAULT),));
    }
    updateById('rwcCoach',array('CoachID'=>$_POST["id"]),
        array(
            "FirstName" => $form["Firstname"],
            "LastName" => $form["Lastname"],
            "Email" => $_POST['email'],
            "Phone" => $_POST['phone'],
            "Level" => "",
            "Gender" => $_POST['gender'],
            "LanguageSkill" => serialize($_POST['language'])

        )
    );
    $error = "success";

}
else {
    $error = "";
}

if (isset($_POST['delete'])){
    updateById('rwcCoach',array('CoachID'=>$_POST["delete"]),
        array(
            "DeleteFlag" => 'Y'

        )
    );
    header("Location: coachreport.php");

}

//Check for ID and load the form with latest data.
if (isset($_POST["id"])){
    $c_id = $_POST["id"];
    }else{
    $c_id = $_SESSION["UserID"];
}

$coach = getById('rwccoach','CoachID',$c_id);
if (isset($coach["LanguageSkill"])){
    $coach["LanguageSkill"] = unserialize($coach["LanguageSkill"]);
}

?>


<div id="wrapper" xmlns: xmlns:>

    <!-- Navigation -->
    <?php include '../includes/_navbar.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <i class="fa fa-road fa-fw">Coach</i>
                    <i class="pull-right">
                        <a href="coachreport.php">
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

        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><b>You are Editing :</b> <?php echo $coach['Firstname'] . " " . $coach['Lastname'] ; ?> Profile</h4>

                        <form class="pull-right" action="" method="post" role="form">
                            <input aria-hidden="true" hidden name="delete" value="<?php echo $c_id; ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>



                </div>
                <div class="panel-body">
                    <form role="form" method="POST" id="coachUpdate">
                        <input aria-hidden="true" hidden name="id" value="<?php echo $c_id; ?>">
                        <div class="row">

                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" id="Firstname" name="Firstname" required value="<?php echo $coach['Firstname']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" id="Lastname" name="Lastname" type="text" value="<?php echo $coach['Lastname']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" id="email" name="email" type="text" required value="<?php echo $coach['Email']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" type="tel" name="phone" value="<?php echo $coach['Phone']; ?>">
                                </div>
                                <div class="form-group">

                                    <label>Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="M" <?php if($coach['Gender'] == "M"){echo "selected";}?>>Male</option>
                                        <option value="F" <?php if($coach['Gender'] == "F"){ echo "selected";}?>>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Language</label>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="language[0]" value="english" <?php if(in_array('english',$coach['LanguageSkill'])){ echo "checked";}?>>English
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="language[1]" value="spanish" <?php if(in_array('spanish',$coach['LanguageSkill'])){ echo "checked";}?>>Spanish
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="language[2]" value= "other" <?php if(in_array('other',$coach['LanguageSkill'])){ echo "checked";}?>>Other
                                            </label>
                                        </div>
                                        <div>
                                            <input type="text" name="language[3]" name="other" class="form-control" autocomplete="off" value="<?php echo print_r($coach['LanguageSkill'][2]); ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Change Password</label>
                                    <input class="form-control" id="email" name="password" type="password" value="" autocomplete="off">
                                </div>



                            </div>

                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>

                        </div>
                    </form>
                    <!-- /.col-lg-6 (nested) -->
                </div>

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
include '../includes/_footer_tables.php';

?>

</body>

</html>


