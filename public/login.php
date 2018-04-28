<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 4/20/2018
 * Time: 9:26 PM
 * This is the user Login page.
 * It will recieve username and pasword and use AJAX to validate the data.
 */
	include '../includes/_headers.php'
?>

    <div class="container">
        <br>
        <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <div hidden class="alert alert-danger">
                Oops There is something wrong with your Credentials, Try again.
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="loginForm" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="UserName" type="UserName" autofocus id="UserName">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="Password" type="Password" value="" id="Password">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
	include '../includes/_footer_tables.php'
?>

<script>

    $(document).ready(function() {
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '../php/ajax/processLogin.php',
                data: {
                    userName: $("#UserName").val(),
                    password: $("#Password").val()
                },
            success: function(data)
                {
                    if (data === 'admin') {
                        window.location.replace('coachreport.php');
                    }
                    else if (data === 'coach'){
                        window.location.replace('showattendance.php');
                    }
                    else {
                        $('.alert').toggle();
                    }
                }
            });
        });
    });

</script>

</body>

</html>