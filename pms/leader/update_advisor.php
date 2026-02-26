<?php include 'header.php'; ?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow">

  <h2 class="text-2xl font-bold mb-6 text-center">
    Update Advisor Details
  </h2>

  <form id="updateForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Advisor Code -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Advisor Code</label>
      <input type="text" name="advisor_code" value="" id="advisor_code"
        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Full Name -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Full Name</label>
      <input type="text" name="name" value="" id="name"
        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Phone -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Phone Number</label>
      <input type="text" name="phone" value=""
        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- PAN Card -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">PAN Card Number</label>
      <input type="text" name="pan" value="" id="pancard_number"
        class="w-full border border-gray-300 p-2 rounded-lg uppercase focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Address -->
    <div class="md:col-span-2">
      <label class="block text-gray-900 font-semibold mb-1">Address</label>
      <textarea name="address" rows="3" id="address"
        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400"></textarea>
    </div>

    <!-- Bank Name -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Bank Name</label>
      <input type="text" name="bank_name" value="" id="bank_name"
        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Account Number -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Account Number</label>
      <input type="text" name="account_no" value="" id="bank_account_no"
        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- IFSC Code -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">IFSC Code</label>
      <input type="text" name="ifsc" value="" id="bank_ifsc_code"
        class="w-full border border-gray-300 p-2 rounded-lg uppercase focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Buttons -->
    <div class="md:col-span-2 flex justify-between mt-6">

      <a href="list_advisor.php"
        class="px-5 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
        Back
      </a>

      <button type="submit"
        class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-2 rounded-lg font-semibold transition">
        Update Advisor
      </button>

    </div>

  </form>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="../url.js"></script>

<script>
  const token = localStorage.getItem("auth_token");
  const id = new URLSearchParams(window.location.search).get("id");

  if (!token) {
    alert("Please login first");
    window.location.href = "../login";
  }

  // Fetch existing advisor
  $.ajax({
    url: url + "users/" + id,
    type: "GET",
    headers: {
      "Authorization": "Bearer " + token,
      "Accept": "application/json"
    },
    success: function(response) {

      let advisor = response.data;

      $("#advisor_code").val(advisor.user_code);
      $("#name").val(advisor.name);
      $("#contact_no").val(advisor.contact_no);
      $("#pancard_number").val(advisor.pancard_number);
      $("#address").val(advisor.address);
      $("#bank_name").val(advisor.bank_name);
      $("#bank_account_no").val(advisor.bank_account_no);
      $("#bank_ifsc_code").val(advisor.bank_ifsc_code);
    }
  });


  // Submit Update
  $("#updateForm").submit(function(e) {
    e.preventDefault();

    $.ajax({
      url: url + "users/" + id,
      type: "PATCH",
      headers: {
        "Authorization": "Bearer " + token,
        "Accept": "application/json"
      },
      data: {
        user_code: $("#advisor_code").val(),
        name: $("#name").val(),
        contact_no: $("#contact_no").val(),
        pancard_number: $("#pancard_number").val(),
        address: $("#address").val(),
        bank_name: $("#bank_name").val(),
        bank_account_no: $("#bank_account_no").val(),
        bank_ifsc_code: $("#bank_ifsc_code").val()
      },
      success: function(response) {
        alert("Advisor Updated Successfully");
        window.location.href = "list_advisor.php";
      },
      error: function(err) {
        console.log(err.responseJSON);
        alert("Update Failed");
      }
    });

  });
</script>

<?php include 'footer.php'; ?>