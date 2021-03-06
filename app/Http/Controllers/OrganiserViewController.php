<?php

namespace App\Http\Controllers;

use App\Api\V1\Transformers\ClientTransformer;
use App\Attendize\Utils;
use App\Models\Organiser;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Fractal;

class OrganiserViewController extends Controller
{

    /**
     * Show the public organiser page
     *
     * @param $organiser_id
     * @param string $slug
     * @param bool $preview
     * @return \Illuminate\Contracts\View\View
     */
    public function showOrganiserHome(Request $request, $organiser_id, $slug = '', $preview = false)
    {
        $organiser = Organiser::findOrFail($organiser_id);

        if (!$organiser->enable_organiser_page && !Utils::userOwns($organiser)) {
            abort(404);
        }

        /*
         * If we are previewing styles from the backend we set them here.
         */
        if ($request->get('preview_styles') && Auth::check()) {
            $query_string = rawurldecode($request->get('preview_styles'));
            parse_str($query_string, $preview_styles);

            $organiser->page_bg_color = $preview_styles['page_bg_color'];
            $organiser->page_header_bg_color = $preview_styles['page_header_bg_color'];
            $organiser->page_text_color = $preview_styles['page_text_color'];
        }

        $upcoming_events = $organiser->events()->where('is_live', 1)->where('end_date', '>=', Carbon::now())->get();
        $past_events = $organiser->events()->where('is_live', 1)->where('end_date', '<', Carbon::now())->limit(10)->get();

        $client = [];
        $followings_ids = [];

        if(Auth::guard('client')->user()) {
            $fractal = new Fractal\Manager();
            $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());
            $auth_client = Auth::guard('client')->user();
            $client_obj = new Fractal\Resource\Item($auth_client, new ClientTransformer);
            $client = $fractal->createData($client_obj)->toArray();
            $followings = $auth_client->followings(\App\Models\Organiser::class)->get();
            $followings_ids = $followings->pluck('id')->toArray();
        }

        $data = [
            'organiser'       => $organiser,
            'tickets'         => $organiser->events()->orderBy('created_at', 'desc')->get(),
            'is_embedded'     => 0,
            'upcoming_events' => $upcoming_events,
            'past_events'     => $past_events,
            'client'          => $client,
            'followings_ids'  => $followings_ids
        ];

        return view('Public.ViewOrganiser.OrganiserPage', $data);
    }

    /**
     * Show the backend preview of the organiser page
     *
     * @param $event_id
     * @return mixed
     */
    public function showEventHomePreview($event_id)
    {
        return showEventHome($event_id, true);
    }
}
