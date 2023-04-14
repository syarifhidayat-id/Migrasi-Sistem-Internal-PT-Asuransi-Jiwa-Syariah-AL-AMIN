<form id="frxx_pjkomisi" name="frxx_pjkomisi" class="form-table" method="post" enctype="multipart/form-data">
    @csrf
    <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="InpOjkKomOver">
        <thead>
            <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                <th class="min-w-50px">No.</th>
                <th class="min-w-200px">Pemegang Polis</th>
                <th class="min-w-150px">Kode Polis</th>
                <th class="min-w-125px">Peserta</th>
                <th class="min-w-200px">Uang Pertanggungan</th>
                <th class="min-w-200px">Kontribusi Tagih</th>
                <th class="min-w-200px">Kontribusi Bayar</th>
                <th class="min-w-120px">Komisi</th>
                <th class="min-w-450px">Pic Pajak Komisi 1</th>
                <th class="min-w-200px">Komisi Bruto 1</th>
                <th class="min-w-450px">Pic Pajak Komisi 2</th>
                <th class="min-w-200px">Komisi Bruto 2</th>
                <th class="min-w-120px">Overreding</th>
                <th class="min-w-450px">Pic Pajak Overreding 1</th>
                <th class="min-w-200px">Komisi Bruto 1</th>
                <th class="min-w-150px">Proses Data</th>
                <th class="min-w-350px">Keterangan</th>
                <th class="min-w-150px">Cab. Alamin</th>
            </tr>
        </thead>
        <tbody>
            @php
            $tary="";

            $tup=0;
            $tpremi=0;
            $tpst=0;
            $tbyr=0;
            $tkomisi=0;
            $tovr=0;
            @endphp
            
            @for($i = 0; $i < count($data); $i++)
                @php
                $tpst=$tpst+strval(str_replace(",","",$data[$i]['tpst']));
                $tup=$tup+strval(str_replace(",","",$data[$i]['tup']));
                $tpremi=$tpremi+strval(str_replace(",","",$data[$i]['ttagih']));
                $tbyr=$tbyr+strval(str_replace(",","",$data[$i]['tbyr']));
                $tkomisi=$tkomisi+strval(str_replace(",","",$data[$i]['tkomisi']));
                $tovr=$tovr+strval(str_replace(",","",$data[$i]['toverreding']));

                $xsaldo1="xsaldo1" .$i;
                $xpic1="xpic1" .$i;

                $xsaldo1a="xsaldo1a" .$i;
                $xpic1a="xpic1a" .$i;

                $xsaldo1b="xsaldo1b" .$i;
                $xpic1b="xpic1b" .$i;

                $xsaldo2="xsaldo2" .$i;
                $xpic2="xpic2" .$i;

                $xsaldo2a="xsaldo2a" .$i;
                $xpic2a="xpic2a" .$i;

                $xproses="xproses" .$i;
                @endphp
            
                <tr class="odd">
                    <td class="dt-body-center">{{ $i+1 }}.</td>
                    <td>{{ $data[$i]['nama'] }}</td>
                    <td>{{ $data[$i]['kdpolis'] }}</td>
                    <td class="dt-body-right">{{ $data[$i]['tpst'] }}</td>
                    <td class="dt-body-right">{{ __formatMoney($data[$i]['tup'], true) }}</td>
                    <td class="dt-body-right">{{ __formatMoney($data[$i]['ttagih'], true) }}</td>
                    <td class="dt-body-right">{{ __formatMoney($data[$i]['tbyr'], true) }}</td>
                    <td class="dt-body-right">{{ __formatMoney($data[$i]['tkomisi'], true) }}</td>
                    <td class="dt-body-center">
                        <input type="text" class="easyui-textbox selectGrid xpic1" id="{{ $xpic1 }}" name="{{ $xpic1 }}" data-options="prompt:'Pic pajak komisi 1'" style="width: 100%; height: 38px;" />
                    </td>
                    <td class="dt-body-center">
                        <input type="text" class="form-control form-control-solid xsaldo1" id="{{ $xsaldo1 }}" name="{{ $xsaldo1 }}" data-type="rupiah" placeholder="Komisi bruto 1" />
                    </td>
                    <td class="dt-body-center">
                        <input type="text" class="easyui-textbox selectGrid xpic1a" id="{{ $xpic1a }}" name="{{ $xpic1a }}" data-options="prompt:'Pic pajak komisi 2'" style="width: 100%; height: 38px;" />
                    </td>
                    <td class="dt-body-center">
                        <input type="text" class="form-control form-control-solid xsaldo1a" id="{{ $xsaldo1a }}" name="{{ $xsaldo1a }}" data-type="rupiah" placeholder="Komisi bruto 2" />
                    </td>
                    <td class="dt-body-right">{{ __formatMoney($data[$i]['toverreding'], true) }}</td>
                    <td class="dt-body-center">
                        <input type="text" class="easyui-textbox selectGrid xpic2" id="{{ $xpic2 }}" name="{{ $xpic2 }}" data-options="prompt:'Pic pajak overreding 1'" style="width: 100%; height: 38px;" />
                    </td>
                    <td class="dt-body-center">
                        <input type="text" class="form-control form-control-solid xsaldo2" id="{{ $xsaldo2 }}" name="{{ $xsaldo2 }}" data-type="rupiah" placeholder="Komisi bruto 1" />
                    </td>
                    <td class="dt-body-center">
                        <button type="button" class="btn btn-primary btn-sm xproses" id="{{ $xproses }}" name="{{ $xproses }}" onclick="proses_pst('{{ $i }}', '{{ $data[$i]['kdpolis'] }}', '{{ $data[$i]['tpst'] }}', '{{ $data[$i]['tup'] }}', '{{ $data[$i]['tkomisi'] }}', '{{ $data[$i]['toverreding'] }}', '{{ $data[$i]['bln1'] }}', '{{ $data[$i]['bln2'] }}', '{{ $data[$i]['thn'] }}', '{{ $data[$i]['cab'] }}', 1)">Proses</button>
                    </td>
                    <td>{{ $data[$i]['ket'] }}</td>
                    <td>{{ $data[$i]['cabang'] }}</td>
                </tr>
            @endfor
        </tbody>
        <tfoot>
            <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 align-middle">
                <th colspan="3" class="text-center">Total</th>
                <th>{{ $tpst }}</th>
                <th class="text-center">{{ __formatMoney($tup, true) }}</th>
                <th class="text-center">{{ __formatMoney($tpremi, true) }}</th>
                <th class="text-center">{{ __formatMoney($tbyr, true) }}</th>
                <th class="text-center">{{ __formatMoney($tkomisi, true) }}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th class="text-center">{{ __formatMoney($tovr, true) }}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>

