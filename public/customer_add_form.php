<?php
include './php/handleSession.php';
?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Windmill Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="./assets/js/init-alpine.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
  <script src="./assets/js/charts-lines.js" defer></script>
  <script src="./assets/js/charts-pie.js" defer></script>
  <link rel="stylesheet" href="./style.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link id="fontStyleForLanguage" href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">


</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }" id="main-body">
    <!-- Desktop sidebar -->
    <?php
    $ActiveHomeBar = '';
    $HomeActiveTextColor = '';

    $ActiveCustomerBar = '';
    $CustomerActiveTextColor = 'text-gray-800';

    $ActiveRoomsBar = '';
    $RoomActiveTextColor = '';

    $ActiveRequestBar = '';
    $RequestActiveTextColor = '';

    $ActiveSupportBar = '';
    $SupportActiveTextColor = '';

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
                      <span class="text-gray-700 dark:text-gray-400" data-translate="email">Email</span>
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
            <button class="mt-6 bg-purple-600 text-white ml-4  text-sm font-medium py-2 px-4 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" data-translate="AddBtn">Add</button>
            <a href="./customer_list.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700" data-translate="CancelBtn">Cancel</a>

          </div>
        </div>
      </main>

      <!-- preloader here  -->
      <div id="preloader" class="preloader-container">
        <div class="preloader"></div>
      </div>
    </div>
  </div>

  <section id="no-internet-section" style="display: none;">
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div class="container flex flex-col items-center px-6 mx-auto">
        <!-- <svg class="w-12 h-12 mt-8 text-purple-200" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"
                    clip-rule="evenodd"></path>
                </svg> -->
        <script src="https://cdn.lordicon.com/lordicon-1.2.0.js"></script>
        <lord-icon src="https://cdn.lordicon.com/pbbsmkso.json" trigger="hover" colors="primary:#8930e8,secondary:#a866ee" style="width:100px;height:100px">
        </lord-icon>
        <h1 class="text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">
          No Internet Connection
        </h1>
        <p class="text-gray-700 dark:text-gray-300 text-center">
          Please check your internet connection and try again.
        </p>
        <a class="px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" href="#" onclick="window.location.reload()">
          Retry
        </a>
      </div>
    </div>
  </section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./pages/js/main.js"></script>

<script>
  ShowNotifications('<?php echo $userID; ?>');
</script>

</html>