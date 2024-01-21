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
    $CustomerActiveTextColor = '';

    $ActiveRoomsBar = '';
    $RoomActiveTextColor = '';

    $ActiveRequestBar = '';
    $RequestActiveTextColor = '';

    $ActiveSupportBar = "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>";
    $SupportActiveTextColor = 'text-gray-800';

    $ActiveSettingsBar = '';
    $SettingsActiveTextColor = '';
    include './php/header-asidebar.php';
    ?>

    <div class="flex flex-col flex-1 w-full">
      <?php
      include './php/header.php';
      ?>
      <main class="h-full overflow-y-auto">

        <div class="container px-6  mx-auto grid">
          <div class="my-6 grid gap-6 mb:grid-cols-2 xl:grid-cols-12">
            <div class="flex flex-wrap -mx-4  bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="w-full md:w-1/2 px-2 mt-2">
                <a href="#" id="AddNewIssueBtn" data-translate="" class="inline-flex mb-4 mt-2 ml-2 items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-600 border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                  Raise New Issue
                </a>
                <!-- <a href="#" id="AddNewIssueBtn" data-translate="" class="inline-flex mb-4 mt-2 mr-2  items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                  View All Issues
                </a> -->
              </div>
              <div class="w-full md:w-1/2 px-4 mt-2">
                <div class="relative w-full max-w-xl mt-2 mb-2 mr-6 focus-within:text-purple-500">
                  <div class="absolute inset-y-0 flex items-center pl-2">
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                  </div>
                  <input id="issue-search-input" class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text" placeholder="Search for an issue / ticket" aria-label="Search" data-translate="roomsInputSearchBox" />
                </div>
              </div>
            </div>
          </div>

          <div class="w-full overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h4 class="mt-4 ml-4 mb-2 font-semibold text-gray-800 dark:text-gray-300" data-translate="RecentTxnTableHeading">
              Issues
            </h4>
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap" id="IssuesTable">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3" data-translate="">Sr No</th>
                    <th class="px-4 py-3" data-translate="">Title</th>
                    <th class="px-4 py-3" data-translate="">category</th>
                    <th class="px-4 py-3" data-translate="">description</th>
                    <th class="px-4 py-3" data-translate="">status</th>
                    <th class="px-4 py-3" data-translate="">resolution remark</th>
                    <th class="px-4 py-3" data-translate="">raised by</th>
                    <th class="px-4 py-3" data-translate="">raised on</th>
                    <th class="px-4 py-3" data-translate="">Action</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="20">
                      1
                    </td>
                    <td class="px-4 py-3 text-sm font-semibold" style="text-align: left;" width="100">
                      Navbar themeing option not working
                    </td>
                    <td class="px-4 py-3 text-sm font-semibold" style="text-align: left;" width="100">
                      UI-Navbar
                    </td>
                    <td class="px-4 py-3 text-sm" style="text-align: left; max-width: 300px; white-space: pre-wrap;">There's a option of theme which is not working properly so please make sure it won't happen again</td>
                    <td class="px-4 py-3 text-xs">
                      <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        resolved
                      </span>
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
                    <td class="px-4 py-3 text-sm">
                      26-11-2023
                    </td>
                    <td class="px-4 py-3">
                      <div class="flex items-center space-x-2 text-sm">
                        <button onclick="showEditDataInForm()" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                          <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                            </path>
                          </svg>
                        </button>
                        <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                          <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                          </svg>
                        </button>
                      </div>
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

  <!-- add Issue modal start  -->
  <div x-data="{ isModalOpen: false }" id="addNewIssueModal">

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
          <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300" data-translate="">
            New Issue Details
          </p>
          <!-- Modal description -->
          <form>
            <div class="flex flex-wrap -mx-4">

              <div class="w-full md:w-1/2 px-4">
                <label class="block text-sm mb-2">
                  <span class="text-gray-700 dark:text-gray-400" data-translate="">Enter Issue Title <span class="text-red-600 font-bold">*</span></span>
                  <input type="text" id="inputIssueTitle" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="e.g. Menubar option not clickable" />
                  <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="inputIssueTitleError">
                    Issue title should not be empty!.
                  </span>
                </label>
              </div>

              <div class="w-full md:w-1/2 px-4">
                <label class="block mb-2 text-sm">
                  <span class="text-gray-700 dark:text-gray-400">
                    Select Category<span class="text-red-600 font-bold">*</span></span>
                  </span>
                  <select id="categoryDD" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option selected value="">Select</option>
                    <option value="1">UI-dashboard</option>
                    <option value="2">Back-End</option>
                    <option value="3">Database</option>
                  </select>
                  <span class="text-xs text-red-600 dark:text-red-400 error-message hidden" id="categoryDDError">
                    Please select category!
                  </span>
                </label>
              </div>

            </div>
            <label class="block text-sm mb-2 px-4">
              <span class="text-gray-700 dark:text-gray-400" data-translate="">Issue Description</span>
              <textarea id="IssueDescriptionInputBox" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Enter some short description about issue."></textarea>
            </label>

          </form>
        </div>
        <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
          <button class="addRoomModalCloseBtn w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray" data-translate="">
            Cancel
          </button>
          <button id="raiseNewIssueBtn" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" data-translate="">
            Raise
          </button>
          <button id="updateIssueBtn" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple hidden" data-translate="">
            Update
          </button>
        </footer>
      </div>
    </div>
    <!-- add txn modal end  -->
  </div>
</body>
<!-- sweet alert cdn  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<!-- moment.js cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- ajax cdn  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- main js  -->
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

  ShowAllIssues();
  ShowIssueCategoryDD()
  $("#AddNewIssueBtn").on('click', function() {
    $('#updateIssueBtn').addClass('hidden')
    $('#raiseNewIssueBtn').removeClass('hidden')
    var modalDiv = document.getElementById("addNewIssueModal");
    modalDiv.__x.$data.isModalOpen = true;
  })
  $('.addRoomModalCloseBtn').on('click', function() {
    closeAddRoomModal('addNewIssueModal')
    $("#inputIssueTitle").val('');
    $("#categoryDD").val('');
    $('#IssueDescriptionInputBox').val('');
  })


  $('#raiseNewIssueBtn').on('click', function() {

    event.preventDefault();
    var isValid = true;
    if ($("#inputIssueTitle").val() == '') {
      isValid = false;
      $('#inputIssueTitleError').removeClass('hidden')
    }
    if ($("#categoryDD").val() == '') {
      isValid = false;
      $('#categoryDDError').removeClass('hidden')
    }

    if (isValid) {
      $('#inputIssueTitleError').addClass('hidden')
      $('#categoryDDError').addClass('hidden')

      AddNewIssueToDB('<?php echo $userID; ?>')
      closeAddRoomModal('addNewIssueModal')
      $("#inputIssueTitle").val('');
      $("#categoryDD").val('');
      $('#IssueDescriptionInputBox').val('');
    }
  })
</script>

</html>