@include('ManageOrganiser.Partials.EventCreateAndEditJS')

{!! Form::model($event, array('url' => route('postEditEvent', ['event_id' => $event->id]), 'class' => 'ajax gf')) !!}

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('is_live', 'Visibility', array('class'=>'control-label required')) !!}
            {!!  Form::select('is_live', [
            '1' => 'Make event visible to the public.',
            '0' => 'Hide event from the public.'],null,
                                        array(
                                        'class'=>'form-control'
                                        ))  !!}
        </div>
        <div class="form-group">
            {!! Form::label('title', 'Title', array('class'=>'control-label required')) !!}
            {!!  Form::text('title', Input::old('title'),
                                        array(
                                        'class'=>'form-control',
                                        'placeholder'=>'E.g: '.Auth::user()->first_name.'\'s Interational Conference'
                                        ))  !!}
        </div>

        <div class="form-group">
           {!! Form::label('description', 'Description', array('class'=>'control-label')) !!}
            {!!  Form::textarea('description', Input::old('description'),
                                        array(
                                        'class'=>'form-control editable',
                                        'rows' => 5
                                        ))  !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Category', array('class'=>'control-label required')) !!}
            {!!  Form::select('category_id', ['' => 'Choose Category'] + $categories , $event->category_id , array('class'=>'form-control' ))  !!}
        </div>

        <div class="form-group address-automatic" style="display:{{$event->location_is_manual ? 'none' : 'block'}};">
            {!! Form::label('name', 'Venue Name', array('class'=>'control-label required ')) !!}
            {!!  Form::text('venue_name_full', Input::old('venue_name_full'),
                                        array(
                                        'class'=>'form-control geocomplete location_field',
                                        'placeholder'=>'E.g: The Crab Shack'
                                        ))  !!}

            <!--These are populated with the Google places info-->
            <div>
               {!! Form::hidden('formatted_address', $event->location_address, ['class' => 'location_field']) !!}
               {!! Form::hidden('street_number', $event->location_street_number, ['class' => 'location_field']) !!}
               {!! Form::hidden('country', $event->location_country, ['class' => 'location_field']) !!}
               {!! Form::hidden('country_short', $event->location_country_short, ['class' => 'location_field']) !!}
               {!! Form::hidden('place_id', $event->location_google_place_id, ['class' => 'location_field']) !!}
               {!! Form::hidden('name', $event->venue_name, ['class' => 'location_field']) !!}
               {!! Form::hidden('location', '', ['class' => 'location_field']) !!}
               {!! Form::hidden('postal_code', $event->location_post_code, ['class' => 'location_field']) !!}
               {!! Form::hidden('route', $event->location_address_line_1, ['class' => 'location_field']) !!}
               {!! Form::hidden('lat', $event->location_lat, ['class' => 'location_field']) !!}
               {!! Form::hidden('lng', $event->location_long, ['class' => 'location_field']) !!}
               {!! Form::hidden('administrative_area_level_1', $event->location_state, ['class' => 'location_field']) !!}
               {!! Form::hidden('sublocality', '', ['class' => 'location_field']) !!}
               {!! Form::hidden('locality', $event->location_address_line_1, ['class' => 'location_field']) !!}
            </div>
            <!-- /These are populated with the Google places info-->

        </div>

        <div class="address-manual" style="display:{{$event->location_is_manual ? 'block' : 'none'}};">
            <div class="form-group">
                {!! Form::label('location_venue_name', 'Venue Name', array('class'=>'control-label required ')) !!}
                {!!  Form::text('location_venue_name', $event->venue_name, [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>'E.g: The Crab Shack'
                            ])  !!}
            </div>
            <div class="form-group">
                {!! Form::label('location_address_line_1', 'Address Line 1', array('class'=>'control-label')) !!}
                {!!  Form::text('location_address_line_1', $event->location_address_line_1, [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>'E.g: 45 Grafton St.'
                            ])  !!}
            </div>
            <div class="form-group">
                {!! Form::label('location_address_line_2', 'Address Line 2', array('class'=>'control-label')) !!}
                {!!  Form::text('location_address_line_2', $event->location_address_line_2, [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>'E.g: Dublin.'
                            ])  !!}
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('location_state', 'City', array('class'=>'control-label')) !!}
                        {!!  Form::text('location_state', $event->location_state, [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>'E.g: Dublin.'
                            ])  !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('location_post_code', 'Post Code', array('class'=>'control-label')) !!}
                        {!!  Form::text('location_post_code', $event->location_post_code, [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>'E.g: 94568.'
                            ])  !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix" style="margin-top:-10px; padding: 5px; padding-top: 0px;">
            <span class="pull-right">
                or <a data-clear-field=".location_field" data-toggle-class=".address-automatic, .address-manual" data-show-less-text="{{$event->location_is_manual ? 'Enter Address Manually' : 'Select From Existing Venues'}}" href="javascript:void(0);" class="show-more-options clear_location">{{$event->location_is_manual ? 'Select From Existing Venues' : 'Enter Address Manually'}}</a>
            </span>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('start_date', 'Start Date', array('class'=>'required control-label')) !!}
                    @if($event->is_activity)
                    {!!  Form::text('start_date', $event->getFormattedDate('start_date', 'd-m-Y'),
                                                        [
                                                    'class'=>'form-control start hasDatepicker ',
                                                    'data-field'=>'date',
                                                    'data-startend'=>'start',
                                                    'data-startendelem'=>'.end',
                                                    'readonly'=>''

                                                ])  !!}
                    @else
                        {!!  Form::text('start_date', $event->getFormattedDate('start_date'),
                        [
                        'class'=>'form-control start hasDatepicker ',
                        'data-field'=>'datetime',
                        'data-startend'=>'start',
                        'data-startendelem'=>'.end',
                        'readonly'=>''

                        ])  !!}
                    @endif

                </div>
            </div>

            <div class="col-sm-6 ">
                <div class="form-group">
                    {!!  Form::label('end_date', 'End Date',
                                        [
                                    'class'=>'required control-label '
                                ])  !!}
                    @if($event->is_activity)
                    {!!  Form::text('end_date', $event->getFormattedDate('end_date', 'd-m-Y'),
                                                [
                                            'class'=>'form-control end hasDatepicker ',
                                            'data-field'=>'date' ,
                                            'data-startend'=>'end',
                                            'data-startendelem'=>'.start',
                                            'readonly'=>''
                                        ])  !!}
                    @else
                        {!!  Form::text('end_date', $event->getFormattedDate('end_date'),
                        [
                        'class'=>'form-control end hasDatepicker ',
                        'data-field'=>'datetime' ,
                        'data-startend'=>'end',
                        'data-startendelem'=>'.start',
                        'readonly'=>''
                        ])  !!}
                    @endif

                </div>
            </div>
        </div>

        @if($event->is_activity)
        <div class="form-group">
            {!!  Form::label('activity_weekdays', 'Days',
            [
            'class'=>'required control-label '
            ])  !!}

            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-xs btn-weekday @if(in_array(6, $event->weekdays_array())) active @endif">
                    <input type="checkbox" name="weekdays[]" value="6" autocomplete="off" @if(in_array(6, $event->weekdays_array())) checked @endif > Saturday
                </label>
                <label class="btn btn-xs btn-weekday @if(in_array(7, $event->weekdays_array())) active @endif">
                    <input type="checkbox" name="weekdays[]" value="7" autocomplete="off" @if(in_array(7, $event->weekdays_array())) checked @endif> Sunday
                </label>
                <label class="btn btn-xs btn-weekday @if(in_array(1, $event->weekdays_array())) active @endif">
                    <input type="checkbox" name="weekdays[]" value="1" autocomplete="off" @if(in_array(1, $event->weekdays_array())) checked @endif> Monday
                </label>
                <label class="btn btn-xs btn-weekday @if(in_array(2, $event->weekdays_array())) active @endif">
                    <input type="checkbox" name="weekdays[]" value="2" autocomplete="off" @if(in_array(2, $event->weekdays_array())) checked @endif> Tuesday
                </label>
                <label class="btn btn-xs btn-weekday @if(in_array(3, $event->weekdays_array())) active @endif">
                    <input type="checkbox" name="weekdays[]" value="3" autocomplete="off" @if(in_array(3, $event->weekdays_array())) checked @endif> Wednesday
                </label>
                <label class="btn btn-xs btn-weekday @if(in_array(4, $event->weekdays_array())) active @endif">
                    <input type="checkbox" name="weekdays[]" value="4" autocomplete="off" @if(in_array(4, $event->weekdays_array())) checked @endif> Thursday
                </label>
                <label class="btn btn-xs btn-weekday @if(in_array(5, $event->weekdays_array())) active @endif">
                    <input type="checkbox" name="weekdays[]" value="5" autocomplete="off" @if(in_array(5, $event->weekdays_array())) checked @endif> Friday
                </label>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('activity_start_time', 'Start Time', array('class'=>'required control-label')) !!}
                    {!!  Form::text('activity_start_time', substr($event->activity_start_time, 0, -3),
                    [
                    'class'=>'form-control start hasDatepicker ',
                    'data-field'=>'time',
                    'data-startend'=>'start',
                    'data-startendelem'=>'.end',
                    'readonly'=>''

                    ])  !!}
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    {!!  Form::label('activity_end_time', 'End Time',
                    [
                    'class'=>'required control-label '
                    ])  !!}

                    {!!  Form::text('activity_end_time', substr($event->activity_end_time, 0, -3),
                    [
                    'class'=>'form-control end hasDatepicker ',
                    'data-field'=>'time',
                    'data-startend'=>'end',
                    'data-startendelem'=>'.start',
                    'readonly'=> ''
                    ])  !!}
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                   {!! Form::label('event_image', 'Event Flyer', array('class'=>'control-label ')) !!}
                   {!! Form::styledFile('event_image', 1) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="float-l">
                    @if($event->images->count())
                    {!! Form::label('', 'Current Event Flyer', array('class'=>'control-label ')) !!}
                    <div class="form-group">
                        <div class="well well-sm well-small">
                           {!! Form::label('remove_current_image', 'Delete?', array('class'=>'control-label ')) !!}
                           {!! Form::checkbox('remove_current_image') !!}

                        </div>
                    </div>
                    <div class="thumbnail">
                       {!!HTML::image('/'.$event->images->first()['image_path'])!!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="panel-footer mt15 text-right">
           {!! Form::hidden('organiser_id', $event->organiser_id) !!}
           {!! Form::submit('Save Changes', ['class'=>"btn btn-success"]) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>

