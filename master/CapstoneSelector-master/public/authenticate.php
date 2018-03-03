<?php $page_name="Login/Register"?>
<?php require 'head.php';?>
<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>



<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <!-- If form post  -->
    <?php 
    $form = checkFormParams(array("pmo_username", "pmo_password"));
    if($form["cnt"] == 2){
      if(isValidUser($form["pmo_username"], $form["pmo_password"])){
        $login = "Yes";
        echo "Valid Password";
        // redirectTo("myhome.php");
      } else {
        $login = "No";
        echo "Invalid Password";
      }
    } else {
      $login = "";
    }
    ?>
    </div>
    
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-lg-12">
      

    </div>
  </div>

</div><!-- /#page-wrapper -->


<script type="text/javascript">

  function submitLogin(){
      var formerrors = "";    

      if(document.getElementById("pmo_username").value == "" || document.getElementById("pmo_username").value == null) {
        formerrors += "Enter Username. <br/>"
      }
      if(document.getElementById("pmo_password").value == "" || document.getElementById("pmo_password").value == null) {
        formerrors += "Enter Password. <br/>"
      }

      if (formerrors == "" || formerrors == null) {
        document.forms["userLogin"].action = "authenticate.php";
        document.forms["userLogin"].submit();
      } else {
        document.getElementById("errors").innerHTML = formerrors;
        document.getElementById("errors").className="alert alert-danger";
      }

    }
</script>

<?php include("footer.php"); ?>
