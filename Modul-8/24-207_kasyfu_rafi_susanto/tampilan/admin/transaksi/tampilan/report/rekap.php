
<div class="m-2 ">
    <table class="table table-bordered border border-1 border-light">
        <thead class="table-light">
            <tr>
                <th>Jumlah Pelanggan</th>
                <th>Total Pendatapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ls_total as $total):?>
                <tr>
                    <td><?= $total["total_pelanggan"]?></td>
                    <td>Rp<?= $total["total"]?></td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>