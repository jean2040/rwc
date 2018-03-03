<?php $page_name="Register"?>

<?php require 'head.php';?>
<?php isAdmin();?>
<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-6">
      <?php 
        $form = checkFormParams(array("fname", "lname", "email", "type", "oname"));
        if($form["cnt"] == 5){
          // echo "Post";
          $result = getById("user", "userEmail", $form["email"]);
          if(isset($result)){
            $error = "duplicate";
          } else {
            // Generate Random Password
            $newPass = randomPassword();
            // echo "Passowrd: " . $newPass;
            // Generate Hash
            // $newPassHash = passHash($newPass);
            // echo "Inserting Fields";
            // Save Password in Database
            $id = insertFields("user", 
                array("userFname" => $form["fname"], 
                      "userLname" => $form["lname"], 
                      "userEmail" => $form["email"], 
                      "userPassword" => $newPass,
                      "userType" => $form["type"],
                      "userOname" => $form["oname"])
                );

            // Email Password to User
            $error = "success";
          }
        } else {
          $error = "";  
        }
      ?>
      <h2 class="page-header">New User? Register</h2>
      
      <form role="form" id="userRegistration" method="POST">
        <div id="errors"></div>
        <?php 
        if($error == "success"){ ?>
          <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              User Registered, password: <?php echo $newPass?>
          </div>
        <?php } ?>

        <?php 
        if($error == "duplicate"){ ?>
          <div class="alert alert-danger alert-dissmisible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Duplicate User!!!
          </div>
        <?php } ?>

        <div class="form-group">
            <label>First Name</label>
            <input id="fname" name="fname" class="form-control">
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input id="lname" name="lname" class="form-control">
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input id="email" name="email" class="form-control" placeholder="example@domain.com">
            <p class="help-block">Your email address will be your username</p>
        </div>
        <div class="form-group">
            <label>Type</label>
            <select name="type" id="type" class="form-control">
              <option value="0">Select</option>
              <option value="industry">Industry Sponsor</option>
              <option value="entrepreneur">Student Entrepreneur</option>
              <option value="executive">Executive Team</option>
            </select> 
        </div>
        <div class="form-group">
            <label>Organization/Project Name</label>
            <input id="oname" name="oname" class="form-control">
        </div>
        
        
        
        <a href="javascript:submitRegistration();" class="btn btn-primary">Register</a>
        <button type="reset" class="btn btn-default">Reset</button>
      </form>
    </div>
    
  </div>
  <!-- /.row -->
</div><!-- /#page-wrapper -->


<script type="text/javascript">
  
  function submitRegistration(){
      var formerrors = "";    

      if(document.getElementById("fname").value == "" || document.getElementById("fname").value == null) {
        formerrors += "Enter First Name. <br/>"
      }
      if(document.getElementById("lname").value == "" || document.getElementById("lname").value == null) {
        formerrors += "Enter Last Name. <br/>"
      }
      if(document.getElementById("email").value == "" || document.getElementById("email").value == null) {
        formerrors += "Enter valid email address.<br/>"
      }
      if(document.getElementById("type").value == "0" || document.getElementById("type").value == null) {
        formerrors += "Select Type.<br/>"
      }
      if(document.getElementById("oname").value == "" || document.getElementById("oname").value == null) {
        formerrors += "Enter Organization/Project Name.<br/>"
      }
      if (formerrors == "" || formerrors == null) {
        document.forms["userRegistration"].action = "register.php";
        document.forms["userRegistration"].submit();
      } else {
        document.getElementById("errors").innerHTML = formerrors;
        document.getElementById("errors").className="alert alert-danger";
      }

    }

</script>

<?php include("footer.php"); ?>