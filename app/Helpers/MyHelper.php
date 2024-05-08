<?php
function formatTerbilang($x)
{
   $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

   if ($x < 12)
      return " " . $angka[$x];
   elseif ($x < 20)
      return formatTerbilang($x - 10) . " belas";
   elseif ($x < 100)
      return formatTerbilang($x / 10) . " puluh" . formatTerbilang($x % 10);
   elseif ($x < 200)
      return "seratus" . formatTerbilang($x - 100);
   elseif ($x < 1000)
      return formatTerbilang($x / 100) . " ratus" . formatTerbilang($x % 100);
   elseif ($x < 2000)
      return "seribu" . formatTerbilang($x - 1000);
   elseif ($x < 1000000)
      return formatTerbilang($x / 1000) . " ribu" . formatTerbilang($x % 1000);
   elseif ($x < 1000000000)
      return formatTerbilang($x / 1000000) . " juta" . formatTerbilang($x % 1000000);
}

function formatToRupiah($nominal)
{
   $amount = $nominal;
   return 'Rp ' . number_format($amount, 0, ',', '.');
}
