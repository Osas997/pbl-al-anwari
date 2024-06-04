<!DOCTYPE html>
<html>

<head>
   <title>Laporan</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   <style type="text/css">
      table tr td,
      table tr th {
         font-size: 9pt;
      }

      .img-container {
         width: 100%;
      }

      img {
         width: 100%;
      }
   </style>
</head>

<body>
   <div class="img-container">
      <img src="{{ public_path('images/kop.png') }}" alt="kop.png">
   </div>
   <center>
      <h5>{{ $title }}</h5>
   </center>

   <table class='table table-bordered'>
      <thead>
         <tr>
            <th>No</th>
            <th>Nama Santri</th>
            <th>Tagihan</th>
            <th>Nominal</th>
            <th>Status</th>
            <th>Bulan</th>
            <th>Semester</th>
            <th>Tahun</th>
            <th>Tanggal</th>
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
            <td>{{ $item->bulan ? $item->bulan : '-' }}</td>
            <td>{{ $item->semester ? $item->semester : '-' }}</td>
            <td>{{ $item->tahun_ajaran }}</td>
            <td>{{ $item->tgl_tagihan->translatedFormat('d F Y') }}</td>
         </tr>
         @endforeach
      </tbody>
   </table>

</body>

</html>