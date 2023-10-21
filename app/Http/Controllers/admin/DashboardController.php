<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'header' => 'Dashboard',
        ];
        $data['total_peserta'] = User::where('role_id', 2)->count();
        $data['total_pertemuan'] = Pertemuan::count();
        return view('admin.dashboard', $data);
    }
}
