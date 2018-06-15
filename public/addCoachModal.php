<?php
/**
 * Created by PhpStorm.
 * User: jeanp
 * Date: 4/14/2018
 * Time: 8:40 AM
 * This File is the Modal to Add Coaches to the DB.
 * It uses AJAx to connect to the DB.
 */

$coaches = getAll('rwccoach',null,null,null);

?>

<div class="modal fade in" id="coachModal" tabindex="-1" role="dialog" aria-labelledby="coachModal" aria-hidden="true" style="display: none; padding-right: 16px;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="s_modalTitle">Click on a Coach to Select it</h4>
            </div>
            <div class="modal-body" id="s_modalbody">

                <div class="table-responsive">
                    <table  id="t_coaches" width="100%" class="display table table-striped table-bordered table-hover">

                        <thead>
                        <tr>
                            <th>Option</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Language Skill</th>


                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($coach = $coaches->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><button class="btn btn-primary">Add</button></td>
                                <td><?php echo $coach['CoachID'] ?></td>
                                <td><?php echo $coach['Firstname'] ?></td>
                                <td><?php echo $coach['Lastname'] ?></td>
                                <td><?php echo $coach['Email'] ?></td>
                                <td><?php echo implode(", ",unserialize($coach['LanguageSkill']))  ?></td>


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
        //this is the modal table

        var track_sectionId = $('#sID').val(); //This is the Track Section Section ID to store in the rwcteachtrack table
        var trackId = $('#trackID').val(); //This is the Track ID needed to pull info from track table

        var table = $('#t_coaches').DataTable({
            responsive: true,
            "scrollY":        "200px",
            "scrollCollapse": true,
            "paging": false,
            "columnDefs": [
                {
                    "targets": [ 1 ],
                    "visible": false

                }
                ]
        });
        //This is the main page table
        var table2 = $('#coaches_queue').DataTable({
            responsive: true,
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false

                }
            ]

        });

// this function will get  info form database on click using ajax and then showing it to the modal
        $('#t_coaches tbody ').on('click', 'button', function () {
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-warning');
            var dataT = table.row( $(this).parents('tr') ).data();
            var row = table.row( $(this).parents('tr') );
            //console.log(dataT);
            //console.log(sectionId);
            $.ajax({
                type: "POST",
                url: "../php/ajax/addCoach.php",
                data: { coach_id: dataT[1],table:"rwccoachteachtrack", track_section_id: track_sectionId, trackId: trackId},
                dataType: "json",
                success: function(data) {
                    //console.log(dataT);
                        table2.row.add([
                        dataT[1],dataT[2],dataT[3],dataT[4], '<button type="submit" class="btn btn-warning" name="remove">Remove</button>']
                    ).draw();
                    row.remove().draw();
                }});

            //$('#trackModal').modal('toggle');
            //alert( 'You clicked on '+data[0]+'\'s row' );
        });

        $('#coaches_queue tbody').on('click', 'button', function(){
            var coachData = table2.row( $(this).parents('tr') ).data();
            var row2 = table2.row( $(this).parents('tr') );


            $.ajax({
                type: "POST",
                url: "../php/ajax/remove.php",
                data: {coach_id:coachData[0], table: "rwccoachteachtrack", track_section_id: track_sectionId, trackId: trackId },
                success: function (data) {
                    console.log("testing");
                    row2.remove().draw();
                }
            })

        })

    });
</script>
