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
  <script src="./assets/js/focus-trap.js" defer></script>
  <link rel="stylesheet" href="./style.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link id="fontStyleForLanguage" href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">

</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
    <?php
    $ActiveHomeBar = '';
    $HomeActiveTextColor = '';
    $ActiveCustomerBar = "";
    $CustomerActiveTextColor = '';
    $ActiveRoomsBar = "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>";
    $RoomActiveTextColor = 'text-gray-800';
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
          <div class="my-6 grid gap-6 mb:grid-cols-2 xl:grid-cols-12">
            <div class="flex flex-wrap -mx-4  bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="w-full md:w-1/2 px-2 mt-2">
                <a href="#" @click="openModal" id="AddNewRoomBtn" data-translate="AddNewRoomBtn" class="inline-flex mb-4 mt-2 ml-2 mr-2  items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-600 border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                  Add New Room
                </a>
              </div>
              <div class="w-full md:w-1/2 px-4 mt-2">
                <div class="relative w-full max-w-xl mt-2 mb-2 mr-6 focus-within:text-purple-500">
                  <div class="absolute inset-y-0 flex items-center pl-2">
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                  </div>
                  <input id="search-input" class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text" placeholder="Search for room number" aria-label="Search" data-translate="roomsInputSearchBox" />
                </div>
              </div>
            </div>
          </div>
          <h4 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300" data-translate="AllRooms">
            All Rooms
          </h4>
          <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4" id="roomCardsDiv">


          </div>
          <div class="w-full my-6 overflow-hidden rounded-lg shadow-xs">
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
      </main>

      <!-- preloader here  -->
      <div id="preloader" class="preloader-container">
        <div class="preloader"></div>
      </div>

      <!-- add Room modal start  -->
      <div x-data="{ isModalOpen: false }" id="addNewRoomModal">

        <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
          <!-- Modal -->
          <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0  transform translate-y-1/2" @keydown.escape="closeModal" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal">
            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
            <header class="flex justify-end">
              <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700 addRoomModalCloseBtn" aria-label="close" @click="closeModal">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                  <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg>
              </button>
            </header>
            <!-- Modal body -->
            <div class="mt-4 mb-6">
              <!-- Modal title -->
              <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300" data-translate="RoomsCardModalHeader">
                New Room Details
              </p>
              <!-- Modal description -->
              <form>
                <div class="flex flex-wrap -mx-4">
                  <div class="w-full md:w-1/2 px-4">
                    <div class=" mb-2 text-sm">
                      <span class="text-gray-700 dark:text-gray-400">
                        Select add option
                      </span>
                      <div class="mt-2">
                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                          <input type="radio" checked class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="roomTypeRadio" value="single" />
                          <span class="ml-2">Single</span>
                        </label>
                        <label class="inline-flex items-center md:ml-6 text-gray-600 dark:text-gray-400">
                          <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="roomTypeRadio" value="multiple" />
                          <span class="ml-2">Multiple (same structured)</span>
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="w-full md:w-1/2 px-4">
                    <label class="block text-sm mb-2" id="inputBoxForMultipleRooms" style="display: none;">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="RoomNumModalForm">Enter Room Numbers(1-4) <span class="text-red-600 font-bold">*</span></span>
                      <input type="text" id="roomsNumbOnMultiple" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="e.g. 1-4 for 4 rooms" />
                      <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="roomsNumbOnMultipleError">
                        Room numbers should not be empty!.
                      </span>
                    </label>

                  </div>
                </div>

                <div class="flex flex-wrap -mx-4">

                  <div class="w-full md:w-1/2 px-4">
                    <label class="block mb-2 text-sm">
                      <span class="text-gray-700 dark:text-gray-400">
                        Select Floor<span class="text-red-600 font-bold">*</span></span>
                      </span>
                      <select id="floorDD" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected>Select</option>
                        <option>ground floor</option>
                        <option>1st floor</option>
                        <option>2nd floor</option>
                      </select>
                      <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="floorDDError">
                        Please select floors!
                      </span>
                    </label>

                  </div>

                  <div class="w-full md:w-1/2 px-4">
                    <label class="block text-sm mb-2">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="TenantCapacity">Enter tenant capacity <span class="text-red-600 font-bold">*</span></span></span>
                      <input type="number" id="tenantCapacityInputBox" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="text-align: right;" placeholder="4" />
                      <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="tenantCapacityInputBoxError">
                        Tenant capacity should not be empty!.
                      </span>
                    </label>

                  </div>
                </div>

                <div class="flex flex-wrap -mx-4">
                  <div class="w-full md:w-1/2 px-4">
                    <label class="block mb-2 text-sm">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="RoomType">
                        Room Type<span class="text-red-600 font-bold">*</span></span>
                      </span>
                      <select id="roomTypeDD" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected>Select</option>
                        <option>Bachelors</option>
                        <option>Family</option>
                      </select>
                      <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="roomTypeDDError">
                        Please select room type!
                      </span>
                    </label>
                  </div>

                  <div class="w-full md:w-1/2 px-4">
                    <label class="block text-sm mb-2">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="DepositAmt">Enter Deposit Amount<span class="text-red-600 font-bold">*</span></span>
                      <input type="number" id="depositAmtInputBox" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="text-align: right;" placeholder="5000" />
                      <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="depositAmtInputBoxError">
                        Deposit amount should not be empty!.
                      </span>
                    </label>
                  </div>
                </div>
                <div class="flex flex-wrap -mx-4">
                  <div class="w-full md:w-1/2 px-4">
                    <label class="block text-sm mb-2">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="RoomRentAmt">Enter Room Rent Amount<span class="text-red-600 font-bold">*</span></span>
                      <input type="number" id="RentAmtInputBox" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="text-align: right;" placeholder="2500" />
                      <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="RentAmtInputBoxError">
                        Room rent should not be empty!.
                      </span>
                    </label>
                  </div>

                  <div class="w-full md:w-1/2 px-4">

                  </div>
                </div>

                <label class="block text-sm mb-2 px-4">
                  <span class="text-gray-700 dark:text-gray-400" data-translate="AddNewRoomNoteItem">Note About Room (optional)</span>
                  <textarea id="roomNoteInputBox" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Enter some short note about transaction."></textarea>
                </label>

              </form>
            </div>
            <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
              <button @click="closeModal" class="addRoomModalCloseBtn w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray" data-translate="NewRoomCancelBtn">
                Cancel
              </button>
              <button id="addNewRoomModalBtn" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" data-translate="NewRoomAddBtn">
                Add
              </button>
            </footer>
          </div>
        </div>
        <!-- add txn modal end  -->
      </div>

    </div>
  </div>
