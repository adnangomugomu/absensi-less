<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'header' => 'Dashboard',
        ];
        $data['row'] = User::with('absensi.pertemuan')->findOrFail(Auth::user()->id);
        return view('user.dashboard', $data);
    }
}
