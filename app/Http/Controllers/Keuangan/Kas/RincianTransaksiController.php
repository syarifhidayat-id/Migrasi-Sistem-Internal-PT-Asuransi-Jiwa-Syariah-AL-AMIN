<?php

namespace App\Http\Controllers\Keuangan\Kas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\wwLib\Lib;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class RincianTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                // 'mpks_mrkn_kode' => 'required',
                // 'mpks_instansi' => 'required',
                // 'mpks_nomor' => 'required',
                // 'mpks_tentang' => 'required',
                // 'mpks_tgl_mulai' => 'required',
                // 'mpks_tgl_akhir' => 'required',
                // 'mpks_pic' => 'required',
                // 'mpks_pic_hp' => 'required',
                // 'mpks_pic_email' => 'required||email',
                // 'mpks_atasan_hp' => 'required',
                // 'mpks_atasan_email' => 'required||email',
                // 'mpks_ket' => 'required',
                // // 'mpks_dokumen' => 'required||mimes:pdf',
            ],
            [
                // 'mpks_mrkn_kode.required' => 'Pemegang Polis tidak boleh kosong!',
                //     'mpks_instansi.required' => 'Instansi tidak boleh kosong!',
                //     'mpks_nomor.required' => 'Nomor pks tidak boleh kosong!',
                //     'mpks_tentang.required' => 'Perihal tidak boleh kosong!',
                //     'mpks_tgl_mulai.required' => 'Tanggal mulai tidak boleh kosong!',
                //     'mpks_tgl_akhir.required' => 'Tanggal akhir tidak boleh kosong!',
                //     'mpks_pic.required' => 'PIC tidak boleh kosong!',
                //     'mpks_pic_hp.required' => 'No. HP PIC tidak boleh kosong!',
                //     'mpks_pic_email.required' => 'email PIC tidak boleh kosong!',
                //     'mpks_pic_email.email' => 'Format email salah!',
                //     'mpks_atasan_hp.required' => 'No. HP atasan tidak boleh kosong!',
                //     'mpks_atasan_email.required' => 'Email atasan tidak boleh kosong!',
                //     'mpks_atasan_email.email' => 'Format email salah!',
                //     'mpks_ket.required' => 'Keterangan tidak boleh kosong!',
                //   // 'mpks_dokumen.required' => 'dokumen harus diisi, dan tidak boleh kosong!',
                //   // 'mpks_dokumen.mimes' => 'dokumen harus diisi dengan format .pdf!',
            ]
        );
        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            if (empty($request->tkad_pk)) {
                $data = $request->all();
                $kode = __getKey(14);
                // $data = request()->except(['_token']);
                $data = $request->except(
                    '_token',
                    'e_akun',
                    // 'tkad_atjh_pk',
                    'nama_akun',
                    'e_kasbon',
                );

                $data['tkad_pk']= $kode;
                $data['tkad_askn_kode'] = $request->e_akun;
                // $data['tkad_total'] = Lib::_str2($request->tkad_total, 'N');
                // $data['tkad_atjh_pk'] = $request->e_pk;
                // $data['tkad_approvkeul_user'] = $request->user()->email;
                $data['tkad_approvkeu1_date'] = date('Y-m-d H:i:s');

                $vtable = DB::table('epms.trs_kas_dtl');
                $vtable->insert($data);

                // return response()->json($data);
                return response()->json([
                    'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
                ]);
            }else{
                $data = $request->all();

                // $data = request()->except(['_token']);

                $data = $request->except(
                    '_token',
                    'e_akun',
                    // 'e_pk',
                    'nama_akun',
                    'e_kasbon',
                );

                $data['tkad_askn_kode'] = $request->e_akun;
                // $data['tkad_atjh_pk'] = $request->e_pk;
                
                $vtable = DB::table('epms.trs_kas_dtl')->where('tkad_atjh_pk', $request->tkad_atjh_pk);
                $vtable->update($data);
               return response()->json([
                    'success' => 'Data dengan Kode ' . $request->tkad_pk . ' berhasil di ubah!'
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('epms.trs_kas_dtl')->where('tkad_pk', $id)->delete();
        return response()->json([
            'success' => 'data dengan nomor pk '.$id. ' berhasil di hapus!'
        ]);

    //     $delete = DB::table('emst.mst_ojk')
    //     ->where('mojk_pk', '=', $id)
    //     ->delete();
    // return response()->json([
    //     'success' => 'Data berhasil dihapus dengan Kode ' . $id . '!'
    // ]);
    }


    public function api_tb_dtl(Request $request)
    {
        // $data = DB::table('epms.trs_kas_dtl')
        // ->select('*')
        // ->where('tkad_atjh_pk', $request->a_pk)
        // ->orderBy('tkad_pk', 'DESC')
        // ->limit(10)
        // ->get();


        $data = DB::table('epms.trs_kas_dtl')
        ->select('*', 
        DB::raw('CASE WHEN tkad_tipe_dk = "D" THEN "Debit" WHEN tkad_tipe_dk = "K" THEN "Kredit" END as tipe_dk, FORMAT(tkad_total, 2) tkad_total')
        // DB::raw(number_format((float)'tkad_total','2') )
        )
        ->where('tkad_atjh_pk', $request->kode_pk)
        ->orderBy('tkad_pk', 'DESC')
        // ->limit(10)
        ->get();

        return Datatables::of($data)->addIndexColumn()->make(true);


    }

    public function e_akun(Request $request)
    {
        // if (!isset($tipedk)) $tipedk="K";
        // if (!isset($ckorek)) $ckorek="0";
        // if (!isset($e_value)) $e_value="0";
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 200;
        $offset = ($page - 1) * $rows;
        // $vtable = DB::select(DB::raw("epms.P_AMBILAKUN_KASKOR('D', '01', '', '1')"));
        // $vtable = DB::raw("CALL epms.P_AMBILAKUN_KASKOR('D', '01', '', '1')");
        // $vtable = DB::table('epms')->select(DB::raw("epms.P_AMBILAKUN_KASKOR('K', '01', '0', '0')"))->get();
        // DB::raw("epms.P_AMBILAKUN_KASKOR")

        $vtable = DB::table('eacc.ams_sub_akun')
        ->select(DB::raw("asakn_kode, asakn_keterangan"))
        // ->where(DB::raw("LEFT(asakn_kode,3)"), '=', '550')
        ->whereRaw("LEFT(asakn_kode,3) = '550'")
        ->orderBy('asakn_kode');
        // ->get();


        $union = DB::table('eacc.ams_sub_akun')
        ->select(DB::raw("asakn_kode, asakn_keterangan"))
        ->where([
            ['asakn_mrpt_kode','NEROPR'],
            ['asakn_aakn_kode', '554','558']
            ])->orWhere([
                ['asakn_aakn_kode','540'],
                ['asakn_bnb','1']
            ]);

        if (!empty($request->q)) {
            $vtable->where('asakn_kode', 'LIKE', "%$request->q%")->orWhere('asakn_keterangan', 'LIKE', "%$request->q%");
        }

        // $tble = $vtable->merge($union);
        $data = $vtable
        ->offset($offset)
        ->limit($rows)
        ->union($union)
        ->get();

        return response()->json($data);
        // return $union;
    }

    public function api_edit_dtl ($id) {
        $data = DB::table('epms.trs_kas_dtl')
        ->select('*')
        ->where('tkad_pk', $id)
        ->first();

        return response()->json($data);
    }

    public function edit_akun ($id) {
        $data = DB::table('eacc.ams_sub_akun')
            ->select('asakn_kode', 'asakn_keterangan')
            ->where('asakn_kode', $id)
            // ->where('mssp_nama', 'like', "%$search%")
            ->first();
        return response()->json($data);
    }

}
