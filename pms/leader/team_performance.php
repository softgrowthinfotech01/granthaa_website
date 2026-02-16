<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

<h2 class="text-2xl font-bold mb-4 text-center">
  Team Performance & Bookings
</h2>

<!-- Table Wrapper -->
<div class="w-full overflow-x-auto">

<table id="example2" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

<thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
<tr>
  <th data-priority="1" class="p-3 font-semibold">Advisor Code</th>
  <th data-priority="2" class="p-3 font-semibold">Advisor Name</th>
  <th data-priority="3" class="p-3 font-semibold">Location</th>
  <th data-priority="4" class="p-3 font-semibold">Total Deals</th>
  <th data-priority="5" class="p-3 font-semibold">Total Booking Amount</th>
  <th data-priority="6" class="p-3 font-semibold">Commission</th>
  <th data-priority="7" class="p-3 font-semibold">Rank</th>
</tr>
</thead>

<tbody class="divide-y divide-gray-200 text-center">

<tr class="odd:bg-white even:bg-gray-50 hover:bg-yellow-50 transition">
  <td class="p-3 font-medium">ADV001</td>
  <td class="p-3">Harish</td>
  <td class="p-3">Pune</td>
  <td class="p-3">5</td>
  <td class="p-3 font-semibold">₹ 5,00,000</td>
  <td class="p-3 text-yellow-600 font-semibold">₹ 25,000</td>
  <td class="p-3 font-bold text-green-600">1</td>
</tr>

<tr class="odd:bg-white even:bg-gray-50 hover:bg-yellow-50 transition">
  <td class="p-3 font-medium">ADV002</td>
  <td class="p-3">Rohit</td>
  <td class="p-3">Mumbai</td>
  <td class="p-3">3</td>
  <td class="p-3 font-semibold">₹ 3,00,000</td>
  <td class="p-3 text-yellow-600 font-semibold">₹ 15,000</td>
  <td class="p-3 font-bold text-blue-600">2</td>
</tr>

<tr class="odd:bg-white even:bg-gray-50 hover:bg-yellow-50 transition">
  <td class="p-3 font-medium">ADV003</td>
  <td class="p-3">Amit</td>
  <td class="p-3">Nagpur</td>
  <td class="p-3">2</td>
  <td class="p-3 font-semibold">₹ 2,00,000</td>
  <td class="p-3 text-yellow-600 font-semibold">₹ 10,000</td>
  <td class="p-3 font-bold text-yellow-600">3</td>
</tr>

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
	<script>
		$(document).ready(function() {
			
			var table = $('#example2').DataTable( {
					responsive: true
				} )
				.columns.adjust()
				.responsive.recalc();
		} );
	
	</script>
