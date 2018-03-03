<?php if(!isset($muted)) {?>
	<div id="footer" class="footer">
		<div class="container">
		  <p class="text-muted text-center text-primary">All rights reserved. Copyright <?php echo date("Y"); ?>, <a href="http://www.devangdoshi.com" target="_new">Devang Doshi</a>
			</p>
		</div>

	</div>
<?php } ?>
</body>

<!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

	<!-- Data Tables -->
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    

</html>


<?php
  // Close database connection
	if (isset($connection)) {
	  mysqli_close($connection);
	}

	if (isset($conn)) {
	  $conn = null;
	}

	
?>