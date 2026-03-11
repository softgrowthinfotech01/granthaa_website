<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Records</title>

<link rel="stylesheet" href="../style.css">

</head>

<body>

<div class="mx-auto">

<div class="flex flex-col">

<?php include "header.php"; ?>

<div class="flex">

<?php include "sidebar.php"; ?>

<div class="w-full sm:w-[95%] md:w-[80%] lg:w-[70%] mx-3 md:mx-auto my-4 self-start rounded-lg bg-slate-100 p-4 md:p-6 border border-default shadow-xs">

<!-- Search + Per Page -->
<div class="mb-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-3">

<input
type="text"
id="searchInput"
placeholder="Search by reference / remark"
class="px-3 py-2 border rounded w-full md:w-1/3">

<div class="flex items-center gap-2">

<label>Show:</label>

<select id="perPageSelect"
class="px-2 py-1 border rounded">

<option value="5">5</option>
<option value="10">10</option>
<option value="25">25</option>
<option value="50">50</option>

</select>

<span>entries</span>

</div>

</div>

<!-- Loader -->
<div id="tableLoader" class="hidden text-center py-6">

<div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-blue-500 border-t-transparent"></div>

<p class="mt-2 text-gray-600">Loading...</p>

</div>

<div class="overflow-x-auto">

<table class="w-full text-sm md:text-md text-left text-gray-600">

<thead class="text-xs text-gray-700 uppercase bg-gray-100">

<tr>

<th class="px-4 py-3">#</th>
<th class="px-4 py-3">User ID</th>
<th class="px-4 py-3">Amount</th>
<th class="px-4 py-3">Mode</th>
<th class="px-4 py-3">Reference</th>
<th class="px-4 py-3">Remark</th>
<th class="px-4 py-3">Created At</th>
<th class="px-4 py-3">Actions</th>

</tr>

</thead>

<tbody id="paymentTableBody">

<tr>
<td colspan="8" class="text-center py-4">Loading...</td>
</tr>

</tbody>

</table>

</div>

<!-- Pagination -->
<div id="paginationControls" class="flex flex-wrap justify-center gap-2 mt-4"></div>

<div id="resultInfo" class="text-sm text-gray-600 mt-2 text-center"></div>

</div>

</div>

<?php include "footer.php"; ?>

</div>

</div>

<script src="../url.js"></script>

<script>

let currentPage = 1;
let currentSearch = '';
let currentPerPage = 5;
let searchTimeout;

const token = localStorage.getItem("auth_token");

if(!token){
alert("Please login first");
window.location.href = "../login";
}

async function fetchPayments(page = 1){

currentPage = page;

const loader = document.getElementById('tableLoader');
const tbody = document.getElementById('paymentTableBody');
const pagination = document.getElementById('paginationControls');

try{

loader.classList.remove('hidden');
tbody.innerHTML='';
pagination.innerHTML='';

const response = await fetch(
url + `commission/payments?page=${page}&search=${currentSearch}&per_page=${currentPerPage}`,
{
method:"GET",
headers:{
"Accept":"application/json",
"Authorization":"Bearer " + token
}
}
);

const result = await response.json();

if(!response.ok){
alert(result.message || "Failed to fetch payments");
return;
}

const paginationData = result.data;
const payments = result?.data?.data ?? [];

if(payments.length === 0){

tbody.innerHTML = `
<tr>
<td colspan="8" class="text-center py-4">No records found</td>
</tr>`;

}else{

let rows = "";

payments.forEach((pay,index)=>{

rows += `
<tr class="border-b">

<td class="px-4 py-2">
${(paginationData.current_page - 1) * paginationData.per_page + index + 1}
</td>

<td class="px-4 py-2">
${pay.user?.name ?? pay.user_id}
</td>

<td class="px-4 py-2 text-green-600 font-semibold">
₹ ${Math.abs(pay.amount)}
</td>

<td class="px-4 py-2">${pay.payment_mode ?? ''}</td>

<td class="px-4 py-2">${pay.reference_no ?? ''}</td>

<td class="px-4 py-2">${pay.remark ?? ''}</td>

<td class="px-4 py-2">
${new Date(pay.created_at).toLocaleDateString()}
</td>

<td class="px-4 py-2 flex gap-2">

<button
onclick="deletePayment(${pay.id})"
class="px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-500">

Delete

</button>

</td>

</tr>
`;

});

tbody.innerHTML = rows;

}

document.getElementById('resultInfo').innerHTML =
`Showing ${paginationData.from} to ${paginationData.to} of ${paginationData.total} entries`;

if(paginationData.prev_page_url){

pagination.innerHTML += `
<button onclick="fetchPayments(${paginationData.current_page - 1})"
class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">

Prev

</button>`;
}

for(let i=1;i<=paginationData.last_page;i++){

pagination.innerHTML += `
<button onclick="fetchPayments(${i})"
class="px-3 py-1 rounded ${
i === paginationData.current_page
? 'bg-blue-600 text-white'
: 'bg-gray-200 hover:bg-gray-300'
}">
${i}
</button>`;
}

if(paginationData.next_page_url){

pagination.innerHTML += `
<button onclick="fetchPayments(${paginationData.current_page + 1})"
class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">

Next

</button>`;
}

}catch(error){

console.error("Error fetching payments:",error);
alert("Server error");

}finally{

loader.classList.add('hidden');

}

}

document.getElementById('searchInput')
.addEventListener('keyup',function(){

clearTimeout(searchTimeout);

searchTimeout = setTimeout(()=>{

currentSearch = this.value.trim();
fetchPayments(1);

},400);

});

document.getElementById('perPageSelect')
.addEventListener('change',function(){

currentPerPage = this.value;
fetchPayments(1);

});

async function deletePayment(id){

if(!confirm("Delete this payment record?")){
return;
}

try{

const response = await fetch(
url + `commission/payments/${id}`,
{
method:"DELETE",
headers:{
"Accept":"application/json",
"Authorization":"Bearer " + token
}
}
);

const result = await response.json();

if(!response.ok){
alert(result.message || "Delete failed");
return;
}

alert(result.message || "Deleted successfully");

fetchPayments(currentPage);

}catch(error){

console.error(error);
alert("Server error");

}

}

fetchPayments();

</script>

</body>
</html>