<?php
include './php/handleSession.php';
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

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link id="fontStyleForLanguage" href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">


  <style>
    .loader {
      width: 20px;
      height: 20px;
      border: 3px dotted #FFF;
      border-style: solid solid dotted dotted;
      border-radius: 50%;
      display: inline-block;
      position: relative;
      box-sizing: border-box;
      animation: rotation 2s linear infinite;
    }

    .loader::after {
      content: '';
      box-sizing: border-box;
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      margin: auto;
      border: 3px dotted #FF3D00;
      border-style: solid solid dotted;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      animation: rotationBack 1s linear infinite;
      transform-origin: center center;
    }

    @keyframes rotation {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    @keyframes rotationBack {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(-360deg);
      }
    }
  </style>
</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }" id="main-body">
    <!-- Desktop sidebar -->
    <?php
    $ActiveHomeBar = "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>";
    $HomeActiveTextColor = 'text-gray-800';
    $ActiveCustomerBar = '';
    $CustomerActiveTextColor = '';
    $ActiveRequestBar = '';
    $RequestActiveTextColor = '';
    $ActiveRoomsBar = '';
    $RoomActiveTextColor = '';
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
        <section class="adminView">

          <div class="container px-6 mx-auto grid">
            <!-- show popup for location  -->
            <div class="mt-6 p-3 bg-white popupCard rounded-lg shadow-xs dark:bg-gray-800 relative" id="locationPopUpDiv">
              <div class="flex items-center justify-between">
                <div>
                  <!-- Your notification message -->
                  <p class="text-sm text-gray-700 dark:text-gray-400">
                    Kindly update your rental property details(Location*) to enhance user visibility and search experience in your vicinity.
                  </p>
                </div>
                <div>
                  <!-- open location details add modal -->
                  <button class="text-green-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white focus:outline-none" id="add-loc-details-Modal">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                      <path d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z">
                      </path>
                    </svg>
                  </button>

                </div>
              </div>
            </div>
            <div class="my-6 grid gap-6 mb:grid-cols-2 xl:grid-cols-12">
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="flex items-end justify-end w-full">
                  <button @click="openModal" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" data-translate="addNewTxnBtn">
                    <span class="ml-2" aria-hidden="true">+</span> Add new Transaction
                  </button>
                  <button class="px-4 py-2 ml-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="window.location.href='./customer_add_form.php'" data-translate="addNewCustomerBtn">
                    <span class="ml-2" aria-hidden="true">+</span> Add new Customer
                  </button>
                  <!-- <button class="px-4 py-2 ml-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" id="some-element" data-translate="">
                    <span class="ml-2" aria-hidden="true">+</span> driver
                  </button> -->
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
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="adminTodaysTxnCount">
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
                    ₹ <span id="adminTotalPendAmt"></span>
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
                    Total Customers
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="adminTotCustCount">
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
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="adminTotRoomsCount">
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
                <table class="w-full whitespace-no-wrap" id="DashRecentTxnTable">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3" data-translate="RTxnSrNo">Sr No</th>
                      <!-- <th class="px-4 py-3" data-translate="RTxnCustAccNo">Account No</th> -->
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
                <span class="flex items-center col-span-3 resultCountShowing">
                  Showing 21-30 of 100
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center paginationUL">

                    </ul>
                  </nav>
                </span>
              </div>


            </div>
          </div>

          <!-- add Location details modal start  -->
          <div x-data="{ isModalOpen: false }" id="addLocationDetailsModal">

            <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
              <!-- Modal -->
              <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0  transform translate-y-1/2" @keydown.escape="closeModal" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal">
                <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                <header class="flex justify-end">
                  <!-- <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700 LocationAddModalCloseBtn" aria-label="close">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                      <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                  </button> -->
                </header>
                <!-- Modal body -->
                <div class="mt-4 mb-6">
                  <!-- Modal title -->
                  <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300" data-translate="">
                    Location Details
                  </p>
                  <!-- Modal description -->
                  <form>
                    <div class="flex flex-wrap -mx-4">

                      <div class="w-full  px-4">
                        <label class="block text-sm mb-2">
                          <span class="text-gray-700 dark:text-gray-400" data-translate="">Enter Residency/appartment Name<span class="text-red-600 font-bold">*</span></span>
                          <input type="text" id="res_name" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="e.g. Anusha Enclave" />
                          <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="res_nameError">
                            Residency name should not be empty!.
                          </span>
                        </label>
                      </div>
                    </div>

                    <label class="block text-sm mb-2 px-4">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="">Address<span class="text-red-600 font-bold">*</span></span>
                      <textarea id="Address-input-box" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Enter address of your residency/appartment."></textarea>
                      <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="Address-input-boxError">
                        Address should not be empty!.
                      </span>
                    </label>

                    <div class="flex flex-wrap -mx-4">
                      <div class="w-full md:w-1/2 px-4">
                        <label class="block mb-2 text-sm">
                          <span class="text-gray-700 dark:text-gray-400">
                            Select State<span class="text-red-600 font-bold">*</span></span>
                          </span>
                          <select id="stateDropDown" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected value="">Select</option>
                            <option value="1">Maharashtra</option>
                            <option value="2">Karnataka</option>
                            <option value="3">Gujarat</option>
                          </select>
                          <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="stateDropDownError">
                            Please select state!
                          </span>
                        </label>
                      </div>
                      <div class="w-full md:w-1/2 px-4">
                        <label class="block text-sm mb-2">
                          <span class="text-gray-700 dark:text-gray-400" data-translate="">Enter District<span class="text-red-600 font-bold">*</span></span>
                          <input type="text" id="districtInput" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="e.g. Kolhapur" />
                          <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="districtInputError">
                            District should not be empty!.
                          </span>
                        </label>
                      </div>
                    </div>

                    <div class="flex flex-wrap -mx-4">
                      <div class="w-full md:w-1/2 px-4">
                        <label class="block text-sm mb-2">
                          <span class="text-gray-700 dark:text-gray-400" data-translate="">Enter City (optional)</span>
                          <input type="text" id="CityInput" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Hupari" />
                          <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="CityInputError">
                            City should not be empty!.
                          </span>
                        </label>
                      </div>
                      <div class="w-full md:w-1/2 px-4">
                        <label class="block text-sm mb-2">
                          <span class="text-gray-700 dark:text-gray-400" data-translate="">Enter PIN Code<span class="text-red-600 font-bold">*</span></span>
                          <input type="text" id="pincodeInput" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="416001" />
                          <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="pincodeInputError">
                            Pin code should not be empty!.
                          </span>
                        </label>
                      </div>
                    </div>

                  </form>
                </div>
                <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                  <button id="SaveLocationBtn" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" data-translate="">
                    Save
                  </button>
                </footer>
              </div>
            </div>
            <!-- add txn modal end  -->
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
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="AmtDepositByUserCard">
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
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="AmtDepositedDateCard">
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
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="UsersDueAmtCard">
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
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="MeterUnitRateCard">
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
                      <th class="px-4 py-3" data-translate="TxnHisTablePreviousReading">Previous Meter Reading</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableOngoingReading">Ongoing Meter Reading</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableElectricityBill">Electricity Bill</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableRent">Rent</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableRentToBePaid">Total Rent to be paid</th>
                      <th class="px-4 py-3" data-translate="TxnHisTableNote">Accumulated Rent</th>
                      <th class="px-4 py-3" data-translate="TxnHisTablePendingAmt">Pending Amount</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400">

                    </tr>
                  </tbody>
                  <tfoot class="bg-gray-50 dark:bg-gray-800 ">
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm" colspan="6"></td>
                      <td class="px-4 py-3 text-sm" style="text-align: right;" colspan="2"><strong>TOTAL AMOUNT PENDING: ₹ 450</strong></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3 resultCountShowing">
                  Showing 21-30 of 100
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center paginationUL">

                    </ul>
                  </nav>
                </span>
              </div>
            </div>
          </div>

        </section>

        <!-- section for unauthorized User -->
        <section class="unauthorizedUserView">
          <div class="container px-6 mx-auto" id="">

            <div class="my-6 p-3 bg-white popupCard rounded-lg shadow-xs dark:bg-gray-800 relative" id="profileNotUpdatedDiv">
              <div class="flex items-center justify-between">
                <div>
                  <!-- Your notification message -->
                  <p class="text-sm text-gray-700 dark:text-gray-400">
                    Your account has been created successfully. Please update your profile first before proceeding to the rooms.
                  </p>
                </div>
                <div>
                  <!-- redirect to profilePage -->
                  <button class="text-green-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white focus:outline-none" onclick="window.location.href='./profile-page.php'">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                      <path d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5">
                      </path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>

            <div class="my-6 grid gap-6 mb:grid-cols-2 xl:grid-cols-12">
              <div class="flex flex-wrap -mx-4  bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="w-full md:w-1/2 px-4 mt-2">
                  <div class="relative w-full max-w-xl mt-2 mb-2 mr-6 focus-within:text-purple-500">
                    <div class="absolute inset-y-0 flex items-center pl-2">
                      <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                      </svg>
                    </div>
                    <input id="location-search-input" class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text" placeholder="Search for residency name/appartment, city, state, address" aria-label="Search" data-translate="" />
                  </div>
                </div>

                <div class="w-full md:w-1/2 px-2 mt-2">
                  <div class="md:hidden text-center mb-2">
                    <hr>
                  </div>
                  <a href="#" id="serachNearbyBtn" data-translate="" class="inline-flex mb-4 mt-2 ml-2 items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-600 border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                    <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" aria-hidden="true" viewBox="0 0 20 20">
                      <path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                      <path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                    <span>Search nearby</span>
                    <span id="loadingCircleOnSearchNearby" class="loader ml-2" style="display: none;"></span>
                  </a>
                </div>
              </div>
            </div>

            <div id="residencies_state_wise">

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
                <select id="ModalCustomerList" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
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
<!-- sweet alert cdn  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<!-- ajax cdn  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- moment.js cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script src="./pages/js/main.js"></script>
<!-- driver . js cdn  -->
<script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />

