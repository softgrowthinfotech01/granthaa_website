<?php include 'header.php'; ?>
<!-- http://127.0.0.1:8000/api/adviserPerformance -->
<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

  <h2 class="text-2xl font-bold mb-4 text-center">
    Team Performance & Bookings
  </h2>

  <!-- Table Wrapper -->
  <div class="w-full overflow-x-auto">

    <table id="example" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

      <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
        <tr>
          <th data-priority="1" class="p-3 font-semibold">#</th>
          <th data-priority="2" class="p-3 font-semibold">Customer</th>
          <th data-priority="3" class="p-3 font-semibold">Plot No.</th>
          <th data-priority="4" class="p-3 font-semibold">Total Commission</th>
          <th data-priority="5" class="p-3 font-semibold">Paid</th>
          <th data-priority="6" class="p-3 font-semibold">Balance</th>
          <th data-priority="7" class="p-3 font-semibold">Created On</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-200 text-center">
      </tbody>

    </table>

  </div>

</div>

<?php include 'footer.php'; ?>




<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!--Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="../url.js"></script>
