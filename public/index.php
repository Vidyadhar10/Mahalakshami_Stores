<?php
session_start();
if (isset($_SESSION['UserID']) && isset($_SESSION['AdminStatus'])) {
  $userID = $_SESSION['UserID'];
} else {
  header('location:./php/logout.php');
}
?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <title>Mahalakshmi Stores Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="./assets/js/init-alpine.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
  <script src="./assets/js/charts-lines.js" defer></script>
  <script src="./assets/js/charts-pie.js" defer></script>
  <link rel="stylesheet" href="./style.css">

  <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Marathi&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Tiro Devanagari Marathi', serif;
    }
  </style> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Nunito', sans-serif;
    }
  </style>

</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
    <?php
    $ActiveHomeBar = "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>";
    $HomeActiveTextColor = 'text-gray-800';
    $ActiveCustomerBar = '';
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
        <section class="adminView">

          <div class="container px-6 mx-auto grid">
            <div class="my-6 grid gap-6 mb:grid-cols-2 xl:grid-cols-12">
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">

                <div class="flex items-end justify-end w-full">
                  <button @click="openModal" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" data-translate="addNewTxnBtn">
                    <span class="ml-2" aria-hidden="true">+</span> Add new Transaction
                  </button>
                  <button class="px-4 py-2 ml-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="window.location.href='./customer_add_form.php'" data-translate="addNewCustomerBtn">
                    <span class="ml-2" aria-hidden="true">+</span> Add new Customer
                  </button>
                </div>
              </div>
            </div>

            <!-- Cards -->
            <div class="grid gap-6  md:grid-cols-2 xl:grid-cols-4">
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="TodaysTotalTxnCard">
                    Today's Total Transactions
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    10
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="TotalAmtPendingCard">
                    Total Amount Pending
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    ₹ 20,500.00
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="TotalCustomersCard">
                    Total Customers <br> (टोटल कस्टमर्स)
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    376
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="TotalRoomsCard">
                    Total Rooms
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    12
                  </p>
                </div>
              </div>
            </div>

            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs my-6">
              <div class="w-full overflow-x-auto">
                <h4 class="mt-4 ml-4 mb-2 font-semibold text-gray-800 dark:text-gray-300" data-translate="RecentTxnTableHeading">
                  Recent Transactions
                </h4>
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3" data-translate="RTxnSrNo">Sr No</th>
                      <th class="px-4 py-3" data-translate="RTxnCustAccNo">Account No</th>
                      <th class="px-4 py-3" data-translate="RTxnCustRoomNo">Room No</th>
                      <th class="px-4 py-3" data-translate="RTxnCustomerName">customer Name</th>
                      <th class="px-4 py-3" data-translate="RTxnCustAmtPaid">Amount Deposited / Note</th>
                      <th class="px-4 py-3" data-translate="RTxnCustTxnTime">txn. Time</th>
                      <th class="px-4 py-3" data-translate="viewDetailsCol">View Details</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="20">
                        1
                      </td>
                      <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="100">
                        43
                      </td>
                      <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="100">
                        3
                      </td>

                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                            <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy" />
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                          </div>
                          <div>
                            <p class="font-semibold">Hans Burger</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                              10x Developer
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm text-green-600" style="text-align: right;" width="200">
                        ₹ <span class=" font-bold">+</span>860
                      </td>

                      <td class="px-4 py-3 text-sm">
                        10 min. ago
                      </td>
                      <td class="px-4 py-3 text-sm" width="200">
                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="window.location.href='customer_details.php'" data-translate="RTxnRowViewBtn">
                          View
                        </button>
                      </td>
                    </tr>


                  </tbody>
                </table>
              </div>
              <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                  Showing 21-30 of 100
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
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
        </section>
        <!-- section for Authorized User -->
        <section class="authorizedUserView">
          <div class="container px-6 mx-auto grid">
            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4 my-6">
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="AmtDepositByUserCard">
                    Deposit Amount
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    5000
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="AmtDepositedDateCard">
                    Amount Deposited Date
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    26-10-2023
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                    </path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="UsersDueAmtCard">
                    Total Amount Pending

                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    500
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="MeterUnitRateCard">
                    Meter reading rate per unit
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    9
                  </p>
                </div>
              </div>
            </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs ">
              <div class="w-full overflow-x-auto">
                <h4 class="mt-4 ml-4 mb-2 font-semibold text-gray-800 dark:text-gray-300" data-translate="UserTxnHistoryTable">
                  Transaction History
                </h4>
                <table class="w-full whitespace-no-wrap" id="Customers-txn-table">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3" data-translate="TxnHisTableSrNo">Sr No</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableRentDate">Rent Given date</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableOngoingReading">Ongoing Reading (चालू रेड़ीन्ग)</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableElectricityBill">Electricity Bill</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableRent">Rent(भाडे)</th>
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
                <!-- Pagination -->
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
        </section>

        <!-- section for unauthorized User -->
        <section class="unauthorizedUserView">
          <div class="container px-6 mx-auto ">

            <h4 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300" data-translate="AllRooms">
              All Rooms
            </h4>
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

              <!-- card for rooms  -->
              <div class="flex flex-wrap -mx-4 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="w-full  px-4 mb-2">
                  <h4 class="mb-2  font-medium text-gray-600 dark:text-gray-400" data-translate="RoomDetails">
                    Room Details
                  </h4>

                </div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="RoomNum">
                    Room Number
                  </p>
                </div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    1
                  </p>
                </div>
                <div class="w-full"></div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="RoomType">
                    Room type
                  </p>
                </div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <span class="px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                    Bachelors
                  </span>
                </div>
                <hr>
                <div class="w-full md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="Tenant">
                    Tenant
                  </p>
                  <p class="text-lg font-semibold text-red-700 text-gray-700 dark:text-gray-200">
                    3
                  </p>
                </div>
                <div class="w-full md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium  text-gray-600 dark:text-gray-400" data-translate="Available">
                    Available
                  </p>
                  <p class="text-lg font-semibold text-green-700 text-gray-700 dark:text-gray-200">
                    1
                  </p>
                </div>

                <button onclick="window.location.href='./customer_list.php'" class="px-4 py-2 ml-2 w-full text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="window.location.href='./customer_add_form.php'" data-translate="ViewBtn">
                  View
                </button>
              </div>
              <!-- card for rooms  -->
              <div class="flex flex-wrap -mx-4 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="w-full  px-4 mb-2">
                  <h4 class="mb-2  font-medium text-gray-600 dark:text-gray-400">
                    Room Details
                  </h4>

                </div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Room Number
                  </p>
                </div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    1
                  </p>
                </div>
                <div class="w-full"></div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Room type
                  </p>
                </div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <span class="px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                    Bachelors
                  </span>
                </div>
                <hr>
                <div class="w-full md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Tenant
                  </p>
                  <p class="text-lg font-semibold text-red-700 text-gray-700 dark:text-gray-200">
                    3
                  </p>
                </div>
                <div class="w-full md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium  text-gray-600 dark:text-gray-400">
                    Available
                  </p>
                  <p class="text-lg font-semibold text-green-700 text-gray-700 dark:text-gray-200">
                    1
                  </p>
                </div>

                <button class="px-4 py-2 ml-2 w-full text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="window.location.href='./customer_add_form.php'">
                  View
                </button>
              </div>
              <!-- card for rooms  -->
              <div class="flex flex-wrap -mx-4 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="w-full  px-4 mb-2">
                  <h4 class="mb-2  font-medium text-gray-600 dark:text-gray-400">
                    Room Details
                  </h4>

                </div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Room Number
                  </p>
                </div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    1
                  </p>
                </div>
                <div class="w-full"></div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Room type
                  </p>
                </div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <span class="px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                    Bachelors
                  </span>
                </div>
                <hr>
                <div class="w-full md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Tenant
                  </p>
                  <p class="text-lg font-semibold text-red-700 text-gray-700 dark:text-gray-200">
                    3
                  </p>
                </div>
                <div class="w-full md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium  text-gray-600 dark:text-gray-400">
                    Available
                  </p>
                  <p class="text-lg font-semibold text-green-700 text-gray-700 dark:text-gray-200">
                    1
                  </p>
                </div>

                <button class="px-4 py-2 ml-2 w-full text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="window.location.href='./customer_add_form.php'">
                  View
                </button>
              </div>
              <!-- card for rooms  -->
              <div class="flex flex-wrap -mx-4 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="w-full  px-4 mb-2">
                  <h4 class="mb-2  font-medium text-gray-600 dark:text-gray-400">
                    Room Details
                  </h4>

                </div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Room Number
                  </p>
                </div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    1
                  </p>
                </div>
                <div class="w-full"></div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Room type
                  </p>
                </div>
                <div class="w-1/2 md:w-1/2 px-4 mb-2">
                  <span class="px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                    Bachelors
                  </span>
                </div>
                <hr>
                <div class="w-full md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Tenant
                  </p>
                  <p class="text-lg font-semibold text-red-700 text-gray-700 dark:text-gray-200">
                    3
                  </p>
                </div>
                <div class="w-full md:w-1/2 px-4 mb-2">
                  <p class="mb-2 text-sm font-medium  text-gray-600 dark:text-gray-400">
                    Available
                  </p>
                  <p class="text-lg font-semibold text-green-700 text-gray-700 dark:text-gray-200">
                    1
                  </p>
                </div>

                <button class="px-4 py-2 ml-2 w-full text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="window.location.href='./customer_add_form.php'">
                  View
                </button>
              </div>
            </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                  Showing 21-30 of 100
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
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

        </section>
      </main>

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
            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300" data-translate="TxnModalheader">
              Transaction
            </p>
            <!-- Modal description -->
            <form>
              <label class="block text-sm mb-2">
                <span class="text-gray-700 dark:text-gray-400" data-translate="TxnDate">Transaction Date <span class="text-red-600 font-bold">*</span></span>
                <input type="date" onclick="this.showPicker()" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
              </label>

              <label class="block mb-2 text-sm">
                <span class="text-gray-700 dark:text-gray-400" data-translate="SelectedCust">
                  Selected Customer <span class="text-red-600 font-bold">*</span>
                </span>
                <select class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                  <option selected>Select</option>
                  <option>Vivek Yadav (#38)</option>
                  <option>Subhan Mullani (#21)</option>
                  <option>Vidyadhar Lohar (#10)</option>
                  <option>Sanjay Datt (#239)</option>
                </select>
              </label>
              <label class="block text-sm mb-2">
                <span class="text-gray-700 dark:text-gray-400" data-translate="AccumulatedRent">Accumulated Rent (जमा भाडे) <span class="text-red-600 font-bold">*</span></span>
                <input type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Amount In Rs (₹)" />
              </label>
              <label class="block text-sm mb-2">
                <span class="text-gray-700 dark:text-gray-400" data-translate="OngoingReading">Ongoing Reading (चालू रेड़ीन्ग) <span class="text-red-600 font-bold">*</span></span>
                <input type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Amount In Rs (₹)" />
              </label>
              <label class="block text-sm mb-2">
                <span class="text-gray-700 dark:text-gray-400" data-translate="PrevReading">Previous Reading (मागील रेड़ीन्ग)</span>
                <input type="number" disabled class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Amount In Rs (₹)" />
              </label>
              <label class="block text-sm mb-2">
                <span class="text-gray-700 dark:text-gray-400" data-translate="AmtDeposited">Amount Deposited (अमाऊंट जमा) <span class="text-red-600 font-bold">*</span></span>
                <input type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Amount In Rs (₹)" />
              </label>
              <label class="block text-sm mb-2">
                <span class="text-gray-700 dark:text-gray-400" data-translate="Note">Note About Deposit (optional)</span>
                <textarea class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Enter some short note about transaction."></textarea>
              </label>



            </form>
          </div>
          <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
            <button @click="closeModal" data-translate="CancelBtn" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
              Cancel
            </button>
            <button class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" data-translate="AddBtn">
              Add
            </button>
          </footer>
        </div>
      </div>

    </div>
  </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="./pages/js/main.js"></script>
<script>
  <?php
  if ($_SESSION['AdminStatus'] == 0) {
    if ($_SESSION['isAuthorized'] == 0) {
  ?>
      $('.adminView').css('display', 'none')
      $('.unauthorizedUserView').css('display', 'block')
      $('.authorizedUserView').css('display', 'none')

    <?php
    } else {
    ?>
      $('.adminView').css('display', 'none')
      $('.unauthorizedUserView').css('display', 'none')
      $('.authorizedUserView').css('display', 'block')
    <?php
    }
  } else {
    ?>
    $('.adminView').css('display', 'block')
    $('.unauthorizedUserView').css('display', 'none')
    $('.authorizedUserView').css('display', 'none')

  <?php
  }
  ?>
</script>

</html>