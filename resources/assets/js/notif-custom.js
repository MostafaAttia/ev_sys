$(document).ready(function(){
    $('#notifications').on('click', function(){

        if($(this).hasClass('has-notifications')) {
           $(this).removeClass('has-notifications');
        }

        $('.divider:last-of-type').remove();


    });
});