<?php

namespace Helvetiapps\LiveControls\Http\Controllers;

use Illuminate\Http\Request;

class AdminInterfaceController extends Controller
{
    public function index(){
        return view('livecontrols::livewire.admin.main');
    }
}
