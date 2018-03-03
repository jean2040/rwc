<?php $page_name="Dashboard"?>
<?php include("head.php"); 
validateUser();
?>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<div id="page-wrapper">


<div class="row">
<div class="col-lg-12">

<?php

$form_params = checkFormParams(array("cid", "sid", "notes"));

if($form_params["cnt"] != 3) {
  redirectTo("myhome.php");
}

$check = getById("students", "sid", $form_params["sid"]);

var_dump($check);
if($check["approved"] == 1) {
  redirectTo("myhome.php?sid=" . $form_params["sid"]);
}

addMember("students", "sid", $form_params["sid"], array('approved' => 1, cid => $form_params["cid"], notes => $form_params["notes"]));
redirectTo("myhome.php");



?>

</div>
</div>
</div>

  

      
</div><!-- /#page-wrapper -->
<?php include("footer.php"); ?>
