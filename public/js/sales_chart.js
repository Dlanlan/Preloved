document.addEventListener("DOMContentLoaded", function () {
  const ctx = document.getElementById("salesChart")?.getContext("2d");
  if (!ctx || typeof salesChartData === "undefined") return;

  const labels = Object.keys(salesChartData);
  const data = Object.values(salesChartData);

  new Chart(ctx, {
    type: "bar",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Total Penjualan (Rp)",
          data: data,
          backgroundColor: "#ffc107",
          borderRadius: 6,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: function (context) {
              return "Rp " + context.raw.toLocaleString("id-ID");
            },
          },
        },
      },
      scales: {
        y: {
          ticks: {
            callback: function (value) {
              return "Rp " + value.toLocaleString("id-ID");
            },
          },
        },
      },
    },
  });
});
