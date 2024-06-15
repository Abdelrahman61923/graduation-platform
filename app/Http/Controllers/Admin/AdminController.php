<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\User;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function home(Request $request)
    {
        $requestType = $this->adminService->checkRequestType($request);
        $homeData = $this->adminService->home();

        if ($requestType == 'api') {
            return response()->json(
                $homeData,
            );
        } else {
            return view('admins.home', $homeData);
        }
    }
    public function settings(Request $request)
    {
        $requestType = $this->adminService->checkRequestType($request);
        $settings = $this->adminService->settings();

        if ($requestType == 'api') {
            return response()->json(
                $settings,
            );
        } else {
            return view('admins.settings.index', $settings);
        }
    }

    public function storeSettings(Request $request)
    {
        $requestType = $this->adminService->checkRequestType($request);
        $setting = $this->adminService->storeSettings($request);

        if ($requestType == 'api') {
            return response()->json([
                'message' => 'Settings Updated Successfully',
                'setting' => $setting,
            ], 200);
        } else {
            return redirect()->route('admins.settings');
        }
    }
}
