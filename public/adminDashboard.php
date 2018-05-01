<?php
/**
 * Created by PhpStorm.
 * User: jeanp
 * Date: 4/30/2018
 * Time: 7:15 PM
 */
include '../includes/_headers.php';

$sections = getAll('section',null,'StartDate','desc')

?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include '../includes/_navbar.php' ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                <form id="sectionFilter" class="form-inline form-group">
                    <label for="sectionSelector">Section</label>
                    <select id="sectionSelector" class="form-control form-group">
                        <?php
                        while ($section = $sections->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $section['SectionID'] ?>"><?php echo $section['SectionName'] ?></option>
                            <?php
                        }
                        ?>

                    </select>
                    <button type="submit" class="btn btn-primary">Load</button>
                </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div id="qty" class="huge">26</div>
                                    <div>New Comments!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
    include '../includes/_footer_tables.php'
    ?>

</body>

<script>
    $(document).ready(function (){
        console.log(13);
        $('#sectionFilter').on('submit', function(e) {
            e.preventDefault();
            var sectionID = $('#sectionSelector').val();
            console.log(sectionID);
            $.ajax({
                type: "POST",
                url: "../php/ajax/dashBoardData.php",
                data: {sectionID: sectionID},
                dataType: 'json',
                success: function (data) {
                    console.log(data.length);


                }
            })
        });

    });


</script>

</html>