<?php

namespace App\Http\Controllers\Keuangan\Kas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\wwLib\Lib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use PDF;

class MasterKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $kode = __getKey(14);
         response()->json([
             'kode' => $kode,
        ]);
        // var_dump($kode);

        return view('pages.keuangan.kas.master_kas.index', compact('kode'));
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

                'tdna_kode_vcr' => 'required',
                // 'mpojk_tentang' => 'required',
                // 'mpojk_jenis' => 'required',
                // 'mpojk_dokumen' => 'mimes:pdf',
            ],
            [
                'tdna_kode_vcr.required' => 'Voucher Induk Tidak Boleh Kosong!',
                // 'mpojk_tentang.required' => 'Tidak boleh kosong!',
                // 'mpojk_jenis.required' => 'Tidak boleh kosong!',
                // 'mpojk_dokumen.mimes' => 'File harus format pdf!',
            ]
        );

        if ($validasi->fails()) {
            return response()->json([
                'error' => $validasi->errors()
            ]);
        } else {
            $data = $request->all();
            $kode = $request->kode_new;
            $data = $request->except(
                '_token',
                'kode_new',
                'serverSide_kas_length',
            );
            $data['tdna_pk'] = $kode;
            // $data['tkad_user_ins'] = $request->user()->email;
            $data['tdna_date_ins'] = date('Y-m-d H:i:s');

            if ($request->hasFile('tdna_bukti')) {
                $dokumen = $request->file('tdna_bukti');
                $dir = 'public/keuangan/kas/master-kas';
                $fileOri = $dokumen->getClientOriginalName();
                $nameBukti = $kode . '_danaju_' . $fileOri;
                $path = Storage::putFileAs($dir, $dokumen, $nameBukti);
                $data['tdna_bukti'] = $nameBukti;
            }

            // $vtable = DB::table('epms.trs_dana_aju')->select('*')->get();
            if ($request->tdna_aprov_admin == '1' && $request->tdna_aprov_kacab == '1' && $request->tdna_aprov_kapms == '1' && $request->tdna_aprov_korwil == '1' && $request->tdna_aprov_ho == '1') {
                $data['tdna_sts_buku'] = '1';
            }

            // $vtable = DB::table('epms.trs_dana_aju')->insert($data);

            // return response()->json([
            //     'success' => 'Data berhasil disimpan dengan Kode ' . $kode . '!'
            // ]);

            return $data;
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
        //
    }

    // public function pdf_vcr(Request $request) {
    //     // $data = DB::table('epms.trs_dtl_vcr')::get();

    //     $file_data = DB::table('epms.trs_kas_vcr')
    //     ->where('tkav_nomor', $request->id)
    //     ->first();

    //     $filename = $file_data->tkav_nomor.'pdf';
    // 	// $html = '<h1 style="color:red;">Hello World</h1>';

    // 	// $pdf = new TCPDF;

    //     // $pdf::SetTitle($file_data::tkav_nomor);
    //     // $pdf::AddPage();
    //     // $pdf::writeHTML($html, true, false, true, false, '');

    //     // $pdf::Output($filename);
    //     // create new PDF document
    //     $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    //     // set document information
    //     $pdf::SetCreator('deni');
    //     $pdf::SetAuthor('Nicola Asuni');
    //     $pdf::SetTitle('Polis Asuransi Jiwa Syariah Individu - Polis 16-33');
    //     $pdf::SetSubject('TCPDF Tutorial');
    //     $pdf::SetKeywords('TCPDF, PDF, example, test, guide');

    //     // set default header data
    //     $pdf::SetHeaderData('logo/logo.png', '20', 'PT Asuransi Jiwa Syariah'.' Al-Amin', 'Jl.Sultan Agung No. 12 Setiabudi, Jakarta 12980
    //     Telp.(021) 8379 0999 (Hunting), Fax.(021) 8370 5234
    //     www.alamin-insurance.com, email: info@alamin-insurance.com');
    //     $pdf::setFooterData(array(0,64,0), array(0,64,128));

    //     // set header and footer fonts
    //     $pdf::setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    //     $pdf::setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    //     // set default monospaced font
    //     $pdf::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //     // set margins
    //     $pdf::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    //     $pdf::SetHeaderMargin(PDF_MARGIN_HEADER);
    //     $pdf::SetFooterMargin(PDF_MARGIN_FOOTER);

    //     // set auto page breaks
    //     $pdf::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    //     // set image scale factor
    //     $pdf::setImageScale(PDF_IMAGE_SCALE_RATIO);

    //     // set some language-dependent strings (optional)
    //     if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    //         require_once(dirname(__FILE__).'/lang/eng.php');
    //         $pdf::setLanguageArray($l);
    //     }

    //     // ---------------------------------------------------------

    //     // set default font subsetting mode
    //     $pdf::setFontSubsetting(true);

    //     $pdf::SetFont('helvetica', '', 8, '', true);

    //     $pdf::AddPage();

    //     $page = <<<EOD
    //     <table>
    //         <tr>
    //             <td></td>
    //         </tr>
    //     </table>

    //     <table>
    //         <tr>
    //             <td></td>
    //         </tr>
    //     </table>

    //     <table style="width: 100%;">
    //     <form action="#">
    //         <tr>
    //             <td style="width: 15%;">Dibayarkan</td>
    //             <td style="width: 2%";>:</td>
    //             <td style="width: 20%;">Nama user</td>
    //         </tr>
    //         <tr>
    //             <td style="width: 15%;">Pembayaran</td>
    //             <td style="width: 2%";>:</td>
    //             <td style="width: 20%;">
    //             <input type="checkbox" id="tunai" name="tunai" value="tunai">
    //             <label for="tunai">Tunai</label>
    //             </td>
    //             <td style="width: 20%;">
    //             <input type="checkbox" id="tf" name="tf" value="tf">
    //             <label for="tunai">Transfer</label>
    //             </td>
    //             <td style="width: 20%;">
    //             <input type="checkbox" id="cek" name="cek" value="cek">
    //             <label for="tunai">Cek/Bilyet Giro</label>
    //             </td>
    //         </tr>
    //     </form>
    //     </table>

    //     <table>
    //         <tr>
    //             <td></td>
    //         </tr>
    //     </table>


    //     <table style="width: 100%; border: 1px solid black; padding: 5px;">
    //         <tr>
    //             <td style="border: 1px solid black; width: 60%; text-align: center;">Keterangan</td>
    //             <td style="border: 1px solid black; width: 40%; text-align: center;">Jumlah</td>
    //         </tr>
    //         <tr>
    //             <td style="height: 50px; border: 1px solid black; ">test</td>
    //             <td style="height: 50px; border: 1px solid black; text-align: right;">test</td>
    //         </tr>
    //         <tr>
    //             <td style="border: 1px solid black; width: 60%; text-align: center;">Total</td>
    //             <td style="border: 1px solid black; width: 40%; text-align: right;">Rp. </td>
    //         </tr>

    //     </table>
    //     <table style="width: 100%;">
    //         <tr>
    //             <td style="width: 15%;">Terbilang</td>
    //             <td style="width: 2%";>:</td>
    //             <td style="width: auto;">Rp. 000000</td>
    //         </tr>
    //     </table>

    //     <table>
    //         <tr>
    //             <td></td>
    //         </tr>
    //     </table>

    //     <table>
    //         <tr>
    //             <td></td>
    //         </tr>
    //     </table>

    //     <table style="width: 100%;">
    //     <form action="#">
    //         <tr>
    //             <td style="width: 15%;">Tunai/No Rek</td>
    //             <td style="width: 2%";>:</td>
    //             <td style="width: 20%;">test</td>
    //         </tr>
    //         <tr>
    //             <td style="width: 15%;">Nama Bank</td>
    //             <td style="width: 2%";>:</td>
    //             <td style="width: 20%;">test nama bank</td>
    //         </tr>
    //     </form>
    //     </table>

    //     <table>
    //         <tr>
    //             <td></td>
    //         </tr>
    //     </table>

    //     <table style="width: 100%; border: 1px solid black; padding: 5px;">
    //         <tr>
    //             <td style="border: 1px solid black; width: 20%; text-align: center;">Uraian Perkiraan</td>
    //             <td style="border: 1px solid black; width: 15%; text-align: center;">Kelompok Pelaporan</td>
    //             <td style="border: 1px solid black; width: 15%; text-align: center;">Kode Perkiraan</td>
    //             <td style="border: 1px solid black; width: 10%; text-align: center;">Mata Uang</td>
    //             <td style="border: 1px solid black; width: 20%; text-align: center;">Debet</td>
    //             <td style="border: 1px solid black; width: 20%; text-align: center;">Kredit</td>
    //         </tr>
    //         <tr>
    //             <td style="height: 50px; border: 1px solid black; ">test</td>
    //             <td style="height: 50px; border: 1px solid black;">test kelompok pelaporan</td>
    //             <td style="height: 50px; border: 1px solid black; text-align: center;">tes kode perkiraan</td>
    //             <td style="height: 50px; border: 1px solid black; text-align: center;">test mata uang</td>
    //             <td style="height: 50px; border: 1px solid black; text-align: right;">Rp. 00000</td>
    //             <td style="height: 50px; border: 1px solid black; text-align: right;">Rp. 00000</td>
    //         </tr>
    //         <tr>
    //             <td colspan="4" style="border: 1px solid black; width: 60%; text-align: center;">Total</td>
    //             <td style="border: 1px solid black; width: 40%; text-align: right;">Rp. </td>
    //         </tr>

    //     </table>
    //     <table style="width: 100%;">
    //         <tr>
    //             <td style="width: 15%;">Terbilang</td>
    //             <td style="width: 2%";>:</td>
    //             <td style="width: auto;">Rp. 000000</td>
    //         </tr>
    //     </table>


    //     EOD;

    //     // Print text using writeHTMLCell()
    //     $pdf::writeHTML($page, true, false, false, false, '');

    //     $pdf::Output($filename);
    // }



    // public function m_kas(Request $request)
    // {

    //     $data = DB::table('emst.mst_laporan_berkala')->leftJoin('esdm.sdm_divisi', 'sdiv_pk', 'mlapbkl_unit')
    //     ->select('*', DB::raw("@no:=@no+1 AS DT_RowIndex"),
    //         // DB::raw('DATE_FORMAT(map_ins_date, "%d-%m-%Y") as ins_date'),
    //         DB::raw('CASE WHEN mlapbkl_unit = sdiv_pk THEN sdiv_nama END as unit'),
    //         DB::raw('CASE WHEN mlapbkl_aktif = "1" THEN "Aktif"
    //         WHEN mlapbkl_aktif = "0" THEN "Non-Aktif"  END as aktif')
    //     )->orderBy('mlapbkl_update', 'DESC')->get();

    //     return DataTables::of($data)
    //     ->addIndexColumn()
    //     ->filter(function ($instance) use ($request) {
    //         if ($request->get('check_judul') == "1") {
    //             if (!empty($request->get('mlapbkl_jenis'))) {
    //                 $instance->collection = $instance->collection->filter(function ($row) use ($request) {
    //                     return Str::contains($row['mlapbkl_jenis'], $request->get('mlapbkl_jenis')) ? true : false;
    //                 });
    //             }
    //         }

    //         if (!empty($request->get('search'))) {
    //             $instance->collection = $instance->collection->filter(function ($row) use ($request) {
    //                 if (Str::contains(Str::lower($row['mlapbkl_jenis']), Str::lower($request->get('search')))){
    //                     return true;
    //                 }
    //                 return false;
    //             });
    //         }
    //     })
    //     ->make(true);
    // }

    public function kantor_alamin(Request $request){
        // $page = $request->page ? intval($request->page) : 1;
        // $rows = $request->rows ? intval($request->rows) : 1000;
        // $offset = ($page - 1) * $rows;
        // $vtable = DB::table('emst.mst_lokasi')
        // ->select('mlok_pk', 'mlok_nama');
        // // ->where([
        // //     ['cb.mrkn_kode','<>',''],
        // //     ['cb.mrkn_kantor_pusat','1'],
        // //     ['cb.mrkn_nama','!=',''],
        // //     // ['cb.mrkn_nama','like',"%$search%"],
        // // ]);

        // if (!empty($request->q)) {
        //     $vtable->where('mlok_pk', 'LIKE', "%$request->q%")->orWhere('mlok_nama', 'LIKE', "%$request->q%");
        // }

        // $data = $vtable
        // ->offset($offset)
        // ->limit($rows)
        // ->get();

        // return response()->json($data);


        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 100;
        $offset = ($page - 1) * $rows;

        $vtable = DB::table('emst.mst_lokasi')
        ->select('mlok_pk','mlok_nama');

        if(!empty($request->q)) {
            $vtable->where('mlok_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->groupBy('mlok_nama')
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }

    public function e_realisasi(Request $request){
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 1000;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('emst.mst_anggaran_realisasi')
        ->select('mar_kode', 'mar_nama');
        // ->where([
        //     ['cb.mrkn_kode','<>',''],
        //     ['cb.mrkn_kantor_pusat','1'],
        //     ['cb.mrkn_nama','!=',''],
        //     // ['cb.mrkn_nama','like',"%$search%"],
        // ]);

        if (!empty($request->q)) {
            $vtable->where('mar_kode', 'LIKE', "%$request->q%")->orWhere('mar_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }
    public function tdna_penerima(Request $request){
        $page = $request->page ? intval($request->page) : 1;
        $rows = $request->rows ? intval($request->rows) : 1000;
        $offset = ($page - 1) * $rows;
        $vtable = DB::table('esdm.sdm_karyawan_new')
        ->select('skar_pk', 'skar_nama')
        ->orderBy('skar_nama')
        ->where('skar_pk', '!=', '20208588320008450001');
        // ->where([
        //     ['cb.mrkn_kode','<>',''],
        //     ['cb.mrkn_kantor_pusat','1'],
        //     ['cb.mrkn_nama','!=',''],
        //     // ['cb.mrkn_nama','like',"%$search%"],
        // ]);

        if (!empty($request->q)) {
            $vtable->where('skar_pk', 'LIKE', "%$request->q%")->orWhere('skar_nama', 'LIKE', "%$request->q%");
        }

        $data = $vtable
        ->offset($offset)
        ->limit($rows)
        ->get();

        return response()->json($data);
    }


    public function testInput(Request $request){

        $data = $request->all();

        return response()->json($data);
    }


    //


}
