<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>TGL KELUAR</th>
            <th>KODE BARANG</th>
            <th>BARANG</th>
            <th>JML KELUAR</th>
            <th>TUJUAN</th>
        </tr>
    </thead>
    <tbody>
        @php $no=1; @endphp
        @foreach($data as $d)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$d->bk_tanggal}}</td>
            <td>{{$d->barang_kode}}</td>
            <td>{{$d->barang_nama}}</td>
            <td>{{$d->bk_jumlah}}</td>
            <td>{{$d->bk_tujuan}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
