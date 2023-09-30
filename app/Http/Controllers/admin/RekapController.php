<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Yajra\DataTables\Facades\DataTables;

class RekapController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Rekap Data',
            'header' => 'Rekap Data',
        ];
        return view('admin.rekap.index', $data);
    }

    public function show($id)
    {
        $row = User::with('absensi.pertemuan')->findOrFail($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('admin.rekap.detail', $data)->render();

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

    public function cetakPdf(Request $request, $id)
    {
        $config = [
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_top' => 20,
            'margin_right' => 10,
            'margin_bottom' => 10,
            'margin_left' => 20,
        ];
        $row = User::with('absensi.pertemuan')->findOrFail($id);
        $data['row'] = $row;
        $mpdf = new Mpdf($config);
        $html = view('admin.rekap.cetak', $data)->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output('rekap ' . $row->name . '.pdf', 'I');
    }

    public function getDataTable(Request $request)
    {
        $data = User::with('absensi')->where('role_id', 2)->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('total_pertemuan', function ($dt) {
                return count($dt->absensi);
            })
            ->editColumn('foto', function ($dt) {
                return '<div style="width:100px;">
                    <img src="' . asset($dt->foto) . '" alt="foto" onclick="detail_gambar(this);" onerror="this.src=\'' . asset('img/default.png') . '\'" class="img rounded" style="width: 100%;">
                </div>';
            })
            ->addColumn('cetak_pdf', function ($dt) {
                return '                    
                    <a class="btn btn-danger" target="_blank" href="' . route('admin.rekap.cetak', $dt->id) . '"><i class="bx bx-printer"></i> PDF</a>
                ';
            })
            ->addColumn('action', function ($dt) {
                return '                    
                    <button class="btn btn-success" onclick="detailData(\'' . $dt->id . '\');"><i class="bx bx-notepad"></i> Detail</button>
                ';
            })
            ->escapeColumns('active')
            ->make(true);
    }
}
