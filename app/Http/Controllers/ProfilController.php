<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Profil',
            'header' => '',
        ];

        $data['row'] = Auth::user();
        $data['provinsi'] = Provinsi::all();
        $data['kabupaten'] = Kabupaten::where('kode_prop', Auth::user()->kode_prop)->get();
        $data['kecamatan'] = Kecamatan::where('kode_kab', Auth::user()->kode_kab)->get();
        $data['kelurahan'] = Kelurahan::where('kode_kec', Auth::user()->kode_kec)->get();
        return view('profil.index', $data);
    }

    function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:5',
                'username' => ['required', 'min:5', Rule::unique('users')->ignore($id)],
                'email' => ['required', 'min:5', 'email:rfc', Rule::unique('users')->ignore($id)],
                'no_hp' => ['required', 'min:10', Rule::unique('users')->ignore($id)],
                'kode_prop' => 'required|exists:ref_provinsi,kode_wilayah',
                'kode_kab' => 'required|exists:ref_kabupaten,kode_wilayah',
                'kode_kec' => 'required|exists:ref_kecamatan,kode_wilayah',
                'kode_kel' => 'required|exists:ref_kelurahan,kode_wilayah',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = User::findOrFail($id);
                $data->name = $request->name;
                $data->username = $request->username;
                $data->email = $request->email;
                $data->no_hp = $request->no_hp;
                $data->kode_prop = $request->kode_prop;
                $data->kode_kab = $request->kode_kab;
                $data->kode_kec = $request->kode_kec;
                $data->kode_kel = $request->kode_kel;
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

    public function resetPassword(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
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
                $data = User::findOrFail($id);
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

    public function updateFoto(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'foto' => 'image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            ], [
                'foto.max' => 'Ukuran :attribute maksimal 2048 Kb',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = User::findOrFail($id);

                if ($data->foto && File::exists($data->foto)) {
                    try {
                        File::delete($data->foto);
                    } catch (\Throwable $th) {
                    }
                }

                if ($request->hasFile('foto')) {
                    $photo = $request->file('foto');

                    $filename = time() . '-' . mt_rand(1, 100000) . '.' . $photo->getClientOriginalExtension();
                    $pathSave = $photo->storeAs('public/foto-profil', $filename);
                    $data->foto = 'storage/foto-profil/' . $filename;

                    // $image = Image::make($request->file('foto')->getRealPath())->encode('webp', 50);
                    // $image->save('public/foto-profil/thumbnail/', $filename);
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

    function get_kab(Request $request)
    {
        $data = Kabupaten::where('kode_prop', $request->kode_wilayah)->get();
        return Response()->json([
            'data' => $data,
        ], 200);
    }

    function get_kec(Request $request)
    {
        $data = Kecamatan::where('kode_kab', $request->kode_wilayah)->get();
        return Response()->json([
            'data' => $data,
        ], 200);
    }

    function get_kel(Request $request)
    {
        $data = Kelurahan::where('kode_kec', $request->kode_wilayah)->get();
        return Response()->json([
            'data' => $data,
        ], 200);
    }
}