</form>

<script>
    $(document).ready(function() {
        dtTables("InpOjkKomOver");
    });
</script>
@for($i = 0; $i < count($data); $i++) 
    @php
        $pickom = '#xpic1'.$i;
        $xsaldo1 = 'xsaldo1'.$i;

        $pickom1a = '#xpic1a'.$i;
        $xsaldo1a = 'xsaldo1a'.$i;

        $pickom1b = '#xpic1b'.$i;
        $xsaldo1b = '#xsaldo1b'.$i;

        $picover = '#xpic2'.$i;
        $xsaldo2 = 'xsaldo2'.$i;

        $picover2a = '#xpic2a'.$i;
        $xsaldo2a = '#xsaldo2a'.$i;

        $xproses = '#xproses'.$i;
    @endphp
<script>
    // pickom
    selectGrids('{{ $pickom }}','GET','{{ url("api/keuangan/komisi-overriding/input-pajak-overriding/lod_user_tax") }}','kode','nama',[
        {field:"npwp",title:"NPWP",width:200},
        {field:"nama",title:"NAMA",align:"left",width:280},
        {field:"ket",title:"STATUS",align:"left",width:120},
    ], function(i, row) {
        setText('{{ $xsaldo1 }}', row.mtx_saldo);
    });
    setTextReadOnly('{{ $xsaldo1 }}', true);
    // pickom1a
    selectGrids('{{ $pickom1a }}','GET','{{ url("api/keuangan/komisi-overriding/input-pajak-overriding/lod_user_tax") }}','kode','nama',[
        {field:"npwp",title:"NPWP",width:200},
        {field:"nama",title:"NAMA",align:"left",width:280},
        {field:"ket",title:"STATUS",align:"left",width:120},
    ], function(i, row) {
        setText('{{ $xsaldo1a }}', row.mtx_saldo);
    });
    setTextReadOnly('{{ $xsaldo1a }}', true);
    // picover
    selectGrids('{{ $picover }}','GET','{{ url("api/keuangan/komisi-overriding/input-pajak-overriding/lod_user_tax") }}','kode','nama',[
        {field:"npwp",title:"NPWP",width:200},
        {field:"nama",title:"NAMA",align:"left",width:280},
        {field:"ket",title:"STATUS",align:"left",width:120},
        {field:"mtx_saldo",title:"SALDO",align:"left",width:100},
    ], function(i, row) {
        setText('{{ $xsaldo2 }}', row.mtx_saldo);
    });
    setTextReadOnly('{{ $xsaldo2 }}', true);
</script>
@endfor