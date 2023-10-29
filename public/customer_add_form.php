<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Windmill Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="./assets/js/init-alpine.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
  <script src="./assets/js/charts-lines.js" defer></script>
  <script src="./assets/js/charts-pie.js" defer></script>
  <script src="./pages/js/main.js"></script>


</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
    <?php
    $ActiveHomeBar = '';
    $HomeActiveTextColor = '';

    $ActiveCustomerBar = '';
    $CustomerActiveTextColor = 'text-gray-800';

    $ActiveRoomsBar = '';
    $RoomActiveTextColor = '';

    $ActiveSettingsBar = '';
    $SettingsActiveTextColor = '';
    include './php/header-asidebar.php';
    ?>

    <div class="flex flex-col flex-1 w-full">
      <?php
      include './php/header.php';
      ?>
      <main class="h-full overflow-y-auto">
        <div class="container px-6 mb-6 mx-auto grid">
          <h4 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300" data-translate="AddCustBtn">
            Add Customer
          </h4>
          <div class="w-full  max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto p-6">

            <!-- Name -->
            <div class="flex flex-wrap -mx-4">
              <!-- Name -->
              <div class="w-full md:w-1/2 ">
                <div class="flex flex-wrap -mx-4">
                  <!-- Name -->
                  <div class="w-full md:w-1/2 px-4">
                    <label class="block text-sm">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="Name">Name <span class="text-red-600 font-bold">*</span></span>
                      <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" required />
                    </label>
                  </div>
                  <div class="w-full md:w-1/2 px-4">
                    <!-- Email -->
                    <label class="block text-sm" da>
                      <span class="text-gray-700 dark:text-gray-400" data-translate="email">Email
                        <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="email" placeholder="jane@example.com" />
                    </label>
                  </div>
                </div>
              </div>


              <div class="w-full md:w-1/2">
                <div class="flex flex-wrap -mx-4">
                  <!-- Mobile Number -->
                  <div class="w-full md:w-1/2 px-4">
                    <label class="block  text-sm">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="MobileNum">Mobile Number<span class="text-red-600 font-bold">*</span></span>
                      <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="123-456-7890" required />
                    </label>
                  </div>
                  <div class="w-full md:w-1/2 px-4">
                    <!-- Designation -->
                    <label class="block  text-sm">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="Designation">Designation <span class="text-red-600 font-bold">*</span></span>
                      <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Designer" required />
                    </label>
                  </div>
                </div>
              </div>
            </div>




            <div class="flex flex-wrap -mx-4">
              <div class="w-full md:w-1/2 ">
                <div class="flex flex-wrap -mx-4">
                  <div class="w-full md:w-1/2 px-4">

                    <!-- Account Number -->
                    <label class="block mt-4 text-sm">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="AccountNum">Account Number <span class="text-red-600 font-bold">*</span></span>
                      <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="123" required />
                    </label>
                  </div>
                  <div class="w-full md:w-1/2 px-4">
                    <label class="block mt-4 text-sm">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="SelectRoomNum">
                        Select Room Number<span class="text-red-600 font-bold">*</span>
                      </span>
                      <select class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                      </select>
                    </label>
                  </div>
                </div>
              </div>
              <div class="w-full md:w-1/2 ">
                <!-- Address -->
                <label class="block mt-4 px-4 text-sm">
                  <span class="text-gray-700 dark:text-gray-400" data-translate="Address">Address <span class="text-red-600 font-bold">*</span></span>
                  <textarea rows="1" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Enter Address"></textarea>
                </label>
              </div>
            </div>

            <div class="flex flex-wrap -mx-4">
              <div class="w-full md:w-1/2 px-4">
                <!-- Documents Upload -->
                <label class="block mt-4 text-sm">
                  <span class="text-gray-700 dark:text-gray-400" data-translate="UploadDoc">Upload Documents <span class="text-red-600 font-bold">*</span></span>
                  <input type="file" multiple class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input" accept=".pdf, .docx, .jpg, .png" required />
                </label>
              </div>
              <div class="w-full md:w-1/2 px-4">
                <!-- Photo upload  -->
                <label class="block mt-4  text-sm">
                  <span class="text-gray-700 dark:text-gray-400" data-translate="UploadPhoto">Upload Photo<span class="text-red-600 font-bold">*</span></span>
                  <input type="file" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input" accept=".pdf, .docx, .jpg, .png" required />
                </label>
              </div>
            </div>
            <div class="flex flex-wrap -mx-4">
              <div class="w-full md:w-1/2 px-4 mt-4">
                <span class="text-gray-700 dark:text-gray-400 " data-translate="DepositPaid">
                  Deposit paid ?(Rs 2500)<span class="text-red-600 font-bold">*</span>
                </span>
                <div class="mt-2">
                  <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                    <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="accountType" value="personal" />
                    <span class="ml-2" data-translate="Yes">Yes</span>
                  </label>
                  <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                    <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="accountType" value="busines" />
                    <span class="ml-2" data-translate="No">No</span>
                  </label>
                </div>
              </div>
              <div class="w-full md:w-1/2 px-4">

              </div>
            </div>
            <!-- Terms and Conditions -->
            <!-- <div class="mt-6 px-4 text-sm">
              <label class="flex items-center dark:text-gray-400">
                <input type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required />
                <span class="ml-2">
                  I agree to the
                  <span class="underline">terms and conditions</span>
                </span>
              </label>
            </div> -->

            <!-- Submit Button -->
            <button class="mt-6 bg-purple-600 text-white ml-4  text-sm font-medium py-2 px-4 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" type="submit" data-translate="SubmitBtn">Submit</button>
            <a href="./customer_list.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700" data-translate="CancelBtn">Cancel</a>

          </div>


        </div>


      </main>
    </div>
  </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>


</script>

</html>