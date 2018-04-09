<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 4/08/2018
 * Time: 9:27 PM
 */

$students = getAll('students',null,null,null);

?>

<div class="modal fade in" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModal" aria-hidden="true" style="display: none; padding-right: 16px;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="s_modalTitle">Click on a Section to Select it</h4>
            </div>
            <div class="modal-body" id="s_modalbody">

                <div class="table-responsive">
                    <table  id="t_students" width="100%" class="display table table-striped table-bordered table-hover">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Option</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($student = $students->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><?php echo $student['StudentID'] ?></td>
                                <td><?php echo $student['Firstname'] ?></td>
                                <td><?php echo $student['Lastname'] ?></td>
                                <td><?php echo $student['Email'] ?></td>
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
        var table = $('#t_students').DataTable({
            responsive: true,
            "scrollY":        "200px",
            "scrollCollapse": true,
            "paging":         false
        });

        var table2 = $('#students_queue').DataTable({
            responsive: true

        });

// this function will get  info form database on click using ajax and then showing it to the modal
        $('#t_students tbody ').on('click', 'button', function () {
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-warning');
            var dataT = table.row( $(this).parents('tr') ).data();
            var sectionId = $('#sID').val();
            console.log(dataT);
            console.log(sectionId);
            $.ajax({
                type: "POST",
                url: "../php/ajax/addStudent.php",
                data: { student_id: dataT[0],table:"studenttaketrack", section_id: sectionId},
                dataType: "json",
                success: function(data) {
                    console.log(dataT);
                    table2.row.add([
                        dataT[0],dataT[1],dataT[2], '<form method="post" action="studentEdit.php">\n' +
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