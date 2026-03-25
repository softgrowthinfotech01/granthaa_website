<?php include 'header.php'; ?>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">

  <!-- Combined Compact Card -->
  <div class="bg-gradient-to-r from-yellow-200 to-gray-800 
            text-black p-4 rounded-2xl shadow-lg">

    <!-- Row 1 -->
    <div class="flex items-center justify-between py-2 border-b border-black/10">
      <div class="flex items-center gap-3">
        <span class="text-xl opacity-60 ">₹</span>
        <h3 class="text-xs font-semibold  tracking-wide">
          TOTAL BOOKING
        </h3>
      </div>
      <p id="totalBooking" class="text-sm  text-white"></p>
    </div>

    <!-- Row 2 -->
    <div class="flex items-center justify-between py-2 border-b border-black/10">
      <div class="flex items-center gap-3">
        <span class="text-xl opacity-60 ">%</span>
        <h3 class="text-xs font-semibold tracking-wide ">
          TOTAL COMMISSION
        </h3>
      </div>
      <p id="totalCommission" class="text-sm text-white"></p>
    </div>

    <!-- Row 3 -->
    <div class="flex items-center justify-between py-2">
      <div class="flex items-center gap-3">
        <span class="text-xl opacity-60">🏆</span>
        <h3 class="text-xs font-semibold tracking-wide ">
          MY BOOKINGS
        </h3>
      </div>
      <p id="mybooking" class="text-sm  text-white"></p>
    </div>

  </div>

  <!-- Combined Compact Card -->
  <div class="bg-gradient-to-r from-yellow-200 to-gray-800 
            text-black p-4 rounded-2xl shadow-lg">

    <!-- Row 1 -->
    <div class="flex items-center justify-between py-2 border-b border-black/10">
      <div class="flex items-center gap-3">
        <span class="text-xl opacity-60 ">₹</span>
        <h3 class="text-xs font-semibold  tracking-wide">
          ADVISOR'S TOTAL BOOKING AMOUNT
        </h3>
      </div>
      <p id="teamtotalBooking" class="text-sm  text-white"></p>
    </div>

    <!-- Row 2 -->
    <div class="flex items-center justify-between py-2 border-b border-black/10">
      <div class="flex items-center gap-3">
        <span class="text-xl opacity-60 ">%</span>
        <h3 class="text-xs font-semibold tracking-wide ">
          ADVISOR'S TOTAL COMMISSION AMOUNT
        </h3>
      </div>
      <p id="teamtotalCommission" class="text-sm text-white"></p>
    </div>

    <!-- Row 3 -->
    <div class="flex items-center justify-between py-2">
      <div class="flex items-center gap-3">
        <span class="text-xl opacity-60">🏆</span>
        <h3 class="text-xs font-semibold tracking-wide ">
          TEAM BOOKINGS
        </h3>
      </div>
      <p id="teambooking" class="text-sm  text-white"></p>
    </div>

  </div>

  <!-- Combined Compact Card -->
  <div class="bg-gradient-to-r from-yellow-200 to-gray-800 
            text-black p-4 rounded-2xl shadow-lg 
            h-full flex flex-col">

    <!-- Row 1 -->
    <div class="flex items-center justify-between flex-1 border-b border-black/10">
      <div class="flex items-center gap-2">
        <span class="text-lg opacity-60">₹</span>
        <h3 class="text-xs font-semibold tracking-wide">
          TOTAL BOOKING AMOUNT
        </h3>
      </div>
      <p id="total_booking_amount" class="text-sm font-semibold text-white"></p>
    </div>

    <!-- Row 2 -->
    <div class="flex items-center justify-between flex-1">
      <div class="flex items-center gap-2">
        <span class="text-lg opacity-60">%</span>
        <h3 class="text-xs font-semibold tracking-wide">
          TOTAL COMMISSION AMOUNT
        </h3>
      </div>
      <p id="total_commission_amount" class="text-sm font-semibold text-white"></p>
    </div>

  </div>

  <!-- Combined Compact Card -->
  <div class="bg-gradient-to-r from-yellow-200 to-gray-800 
            text-black p-4 rounded-2xl shadow-lg 
            h-full flex flex-col">

    <!-- Row 1 -->
    <div class="flex items-center justify-between flex-1 border-b border-black/10">
      <div class="flex items-center gap-2">
        <span class="text-lg opacity-60">₹</span>
        <h3 class="text-xs font-semibold tracking-wide">
          TOTAL ADVISORS
        </h3>
      </div>
      <p id="totalAdvisors" class="text-sm font-semibold text-white"></p>
    </div>

    <!-- Row 2 -->
    <div class="flex items-center justify-between flex-1">
      <div class="flex items-center gap-2">
        <span class="text-lg opacity-60">%</span>
        <h3 class="text-xs font-semibold tracking-wide">
          TOP ADVISOR
        </h3>
      </div>
      <p id="topAdvisor" class="text-sm font-semibold text-white"></p>
    </div>
  </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

  <!-- SALES TREND -->
  <div class="bg-white p-4 rounded-xl shadow">
    <h3 class="text-lg font-semibold mb-3">📈 Sales Trend</h3>
    <canvas id="salesChart"></canvas>
  </div>

  <!-- COMMISSION SPLIT -->
  <div class="bg-white p-4 rounded-xl shadow flex flex-col justify-center items-center">
    <h3 class="text-lg font-semibold mb-3">Commission Split</h3>
    <canvas id="commissionChart" style="max-width: 280px; max-height: 280px;"></canvas>
  </div>

</div>

