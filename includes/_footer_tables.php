<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/9/2018
 * Time: 9:26 PM
 */
?>

<!-- /#wrapper -->

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>


<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/b-print-1.5.1/r-2.2.1/sl-1.2.5/datatables.min.css"/>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/b-print-1.5.1/r-2.2.1/sl-1.2.5/datatables.min.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>


<script>
    $(document).ready(function() {
        var table = $('#coaches').DataTable({

            responsive: true,
            dom: 'Bflrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            });
// this function will get  info form datadabe on click using ajax and then showing it to the modal
        $('#coaches tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();

            $.ajax({
                type: "POST",
                url: "../php/getUser.php",
                data: { user_id: data[0]},
                dataType: "json",
                success: function(data) {
                    //and from data you can retrive your user details and show them in the modal
                    $('#myModal').modal();
                    $('#myModalLabel').text(data['Firstname']+""+data['Lastname']);
                    $('#modal_email').text(data['Email']);
                    $('#modal_gender').text(data['Gender']);
                    $('#modal_phone').text(data['Phone']);
                    $('#modal_level').text(data['Level']);
                    $('#modal_language').text(data['LanguageSkill']);
                    console.log(data);
                }});


            //alert( 'You clicked on '+data[0]+'\'s row' );
        } );
    });
</script>

</body>

</html>
