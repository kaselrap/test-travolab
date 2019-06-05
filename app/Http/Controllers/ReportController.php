<?php

namespace App\Http\Controllers;

use App\Model\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $dateStart;

    protected $dateEnd = '';

    /**
     * ReportController constructor.
     */
    public function __construct()
    {
        $this->dateStart = Carbon::today();
        $this->dateEnd = Carbon::today();

    }

    /**
     * @param null $period
     */
    public function period($period = null)
    {
        if ($period) {
            $period = explode(' - ', $period);
            $this->dateStart = Carbon::createFromFormat('d/m/Y', $period[0]);
            $this->dateEnd = Carbon::createFromFormat('d/m/Y', $period[1]);
        }
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * @param $period
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function reservations($period)
    {
        $this->period($period);

        $reservations = \Excel::getDataFromDatabase(
            Reservation::class,
            [
                'events.name as event_name',
                'employees.name as employee_name',
                'treaties.exit_date',
                'treaties.time_start',
                'treaties.time_end',
            ],
            [
                ['employees', 'employees.id', '=', 'reservations.employee_id'],
                ['treaties', 'treaties.reservation_id', '=', 'reservations.id'],
                ['event_on_places', 'event_on_places.id', '=', 'treaties.event_on_place_id'],
                ['events', 'events.id', '=', 'event_on_places.event_id'],
            ],
            [
                ['treaties.exit_date', '>=', $this->dateStart],
                ['treaties.exit_date', '<=', $this->dateEnd],
            ]
        );

        $reservations = array_map(function ($reservation) {
            return array_values($reservation);
        }, $reservations);

        $document = \Excel::createDocument(
            $reservations,
            __('reports.reservation_report'),
            [
                'Название мероприятия',
                'Сотрудник',
                'Дата проведения',
                'Начало экскурсии',
                'Конец экскурсии',
            ],
            'М.В. Янковская'
        );

        \Excel::downloadDocument($document, 'reservations');
    }

    /**
     * @return string
     */
    public function renderReportLink()
    {
        $link = '';
        $route = \request()->input('route');
        $time = \request()->input('time');
        if (isset($route) && !empty($route) && isset($time) && !empty($time)) {
            $link = route($route, ['period' => $time]);
        }

        return response()->json([
            'route' => $link
        ]);
    }
}
