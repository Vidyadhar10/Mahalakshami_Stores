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
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }" id="main-body">
    <!-- Desktop sidebar -->
    <?php
    $ActiveHomeBar = '';
    $HomeActiveTextColor = '';

    $ActiveCustomerBar = "";
    $CustomerActiveTextColor = '';

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
        <div class="container px-6 my-6 mx-auto grid">

          <div class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto p-3">
            <form class="p-2">
              <div class="flex flex-col md:flex-row items-center">
                <!-- Left Column (Profile Image) -->
                <div class="relative w-full mb-4 md:w-1/2 " id="profileImg" style="width: 250px; height: 210px;">
                  <img id="profileImgBox" class="object-cover w-full h-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg4fQ" alt="Profile Image" loading="lazy" />
                  <div class="absolute inset-0 shadow-inner" aria-hidden="true"></div>
                  <div class="absolute inset-0 flex items-start justify-end p-2">
                    <!-- Camera Icon from Heroicons -->
                    <svg id="uploadImgIcon" style="cursor: pointer;" class="h-6 w-6 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500 transition duration-300 ease-in-out" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path> -->
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"></path>
                    </svg>
                  </div>
                </div>

                <!-- Right Column (User Details) -->
                <div class="md:w-1/2 md:ml-4 ml-4">
                  <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white" id="userName">Bonnie Green</h5>
                  <span class="text-sm text-gray-500 dark:text-gray-400" id="userDesignation">Visual Designer</span>
                  <div class="flex mt-4 space-x-3">
                    <span class="text-sm text-gray-500 font-medium dark:text-gray-400">Address:</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400" id="userAddress">Korochi</span>
                  </div>
                  <div class="flex mt-2 space-x-3">
                    <span class="text-sm text-gray-500 font-medium dark:text-gray-400">Mobile Number:</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400" id="mobileNumber"></span>
                  </div>
                  <div class="flex mt-2 space-x-3">
                    <span class="text-sm text-gray-500 font-medium dark:text-gray-400">Customer Added Date:</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400" id="userAddedDate">10/03/2023</span>
                  </div>
                  <div class="flex mt-4 space-x-3">
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700" id="UpdateDetailsBtn">Update Details</a>
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700" id="UpdatePasswordBtn">Update Password</a>
                  </div>
                </div>
              </div>
            </form>
          </div>

        </div>

        <div class="container px-6 my-6 mx-auto grid" id="update-details-card" style="display: none;">

          <div class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto p-3">

            <div class="flex flex-wrap -mx-4">
              <div class="w-full md:w-1/2 ">
                <div class="flex flex-wrap -mx-4">
                  <div class="w-full md:w-1/2 px-4">
                    <!-- Name -->
                    <label class="block text-sm">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="Name">Name<span class="text-red-600 font-bold">*</span></span>
                      <input id="userNameInput" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" required />
                    </label>
                  </div>
                  <div class="w-full md:w-1/2 px-4">
                    <!-- Email -->
                    <label class="block text-sm" da>
                      <span class="text-gray-700 dark:text-gray-400" data-translate="email">Email</span>
                      <input id="userEmailInput" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="email" placeholder="jane@example.com" />
                    </label>
                  </div>
                </div>
              </div>


              <div class="w-full md:w-1/2">
                <div class="flex flex-wrap -mx-4">
                  <div class="w-full md:w-1/2 px-4">
                    <!-- Designation -->
                    <label class="block  text-sm">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="Designation">Designation</span>
                      <input id="userDesignationInput" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Designer" required />
                    </label>
                  </div>
                  <div class="w-full md:w-1/2 px-4">
                    <!-- Mobile Number -->
                    <label class="block  text-sm">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="MobileNum">Mobile Number</span>
                      <input id="userMobileInput" disabled class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="123-456-7890" required />
                    </label>
                  </div>

                </div>
              </div>
            </div>

            <div class="flex flex-wrap -mx-4">
              <div class="w-full md:w-1/2 ">
                <!-- Address -->
                <label class="block mt-4 px-4 text-sm">
                  <span class="text-gray-700 dark:text-gray-400" data-translate="Address">Address <span class="text-red-600 font-bold">*</span></span>
                  <textarea id="userAddressInput" rows="1" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Enter Address"></textarea>
                </label>
              </div>
              <div class="w-full md:w-1/2 ">
                <!-- <div class="flex flex-wrap -mx-4">
                  <div class="w-full md:w-1/2 px-4">
                    <label class="block mt-4 text-sm">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="AccountNum">Account Number <span class="text-red-600 font-bold">*</span></span>
                      <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="123" required />
                    </label>
                  </div>
                  <div class="w-full md:w-1/2 px-4">
                    <label class="block mt-4 text-sm">
                      <span class="text-gray-700 dark:text-gray-400" data-translate="SelectRoomNum">
                        Select Room Number<span class="text-red-600 font-bold">*</span>
                      </span>
                      <select class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                      </select>
                    </label>
                  </div>
                </div> -->
              </div>

            </div>

            <div class="flex flex-wrap -mx-4">
              <div class="w-full md:w-1/2 px-4">
                <!-- Documents Upload -->
                <label class="block mt-4 text-sm">
                  <span class="text-gray-700 dark:text-gray-400" data-translate="UploadDoc">Upload Documents <span class="text-red-600 font-bold">*</span></span>
                  <input type="file" multiple class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input" accept=".pdf, .doc, .docx, .jpg, .jpeg" required />
                </label>
              </div>
              <div class="w-full md:w-1/2 px-4">
                <!-- Photo upload  -->
                <label class="block mt-4  text-sm">
                  <span class="text-gray-700 dark:text-gray-400" data-translate="UploadPhoto">Upload Photo<span class="text-red-600 font-bold">*</span></span>
                  <input type="file" id="uploadImgIconInput" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input" accept=".jpg, .png" required />
                </label>
              </div>
            </div>
            <!-- Terms and Conditions -->
            <div class="mt-6 px-4 text-sm">
              <label class="flex items-center dark:text-gray-400">
                <input type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required />
                <span class="ml-2">
                  I agree to the
                  <a href="./terms_and_conditions.php"><span class="underline">terms and conditions</span></a>
                </span>
              </label>
            </div>

            <!-- Submit Button -->
            <button class="mt-6 bg-purple-600 text-white ml-4  text-sm font-medium py-2 px-4 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" data-translate="UpdateProfileDataBtn">Update</button>
            <!-- <a href="./customer_list.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700" data-translate="CancelBtn">Cancel</a> -->

          </div>
        </div>

        <div class="container px-6 my-6 mx-auto" id="passwordupdatecard" style="display: none;">
          <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800  mt-6 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
              Update Password
            </h4>
            <div class="flex flex-wrap -mx-4">
              <div class="w-full md:w-1/2 ">

                <div class="flex flex-wrap -mx-4 mt-1">
                  <div class="w-full md:w-1/2 px-4">
                    <label class="block text-sm">
                      <span class="text-gray-700 dark:text-gray-400">Old Password<span class="text-red-600 font-bold">*</span></span>
                      <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="********" />
                    </label>
                  </div>
                  <div class="w-full md:w-1/2 px-4 ">
                    <label class="block  text-sm">
                      <span class="text-gray-700 dark:text-gray-400">New Password<span class="text-red-600 font-bold">*</span></span>
                      <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="********" />
                    </label>
                  </div>
                </div>

              </div>

              <div class="w-full md:w-1/2">
                <div class="flex flex-wrap -mx-4">
                  <div class="w-full md:w-1/2 px-4 mt-1">
                    <label class="block text-sm">
                      <span class="text-gray-700 dark:text-gray-400">Confirm Password<span class="text-red-600 font-bold">*</span></span>
                      <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="********" />
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex mt-4 space-x-3 md:mt-6 px-4">
              <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="updatePassFormBtn">Update</a>
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
    $("#UpdatePasswordBtn").on("click", function() {
      $('#passwordupdatecard').css('display', 'block');
      $('#update-details-card').css('display', 'none');
      $(this).removeClass('text-gray-900 bg-white hover:bg-gray-100').addClass('text-white bg-purple-600')
      $('#UpdateDetailsBtn').addClass('text-gray-900 bg-white hover:bg-gray-100').removeClass('text-white bg-purple-600')

    });
    $("#UpdateDetailsBtn").on("click", function() {
      $('#passwordupdatecard').css('display', 'none');
      $('#update-details-card').css('display', 'block');
      $(this).removeClass('text-gray-900 bg-white hover:bg-gray-100').addClass('text-white bg-purple-600')
      $('#UpdatePasswordBtn').addClass('text-gray-900 bg-white hover:bg-gray-100').removeClass('text-white bg-purple-600')

    });
    ShowTenantProfileData('<?php echo $userID; ?>')
    ShowNotifications('<?php echo $userID; ?>');


    $('#uploadImgIcon').on('click', function() {
      $('#uploadImgIconInput').click();
    })

    $('#uploadImgIconInput').on('change', function() {
      if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#profileImgBox').attr('src', e.target.result).css('filter', '');
        };
        reader.readAsDataURL(this.files[0]);
      }
    });

  });
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