<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;

class RegistrasiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Registrasi',
            'header' => 'Akun yang sudah terdaftar',
        ];
        return view('admin.register.index', $data);
    }

    public function create()
    {
        $data['provinsi'] = Provinsi::all();
        $data['role'] = Role::all();
        $html = view('admin.register.form', $data)->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ], 200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'role_id' => 'required|exists:role,id',
                'name' => 'required|min:5',
                'username' => 'required|min:5|unique:users,username',
                'email' => 'required|min:5|email:rfc|unique:users,email',
                'no_hp' => 'required|min:10|unique:users,no_hp',
                'kode_prop' => 'required|exists:ref_provinsi,kode_wilayah',
                'kode_kab' => 'required|exists:ref_kabupaten,kode_wilayah',
                'kode_kec' => 'required|exists:ref_kecamatan,kode_wilayah',
                'kode_kel' => 'required|exists:ref_kelurahan,kode_wilayah',
                'password' => 'required|min:5|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!?])/',
                're_password' => 'required|min:5|same:password',
            ], [
                'regex' => ':attribute wajib menggunakan huruf kapital, angka dan karakter'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = new User();
                $data->id = Uuid::uuid4()->toString();
                $data->role_id = $request->role_id;
                $data->name = $request->name;
                $data->username = $request->username;
                $data->email = $request->email;
                $data->no_hp = $request->no_hp;
                $data->kode_prop = $request->kode_prop;
                $data->kode_kab = $request->kode_kab;
                $data->kode_kec = $request->kode_kec;
                $data->kode_kel = $request->kode_kel;
                $data->password = Hash::make($request->password);
                $data->save();
                DB::commit();

                return response()->json([
                    'status' => 'success',
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning($e->getMessage());

            return response()->json([
                'status' => 'failed',
                'msg' => 'Terjadi kesalahan',
            ], 500);
        }
    }

    public function show($id)
    {
        $row = User::findOrFail($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('admin.register.detail', $data)->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
            ], 200);
        } else {
            return response()->json([
                'msg' => 'Data tidak ditemukan',
            ], 400);
        }
    }

    public function edit($id)
    {
        $row = User::findOrFail($id);
        if ($row) {
            $data['row'] = $row;
            $data['provinsi'] = Provinsi::all();
            $data['kabupaten'] = Kabupaten::where('kode_prop', $row->kode_prop)->get();
            $data['kecamatan'] = Kecamatan::where('kode_kab', $row->kode_kab)->get();
            $data['kelurahan'] = Kelurahan::where('kode_kec', $row->kode_kec)->get();

            $html = view('admin.register.formEdit', $data)->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
            ], 200);
        } else {
            return response()->json([
                'msg' => 'Data tidak ditemukan',
            ], 400);
        }
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        if ($data) {
            $data->delete();
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'msg' => 'Data tidak ditemukan'
            ], 400);
        }
    }

    public function resetPassword($id)
    {
        $data['id'] = $id;
        $html = view('admin.register.resetPassword', $data)->render();
        return response()->json([
            'html' => $html,
        ], 200);
    }

    public function getDataTable(Request $request)
    {
        $data = User::orderBy('created_at', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('role', function ($user) {
                return $user->role->nama;
            })
            ->addColumn('action', function ($user) {
                return '                    
                    <div class="dropdown">
                        <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                        <div class="dropdown-menu dropdown-menu-right">
                            <span class="dropdown-item" onclick="editData(\'' . $user->id . '\');"><i class="bx bx-edit-alt mr-1"></i> Edit</span>
                            <span class="dropdown-item" onclick="detailData(\'' . $user->id . '\');"><i class="bx bx-info-circle mr-1"></i> Detail</span>
                            <span class="dropdown-item" onclick="resetPassword(\'' . $user->id . '\');"><i class="bx bx-lock-alt mr-1"></i> Reset Password</span>
                        </div>
                    </div>
                ';
            })
            ->escapeColumns('active')
            ->make(true);
    }
}
