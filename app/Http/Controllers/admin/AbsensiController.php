<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pertemuan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AbsensiController extends Controller
{
    public function index(Request $request, $id)
    {
        $data = [
            'title' => 'Detail Absensi',
            'header' => 'Detail Absensi',
        ];
        $data['row'] = Pertemuan::findOrFail($id);
        return view('admin.absensi.index', $data);
    }

    public function create(Request $request, $id)
    {
        $data = [
            'title' => 'Tambah Absensi',
            'header' => 'Tambah Absensi',
        ];
        $data['id'] = $id;
        $data['user'] = User::where('role_id', 2)->get();
        return view('admin.absensi.form', $data);
    }

    public function store(Request $request, $id)
    {
        $row = Pertemuan::findOrFail($id);
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'gambar_data' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $cekAda = Absensi::where([
                    'user_id' => $request->user_id,
                    'pertemuan_id' => $id,
                ])->get();

                if (count($cekAda) > 0) {
                    return response()->json([
                        'msg' => 'Data sudah ada',
                        'cek' => $cekAda,
                    ], 400);
                }

                $data = new Absensi();
                $data->user_id = $request->user_id;
                $data->pertemuan_id = $id;

                $img = preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $request->gambar_data);
                $imageData = base64_decode($img);
                $path = storage_path('app/public/absensi');
                if (!File::isDirectory($path)) File::makeDirectory($path, 0777, true, true);
                $fileName = '/pertemuanke-' . $row->pertemuan_ke . '-' . time() . mt_rand(1, 1000) . '.png';

                if (file_put_contents($path . $fileName, $imageData)) {
                    $data->foto_absensi = 'storage/absensi' . $fileName;
                }

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
                // 'cek' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $row = Absensi::findOrFail($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('admin.absensi.detail', $data)->render();

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
        $row = Absensi::findOrFail($id);
        if ($row) {
            $data = [
                'title' => 'Edit Absensi',
                'header' => 'Edit Absensi',
            ];
            $data['id'] = $id;
            $data['row'] = $row;
            $data['user'] = User::where('role_id', 2)->get();
            return view('admin.absensi.formEdit', $data);
        } else {
            return response()->json([
                'msg' => 'Data tidak ditemukan',
            ], 400);
        }
    }

    public function update(Request $request, $id, $idAbsensi)
    {
        $row = Pertemuan::findOrFail($id);
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $cekAda = Absensi::where([
                    'user_id' => $request->user_id,
                    'pertemuan_id' => $id,
                ])
                    ->whereNotIn('id', [$idAbsensi])
                    ->get();

                if (count($cekAda) > 0) {
                    return response()->json([
                        'msg' => 'Data sudah ada',
                        'cek' => $cekAda,
                    ], 400);
                }

                $data = Absensi::findOrFail($idAbsensi);
                $data->user_id = $request->user_id;
                $data->pertemuan_id = $id;

                if ($request->gambar_data) {
                    if ($data->foto_absensi && File::exists($data->foto_absensi)) {
                        try {
                            File::delete($data->foto_absensi);
                        } catch (\Throwable $th) {
                        }
                    }

                    $img = preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $request->gambar_data);
                    $imageData = base64_decode($img);
                    $path = storage_path('app/public/absensi');
                    if (!File::isDirectory($path)) File::makeDirectory($path, 0777, true, true);
                    $fileName = '/pertemuanke-' . $row->pertemuan_ke . '-' . time() . mt_rand(1, 1000) . '.png';

                    if (file_put_contents($path . $fileName, $imageData)) {
                        $data->foto_absensi = 'storage/absensi' . $fileName;
                    }
                }

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
        $data = Absensi::findOrFail($id);
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

    public function getDataTable(Request $request, $id)
    {
        $data = Absensi::with('user')->where('pertemuan_id', $id)->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($dt) {
                return $dt->user->name;
            })
            ->editColumn('foto_absensi', function ($dt) {
                return '<img class="img-fluid rounded" onclick="detail_gambar(this);" style="width:150px;" src="' . asset($dt->foto_absensi) . '">';
            })
            ->addColumn('waktu', function ($dt) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $dt->created_at)->format('l, d F Y H:i');
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
