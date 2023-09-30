<?php

use Carbon\Carbon;

function tglIndo($tgl, $format = 'd-m-Y H:i')
{
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $tgl);
    $formattedDate = $date->format($format);
    return $formattedDate;
}

function rupiah($data, $is_koma = false)
{
    if ($data == null) {
        return '';
    } else {
        if ($is_koma == true) {
            return number_format($data, 2, ',', '.');
        } else {
            return number_format($data, 0, ',', '.');
        }
    }
}
