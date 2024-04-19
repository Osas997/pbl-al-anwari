<!DOCTYPE html>
<html>

<head>
   <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
   <style type="text/css">
      table tr td,
      table tr th {
         font-size: 9pt;
      }
   </style>
   <center>
      <h5>Laporan Tagihan</h5>
   </center>

   <table class='table table-bordered'>
      <thead>
         <tr>
            <th>No</th>
            <th>Nama Santri</th>
            <th>Jenis Tagihan</th>
            <th>Nominal</th>
            <th>Status</th>
            <th>Tanggal Tagihan</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($tagihan as $index => $item)
         <tr>
            <th>{{ $loop->iteration }}</th>
            <th>{{ $item->santri->nama_santri }}</th>
            <td>{{ $item->jenis_tagihan }}</td>
            <td>{{ $item->formatToRupiah('nominal') }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->tgl_tagihan->translatedFormat('d F Y') }}</td>
         </tr>
         @endforeach
      </tbody>
   </table>

</body>

</html>