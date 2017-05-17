<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organiser;
use App\Models\Ticket;
use App\Models\Auditorium;
use App\Models\SeatRow;
use App\Models\RowSpace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;

use Validator;


class OrganiserAuditoriumsController extends MyBaseController
{
	/**
     * @param Request $request
     * @param $event_id
     * @return mixed
     */
    public function showOrganiserAuditoriums($organiser_id)
    {
        
        // Find organiser or return 404 error.
        $organiser = Organiser::scope()->find($organiser_id);
        if ($organiser === null) {
            abort(404);
        }

        $auditoriums = Auditorium::where('organiser_id', '=', $organiser_id)->get();

       
        // Return view.
        return view('ManageOrganiser.Auditoriums', compact('organiser', 'auditoriums'));

       
    }

    /**
     * Show the create ticket modal
     *
     * @param $event_id
     * @return \Illuminate\Contracts\View\View
     */
    public function showCreateAuditorium($organiser_id)
    {
        return view('ManageOrganiser.Modals.CreateAuditorium', [
            'organiser' => Organiser::scope()->find($organiser_id),
        ]);
    }


    /**
     * Creates an Auditorium
     *
     * @param $event_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateAuditorium(Request $request, $organiser_id)
    {
        // Find organiser or return 404 error.
        $organiser = Organiser::scope()->find($organiser_id);
        if ($organiser === null) {
            abort(404);
        }

        $auditorium = Auditorium::createNew(false, false, true); 

        if (!$auditorium->validate($request->all())) {
            return response()->json([
                'status'   => 'error',
                'messages' => $auditorium->errors(),
            ]);
        }

        $auditorium->name = $request->get('name');
        $auditorium->seats_no = $request->get('seats_no');
        $auditorium->rows_no = $request->get('rows_no');
        $auditorium->columns_no = $request->get('columns_no');
        $auditorium->organiser_id = $organiser->id;
        $auditorium->account_id = $organiser->account_id;
        $auditorium->is_public = $request->get('is_public');

        $auditorium->save();

        foreach ($request->get('row_name') as $key => $value) {
            $seatRow = new SeatRow();

            if (!$seatRow->validate($request->only('row_name', 'row_seats_no', 'seat_price', 'category'), [
                    'row_name.*'          => ['required'],
                    'row_seats_no.*'      => ['required', 'numeric'],
                    'seat_price.*'        => ['required', 'numeric'],
                    'category.*'          => ['required'],
                ])) {

                return response()->json([
                    'status'   => 'error',
                    'messages' => $seatRow->errors(),
                ]);
            }

            $seatRow->auditorium_id = $auditorium->id;
            $seatRow->row_name = $request->get('row_name')[$key];
            $seatRow->row_seats_no = $request->get('row_seats_no')[$key];
            $seatRow->seat_price = $request->get('seat_price')[$key];
            $seatRow->category = $request->get('category')[$key];

            $seatRow->save();
        }

        session()->flash('message', 'Auditorium Created Successfully!');
        session()->flash('customizeAuditorium', 'Now you can add empty spaces between seats from here!');
        session()->put('aud_id', $auditorium->id);

        return response()->json([
            'status'      => 'success',
            'id'          => $auditorium->id,
            'message'     => 'Refreshing...',
            'redirectUrl' => route('showOrganiserAuditoriums', [
                'organiser_id' => $organiser_id,
            ]),
        ]);
        
    }

    /**
     * Preview auditorium 
     *
     * @param $event_id
     * @return \Illuminate\Contracts\View\View
     */
    public function previewAuditorium($organiser_id, $auditorium_id)
    {

    	$auditorium = Auditorium::findOrFail($auditorium_id);
        return view('ManageOrganiser.Modals.previewAuditorium', $auditorium->mapFields);
        
    }


