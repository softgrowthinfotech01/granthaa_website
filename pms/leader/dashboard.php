<?php include 'header.php'; ?>

<!-- Css for Cards -->
<style>
  .card p {
    font-size: 19px;
    font-weight: 500;
    line-height: 20px;
    color: gray;
  }

  .card p1 {
    font-size: 21px;
    font-weight: 600;
    line-height: 20px;
    color: black;
  }

  .card p.small {
    font-size: 14px;
  }

  .go-corner {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    width: 32px;
    height: 32px;
    overflow: hidden;
    top: 0;
    right: 0;
    background-color: #00838d;
    border-radius: 0 4px 0 32px;
  }

  .go-arrow {
    margin-top: -4px;
    margin-right: -4px;
    color: white;
    font-family: courier, sans;
  }

  .card1 {
    display: block;
    position: relative;
    max-width: 320px;
    background-color: #f8fafc;
    border-radius: 4px;
    padding: 32px 24px;
    margin: 12px;
    text-decoration: none;
    z-index: 0;
    overflow: hidden;
  }

  .card1:before {
    content: "";
    position: absolute;
    inset: 0;
    /* covers full card */
    background: #00838d;
    transform: scale(0);
    transform-origin: top right;
    transition: transform 0.3s ease-out;
    border-radius: inherit;
    z-index: -1;
  }

  .card1:hover:before {
    transform: scale(1);
  }

  .card1:hover p {
    transition: all 0.3s ease-out;
    color: rgba(255, 255, 255, 0.8);
  }

  .card1:hover h3 {
    transition: all 0.3s ease-out;
    color: #fff;
  }

  .card2 {
    display: block;
    position: relative;
    max-width: 320px;
    background-color: #f8fafc;
    border-radius: 4px;
    padding: 32px 24px;
    margin: 12px;
    text-decoration: none;
    z-index: 0;
    overflow: hidden;
  }

  .card4 {
  display: block;
  position: relative;
  max-width: 320px;
  background-color: #f8fafc;
  border-radius: 4px;
  padding: 32px 24px;
  margin: 12px;
  text-decoration: none;
  z-index: 0;
  overflow: hidden;

  min-height: 148px;
}

.card4:before {
  content: "";
  position: absolute;
  inset: 0;
  background: #00838d;
  transform: scale(0);
  transform-origin: top right;
  transition: transform 0.3s ease-out;
  border-radius: inherit;
  z-index: -1;
}

.card4:hover:before {
  transform: scale(1);
}

.card4:hover p {
  transition: all 0.3s ease-out;
  color: rgba(255, 255, 255, 0.8);
}

.card4:hover h3 {
  transition: all 0.3s ease-out;
  color: #fff;
}
</style>
<!-- Css for Cards -->

<!-- New UI -->
<div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-4">
  <div class="card">
    <div class="card1">
      <p1 class="font-semibold">My Performance</p1>

      <p class="small">₹ Total Booking: <span id="totalBooking"></span></p>
      <p class="small">% Total Commission: <span id="totalCommission"></span></p>
      <p class="small">🏆 My Bookings: <span id="mybooking"></span></p>

    </div>
  </div>
  <div class="card">
    <a class="card1" href="advisor_payment_summary">
      <p1 class="font-semibold">Advisor Performance</p1>

      <p class="small">₹ Total Booking: <span id="teamtotalBooking"></span></p>
      <p class="small">% Total Commission: <span id="teamtotalCommission"></span></p>
      <p class="small">🏆 Team Bookings: <span id="teambooking"></span></p>

      <div class="go-corner">
        <div class="go-arrow">→</div>
      </div>
    </a>
  </div>
  <div class="card">
    <a class="card1" href="team_performance">
      <p1 class="font-semibold">Advisor Insights</p1>

      <p class="small">👥 Total Advisors: <span id="totalAdvisors"></span></p>
      <p class="small">⭐ Top Advisor: <span id="topAdvisor"></span></p>

      <div class="go-corner">
        <div class="go-arrow">→</div>
      </div>
    </a>
  </div>
  <div class="card">
    <a class="card4" href="list_customer_booking">
      <p1 class="font-bold">Overall Summary</p1>

      <p class="small py-2">₹ Total Booking: <span id="total_booking_amount"></span></p>
      <p class="small mb-[30px]">% Total Commission: <span id="total_commission_amount"></span></p>

      <div class="go-corner">
        <div class="go-arrow">→</div>
      </div>
    </a>
  </div>
</div>
<!-- New UI -->


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