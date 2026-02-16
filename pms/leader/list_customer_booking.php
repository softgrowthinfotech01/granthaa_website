<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

<h2 class="text-2xl font-bold mb-4 text-center">Customer and Plot Details</h2>

<!-- Horizontal scroll wrapper -->
<div class="w-full overflow-x-auto">

<table id="example" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

<thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
<tr>
  <th data-priority="1" class="p-3 font-semibold text-left">Leader Name</th>
  <th data-priority="2" class="p-3 font-semibold text-left">Buyer Name</th>
  <th data-priority="3" class="p-3 font-semibold text-left">Phone</th>
  <th data-priority="4" class="p-3 font-semibold text-left">DOB</th>
  <th data-priority="5" class="p-3 font-semibold text-left">Email</th>
  <th data-priority="6" class="p-3 font-semibold text-left">PAN No.</th>
  <th data-priority="7" class="p-3 font-semibold text-left">Aadhar No.</th>
  <th data-priority="8" class="p-3 font-semibold text-left">Address</th>
  <th data-priority="9" class="p-3 font-semibold text-left">City</th>
  <th data-priority="10" class="p-3 font-semibold text-left">State</th>
  <th data-priority="11" class="p-3 font-semibold text-left">Pin code</th>
  <th data-priority="12" class="p-3 font-semibold text-left">Advanced Booking AMT</th>
  <th data-priority="13" class="p-3 font-semibold text-left">Site Location</th>
  <th data-priority="14" class="p-3 font-semibold text-left">Commission Type</th>
  <th data-priority="15" class="p-3 font-semibold text-left">Project Name</th>
  <th data-priority="16" class="p-3 font-semibold text-left">Plot / Flat No.</th>
  <th data-priority="17" class="p-3 font-semibold text-left">Khasara No.</th>
  <th data-priority="18" class="p-3 font-semibold text-left">P.H. No.</th>
  <th data-priority="19" class="p-3 font-semibold text-left">Mouza</th>
  <th data-priority="20" class="p-3 font-semibold text-left">Tahsil</th>
  <th data-priority="21" class="p-3 font-semibold text-left">District</th>
  <th data-priority="22" class="p-3 font-semibold text-left">Sq. Feet</th>
  <th data-priority="23" class="p-3 font-semibold text-left">Sq. Mtr</th>
  <th data-priority="24" class="p-3 font-semibold text-left">Total Booking Amt.</th>
  <th data-priority="25" class="p-3 font-semibold text-left">Payment Mode</th>
  <th data-priority="26" class="p-3 font-semibold text-left">Remark</th>
  <th data-priority="27" class="p-3 font-semibold text-center">Action</th>
</tr>
</thead>

<tbody class="divide-y divide-gray-200">

<tr class="odd:bg-white even:bg-gray-50 hover:bg-yellow-50 transition text-center">

  <td class="p-3 whitespace-nowrap font-medium">Rahul</td>
  <td class="p-3 whitespace-nowrap">Ram</td>
  <td class="p-3 whitespace-nowrap">9876543210</td>
  <td class="p-3 whitespace-nowrap">01/07/2000</td>
  <td class="p-3 whitespace-nowrap ">rahul@gmail.com</td>
  <td class="p-3 whitespace-nowrap">ABCDE9689P</td>
  <td class="p-3 whitespace-nowrap">121212121212</td>
  <td class="p-3 whitespace-nowrap">Chandrapur</td>
    <td class="p-3 whitespace-nowrap ">Chandrapur</td>
  <td class="p-3 whitespace-nowrap">MH</td>
  <td class="p-3 whitespace-nowrap">442935</td>
  <td class="p-3 whitespace-nowrap">1,50,000</td>
  <td class="p-3 whitespace-nowrap ">Dewada</td>
  <td class="p-3 whitespace-nowrap">Percentage</td>
  <td class="p-3 whitespace-nowrap">Grantha</td>
  <td class="p-3 whitespace-nowrap">20</td>
    <td class="p-3 whitespace-nowrap ">35</td>
  <td class="p-3 whitespace-nowrap">66</td>
  <td class="p-3 whitespace-nowrap">Kosara</td>
  <td class="p-3 whitespace-nowrap">Chandrapur</td>
  <td class="p-3 whitespace-nowrap ">Chandrapur</td>
  <td class="p-3 whitespace-nowrap">1500</td>
  <td class="p-3 whitespace-nowrap">200</td>
  <td class="p-3 whitespace-nowrap">5,50,500</td>
  
  <td class="p-3 whitespace-nowrap">RTGS/NEFT</td>
  <td class="p-3 whitespace-nowrap">GOOD PLOT</td>


  <!-- Action buttons -->
  <td class="p-3 whitespace-nowrap">
    <div class="flex flex-col sm:flex-row gap-2 justify-center">

      <a href="update_customer_booking.php"
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
  
