<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/23/2018
 * Time: 9:42 PM
 */

$sections = getAll('section',null,null,null);

?>

<div class="modal fade in" id="sectionModal" tabindex="-1" role="dialog" aria-labelledby="sectionModal" aria-hidden="true" style="display: none; padding-right: 16px;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="s_modalTitle">Click on a Section to Select it</h4>
            </div>
            <div class="modal-body" id="s_modalbody">

                <div class="table-responsive">
                    <table  id="sections" width="100%" class="table table-striped table-bordered table-hover">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Section Name</th>
                            <th>Start Date</th>
                            <th>Location</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($section = $sections->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><?php echo $section['SectionID'] ?></td>
                                <td><?php echo $section['SectionName'] ?></td>
                                <td><?php echo $section['StartDate'] ?></td>
                                <td><?php echo $section['Location'] ?></td>

                            </tr>

                            <?php
                        }
                        ?>


                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {
        var table = $('#sections').DataTable({
            responsive: true,
            "scrollY":        "200px",
            "scrollCollapse": true,
            "paging":         false
        });
// this function will get  info form database on click using ajax and then showing it to the modal
        $('#sections tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            console.log(data);
            $('#p_trackSection').text(data[1]);
            $('#trackSection').text(data[0]);
            $('#sectionModal').modal();
            //alert( 'You clicked on '+data[0]+'\'s row' );
        } );
    });
</script>