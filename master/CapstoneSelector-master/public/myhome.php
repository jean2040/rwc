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
      <h1 class="page-header"><?php echo $_SESSION["oname"]?></h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
      
      <div class="col-lg-6 col-md-6">
          <div class="row"><div class="col-lg-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-8">
                            <i class="fa fa-user fa-5x"></i> <span class="h3">My Team</span>
                        </div>
                        <div class="col-xs-4 text-right">
                            <?php $myteam = getCount("students", array("cid" => $_SESSION["id"])); ?>
                            <div class="huge"><?php echo $myteam?></div>
                            <div>Selected</div>
                        </div>
                    </div>
                </div>
                
            </div>
          </div></div>



          <div class="row">
          <!-- selected students -->
            <!-- Undergrad students -->
            <div class="col-lg-12">
            
            <?php if(isset($_GET["sid"])){
              $cannotadd = getById("students", "sid", $_GET["sid"]);
              ?>
            
            <div class="alert alert-danger">
                <a href="myhome.php" type="button" class="close"  >&times;</a>
                Sorry! <span class="alert-link"><?php echo $cannotadd["name"] ?></span> seems to be part of another team.
            </div>
            <?php } ?>
            <div class="panel panel-success">
                
                <div class="panel-heading">
                    <span class="h3">Undergraduate</span>
                </div>
                <div class="panel-body">
                    <?php 
                    $mymembers = getAll("students", array("cid" => $_SESSION["id"], "level" => "undergraduate"), "name", "asc"); 
                    while ($member = $mymembers->fetch_assoc()) {
                    ?>
                      <div class="col-lg-12">
                        
                        <div class="well">
                          <button type="button" class="btn btn-outline btn-danger btn-xs pull-right" data-toggle="modal" data-target="#myModal<?php echo $member["sid"];?>"><i class="fa fa-times"></i></button>
                          <h3> <?php echo $member["name"]; ?> </h3>
                          <p><?php echo $member["notes"]; ?></p>
                          
                          

                          <div class="modal fade text-left" id="myModal<?php echo $member["sid"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title" id="myModalLabel"><button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button> Remove Member?</h4>
                                </div>
                                <div class="modal-body alert alert-danger">
                                  Are you sure you want to remove &quot;<?php echo $member["name"];?> &quot;?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <a href="removemember.php?sid=<?php echo $member["sid"];?>" class="btn btn-danger">Delete</a>
                                </div>
                              </div><!-- /.modal-content -->
                            </div> <!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                        </div>
                      </div>
                      
                    <?php } ?>
                </div>
                
            </div>
            </div>
            

            <!-- Grad students -->
            <div class="col-lg-12">
            <div class="panel panel-success">
                
                <div class="panel-heading">
                    <span class="h3">Graduate</span>
                </div>
                <div class="panel-body">
                    <?php 
                    $mymembers = getAll("students", array("cid" => $_SESSION["id"], "level" => "graduate"), "name", "asc"); 
                    while ($member = $mymembers->fetch_assoc()) {
                    ?>
                      <div class="col-lg-12">
                        
                        <div class="well">
                          <button type="button" class="btn btn-outline btn-danger btn-xs pull-right" data-toggle="modal" data-target="#myModal<?php echo $member["sid"];?>"><i class="fa fa-times"></i></button>
                          <h3> <?php echo $member["name"]; ?> </h3>
                          <p><?php echo $member["notes"]; ?></p>
                          
                          

                          <div class="modal fade text-left" id="myModal<?php echo $member["sid"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title" id="myModalLabel"><button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button> Remove Member?</h4>
                                </div>
                                <div class="modal-body alert alert-danger">
                                  Are you sure you want to remove &quot;<?php echo $member["name"];?> &quot;?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <a href="removemember.php?sid=<?php echo $member["sid"];?>" class="btn btn-danger">Delete</a>
                                </div>
                              </div><!-- /.modal-content -->
                            </div> <!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                        </div>
                      </div>
                    <?php } ?>
                </div>
                
            </div>
            </div>

          </div>
      </div>
      <div class="col-lg-6 col-md-6">
          <div class="row"><div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-8">
                            <i class="fa fa-users fa-5x"></i> <span class="h3">Global Pool</span>
                        </div>
                        <div class="col-xs-4 text-right">
                            <?php $myteam = getCount("students", array("approved" => 0)); ?>
                            <div class="huge"><?php echo $myteam?></div>
                            <div>Available</div>
                        </div>
                    </div>
                </div>
            </div>
          </div></div>

          <div class="row"><div class="col-lg-12">
            <form role="form" id="newMember" method="POST">
              <input type="hidden" name="sid" id="sid" value="">
              <input type="hidden" name="cid" id="cid" value="<?php echo $_SESSION["id"]?>">
              <input type="hidden" name="notes" id="notes" value="">
            </form>
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Student Name</th>
                        <th>Level</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                    $students = getAll("students", array("approved" => 0), "name", "asc");

                    $i = 1;
                    while ($student = $students->fetch_assoc()){
                    ?>   
                    
                   
                    
                    <tr class="odd gradeX">
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $student["name"]; ?></td>
                        <td><?php echo $student["level"]; ?></td>
                        <td class="text-center">
                          <button type="button" class="btn btn-default btn-circle" data-toggle="modal" data-target="#myModal<?php echo $student["sid"];?>"><i class="fa  fa-plus"></i></button>

                          <div class="modal fade text-left" id="myModal<?php echo $student["sid"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title" id="myModalLabel"><button type="button" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></button> Add Member?</h4>
                                </div>
                                <div class="modal-body alert alert-success">
                                  <div class="form-group">
                                      <label><?php echo $student["name"];?></label>
                                      <input id="membernote<?php echo $student["sid"];?>" name="membernote<?php echo $student["sid"];?>" class="form-control" placeholder="e.g. Project Manager, Team Member, other notes...">
                                  </div>
                                  
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <a href="javascript:addMember(<?php echo $student["sid"]?>)" class="btn btn-success">Add</a>
                                </div>
                              </div><!-- /.modal-content -->
                            </div> <!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                        </td>
                        
                    </tr>
                    <?php $i++; ?>
                    <?php } ?>
                </tbody>
            </table>
            <!-- /.table-responsive -->
          </div></div>
      </div>
  </div>
  <!-- /.row -->

  

      
</div><!-- /#page-wrapper -->



<script type="text/javascript">

  function addMember(sid){
      
      document.getElementById("sid").value = sid;
      document.getElementById("notes").value = document.getElementById("membernote" + sid).value;
      document.forms["newMember"].action = "addmember.php";
      document.forms["newMember"].submit();

    }
</script>



<?php include("footer.php"); ?>

<script type="text/javascript">
  $(document).ready( function () {
    $('#dataTables-example').DataTable({
      ordering:  false
    });
  } );
</script>