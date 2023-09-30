<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Role',
            'header' => 'Manajemen Role',
        ];
        return view('admin.role.index', $data);
    }

    public function create()
    {
        $data = [];
        $html = view('admin.role.form', $data)->render();

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
                'nama' => 'required|min:5|unique:role,nama',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = new Role();
                $data->nama = $request->nama;
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
        $row = Role::findOrFail($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('admin.role.detail', $data)->render();

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
        $row = Role::findOrFail($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('admin.role.formEdit', $data)->render();

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

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|min:5|unique:role,nama',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = Role::findOrFail($id);
                $data->nama = $request->nama;
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

    public function destroy($id)
    {
        $data = Role::findOrFail($id);
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

    public function getDataTable(Request $request)
    {
        $data = Role::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($dt) {
                return '                    
                    <div class="dropdown">
                        <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                        <div class="dropdown-menu dropdown-menu-right">
                            <span class="dropdown-item" onclick="editData(\'' . $dt->id . '\');"><i class="bx bx-edit-alt mr-1"></i> Edit</span>
                            <span class="dropdown-item" onclick="detailData(\'' . $dt->id . '\');"><i class="bx bx-info-circle mr-1"></i> Detail</span>
                        </div>
                    </div>
                ';
            })
            ->escapeColumns('active')
            ->make(true);
    }
}
