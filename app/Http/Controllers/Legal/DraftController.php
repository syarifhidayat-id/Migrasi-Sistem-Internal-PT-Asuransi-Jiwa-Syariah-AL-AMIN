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



class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('pages.legal.draft_pks.index');
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
        if ($request->mdp_pk == "") {
            $kode = KodeController::__getKey(14);
            $data = $request->all();
            $data = request()->except(['_token']);

            if ($request->hasFile('mdp_dokumen')) {
                $mdp_dokumen = $request->file('mdp_dokumen');
                $dir = 'public/legal/pks/draftpks';
                $fileOri = $mdp_dokumen->getClientOriginalName();
                $nameBukti = $kode . '_draftpks_' . $fileOri;
                $path = Storage::putFileAs($dir, $mdp_dokumen, $nameBukti);
                $data['mdp_dokumen'] = $nameBukti;
            }

            $data['mdp_pk'] = $kode;
            $data['mdp_ins_user'] = $request->user()->email;
            $data['mdp_ins_date'] = date('Y-m-d H:i:s');
            $data['mdp_indexfolder'] = 0;
            $insert = DB::table('emst.mst_draft_pks')->insert($data);

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
            $draft = DB::table('emst.mst_draft_pks')
                ->where('mdp_pk', '=', $request->mdp_pk)
                ->first();

            $data = request()->except(['_token']);
            $oldFile = 'public/legal/pks/draftpks/' . $draft->mdp_dokumen;

            if ($request->hasFile('mdp_dokumen')) {
                $mdp_dokumen = $request->file('mdp_dokumen');
                $dir = 'public/legal/pks/draftpks';
                $fileOri = $mdp_dokumen->getClientOriginalName();
                $nameBukti = $request->mdp_pk . '_draftpks_' . $fileOri;
                Storage::delete($oldFile);
                $path = Storage::putFileAs($dir, $mdp_dokumen, $nameBukti);
                $data['mdp_dokumen'] = $nameBukti;
            }

            $data['mdp_upd_user'] = $request->user()->email;
            $data['mdp_upd_date'] = date('Y-m-d H:i:s');

            $update = DB::table('emst.mst_draft_pks')
                ->where('mdp_pk', '=', $request->mdp_pk)
                ->update($data);

            if ($update) {
                return response()->json([
                    'success' => 'Data berhasil diupdate dengan Kode ' . $request->mdp_pk . '!'
                ]);
            } else {
                return response()->json([
                    'error' => 'Data dengan kode ' . $request->mdp_pk . ' gagal di update !'
                ]);
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
        $pks = DB::table('emst.mst_draft_pks')
            ->where('mdp_pk', $id)
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
        // $pks = Pks::findOrFail($id);
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
        $draft = DB::table('emst.mst_draft_pks')
            ->where('mdp_pk', '=', $id)
            ->first();
        $oldFile = 'public/legal/pks/draftpks/' . $draft->mdp_dokumen;

        if ($oldFile) {
            Storage::delete($oldFile);
        }

        $delete = DB::table('emst.mst_draft_pks')
            ->where('mdp_pk', '=', $id)
            ->delete();
        if ($delete) {
            return response()->json([
                'success' => 'Data berhasil dihapus dengan Kode ' . $draft->mdp_pk . '!'
            ]);
        } else {
            return response()->json([
                'error' => 'Gagal menghapus data dengan kode' . $draft->mdp_pk . '!'
            ]);
        }
    }
}
