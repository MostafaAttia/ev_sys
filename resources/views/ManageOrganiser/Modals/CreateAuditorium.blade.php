<div role="dialog"  class="modal fade" style="display: none;">
   {!! Form::open(array('url' => route('postCreateAuditorium', array('organiser_id' => $organiser->id)), 'class' => 'ajax')) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-ticket"></i>
                    Create Auditorium</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('name', 'Auditorium Name', array('class'=>'control-label required')) !!}
                            {!!  Form::text('name', Input::old('name'),
                                        array(
                                        'class'=>'form-control',
                                        'placeholder'=>'E.g: National Theater'
                            ))  !!}
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('seats_no', 'Number of Seats', array('class'=>'control-label required')) !!}
                                    {!!  Form::number('seats_no', Input::old('seats_no'),
                                                array(
                                                'class'=>'form-control',
                                                'placeholder'=>'E.g: 600',
                                                'min'=>'1',
                                                'pattern'=>' 0+\.[0-9]*[1-9][0-9]*$',
                                                'onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'
                                    ))  !!}


                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('rows_no', 'Number of Rows', array('class'=>' control-label required')) !!}
                                    {!!  Form::number('rows_no', Input::old('rows_no'),
                                                array(
                                                'class'=>'form-control',
                                                'placeholder'=>'E.g: 20 ',
                                                'min'=>'1',
                                                'pattern'=>' 0+\.[0-9]*[1-9][0-9]*$',
                                                'onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'
                                                )
                                    )  !!}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('columns_no', 'Number of Columns', array('class'=>' control-label required')) !!}
                                    {!!  Form::number('columns_no', Input::old('columns_no'),
                                                array(
                                                'class'=>'form-control',
                                                'placeholder'=>'max number of seats per row',
                                                'min'=>'1',
                                                'pattern'=>' 0+\.[0-9]*[1-9][0-9]*$',
                                                'onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'
                                                )
                                    )  !!}
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            {!! Form::label('is_public', 'Make it public for other Organisers to use ?', array('class'=>'control-label required')) !!}
                            {!!  Form::select('is_public', ['0'=>'No, Only Me', '1'=>'Yes' ] , Input::old('is_public') , array('class'=>'form-control' ))  !!}
                        </div>

                        <div class="seat-rows">
                            <h4>Seat Rows</h4>
                            <fieldset class="row-fieldset">
                                <div class="form-group">
                                    
                                    {!! Form::label('row_name', 'Row Name', array('class'=>' control-label required')) !!}
                                    {!!  Form::text('row_name[]', Input::old('row_name'),
                                                array(
                                                'class'=>'form-control',
                                                'placeholder'=>'One Character like A, B, C,.. OR 1, 2, 3,..',
                                                'maxlength'=>'1'
                                                )
                                    )  !!}
                                </div>

                                <div class="form-group">
                                    
                                    {!! Form::label('row_seats_no', 'Row Seats Number', array('class'=>' control-label required')) !!}
                                    {!!  Form::number('row_seats_no[]', Input::old('row_seat_no'),
                                                array(
                                                'class'=>'form-control',
                                                'placeholder'=>'Number of seats in this row',
                                                'min'=>'1',
                                                'pattern'=>' 0+\.[0-9]*[1-9][0-9]*$',
                                                'onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'
                                                )
                                    )  !!}
                                </div>

                                <div class="form-group">
                                    
                                    {!! Form::label('seat_price', 'Seat Price', array('class'=>' control-label required')) !!}
                                    {!!  Form::number('seat_price[]', Input::old('seat_price'),
                                                array(
                                                'class'=>'form-control',
                                                'placeholder'=>'Price of a seat in this row',
                                                'min'=>'1',
                                                'pattern'=>' 0+\.[0-9]*[1-9][0-9]*$',
                                                'onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'
                                                )
                                    )  !!}
                                </div>

                                <div class="form-group">
                                    
                                    {!! Form::label('category', 'Category', array('class'=>' control-label required')) !!}
                                    {!!  Form::text('category[]', Input::old('category'),
                                                array(
                                                'class'=>'form-control',
                                                'placeholder'=>'e.g First Class'
                                                )
                                    )  !!}
                                </div>

                            </fieldset>

                            <button id="add_new_row" class="btn btn-primary btn-sm">
                                <i class="ico-plus-sign"></i> New Row
                            </button>
                        </div><!-- /end seat rows-->
                        
                    </div><!-- /end col-md-12-->
                </div><!-- /end row-->
            </div> <!-- /end modal body-->

            <div class="modal-footer">
               {!! Form::button('Cancel', ['class'=>"btn modal-close btn-danger",'data-dismiss'=>'modal']) !!}
               {!! Form::submit('Create Auditorium', ['class'=>"btn btn-success"]) !!}
            </div>
        </div><!-- /end modal content-->
       {!! Form::close() !!}
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
                var rows_max_fields      = 100; 
                var rows_wrapper         = $(".seat-rows");
                var rows_add_button      = $("#add_new_row");

                var x = 1; 
                $(rows_add_button).click(function(e){ 
                    e.preventDefault();
                    if(x < rows_max_fields){ 
                        x++; 
                        $(rows_add_button).before("<div><fieldset class='row-fieldset'>"+
                            "<div class='form-group'>"+
                            '<label for="row_name" class="control-label required">Row Name</label>'+
                            '<input type="text" name="row_name[]" class="form-control" maxlength="1" placeholder="One Character like A, B, C,.. OR 1, 2, 3,..">'+
                            "</div>"+
                            "<div class='form-group'>"+
                            "<label for='row_seats_no' class='control-label required'>Row Seats Number</label>"+
                            "<input type='number' name='row_seats_no[]' class='form-control' pattern='0+\.[0-9]*[1-9][0-9]*$' min='1' placeholder='Number of seats in this row' onkeypress='return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'>"+
                            "</div>"+
                            "<div class='form-group'>"+
                            '<label for="seat_price" class="control-label required">Seat Price</label>'+
                            '<input type="number" name="seat_price[]" class="form-control" pattern="0+\.[0-9]*[1-9][0-9]*$" min="1" placeholder="Price of a seat in this row" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57">'+
                            "</div>"+
                            "<div class='form-group'>"+
                            '<label for="category" class="control-label required">Category</label>'+
                            '<input type="text" name="category[]" class="form-control" placeholder="e.g Economy Class">'+
                            "</div>"+
                            "<a href='#' class='remove_field'>Remove</a></fieldset></div>"); 

                    }
                });

                $(rows_wrapper).on("click",".remove_field", function(e){ 
                    e.preventDefault();
                    $(this).closest('div').remove();
                    x--;
                });

        });
    </script>


</div>

