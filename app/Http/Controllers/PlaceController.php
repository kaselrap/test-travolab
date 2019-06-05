<?php

namespace App\Http\Controllers;

use App\Model\Place;

/**
 * Class PlaceController
 * @package App\Http\Controllers
 */
class PlaceController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function index()
    {
        return view('places.index', ['places' => Place::getList()]);
    }

    public function show(Place $place = null)
    {
        return view('places.edit', ['place' => $place ? $place : new Place()]);
    }

    /**
     * @param Place|null $place
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(Place $place = null)
    {
        if (!$place) {
            $place = new Place();
        }

        $place->name = request()->input('name', '');

        if ($place->save()) {
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'failure' => true,
        ]);
    }

    /**
     * @param Place $place
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Place $place)
    {
        return response()->json([
            'success' => $place->delete()
        ]);
    }
}
