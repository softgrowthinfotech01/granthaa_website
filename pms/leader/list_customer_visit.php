<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">
    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center">
        Customer Visit Records
    </h2>

    <!-- Search -->
    <input type="text" id="searchInput"
        placeholder="Search customer visits..."
        class="border p-2 rounded mb-3 w-full sm:w-1/3">

    <!-- Table wrapper -->
    <div class="w-full overflow-x-auto">

        <table id="example"
            class="min-w-[900px] w-full text-sm text-left border border-gray-200">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 whitespace-nowrap">Site Location</th>
                    <th class="p-3 whitespace-nowrap">Name</th>
                    <th class="p-3 whitespace-nowrap">Email</th>
                    <th class="p-3 whitespace-nowrap">Phone</th>
                    <th class="p-3 whitespace-nowrap">Aadhar</th>
                    <th class="p-3 whitespace-nowrap">Gender</th>
                    <th class="p-3 text-center whitespace-nowrap">Action</th>
                </tr>
            </thead> 

            <tbody class="divide-y divide-gray-200">
            </tbody>

        </table>

    </div>

    <div id="pagination" class="mt-4"></div>

</div> 

<?php include 'footer.php'; ?>

<script>

document.addEventListener("DOMContentLoaded", function(){

const token = localStorage.getItem('auth_token');

if(!token){
    alert("Please login first");
    window.location.href="../login";
    return;
}

let visitsData=[];


/* ================= LOAD VISITS ================= */

function loadVisits(){

fetch(url+"customer-visits",{
    method:"GET",
    headers:{
        "Authorization":"Bearer "+token,
        "Accept":"application/json"
    }
})
.then(res=>res.json())
.then(response=>{

    visitsData=response.data ?? [];

    renderTable(visitsData);
});
}

loadVisits();



/* ================= RENDER TABLE ================= */

function renderTable(data){

const tbody=document.querySelector("#example tbody");

tbody.innerHTML="";

if(data.length===0){
    tbody.innerHTML=`
        <tr>
            <td colspan="7" class="text-center p-4">
                No Records Found
            </td>
        </tr>`;
    return;
}

data.forEach(v=>{

tbody.innerHTML+=`
<tr class="hover:bg-gray-50">

<td class="p-3">${v.location?.site_location ?? '-'}</td>

<td class="p-3 font-semibold">${v.name}</td>

<td class="p-3">${v.email}</td>

<td class="p-3">${v.contact_no}</td>

<td class="p-3">${v.aadhaar_number}</td>

<td class="p-3 capitalize">${v.gender}</td>

<td class="p-3 text-center">

${
v.released==0
? `<button onclick="releaseCustomer(${v.id})"
    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
    Release
   </button>`
: `<span class="text-green-600 font-semibold">Released</span>`
}

</td>

</tr>
`;
});

}



/* ================= RELEASE CUSTOMER ================= */

window.releaseCustomer=function(id){

if(!confirm("Release this customer?")) return;

fetch(url+"customer-visits/"+id+"/release",{
    method:"POST",
    headers:{
        "Authorization":"Bearer "+token,
        "Accept":"application/json"
    }
})
.then(res=>res.json())
.then(result=>{

alert(result.message);

loadVisits();

})
.catch(()=>{
alert("Release failed");
});

};



/* ================= SEARCH ================= */

document.getElementById("searchInput")
.addEventListener("keyup",function(){

const keyword=this.value.toLowerCase();

const filtered=visitsData.filter(v=>

    v.name.toLowerCase().includes(keyword) ||
    v.email.toLowerCase().includes(keyword) ||
    v.contact_no.toLowerCase().includes(keyword) ||
    (v.location?.site_location ?? "")
        .toLowerCase()
        .includes(keyword)
);

renderTable(filtered);

});

});

</script>