<?php
use App\Models\Admin\BarangmasukModel;
use App\Models\Admin\BarangkeluarModel;
?>
<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>KODE BARANG</th>
            <th>BARANG</th>
            <th>STOK AWAL</th>
            <th>JML MASUK</th>
            <th>JML KELUAR</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @php $no=1; @endphp
        @foreach($data as $d)
        <?php 
        if($tglawal == ''){
            $jmlmasuk = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')->leftJoin('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_barangmasuk.customer_id')->where('tbl_barangmasuk.barang_kode', '=', $d->barang_kode)->sum('tbl_barangmasuk.bm_jumlah');
        }else{
            $jmlmasuk = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')->leftJoin('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_barangmasuk.customer_id')->where('tbl_barangmasuk.barang_kode', '=', $d->barang_kode)->whereBetween('bm_tanggal', [$tglawal, $tglakhir])->sum('tbl_barangmasuk.bm_jumlah');
        }

        if ($tglawal != '') {
            $jmlkeluar = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')->whereBetween('bk_tanggal', [$tglawal, $tglakhir])->where('tbl_barangkeluar.barang_kode', '=', $d->barang_kode)->sum('tbl_barangkeluar.bk_jumlah');
        } else {
            $jmlkeluar = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')->where('tbl_barangkeluar.barang_kode', '=', $d->barang_kode)->sum('tbl_barangkeluar.bk_jumlah');
        }

        $totalStok = $d->barang_stok + ($jmlmasuk-$jmlkeluar);
        ?>
        <tr>
            <td>{{$no++}}</td>
            <td>{{$d->barang_kode}}</td>
            <td>{{$d->barang_nama}}</td>
            <td>{{$d->barang_stok}}</td>
            <td>{{$jmlmasuk}}</td>
            <td>{{$jmlkeluar}}</td>
            <td>{{$totalStok}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
