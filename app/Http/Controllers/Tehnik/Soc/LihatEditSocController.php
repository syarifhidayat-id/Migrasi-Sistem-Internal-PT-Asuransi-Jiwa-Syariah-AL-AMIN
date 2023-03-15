<?php

namespace App\Http\Controllers\Tehnik\Soc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LihatEditSocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.tehnik.soc.lihat-editsoc.index');
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

        if (__getHak("sjab_kode")!="AKT" && __getHak("sjab_kode")!="KDVAKT" && __getHak("sjab_kode")!="KDVAKT") {
            return __json([
                'errors' => 'Tidak Punya Akses Modul !'
            ]);
        }
        if ((trim($_POST['msoc_nomor']))=="") {
            return __json([
                'errors' => 'Gagal Simpan Endos , Nomor SOC Kosong !!'
            ]);
        }
        if ((trim($_POST['msoc_kode']))=="") {
            return __json([
                'errors' => 'Gagal Simpan Endos , Kode SOC Kosong !!'
            ]);
        }

        $vtable = "eopr.mst_soc";
        if ((trim($_POST['msoc_endos']))=="2") {
            if ((trim($_POST['msoc_nomor']))=="") {
                return __json([
                    'errors' => 'Gagal Simpan Endos , Nomor SOC Kosong !!'
                ]);
            }
            if ((trim($_POST['msoc_kode']))=="") {
                return __json([
                    'errors' => 'Gagal Simpan Endos , Kode SOC Kosong !!'
                ]);
            }
            $msoc_endos_idx=0;
            $cmd="SELECT IFNULL(max(msoc_endos_idx),0)+1 idx ,msoc_kode_ori FROM $vtable WHERE msoc_kode='".$_POST['msoc_kode']."'";
            //echo $cmd;
            $res=__dbrow($cmd);
            $msoc_endos_idx=strval($res['idx']);

            $kodepolisendos="EDS".$msoc_endos_idx.'.'.$res['msoc_kode_ori'];
            $cmd= "update $vtable set msoc_endos=3 where msoc_kode='".$_POST['msoc_kode']."' ";
            //echo $cmd;
            __dbrow($cmd);

            $nomorx=substr($res['msoc_kode_ori'],0,10);
            $_POST['msoc_kode']="";
            $_POST['msoc_endos']="1";
            $_POST['msoc_approve']="0";
            $_POST['msoc_kode_ori']=$res['msoc_kode_ori'];
            $_POST['msoc_endos_idx']=$msoc_endos_idx;
        }

        if ((trim($_POST['msoc_kode']))=="") {

            if ((trim($_POST['msoc_mpid_kode']))!="" && ($_POST['msoc_endos']!="2")) {
                //echo $msoc_endos_idx;
                $kdx=$_POST['msoc_mjns_kode'].'.'.$_POST['msoc_mpid_kode'].'.';
                //  echo $kdx;
                $kd=__get_no('',$kdx,'2016-01-01','Y','SOC','0');
                // echo $kd;
                $_POST['msoc_nomor']=$kd;
                $_POST['msoc_approve']="0";
            }
            // echo $msoc_endos_idx;
            if (trim($kodepolisendos)!="") {
                $_POST['msoc_kode']=$kodepolisendos;
                $_POST['msoc_nomor']=$nomorx;
            } else {
                $_POST['msoc_kode']=$_POST['msoc_nomor'].'.'.$_POST['msoc_mft_kode'].'.'.$_POST['msoc_mjm_kode'].'.'.$_POST['msoc_mpras_kode'].'.'.$_POST['msoc_jns_perusahaan'];

                $_POST['msoc_kode_ori']=$_POST['msoc_kode'];
            }

            $_POST['msoc_ins_date']=__now();
            $_POST['msoc_ins_user']=__getUser();
            $_POST['msoc_upd_date']=__now();
            $_POST['msoc_upd_user']=__getUser();

            $field=__getKode("msoc_",$_POST);
            $cmd=__toSQL($vtable, $field, "I", '', true, '');
            $title = 'di simpan';
        } else {
            $_POST['msoc_upd_date']=__now();
            $_POST['msoc_upd_user']=__getUser();

            $field=__getKode("msoc_",$_POST);
            $cmd=__toSQL($vtable, $field, "U", "WHERE msoc_kode='".$_POST['msoc_kode']."'", true, '');
            $title = 'di update';
        }

        return __json([
            'success' => 'Data berhasil '.$title.' dengan Kode '.$_POST['msoc_kode'].' !'
        ]);
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
