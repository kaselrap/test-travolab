<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Model\OrganizationType;

class OrganizationTypeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('organization-type.index', ['organizationTypes' => OrganizationType::getList()]);
    }

    /**
     * @param OrganizationType|null $organizationType
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(OrganizationType $organizationType = null)
    {
        return view('organization-type.edit', ['organizationType' => $organizationType ? $organizationType : new OrganizationType()]);
    }

    /**
     * @param OrganizationType|null $organizationType
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, OrganizationType $organizationType = null)
    {
        $errors = $request->getErrors()->all();

        if (count($errors) > 0) {
            return response()->json([
                'failure' => true,
                'errors' => $errors
            ]);
        }

        if (!$organizationType) {
            $organizationType = new OrganizationType();
        }

        $organizationType->name = request()->input('name', '');

        if ($organizationType->save()) {
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'failure' => true,
        ]);
    }

    /**
     * @param OrganizationType $organizationType
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(OrganizationType $organizationType)
    {
        return response()->json([
            'success' => $organizationType->delete()
        ]);
    }
}
