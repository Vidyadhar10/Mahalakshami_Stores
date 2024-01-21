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

  <!-- Include the Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }" id="main-body">
    <!-- Desktop sidebar -->
    <?php
    $ActiveHomeBar = "";
    $HomeActiveTextColor = '';
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
        <div class="container px-6 mx-auto">
          <h4 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300" data-translate="AllRooms">
            All Rooms
          </h4>
          <div class="grid  gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4" id="roomCardsDiv">

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
    </div>
  </div>

  <section id="no-internet-section" style="display: none;">
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div class="container flex flex-col items-center px-6 mx-auto">
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

<!-- Include the Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Include baguetteBox.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css" />

<!-- Include baguetteBox.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Initialize Swiper -->
<script>

</script>

<script>
  <?php
  if ($_SESSION['AdminStatus'] == 0) {
    if ($_SESSION['isAuthorized'] == 0) {
  ?>
      $('.adminView').css('display', 'none')
      $('.unauthorizedUserView').css('display', 'block')
      $('.authorizedUserView').css('display', 'none')
      showRoomsCardsData(atob('<?php echo $_GET['admid']; ?>'), '<?php echo $_SESSION['AdminStatus']; ?>')
      // jQuery code to handle button click and toggle submenu
      $(document).ready(function() {
        $('.dropdown-toggle-btn').on('click', function() {
          var dropdownMenu = $(this).closest('.dropdown-container').find('.dropdown-menu');

          var xData = dropdownMenu.closest('[x-instance="rentDetailsDropdown"]');
          if (xData.length > 0) {
            var isPagesMenuOpen = xData[0].__x.$data.isPagesMenuOpen;
            xData[0].__x.$data.isPagesMenuOpen = !isPagesMenuOpen;
          }
        });
      });
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
  ShowNotifications('<?php echo $userID; ?>');
</script>



</html>