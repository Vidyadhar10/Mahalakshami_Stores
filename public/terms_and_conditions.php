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
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
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
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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