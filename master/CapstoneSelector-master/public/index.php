<?php $page_name="Login/Register"?>
<?php require 'head.php';?>
<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>


<?php 

  $form = checkFormParams(array("username", "password"));
  if($form["cnt"] == 2){
    if(isValidUser($form["username"], $form["password"])){
      $login = "Yes";
      redirectTo("myhome.php"); 
    } else {
      $login = "No";
    }
  } else {
    $login = "";
  }
?>

<div class="container">
  <?php if($login == "No"){ ?>
  <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      Username or Password Incorrect!!!
  </div>
  <?php } ?>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Please Sign In</h3>
        </div>
        <div class="panel-body">
          <form role="form" id="userLogin" method="POST">
            <div id="errors">
          
            </div>
            <fieldset>
              <div class="form-group">
                <input class="form-control" placeholder="E-mail" id="username" name="username" type="email" autofocus>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Password" id="password" name="password" type="password" value="">
              </div>
              
              <a href="javascript:submitLogin();" class="btn btn-lg btn-success btn-block">Login</a>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

  function submitLogin(){
      var formerrors = "";    

      if(document.getElementById("username").value == "" || document.getElementById("username").value == null) {
        formerrors += "Enter Username. <br/>"
      }
      if(document.getElementById("password").value == "" || document.getElementById("password").value == null) {
        formerrors += "Enter Password. <br/>"
      }

      if (formerrors == "" || formerrors == null) {
        document.forms["userLogin"].action = "index.php";
        document.forms["userLogin"].submit();
      } else {
        document.getElementById("errors").innerHTML = formerrors;
        document.getElementById("errors").className="alert alert-danger";
      }

    }
</script>

<?php include("footer.php"); ?>
