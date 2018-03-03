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

$query_params = checkQueryParams(array("sid"));
if($query_params["cnt"] != 1) {
  redirectTo("myhome.php");
}

updateById("students", "sid", $query_params["sid"], array('approved' => 0, cid => 0, notes => " "));
echo "up over";
redirectTo("myhome.php");

?>

</div>
</div>
</div>

  

      
</div><!-- /#page-wrapper -->
<?php include("footer.php"); ?>
