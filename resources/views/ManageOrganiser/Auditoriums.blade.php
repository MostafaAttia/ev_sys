@extends('Shared.Layouts.Master')

@section('title')
    @parent
    Auditoriums
@stop

@section('top_nav')
    @include('ManageOrganiser.Partials.TopNav')
@stop

@section('page_title')
    <i class="ico-ticket mr5"></i>
    Auditoriums
@stop

@section('head')
    {{-- Style For Seats Map --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    {!! HTML::style(config('attendize.cdn_url_static_assets').'/assets/stylesheet/jquery.seat-charts.css') !!}
    <!--/Style-->
@stop

@section('menu')
    @include('ManageOrganiser.Partials.Sidebar')
@stop

@section('page_header')
    <div class="col-md-9">
        <!-- Toolbar -->
        <div class="btn-toolbar" role="toolbar">

            <div class="btn-group btn-group-responsive">
                <button data-modal-id='CreateTicket'
                        data-href="{{route('showCreateAuditorium', array('organiser_id'=>$organiser->id))}}"
                        class='loadModal btn btn-success' type="button"><i class="ico-ticket"></i> Create Auditorium
                </button>
            </div>

        </div>
        <!--/ Toolbar -->
    </div>
    
@stop

@section('content')
    @if($auditoriums->count())
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <div class='order_options'>
                    <span class="event_count">{{$auditoriums->count()}} auditoriums</span>
                </div>
            </div>
        </div>
    @endif
    <!--Start auditorium table-->
    <div class="row sortable">
        @if($auditoriums->count())

            @foreach($auditoriums as $auditorium)
                <div id="auditorium_{{$auditorium->id}}" class="col-md-4 col-sm-6 col-xs-12">
                    
                    <div class="panel panel-success ticket" data-ticket-id="{{$auditorium->id}}">
                        <div style="cursor: pointer;" data-modal-id='auditorium-{{ $auditorium->id }}'
                             data-href="{{ route('previewAuditorium', ['organiser_id' => $organiser->id, 'auditorium_id' => $auditorium->id]) }}"
                             class="panel-heading loadModal">
                            <h3 class="panel-title">
                                <i class="ico-ticket ticket_icon mr5 ellipsis"></i>
                                {{$auditorium->name}}
                                <span class="pull-right">
                                    {{ ($auditorium->is_public) ? "PUBLIC" : "PRIVATE" }}
                                </span>
                            </h3>
                        </div>
                        <div class='panel-body'>
                            <ul class="nav nav-section nav-justified mt5 mb5">
                                <li>
                                    <div class="section">
                                        <h4 class="nm">{{ $auditorium->seats_no }}</h4>

                                        <p class="nm text-muted">Seats</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="section">
                                        <h4 class="nm">
                                            {{ $auditorium->rows_no }}
                                        </h4>

                                        <p class="nm text-muted">Rows</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="section">
                                        <h4 class="nm">
                                            {{ $auditorium->columns_no }}
                                        </h4>
                                        <p class="nm text-muted">Columns</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="panel-footer" style="height: 56px;">
                            <ul class="nav nav-section nav-justified text-center mt5">
                                 <li>
                                    {!! Form::open(['action'=> ['OrganiserAuditoriumsController@deleteAuditorium', $organiser->id, $auditorium->id], 'class' => 'ajax' ]) !!}
                                        {!! Form::button('<i class="ico-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger'] )  !!}
                                    {!! Form::close() !!}
                                </li>
                                <li>
                                    <button data-href="{{ route('previewAuditorium', ['organiser_id' => $organiser->id, 'auditorium_id' => $auditorium->id]) }}"
                                            class='loadModal btn btn-xs btn-success' type="button"><i class="ico-eye6"></i> Preview
                                    </button>
                                </li>
                                <li>
                                    <button id="customize_aud_{{$auditorium->id}}" class='customize_aud btn btn-xs btn-info' data-container="body" data-toggle="popover" data-placement="top">
                                        <a role="button" href="{{route('showCustomizeAuditorium', array('organiser_id' => $organiser->id, 'auditorium_id' => $auditorium->id)) }}" > <i class="ico-cogs" ></i> Customize
                                        </a>
                                    </button>
                                </li>
                            </ul>
                        </div>

                    </div>


                </div>
            @endforeach
        @else
            @include('ManageOrganiser.Partials.AuditoriumsBlankSlate')
        @endif
    </div><!--/ end auditorium table-->

    @if(session()->has('customizeAuditorium'))
        {{-- <script>showMessage('{{\Session::get('customizeAuditorium')}}');</script>  --}}
        <script>
            $(document).ready(function () {

                $("#customize_aud_{{session()->get('aud_id')}}").popover({
                    placement: 'top',
                    container: 'body',
                    html: true,
                    template : '<div class="popover" role="tooltip">'+
                    '<div class="arrow">'+
                    '</div>'+
                    '<h3 class="popover-title"></h3>'+
                    '<div class="popover-content">'+
                    '</div>'+
                    '</div>',
                    content: '<i class="ico-info-sign"></i> Now you can add <strong>empty spaces</strong> between seats, or multiple spaces as a passage <i class="ico-road"></i>'
                }).popover('show');
                
                $("#customize_aud_{{session()->get('aud_id')}}").on('shown.bs.popover', function () {

                    setTimeout(function() {
                        $('.popover').fadeOut('slow'); 
                    },5000);

                });
                
                

            });
        </script>
    @endif
    
@stop

@section('foot')
    <!--JS for seats map-->
    {!! HTML::script('assets/javascript/jquery.seat-charts.js') !!}
@stop
