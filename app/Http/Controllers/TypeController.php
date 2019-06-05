<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Model\Type;

class TypeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('types.index', ['types' => Type::getList()]);
    }

    /**
     * @param Type|null $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Type $type = null)
    {
        return view('types.edit', ['type' => $type ? $type : new Type()]);
    }

    /**
     * @param Type|null $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Type $type = null)
    {
        $errors = $request->getErrors()->all();

        if (count($errors) > 0) {
            return response()->json([
                'failure' => true,
                'errors' => $errors
            ]);
        }

        if (!$type) {
            $type = new Type();
        }

        $type->name = request()->input('name', '');

        if ($type->save()) {
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'failure' => true,
        ]);
    }

    /**
     * @param Type $type
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Type $type)
    {
        return response()->json([
            'success' => $type->delete()
        ]);
    }
}
