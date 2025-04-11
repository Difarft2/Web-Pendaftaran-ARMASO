<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mode;

class ControllController extends Controller
{
    public function toggleMaintenance()
    {
        $new = Mode::getValue('maintenance_mode') === 'on' ? 'off' : 'on';
        Mode::setValue('maintenance_mode', $new);
        return redirect()->back()->with('status', "Maintenance mode: $new");
    }
    
    public function toggleRegistration()
    {
        $new = Mode::getValue('registration_closed') === 'on' ? 'off' : 'on';
        Mode::setValue('registration_closed', $new);
        return redirect()->back()->with('status', "Mode pendaftaran: $new");
    }
}