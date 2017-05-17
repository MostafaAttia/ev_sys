@extends('Shared.Layouts.Master')

@section('title')
    @parent
    Customize Auditorium
@stop

@section('top_nav')
    @include('ManageOrganiser.Partials.TopNav')
@stop

@section('page_title')
    <i class="ico-cogs mr5"></i>
    Customize {{ $auditorium->name }}
    <button data-href="{{ route('previewAuditorium', ['organiser_id' => $organiser->id, 'auditorium_id' => $auditorium->id]) }}" class='loadModal btn btn-default pull-right' type="button">
            <i class="ico-eye6"></i> Preview
    </button>
@stop

@section('head')
    <!--JS-->
    {!! HTML::script(config('attendize.cdn_url_static_assets').'/assets/javascript/datatables.min.js') !!}
    <!--/JS-->
    <!--Style-->
    {!! HTML::style(config('attendize.cdn_url_static_assets').'/assets/stylesheet/datatables.min.css') !!}
    <!--/Style-->

     {{-- Style For Seats Map --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    {!! HTML::style(config('attendize.cdn_url_static_assets').'/assets/stylesheet/jquery.seat-charts.css') !!}
    <!--/Style-->
@stop

@section('menu')
    @include('ManageOrganiser.Partials.Sidebar')
@stop


@section('content')

    <div class="row add_space_all">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <h5><i class="ico-road"></i> Add an Empty Space Between Two Columns for <strong>ALL ROWS</strong> (as a passage or path), This works <strong>ONLY</strong> for symmetric auditorium (when rows have the same number of seats)</h5>
            {!! Form::open(array('url' => route('postCreateAllSpaces', array('organiser_id' => $organiser->id,'auditorium_id' => $auditorium->id)), 'class' => 'form-inline ajax')) !!}
              <div class="form-group">
                {!! Form::label('starts_at', 'Starts after', array('class'=>' control-label required')) !!}
                {!!  Form::number('starts_at', Input::old('starts_at'),
                                                            array(
                                                            'class'=>'form-control',
                                                            'placeholder'=>'Start Column #',
                                                            'min'=>'1',
                                                            'pattern'=>' 0+\.[0-9]*[1-9][0-9]*$',
                                                            'onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'
                                                            )
                                                )  !!}
              </div>
              <div class="form-group">
                {!! Form::label('ends_at', 'Ends before', array('class'=>' control-label required')) !!}
                {!!  Form::number('ends_at', Input::old('ends_at'),
                                                            array(
                                                            'class'=>'form-control',
                                                            'placeholder'=>'End Column #',
                                                            'min'=>'1',
                                                            'pattern'=>' 0+\.[0-9]*[1-9][0-9]*$',
                                                            'onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'
                                                            )
                                                )  !!}
              </div>
              <button type="submit" class="btn btn-info"><i class="ico-road"></i> Add Space</button>
              {!! Form::close() !!}
            <br><br>
            <h6>
                <i class="ico-info-sign"></i> OR You can add empty spaces (i.e empty seats) for a <strong>SINGLE ROW</strong> 
                in the table below <i class="ico-point-down"></i> 
            </h6>
        </div>
        <div class="col-sm-2"></div>
    </div>
    
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            
            <table id="auditorium_rows" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th> Name </th>
                        <th> Seats # </th>
                        <th> Seat Price</th>
                        <th> Add Spaces </th>
                        <th> Delete </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($rows as $row)
                        <tr>
                            <th> {{ $row->row_name }} </th>
                            <th> {{ $row->row_seats_no }} </th>
                            <th> {{ $row->seat_price }} </th>
                            <th>
                                <button data-href="{{route('postCreateRowSpaces', array('row_id'=>$row->id))}}"
                                    class='loadModal btn btn-xs btn-info' type="button"><i class="ico-plus-sign"></i> Add Spaces
                                </button>
                            </th>
                            <th>
                                {!! Form::open(['action'=> ['OrganiserAuditoriumsController@deleteAuditoriumRow', $row->id], 'class' => 'ajax' ]) !!}
                                    {!! Form::button('<i class="ico-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger'] )  !!}
                                {!! Form::close() !!}
                            </th>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
        <div class="col-sm-2"></div>
    </div>

    <script type="text/javascript">
        
        $(document).ready(function() {
            $('#auditorium_rows').DataTable({
                scrollY: 300,
                paging: false
            });
        } );

    </script>

@stop

@section('foot')
    <!--JS for seats map-->
    {!! HTML::script('assets/javascript/jquery.seat-charts.js') !!}
@stop

