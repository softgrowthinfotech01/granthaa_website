<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Commission</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body>
    <!--Container -->
    <div class="mx-auto">
        <!--Screen-->
        <div class="flex flex-col">
            <!--Header Section Starts Here-->
            <?php include "header.php"; ?>
            <!--/Header-->

            <div class="flex">
                <!--Sidebar-->
                <?php include 'sidebar.php'; ?>
                <!--/Sidebar-->

                <!--Main-->
                <div class="w-[60%] mx-auto my-4 self-start rounded-lg bg-gray-200 p-6 border border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
                    <form class="w-full">
                        <div class="personal-details">
                            <h5 class="text-xl font-bold text-heading p-1">Update Leader Commission</h5>
                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="site" class="block mb-2.5 text-sm font-medium text-heading">Site Location</label>
                                    <select id="site" class="block w-full px-3 py-2.5 rounded-lg bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                                        <option selected>Choose a site location</option>
                                        <option value="Male">DSK</option>
                                        <option value="Female">Grantha</option>
                                        <option value="Others">Datala</option>
                                    </select>
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="leader" class="block mb-2.5 text-sm font-medium text-heading">Select Leader</label>
                                    <select id="leader" class="block w-full px-3 py-2.5 rounded-lg bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                                        <option selected>Choose a leader</option>
                                        <option value="">LEAD001</option>
                                        <option value="">LEAD002</option>
                                        <option value="">LEAD003</option>
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <div class="mb-5  px-1">
                                    <label class="block mb-2.5 text-sm font-medium text-heading">Commission Type</label>
                                    <div class="flex gap-4">
                                        <div class="flex items-center">
                                            <input type="radio" id="percentage" name="commissionType" value="percentage" class="w-4 h-4" checked />
                                            <label for="percentage" class="ml-2 text-sm font-medium text-heading">Percentage</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" id="amount" name="commissionType" value="amount" class="w-4 h-4" />
                                            <label for="amount" class="ml-2 text-sm font-medium text-heading">Amount</label>
                                        </div>
                                    </div></div>
                                
                            </div>
                            <div class="">
                                <div class="mb-5 px-1">
                                   <label for="commission" class="block mb-2.5 text-sm font-medium text-heading">Commission Value</label>
                                    <input type="text" id="commission" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter commission value" required />
                                </div>
                            </div>
                        </div>
                   
                        <hr class="border-white-300 mb-3">
                        <div class="flex justify-center gap-2">
                            <button type="submit" class="w-[15%] text-white bg-blue-600 box-border border border-transparent hover:bg-blue-400 rounded-lg focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Update</button>
                            <button type="button"
                                onclick=""
                                class="w-[15%] text-gray-700 bg-white hover:bg-gray-200 rounded-lg text-sm px-5 py-2.5">
                               Back
                            </button>
                        </div>
                    </form>
                </div>
                <!--/Main-->
            </div>
            <!--Footer-->
            <?php include 'footer.php'; ?>
            <!--/footer-->

        </div>

    </div>

    <script>
function confirmReset() {
    if (confirm("Clear all entered data?")) {
        document.querySelector("form").reset();
    }
}
</script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>