<script src="../url.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const token = localStorage.getItem('auth_token');
    if (!token) {
      alert("Please login first");
      window.location.href = "../login";
      return;
    }
    const apiUrl = url + 'dashboard';

    fetch(apiUrl, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          "Authorization": "Bearer " + token
        }
      })
      .then(response => {
        if (!response.ok) {
          throw new Error("Network response was not ok: " + response.statusText);
        }
        return response.json();
      })
      .then(data => {
        document.querySelector('#totalAdvisors').textContent = data.data.total_advisors.toLocaleString();
        document.querySelector('#totalBooking').textContent = "₹ " + parseFloat(data.data.my_total_booking_amount).toLocaleString();
        document.querySelector('#teamtotalBooking').textContent = "₹ " + parseFloat(data.data.team_total_booking_amount).toLocaleString();
        document.querySelector('#totalCommission').textContent = "₹ " + parseFloat(data.data.my_commission).toLocaleString();
        document.querySelector('#teamtotalCommission').textContent = "₹ " + parseFloat(data.data.team_commission).toLocaleString();
        document.querySelector('#topAdvisor').textContent = (data.data.top_advisor_name == null) ? "-" : data.data.top_advisor_name + " (" + data.data.user_code + ")";
        document.querySelector('#teambooking').textContent = (data.data.team_total_booking == null) ? "-" : data.data.team_total_booking;
        document.querySelector('#mybooking').textContent = (data.data.my_total_booking == null) ? "-" : data.data.my_total_booking;
        document.querySelector('#total_booking_amount').textContent = (data.data.total_booking_amount == null) ? "-" : "₹ " + data.data.total_booking_amount.toLocaleString();
        document.querySelector('#total_commission_amount').textContent = (data.data.total_commission_amount == null) ? "-" : "₹ " + data.data.total_commission_amount.toLocaleString();

      })
      .catch(error => console.error('Error fetching dashboard data:', error));
  });



  // CHARTS
  async function loadSalesChart() {

    const token = localStorage.getItem("auth_token");

    const res = await fetch(url + "sales-trend", {
      headers: {
        "Authorization": "Bearer " + token
      }
    });

    const result = await res.json();

    const labels = result.data.map(d => d.date);
    const values = result.data.map(d => d.total);

    new Chart(document.getElementById("salesChart"), {
      type: "line",
      data: {
        labels: labels,
        datasets: [{
          label: "Sales",
          data: values,
          borderWidth: 2,
          tension: 0.3
        }]
      }
    });
  }

  async function loadCommissionChart() {

    const token = localStorage.getItem("auth_token");

    const res = await fetch(url + "commission-split", {
      headers: {
        "Authorization": "Bearer " + token
      }
    });

    const result = await res.json();
    const d = result.data;

    // ✅ FIX: convert to number
    const leader = Number(d.leader);
    const adviser = Number(d.adviser);
    const total = leader + adviser;

    const ctx = document.getElementById("commissionChart").getContext("2d");

    // 🎨 Gradients
    const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
    gradient1.addColorStop(0, "#36D1DC");
    gradient1.addColorStop(1, "#5B86E5");

    const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
    gradient2.addColorStop(0, "#FF758C");
    gradient2.addColorStop(1, "#FF7EB3");

    // 🔥 Inner Circle Plugin (FIXED)
    const innerCirclePlugin = {
      id: 'innerCircle',
      beforeDraw(chart) {
        const {
          ctx
        } = chart;
        const meta = chart.getDatasetMeta(0);
        if (!meta || !meta.data || !meta.data[0]) return;

        const x = meta.data[0].x;
        const y = meta.data[0].y;

        ctx.save();

        // 🎯 PERFECT INNER RADIUS (no weird shape)
        const innerRadius = meta.data[0].innerRadius;

        // 🧊 Draw inner circle slightly smaller (gap maintained)
        ctx.beginPath();
        ctx.arc(x, y, innerRadius - 10, 0, 2 * Math.PI);
        ctx.fillStyle = "#f8fafc"; // clean background
        ctx.fill();

        // subtle border
        ctx.strokeStyle = "#e5e7eb";
        ctx.lineWidth = 2;
        ctx.stroke();

        // 💰 TEXT (DYNAMIC)
        const centerData = chart.$centerText || {
          title: "Total Commission",
          value: total
        };

        ctx.textAlign = "center";

        ctx.fillStyle = "#111";
        ctx.font = "bold 22px sans-serif";
        ctx.fillText("₹" + Number(centerData.value).toLocaleString(), x, y - 8);

        ctx.fillStyle = "#666";
        ctx.font = "13px sans-serif";
        ctx.fillText(centerData.title, x, y + 15);

        ctx.restore();
      }
    };

    const chart = new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: ["Leader", "Adviser"],
        datasets: [{
          data: [leader, adviser],
          backgroundColor: [gradient1, gradient2],
          borderWidth: 0,
          hoverOffset: 20
        }]
      },
      options: {
        cutout: "70%",
        radius: "85%",

        plugins: {
          legend: {
            position: "top"
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                const value = context.raw;
                const percent = ((value / total) * 100).toFixed(1);
                return `${context.label}: ₹${value.toLocaleString()} (${percent}%)`;
              }
            }
          }
        },

        // 🔥 Hover center update
        onHover: (event, elements, chart) => {
          if (elements.length) {
            const index = elements[0].index;
            const label = chart.data.labels[index];
            const value = chart.data.datasets[0].data[index];

            chart.$centerText = {
              title: label,
              value: value
            };
          } else {
            chart.$centerText = {
              title: "Total Commission",
              value: total
            };
          }

          chart.draw();
        }
      },
      plugins: [innerCirclePlugin]
    });

    // 🔥 Update center dynamically
    chart.$centerText = {
      title: "Total Commission",
      value: total
    };
  }


  document.addEventListener("DOMContentLoaded", function() {
    loadSalesChart();
    loadCommissionChart();
  });
</script>

<?php include 'footer.php'; ?>