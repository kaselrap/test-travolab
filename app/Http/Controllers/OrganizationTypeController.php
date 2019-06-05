<?php

namespace App\Http\Controllers;

use App\Model\OrganizationType;
use Illuminate\Http\Request;

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
    public function update(OrganizationType $organizationType = null)
    {
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
