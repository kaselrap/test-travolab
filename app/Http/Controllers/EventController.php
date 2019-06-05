<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Requests\ReservationRequest;
use App\Model\Event;
use App\Model\EventCoast;
use App\Model\Reservation;
use App\Model\Treatie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('events.index', ['events' => Event::getList()]);
    }

    /**
     * @param Event|null $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Event $event = null)
    {
        return view('events.edit', ['event' => $event ?: new Event()]);
    }

    /**
     * @param Event|null $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EventRequest $request, Event $event = null)
    {
        $errors = $request->getErrors()->all();

        if (count($errors) > 0) {
            return response()->json([
                'failure' => true,
                'errors' => $errors
            ]);
        }

        if (!$event) {
            $event = new Event();
        }

        $event->name = request()->input('name', '');
        $event->duration = request()->input('duration', '');
        $event->subtype_id = request()->input('subtype_id', '');

        if ($event->save()) {
            $event->places()->detach();
            $event->places()->attach(request()->input('place_id', ''));

            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'failure' => true,
        ]);
    }

    /**
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Event $event)
    {
        return response()->json([
            'success' => $event->delete()
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function renderRequestModal(Event $event)
    {
        return response()->json([
            'success' => true,
            'data' => view('events.modal-request', ['event' => $event])->render()
        ]);
    }

    /**
     * @param ReservationRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function addReservation(ReservationRequest $request)
    {
        $errors = $request->getErrors()->all();

        if (count($errors) > 0) {
            return response()->json([
                'failure' => true,
                'errors' => $errors
            ]);
        }

        $event_id = $request->input('event_id', '');

        if (empty($event_id)) {
            return response()->json(['failure' => true]);
        }

        $event = Event::find($event_id);

        $reservation = new Reservation();
        foreach ([
                     'client_id',
                     'employee_id',
                     'phone',
                     'children_num',
                     'receiving',
                     'document',
                     'summ',
                 ] as $filled) {
            $reservation->{$filled} = $request->input($filled, '');
        }
        $reservation->call_day = Carbon::createFromFormat('m/d/Y', $request->input('call_day', Carbon::now()));
        $reservation->summ = 0;
        if ($reservation->save()) {
            $treatie = new Treatie();
            $treatie->reservation_id = $reservation->id;
            $treatie->event_on_place_id = $request->input('event_on_place_id', '');
            $treatie->exit_date = Carbon::createFromFormat('m/d/Y', $request->input('exit_date', Carbon::now()));
            $treatie->time_start = $request->input('time_start', '10:00');
            $endTime = strtotime("+". ($event->duration ?: 0) ." minutes", strtotime($request->input('time_start', '10:00')));
            $treatie->time_end = date('H:i', $endTime);
            $treatie->subtype_id = $event->subtype_id;

            if ($treatie->save()) {
                return response()->json([
                    'success' => true,
                    'data' => view('events.reservations', ['reservations' => $event->treaties, 'event' => $event])->render()
                ]);
            }

        }
    }
}
