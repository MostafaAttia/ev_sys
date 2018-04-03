<?php

namespace App\Http\Controllers;

use App\Models\Organiser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class OrganiserController extends MyBaseController
{

    /**
     * Get latest 10 unread notifications as array
     */
    public function notifications($organiser_id)
    {
        $organiser = Organiser::scope()->findOrFail($organiser_id);
        return $organiser->unreadNotifications()->limit(10)->get()->toArray();
    }

    /**
     * Mark all organiser notifications as read
     */
    public function markAllNotificationsAsRead($organiser_id)
    {
        $organiser = Organiser::scope()->findOrFail($organiser_id);
        $notifications = $organiser->notifications()->where('read_at', null)->get();
        foreach($notifications as $notification){
            $notification->markAsRead();
        }
    }

    /**
     * Show the select organiser page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showSelectOrganiser()
    {
        return view('ManageOrganiser.SelectOrganiser');
    }

    /**
     * Show the create organiser page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showCreateOrganiser()
    {
        return view('ManageOrganiser.CreateOrganiser');
    }

    /**
     * Create the organiser
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateOrganiser(Request $request)
    {
        $organiser = Organiser::createNew(false, false, true);

        if (!$organiser->validate($request->all())) {
            return response()->json([
                'status'   => 'error',
                'messages' => $organiser->errors(),
            ]);
        }

        $organiser->name = $request->get('name');
        $organiser->about = $request->get('about');
        $organiser->email = $request->get('email');
        //$organiser->has_auditorium = $request->get('has_auditorium');
        $organiser->facebook = $request->get('facebook');
        $organiser->twitter = $request->get('twitter');
        $organiser->confirmation_key = str_random(15);

        // upload user image

        if ($request->hasFile('organiser_logo')) {

            $image = $request->file('organiser_logo');
            $imageName = 'img_'.md5(time(). str_random()).'.'.$image->getClientOriginalExtension();
            $organiser->logo_path = $imageName;

            Storage::disk('s3')->put('organizer/original/'.$imageName, file_get_contents($image), 'public');

            // save as THUMB 60*60
            $image_thumb_60_60 = Image::make($image)->resize(60, 60)->stream();
            Storage::disk('s3')->put('organizer/60*60/'.$imageName, $image_thumb_60_60->__toString(), 'public');

            // save as THUMB 120*120
            $image_thumb_120_120 = Image::make($image)->resize(120, 120)->stream();
            Storage::disk('s3')->put('organizer/120*120/'.$imageName, $image_thumb_120_120->__toString(), 'public');

            // save as VERTICAL poster 240*240
            $image_vert_poster_240_240 = Image::make($image)->resize(240, 240)->stream();
            Storage::disk('s3')->put('organizer/240*240/'.$imageName, $image_vert_poster_240_240->__toString(), 'public');

        }


        $organiser->save();

        session()->flash('message', 'Successfully Created Organiser.');

        return response()->json([
            'status'      => 'success',
            'message'     => 'Refreshing..',
            'redirectUrl' => route('showOrganiserEvents', [
                'organiser_id' => $organiser->id,
                'first_run'    => 1
            ]),
        ]);
    }
}