<!-- Add these lines to include Swiper.js -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Add Swiper.js CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<!-- select 2 cdn  -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  <?php
  if ($_SESSION['AdminStatus'] == 0) {
    if ($_SESSION['isAuthorized'] == 0) {
  ?>
      $('.adminView').css('display', 'none')
      $('.unauthorizedUserView').css('display', 'block')
      $('.authorizedUserView').css('display', 'none')
      UpdateProfileDetailsHighlight();
      ShowResidenciesCards()



    <?php
    } else {
    ?>
      $('.adminView').css('display', 'none')
      $('.unauthorizedUserView').css('display', 'none')
      $('.authorizedUserView').css('display', 'block')
      ShowUserDashbordData('<?php echo $userID; ?>', '<?php echo $roomNo; ?>')
      ShowUserTxnHistoryData('<?php echo $userID; ?>')
    <?php
    }
  } else {
    ?>
    $('.adminView').css('display', 'block')
    $('.unauthorizedUserView').css('display', 'none')
    $('.authorizedUserView').css('display', 'none')

    ShowAdminDashbordCardsData()
    ShowRecentTransactionsDetails()
    ShowCustListWithPrevReadingDD('ModalCustomerList')
    ResidencyDetailsAdded();

  <?php
  }
  ?>
  ShowNotifications('<?php echo $userID; ?>');
