<div role="dialog"  class="modal fade" style="display: none;">
   {!! Form::open(array('url' => route('postCreateRowSpaces', array('row_id' => $row->id)), 'class' => 'ajax')) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-ticket"></i>
                    Add Spaces To Row <strong>{!! $row->row_name !!}</strong> 
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4">
                        {!! Form::label('starts_at', 'Space Starts At', array('class'=>' control-label required')) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('ends_at', 'Space Ends At', array('class'=>' control-label required')) !!}
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="spaces_wrapper">
                    <div class="row row_spaces">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!!  Form::number('starts_at[]', Input::old('starts_at'),
                                            array(
                                            'class'=>'form-control',
                                            'placeholder'=>'Start Column #',
                                            'min'=>'1',
                                            'pattern'=>' 0+\.[0-9]*[1-9][0-9]*$',
                                            'onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'
                                            )
                                )  !!}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!!  Form::number('ends_at[]', Input::old('ends_at'),
                                            array(
                                            'class'=>'form-control',
                                            'placeholder'=>'End Column #',
                                            'min'=>'1',
                                            'pattern'=>' 0+\.[0-9]*[1-9][0-9]*$',
                                            'onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'
                                            )
                                )  !!}
                            </div>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>

                    <div class="row new_space_row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-4">
                            <button id="add_new_space" class="btn btn-primary btn-xs">
                                <i class="ico-plus-sign"></i> New Space
                            </button>
                        </div>
                    </div>
                </div>


                

            </div> <!-- /end modal body-->

            <div class="modal-footer">
               {!! Form::button('Cancel', ['class'=>"btn modal-close btn-danger",'data-dismiss'=>'modal']) !!}
               {!! Form::submit('Create Spaces', ['class'=>"btn btn-success"]) !!}
            </div>
        </div><!-- /end modal content-->
       {!! Form::close() !!}
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
                var spaces_max_fields      = 50; 
                var spaces_wrapper         = $(".spaces_wrapper");
                var spaces_add_button      = $("#add_new_space");

                var x = 1; 
                $(spaces_add_button).click(function(e){
                    e.preventDefault();
                    if(x < spaces_max_fields){ 
                        x++; 
                        $('.new_space_row').before("<div class='row row_spaces'>"+
                            '<div class="col-sm-2"></div>'+
                            '<div class="col-sm-4">'+
                                "<div class='form-group'>"+
                                "<input type='number' name='starts_at[]' class='form-control' pattern='0+\.[0-9]*[1-9][0-9]*$' min='1' placeholder='Start Column #' onkeypress='return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'>"+
                                "</div>"+
                            "</div>"+
                            '<div class="col-sm-4">'+
                                "<div class='form-group'>"+
                                "<input type='number' name='ends_at[]' class='form-control' pattern='0+\.[0-9]*[1-9][0-9]*$' min='1' placeholder='End Column #' onkeypress='return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'>"+
                                "</div>"+
                            "</div>"+
                            "<div class='col-sm-2'></div>"+
                            "<a href='#' class='remove_field'> Remove </a>"+
                            "</div>");

                    }
                });

                $(spaces_wrapper).on("click",".remove_field", function(e){
                    e.preventDefault();
                    $(this).closest('div').remove();
                    x--;
                });

        });
    </script>



</div>