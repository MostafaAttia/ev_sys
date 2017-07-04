/**
 * Created by mostafa on 19/12/16.
 */

$(document).ready(function() {

    $('#adminsTable').DataTable({
        select: true,
        responsive: true,
        fixedHeader: true,
        colReorder: true,
        dom: 'Bfrtip',
        buttons: [
            'print', 'csv', 'excel', 'pdf'
        ]

    });


    $("#success-alert").fadeTo(3000, 500).slideUp(3000, function(){
        $("#success-alert").slideUp(3000);
    });

    $('[data-toggle="tooltip"]').tooltip();

    // Add active class to Sidebar menu
    $.AdminLTE.dinamicMenu = function() {
        var url = window.location;
        //$('.treeview-menu li a[href="' + url + '"]').parent().addClass('active');
        $('.treeview-menu li a[href="' + url + '"]').addClass('active');
        $('.treeview-menu li a').filter(function() {
            return this.href == url;
        }).parent().parent().parent().addClass('active');
    }();

} );
