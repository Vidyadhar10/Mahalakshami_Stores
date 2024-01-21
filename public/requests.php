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
  <style>
    /* .parent {
      position: relative;
      overflow: hidden;
    }

    .parent thead {
      transform: translateY(-100%);
      position: absolute;
      transition: transform 0.3s ease;
    }

    .parent tbody {
      transform: translateY(0);
      transition: transform 0.3s ease;
    }

    .parent:hover thead {
      transform: translateY(0);
      transition: transform 0.3s ease;
    }

    .parent:hover tbody {
      transform: translateY(100%);
    } */
  </style>

</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }" id="main-body">
    <!-- Desktop sidebar -->
    <?php
    $ActiveHomeBar = '';
    $HomeActiveTextColor = '';

    $ActiveCustomerBar = "";
    $CustomerActiveTextColor = '';

    $ActiveRequestBar = "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>";
    $RequestActiveTextColor = 'text-gray-800';

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


      <main class="h-full overflow-y-auto content-loaded">
        <div class="container px-6 mx-auto ">

          <div class="my-6 grid gap-6 mb:grid-cols-2 xl:grid-cols-12">
            <div class="flex flex-wrap -mx-4  bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="w-full md:w-1/2 px-2 mt-2">
                <div class="flex flex-wrap">
                  <a href="#" id="AllReqBtn" data-translate="" class="inline-flex mb-4 mt-2 mr-2  items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-600 border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                    All Requests
                  </a>
                  <a href="#" id="todaysReqBtn" data-translate="" class="inline-flex mb-4 mt-2 mr-2  items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                    Today's Requests
                  </a>
                </div>
              </div>
              <div class="w-full md:w-1/2 px-4 mt-2">
                <div class="relative w-full max-w-xl mt-2 mb-2 mr-6 focus-within:text-purple-500">
                  <div class="absolute inset-y-0 flex items-center pl-2">
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                  </div>
                  <input id="request-search-input" class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text" placeholder="Search for request" aria-label="Search" data-translate="roomsInputSearchBox" />
                </div>
              </div>
            </div>
          </div>

          <div class="mb-4 grid gap-6 mb:grid-cols-2 xl:grid-cols-12">
            <div class="flex flex-wrap -mx-4  bg-white rounded-lg shadow-xs dark:bg-gray-800 overflow-x-auto">
              <table class="w-full parent whitespace-no-wrap">
                <thead class="child">
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3" data-translate="">Sr No</th>
                    <th class="px-4 py-3" data-translate="">Mobile No</th>
                    <th class="px-4 py-3 avatarTheadTitle" data-translate="">Avatar</th>
                    <th class="px-4 py-3" data-translate="">Floor</th>
                    <th class="px-4 py-3" data-translate="">Room No</th>
                    <th class="px-4 py-3" data-translate="">Request Date Time</th>
                    <th class="px-4 py-3" data-translate="">Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>

          <!-- <thead class="child">
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3" data-translate="">Sr No</th>
                      <th class="px-4 py-3" data-translate="">Mobile No</th>
                      <th class="px-4 py-3" data-translate="">Avatar</th>
                      <th class="px-4 py-3" data-translate="">Room No</th>
                      <th class="px-4 py-3" data-translate="" style="text-align: right;">Floor</th>
                      <th class="px-4 py-3" data-translate="">Request Date Time</th>
                      <th class="px-4 py-3" data-translate="">Action</th>
                    </tr>
                  </thead> -->
          <div class="mb-6 grid mb:grid-cols-2 xl:grid-cols-12" style="gap : 0.5rem;" id="requestCardsTr">

          </div>

        </div>
      </main>

      <!-- preloader here  -->
      <div id="preloader" class="preloader-container">
        <div class="preloader"></div>
      </div>

    </div>
  </div>

  <!-- no internet section  -->
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<!-- moment.js cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script src="./pages/js/main.js"></script>
<script>
  $(document).ready(function() {
    ShowAllRequests();
  })

  $("#request-search-input").on("keyup", function() {
    var searchText = $(this).val().toLowerCase();
    $("#requestCardsTr .cardRow").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
    });
  });

  //show today's requests
  $('#todaysReqBtn').on('click', function() {
    $(this).removeClass('text-gray-900 bg-white hover:bg-gray-100').addClass('text-white bg-purple-600')
    $('#AllReqBtn').addClass('text-gray-900 bg-white hover:bg-gray-100').removeClass('text-white bg-purple-600')
    var todayDate = new Date().toLocaleDateString('en-GB', {
      day: 'numeric',
      month: 'numeric',
      year: 'numeric'
    }).split('/').join('-');
    $("#requestCardsTr .cardRow .reqDate").filter(function() {
      // Compare each record's date with today's date
      $(this).closest('.cardRow').toggle($(this).closest('.reqDate').text().trim() === todayDate);
    });
  })

  // show all recoreds 
  $('#AllReqBtn').on('click', function() {
    $(this).removeClass('text-gray-900 bg-white hover:bg-gray-100').addClass('text-white bg-purple-600')
    $('#todaysReqBtn').addClass('text-gray-900 bg-white hover:bg-gray-100').removeClass('text-white bg-purple-600')

    $("#requestCardsTr .cardRow").show();
  });

  //show notifications
  ShowNotifications('<?php echo $userID; ?>');
  setInterval(function() {
    ShowNotifications('<?php echo $userID; ?>');
  }, 300000);
</script>

</html>