<?php

namespace App\Http\Controllers\Tehnik\Polis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntryPolisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.tehnik.polis.entry-master-polis.create');
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
        extract($_POST);
        $cmd = "";
        $vtable = "";
        $user = __getUser();

        $validasi = __valid($request->all(), [
            'mpol_mrkn_nama' => 'required',
            'mpol_msoc_kode' => 'required',
            'mpol_mpojk_kode' => 'required',
            'mpol_mja_kode' => 'required',
            'mpol_mgpp_kode' => 'required',
            'mpol_mgp_kode' => 'required',
            'mpol_mgs_kode' => 'required',
            'mpol_mlu_kode' => 'required',
            'mpol_mgol_kode' => 'required',
            'mpol_online_rekan' => 'required',
            'mpol_openpolis' => 'required',
            'mpol_jenis_cetak' => 'required',
            'mpol_cetak_lunas' => 'required',
            'mpol_host2host' => 'required',
            'mpol_pemgroupusaha' => 'required',
            'mpol_standar_perlindungan' => 'required',
            'mpol_penerima_manfaat' => 'required',
            'mpol_mnfa_kode' => 'required',
            'mpol_surplus' => 'required',
            'mpol_payonline' => 'required',
            'mpol_agent' => 'required',
            'mpol_msrf_kode' => 'required',
            'mpol_jenis_login' => 'required',
            'mpol_acc_tek' => 'required',
            'mpol_dok' => 'mimes:pdf',
        ],
        [
            'mpol_mrkn_nama.required' => 'Pemegang polis tidak boleh kosong!',
            'mpol_msoc_kode.required' => 'Kode soc tidak boleh kosong!',
            'mpol_mpojk_kode.required' => 'Produk individu ojk tidak boleh kosong!',
            'mpol_mja_kode.required' => 'Jenis asuansi tidak boleh kosong!',
            'mpol_mgpp_kode.required' => 'Produk segmen tidak boleh kosong!',
            'mpol_mgp_kode.required' => 'Kelompok produk tidak boleh kosong!',
            'mpol_mgs_kode.required' => 'Rekan Segmen tidak boleh kosong!',
            'mpol_mlu_kode.required' => 'Lini usaha tidak boleh kosong!',
            'mpol_mgol_kode.required' => 'Golongan tidak boleh kosong!',
            'mpol_online_rekan.required' => 'Online polis rekan tidak boleh kosong!',
            'mpol_openpolis.required' => 'Open polis tidak boleh kosong!',
            'mpol_jenis_cetak.required' => 'Cetak peserta pengajuan tidak boleh kosong!',
            'mpol_cetak_lunas.required' => 'Cetak peserta lunas tidak boleh kosong!',
            'mpol_host2host.required' => 'Host to host tidak boleh kosong!',
            'mpol_pemgroupusaha.required' => 'Pemasaran group usaha tidak boleh kosong!',
            'mpol_standar_perlindungan.required' => 'Nilai perlindungan tidak boleh kosong!',
            'mpol_penerima_manfaat.required' => 'Penerima manfaat tidak boleh kosong!',
            'mpol_mnfa_kode.required' => 'Manfaat jiwa tidak boleh kosong!',
            'mpol_surplus.required' => 'Berlaku surplus',
            'mpol_payonline.required' => 'Pembayaran online tidak boleh kosong!',
            'mpol_agent.required' => 'Pembayaran retail/agent tidak boleh kosong!',
            'mpol_msrf_kode.required' => 'Keterangan refund tidak boleh kosong!',
            'mpol_jenis_login.required' => 'Jenis login tidak boleh kosong!',
            'mpol_acc_tek.required' => 'Persetujuan tehnik klaim tidak boleh kosong!',
            // 'msoc_dok.required'=>'File excel harus terisi!',
            'mpol_dok.mimes'=>'File harus berbentuk *pdf!',
        ]);

        if ($validasi->fails()) {
            return __json([
                'error' => $validasi->errors()
            ]);
        } else {
            $vtable="eopr.mst_polis";
            $_POST['mpol_tgl_terbit'] = __str2($_POST['mpol_tgl_terbit'], 'D');
            $_POST['mpol_tgl_awal_polis'] = __str2($_POST['mpol_tgl_awal_polis'], 'D');
            $_POST['mpol_tgl_ahir_polis'] = __str2($_POST['mpol_tgl_ahir_polis'], 'D');
            $_POST['mpol_va_via'] = __str2($_POST['mpol_va_via'], 'MS');
            $_POST['mpol_playonline_via'] = __str2($_POST['mpol_playonline_via'], 'MS');
            $_POST['mpol_agent_via'] = __str2($_POST['mpol_agent_via'], 'MS');
            $_POST['mpol_mprov_berlaku'] = __str2($_POST['mpol_mprov_berlaku'], 'MS');

            $kodepolisendos = "";
            if ((trim($_POST['endors']))=="2") {
                if ((trim($_POST['mpol_nomor']))=="") {
                    return __json([ 'error' => 'Gagal Simpan Endors , Nomor Polis Kosong !!' ]);
                }

                if ((trim($_POST['mpol_kode']))=="") {
                    return __json([ 'error' => 'Gagal Simpan Endors , Kode Polis Kosong !!' ]);
                }

                $mpol_endos_idx=0;
                $cmd = "SELECT max(mpol_endos_idx)+1 idx, mpol_kode_ori FROM $vtable WHERE mpol_kode='".$_POST['mpol_kode']."'";
                $res = __dbRow($cmd);
                $mpol_endos_idx = strval($res['idx']);

                $kodepolisendos = "EDS".$mpol_endos_idx.".".$res['mpol_kode_ori'];
                $cmd = "UPDATE $vtable SET mpol_endos=3 WHERE mpol_kode='".$_POST['mpol_kode']."'";
                __dbRow($cmd);

                $data['mpol_kode'] = "";
                $data['mpol_endos'] = "1";
                $data['mpol_kode_ori'] = $res['mpol_kode_ori'];
                $data['mpol_endos_idx'] = $mpol_endos_idx;
            }

            if ((trim($_POST['endors']))=="4") {
                if ((trim($_POST['mpol_nomor']))=="") {
                    return __json([ 'error' => 'Gagal Simpan Endors , Nomor Polis Kosong !!' ]);
                }

                if ((trim($_POST['mpol_kode']))=="") {
                    return __json([ 'error' => 'Gagal Simpan Endors , Kode Polis Kosong !!' ]);
                }

                $dataold = "SELECT mpol_kode_ori, mpol_msoc_kode,msoc_kode_ori FROM $vtable LEFT JOIN eopr.mst_soc ON msoc_kode=mpol_msoc_kode WHERE mpol_kode='".$_POST['mpol_kode']."'";
                $resold = __dbRow($dataold);

                $cmd = "SELECT IFNULL(MAX(mpol_endos_idx),0)+1 idx FROM $vtable WHERE mpol_kode='".$_POST['mpol_kode']."' and mpol_polis_new=1";
                $res = __dbRow($cmd);
                $mpol_endos_idx = strval($res['idx']);

                $cmd = "UPDATE $vtable SET mpol_endos=3 WHERE mpol_kode='".$_POST['mpol_kode']."'";
                __dbRow($cmd);

                $data['mpol_kode_ori'] = $resold['mpol_kode_ori'];
                $data['mpol_endos_idx'] = $mpol_endos_idx;
                $data['mpol_endos'] = "0";
                $data['mpol_polis_new'] = "1";
                $th = __dbRow("SELECT right(year('".$_POST['mpol_tgl_terbit']."'),2) xyear");

                if ((trim($_POST['mpol_mpid_kode']))!="") {
                    $kd = $th['xyear'].'.'.$_POST['mpol_mpid_kode'].'.';
                    $tglx = $_POST['mpol_tgl_terbit'];
                    $kd = __get_no('',$kd,$tglx,'Y','POL');

                    $_POST['mpol_nomor'] = $kd;
                }
                $_POST['mpol_kode']= "";
                $kodepolisendos=$_POST['mpol_nomor'].'.'.$_POST['mpol_mft_kode'].'.'.$_POST['mpol_mjm_kode'].'.'.$_POST['mpol_mpras_kode'].'.'.$_POST['mpol_jns_perusahaan'].".N".$mpol_endos_idx;
            }

            if ((trim($_POST['mpol_kode']))=="") {
                if (trim($kodepolisendos)!="") {
                    $_POST['mpol_kode'] = $kodepolisendos;
                } else {
                    if ((trim($_POST['mpol_mpid_kode']))!="") {
                        $kd = $th['xyear'].'.'.$_POST['mpol_mpid_kode'].'.';
                        $tglx = $_POST['mpol_tgl_terbit'];
                        $kd = __get_no('',$kd,$tglx,'Y','POL');

                        $_POST['mpol_nomor']=$kd;
                    }
                    $_POST['mpol_kode'] = $_POST['mpol_nomor'].'.'.$_POST['mpol_mft_kode'].'.'.$_POST['mpol_mjm_kode'].'.'.$_POST['mpol_mpras_kode'].'.'.$_POST['mpol_jns_perusahaan'].'.'.$_POST['mpol_mekanisme'].'.'.$_POST['mpol_mekanisme2'];
                    $_POST['mpol_kode_ori'] = $_POST['mpol_kode'];
                }
                $_POST['mpol_ins_date']="now()";
                $_POST['mpol_ins_user']=__getUser();
                $_POST['mpol_upd_date']="now()";
                $_POST['mpol_upd_user']=__getUser();
                $_POST['mpol_mssp_kode']=$_POST['mpol_mssp_kode'];
                $field=__getKey("mpol_",$_POST);
                $cmd=__toSQL($vtable,$field,"I",'',true,'');

                if ($_POST['mpol_ins_soc']==1) {
                    $kdx = $th['xyear'].'.'.$_POST['mpol_mjns_kode'].'.'.$_POST['mpol_mpid_kode'].'.';
                    $kd = __get_no('',$kdx,$_POST['mpol_tgl_terbit'],'Y','SOC','0');

                    $kd_soc = $kd.'.'.$_POST['mpol_mft_kode'].'.'.$_POST['mpol_mjm_kode'].'.'.$_POST['mpol_mpras_kode'].'.'.$_POST['mpol_jns_perusahaan'].'.'.$_POST['mpol_mekanisme'].'.'.$_POST['mpol_mekanisme2'].".N".$mpol_endos_idx;

                    $sql_soc = "
                    INSERT IGNORE INTO eopr.mst_soc
                    SELECT
                    '".$kd_soc."' `msoc_kode`,
                    '".$rold['msoc_kode_ori']."' `msoc_kode_ori`,
                    '' `msoc_mspaj_nomor`,
                    '".$kd."' `msoc_nomor`,
                    '".$_POST['mpol_mrkn_kode']."' `msoc_mrkn_kode`,
                    '".$_POST['mpol_mrkn_nama']."' `msoc_mrkn_nama`,
                    '".$_POST['mpol_mjns_kode']."' `msoc_mjns_kode`,
                    '".$_POST['mpol_mekanisme']."' `msoc_mekanisme`,
                    '".$_POST['mpol_mekanisme2']."' `msoc_mekanisme2`,
                    '0' `msoc_endos`,
                    '1'  `msoc_endos_idx`,
                    '".$_POST['mpol_mpras_kode']."' `msoc_mpras_kode`,
                    '".$_POST['mpol_mssp_nama']."' `msoc_mssp_nama`,
                    '".$_POST['mpol_mpid_kode']."' `msoc_mpid_kode`,
                    '".$_POST['mpol_mpojk_kode']."' `msoc_mpojk_kode`,
                    '' `msoc_file_polis`,
                    '".$_POST['mpol_mssp_kode']."' `msoc_mssp_kode`,
                    '".$_POST['mpol_mlok_kode']."' `msoc_mlok_kode`,
                    '".$_POST['mpol_mkar_kode_mkr']."' `msoc_mkar_kode_mkr`,
                    '".$_POST['mpol_mujh_persen']."' `msoc_mujh_persen`,
                    '".$_POST['mpol_mjm_kode']."' `msoc_mjm_kode`,
                    '".$_POST['mpol_mft_kode']."' `msoc_mft_kode`,
                    '".$_POST['mpol_jenis_bayar']."' `msoc_jenis_bayar`,
                    '".$_POST['mpol_jns_tarif']."' `msoc_jenis_tarif`,
                    '".$_POST['mpol_jns_perusahaan']."' `msoc_jns_perusahaan`,
                    '".$_POST['mpol_mslr_kode']."' `msoc_mslr_kode`,
                    '".$_POST['mpol_mmfe_persen']."' `msoc_mmfe_persen`,
                    '".$_POST['mpol_mfee_persen']."' `msoc_mfee_persen`,
                    '".$_POST['mpol_mkom_persen']."' `msoc_mkom_persen`,
                    '".$_POST['mpol_mkomdisc_persen']."' `msoc_mkomdisc_persen`,
                    '".$_POST['mpol_referal']."' `msoc_referal`,
                    '".$_POST['mpol_maintenance']."' `msoc_maintenance`,
                    '".$_POST['mpol_overreding']."' `msoc_overreding`,
                    '".$_POST['mpol_pajakfee']."' `msoc_pajakfee`,

                    '".$_POST['mpol_handlingfee']."' `msoc_handlingfee`,
                    '".$_POST['mpol_pajakfee_persen']."' `msoc_handlingfee2`,
                    '' `msoc_endors`,
                    '".$_POST['mpol_ket_endors']."' `msoc_ket_endors`,
                    '".$_POST['mpol_mkar_kode_pim']."' `msoc_mkar_kode_pim`,
                    '".$_POST['mpol_mpuw_nomor']."' `msoc_mpuw_nomor`,
                    '".$_POST['mpol_tipe_uw']."' `msoc_tipe_uw`,
                    '".$_POST['mpol_mujhrf_kode']."' `msoc_mujhrf_kode`,
                    '".$_POST['mpol_mdr_kode']."' `msoc_mdr_kode`,
                    '".$_POST['mpol_no_endors']."' `msoc_no_endors`,
                    '".$_POST['mpol_mspaj_nama']."' `msoc_mspaj_nama`,
                    '".$_POST['mpol_mth_nomor']."' `msoc_mth_nomor`,
                    '0' `msoc_approve`,
                    NOW() `msoc_ins_date`,
                    '".$user."' `msoc_ins_user`,
                    NOW() `msoc_upd_date`,
                    '".$user."' `msoc_upd_user`,
                    '".$_POST['mpol_mjns_mpid_kode']."' `msoc_mjns_mpid_kode`,
                    '".$_POST['mpol_pajakfee']."' `msoc_disc_lain`,
                    '0' `msoc_status`,
                    '".$_POST['mpol_indexfolder']."' `msoc_indexfolder`,
                    '' `msoc_dok`,
                    0 `msoc_iscopy`,
                    '' `msoc_msoc_copy`,
                    1 `msoc_soc_new`
                    ";
                    $rins_soc=__dbrow($sql_soc);

                    $ceksoc=__dbrow("SELECT count(*) t FROM eopr.mst_soc WHERE msoc_kode='".$kd_soc."'");

                    if($ceksoc['t'] > 0) {
                        $btlsoc = "UPDATE eopr.mst_soc set msoc_endos=3 where msoc_kode='".$rold['mpol_msoc_kode']."' ";
                        __dbrow($btlsoc);

                        $updsocpol = "UPDATE $vtable SET mpol_msoc_kode='".$kd_soc."' WHERE mpol_kode='".$_POST['mpol_kode']."'";
                        __dbrow($updsocpol);
                    }
                }
                $cek = "SELECT count(*) t FROM $vtable	WHERE mpol_kode='".$_POST['mpol_kode']."' ";
                $rcek=__dbrow($cek);

                if($rcek['t'] < 1) {
                    return __json([ 'error' => 'Gagal Insert data, Silahkan konfirmasi ke IT !!' ]);
                }
            } else {
                $_POST['mpol_upd_date']="now()";
                $_POST['mpol_upd_user']=__getUser();
                $_POST['mpol_mssp_kode']=$_POST['mpol_mssp_kode'];

                $field = __getKey("mpol_",$_POST);
                $cmd = __toSQL($vtable,$field,"U","WHERE mpol_kode='".$_POST['mpol_kode']."'",true,'');
            }

            if (!empty($_FILES['mpol_dok']['name'])) {
                $mpol_dok = $request->file('mpol_dok');
                $dir = 'public/tehnik/polis/doc';
                $fileOri = $mpol_dok->getClientOriginalName();
                $namaFile = $_POST['mpol_kode'] . '-DokumenPolis-' . $fileOri;
                $path = __upfile($dir, $mpol_dok, $namaFile);
                // $_POST['msoc_dok'] = $namaFile;
                $cmd = "UPDATE $vtable SET mpol_file_page=0, mpol_convert_img=0, mpol_file_polis='".$namaFile."', mpol_indexfolder='1' WHERE mpol_kode='".$_POST['mpol_kode']."'";
                __dbRow($cmd);
            }

            // $cmd = __select("DELETE FROM eopr.mst_polis_provinsi WHERE mpwl_mpol_kode='".$_POST['mpol_kode']."'");
            $cmd = __toSQL("eopr.mst_polis_provinsi", "", "D", "WHERE mpwl_mpol_kode='".$_POST['mpol_kode']."'", true, "");

            return __json([
                'success' => 'Data berhasil disimpan dengan Kode '.$_POST['mpol_kode']. ' !'
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
}