    /**
     * Delete Auditorium
     *
     * @param $auditorium_id
     * @return \Illuminate\Contracts\View\View
     */
    public function deleteAuditorium($organiser_id, $auditorium_id)
    {

        $auditorium = Auditorium::findOrFail($auditorium_id);

        if($auditorium->delete()){

            session()->flash('message',  "$auditorium->name Deleted Successfully!");

            return response()->json([
                'status'      => 'success',
                'id'          => $auditorium->id,
                'message'     => 'Refreshing...',
                'redirectUrl' => route('showOrganiserAuditoriums', [
                    'organiser_id' => $organiser_id,
                ]),
            ]);
        }

        session()->flash('message', 'Auditorium Not Found');

            return response()->json([
                'status'      => 'success',
                'message'     => 'Refreshing...',
                'redirectUrl' => route('showOrganiserAuditoriums', [
                    'organiser_id' => $organiser_id,
                ]),
            ]);

        
    }


    /**
     * Show customize Auditorium to add spaces
     *
     * @param $event_id
     * @return \Illuminate\Contracts\View\View
     */
    public function showCustomizeAuditorium($organiser_id, $auditorium_id)
    {
        $organiser = Organiser::scope()->find($organiser_id);
        if ($organiser === null) {
            abort(404);
        }
        $auditorium = Auditorium::scope()->find($auditorium_id);
        $rows = $auditorium->seatRows;
        return view('ManageOrganiser.Auditoriums.CustomizeAuditorium', compact('organiser','auditorium', 'rows'));
    }



    /**
     * Show the create Spaces modal
     *
     * @param $event_id
     * @return \Illuminate\Contracts\View\View
     */
    public function showCreateSpaces($row_id)
    {
        $row = SeatRow::findOrFail($row_id);

        return view('ManageOrganiser.Modals.CreateSpaces', compact('row'));
    }

    /**
     * Creates Spaces for a single Row
     *
     * @param $row_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateRowSpaces(Request $request, $row_id)
    {
        $row = SeatRow::findOrFail($row_id);

        $auditorium = Auditorium::scope()->find($row->auditorium_id);
        
        foreach($request->get('starts_at') as $key => $spaceStart){
            $space = new RowSpace();

            if (!$space->validate($request->all())) {
                return response()->json([
                    'status'   => 'error',
                    'messages' => $space->errors(),
                ]);
            }

            $space->row_id      = $row_id;
            $space->starts_at   = $request->get('starts_at')[$key];
            $space->ends_at     = $request->get('ends_at')[$key];

            $space->save();

        }

        session()->flash('message', "Spaces for row $row->row_name Successfully Created!");

        return response()->json([
            'status'      => 'success',
            'message'     => 'Creating Spaces...',
            'redirectUrl' => route('showCustomizeAuditorium', [
                'organiser_id' => $auditorium->organiser_id,
                'auditorium_id' => $auditorium->id
            ]),
        ]);

        
    }

    /**
     * Creates Spaces for all Rows at once
     *
     * @param $auditorium_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateAllSpaces(Request $request, $auditorium_id)
    {
        $auditorium = Auditorium::scope()->find($auditorium_id);
        $rows = $auditorium->seatRows;

        foreach ($rows as $row) {
            $space = new RowSpace();

            if (!$space->validate($request->all())) {
                return response()->json([
                    'status'   => 'error',
                    'messages' => $space->errors(),
                ]);
            }

            $space->row_id = $row->id;
            $space->starts_at = $request->get('starts_at');
            $space->ends_at = $request->get('ends_at');
            
            $space->save();

        }

        session()->flash('message', "Row Spaces for $auditorium->name Successfully Added!");

        return response()->json([
            'status'      => 'success',
            'message'     => 'Refreshing...',
            'redirectUrl' => route('showCustomizeAuditorium', [
                'organiser_id' => $auditorium->organiser_id,
                'auditorium_id' => $auditorium_id
            ]),
        ]);

        
    }

    /**
     * Delete Auditorium
     *
     * @param $auditorium_id
     * @return \Illuminate\Contracts\View\View
     */
    public function deleteAuditoriumRow($row_id)
    {

        $row = SeatRow::findOrFail($row_id);
        $auditorium = Auditorium::scope()->find($row->auditorium_id);

        if($row->delete()){
            session()->flash('message',  "Row $row->name Deleted Successfully!");
        }

        session()->flash('message', 'Row Not Found');

        return response()->json([
            'status'      => 'success',
            'message'     => 'Refreshing...',
            'redirectUrl' => route('showCustomizeAuditorium', [
                'organiser_id' => $auditorium->organiser_id,
                'auditorium_id' => $auditorium->id
            ]),
        ]);

        
    }

    



}