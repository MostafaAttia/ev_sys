$(document).ready(function(){

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    var route = $('#route').attr('data-route');

    $('.client-inputs').on('change', function(event) {
        var thisInput = $(this);
        var name = $(this).attr('name');
        var value = this.value;
        $.post(route, { [name] : value } ).done(function( data ) {
            if(data.status === 'success') {
                thisInput.parent('div').addClass('has-success');
                thisInput.next('.error-help').hide();
            } else {
                thisInput.parent('div').addClass('has-error');
                thisInput.next('.error-help').show().html(data.message['0']);
            }
        });

    });

    $('#clientdob').on('dp.change', function(e) {
        var thisInput = $(this);
        var name = $(this).attr('name');
        var value = e.date.format(e.date._f);
        $.post(route, { [name] : value } ).done(function( data ) {
            $('#clientdob').parent('div').addClass('has-success');
            if(data.status === 'success') {
                thisInput.parent('div').addClass('has-success');
                thisInput.next('.error-help').hide();
            } else {
                thisInput.parent('div').addClass('has-error');
                thisInput.next('.error-help').show().html(data.message['0']);
            }
        });

    });



});