<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PertemuanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Pertemuan',
            'header' => 'Pertemuan Less',
        ];
        return view('admin.pertemuan.index', $data);
    }

    public function create()
    {
        $data = [];
        $html = view('admin.pertemuan.form', $data)->render();

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
                'pertemuan_ke' => 'required|numeric',
                'materi' => 'required|min:5',
                'tanggal' => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = new Pertemuan();
                $data->pertemuan_ke = $request->pertemuan_ke;
                $data->materi = $request->materi;
                $data->tanggal = $request->tanggal;
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
        $row = Pertemuan::with('absensi.user')->findOrFail($id);
        if ($row) {
            $row->tanggal = Carbon::createFromFormat('Y-m-d', $row->tanggal)->format('l, d F Y');
            $data['row'] = $row;
            $html = view('admin.pertemuan.detail', $data)->render();

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
        $row = Pertemuan::findOrFail($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('admin.pertemuan.formEdit', $data)->render();

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
                'pertemuan_ke' => 'required|numeric',
                'materi' => 'required|min:5',
                'tanggal' => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = Pertemuan::findOrFail($id);
                $data->pertemuan_ke = $request->pertemuan_ke;
                $data->materi = $request->materi;
                $data->tanggal = $request->tanggal;
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
        $data = Pertemuan::findOrFail($id);
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
        $data = Pertemuan::with('absensi')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($dt) {
                return Carbon::createFromFormat('Y-m-d', $dt->tanggal)->format('l, d F Y');
            })
            ->editColumn('pertemuan_ke', function ($dt) {
                return $dt->pertemuan_ke . ' <span class="text-danger d-block">(' . count($dt->absensi) . ' peserta)</span>';
            })
            ->addColumn('absensi', function ($dt) {
                return '                    
                   <a class="btn btn-light-info" href="' . route('admin.absensi', $dt->id) . '">Absensi</>
                ';
            })
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
