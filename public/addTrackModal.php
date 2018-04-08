<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/23/2018
 * Time: 9:42 PM
 */

$tracks = getAll('track',null,null,null);

?>

<div class="modal fade in" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="trackModal" aria-hidden="true" style="display: none; padding-right: 16px;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="s_modalTitle">Click on a Section to Select it</h4>
            </div>
            <div class="modal-body" id="s_modalbody">

                <div class="table-responsive">
                    <table  id="tracks" width="100%" class="display table table-striped table-bordered table-hover">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Option</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($track = $tracks->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><?php echo $track['TrackID'] ?></td>
                                <td><?php echo $track['Title'] ?></td>
                                <td><?php echo $track['Description'] ?></td>
                                <td><button class="btn btn-primary">Add</button></td>

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
        var table = $('#tracks').DataTable({
            responsive: true,
            "scrollY":        "200px",
            "scrollCollapse": true,
            "paging":         false
        });

        var table2 = $('#tracks_queue').DataTable({
            responsive: true,

        });

// this function will get  info form database on click using ajax and then showing it to the modal
        $('#tracks tbody ').on('click', 'button', function () {
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-warning');
            var dataT = table.row( $(this).parents('tr') ).data();
            var sectionId = $('#sID').val();

            console.log(sectionId);
            $.ajax({
                type: "POST",
                url: "../php/addTrack.php",
                data: { track_id: dataT[0],table:"trackhassection", section_id: sectionId},
                dataType: "json",
                success: function(data) {
                    console.log(dataT);
                    table2.row.add([
                            dataT[0],dataT[1],dataT[2], '<form method="post" action="trackEdit.php">\n' +
                                                        '<input type="submit" class="btn btn-warning" name="action" value="Edit">\n' +
                                                        '<input type="hidden" name="id" value="'+dataT[0]+'">\n' +
                                                        '</form>']
                    ).draw();
                }});





            //$('#trackModal').modal('toggle');
            //alert( 'You clicked on '+data[0]+'\'s row' );
        } );

        });
</script>