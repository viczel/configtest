<?php

namespace App\Http\Controllers;

use App\CurrentSettings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\CurrentMfos;
use App\Mfo;
use App\Configs;
use App\SettingName;
use App\cpFunctions;
use App\BaseServiceConfig;

class CurrentController extends Controller
{
    //
    public function index() {
        return CurrentMfos::all();
    }

    public function show($id) {
        return CurrentMfos::where('customer_key', $id)
            ->with(['settings'])
            ->firstOrFail();
    }

}
