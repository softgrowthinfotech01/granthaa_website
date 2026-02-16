<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-6 rounded-2xl shadow-xl">

<h2 class="text-2xl font-bold mb-4 text-center">Advisor Commission Records</h2>

<!-- Table wrapper for horizontal scroll -->
<div class="w-full overflow-x-auto">

<table id="example" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

<thead class="bg-gradient-to-r from-gray-100 to-gray-300 text-gray-700">
<tr>
  <th data-priority="1" class="p-3 text-center font-semibold">Advisor Code</th>
  <th data-priority="2" class="p-3 text-center font-semibold">Advisor Name</th>
  <th data-priority="3" class="p-3 text-center font-semibold">Commission</th>
  <th data-priority="4" class="p-3 text-center font-semibold">Action</th>
</tr>
</thead>

<tbody class="text-center divide-y divide-gray-200">

<tr class="odd:bg-white even:bg-gray-100 hover:bg-yellow-50 transition">
  <td class="p-3 whitespace-nowrap font-medium">ADV001</td>
  <td class="p-3 whitespace-nowrap">Ravi Raj</td>
  <td class="p-3 whitespace-nowrap font-semibold ">5 %</td>

  <td class="p-3 whitespace-nowrap">
    <div class="flex gap-2 justify-center">

      <a href="update_commission.php"
         class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-lg shadow-sm transition">
        Update
      </a>

      <a href=""
         class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-lg shadow-sm transition">
        Delete
      </a>

    </div>
  </td>
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
