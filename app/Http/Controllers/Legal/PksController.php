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
        if ($request->mpks_pk == "") {
            $kode = KodeController::__getKey(14);
            $data = $request->all();

            if ($request->hasFile('pks_dokumen')) {
                $pks_dokumen = $request->file('pks_dokumen');
                $dir = 'public/legal/pks';
                $fileOri = $pks_dokumen->getClientOriginalName();
                $nameBukti = $kode . '_pks_' . $fileOri;
                $path = Storage::putFileAs($dir, $pks_dokumen, $nameBukti);
                $data['mpks_dokumen'] = $nameBukti;
            }

            $data['mpks_pk'] = $kode;
            $data['mpks_nomor'] = $request->pks_nomor;
            $data['mpks_instansi'] = $request->pks_instansi;
            $data['mpks_tentang'] = $request->pks_tentang;
            $data['mpks_tgl_mulai'] = $request->pks_tgl_mulai;
            $data['mpks_tgl_akhir'] = $request->pks_tgl_akhir;
            $data['mpks_mrkn_kode'] = $request->dd_polis;
            $data['mpks_pic'] = $request->pks_pic;
            $data['mpks_pic_hp'] = $request->pks_pic_hp;
            $data['mpks_pic_email'] = $request->pks_pic_email;
            $data['mpks_atasan_hp'] = $request->pks_atasan_hp;
            $data['mpks_atasan_email'] = $request->pks_atasan_email;
            $data['mpks_ket'] = $request->pks_ket;
            $data['mpks_ins_user'] = $request->user()->email;
            $data['mpks_ins_date'] = date('Y-m-d H:i:s');
            $data['mpks_nomor_ori'] = 0;
            $data['mpks_endos'] = 0;
            $data['mpks_endos_idx'] = 0;
            $data['mpks_indexfolder'] = 0;
            $data['mpks_hapus'] = 0;

            Pks::create($data);
            return response()->json([
                'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
            ]);
        } else {
            $data = $request->all();
            $menu = Pks::findOrFail($request->mpks_pk);
            $oldFile = 'public/legal/pks/' . $menu->mpks_dokumen;
            if ($request->hasFile('pks_dokumen')) {
                $pks_dokumen = $request->file('pks_dokumen');
                $dir = 'public/legal/pks';
                $fileOri = $pks_dokumen->getClientOriginalName();
                $nameBukti = $request->mpks_pk . '_pks_' . $fileOri;
                Storage::delete($oldFile);
                $path = Storage::putFileAs($dir, $pks_dokumen, $nameBukti);
                $data['mpks_dokumen'] = $nameBukti;
            }

            $data['mpks_nomor'] = $request->pks_nomor;
            $data['mpks_instansi'] = $request->pks_instansi;
            $data['mpks_tentang'] = $request->pks_tentang;
            $data['mpks_tgl_mulai'] = $request->pks_tgl_mulai;
            $data['mpks_tgl_akhir'] = $request->pks_tgl_akhir;
            $data['mpks_mrkn_kode'] = $request->dd_polis;
            $data['mpks_pic_hp'] = $request->pks_pic_hp;
            $data['mpks_pic_email'] = $request->pks_pic_email;
            $data['mpks_atasan_hp'] = $request->pks_atasan_hp;
            $data['mpks_atasan_email'] = $request->pks_atasan_email;
            $data['mpks_ket'] = $request->pks_ket;
            $data['mpks_nomor_ori'] = 0;
            $data['mpks_endos'] = 0;
            $data['mpks_endos_idx'] = 0;
            $data['mpks_indexfolder'] = 0;
            $data['mpks_hapus'] = 0;
            $data['mpks_upd_user'] = $request->user()->email;
            $data['mpks_upd_date'] = date('Y-m-d H:i:s');

            $menu->update($data);
            return response()->json([
                $menu
            ]);
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
