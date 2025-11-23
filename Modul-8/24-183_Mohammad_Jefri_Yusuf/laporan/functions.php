<?php
// Report Transaksi
function validateDateRange(&$errors, $since, $until)
{
    if (empty($since)) {
        $errors['since'] = "Tanggal 'Dari' tidak boleh kosong";
    }
    if (empty($until)) {
        $errors['until'] = "Tanggal 'Sampai' tidak boleh kosong";
    }
    if (!empty($since) && !empty($until)) {
        if ($since > $until) {
            $errors['range'] = "Tanggal 'Dari' tidak boleh lebih  dari tanggal 'Sampai'.";
        }
    }
}
?>