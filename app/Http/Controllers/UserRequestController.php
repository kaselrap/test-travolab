<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestForm;
use App\UserRequests;

class UserRequestController extends Controller
{
    protected  $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'place_id'
    ];

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('requests.index', ['requests' => UserRequests::all()]);
    }

    /**
     * @param RequestForm $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apply(RequestForm $request)
    {
        $errors = $request->getErrors()->all();

        if (count($errors) > 0) {
            return response()->json([
                'failure' => true,
                'errors' => $errors
            ]);
        }

        $userRequest = new UserRequests();
        foreach ($this->fillable as $filled) {
            if ($filled == 'place_id' && empty($request->input($filled, ''))) {
                continue;
            }
            $userRequest->{$filled} = $request->input($filled, '');
        }

        if ($userRequest->save()) {
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'failure' => true,
            'errors' => [
                'Произошла серверная ошибка'
            ]
        ]);
    }

    /**
     * @param UserRequests $userRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(UserRequests $userRequest)
    {
        if ($userRequest->exists) {
            return response()->json([
                'success' => $userRequest->delete()
            ]);
        }
    }
}
