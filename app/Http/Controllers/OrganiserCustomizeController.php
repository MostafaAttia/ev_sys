<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Organiser;
use Validator;
use Image;
use File;

class OrganiserCustomizeController extends MyBaseController
{
    /**
     * Show organiser setting page
     *
     * @param $organiser_id
     * @return mixed
     */
    public function showCustomize($organiser_id)
    {
        $data = [
            'organiser' => Organiser::scope()->findOrFail($organiser_id),
        ];

        return view('ManageOrganiser.Customize', $data);
    }

    /**
     * Edits organiser settings / design etc.
     *
     * @param Request $request
     * @param $organiser_id
     * @return mixed
     */
    public function postEditOrganiser(Request $request, $organiser_id)
    {
        $organiser = Organiser::scope()->find($organiser_id);

        if (!$organiser->validate($request->all())) {
            return response()->json([
                'status'   => 'error',
                'messages' => $organiser->errors(),
            ]);
        }

        $organiser->name                  = $request->get('name');
        $organiser->about                 = $request->get('about');
        $organiser->google_analytics_code = $request->get('google_analytics_code');
        $organiser->email                 = $request->get('email');
        $organiser->enable_organiser_page = $request->get('enable_organiser_page');
        $organiser->facebook              = $request->get('facebook');
        $organiser->twitter               = $request->get('twitter');

        if ($request->get('remove_current_image') == '1') {
            $organiser->logo_path = '';
        }


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

        session()->flash('message', 'Successfully Updated Organiser');

        return response()->json([
            'status'      => 'success',
            'redirectUrl' => '',
        ]);
    }

    /**
     * Edits organiser profile page colors / design
     *
     * @param Request $request
     * @param $organiser_id
     * @return mixed
     */
    public function postEditOrganiserPageDesign(Request $request, $organiser_id)
    {
        $event = Organiser::scope()->findOrFail($organiser_id);

        $rules = [
            'page_bg_color'        => ['required'],
            'page_header_bg_color' => ['required'],
            'page_text_color'      => ['required'],
        ];
        $messages = [
            'page_header_bg_color.required' => 'Please enter a header background color.',
            'page_bg_color.required'        => 'Please enter a background color.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'messages' => $validator->messages()->toArray(),
            ]);
        }

        $event->page_bg_color        = $request->get('page_bg_color');
        $event->page_header_bg_color = $request->get('page_header_bg_color');
        $event->page_text_color      = $request->get('page_text_color');

        $event->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Organiser Design Successfully Updated',
        ]);
    }
}
