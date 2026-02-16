<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

<h2 class="text-2xl font-bold mb-4 text-center">
  My Bookings Record
</h2>

<!-- Table Wrapper -->
<div class="w-full overflow-x-auto">

<table id="example2" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

<thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
<tr>
  <th data-priority="1" class="p-3 font-semibold">Leader / Adviser</th>
  <th data-priority="2" class="p-3 font-semibold">Site Location</th>
  <th data-priority="3" class="p-3 font-semibold">Plot / Flat No.</th>
  <th data-priority="4" class="p-3 font-semibold">Khasa No.</th>
  <th data-priority="5" class="p-3 font-semibold">Sq. Feet</th>
  <th data-priority="6" class="p-3 font-semibold">Total Booking Amt</th>
</tr>
</thead>

<tbody class="divide-y divide-gray-200 text-center">

<tr class="odd:bg-white even:bg-gray-50 hover:bg-yellow-50 transition">
  <td class="p-3 font-medium">ADV001 - AMAN</td>
  <td class="p-3">DSK</td>
  <td class="p-3">02</td>
  <td class="p-3">05</td>
  <td class="p-3 font-semibold">1500</td>
  <td class="p-3 text-green-600 font-semibold">₹ 25,00,000</td>
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
