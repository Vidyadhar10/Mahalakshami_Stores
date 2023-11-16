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

</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
    <?php
    $ActiveHomeBar = '';
    $HomeActiveTextColor = '';
    $ActiveCustomerBar = "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>";
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
        <div class="container px-6 mx-auto ">
          <div class="mt-6 mb-4 grid roomidExists mb:grid-cols-2 xl:grid-cols-12 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mt-2 ml-4 text-lg font-semibold text-gray-600 dark:text-gray-300" data-translate="CustRoomDetails">
              Room-Customer Details
            </h4>
            <div class="flex flex-wrap -mx-4 mt-2 mb-4 text-center md:text-left topDetailsDiv">

              <div class="w-full md:w-1/2">
                <div class="flex flex-wrap -mx-4">
                  <!-- floor number -->
                  <div class="w-full md:w-1/2 px-4">
                    <label class="block text-sm labelForDetails">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="FloorNameOnCard">Floor</span>
                      <span class="text-gray-700 dark:text-gray-300 block w-full  mb-2 details_value" id="floorVal">Ground Floor</span>
                    </label>
                  </div>
                  <div class="w-full md:w-1/2 px-4">
                    <!-- room no -->
                    <label class="block text-sm labelForDetails">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="RoomNoOnCard">Room No</span>
                      <span class="text-gray-700 dark:text-gray-300 block w-full mb-2 details_value" id="roomNumVal">102</span>
                    </label>
                  </div>
                </div>
              </div>


              <div class="w-full md:w-1/2">
                <div class="flex flex-wrap -mx-4">
                  <!-- deposit amount -->
                  <div class="w-full md:w-1/2 px-4">
                    <label class="block text-sm labelForDetails">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="DepositAmtOnCard">Deposit Amount</span>
                      <span class="text-gray-700 dark:text-gray-300 block w-full mb-2 details_value" id="depositAmtVal">5000</span>
                    </label>
                  </div>
                  <div class="w-full md:w-1/2 px-4">
                    <!-- rent  -->
                    <label class="block text-sm labelForDetails">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="RentOnCard">Rent</span>
                      <span class="text-gray-700 dark:text-gray-300 block w-full mb-2 details_value" id="rentVal"></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- customer list table here for the room  -->
          <h4 class="mb-2 customerTableWithHeading text-lg font-semibold text-gray-600 dark:text-gray-300" data-translate="AllCustomers">
            All Customers
          </h4>
          <div class="mb-4 bg-white rounded-lg shadow-md dark:bg-gray-800">

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">

                <div class="flex flex-wrap -mx-4 mt-2">
                  <div class="w-full md:w-1/2 px-2">
                    <a href="./customer_add_form.php" id="addCustBtn" class="inline-flex mb-4 mt-2 ml-2 mr-2  items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-600 border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700" data-translate="AddNewCustBtn">
                      Add New customer
                    </a>
                  </div>

                  <div class="w-full md:w-1/2 px-4">
                    <div class="relative w-full max-w-xl mt-2 mb-2 mr-6 focus-within:text-purple-500">
                      <div class="absolute inset-y-0 flex items-center pl-2">
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                      </div>
                      <input id="customer-search-input" class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text" placeholder="Search for customer" aria-label="Search" data-translate="CustomerInputSearchBox" />
                    </div>
                  </div>
                </div>


                <table class="w-full whitespace-no-wrap" id="Customers-table">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">Sr No</th>
                      <th class="px-4 py-3">Account No</th>
                      <th class="px-4 py-3 TableColumns">Room No</th>
                      <th class="px-4 py-3">Customer Name</th>
                      <th class="px-4 py-3 TableColumns">Total Amount Pending</th>
                      <!-- <th class="px-4 py-3">Status</th> -->
                      <th class="px-4 py-3">Added Date</th>
                      <th class="px-4 py-3">Customer Details</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm  font-semibold" style="text-align: right;" width="20">
                        1
                      </td>
                      <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="100">
                        43
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
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
                      <td class="px-4 py-3 text-sm">
                        06-10-2023
                      </td>
                      <td class="px-4 py-3 text-sm">
                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="window.location.href='customer_details.php'">
                          View
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="grid px-4 custTablePagination py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
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

          <!-- all transaction table here for room  -->
          <div class="roomidExists">
            <h4 class="mb-2 text-lg font-semibold text-gray-600 dark:text-gray-300">
              All Transactions
            </h4>
            <div class="mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <div class="px-2 mt-2" style="display:flex; align-items:center; justify-content:right;">
                <a href="#" id="add-new-txn-btn" data-translate="addNewTxnBtn" class="inline-flex mb-6 mt-2 mr-2  items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-600 border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                  Add New Transaction
                </a>
                <a href="#" id="downloadBtn" data-translate="DownloadBtn" class="inline-flex mb-6 mt-2  items-center px-4 py-2 text-sm font-medium text-center text-white bg-red-600 border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                  Download
                </a>
              </div>

              <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                  <table class="w-full whitespace-no-wrap" id="CustRoom-txn-table">
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
                        <td class="px-4 py-3 text-sm" colspan="7"></td>
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
          </div>

        </div>

      </main>

      <!-- preloader here  -->
      <div id="preloader" class="preloader-container">
        <div class="preloader"></div>
      </div>

      <!-- add txn modal start  -->
      <div x-data="{ isModalOpen: false }" id="addNewTxnModal">

        <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
          <!-- Modal -->
          <div x-show="isModalOpen" style="overflow: auto;" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0  transform translate-y-1/2" @keydown.escape="closeModal" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal">
            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
            <header class="flex justify-end">
              <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700 addTxnModalCloseBtn" aria-label="close" @click="closeModal">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                  <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg>
              </button>
            </header>
            <!-- Modal body -->
            <div class="mt-4 mb-6">
              <!-- Modal title -->
              <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300" data-translate="TxnModalTitle">
                Transaction
              </p>
              <!-- Modal description -->
              <form>
                <div class="flex flex-wrap -mx-4">
                  <div class="w-full md:w-1/2 px-4">
                    <div class=" mb-2 text-sm">
                      <span class="text-gray-700 dark:text-gray-400">
                        Transaction Type
                      </span>
                      <div class="mt-2">
                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                          <input type="radio" checked class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="txnTypeRadio" value="monthly" />
                          <span class="ml-2">Monthly Rent</span>
                        </label>
                        <label class="inline-flex ml-2 items-center md:ml-6 text-gray-600 dark:text-gray-400">
                          <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="txnTypeRadio" value="pending-pay" />
                          <span class="ml-2">Pending Pay</span>
                        </label>
                      </div>

                    </div>
                  </div>
                  <div class="w-full md:w-1/2 px-4">
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
                      <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="ModalCustomerListError">
                        Please select customer!.
                      </span>
                    </label>
                  </div>

                </div>
                <div id="monthlyPay">

                  <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4">
                      <label class="block text-sm mb-2">
                        <span class="text-gray-700 dark:text-gray-400" data-translate="PrevReading">Previous Reading (मागील रेड़ीन्ग)</span>
                        <input type="number" id="prevReadingInput" style="text-align: end;" disabled class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Auto/Enter reading for first time" />
                      </label>
                    </div>

                    <div class="w-full md:w-1/2 px-4">
                      <label class="block text-sm mb-2">
                        <span class="text-gray-700 dark:text-gray-400" data-translate="OngoingReading">Ongoing Reading (चालू रेड़ीन्ग) <span class="text-red-600 font-bold">*</span></span>
                        <input type="number" id="ongoingReadingInput" style="text-align: end;" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter reading" />
                        <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="ongoingReadingInputError">
                          Ongoing reading should not be empty!.
                        </span>
                      </label>
                    </div>
                  </div>

                  <div class="flex flex-wrap -mx-4 mb-2">
                    <div class="px-4 w-full">

                      <div class="w-full md:w-full px-2 border">
                        <div class="flex flex-wrap -mx-4 mt-2 ">
                          <div class="w-full md:w-1/2">
                            <label class="block text-sm mb-2">
                              <span class=" w-1/2 mt-1 text-sm text-gray-700 dark:text-gray-400" data-translate="">Meter Calulation : (<span id="meterCalcString"></span>)</span>
                            </label>
                          </div>
                          <div class="w-full md:w-1/2">
                            <label class="block text-sm mb-2">
                              <input type="text" disabled id="MeterCalcVal" style="text-align: end;" class="w-1/2 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Auto" />
                            </label>
                          </div>
                        </div>
                        <div class="flex flex-wrap -mx-4 mt-2 ">
                          <div class="w-full md:w-1/2">
                            <label class="block text-sm mb-2">
                              <span class=" w-1/2 mt-1 text-sm text-gray-700 dark:text-gray-400" data-translate="">Electricity Bill: (<span id="TotalCalcSpan"></span>)</span>
                            </label>
                          </div>
                          <div class="w-full md:w-1/2">
                            <label class="block text-sm mb-2">
                              <input type="text" disabled id="ElectricityCalcVal" style="text-align: end;" class="w-1/2 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Auto" />
                            </label>
                          </div>
                        </div>
                        <div class="flex flex-wrap -mx-4 mt-2 ">
                          <div class="w-full md:w-1/2">
                            <label class="block text-sm mb-2">
                              <span class=" w-1/2 mt-1 text-sm text-gray-700 dark:text-gray-400" data-translate="">TOTAL PAY: <br>(<span id="TotalPaySpan"></span>)</span>
                            </label>
                          </div>
                          <div class="w-full md:w-1/2">
                            <label class="block text-sm mb-2">
                              <input type="text" disabled id="TotalPayCalcVal" style="text-align: end;" class="w-1/2 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Auto" />
                            </label>
                          </div>
                        </div>

                      </div>

                    </div>
                  </div>
                </div>

                <div class="flex flex-wrap -mx-4">
                  <div class="w-full md:w-1/2 px-4">
                    <label class="block text-sm mb-2">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="TxnAccumulatedRent"> <span id="rentInputLabel">Accumulated Rent </span><span class="text-red-600 font-bold">*</span></span>
                      <input type="number" id="rentInputBox" maxlength="5" style="text-align: end;" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Amount In Rs (₹)" />
                      <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="rentInputBoxError">
                        Rent/pending amount should not be empty!.
                      </span>
                    </label>
                  </div>

                  <div class="w-full md:w-1/2 px-4">
                    <!-- <label class="block text-sm mb-2">
                          <span class="text-gray-700 dark:text-gray-400" data-translate="AmtDeposited">Amount Deposited (अमाऊंट जमा) <span class="text-red-600 font-bold">*</span></span>
                          <input type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Amount In Rs (₹)" />
                        </label> -->
                  </div>
                </div>

                <label class="block text-sm mb-2 px-4">
                  <span class="text-gray-700 dark:text-gray-400" data-translate="Note">Note About Deposit (optional)</span>
                  <textarea id="noteVal" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Enter some short note about transaction."></textarea>
                </label>

              </form>
            </div>
            <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
              <button @click="closeModal" data-translate="CancelBtn" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray addTxnModalCloseBtn">
                Cancel
              </button>
              <button id="ModalTxnAddBtn" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" data-translate="AddBtn">
                Add
              </button>
            </footer>
          </div>
        </div>
      </div>
      <!-- add txn modal end  -->
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
  $('.addTxnModalCloseBtn').on('click', function() {
    closeAddRoomModal('addNewTxnModal')
  })

  function handleScreenSize() {

    if ($(window).width() < 768) {
      $('.details_value').removeClass('block w-full');
      $('.details_value').removeClass('mt-2');
      $('.topDetailsDiv').removeClass('text-center');
      $('.labelForDetails').css('display', 'flex').css('justify-content', 'space-evenly');
    } else {
      $('.details_value').addClass('block w-full');
      $('.topDetailsDiv').addClass('text-center');
      $('.labelForDetails').css('display', 'block').css('justify-content', '');
      $('.details_value').addClass('mt-2');
    }
  }
  $(document).ready(function() {
    $(window).resize(function() {
      handleScreenSize();
    });
    <?php
    if (isset($_GET['roomid'])) {
    ?>
      $('.roomidExists').css('display', 'block');
      $('.TableColumns').css('display', 'none');
      $('.custTablePagination').css('display', 'none');
      $('.customerTableWithHeading').removeClass('my-6');
      ShowCustomersList('<?php echo $_GET['roomid']; ?>')

      $('input[name="txnTypeRadio"]').on('change', function() {
        var radioValue = $('input[name="txnTypeRadio"]:checked').val();
        var MonthlyPayDiv = $('#monthlyPay');

        if (radioValue == 'monthly') {
          MonthlyPayDiv.css('display', 'block')
          $("#rentInputLabel").html('Accumulated Rent')
        } else {
          MonthlyPayDiv.css('display', 'none')
          $("#rentInputLabel").html('Pending Amount')
        }
      });

      $('#ModalTxnAddBtn').on('click', function() {

        var txnAddType = $('input[name="txnTypeRadio"]:checked').val();

        var ModalCustDD = $('#ModalCustomerList');
        var pending_or_rent = $('#rentInputBox');

        var formTrue = true;
        var emptyFields = [];

        if (ModalCustDD.val() === '') {
          emptyFields.push('ModalCustomerList');
        }

        if (pending_or_rent.val() === '') {
          emptyFields.push('rentInputBox');
        }
        if (txnAddType == 'monthly') {
          var prevReading = $('#prevReadingInput');
          var ongoingReading = $('#ongoingReadingInput');
          var pendingVal = $('#TotalPayCalcVal').val() - pending_or_rent;
          debugger
          // if (parseInt(ongoingReading.val()) < parseInt(prevReading.val())) {
          //   $('#ongoingReadingInputError').html('Ongoing reading should not be less than previous reading!');
          //   $('#ongoingReadingInputError').removeClass('hidden');
          // }
          if (ongoingReading.val() === '') {
            emptyFields.push('ongoingReadingInput');
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
            //code to add monthaly txn
            AddPendingTxn();
          }

        } else {
          $('.error-message').addClass('hidden');

          if (emptyFields.length > 0) {
            // Display error messages for empty fields
            emptyFields.forEach(function(field) {
              $('#' + field + 'Error').removeClass('hidden');
            });
            formTrue = false;
          }
          if (formTrue) {
            //code to add pending txn
            AddPendingTxn();
          }
        }
      })

      function AddPendingTxn() {
        var txnAddType = $('input[name="txnTypeRadio"]:checked').val();
        var ModalCustId = $('#ModalCustomerList').val();
        var pending_or_rent = $('#rentInputBox').val();
        var noteVal = $('#noteVal').val();
        const roomTbId = '<?php echo $_GET['roomid']; ?>';

        if (txnAddType == 'monthly') {
          var prevReading = $('#prevReadingInput');
          var ongoingReading = $('#ongoingReadingInput');
          var pendingVal = $('#TotalPayCalcVal').val() - pending_or_rent;

          var data = {
            txntype: txnAddType,
            custid: ModalCustId,
            prevReading: prevReading.val(),
            ongoingReading: ongoingReading.val(),
            rentValue: $('#rentVal').html(),
            amtpaid: pending_or_rent,
            noteVal: noteVal,
            roomid: roomTbId,
            uid: '<?php echo $userID; ?>'
          }
        } else {
          var data = {
            txntype: txnAddType,
            custid: ModalCustId,
            amtpaid: pending_or_rent,
            noteVal: noteVal,
            roomid: roomTbId,
            uid: '<?php echo $userID; ?>'
          }
        }

        $.ajax({
          url: 'php/api/customers_addNewTxn.php',
          type: 'POST',
          dataType: 'JSON',
          data: data,
          success: function(data) {
            if (data.success) {
              //txn added successfully
              Swal.fire(
                'Added!',
                'Transaction Added Successfully!',
                'success'
              )
              ShowCustomerAllTxnData(data.roomNo, data.floorNo)
              var modalDiv = document.getElementById("addNewTxnModal");
              modalDiv.__x.$data.isModalOpen = false;
            }
          }
        })

      }
    <?php
    } else {
    ?>
      $('.roomidExists').css('display', 'none');
      $('.TableColumns').css('display', 'block');
      $('.custTablePagination').css('display', 'block');
      $('.customerTableWithHeading').addClass('my-6');
      ShowCustomersList()
    <?php
    }
    ?>
  })
</script>

</html>