</body>
<!-- sweet alert cdn  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<!-- ajax cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./pages/js/main.js"></script>

<script>
  showRoomsCardsData()
  $('#AddNewRoomBtn').on('click', function() {
    $('#floorDD').empty();
    $('#roomTypeDD').empty();
    GetFloorsForDropdown();
    GetRoomTypeForDropdown();
    var modalDiv = document.getElementById("addNewRoomModal");
    modalDiv.__x.$data.isModalOpen = true;
  })

  $('.addRoomModalCloseBtn').on('click', function() {
    closeAddRoomModal('addNewRoomModal')
  })

  $('input[name="roomTypeRadio"]').on('change', function() {
    var selectedValue = $('input[name="roomTypeRadio"]:checked').val();
    var RoomsCount = $('#roomsNumbOnMultiple');

    if (selectedValue == 'multiple') {
      $('#inputBoxForMultipleRooms').css('display', 'block')
    } else {
      $('#inputBoxForMultipleRooms').css('display', 'none')
      RoomsCount.val('')
    }
  });

  $('#addNewRoomModalBtn').on('click', function() {
    var RoomAddType = $('input[name="roomTypeRadio"]:checked').val();
    var RoomsCount = $('#roomsNumbOnMultiple');
    var floorValue = $('#floorDD');
    var tenantCapacityVal = $('#tenantCapacityInputBox');
    var roomTypeVal = $('#roomTypeDD');
    var DepositAmtVal = $('#depositAmtInputBox');
    var rentVal = $('#RentAmtInputBox');
    var noteVal = $('#roomNoteInputBox');

    var formTrue = true;
    var emptyFields = [];

    if (RoomAddType == 'multiple' && RoomsCount.val() === '') {
      emptyFields.push('roomsNumbOnMultiple');
    }

    if (floorValue.val() === '') {
      emptyFields.push('floorDD');
    }

    if (tenantCapacityVal.val() === '') {
      emptyFields.push('tenantCapacityInputBox');
    }

    if (roomTypeVal.val() === '') {
      emptyFields.push('roomTypeDD');
    }

    if (DepositAmtVal.val() === '') {
      emptyFields.push('depositAmtInputBox');
    }

    if (rentVal.val() === '') {
      emptyFields.push('RentAmtInputBox');
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
      RoomCountReachedToMax();
    }
  });


  function RoomCountReachedToMax() {
    var floorCnt = $('#floorDD').val();
    var enteredRoomNum = $('#roomsNumbOnMultiple').val();
    $.ajax({
      url: "php/api/rooms_isRoomCountExceeded.php",
      type: "POST",
      datatype: "JSON",
      data: {
        flrCnt: floorCnt,
        enteredRoomNum: enteredRoomNum,
      },
      success: function(data) {
        if (data.success) {
          Swal.fire({
            icon: 'error',
            title: 'Attention!',
            text: data.message,
          })
        } else {
          var formData = new FormData();

          // Append the variables to the FormData object
          formData.append('RoomAddType', $('input[name="roomTypeRadio"]:checked').val());
          formData.append('RoomsCount', $('#roomsNumbOnMultiple').val());
          formData.append('floorValue', $('#floorDD').val());
          formData.append('tenantCapacityVal', $('#tenantCapacityInputBox').val());
          formData.append('roomTypeVal', $('#roomTypeDD').val());
          formData.append('DepositAmtVal', $('#depositAmtInputBox').val());
          formData.append('rentVal', $('#RentAmtInputBox').val());
          formData.append('noteVal', $('#roomNoteInputBox').val());
          formData.append('userID', '<?php echo $userID; ?>');
          // Perform further actions
          AddNewRoomToDB(formData);
        }
        // Process data and display the list of customers
      }
    });
  }
  ShowNotifications('<?php echo $userID; ?>');
</script>

</html>