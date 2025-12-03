<?php 

    $jumlah = array_map(function ($r) {
    return (int) str_replace('.', '', $r['total']);
    }, $ls_dt);

    $waktu = array_map(function ($r) {
        return $r['waktu_transaksi'];
    }, $ls_dt);


?>


    <div class="m-2">
        <canvas id="transaksi"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('transaksi');

        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: <?= json_encode($waktu);  ?>,
            datasets: [{
                label: 'Total',
                data: <?= json_encode($jumlah); ?>,
                borderWidth: 1
            }]
            },
            options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            return value.toLocaleString('id-ID'); 
                        }
                    }
                }
            }
            }
        });
    </script>