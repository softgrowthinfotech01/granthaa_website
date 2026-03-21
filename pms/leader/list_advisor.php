<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-3 sm:p-4 rounded-2xl shadow-xl">

    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center">
        Advisor Records
    </h2>

    <!-- Search -->
    <input type="text" id="searchInput"
        placeholder="Search advisors..."
        class="border p-2 rounded mb-3 w-full sm:w-1/3">

    <!-- Table wrapper -->
    <div class="w-full overflow-x-auto">

        <table id="example"
            class="min-w-[900px] w-full text-sm text-left border border-gray-200">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 whitespace-nowrap">Advisor Code</th>
                    <th class="p-3 whitespace-nowrap">Name</th>
                    <th class="p-3 whitespace-nowrap">Phone</th>
                    <th class="p-3 whitespace-nowrap">Address</th>
                    <th class="p-3 whitespace-nowrap">PAN</th>
                    <th class="p-3 whitespace-nowrap">Bank Name</th>
                    <th class="p-3 whitespace-nowrap">Account No</th>
                    <th class="p-3 whitespace-nowrap">IFSC</th>
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


<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script src="../url.js"></script>
<script>
    $(document).ready(function() {

        const token = localStorage.getItem('auth_token');
        if (!token) {
            alert("Please login first");
            window.location.href = "../login";
            return;
        }

        let currentPage = 1;
        let perPage = 10;

        function loadAdvisors(page = 1, search = '') {

            $.ajax({
                url: url + "users",
                data: {
                    page: page,
                    per_page: perPage,
                    search: search,
                    role: "adviser"
                },
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                },
                success: function(response) {

                    let tbody = $("tbody");
                    tbody.empty();

                    let advisors = response.data.data;
                    let pagination = response.data;

                    if (advisors.length === 0) {
                        tbody.append(`<tr>
                        <td colspan="9" class="text-center p-4">No Records Found</td>
                    </tr>`);
                    }

                    advisors.forEach(function(advisor) {

                        tbody.append(`
                        <tr class="border-b">
                            <td class="p-3">${advisor.user_code ?? ''}</td>
                            <td class="p-3">${advisor.name ?? ''}</td>
                            <td class="p-3">${advisor.contact_no ?? ''}</td>
                            <td class="p-3">${advisor.address ?? ''}</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">
                                    ${advisor.pancard_number ?? ''}
                                </span>
                            </td>
                            <td class="p-3">${advisor.bank_name ?? ''}</td>
                            <td class="p-3">${advisor.bank_account_no ?? ''}</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">
                                    ${advisor.bank_ifsc_code ?? ''}
                                </span>
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex flex-col sm:flex-row gap-2 justify-center">
                                    <a href="update_advisor.php?id=${advisor.id}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-lg shadow-sm transition">
                                       Update
                                    </a>
                                    <button onclick="deleteAdvisor(${advisor.id})"
                                       class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-lg shadow-sm transition">
                                       Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `);
                    });

                    // Pagination Controls
                    $("#pagination").html(`
                    <div class="flex justify-between items-center mt-4">
                        <button ${pagination.current_page == 1 ? 'disabled' : ''}
                            onclick="changePage(${pagination.current_page - 1})"
                            class="bg-gray-300 px-4 py-2 rounded">
                            Previous
                        </button>

                        <span>Page ${pagination.current_page} of ${pagination.last_page}</span>

                        <button ${pagination.current_page == pagination.last_page ? 'disabled' : ''}
                            onclick="changePage(${pagination.current_page + 1})"
                            class="bg-gray-300 px-4 py-2 rounded">
                            Next
                        </button>
                    </div>
                `);

                    currentPage = pagination.current_page;
                },
                error: function(error) {
                    if (error.status === 401 || error.status === 403) {
                        alert("Unauthorized. Please login again.");
                        window.location.href = "../login";
                    }
                }
            });
        }

        // Load first page
        loadAdvisors();

        // Search event
        $("#searchInput").on("keyup", function() {
            let value = $(this).val();
            loadAdvisors(1, value);
        });

        window.changePage = function(page) {
            loadAdvisors(page, $("#searchInput").val());
        }

    });

    function deleteAdvisor(id) {

        const token = localStorage.getItem('auth_token');

        if (!confirm("Are you sure you want to delete this advisor?")) return;

        $.ajax({
            url: url + "users/" + id,
            type: "DELETE",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            },
            success: function(response) {
                alert("Deleted Successfully");
                location.reload();
            }
        });
    }
</script>