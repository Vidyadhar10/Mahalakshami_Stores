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
  <script src="./pages/js/main.js"></script>


</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
    <?php
    $ActiveHomeBar = '';
    $HomeActiveTextColor = '';

    $ActiveCustomerBar = "";
    $CustomerActiveTextColor = 'text-gray-800';

    $ActiveRoomsBar = '';
    $RoomActiveTextColor = '';

    $ActiveRequestBar = '';
    $RequestActiveTextColor = '';

    $ActiveSettingsBar = '';
    $SettingsActiveTextColor = '';
    include './php/header-asidebar.php';
    ?>

    <div class="flex flex-col flex-1 w-full">
      <?php
      include './php/header.php';
      ?>
      <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">


          <div class="w-full mt-6 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <form class="p-6">
              <div class="flex justify-start my-6 flex-col md:flex-row items-center pb-10">
                <!-- Left Column -->
                <div class="relative w-20 h-20 mb-4 mr-4 rounded-full">
                  <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg4fQ" alt="" loading="lazy" />
                  <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                </div>
                <!-- Right Column -->
                <div class="md:w-1/2 md:ml-4 ml-4">
                  <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white" id="userName"></h5>
                  <span class="text-sm text-gray-500 dark:text-gray-400" id="userDesignation">Visual Designer</span>
                  <div class="flex mt-4 space-x-3 md:mt-6">
                    <span class="text-sm text-gray-500 font-medium dark:text-gray-400">Address:</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400" id="userAddress">Korochi</span>
                  </div>
                  <div class="flex mt-2 space-x-3 md:mt-6">
                    <span class="text-sm text-gray-500 font-medium dark:text-gray-400">Mobile Number:</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400" id="mobileNumber">7875910170</span>
                  </div>
                  <div class="flex mt-2 space-x-3 md:mt-6">
                    <span class="text-sm text-gray-500 font-medium dark:text-gray-400">Customer Added Date:</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400" id="userAddedDate">10/03/2023</span>
                  </div>
                  <div class="flex mt-4 space-x-3 md:mt-6">
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send Notification</a>
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700" id="callButton">Make A Call</a>
                  </div>

                </div>


                <div class="md:w-1/2 md:ml-4">
                  <div class="flex mt-2 space-x-3 md:mt-6">
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Documents Uploaded</h5>
                  </div>
                  <div class="flex mt-4 space-x-3 md:mt-6">
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Aadhar Card</a>
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Pan Card</a>
                    <!-- <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700" >Make A Call</a> -->
                  </div>
                </div>
              </div>
            </form>
          </div>

        </div>

        <!-- <div class="container px-6 mx-auto ">

          
          <div class="px-2 my-6 py-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="" style="display:flex; align-items:center; justify-content:right;">
              <a href="#" @click="openModal" data-translate="addNewTxnBtn" class="inline-flex mb-6 mt-2 mr-2  items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-600 border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                Add New Transaction
              </a>
              <a href="#" id="downloadBtn" data-translate="DownloadBtn" class="inline-flex mb-6 mt-2  items-center px-4 py-2 text-sm font-medium text-center text-white bg-red-600 border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                Download
              </a>
            </div>

            <div class="w-full overflow-hidden rounded-lg shadow-xs ">
              <div class="w-full overflow-x-auto">

                <table class="w-full whitespace-no-wrap" id="Customers-txn-table">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3" data-translate="TxnHisTableSrNo">Sr No</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableRentDate">Rent Given date</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableOngoingReading">Ongoing Reading</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableElectricityBill">Electricity Bill</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableRent">Rent</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableRentToBePaid">Total Rent to be paid</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableNote">Accumulated Rent</th>
                      <th class="px-4 py-3" data-translate="TxnHisTablePendingAmt">Pending Amount</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="20">
                        1
                      </td>
                      <td class="px-4 py-3 text-sm" width="100">
                        06-10-2023
                      </td>
                      <td class="px-4 py-3 text-sm" style="text-align: right;">
                        150
                      </td>
                      <td class="px-4 py-3 text-sm" style="text-align: right;">
                        150 x 9 = <span class="font-semibold">1350</span>
                      </td>
                      <td class="px-4 py-3 text-sm" style="text-align: right;">
                        2500
                      </td>
                      <td class="px-4 py-3 text-sm" style="text-align: right;">
                        2500 + 1350 = <span class="font-semibold">3850</span>
                      </td>

                      <td class="px-4 py-3 text-sm" style="text-align: right;">
                        ₹ 890
                      </td>
                      <td class="px-4 py-3 text-sm" style="text-align: right;">
                        3850 - 3000 = <span class="font-semibold text-red-700">850</span>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot class="bg-gray-50 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm" colspan="6"></td>
                      <td class="px-4 py-3 text-sm" style="text-align: right;" colspan="2"><strong>TOTAL AMOUNT PENDING: ₹ 450</strong></td>
                    </tr>
                  </tfoot>
                </table>
              </div>

              <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                  Showing 21-30 of 100
                </span>
                <span class="col-span-2"></span>
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                      <li>
                        <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                          <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                          </svg>
                        </button>
                      </li>
                      <li>
                        <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                          1
                        </button>
                      </li>
                      <li>
                        <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                          2
                        </button>
                      </li>
                      <li>
                        <button class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                          3
                        </button>
                      </li>
                      <li>
                        <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                          4
                        </button>
                      </li>
                      <li>
                        <span class="px-3 py-1">...</span>
                      </li>
                      <li>
                        <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                          8
                        </button>
                      </li>
                      <li>
                        <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                          9
                        </button>
                      </li>
                      <li>
                        <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                          <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                          </svg>
                        </button>
                      </li>
                    </ul>
                  </nav>
                </span>
              </div>
            </div>

          </div>


        </div> -->
      </main>

      <!-- preloader here  -->
      <div id="preloader" class="preloader-container">
        <div class="preloader"></div>
      </div>

    </div>
  </div>
</body>
<!-- sweet alert cdn  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<!-- ajax cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- moment.js cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script src="./pages/js/main.js"></script>
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
    ShowTenantProfileData('<?php echo $_GET['usrid']; ?>')
  });
  ShowNotifications('<?php echo $userID; ?>');
</script>

</html>