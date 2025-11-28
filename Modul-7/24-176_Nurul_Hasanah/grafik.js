document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("grafikPenjualan").getContext("2d");

    if (labels.length === 0) {
        ctx.font = "14px Arial";
        ctx.fillText("Data tidak tersedia", 20, 20);
        return;
    }

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Pendapatan (Rp)",
                data: dataGrafik
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});