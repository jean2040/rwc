<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        
        <div class="navbar-header">
            <?php if(isLoggedIn()){ ?>    
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php } ?>    
            <a class="navbar-brand" href="myhome.php">NJIT Capstone: Student Selection</a>
        </div>
        
        
        <ul class="nav navbar-top-links navbar-right" style="padding-left: 10px;">
            <?php if(isLoggedIn("all")){ ?>
            <li>
                <?php
                    if($_SESSION["type"] == "industry") {
                        $type = "Industry Sponsor";
                    } else if ($_SESSION["type"] == "entrepreneur") {
                        $type = "Student Entrepreneur";
                    } else {
                        $type = "Executive Team";
                    }

                ?>
                <h5><?php echo $_SESSION["fname"]?> <?php echo $_SESSION["lname"]?> (<?php echo $type?>)</h5>
            </li>
            
            
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    
                    <li><a href="signout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>   
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
            <?php } ?>
        </ul>
        
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
            <?php if(isLoggedIn()){ ?>
                <li>
                    <a href="myhome.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
            <?php } ?>
            <?php if(isLoggedIn() && $_SESSION["type"] == "executive"){ ?>
                <li>
                    <a href="register.php"><i class="fa fa-plus-circle"></i> Register User</a>
                </li>
             <?php } ?>
            </ul>

        </div>
        <!-- /.sidebar-collapse -->
        
    </div>
    <!-- /.navbar-static-side -->
</nav>
