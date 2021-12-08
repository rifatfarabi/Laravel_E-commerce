<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function adminDashboard(){
        return view('dashboard.admin');
    }

    public function customerDashboard(){
        abort_if(Gate::denies("customer"), Response::HTTP_FORBIDDEN, "Not Authorized");
        return view('dashboard.customer');
    }
}
