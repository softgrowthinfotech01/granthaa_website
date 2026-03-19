<?php include 'header.php'; ?>
<div class="max-w-7xl mx-auto bg-white p-4 rounded-xl shadow">

<h2 class="text-lg sm:text-xl font-bold text-center mb-4">
My Referral Records
</h2>

<!-- Controls -->
<div class="flex flex-col sm:flex-row justify-between gap-3 mb-4">

<input
id="searchInput"
type="text"
placeholder="Search..."
class="border px-3 py-2 rounded w-full sm:w-60"
/>

<div class="flex items-center gap-2">
<label>Show</label>

<select id="perPage" class="border px-2 py-1 rounded">
<option value="10">10</option>
<option value="25">25</option>
<option value="50">50</option>
</select>

<span>entries</span>
</div>

</div>

<!-- TABLE WRAPPER -->
<div class="w-full overflow-x-auto">

<table class="min-w-[700px] w-full border border-gray-200">

<thead class="bg-gray-800 text-white">
<tr>
<th class="px-3 py-2">Customer Name</th>
<th class="px-3 py-2">Phone</th>
<th class="px-3 py-2">Email</th>
<th class="px-3 py-2">Status</th>
<th class="px-3 py-2">Date</th>
</tr>
</thead>

<tbody id="referralBody">

<tr class="border-t">
<td class="px-3 py-2">Test User</td>
<td class="px-3 py-2">9999999999</td>
<td class="px-3 py-2">test@mail.com</td>
<td class="px-3 py-2">Pending</td>
<td class="px-3 py-2">2026-03-19</td>
</tr>

</tbody>

</table>

</div>

<!-- Pagination -->
<div class="flex flex-col sm:flex-row justify-between items-center gap-3 mt-4">

<button id="prevBtn" class="bg-gray-200 px-4 py-2 rounded w-full sm:w-auto">
Prev
</button>

<span id="pageInfo">Page 1</span>

<button id="nextBtn" class="bg-gray-200 px-4 py-2 rounded w-full sm:w-auto">
Next
</button>

</div>

</div>
<?php include 'footer.php'; ?>

<script src="../url.js"></script>

<script>

let referrals = [];
let filteredReferrals = [];
let currentPage = 1;
let rowsPerPage = 10;

document.addEventListener("DOMContentLoaded", () => {

fetchReferrals();

document.getElementById("searchInput")
.addEventListener("input", function(){

let term = this.value.toLowerCase().trim();

if(term === ""){
filteredReferrals = referrals;
}
else{

filteredReferrals = referrals.filter(r => {

const searchableText = [
r.referred_name,
r.referred_contact,
r.referred_email,
r.status
].join(" ").toLowerCase();

return searchableText.includes(term) ||
searchableText.startsWith(term);

});

}

currentPage = 1;
renderTable();

});


document.getElementById("perPage").addEventListener("change", function(){

rowsPerPage = parseInt(this.value);

currentPage = 1;

renderTable();

});


document.getElementById("prevBtn").onclick = () => {

if(currentPage > 1){
currentPage--;
renderTable();
}

};

document.getElementById("nextBtn").onclick = () => {

if(currentPage < Math.ceil(filteredReferrals.length / rowsPerPage)){
currentPage++;
renderTable();
}

};

});

async function fetchReferrals(){

try{

const token = localStorage.getItem("auth_token");

const response = await fetch(url + "refered",{

method:"POST",

headers:{
"Authorization":"Bearer " + token,
"Accept":"application/json"
}

});

const result = await response.json();

referrals = result.data?.data || [];

if(!Array.isArray(referrals)){
referrals = [];
}

filteredReferrals = referrals;

renderTable();

}catch(error){

console.error("Error fetching referrals:", error);

}

}

function renderTable(){

const tbody = document.getElementById("referralBody");

tbody.innerHTML = "";

const start = (currentPage - 1) * rowsPerPage;
const end = start + rowsPerPage;

const pageData = filteredReferrals.slice(start,end);

if(pageData.length === 0){

tbody.innerHTML = `
<tr style="text-align:center;">
<td colspan="6">No referrals found</td>
</tr>
`;

return;

}

pageData.forEach(r => {

const row = `

<tr>


<td>${r.referred_name ?? "-"}</td>

<td>${r.referred_contact ?? "-"}</td>

<td>${r.referred_email ?? "-"}</td>

<td>
<span style="
padding:4px 8px;
border-radius:6px;
background:${r.status === 'pending' ? '#ffeeba' : '#c3e6cb'};
">
${r.status}
</span>
</td>

<td>${new Date(r.created_at).toLocaleDateString()}</td>

</tr>

`;

tbody.insertAdjacentHTML("beforeend", row);

});

document.getElementById("pageInfo").innerText =
`Page ${currentPage} of ${Math.ceil(filteredReferrals.length / rowsPerPage)}`;

}

</script>