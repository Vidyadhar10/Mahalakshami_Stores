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

          <div class="w-full my-6 max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto p-6">

            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Terms and Conditions</h2>

            <div class="mb-6">
              <p class="text-sm text-gray-700 dark:text-gray-400">Please read and agree to the following terms and conditions before proceeding:</p>
            </div>

            <div class="mb-6">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">1. Smoking Policy</h3>
              <p class="text-sm text-gray-700 dark:text-gray-400">Smoking is strictly prohibited within the premises of the rental room.</p>
            </div>

            <div class="mb-6">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">2. Tenant Interaction</h3>
              <p class="text-sm text-gray-700 dark:text-gray-400">Tenants are expected to respect the privacy and space of fellow tenants. No interference with other tenants' belongings or activities is allowed.</p>
            </div>

            <div class="mb-6">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">3. Quiet Hours</h3>
              <p class="text-sm text-gray-700 dark:text-gray-400">Quiet hours are enforced between 10:00 PM and 7:00 AM. Please keep noise levels to a minimum during this time to ensure a peaceful environment for all tenants.</p>
            </div>

            <div class="mb-6">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">4. Guest Policy</h3>
              <p class="text-sm text-gray-700 dark:text-gray-400">Tenants are responsible for the behavior of their guests. Guests must adhere to the same rules and regulations outlined in these terms and conditions.</p>
            </div>

            <div class="mb-6">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">5. Maintenance Responsibilities</h3>
              <p class="text-sm text-gray-700 dark:text-gray-400">Tenants are responsible for keeping their rented space clean and reporting any maintenance issues promptly to the landlord or property manager.</p>
            </div>

            <!-- Add more terms and conditions as needed -->

            <!-- Submit Button -->
            <button onclick="window.history.back();" class="mt-6 bg-purple-600 text-white text-sm font-medium py-2 px-4 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Agree and Proceed</button>
            <!-- <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Cancel</a> -->

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="./pages/js/main.js"></script>

<script>
  ShowNotifications('<?php echo $userID; ?>');
</script>
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