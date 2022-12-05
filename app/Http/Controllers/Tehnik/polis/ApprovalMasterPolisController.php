<?php

namespace App\Http\Controllers\tehnik\polis;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ApprovalMasterPolisController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.tehnik.polis.index');
    }

    public function getApprovalMasterPolis(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('eopr.mst_soc')
                ->select(DB::raw("DATEDIFF(CURDATE(),mpol_tgl_terbit) umur,
                replace(mlok.mlok_nama,'CAB.','') cabang,
                msoc_mrkn_nama,
                if(mpol_kode!='','POLIS','...') as cek,
                if(msoc_approve='1','','SOC') as apr_soc,
                mpol_nomor,
                msoc_nomor mpol_msoc_nomor,
                msoc_kode mpol_msoc_kode,
                msoc_kode_ori,
                mpol_kode,
                mpol_kode_ori,
                mjm.mjm_nama mpol_mjm_nama,
                mft.mft_nama mpol_mft_nama,
                pras.mpras_nama mpol_mpras_nama,
                mjns.mjns_keterangan mpol_mjns_keterangan,
                IFNULL(L0.mpap_note,'') L0mpap_note,
                emst.f_getaprov(L0.mpap_status,'POLIS') L0sts,
                IFNULL(L1.mpap_note,'') L1mpap_note,
                emst.f_getaprov(L1.mpap_status,'POLIS') L1sts,
                IFNULL(L2.mpap_note,'') L2mpap_note,
                emst.f_getaprov(L2.mpap_status,'POLIS') L2sts,
                IFNULL(L3.mpap_note,'') L3mpap_note,
                emst.f_getaprov(L3.mpap_status,'POLIS') L3sts,
                IFNULL(L4.mpap_note,'') L4mpap_note,
                emst.f_getaprov(L4.mpap_status,'POLIS') L4sts,
                IFNULL(L5.mpap_note,'') L5mpap_note,
                emst.f_getaprov(L5.mpap_status,'POLIS') L5sts,
                IFNULL(L6.mpap_note,'') L6mpap_note,
                emst.f_getaprov(L6.mpap_status,'POLIS') L6sts,
                IFNULL(L7.mpap_note,'') L7mpap_note,
                emst.f_getaprov(L7.mpap_status,'POLIS') L7sts,
                IFNULL(L8.mpap_note,'') L8mpap_note,
                emst.f_getaprov(L8.mpap_status,'POLIS') L8sts
                "))
                ->leftJoin('emst.mst_lokasi as mlok', 'mlok.mlok_kode', '=', 'msoc_mlok_kode')
                ->leftJoin('eopr.mst_polis as mpol', 'mpol.mpol_msoc_kode', '=', 'msoc_kode')
                ->leftJoin('emst.mst_rekanan as ps', 'ps.mrkn_kode', '=', 'msoc_mrkn_kode')
                ->leftJoin('emst.mst_jaminan as mjm', 'mjm.mjm_kode', '=', 'msoc_mjm_kode')
                ->leftJoin('emst.mst_manfaat_plafond as mft', 'mft.mft_kode', '=', 'msoc_mft_kode')
                ->leftJoin('emst.mst_program_asuransi as pras', 'pras.mpras_kode', '=', 'msoc_mpras_kode')
                ->leftJoin('emst.mst_jenis_nasabah as mjns', 'mjns.mjns_kode', '=', 'msoc_mjns_kode')
                ->leftJoin('eopr.mst_polis_aprov as L0', function($join) {
                    $join->on('L0.mpap_mpol_kode', '=', 'mpol_kode');
                    $join->where('L0.mpap_level', '=', '0');
                })
                ->leftJoin('eopr.mst_polis_aprov as L1', function($join) {
                    $join->on('L1.mpap_mpol_kode', '=', 'mpol_kode');
                    $join->where('L1.mpap_level', '=', '1');
                })
                ->leftJoin('eopr.mst_polis_aprov as L2', function($join) {
                    $join->on('L2.mpap_mpol_kode', '=', 'mpol_kode');
                    $join->where('L2.mpap_level', '=', '2');
                })
                ->leftJoin('eopr.mst_polis_aprov as L3', function($join) {
                    $join->on('L3.mpap_mpol_kode', '=', 'mpol_kode');
                    $join->where('L3.mpap_level', '=', '3');
                })
                ->leftJoin('eopr.mst_polis_aprov as L4', function($join) {
                    $join->on('L4.mpap_mpol_kode', '=', 'mpol_kode');
                    $join->where('L4.mpap_level', '=', '4');
                })
                ->leftJoin('eopr.mst_polis_aprov as L5', function($join) {
                    $join->on('L5.mpap_mpol_kode', '=', 'mpol_kode');
                    $join->where('L5.mpap_level', '=', '5');
                })
                ->leftJoin('eopr.mst_polis_aprov as L6', function($join) {
                    $join->on('L6.mpap_mpol_kode', '=', 'mpol_kode');
                    $join->where('L6.mpap_level', '=', '6');
                })
                ->leftJoin('eopr.mst_polis_aprov as L7', function($join) {
                    $join->on('L7.mpap_mpol_kode', '=', 'mpol_kode');
                    $join->where('L7.mpap_level', '=', '7');
                })
                ->leftJoin('eopr.mst_polis_aprov as L8', function($join) {
                    $join->on('L8.mpap_mpol_kode', '=', 'mpol_kode');
                    $join->where('L8.mpap_level', '=', '8');
                })
                ->where([
                    ['msoc_approve', '!=', '1'],
                    ['msoc_endos', '!=', '3'],
                ])
                ->orderBy('mpol_mrkn_nama', 'ASC')
                ->get();

            return DataTables::of($data)
            ->addIndexColumn()
            // ->filter (function ($instance) use ($request) {
            //     if (!empty($request->get('msoc_kode'))) {
            //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
            //             return Str::contains($row['msoc_kode'], $request->get('msoc_kode')) ? true : false;
            //         });
            //     }
            //     if (!empty($request->get('search'))) {
            //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
            //             if (Str::contains(Str::lower($row['msoc_kode']), Str::lower($request->get('search')))){
            //                 return true;
            //             }else if (Str::contains(Str::lower($row['msli_mrkn_nama']), Str::lower($request->get('search')))) {
            //                 return true;
            //             }

            //             return false;
            //         });
            //     }
            // })
            ->make(true);
        }
    }
}
