<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventCoast;
use Illuminate\Http\Request;

class EventCoastController extends Controller
{
    protected $fillable = [
        'event_id',
        'coast_less_five_spec',
        'coast_less_five_other',
        'coast_more_five_spec',
        'coast_more_five_other',
    ];
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('events_coast.index', [
            'events_coast' => EventCoast::paginate(20)
        ]);
    }

    /**
     * @param EventCoast|null $eventCoast
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(EventCoast $eventCoast = null)
    {
        if (count(Event::getListForEventCoast()) == 0) {
            return redirect()->route('event_coast');
        }

        return view('events_coast.edit', ['eventCoast' => $eventCoast ?: new EventCoast()]);
    }

    /**
     * @param Request $request
     * @param EventCoast|null $eventCoast
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, EventCoast $eventCoast = null)
    {
        $event_id = $request->input('event_id', '');
        if (empty($event_id)) {
            return response()->json([
                'failure' => true
            ]);
        }

        if (!$eventCoast) {
            $eventCoast = new EventCoast();
        }

        foreach ($this->fillable as $filled) {
            $eventCoast->{$filled} = $request->input($filled, 0);
        }

        if ($eventCoast->save()) {
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'failure' => true,
        ]);
    }

    /**
     * @param EventCoast $eventCoast
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(EventCoast $eventCoast)
    {
        return response()->json([
            'success' => $eventCoast->delete()
        ]);
    }
}
