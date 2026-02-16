<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

<h2 class="text-2xl font-bold mb-4 text-center">Referred Customer Records</h2>

<!-- Horizontal scroll wrapper -->
<div class="w-full overflow-x-auto">

<table id="example" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

<thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
<tr>                
  <th data-priority="1" class="p-3 font-semibold text-left">Refferal Code</th>
  <th data-priority="2" class="p-3 font-bold text-left">Leader / Adviser</th>
  <th data-priority="3" class="p-3 font-semibold text-left">Site Location</th>
  <th data-priority="4" class="p-3 font-semibold text-left">Customer Name</th>
  <th data-priority="5" class="p-3 font-semibold text-left">Phone No.</th>
  <th data-priority="6" class="p-3 font-semibold text-left">Customer Location</th>
</tr>
</thead>

<tbody class="divide-y divide-gray-200">

<tr class="odd:bg-white even:bg-gray-50 hover:bg-yellow-50 transition text-center">

  <td class="p-3 whitespace-nowrap font-medium">REF001</td>
  <td class="p-3 whitespace-nowrap">ADV001</td>
  <td class="p-3 whitespace-nowrap">Datala</td>
  <td class="p-3 whitespace-nowrap">Kailash</td>
    <td class="p-3 whitespace-nowrap">9876543210</td>
    <td class="p-3 whitespace-nowrap">Chandrapur</td>
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
			
			var table = $('#example').DataTable( {
					responsive: true
				} )
				.columns.adjust()
				.responsive.recalc();
		} );
	
	</script>
  
