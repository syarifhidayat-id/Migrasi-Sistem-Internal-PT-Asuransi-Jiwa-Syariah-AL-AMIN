<?php

namespace App\Http\Controllers\Sekper;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\KodeController;
use App\Http\Requests\Sekper\SuratMasuk\EditSuratMasukRequest;
use App\Http\Requests\Sekper\SuratMasuk\InputSuratMasukRequest;
use App\Models\Sekper\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SuratMasuk::
        select('*', 'user.*',
          DB::raw('DATE_FORMAT(tsm_tanggal, "%d-%m-%Y") as tgl_tsm'),
          DB::raw('DATE_FORMAT(tsm_ins_date, "%d-%m-%Y") as dt_ins'),
        )
        ->leftJoin('user_accounts as user', 'tsm_ins_user', '=', 'user.id')
        ->where('tsm_proses', '!=', 1)
        ->orderby('tsm_ins_date','DESC')
        ->limit(10)
        ->get();
        // $suratmasuk = $suratmasuk->paginate(10);

        return Inertia::render('Sekper/Suratmasuk/Index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return Inertia::render('Sekper/Suratmasuk/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $smBaru = SuratMasuk::all()->max('tsm_pk');
        $kodeBaru = KodeController::__getPK($smBaru, 15);
        $fileDoc = $request->file('file_upload');
          if ($fileDoc) {
              $file = $fileDoc;
              $dir = 'public/sekper/suratmasuk';
              // $name = $request->tsm_doksurat;
              $name = $kodeBaru . '-SuratMasuk-' . $file->getClientOriginalName();
              $path = Storage::putFileAs(
                  $dir,
                  $file,
                  $name
              );

              $request->merge([ 'tsm_doksurat' => $name ]);
          }

          $tsm_tanggal = str_replace('/', '-', $request->tsm_tanggal);

          $request->merge([
            'tsm_pk' => $kodeBaru,
            'tsm_tanggal' => date('Y-m-d', strtotime($tsm_tanggal)),
            'tsm_ins_date' => date('Y-m-d H:i:s'),
            'tsm_upd_date' => date('Y-m-d H:i:s'),
            'tsm_ins_user' => auth()->user()->email,
            'tsm_upd_user' => auth()->user()->email,
            'tsm_halkhusus' => 0,
          ]);

          $nullRequest=['file_upload'];
          $nullRequest = array_merge_recursive($nullRequest, KodeController::nullRequests($request->all()));

          SuratMasuk::create($request->except($nullRequest));

          return Redirect::route('sekper.suratmasuk.create')->with([
            'message' => 'Surat Masuk dengan nomor '.$request->tsm_pk.' berhasil disimpan!',
            'type' => 'success',
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
        $suratmasuk = SuratMasuk::where('tsm_pk', $id)->first();

        return response()->json([
          'suratmasuk' => $suratmasuk,
        ]);
    }

    public function updatedata(Request $request, $id)
    {
        $sm = SuratMasuk::findOrFail($id);
        $fileDocOld = 'public/sekper/suratmasuk/' . $request->tsm_doksurat;
        // $tsm_tanggal = str_replace('/', '-', $request->tsm_tanggal);

        if ($request->file('file_upload')) {
            $fileDoc = $request->file('file_upload');
            $dir = 'public/sekper/suratmasuk';
            $name = $id . '-SuratMasuk-' . $fileDoc->getClientOriginalName();
            Storage::delete($fileDocOld);
            Storage::putFileAs(
                $dir,
                $fileDoc,
                $name
            );

            $request->merge([ 'tsm_doksurat' => $name ]);
        }

        $request->merge([
          'tsm_tanggal' => $request->tsm_tanggal,
          'tsm_upd_date' => date('Y-m-d H:i:s'),
          'tsm_upd_user' => auth()->user()->email,
        ]);

        $nullRequest=['file_upload'];
        $nullRequest = array_merge_recursive($nullRequest, KodeController::nullRequests($request->all()) );
        $sm->update($request->except($nullRequest));

        return Redirect::route('sekper.suratmasuk.create')->with('message', 'Surat Masuk dengan nomor '.$id.' berhasil diperbaharui!');
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

        // $sm = SuratMasuk::findOrFail($id);
        // $fileDocOld = 'public/sekper/suratmasuk/' . $request->tsm_doksurat;
        // // $tsm_tanggal = str_replace('/', '-', $request->tsm_tanggal);

        // if (Storage::exists($fileDocOld)) {
        //     $fileDoc = $request->file('file_upload');
        //     $dir = 'public/sekper/suratmasuk';
        //     $name = $id . '-SuratMasuk-' . $fileDoc->getClientOriginalName();
        //     Storage::delete($fileDocOld);
        //     Storage::putFileAs(
        //         $dir,
        //         $fileDoc,
        //         $name
        //     );

        //     $request->merge([ 'tsm_doksurat' => $name ]);
        // }

        // $request->merge([
        //   'tsm_tanggal' => $request->tsm_tanggal,
        //   'tsm_upd_date' => date('Y-m-d H:i:s'),
        // ]);

        // $nullRequest=['file_upload'];
        // $nullRequest = array_merge_recursive($nullRequest, KodeController::nullRequests($request->all()) );
        // $sm->update($request->except($nullRequest));

        // return Redirect::route('sekper.suratmasuk.create')->with('message', 'Surat Masuk dengan nomor '.$id.' berhasil diubah!');
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

    public function lov()
    {
      $suratmasuk = DB::table('trs_surat_masuk AS sm')
              ->select('sm.*', 'user.*',
                  DB::raw('DATE_FORMAT(sm.tsm_tanggal, "%d-%m-%Y") as tgl_surat'),
                  DB::raw('DATE_FORMAT(sm.tsm_ins_date, "%d-%m-%Y") as ins_user'),
                )
              ->leftJoin('user_accounts AS user', 'sm.tsm_ins_user', '=', 'user.id')
              ->where('sm.tsm_proses', '!=', 1)
              ->orderby('sm.tsm_upd_date','DESC')
              // ->paginate(5);
              ->get();

      return response()->json([
        'data' => $suratmasuk,
      ]);
    }

    // public function lovAjax(Request $request)
    // {
    //     ## Read value
    //     $draw = $request->get('draw');
    //     $start = $request->get("start");
    //     $rowperpage = $request->get("length"); // total number of rows per page

    //     $columnIndex_arr = $request->get('order');
    //     $columnName_arr = $request->get('columns');
    //     $order_arr = $request->get('order');
    //     $search_arr = $request->get('search');

    //     $columnIndex = $columnIndex_arr[0]['column']; // Column index
    //     $columnName = $columnName_arr[$columnIndex]['data']; // Column name
    //     $columnSortOrder = $order_arr[0]['dir']; // asc or desc
    //     $searchValue = $search_arr['value']; // Search value

    //     // Total records
    //     $totalRecords = SuratMasuk::select('count(*) as allcount')->count();
    //     $totalRecordswithFilter = SuratMasuk::select('count(*) as allcount')->where('tsm_hal', 'like', '%' . $searchValue . '%')->count();

    //     // Get records, also we have included search filter as well
    //     $records = DB::table('trs_surat_masuk AS sm')
    //         ->orderBy($columnName, $columnSortOrder)
    //         // ->orderBy('sm.tsm_ins_date', 'DESC')
    //         ->where('sm.tsm_hal', 'like', '%' . $searchValue . '%')
    //         // ->orWhere('sm.*', 'like', '%' . $searchValue . '%')
    //         // ->orWhere('sm.tsm_nomor', 'like', '%' . $searchValue . '%')
    //         // ->orWhere('sm.tsm_pk', 'like', '%' . $searchValue . '%')
    //         ->select('sm.*')
    //         ->skip($start)
    //         ->take($rowperpage)
    //         ->get();

    //     $data_arr = array();

    //     foreach ($records as $record) {
    //         $data_arr[] = $record;
    //         // $data_arr[] = array(
    //         //     "tsm_pk" => $record->tsm_pk,
    //         //     "tsm_nomor" => $record->tsm_nomor,
    //         //     "tsm_hal" => $record->tsm_hal,
    //         //     "tsm_tanggal" => $record->tsm_tanggal,
    //         // );
    //     }

    //     $response = array(
    //         "draw" => intval($draw),
    //         "iTotalRecords" => $totalRecords,
    //         "iTotalDisplayRecords" => $totalRecordswithFilter,
    //         "aaData" => $data_arr,
    //     );

    //     echo json_encode($response);
    // }
}
