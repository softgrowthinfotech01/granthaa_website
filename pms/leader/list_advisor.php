<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

<h2 class="text-2xl font-bold mb-4 text-center">Advisor Records</h2>

<!-- Horizontal scroll wrapper -->
<div class="w-full overflow-x-auto">

<table id="example" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

<thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
<tr>
  <th data-priority="1" class="p-3 font-semibold text-left">Advisor Code</th>
  <th data-priority="2" class="p-3 font-bold text-left">Name</th>
  <th data-priority="3" class="p-3 font-semibold text-left">Phone</th>
  <th data-priority="4" class="p-3 font-semibold text-left">Address</th>
  <th data-priority="5" class="p-3 font-semibold text-left">PAN</th>
  <th data-priority="6" class="p-3 font-semibold text-left">Bank Name</th>
  <th data-priority="7" class="p-3 font-semibold text-left">Account No</th>
  <th data-priority="8" class="p-3 font-semibold text-left">IFSC</th>
  <th data-priority="9" class="p-3 font-semibold text-center">Action</th>
</tr>
</thead>

<tbody class="divide-y divide-gray-200">

<tr class="odd:bg-white even:bg-gray-50 hover:bg-yellow-50 transition text-center">

  <td class="p-3 whitespace-nowrap font-medium">ADV001</td>
  <td class="p-3 whitespace-nowrap">Ram</td>
  <td class="p-3 whitespace-nowrap">9876543210</td>
  <td class="p-3 whitespace-nowrap">Mumbai</td>

  <td class="p-3 whitespace-nowrap">
    <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">
      ABCDE1234F
    </span>
  </td>

  <td class="p-3 whitespace-nowrap">BOI</td>
  <td class="p-3 whitespace-nowrap">1234567890</td>

  <td class="p-3 whitespace-nowrap">
    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">
      BKID0001234
    </span>
  </td>

  <!-- Action buttons -->
  <td class="p-3 whitespace-nowrap">
    <div class="flex flex-col sm:flex-row gap-2 justify-center">

      <a href="update_advisor.php"
         class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 
                rounded-lg shadow-sm transition">
        Update
      </a>

      <a href=""
         class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 
                rounded-lg shadow-sm transition">
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
  
