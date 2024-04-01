<?php

namespace App;

trait JenisKelaminTrait
{
    public function jenisKelamin($gender)
    {
        return  $gender == "L" ? "Laki-laki" : "Perempuan";
    }
}
