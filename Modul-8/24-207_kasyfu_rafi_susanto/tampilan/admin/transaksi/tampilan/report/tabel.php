<?php
$no = 1;

function tanggal_indo_singkat($tanggal) {
    $bulan = [
        1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    ];
    $split = explode('-', $tanggal); 
    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}


?>

<div class="m-2 ">
    <table class="table table-bordered border border-1 border-light">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Waktu Transaksi</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ls_dt as $report):?>
                <tr>
                    <td><?= $no?></td>
                    <td>Rp<?= $report["total"]?></td>
                    <td><?= tanggal_indo_singkat($report["waktu_transaksi"])?></td>
                    <?php $no+=1 ?>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>