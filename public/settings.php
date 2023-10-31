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
  <script src="./assets/js/focus-trap.js" defer></script>
  <script src="./pages/js/validation.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./style.css">

  <style>
    .tab {
      position: relative;
      overflow: hidden;
    }

    .tab::before {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      /* Adjust the height of the line as needed */
      background-color: transparent;
      /* Set the initial color of the line */
      transition: background-color 0.3s;
      /* Add a transition for a smooth effect */
    }

    .tab:hover::before,
    .tab:focus::before {
      background-color: purple;
      /* Change the color on hover and focus */
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
    $ActiveRoomsBar = "";
    $RoomActiveTextColor = '';
    $ActiveSettingsBar = "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>";
    $SettingsActiveTextColor = 'text-gray-800';
    include './php/header-asidebar.php';
    ?>

    <div class="flex flex-col flex-1 w-full">
      <?php
      include './php/header.php';
      ?>
      <main class="h-full overflow-y-auto">
        <div class="container px-6  mx-auto ">
          <div x-data="{ activeTab: 1, isModalOpen: false }">
            <!-- Tabs -->
            <div class="mb-4 my-6 ">
              <ul class="flex text-sm text-semibold font-medium text-gray-500 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <li x-on:click="activeTab = 1" :class="{ 'bg-gray-200': activeTab === 1 }" class="py-2 px-4 rounded-tl-lg tab" style="cursor: pointer;" data-translate="SettingsRoomTab">
                  Room
                </li>
                <li x-on:click="activeTab = 2" :class="{ 'bg-gray-200': activeTab === 2 }" class="py-2 px-4 rounded-tl-lg tab" style="cursor: pointer;" data-translate="SettingsTenantTab">
                  Tenant
                </li>
                <li x-on:click="activeTab = 3" :class="{ 'bg-gray-200': activeTab === 3 }" class="py-2 px-4 rounded-tr-lg tab" style="cursor: pointer;" data-translate="SettingsMeterTab">
                  Meter
                </li>
              </ul>
            </div>

            <!-- Tab Content -->
            <div x-show="activeTab === 1" class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <!-- Form 1 -->
              <h1 class="text-xl font-semibold mb-4 dark:text-gray-300" data-translate="SettingsCardHeader">Room Settings</h1>
              <!-- Add your form fields here -->
              <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/2 px-4">
                  <span class="px-4 text-gray-700 dark:text-gray-400" data-translate="SettingsRoomTypeItem">Add Room Type<span class="text-red-600 font-bold">*</span></span></span>
                  <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4">
                      <label class="block text-sm mb-2">
                        <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="bachelors/family..." />
                      </label>
                    </div>

                    <div class="w-full md:w-1/2 px-4">
                      <button class="bg-purple-600 text-white px-4 py-2 rounded-md mb-4" data-translate="SettingsAddRTBtn" id="AddRoomTypeBtn">Add</button>
                    </div>
                  </div>

                  <!-- <hr> -->
                  <div class="flex flex-wrap -mx-4  mb-4">
                    <div class="w-full md:w-1/2 px-4" id="room_type_badges">
                      <span class="px-2 py-1  mt-2 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        Bachelors <span class="ml-2 text-red-700" aria-hidden="true" style="cursor: pointer;">x</span>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="w-full md:w-1/2 px-4">
                  <span class="px-4 text-gray-700 dark:text-gray-400" data-translate="SettingsAddRoomDepositAmt">Add Room Deposit Amount<span class="text-red-600 font-bold">*</span></span>
                  <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4">
                      <label class="block text-sm mb-2">
                        <input type="text" style="text-align: right;" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="2500" />
                      </label>
                    </div>

                    <div class="w-full md:w-1/2 px-4">
                      <button class="bg-purple-600 text-white px-4 py-2 rounded-md mb-4" data-translate="SettingsAddRoomDepositAmtBtn" id="AddUpdateDepositBtn">Add</button>
                    </div>
                  </div>
                  <div class="flex flex-wrap -mx-4  mb-4">
                    <div class="w-full md:w-1/2 px-4">
                      <label class="block text-sm mb-2">
                        <span class=" text-gray-700 dark:text-gray-400" data-translate="SettingsCurrentDepositAmt">Current Deposit Ammount for Single room :</span>
                      </label>
                    </div>
                    <div class="w-full md:w-1/2 px-4" id="fixedDepositAmt">
                      <span class="px-2 py-1  mt-2 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                        2500
                      </span>
                    </div>
                  </div>
                  <!-- <button @click="isModalOpen = true" class="bg-purple-600 text-white px-4 py-2 rounded-md mb-4">Open Modal</button> -->
                </div>
              </div>

              <div class="flex flex-wrap -mx-4">

                <div class="w-full md:w-1/2 px-4">
                  <span class="px-4 text-gray-700 dark:text-gray-400">Set Number Of Floors<span class="text-red-600 font-bold">*</span></span>
                  <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4">
                      <label class="block text-sm mb-2">
                        <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="text-align: right;" placeholder="2" />
                      </label>
                    </div>

                    <div class="w-full md:w-1/2 px-4">
                      <button class="bg-purple-600 text-white px-4 py-2 rounded-md mb-4" id="AddUpdateTotalNumOfFloorsBtn">Add</button>
                    </div>
                  </div>
                  <div class="flex flex-wrap -mx-4  mb-4">
                    <div class="w-full md:w-1/2 px-4">
                      <label class="block text-sm mb-2">
                        <span class=" text-gray-700 dark:text-gray-400">Total number of floors :</span>
                      </label>
                    </div>
                    <div class="w-full md:w-1/2 px-4" id="numoffloors">
                      <span class="px-2 py-1  mt-2 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100">
                        3
                      </span>
                    </div>
                  </div>
                  <!-- <button @click="isModalOpen = true" class="bg-purple-600 text-white px-4 py-2 rounded-md mb-4">Open Modal</button> -->
                </div>


                <div class="w-full md:w-1/2 px-4">
                  <span class="px-4 text-gray-700 dark:text-gray-400">Set Number Of Rooms Per Floor<span class="text-red-600 font-bold">*</span></span>
                  <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4">
                      <label class="block text-sm mb-2">
                        <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="text-align: right;" placeholder="6" />
                      </label>
                    </div>

                    <div class="w-full md:w-1/2 px-4">
                      <button class="bg-purple-600 text-white px-4 py-2 rounded-md mb-4" id="AddUpdateNumOfRoomsBtn">Add</button>
                    </div>
                  </div>
                  <div class="flex flex-wrap -mx-4  mb-4">
                    <div class="w-full md:w-1/2 px-4">
                      <label class="block text-sm mb-2">
                        <span class=" text-gray-700 dark:text-gray-400">Total number of Rooms :</span>
                      </label>
                    </div>
                    <div class="w-full md:w-1/2 px-4" id="rooms_per_floor">
                      <span class="px-2 py-1  mt-2 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100">
                        6
                      </span>
                    </div>
                  </div>
                  <!-- <button @click="isModalOpen = true" class="bg-purple-600 text-white px-4 py-2 rounded-md mb-4">Open Modal</button> -->
                </div>
              </div>

            </div>

            <div x-show="activeTab === 2" class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <!-- Form 2 -->
              <h1 class="text-xl font-semibold mb-4">Form 2</h1>
              <button @click="isModalOpen = true" class="bg-purple-600 text-white px-4 py-2 rounded-md mb-4">Open Modal</button>
              <!-- Add your form fields here -->
            </div>

            <div x-show="activeTab === 3" class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <!-- Meter settings 3 -->
              <h1 class="text-xl font-semibold mb-4 dark:text-gray-300">Electricity Meter Settings</h1>
              <!-- Add your form fields here -->
              <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/2">
                  <span class="px-4 text-gray-700 dark:text-gray-400">Enter Meter Rate<span class="text-red-600 font-bold">*</span></span>
                  <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4">
                      <label class="block text-sm mb-2">
                        <input type="text" maxlength="5" oninput="InputNumberOnly(this.id)" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="text-align: right;" placeholder="10" />
                      </label>
                    </div>

                    <div class="w-full md:w-1/2 px-4">
                      <button class="bg-purple-600 text-white px-4 py-2 rounded-md mb-4" id="AddMeterRateBtn">Add</button>
                    </div>
                  </div>

                  <!-- <hr> -->
                  <div class="flex flex-wrap -mx-4  mb-4">
                    <div class="w-full md:w-1/2 px-4">
                      <span class="text-gray-700 dark:text-gray-400">Current Meter Rate</span>
                    </div>
                    <div class="w-full md:w-1/2 px-4 mt-2" id="meter_rate_badge">
                      <span class="px-2 py-1 mt-2 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        10 RS
                      </span>
                    </div>
                  </div>
                </div>

                <div class="w-full md:w-1/2 px-4">

                </div>
              </div>
            </div>


            <!-- @click="isModalOpen = true" -->
            <!-- Modal backdrop. This what you want to place close to the closing body tag -->
            <div x-show="isModalOpen" @click.away="isModalOpen = true" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
              <!-- Modal -->
              <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeModal" @keydown.escape="closeModal" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal">
                <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                <header class="flex justify-end">
                  <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" @click="isModalOpen = false" id="modalCloseOnClick">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                      <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                  </button>
                </header>
                <!-- Modal body -->
                <div class="mt-4 mb-6">
                  <!-- Modal title -->
                  <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                    Modal header
                  </p>
                  <!-- Modal description -->
                  <p class="text-sm text-gray-700 dark:text-gray-400">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum et
                    eligendi repudiandae voluptatem tempore!
                  </p>
                </div>
                <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                  <button @click="isModalOpen = false" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    Cancel
                  </button>
                  <button class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Accept
                  </button>
                </footer>
              </div>
            </div>
            <!-- End of modal backdrop -->
          </div>

        </div>
      </main>

    </div>
  </div>
</body>
<!-- sweet alert cdn  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<!-- jquery cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="./pages/js/main.js"></script>
<script>
  GetMasterDataAll();
  $('#AddUpdateDepositBtn').on('click', function() {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      // confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
      // denyButtonClass: "btn btn-danger w-xs mt-2",
      // buttonsStyling: !1,
      focusConfirm: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showClass: {
        popup: 'animate__animated animate__fadeInDown'
      },
      hideClass: {
        popup: 'animate__animated animate__fadeOutUp'
      }
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
      }
    })
  })



  $('#AddRoomTypeBtn').on('click', function() {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      // confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
      // denyButtonClass: "btn btn-danger w-xs mt-2",
      // buttonsStyling: !1,
      focusConfirm: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showClass: {
        popup: 'animate__animated animate__fadeInDown'
      },
      hideClass: {
        popup: 'animate__animated animate__fadeOutUp'
      }
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
      }
    })
  })
  $('#AddMeterRateBtn').on('click', function() {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      // confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
      // denyButtonClass: "btn btn-danger w-xs mt-2",
      // buttonsStyling: !1,
      focusConfirm: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showClass: {
        popup: 'animate__animated animate__fadeInDown'
      },
      hideClass: {
        popup: 'animate__animated animate__fadeOutUp'
      }
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
      }
    })
  })
</script>
<!-- <script>
  $(document).ready(function() {
    // Initial modal state
    let isModalOpen = false;

    // Function to open the modal
    function openModal() {
      isModalOpen = true;
      $('#modal').show(); // Show the modal
    }

    // Function to close the modal
    function closeModal() {
      isModalOpen = false;
      $('#modal').hide(); // Hide the modal
    }

    // Add an event listener to handle modal opening
    $('#openModalButton').click(openModal);

    // Add an event listener to handle modal closing
    $('#modalCloseOnClick').click(closeModal);
  });
</script> -->


</html>