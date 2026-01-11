<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>TGL MASUK</th>
            <th>KODE BARANG</th>
            <th>CUSTOMER</th>
            <th>BARANG</th>
            <th>JML MASUK</th>
        </tr>
    </thead>
    <tbody>
        @php $no=1; @endphp
        @foreach($data as $d)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$d->bm_tanggal}}</td>
            <td>{{$d->barang_kode}}</td>
            <td>{{$d->customer_nama}}</td>
            <td>{{$d->barang_nama}}</td>
            <td>{{$d->bm_jumlah}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
