<?php include 'header.php'; ?>

<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow">

<h2 class="text-2xl font-bold mb-6 text-center">
  Update Advisor Commission
</h2>

<form id="updateCommissionForm" class="space-y-5">

  <!-- Site Location -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">
      Site Location
    </label>
    <input type="text" id="site_location"
      class="w-full border border-gray-300 p-2 rounded-lg">
  </div>

  <!-- Advisor Name -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">
      Advisor Name
    </label>
    <input type="text" id="advisor_name"
      class="w-full border border-gray-300 p-2 rounded-lg" readonly>
  </div>

  <!-- Commission Type -->
  <div>
    <label class="block text-gray-900 font-semibold mb-2">
      Commission Type
    </label>
    <div class="flex gap-6">
      <label class="flex items-center gap-2">
        <input type="radio" name="commission_type" value="percent">
        <span>Percentage (%)</span>
      </label>

      <label class="flex items-center gap-2">
        <input type="radio" name="commission_type" value="amount">
        <span>Fixed Amount (₹)</span>
      </label>
    </div>
  </div>

  <!-- Commission Value -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">
      Commission Value
    </label>
    <input type="text" id="commission_value"
      class="w-full border border-gray-300 p-2 rounded-lg">
  </div>

  <!-- Buttons -->
  <div class="flex justify-between mt-6">
    <a href="list_commission.php"
      class="px-5 py-2 rounded-lg border border-gray-300">
      Back
    </a>

    <button type="submit"
      class="bg-yellow-500 px-6 py-2 rounded-lg font-semibold">
      Update Commission
    </button>
  </div>

</form>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="../url.js"></script>

<script>
const token = localStorage.getItem("auth_token");
const id = new URLSearchParams(window.location.search).get("id");

// 1️⃣ Fetch Commission
$.ajax({
    url: url + "commission/" + id,
    type: "GET",
    headers: {
        "Authorization": "Bearer " + token,
        "Accept": "application/json"
    },
    success: function(response){

        let commission = response.data;

        $("#commission_value").val(commission.commission_value);

        $("input[name='commission_type'][value='" + commission.commission_type + "']")
            .prop("checked", true);

        // 2️⃣ Fetch Advisor Name
        $.ajax({
            url: url + "users/" + commission.user_id,
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            },
            success: function(userResponse){
                $("#advisor_name").val(userResponse.data.name);
            }
        });

        // 3️⃣ Fetch Site Location
        $.ajax({
            url: url + "site-location/" + commission.location_id,
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            },
            success: function(locResponse){
                $("#site_location").val(locResponse.data.site_location);
            }
        });

    }
});

$("#updateCommissionForm").submit(function(e){
    e.preventDefault();

    $.ajax({
        url: url + "commission/" + id,
        type: "PUT",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },
        data: {
            commission_type: $("input[name='commission_type']:checked").val(),
            commission_value: $("#commission_value").val()
        },
        success: function(){
            alert("Commission Updated Successfully");
            window.location.href = "list_commission.php";
        }
    });
});

</script>

<?php include 'footer.php'; ?>
