<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Legal\Pks;
use App\Http\Controllers\Library\KodeController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class PksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('eopr.mst_pks AS pks')
            ->join('emst.mst_rekanan AS rekanan', 'rekanan.mrkn_kode', '=', 'pks.mpks_mrkn_kode')
            ->select(
                'rekanan.*',
                'pks.*',
                DB::raw('DATE_FORMAT(mpks_tgl_mulai, "%d-%m-%Y") as awal_date'),
                DB::raw('DATE_FORMAT(mpks_tgl_akhir, "%d-%m-%Y") as akhir_date')
            )
            ->orderBy('pks.mpks_ins_date', 'desc')
            ->get();
        return View('pages.legal.pks.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = Validator::make(
            $request->all(),
            [
                'mpks_mrkn_kode' => 'required',
                'mpks_instansi' => 'required',
                'mpks_nomor' => 'required',
                'mpks_tentang' => 'required',
                'mpks_tgl_mulai' => 'required',
                'mpks_tgl_akhir' => 'required',
                'mpks_pic' => 'required',
                'mpks_pic_hp' => 'required',
                'mpks_pic_email' => 'required||email',
                'mpks_atasan_hp' => 'required',
                'mpks_atasan_email' => 'required||email',
                'mpks_ket' => 'required',
                'mpks_dokumen' => 'required||mimes:pdf',
            ],
           [
            'mpks_mrkn_kode.required' => 'Pemegang Polis tidak boleh kosong!',
                'mpks_instansi.required' => 'Instansi tidak boleh kosong!',
                'mpks_nomor.required' => 'Nomor pks tidak boleh kosong!',
                'mpks_tentang.required' => 'Perihal tidak boleh kosong!',
                'mpks_tgl_mulai.required' => 'Tanggal mulai tidak boleh kosong!',
                'mpks_tgl_akhir.required' => 'Tanggal akhir tidak boleh kosong!',
                'mpks_pic.required' => 'PIC tidak boleh kosong!',
                'mpks_pic_hp.required' => 'No. HP PIC tidak boleh kosong!',
                'mpks_pic_email.required' => 'email PIC tidak boleh kosong!',
                'mpks_pic_email.email' => 'Format email salah!',
                'mpks_atasan_hp.required' => 'No. HP atasan tidak boleh kosong!',
                'mpks_atasan_email.required' => 'Email atasan tidak boleh kosong!',
                'mpks_atasan_email.email' => 'Format email salah!',
                'mpks_ket.required' => 'Keterangan tidak boleh kosong!',
                'mpks_dokumen.required' => 'dokumen harus diisi, dan tidak boleh kosong!',
                'mpks_dokumen.mimes' => 'dokumen harus diisi dengan format .pdf!',
            ]
        );

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        }else{
            if ($request->mpks_pk == "") {
                $kode = KodeController::__getKey(14);
                $data = $request->all();
                $data = request()->except(['_token']);

                if ($request->hasFile('mpks_dokumen')) {
                    $mpks_dokumen = $request->file('mpks_dokumen');
                    $dir = 'public/legal/pks';
                    $fileOri = $mpks_dokumen->getClientOriginalName();
                    $nameBukti = $kode . '_pks_' . $fileOri;
                    $path = Storage::putFileAs($dir, $mpks_dokumen, $nameBukti);
                    $data['mpks_dokumen'] = $nameBukti;
                }

                $data['mpks_pk'] = $kode;
                $data['mpks_ins_user'] = $request->user()->email;
                $data['mpks_ins_date'] = date('Y-m-d H:i:s');
                $data['mpks_nomor_ori'] = 0;
                $data['mpks_endos'] = 0;
                $data['mpks_endos_idx'] = 0;
                $data['mpks_indexfolder'] = 0;
                $data['mpks_hapus'] = 0;

                // Pks::create($data);

                $insert = DB::table('eopr.mst_pks')->insert($data);

                if ($insert) {
                    return response()->json([
                        'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
                    ]);
                } else {
                    return response()->json([
                        'error' => 'Data gagal disimpan !'
                    ]);
                }
            } else {
                $data = $request->all();
                $pks = DB::table('eopr.mst_pks')
                    ->where('mpks_pk', '=', $request->mpks_pk)
                    ->first();
                $data = request()->except(['_token']);

                $oldFile = 'public/legal/pks/' . $pks->mpks_dokumen;

                if ($request->hasFile('mpks_dokumen')) {
                    $mpks_dokumen = $request->file('mpks_dokumen');
                    $dir = 'public/legal/pks';
                    $fileOri = $mpks_dokumen->getClientOriginalName();
                    $nameBukti = $request->mpks_pk . '_pks_' . $fileOri;
                    Storage::delete($oldFile);
                    $path = Storage::putFileAs($dir, $mpks_dokumen, $nameBukti);
                    $data['mpks_dokumen'] = $nameBukti;
                }

                $data['mpks_nomor_ori'] = 0;
                $data['mpks_endos'] = 0;
                $data['mpks_endos_idx'] = 0;
                $data['mpks_indexfolder'] = 0;
                $data['mpks_hapus'] = 0;
                $data['mpks_upd_user'] = $request->user()->email;
                $data['mpks_upd_date'] = date('Y-m-d H:i:s');

                $update = DB::table('eopr.mst_pks')
                    ->where('mpks_pk', '=', $request->mpks_pk)
                    ->update($data);

                if ($update) {
                    return response()->json([
                        'success' => 'Data berhasil diupdate dengan Kode ' . $request->mpks_pk . '!'
                    ]);
                } else {
                    return response()->json([
                        'error' => 'Data dengan kode ' . $request->mpks_pk . ' gagal diupdate !'
                    ]);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $pks = DB::table('eopr.mst_pks')
            ->where('mpks_pk', $id)
            ->select(
                'mst_pks.*',
                DB::raw('DATE_FORMAT(mpks_tgl_mulai, "%Y-%m-%d") as awal_date'),
                DB::raw('DATE_FORMAT(mpks_tgl_akhir, "%Y-%m-%d") as akhir_date')
            )
            ->first();
        return response()->json($pks);
    }

    public function viewPks($id)
    {
        $pks = DB::table('eopr.mst_pks AS pks')
            ->join('emst.mst_rekanan AS rekanan', 'rekanan.mrkn_kode', '=', 'pks.mpks_mrkn_kode')
            ->where('pks.mpks_pk', $id)
            ->select(
                'pks.*',
                'rekanan.mrkn_nama_induk',
                DB::raw('DATE_FORMAT(mpks_tgl_mulai, "%d-%m-%Y") as awal_date'),
                DB::raw('DATE_FORMAT(mpks_tgl_akhir, "%d-%m-%Y") as akhir_date')
            )
            ->first();
        return response()->json($pks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pks = Pks::findOrFail($id);
        $pks->delete();
        $oldFile = 'public/legal/pks/' . $pks->mpks_dokumen;
        Storage::delete($oldFile);
        return response()->json([
            'success' => 'Data berhasil dihapus dengan Kode ' . $pks->mpks_pk . '!'
        ]);
    }
}
