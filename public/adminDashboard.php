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
            <div id="panels" class="row">


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
        $(function() {
            $('#sectionFilter').submit();
        });

        $('#sectionFilter').on('submit', function(e) {
            e.preventDefault();
            var sectionID = $('#sectionSelector').val();

            $.ajax({
                type: "POST",
                url: "../php/ajax/dashBoardData.php",
                data: {sectionID: sectionID},
                dataType: 'json',
                success: function (data) {
                        drawDash(data);
                }
            })
        });

        function drawDash(users) {
            $('#panels').empty();
            console.log(users);
            for (i = 0; i < users.length; i++) {
                console.log(users[i]['coachName']);
                var box = "<div class=\"col-lg-4 col-md-6\">\n" +
                    "                    <div class=\"panel panel-primary\">\n" +
                    "                        <div class=\"panel-heading\">\n" +
                    "                            <div class=\"row\">\n" +
                    "                                <div class=\"col-xs-3\">\n" +
                    "                                    <div class=\"huge\">"+users[i]['COUNT(studenttaketrack.StudentID)']+"</div>\n" +
                    "                                </div>\n" +
                    "                                <div class=\"col-xs-9 text-right\">\n" +
                    "                                    <h3>"+users[i]['TrackTitle']+"</h3>\n" +
                    "                                    <div>"+users[i]['coachName']+"</div>\n" +
                    "                                </div>\n" +
                    "                            </div>\n" +
                    "                        </div>\n" +
                    "                        <a href=\"#\">\n" +
                    "                            <div class=\"panel-footer\">\n" +
                    "                                <span class=\"pull-left\">View Details</span>\n" +
                    "                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>\n" +
                    "                                <div class=\"clearfix\"></div>\n" +
                    "                            </div>\n" +
                    "                        </a>\n" +
                    "                    </div>\n" +
                    "                </div>";
                $("#panels").append(box);
            }

        }

    });


</script>

</html>