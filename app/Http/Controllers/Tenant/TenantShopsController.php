<?php namespace App\Http\Controllers\Tenant;


class TenantShopsController extends TenantController {

    public function index()
    {
        return view('tenant.shops');
    }

}