</script>

<script>
  $('#add-loc-details-Modal').on('click', function() {
    var modalDiv = document.getElementById("addLocationDetailsModal");
    modalDiv.__x.$data.isModalOpen = true;
  })

  //save location Details 
  $('#SaveLocationBtn').on('click', function() {
    var res_name = $('#res_name');
    var address_input = $('#Address-input-box');
    var stateDropDown = $('#stateDropDown');
    var districtInput = $('#districtInput');
    var CityInput = $('#CityInput');
    var pincodeInput = $('#pincodeInput');

    var formTrue = true;
    var emptyFields = [];


    if (res_name.val() === '') {
      emptyFields.push('res_name');
    }

    if (address_input.val() === '') {
      emptyFields.push('Address-input-box');
    }

    if (stateDropDown.val() === '') {
      emptyFields.push('stateDropDown');
    }

    if (districtInput.val() === '') {
      emptyFields.push('districtInput');
    }

    if (pincodeInput.val() === '') {
      emptyFields.push('pincodeInput');
    }

    $('.error-message').addClass('hidden');

    if (emptyFields.length > 0) {
      // Display error messages for empty fields
      emptyFields.forEach(function(field) {
        $('#' + field + 'Error').removeClass('hidden');
      });
      formTrue = false;
    }

    if (formTrue) {
      //check if database has the room on the floor available to add OR
      // the room number already exist on the floor
      SaveLocationDetails();
    }
  })
</script>

<script>
  // $(document).ready(function() {
  //   $('#location-search-input').select2();
  // });
</script>

</html>