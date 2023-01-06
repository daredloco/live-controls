<?php

namespace Helvetiapps\LiveControls\Http\Controllers;

use Illuminate\Http\Request;

class AdminInterfaceController extends Controller
{
    public function index(){
        if(!config('livecontrols.admininterface_enabled', false)){
            abort('404', 'Admin Interface disabled!');
        }
        return view('livecontrols::admin.index');
    }
}
