<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubtypeRequest;
use App\Model\Subtype;
use App\Model\Type;

class SubTypeController extends Controller
{
    protected $filled = [
        'name',
        'type_id'
    ];

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('subtypes.index', ['subtypes' => Subtype::getList()]);
    }

    /**
     * @param Subtype|null $subtype
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Subtype $subtype = null)
    {
        return view('subtypes.edit', ['subtype' => $subtype ? $subtype : new Subtype()]);
    }

    /**
     * @param Type|null $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SubtypeRequest $request, Subtype $subtype = null)
    {
        $errors = $request->getErrors()->all();

        if (count($errors) > 0) {
            return response()->json([
                'failure' => true,
                'errors' => $errors
            ]);
        }

        if (!$subtype) {
            $subtype = new Subtype();
        }

        foreach ($this->filled as $value) {
            $subtype->{$value} = is_numeric(request()->input($value, '')) ?
                (int)request()->input($value, '') : request()->input($value, '');
        }

        if ($subtype->save()) {
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'failure' => true,
        ]);
    }

    /**
     * @param Subtype $subtype
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Subtype $subtype)
    {
        return response()->json([
            'success' => $subtype->delete()
        ]);
    }
}
