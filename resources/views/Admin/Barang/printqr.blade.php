<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        .container {
            border: 1px solid #ccc;
            padding: 20px;
            display: inline-block;
            border-radius: 10px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .code {
            font-size: 18px;
            margin-top: 10px;
            color: #555;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="title">{{ $barang->barang_nama }}</div>
        <div>{!! $qrcode !!}</div>
        <div class="code">{{ $barang->barang_kode }}</div>
    </div>
</body>
</html>