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

  <style>
    @media only screen and (min-width: 600px) {
      #profileImg {
        height: 20%;
        width: 30%;
      }
    }
  </style>
</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
    <?php
    $ActiveHomeBar = '';
    $HomeActiveTextColor = '';

    $ActiveCustomerBar = "";
    $CustomerActiveTextColor = '';

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
        <div class="container px-6 my-6 mx-auto grid">
          <div class="w-full mt-6 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <form class="p-6">
              <div class="flex justify-between my-6 flex-col md:flex-row items-center pb-10">
                <!-- Left Column -->
                <div class="relative w-full mb-4" id="profileImg">
                  <img class="object-cover w-full h-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg4fQ" alt="" loading="lazy" />
                  <div class="absolute inset-0 shadow-inner" aria-hidden="true"></div>
                </div>
                <!-- Right Column -->
                <div class="md:w-1/2 md:ml-4 ml-4">
                  <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Bonnie Green</h5>
                  <span class="text-sm text-gray-500 dark:text-gray-400">Visual Designer</span>
                  <div class="flex mt-4 space-x-3 md:mt-6">
                    <span class="text-sm text-gray-500 font-medium dark:text-gray-400">Address:</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Korochi</span>
                  </div>
                  <div class="flex mt-2 space-x-3 md:mt-6">
                    <span class="text-sm text-gray-500 font-medium dark:text-gray-400">Mobile Number:</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400" id="mobileNumber">7875910170</span>
                  </div>
                  <div class="flex mt-2 space-x-3 md:mt-6">
                    <span class="text-sm text-gray-500 font-medium dark:text-gray-400">Customer Added Date:</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">10/03/2023</span>
                  </div>
                  <div class="flex mt-4 space-x-3 md:mt-6">
                    <!-- <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit Details</a> -->
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700" id="UpdatePasswordBtn">Update Password</a>
                  </div>
                </div>

              </div>
            </form>
          </div>

        </div>

        <div class="container px-6 my-6 mx-auto" id="passwordupdatecard" style="display: none;">
          <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800  mt-6 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
              Update Password
            </h4>
            <div class="flex flex-wrap -mx-4">
              <div class="w-full md:w-1/2 ">

                <div class="flex flex-wrap -mx-4 mt-1">
                  <div class="w-full md:w-1/2 px-4">
                    <label class="block text-sm">
                      <span class="text-gray-700 dark:text-gray-400">Old Password<span class="text-red-600 font-bold">*</span></span>
                      <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="********" />
                    </label>
                  </div>
                  <div class="w-full md:w-1/2 px-4 ">
                    <label class="block  text-sm">
                      <span class="text-gray-700 dark:text-gray-400">New Password<span class="text-red-600 font-bold">*</span></span>
                      <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="********" />
                    </label>
                  </div>
                </div>

              </div>

              <div class="w-full md:w-1/2">
                <div class="flex flex-wrap -mx-4">
                  <div class="w-full md:w-1/2 px-4 mt-1">
                    <label class="block text-sm">
                      <span class="text-gray-700 dark:text-gray-400">Confirm Password<span class="text-red-600 font-bold">*</span></span>
                      <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="********" />
                    </label>

                  </div>
                </div>
              </div>
            </div>
            <div class="flex mt-4 space-x-3 md:mt-6 px-4">
              <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="updatePassFormBtn">Update</a>
            </div>

          </div>

        </div>
      </main>

      <!-- add txn modal start  -->
      <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        <!-- Modal -->
        <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0  transform translate-y-1/2" @keydown.escape="closeModal" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal">
          <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
          <header class="flex justify-end">
            <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" @click="closeModal">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
              </svg>
            </button>
          </header>
          <!-- Modal body -->
          <div class="mt-4 mb-6">
            <!-- Modal title -->
            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
              Transaction
            </p>
            <!-- Modal description -->
            <form>
              <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/2 px-4">
                  <label class="block text-sm mb-2">
                    <span class="text-gray-700 dark:text-gray-400">Accumulated Rent (जमा भाडे) <span class="text-red-600 font-bold">*</span></span>
                    <input type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Amount In Rs (₹)" />
                  </label>
                </div>

                <div class="w-full md:w-1/2 px-4">
                  <label class="block text-sm mb-2">
                    <span class="text-gray-700 dark:text-gray-400">Ongoing Reading (चालू रेड़ीन्ग) <span class="text-red-600 font-bold">*</span></span>
                    <input type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Amount In Rs (₹)" />
                  </label>
                </div>
              </div>

              <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/2 px-4">
                  <label class="block text-sm mb-2">
                    <span class="text-gray-700 dark:text-gray-400">Previous Reading (मागील रेड़ीन्ग)</span>
                    <input type="number" disabled class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Amount In Rs (₹)" />
                  </label>
                </div>

                <div class="w-full md:w-1/2 px-4">
                  <label class="block text-sm mb-2">
                    <span class="text-gray-700 dark:text-gray-400">Amount Deposited (अमाऊंट जमा) <span class="text-red-600 font-bold">*</span></span>
                    <input type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Amount In Rs (₹)" />
                  </label>
                </div>
              </div>

              <label class="block text-sm mb-2 px-4">
                <span class="text-gray-700 dark:text-gray-400">Note About Deposit (optional)</span>
                <textarea class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Enter some short note about transaction."></textarea>
              </label>

            </form>
          </div>
          <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
            <button @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
              Cancel
            </button>
            <button class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Add
            </button>
          </footer>
        </div>
      </div>
      <!-- add txn modal end  -->

    </div>
  </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $(document).ready(function() {
    $("#callButton").on("click", function() {
      // Check if it's a mobile device
      if (/Mobi|Android/i.test(navigator.userAgent)) {
        // Replace '1234567890' with your phone number
        window.location.href = `tel:+91 ${parseInt($('#mobileNumber').text())}`;
      } else {
        // Handle non-mobile devices or perform a different action
        alert("Calling is supported on mobile devices only.");
      }
    });
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $(document).ready(function() {
    $("#UpdatePasswordBtn").on("click", function() {
      $('#passwordupdatecard').css('display', 'block');
    });
  });
</script>


</html>