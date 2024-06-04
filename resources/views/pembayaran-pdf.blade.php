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
            <th>Bulan</th>
            <th>Semester</th>
            <th>Tahun</th>
            <th>Metode</th>
            <th>Jumlah Bayar</th>
            <th>Tanggal Bayar</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($pembayaran as $item)
         <tr>
            <th>{{ $loop->iteration }}</th>
            <th>{{ $item->santri->nama_santri }}</th>
            <td>{{ $item->tagihan->jenis_tagihan }}</td>
            <td>{{ $item->tagihan->bulan ? $item->tagihan->bulan : '-' }}</td>
            <td>{{ $item->tagihan->semester ? $item->tagihan->semester : '-' }}</td>
            <td>{{ $item->tagihan->tahun_ajaran }}</td>
            <td>{{ $item->metode_pembayaran }}</td>
            <td>{{ $item->formatToRupiah('jumlah_bayar') }}</td>
            <td>{{ $item->tanggal_bayar->translatedFormat('d F Y') }}</td>
         </tr>
         @endforeach
      </tbody>
   </table>

</body>


</html>