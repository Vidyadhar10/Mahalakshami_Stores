//code for checking internet connection 
function checkInternetConnection() {
    fetch('php/googleUrl.php')
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                // throw new Error('Internet is not connected');
                document.getElementById('no-internet-section').style.display = "";
                document.getElementById('main-body').style.display = "none";
            } else {
                // console.log('Internet is connected');
            }
        });
}

// Call the function to check the internet connection
checkInternetConnection();

// preloader stops when page loads completely
document.addEventListener("DOMContentLoaded", function () {
    // Remove the preloader when the content is loaded
    document.getElementById("preloader").style.display = "none";
});

// full screen icon with size toggle 
function togglefullscreen() {
    if (!document.fullscreenElement) {
        var fullScrLI = document.getElementById("fullScrIcon");
        fullScrLI.__x.$data.full = true;
        // If the page is not in full-screen mode, request full screen
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
            document.documentElement.webkitRequestFullscreen();
        } else if (document.documentElement.msRequestFullscreen) {
            document.documentElement.msRequestFullscreen();
        }
    } else {
        var fullScrLI = document.getElementById("fullScrIcon");
        fullScrLI.__x.$data.full = false;
        // If the page is in full-screen mode, exit full screen
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
}


// language toggler 
function ToggleLanguageBtn(lang) {
    var currentLang = lang;
    var supportedLanguages = ['eng', 'mar', 'fr', 'es']; // Add more languages as needed

    // Find the index of the current language in the array
    var currentIndex = supportedLanguages.indexOf(currentLang);

    // Update the image source based on the selected language
    if (currentIndex === -1 || currentIndex === supportedLanguages.length - 1) {
        currentLang = supportedLanguages[0];
    } else {
        currentLang = supportedLanguages[currentIndex];
    }

    var newSrc = './images/lang-' + currentLang + '.png';
    languageChosen(currentLang);

    $('#languageIconImg').attr('src', newSrc);
    localStorage.setItem('language', currentLang);
}

$(document).ready(function () {
    // Set the default language to English and store it in localStorage
    if (!localStorage.getItem('language')) {
        localStorage.setItem('language', 'eng');
    }

    // Initialize the language icon based on the stored language
    var storedLanguage = localStorage.getItem('language');
    var languageIconSrc = './images/lang-' + storedLanguage + '.png';
    $('#languageIconImg').attr('src', languageIconSrc);
    languageChosen(storedLanguage);
    toggleFontStyle(storedLanguage)
})


//show language chosen appropriate
function languageChosen(lang) {
    toggleFontStyle(lang)
    var url = window.location.href;
    var parts = url.split('/');
    var filenameWithQuery = parts[parts.length - 1];
    var filename = filenameWithQuery.split('?')[0];
    var pageName = filename.split('.')[0];
    // Load the JSON translations file
    $.getJSON('JSON/translation.json', function (translations) {

        if (translations['Menubar']) {
            // Iterate through elements with data-translate attribute
            $('[data-translate]').each(function () {
                var key = $(this).data('translate');
                if (translations['Menubar'][key] && translations['Menubar'][key][lang]) {
                    // Update the element's content with the translation
                    $(this).html(translations['Menubar'][key][lang]);
                }
            });
        }
        if (translations[pageName]) {
            // Iterate through elements with data-translate attribute
            $('[data-translate]').each(function () {
                var key = $(this).data('translate');
                if (translations[pageName][key] && translations[pageName][key][lang]) {
                    // Update the element's content with the translation
                    $(this).text(translations[pageName][key][lang]);
                    if (key == 'roomsInputSearchBox') {
                        $(this).attr('placeholder', `${translations[pageName][key][lang]}`)
                    }
                    if (key == 'CustomerInputSearchBox') {
                        $(this).attr('placeholder', `${translations[pageName][key][lang]}`)
                    }
                }
            });
        }
        // if (translations[pageName]) {
        //     // Iterate through elements with data-translate attribute
        //     $('[data-translate]').each(function () {
        //         var key = $(this).data('translate');
        //         if (translations[pageName][key] && translations[pageName][key][lang]) {
        //             // Update the element's content with the translation
        //             $(this).html(translations[pageName][key][lang]);



        //         }
        //     });
        // }
    });
}


var fontLinks = {
    'eng': "https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap",
    'mar': "https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Marathi&display=swap",
    // Add more font links for other languages as needed
};

var activeFontLang = 'eng'; // Default font language

function toggleFontStyle(lang) {
    // Toggle the font language
    activeFontLang = lang;

    // Remove the current font link
    $('#fontStyleForLanguage').remove();

    // Add the selected font link to the head
    $('head').append('<link id="fontStyleForLanguage" rel="stylesheet" href="' + fontLinks[activeFontLang] + '">');

    // Apply the font-family style to the body
    if (activeFontLang === 'mar') {
        $('body').css('font-family', "'Tiro Devanagari Marathi', serif");
    } else {
        $('body').css('font-family', "'Nunito', serif");
    }
}

// functions start here
function formatTimestamp(timestamp) {
    // Convert the timestamp to a JavaScript Date object
    var targetTime = new Date(timestamp);

    // Calculate the time difference in milliseconds
    var now = new Date();
    var diff = now - targetTime;

    // Convert milliseconds to seconds, minutes, hours, and days
    var secondsAgo = Math.floor(diff / 1000);
    var minutesAgo = Math.floor(secondsAgo / 60);
    var hoursAgo = Math.floor(minutesAgo / 60);
    var daysAgo = Math.floor(hoursAgo / 24);

    // Format the time difference
    var formattedTime;

    if (secondsAgo < 60) {
        formattedTime = secondsAgo + " secs ago";
    } else if (minutesAgo < 60) {
        formattedTime = minutesAgo + " mins ago";
    } else if (hoursAgo < 24) {
        formattedTime = hoursAgo + " hrs ago";
    } else {
        formattedTime = daysAgo + " days ago";
    }

    return formattedTime;
}

//pagination working by passing id of table
function paginationWorking(tid) {
    // Pagination initialization
    var itemsPerPage = 10;
    var currentPage = 1;
    var totalItems = $("#" + tid + " tbody tr").length;
    var totalPages = Math.ceil(totalItems / itemsPerPage);

    function updatePagination() {
        $(".paginationUL").empty();
        $('.paginationUL').append(`<li class="prevBtnLi">
                                    <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                                        <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    </li>`);
        for (var i = 1; i <= totalPages; i++) {
            var activeClass = (i === currentPage) ? `text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600` : "";
            $(".paginationUL").append(
                `<li class="pageNumLI">
                    <button class="px-3 pageNumLI py-1 page-num-btn rounded-md ${activeClass} focus:outline-none focus:shadow-outline-purple">
                    ${i}
                    </button>
                </li>`);
        }
        $('.paginationUL').append(`<li class="nextBtnLi">
                                    <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    </li>`);

    }

    // Pagination click event
    $(".paginationUL").on("click", ".pageNumLI button.page-num-btn", function (e) {
        e.preventDefault();
        currentPage = parseInt($(this).text());
        updatePagination();
        updateTableRows();
        updateResultCount();
    });

    $(".paginationUL").on("click", ".prevBtnLi button", function () {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
            updateTableRows();
            updateResultCount();
        }
    });

    $(".paginationUL").on("click", ".nextBtnLi button", function () {
        if (currentPage < totalPages) {
            currentPage++;
            updatePagination();
            updateTableRows();
            updateResultCount();
        }
    });


    function updateTableRows() {
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;
        $("#" + tid + " tbody tr").hide().slice(startIndex, endIndex).show();
    }

    function updateResultCount() {
        var startIndex = (currentPage - 1) * itemsPerPage + 1;
        var endIndex = Math.min(startIndex + itemsPerPage - 1, totalItems);
        var resultCountText = "Showing " + startIndex + "-" + endIndex + " of " + totalItems;
        $(".resultCountShowing").text(resultCountText);
    }

    // Initial setup
    updatePagination();
    updateTableRows();
    updateResultCount();
}
// pagination for cards 
function PaginationForCards(mainCardDivID, innerCardClass) {
    // Pagination initialization
    var itemsPerPage = 4;
    var currentPage = 1;
    var totalItems = $("#" + mainCardDivID + " ." + innerCardClass + "").length;
    var totalPages = Math.ceil(totalItems / itemsPerPage);

    function updatePagination() {
        $(".paginationUL").empty();
        $('.paginationUL').append(`<li class="prevBtnLi">
                                    <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                                        <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    </li>`);
        for (var i = 1; i <= totalPages; i++) {
            var activeClass = (i === currentPage) ? `text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600` : "";
            $(".paginationUL").append(
                `<li class="pageNumLI">
                    <button class="px-3 pageNumLI py-1 page-num-btn rounded-md ${activeClass} focus:outline-none focus:shadow-outline-purple">
                    ${i}
                    </button>
                </li>`);
        }
        $('.paginationUL').append(`<li class="nextBtnLi">
                                    <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    </li>`);

    }

    // Pagination click event
    $(".paginationUL").on("click", ".pageNumLI button.page-num-btn", function (e) {
        e.preventDefault();
        currentPage = parseInt($(this).text());
        updatePagination();
        updateTableRows();
        updateResultCount();
    });

    $(".paginationUL").on("click", ".prevBtnLi button", function () {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
            updateTableRows();
            updateResultCount();
        }
    });

    $(".paginationUL").on("click", ".nextBtnLi button", function () {
        if (currentPage < totalPages) {
            currentPage++;
            updatePagination();
            updateTableRows();
            updateResultCount();
        }
    });


    function updateTableRows() {
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;
        $("#" + mainCardDivID + " ." + innerCardClass + "").hide().slice(startIndex, endIndex).show();
    }

    function updateResultCount() {
        var startIndex = (currentPage - 1) * itemsPerPage + 1;
        var endIndex = Math.min(startIndex + itemsPerPage - 1, totalItems);
        var resultCountText = "Showing " + startIndex + "-" + endIndex + " of " + totalItems;
        $(".resultCountShowing").text(resultCountText);
    }

    // Initial setup
    updatePagination();
    updateTableRows();
    updateResultCount();
}
//modal close by id fn
function closeAddRoomModal(id) {
    var modalDiv = document.getElementById(id);
    modalDiv.__x.$data.isModalOpen = false;
}
// show the notificationData on modal 
function ShowNotifications(userID) {
    $.ajax({
        url: "php/api/notifications_GetData.php",
        type: "POST",
        datatype: "JSON",
        data: {
            usrID: userID,
        },
        success: function (data) {
            $("#newNotificationDot").addClass('hidden');
            $('#notificationsDiv').empty()
            var unreadCount = 0;
            $.each(data.notiDataArray, function (index, item) {
                if (item.readStatus == 0) {
                    unreadCount++;
                }
                var notificationMessage = `<hr class="mt-2 mb-2">
                                            <p class="text-sm text-gray-700 dark:text-gray-400 flex gap-2">
                                                <span>${item.title}</span>
                                                <span>
                                                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600" style="white-space: nowrap;">
                                                        ${formatTimestamp(item.datetime)}
                                                    </span>
                                                </span>
                                            </p>`;
                $('#notificationsDiv').append(notificationMessage)
            })
            if (unreadCount != 0) {
                $("#newNotificationDot").removeClass('hidden');
            }
        }
    });
}

// notification modal showing js also with mark as seen
function ShowNotificationModal(id) {
    var modalDiv = document.getElementById("notificationDiv");
    modalDiv.__x.$data.isModalOpen = true;
    $.ajax({
        url: 'php/api/notifications_MarkAsRead.php',
        type: 'POST',
        datatype: 'JSON',
        data: {
            uid: id
        },
        success: function (data) {
            if (data.success) {
                //marked as read all notifications
                ShowNotifications(id);
            }
        }
    })
}


// AdminSide
// 	1. ShowAdminDashbordCardsData()
// 	2. ShowRecentTransactionsDetails()
// 	3. ShowCustomerListWithPreviousReadingForDropdown()
//  4. Check admin has added locations or not


function ShowAdminDashbordCardsData() {
    $.ajax({
        url: "php/api/dashboard_GetAdminCardsData.php",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            $('#adminTodaysTxnCount').text(data.TodaysTxnCount);
            $('#adminTotalPendAmt').text(data.totalPendAmt == null ? 0 : data.totalPendAmt);
            $('#adminTotCustCount').text(data.TotCustCount);
            $('#adminTotRoomsCount').text(data.TotRoomsCount);
        }
    });
}

function ShowRecentTransactionsDetails() {
    $.ajax({
        url: "php/api/dashboard_GetRecentTransactions.php",
        type: "POST",
        datatype: "JSON",
        // data: {
        //     adminID: adminID,
        // },
        success: function (data) {
            // console.log(data);
            $('#DashRecentTxnTable tbody').empty();
            var srno = 1;
            if (data.length == 0) {
                var noDataFound = `<tr class="text-gray-700 dark:text-gray-400">
                                        <td colspan="7" class="px-4 py-3 text-sm font-semibold" style="text-align: center;" width="20">
                                            No Records Found!
                                        </td>
                                    </tr>`
                $('#DashRecentTxnTable tbody').append(noDataFound);
            }
            $.each(data, function (index, item) {
                var profilePhotoImg = item.Profile_Photo == null ? 'images/users/user-blank.jpg' : item.Profile_Photo;
                var profilePhotoCss = item.Profile_Photo == null ? 'filter: saturate(23) hue-rotate(4739deg) brightness(95%) contrast(94%);' : '';

                var Trow = `<tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="20">
                                    ${srno++}
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="100">
                                ${item.Floor_No.split(' ').map(word => word.charAt(0)).join('')}-${item.Room_No}
                                </td>
                                <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full" src="${profilePhotoImg}" style="${profilePhotoCss}" alt="" loading="lazy" />
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                    </div>
                                    <div>
                                        <p class="font-semibold">${item.Name}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            ${item.Designation}
                                        </p>
                                    </div>
                                </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-green-600" style="text-align: right;" width="200">
                                    ₹ <span class=" font-bold">+</span>${item.amt_paid}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                ${formatTimestamp(item.datetime)}
                                </td>
                                <td class="px-4 py-3 text-sm" width="200">
                                <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="window.location.href='customer_details.php?userid=${item.ID}'" data-translate="RTxnRowViewBtn">
                                    View
                                </button>
                                </td>
                            </tr>`;
                $('#DashRecentTxnTable tbody').append(Trow);
            })
            paginationWorking('DashRecentTxnTable')
        }
    });
}

function ShowCustListWithPrevReadingDD(DD_id) {
    $.ajax({
        url: "php/api/dashboard_CustListForDD.php",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            // console.log(data);
            $('#' + DD_id).empty();
            $.each(data, function (index, item) {
                $('#' + DD_id).append(item)
            })
        }
    });
}

function ResidencyDetailsAdded() {
    $.ajax({
        url: "php/api/dashboard_IsLocationExists.php",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            // Process data and update the user's password
            if (!data.success) {
                const driver = window.driver.js.driver;

                const driverObj = driver({
                    // showProgress: true,
                    allowClose: false,
                    overlayClickNext: false,
                    animate: true,
                });
                driverObj.highlight({
                    element: '#locationPopUpDiv',
                    popover: {
                        title: 'Add residency location details first!',
                        description: 'Please add details of your residency (e.g. name, address), then move to admin menus.',
                        side: "left",
                        align: 'end',
                    }
                });

                $('#add-loc-details-Modal').on('click', function () {
                    driverObj.destroy();
                })
            } else {
                $('#locationPopUpDiv').addClass('hidden')
            }
        }
    });
}

function SaveLocationDetails() {

    $.ajax({
        url: "php/api/admin_SaveLocation.php",
        type: "POST",
        datatype: "JSON",
        data: {
            res_name: $('#res_name').val(),
            address_input: $('#Address-input-box').val(),
            stateDropDown: $('#stateDropDown').val(),
            districtInput: $('#districtInput').val(),
            CityInput: $('#CityInput').val(),
            pincodeInput: $('#pincodeInput').val(),
        },
        success: function (data) {
            if (data.success) {
                Swal.fire(
                    'Added!',
                    'Location Details Added Successfully!',
                    'success'
                )
                closeAddRoomModal('addLocationDetailsModal')
                ResidencyDetailsAdded()
            } else {
                Swal.fire(
                    'Error!',
                    'Error while adding location details!',
                    'Error'
                )
            }
        }
    });
}

function UpdateProfileDetailsHighlight() {
    $.ajax({
        url: "php/api/dashboard_IsUpdatedProile.php",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            // Process data and update the user's password
            if (!data.success) {
                const driver = window.driver.js.driver;

                const driverObj = driver({
                    animate: true,
                });
                driverObj.highlight({
                    element: '#profileNotUpdatedDiv',
                    popover: {
                        title: 'Add profile details first!',
                        description: 'Please add profile details (e.g. name, address, documents), then proceed for the rooms.',
                        side: "left",
                        align: 'end',
                    }
                });


            } else {
                $('#profileNotUpdatedDiv').addClass('hidden')
            }
        }
    });
}

//geo location permission functions
$('#serachNearbyBtn').on('click', function () {
    $('#loadingCircleOnSearchNearby').css('display', '')
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
})
function showPosition(position) {
    // Use reverse geocoding to get the city based on the coordinates
    reverseGeocode(position.coords.latitude, position.coords.longitude, function (city) {
        // Fill the input field with the obtained city
        document.getElementById('location-search-input').value = city;
        $('#loadingCircleOnSearchNearby').css('display', 'none')

        // Trigger the input event manually
        var inputEvent = new Event('input');
        document.getElementById('location-search-input').dispatchEvent(inputEvent);

    });
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert("User denied the request for geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
}

function reverseGeocode(latitude, longitude, callback) {
    // Use OpenCage Geocoding API to get the city based on coordinates
    var api_key = '0a3e970f819442c8a3bacfaf516d5eaa';
    var api_url = 'https://api.opencagedata.com/geocode/v1/json';
    var query = latitude + ',' + longitude;

    var request_url = api_url +
        '?' +
        'key=' + api_key +
        '&q=' + encodeURIComponent(query) +
        '&pretty=1' +
        '&no_annotations=1';

    fetch(request_url)
        .then(response => response.json())
        .then(data => {
            if (data.results && data.results.length > 0) {
                const city = data.results[0].components.city;
                callback(city);
            } else {
                alert("City information not available.");
            }
        })
        .catch(error => {
            console.error('Error during reverse geocoding:', error);
        });
}

function ShowResidenciesCards() {
    $.ajax({
        url: "php/api/dashboard_GetResidenciesCardsData.php",
        type: "POST",
        dataType: "JSON",
        success: function (data) {
            const districtData = {};

            data.forEach(item => {
                const districtID = item.district;
                districtData[districtID] = districtData[districtID] || [];
                districtData[districtID].push(item);
            });

            $('#residencies_state_wise').empty();
            $.each(districtData, function (district, items) {
                const distString = `<div class="districtwise">
                    <h4 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300 district-name" data-translate="">
                        ${items[0].district_name}
                    </h4>
                    <div class="swiper-container grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4" style="overflow: hidden;">
                        <div class="swiper-wrapper" id="${items[0].district_name}"></div>
                    </div>
                </div>`;
                $('#residencies_state_wise').append(distString);

                items.forEach(innerItem => {
                    const rating_color = (innerItem.average_ratings || 0) > 3.5
                        ? 'green'
                        : (innerItem.average_ratings || 0) > 2
                            ? 'yellow'
                            : 'red';

                    const res_cardString = `<div class="swiper-slide">
                        <div class="flex flex-wrap -mx-4 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="w-full px-4 mb-2">
                                <p class="text-xl font-semibold text-gray-700 dark:text-gray-300 residency-name">
                                    ${innerItem.residency_name}
                                </p>
                            </div>
                            <!-- Star Ratings -->
                            <div class="w-1/2 md:w-1/2 px-4 mb-2">
                              <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="StarRatings">
                                Star Ratings
                              </p>
                            </div>
                            <div class="w-1/2 md:w-1/2 px-4 mb-2">
                              <div class="flex items-center">
                                <span class="text-sm font-semibold text-${rating_color}-700">${innerItem.average_ratings == null ? 0 : innerItem.average_ratings}</span>
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">(Out of 5)</span>
                              </div>
                            </div>
    
                            <!-- Location/Address -->
                            <div class="w-full px-4 mb-2">
                              <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="Location">
                                Location/Address
                              </p>
                            </div>
                            <div class="w-full px-4 mb-2">
                              <p class="text-sm font-semibold text-gray-700 dark:text-gray-200 address">
                                ${innerItem.address}
                              </p>
                            </div>
    
                            <!-- Additional Details -->
                            <div class="w-full px-4 mb-2">
                              <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="OtherDetails">
                                Other Details
                              </p>
                            </div>
                            <div class="w-full px-4 mb-2">
                              <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                - Free Wi-Fi<br>
                                - Swimming Pool<br>
                                - Parking Available
                              </p>
                            </div>
                            <button onclick="window.location.href='./rooms_on_location.php?admid=${btoa(innerItem.admin_id)}'" class="px-4 py-2 ml-2 w-full text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="window.location.href='./customer_add_form.php'" data-translate="ViewBtn">
                                View
                            </button>
                        </div>
                    </div>`;
                    $(`#${items[0].district_name}`).append(res_cardString);
                });
            });

            // Initialize Swiper
            new Swiper('.swiper-container', {
                slidesPerView: 1,
                spaceBetween: 10,
                breakpoints: {
                    640: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 4 },
                },
                autoplay: { delay: 5000 },
            });

            //location wise search 
            $("#location-search-input").on("input", function () {
                var searchText = $(this).val().toLowerCase();

                $("#residencies_state_wise .districtwise").each(function () {
                    var districtContainer = $(this);
                    var districtName = districtContainer.find(".district-name").text().toLowerCase();

                    // Check individual cards for residency name or address
                    var showCard = districtContainer.find(".swiper-slide").toArray().some(function (card) {
                        var residencyName = $(card).find(".residency-name").text().toLowerCase();
                        var address = $(card).find(".address").text().toLowerCase();

                        return residencyName.includes(searchText) || address.includes(searchText);
                    });

                    // Show or hide the entire districtwise container based on the search result for residency name, address, or district
                    var showDistrict = districtName.includes(searchText) || showCard || searchText.length === 0;
                    districtContainer.toggle(showDistrict);

                    if (showDistrict) {
                        // If the district is found or there's a matching card, show all individual cards
                        districtContainer.find(".swiper-slide").show();
                        $(this).find(".swiper-slide").each(function () {
                            var residencyName = $(this).find(".residency-name").text().toLowerCase();
                            var address = $(this).find(".address").text().toLowerCase();

                            // Show or hide individual card based on the search result for residency name, district, or address
                            var showCard = residencyName.includes(searchText) || districtName.includes(searchText) || address.includes(searchText);
                            $(this).toggle(showCard);
                        });
                    } else {
                        districtContainer.find(".swiper-slide").hide();
                    }
                });
            });


        }
    });
}


// UserSide
// 	1. ShowUserDashbordData()
// 	2. ShowUserTransactionData(userID)
function ShowUserDashbordData(userID, roomno) {
    $.ajax({
        url: "php/api/dashboard_GetUsersCardsData.php",
        type: "POST",
        datatype: "JSON",
        data: {
            userID: userID,
            roomno: roomno,
        },
        success: function (data) {
            $('#AmtDepositByUserCard').text(data.DepositAmt == null ? 0 : data.DepositAmt);
            $('#AmtDepositedDateCard').text(moment(data.AmtDepoDate).format('DD-MM-YYYY'));
            $('#UsersDueAmtCard').text(data.PendingAmt == null ? 0 : data.PendingAmt);
            $('#MeterUnitRateCard').text(data.MeterReadingRate);
        }
    });
}

function ShowUserTxnHistoryData(userID) {
    $.ajax({
        url: "php/api/dashboard_GetUserTxnHistoryData.php",
        type: "POST",
        datatype: "JSON",
        data: {
            userID: userID,
        },
        success: function (data) {
            // console.log(data);
            $('#Customers-txn-table tbody').empty();
            $('#Customers-txn-table tfoot').empty();

            var srno = 1;
            var totalPendingAmt = 0;
            if (data.length == 0) {
                var noDataFound = `<tr class="text-gray-700 dark:text-gray-400">
                                        <td colspan="9" class="px-4 py-3 text-sm font-semibold" style="text-align: center;" width="20">
                                            No Records Found!
                                        </td>
                                    </tr>`
                $('#Customers-txn-table tbody').append(noDataFound);

            }
            $.each(data, function (index, item) {
                var meterreading = item.ongoing_meter_reading - item.previous_meter_reading;
                var elecBill = meterreading * item.meter_rate;
                var moneyTxtColor = '';
                var PendingAmtColor = '';
                if (parseInt(item.pendingAmt) < 0) {
                    moneyTxtColor = 'text-green-700';
                } else {
                    moneyTxtColor = "text-red-700";
                }
                if (item.previous_meter_reading == null) {
                    if (parseInt(totalPendingAmt) - item.amt_paid < 0) {
                        moneyTxtColor = 'text-green-700';
                    } else {
                        moneyTxtColor = "text-red-700";
                    }

                    var Trow = `<tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="20">
                                        ${srno++}
                                    </td>
                                    <td class="px-4 py-3 text-sm" width="100">
                                        ${moment(item.datetime).format('DD-MM-YYYY')}
                                    </td>
                                    <td class="px-4 py-3 text-sm" colspan="5" style="text-align: right;" width:"10">
                                    
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;">
                                    ₹ ${item.amt_paid}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;">
                                    ${parseInt(totalPendingAmt)} - ${item.amt_paid} = <span class="font-semibold ${moneyTxtColor}">${parseInt(totalPendingAmt) - item.amt_paid}</span>
                                    </td>
                                </tr>`;
                    totalPendingAmt = parseInt(totalPendingAmt) - item.amt_paid;

                } else {

                    var Trow = `<tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="20">
                                        ${srno++}
                                    </td>
                                    <td class="px-4 py-3 text-sm" width="100">
                                        ${moment(item.datetime).format('DD-MM-YYYY')}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;" width:"10">
                                        ${item.previous_meter_reading == null ? '0' : item.previous_meter_reading}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;" width:"10">
                                        ${item.ongoing_meter_reading == null ? '0' : item.ongoing_meter_reading}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;" width:"10">
                                        ${meterreading} x ${item.meter_rate == null ? '0' : item.meter_rate} = <span class="font-semibold">${meterreading * item.meter_rate}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;">
                                        ${item.rent}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;">
                                        ${item.rent} + ${meterreading * item.meter_rate} = <span class="font-semibold">${parseInt(item.rent) + elecBill}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;">
                                    ₹ ${item.amt_paid}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;">
                                    ${parseInt(item.rent) + elecBill} - ${item.amt_paid} = <span class="font-semibold ${moneyTxtColor}">${parseInt(item.rent) + elecBill - item.amt_paid}</span>
                                    </td>
                                </tr>`;
                    totalPendingAmt += parseInt(item.rent) + elecBill - item.amt_paid;
                }
                $('#Customers-txn-table tbody').append(Trow);
            })
            if (parseInt(totalPendingAmt) < 0) {
                PendingAmtColor = 'text-green-700';
            } else {
                PendingAmtColor = "text-red-700";
            }
            var tableFooter = `<tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm" colspan="7"></td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;" colspan="2"><strong>TOTAL AMOUNT PENDING: <span class="${PendingAmtColor}">₹ ${totalPendingAmt}</span></strong></td>
                                </tr>`;
            $('#Customers-txn-table tfoot').append(tableFooter);

            paginationWorking('Customers-txn-table')
        }
    });
}

// rooms-cards.php
// 	1. showCardsData()
// 	2. GetRoomTypeForDropdown()
// 	3. AddNewRoomToDB()
function showRoomsCardsData(para, isadmin) {
    $.ajax({
        url: "php/api/rooms_GetRoomCardsData.php",
        type: "POST",
        datatype: "JSON",
        data: {
            admid: para,
        },
        success: function (data) {
            // console.log(data);
            $('#roomCardsDiv').empty();

            $.each(data, function (ind, item) {
                if (isadmin == 1) {
                    var appropriateBtns = `<button onclick="window.location.href='./customer_list.php?roomid=${item.ID}'"
                                                class="py-2 w-full text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                                data-translate="ViewBtn">
                                                View
                                            </button>`;
                } else {
                    var urlParams = new URLSearchParams(window.location.search);

                    appropriateBtns = `<button onclick="BookReqForRoom(${item.ID}, ${atob(urlParams.get('admid'))})"
                                            class="py-2 w-full text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                            data-translate="ViewBtn">
                                            Book
                                        </button>
                                        <button
                                            class="flex items-center justify-between ml-2 px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                            aria-label="Like">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                            </svg>
                                        </button>`;
                }

                var imgArr = item.room_images == null ? [] : item.room_images.split(';');

                //iterate
                var cardString = ` 
                                    <!-- Card -->
                                    <div class="relative roomCard bg-white rounded-lg shadow-md dark:bg-gray-800 overflow-hidden">
                                    <!-- Swiper -->
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">`
                // imgArr.forEach(element => {
                cardString += `<!-- Image 1 -->
                                        <div class="swiper-slide">
                                            <a href="assets/img/create-account-office-dark.jpeg" data-baguettebox="gallery"
                                            data-caption="Caption for Image 1">
                                            <img src="assets/img/create-account-office-dark.jpeg" alt="Image 1"
                                                class="w-full h-32 object-cover">
                                            </a>
                                        </div>`;
                // });

                cardString += `<!-- Image 2 -->
                                        <div class="swiper-slide">
                                            <a href="assets/img/dashboard.png" data-baguettebox="gallery" data-caption="Caption for Image 2">
                                            <img src="assets/img/dashboard.png" alt="Image 2" class="w-full h-32 object-cover">
                                            </a>
                                        </div>
                                        </div>
                                        <div class="swiper-wrapper">
                                        <!-- Add Pagination -->
                                        <div class="swiper-pagination"></div>
                                        </div>
                                    </div>
                        
                                    <div class="flex  flex-wrap -mx-4 p-4">
                                        <div class="w-1/2 md:w-1/2 px-4 mb-2">
                                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="FloorNum">
                                            Floor
                                        </p>
                                        </div>
                                        <div class="w-1/2 md:w-1/2 px-4 mb-2">
                                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            ${item.floorInwords}
                                        </p>
                                        </div>
                                        <div class="w-full"></div>
                                        <div class="w-1/2 md:w-1/2 px-4 mb-2">
                                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="RoomNum">
                                            Room No
                                        </p>
                                        </div>
                                        <div class="w-1/2 md:w-1/2 px-4 mb-2">
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            ${item.room_no}
                                        </p>
                                        </div>
                                        <div class="w-full"></div>
                                        <div class="w-1/2 md:w-1/2 px-4 mb-2">
                                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="RoomType">
                                            Room type
                                        </p>
                                        </div>
                                        <div class="w-1/2 md:w-1/2 px-4 mb-2">
                                        <span
                                            class="px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            ${item.room_type}
                                        </span>
                                        </div>
                                        <hr>
                                        <div class="w-full md:w-1/2 px-4 mb-2">
                                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="Tenant">
                                            Tenants
                                        </p>
                                        <p class="text-lg font-semibold text-red-700 text-gray-700 dark:text-gray-200">
                                            ${item.roomTenants}
                                        </p>
                                        </div>
                                        <div class="w-full md:w-1/2 px-4 mb-2">
                                        <p class="mb-2 text-sm font-medium  text-gray-600 dark:text-gray-400" data-translate="Available">
                                            Available
                                        </p>
                                        <p class="text-lg font-semibold text-green-700 text-gray-700 dark:text-gray-200">
                                            ${item.available}
                                        </p>
                                        </div>
                                        <div class="w-full relative px-4 py-3 mb-2 dropdown-container" x-data="{ isPagesMenuOpen: false }"
                                        x-instance="rentDetailsDropdown">
                                        <button
                                            class="inline-flex items-center dropdown-toggle-btn justify-between w-full text-sm font-semibold transition-colors duration-150 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200"
                                             aria-haspopup="true">
                                            <span class="inline-flex items-center">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z">
                                                </path>
                                            </svg>
                                            <span class="ml-4">Rent details</span>
                                            </span>
                                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                        <template x-if="isPagesMenuOpen" class="dropdown-menu">
                                            <ul x-transition:enter="transition-all ease-in-out duration-300"
                                            x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                                            x-transition:leave="transition-all ease-in-out duration-300"
                                            x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                                            class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                                            aria-label="submenu">
                        
                                            <div class="flex  flex-wrap px-2 py-1">
                                                <div class="w-full flex flex-wrap justify-between">
                                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="RoomNum">
                                                    Deposit Amount
                                                </p>
                                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                                    ${item.deposit_amt}
                                                </p>
                                                </div>
                                                <div class="w-full"></div>
                        
                                                <div class="w-full flex flex-wrap justify-between">
                                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="RoomNum">
                                                    Rent Amount
                                                </p>
                                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                                    ${item.room_rent}
                                                </p>
                                                </div>
                                                <div class="w-full text-center mb-2 text-gray-700 dark:text-gray-200">
                                                <hr class="">
                                                </div>
                                                <div class="w-full flex flex-wrap justify-between">
                                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="RoomNum">
                                                    Total Amount
                                                </p>
                                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                                    ${parseInt(item.deposit_amt) + parseInt(item.room_rent)}
                                                </p>
                                                </div>
                                            </div>
                                            </ul>
                                        </template>
                                        </div>
                                        <div class="w-full flex justify-between">
                                            ${appropriateBtns}
                                        </div>
                                    </div>
                                    </div>`;
                $('#roomCardsDiv').append(cardString)
            })
            PaginationForCards('roomCardsDiv', 'roomCard')

            $("#search-input").on("keyup", function () {
                var searchText = $(this).val().toLowerCase();
                $("#roomCardsDiv .roomCard").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });

            // img swiper 
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: { delay: 5000 },
            });
            baguetteBox.run('.swiper-container', {
                animation: 'slideIn',
                noScrollbars: true,
                buttons: true,
            });
        }
    });
}
function GetFloorsForDropdown() {
    $.ajax({
        url: "php/api/rooms_FloorsDropdown.php",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            $.each(data, function (index, item) {
                $('#floorDD').append(item);
            })
        }
    });
}
function GetRoomTypeForDropdown() {
    $.ajax({
        url: "php/api/rooms_TypesDropdown.php",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            $.each(data, function (index, item) {
                $('#roomTypeDD').append(item);
            })
        }
    });
}
function AddNewRoomToDB(formData) {
    var formDataObject = {};
    formData.forEach((value, key) => {
        formDataObject[key] = value;
    });
    var RoomsCount = $('#roomsNumbOnMultiple');
    var floorValue = $('#floorDD');
    var tenantCapacityVal = $('#tenantCapacityInputBox');
    var roomTypeVal = $('#roomTypeDD');
    var DepositAmtVal = $('#depositAmtInputBox');
    var rentVal = $('#RentAmtInputBox');
    var noteVal = $('#roomNoteInputBox');
    $.ajax({
        url: "php/api/rooms_AddNewRoom.php",
        type: "POST",
        datatype: "JSON",
        data: formDataObject,
        success: function (data) {
            if (data.success) {
                Swal.fire(
                    'Added!',
                    'Room/Rooms Added Successfully!',
                    'success'
                )
                RoomsCount.val('');
                floorValue.val('');
                tenantCapacityVal.val('');
                roomTypeVal.val('');
                DepositAmtVal.val('');
                rentVal.val('');
                noteVal.val('');
                closeAddRoomModal('addNewRoomModal')
                showRoomsCardsData()
            } else {
                Swal.fire(
                    'Error!',
                    'Something went wrong while adding the room!',
                    'error'
                )
            }
        }
    });
}
function BookReqForRoom(rmid, admid) {
    Swal.fire({
        title: "Are you sure?",
        text: "This action will send booking requests to the owner. Please note that you'll need to wait for confirmation.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        customClass: {
            confirmButton: 'bg-purple-600 text-white  px-4 py-2 rounded-md',
            cancelButton: "bg-red-600 text-white ml-2 px-4 py-2 rounded-md",
        },
        buttonsStyling: !1,
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
            $.ajax({
                url: "php/api/requests_addRequestForRoom.php",
                type: "POST",
                datatype: "JSON",
                data: {
                    rmid: rmid,
                    admid: admid
                },
                success: function (data) {
                    // console.log(data);
                    if (data.success) {
                        Swal.fire(
                            'Requested',
                            `Your room request has been sent Successfully!`,
                            'success'
                        )
                    } else {
                        if (data.message) {
                            Swal.fire(
                                'Already Requested!',
                                data.message,
                                'warning'
                            )
                        } else {
                            Swal.fire(
                                'error',
                                `Error while sending request!`,
                                'error'
                            )
                        }
                    }
                }
            });
        }
    });
}
// customer_list.php
// 	1. ShowCustomerList()
//  2. ShowCustomerAllTxnData()
// 	3. GetTransactionTableData()
// 	4. ShowCustomersListInDropDown() //previous reading.
function ShowCustomersList(roomid) {
    $.ajax({
        url: "php/api/customers_GetCustList.php",
        type: "POST",
        datatype: "JSON",
        data: {
            roomID: roomid,
        },
        success: function (data) {
            // console.log(data);
            $('#Customers-table tbody').empty();
            var srno = 1;
            $.each(data.CardData, function (index, items) {
                $('#floorVal').html(items.floorInwords)
                $('#roomNumVal').html(items.room_no)
                $('#depositAmtVal').html(items.deposit_amt)
                $('#rentVal').html(items.room_rent)
            })
            $.each(data.userData, function (ind, item) {

                if (!roomid) {
                    var roomNoTr = `<td class="px-4 py-3 text-sm font-semibold" style="text-align: center;" width="100">
                    ${item.floorInwords.split(' ').map(word => word.charAt(0)).join('')}-${item.Room_No}
                                    </td>`;
                    var pendingAmtTr = `<td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="100">
                                        ${item.PendingAmt}
                                    </td>`
                } else {
                    var roomNoTr, pendingAmtTr = '';
                }
                var profilePhotoImg = item.Profile_Photo == null ? 'images/users/user-blank.jpg' : item.Profile_Photo;
                var profilePhotoCss = item.Profile_Photo == null ? 'filter: saturate(23) hue-rotate(4739deg) brightness(95%) contrast(94%);' : '';

                var tablerow = `  <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm  font-semibold" style="text-align: right;" width="20">
                                            ${srno++}
                                        </td>
                                        ${roomNoTr}
                                        <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full" src="${profilePhotoImg}" style="${profilePhotoCss}" alt="" loading="lazy" />
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                            </div>
                                            <div>
                                            <p class="font-semibold">${item.Name}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                ${item.Designation}
                                            </p>
                                            </div>
                                        </div>
                                        </td>
                                        ${pendingAmtTr.includes(null) == true ? '<td></td>' : pendingAmtTr}
                                        <td class="px-4 py-3 text-sm">
                                            ${moment(item.Date_Time).format('DD-MM-YYYY')}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="window.location.href='customer_details.php?usrid=${item.userID}'">
                                            View
                                        </button>
                                        </td>
                                    </tr>`;
                $('#Customers-table tbody').append(tablerow)
            })
            if (data.userData.length <= 0) {
                var noDataFoundRow = `<tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm font-semibold" colspan="5" style="text-align: center;" width="100">
                                            No customers yet!
                                        </td>
                                      </tr>`;
                $('#Customers-table tbody').append(noDataFoundRow);
                $('#add-new-txn-btn').on('click', function () {
                    //show swal
                    Swal.fire(
                        'Error!',
                        'No customers in the room yet!',
                        'error'
                    )
                })
            } else {
                $('#add-new-txn-btn').on('click', function () {
                    var modalDiv = document.getElementById("addNewTxnModal");
                    modalDiv.__x.$data.isModalOpen = true;
                })
            }
            $("#customer-search-input").on("keyup", function () {
                var searchText = $(this).val().toLowerCase();
                $("#Customers-table tbody tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });
            if (!roomid) {
                paginationWorking('Customers-table')
            }

            if (data.CardData[0].available == 0) {
                $('#addCustBtn').attr('href', '#')
                $('#addCustBtn').on('click', function () {
                    Swal.fire(
                        'Error!',
                        'Tenant capacity already occupied in the room!',
                        'error'
                    )
                })
            }

            ShowCustomerAllTxnData(data.CardData[0].room_no, data.CardData[0].floor)
            ShowCustomersListInDropDown(data.CardData[0].room_no, data.CardData[0].floor)
            $('#ongoingReadingInput').on('input', function () {
                var ongReadVal = $("#ongoingReadingInput").val();
                var prevReadVal = $('#prevReadingInput').val();
                if (parseInt(ongReadVal) >= parseInt(prevReadVal)) {

                    var meterReadingVal = parseInt(ongReadVal) - parseInt(prevReadVal)
                    var CalcString = `${ongReadVal} - ${prevReadVal}`;
                    $('#meterCalcString').html(CalcString)
                    $('#MeterCalcVal').val(parseInt(meterReadingVal))

                    //total calc
                    var totalElexBill = `${meterReadingVal} x ${data.CardData[0].meterRate}`;
                    $('#TotalCalcSpan').html(totalElexBill)
                    $('#ElectricityCalcVal').val(meterReadingVal * data.CardData[0].meterRate)
                    var totalRentCal = `${meterReadingVal * data.CardData[0].meterRate} + ${data.CardData[0].room_rent} (ROOM RENT)`
                    $('#TotalPaySpan').html(totalRentCal)
                    $('#TotalPayCalcVal').val(parseInt(meterReadingVal * data.CardData[0].meterRate) + parseInt(data.CardData[0].room_rent))
                } else {
                    $('#meterCalcString').html('')
                    $('#MeterCalcVal').val('0')
                    $('#TotalCalcSpan').html('')
                    $('#ElectricityCalcVal').val('0')
                    $('#TotalPaySpan').html('')
                    $('#TotalPayCalcVal').val('0')

                }
            })
        }
    });
}

function ShowCustomerAllTxnData(roomNo, floorNo) {
    $.ajax({
        url: "php/api/dashboard_GetUserTxnHistoryData.php",
        type: "POST",
        datatype: "JSON",
        data: {
            roomNo: roomNo,
            floorNo: floorNo
        },
        success: function (data) {
            // console.log(data);
            $('#CustRoom-txn-table tbody').empty();
            $('#CustRoom-txn-table tfoot').empty();

            var srno = 1;
            var totalPendingAmt = 0;
            if (data.length == 0) {
                var noDataFound = `<tr class="text-gray-700 dark:text-gray-400">
                                        <td colspan="8" class="px-4 py-3 text-sm font-semibold" style="text-align: center;" width="20">
                                            No Transactions Yet!
                                        </td>
                                    </tr>`
                $('#CustRoom-txn-table tbody').append(noDataFound);

            }
            $.each(data, function (index, item) {
                var meterreading = item.ongoing_meter_reading - item.previous_meter_reading;
                var elecBill = meterreading * item.meter_rate;
                var moneyTxtColor = '';
                if (parseInt(item.pendingAmt) < 0) {
                    moneyTxtColor = 'text-green-700';
                } else {
                    moneyTxtColor = "text-red-700";
                }
                if (item.previous_meter_reading == null) {
                    if (parseInt(totalPendingAmt) - item.amt_paid < 0) {
                        moneyTxtColor = 'text-green-700';
                    } else {
                        moneyTxtColor = "text-red-700";
                    }

                    var Trow = `<tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="20">
                                        ${srno++}
                                    </td>
                                    <td class="px-4 py-3 text-sm" width="100">
                                        ${moment(item.datetime).format('DD-MM-YYYY')}
                                    </td>
                                    <td class="px-4 py-3 text-sm" colspan="5" style="text-align: right;" width:"10">
                                    
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;">
                                    ₹ ${item.amt_paid}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;">
                                    ${parseInt(totalPendingAmt)} - ${item.amt_paid} = <span class="font-semibold ${moneyTxtColor}">${parseInt(totalPendingAmt) - item.amt_paid}</span>
                                    </td>
                                </tr>`;
                    totalPendingAmt = parseInt(totalPendingAmt) - item.amt_paid;

                } else {

                    var Trow = `<tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="20">
                                        ${srno++}
                                    </td>
                                    <td class="px-4 py-3 text-sm" width="100">
                                        ${moment(item.datetime).format('DD-MM-YYYY')}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;" width:"10">
                                        ${item.previous_meter_reading == null ? '0' : item.previous_meter_reading}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;" width:"10">
                                        ${item.ongoing_meter_reading == null ? '0' : item.ongoing_meter_reading}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;" width:"10">
                                        ${meterreading} x ${item.meter_rate == null ? '0' : item.meter_rate} = <span class="font-semibold">${meterreading * item.meter_rate}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;">
                                        ${item.rent}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;">
                                        ${item.rent} + ${meterreading * item.meter_rate} = <span class="font-semibold">${parseInt(item.rent) + elecBill}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;">
                                    ₹ ${item.amt_paid}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;">
                                    ${parseInt(item.rent) + elecBill} - ${item.amt_paid} = <span class="font-semibold ${moneyTxtColor}">${parseInt(item.rent) + elecBill - item.amt_paid}</span>
                                    </td>
                                </tr>`;
                    totalPendingAmt += parseInt(item.rent) + elecBill - item.amt_paid;
                }
                $('#CustRoom-txn-table tbody').append(Trow);
            })
            var tableFooter = `<tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm" colspan="7"></td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;" colspan="2"><strong>TOTAL AMOUNT PENDING: <span class="text-red-700">₹ ${totalPendingAmt}</span></strong></td>
                                </tr>`;
            $('#CustRoom-txn-table tfoot').append(tableFooter);

            paginationWorking('CustRoom-txn-table')
        }
    });
}
function ShowCustomersListInDropDown(roomno, floorno) {
    // ModalCustomerList.
    // var filterData;
    $.ajax({
        url: "php/api/customers_CustListForDD.php",
        type: "POST",
        datatype: "JSON",
        data: {
            roomno: roomno,
            floorno: floorno
        },
        success: function (data) {
            // console.log(data);
            $('#ModalCustomerList').empty();
            $.each(data.options_data, function (index, item) {
                $('#ModalCustomerList').append(item)
            })
            $('#ModalCustomerList').on('change', function () {
                $.each(data.non_option_data, function (ind, it) {
                    if (it.ID == $('#ModalCustomerList').val()) {
                        $('#prevReadingInput').val(it.prevMeterReading)
                        if (it.prevMeterReading == null) {
                            $('#prevReadingInput').prop('disabled', false)
                        }
                    }
                })
            })
        }
    });
}

// customer_details.php
// 	1. ShowTenantProfileData()
// 	2. SendNotification()
function ShowTenantProfileData(ID) {
    $.ajax({
        url: "php/api/tenants_ProfileData.php",
        type: "POST",
        datatype: "JSON",
        data: {
            rowid: ID,
        },
        success: function (data) {
            console.log(data);
            $.each(data, function (index, item) {
                $('#profileImgBox').attr('src', item.Profile_Photo == null ? 'images/users/user-blank.jpg' : item.Profile_Photo)
                    .css('filter', item.Profile_Photo == null ? 'saturate(23) hue-rotate(4739deg) brightness(95%) contrast(94%)' : '')

                $('#userName').html(item.Name)
                $('#userDesignation').html(item.Designation)
                $('#userAddress').html(item.Address)
                $('#mobileNumber').html(item.Mobile_No)
                $('#userAddedDate').html(moment(item.Date_Time).format('DD-MM-YYYY'))

                $('#userNameInput').val(item.Name)
                $('#userEmailInput').val(item.Email)
                $('#userDesignationInput').val(item.Designation)
                $('#userMobileInput').val(item.Mobile_No)
                $('#userAddressInput').val(item.Address)
            })
        }
    });
}

// setting.php
// 	1.GetMasterDataAll()
// 	2.Addroomtypedata()
// 	3.UpdateRoomDepositAmt()
// 	4.UpdateMeterData()

function GetMasterDataAll() {
    $.ajax({
        url: "php/api/GetMasterDataAll.php",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            // Process data and display room type data
            $('#room_type_badges').empty();
            $.each(data.room_type, function (index, item) {
                var badgeStr = `<span class="px-2 py-1 ml-2 mt-2 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    ${item.room_type} <span class="ml-2 text-red-700" aria-hidden="true" style="cursor: pointer;">x</span>
                                </span>`;
                $('#room_type_badges').append(badgeStr);
            })

            $('#fixedDepositAmt').empty();
            // $.each(data.room_depo, function (index, item) {
            //     var badgeStr = `<span class="px-2 py-1  mt-2 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
            //                         ${item.deposit_amt}
            //                     </span>`;
            //     $('#fixedDepositAmt').append(badgeStr);
            // })

            $('#numoffloors').empty();
            $.each(data.rooms_floors, function (index, item) {
                var badgeStr = `<span class="px-2 py-1  mt-2 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100">
                                    ${item.floors}
                                </span>`;
                $('#numoffloors').append(badgeStr);
            })
            $('#rooms_per_floor').empty();
            $.each(data.rooms_per_floor, function (index, item) {
                var badgeStr = `<span class="px-2 py-1  mt-2 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100">
                                    ${item.room_per_floor}
                                </span>`;
                $('#rooms_per_floor').append(badgeStr);
            })
            $('#meter_rate_badge').empty();
            $.each(data.meter_rate, function (index, item) {
                var badgeStr = `<span class="px-2 py-1 mt-2 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    ₹ ${item.rate}
                                </span>`;
                $('#meter_rate_badge').append(badgeStr);
            })
        }
    });
}

function Addroomtypedata(roomTypeData) {
    $.ajax({
        url: "api/addRoomTypeData",
        type: "POST",
        datatype: "JSON",
        data: roomTypeData,
        success: function (data) {
            // Process data and add room type data
        }
    });
}

function UpdateRoomDepositAmt(depositData) {
    $.ajax({
        url: "api/updateRoomDepositAmt",
        type: "POST",
        datatype: "JSON",
        data: depositData,
        success: function (data) {
            // Process data and update room deposit amount
        }
    });
}

function UpdateMeterData(meterData) {
    $.ajax({
        url: "api/updateMeterData",
        type: "POST",
        datatype: "JSON",
        data: meterData,
        success: function (data) {
            // Process data and update meter data
        }
    });
}

// profile-page.php
// 	1.GetUserData()
// 	2.GetPasswordDataToCheckOld()
// 	3.UpdatePasswordData(userID)


function GetPasswordDataToCheckOld(userID, oldPassword) {
    $.ajax({
        url: "api/checkOldPassword",
        type: "POST",
        datatype: "JSON",
        data: {
            userID: userID,
            oldPassword: oldPassword,
        },
        success: function (data) {
            // Process data and check the old password
        }
    });
}

function UpdatePasswordData(userID, newPassword) {
    $.ajax({
        url: "api/updatePassword",
        type: "POST",
        datatype: "JSON",
        data: {
            userID: userID,
            newPassword: newPassword,
        },
        success: function (data) {
            // Process data and update the user's password
        }
    });
}

// request.php
// 1.ShowAllRequests()

function ShowAllRequests() {
    $.ajax({
        url: "php/api/requests_GetData.php",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            $('#requestCardsTr').empty();

            if (data.length <= 0) {
                var cardWithNoData = `<div class="flex flex-wrap -mx-4  bg-white rounded-lg shadow-md dark:bg-gray-800 overflow-x-auto cardRow">
                                        <div class="flex flex-wrap -mx-4 w-full">
                                        <table class="w-full parent whitespace-no-wrap">
                                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                            <tr class="text-gray-700 dark:text-gray-400" >
                                                <td class="px-4 py-3 text-sm font-semibold" colspan="7" style="text-align: center;">
                                                    No Requests Yet!
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>`;
                $('#requestCardsTr').append(cardWithNoData);
            }
            var srno = 1;
            $.each(data, function (ind, item) {
                var reqCard = `<div class="flex flex-wrap -mx-4  bg-white rounded-lg shadow-md dark:bg-gray-800 overflow-x-auto cardRow">
                                    <div class="flex flex-wrap -mx-4 w-full">
                                    <table class="w-full parent whitespace-no-wrap">
                                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                            <tr class="text-gray-700 dark:text-gray-400">
                                                <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;">
                                                    ${srno++}
                                                </td>
                                                <td class="px-4 py-3 text-sm font-semibold mobileNumber" style="text-align: center;">
                                                    ${item.Mobile_No}
                                                </td>
                                                <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <div class="relative hidden w-8 h-8  rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy" />
                                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                    </div>
                                                </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm font-semibold" style="text-align: center;">
                                                    ${item.floorInwords}
                                                </td>
                                                <td class="px-4 py-3 text-sm font-semibold" style="text-align: center;">
                                                    ${item.room_no}
                                                </td>
                                                <td class="px-4 py-3 text-sm reqDate" style="text-align: right;">
                                                    ${moment(item.datetime).format('DD-MM-YYYY hh:mm A')}
                                                </td>
                                                <td class="px-4 py-3 text-sm" style="text-align: right;" width="285">
                                                <button  class="px-3 callButton py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" data-translate="RTxnRowViewBtn">
                                                    Call
                                                </button>
                                                <button onclick="approveDenyRequest(${item.userID}, 'approve')" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple" data-translate="RTxnRowViewBtn">
                                                    Approve
                                                </button>
                                                <button onclick="approveDenyRequest(${item.userID}, 'deny')" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-md active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple" data-translate="RTxnRowViewBtn">
                                                    Deny
                                                </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>`;

                $('#requestCardsTr').append(reqCard);
            })

            $(".callButton").on("click", function () {
                var mobileNumber = $(this).closest('tr').find('.mobileNumber').text().trim();
                if (/Mobi|Android/i.test(navigator.userAgent)) {
                    window.location.href = `tel:+91 ${parseInt(mobileNumber)}`;
                } else {
                    alert("Calling is supported on mobile devices only.");
                }
            });
        }
    });
}

function approveDenyRequest(uid, task) {
    if (task == 'approve') {
        var swalText = 'Approve this request?';
        var subSwalText = 'Approved';
    } else {
        var swalText = 'Deny this request?';
        var subSwalText = 'Denied';
    }
    Swal.fire({
        title: "Are you sure?",
        text: swalText,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        customClass: {
            confirmButton: 'bg-purple-600 text-white  px-4 py-2 rounded-md',
            cancelButton: "bg-red-600 text-white ml-2 px-4 py-2 rounded-md",
        },
        buttonsStyling: !1,
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
            $.ajax({
                url: "php/api/requests_Approve-or-deny.php",
                type: "POST",
                datatype: "JSON",
                data: {
                    userID: uid,
                    task: task
                },
                success: function (data) {
                    // console.log(data);
                    if (data.success) {
                        Swal.fire(
                            subSwalText,
                            `Tenants request ${subSwalText} Successfully!`,
                            'success'
                        )
                        ShowAllRequests();
                    }
                }
            });
        }
    });

}

// support.php
// 1.Show all Issues
function ShowAllIssues() {
    $.ajax({
        url: "php/api/support_GetIssueData.php",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            $('#IssuesTable tbody').empty();

            if (data.length <= 0) {
                var NoDataRow = `<tr class="text-gray-700 dark:text-gray-400" >
                                        <td class="px-4 py-3 text-sm font-semibold" colspan="9" style="text-align: center;">
                                            No Issues Yet!
                                        </td>
                                      </tr>`;
                $('#IssuesTable tbody').append(NoDataRow);
            }
            var srno = 1;
            $.each(data, function (ind, item) {

                var profilePhotoImg = item.Profile_Photo == null ? 'images/users/user-blank.jpg' : item.Profile_Photo;
                var profilePhotoCss = item.Profile_Photo == null ? 'filter: saturate(23) hue-rotate(4739deg) brightness(95%) contrast(94%);' : '';
                var IssueRows = `<tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="20">
                                            ${srno++}
                                        </td>
                                        <td class="px-4 py-3 text-sm font-semibold" style="text-align: left;" width="100">
                                            ${item.title}
                                        </td>
                                        <td class="px-4 py-3 text-sm font-semibold" style="text-align: left;" width="100">
                                            ${item.category_name}
                                        </td>
                                        <td class="px-4 py-3 text-sm" style="text-align: left; max-width: 300px; white-space: pre-wrap;">${item.description}</td>
                                        <td class="px-4 py-3 text-xs">
                                            <span class="px-2 py-1 font-semibold leading-tight text-${item.status == 0 ? 'red' : 'green'}-700 bg-${item.status == 0 ? 'red' : 'green'}-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                ${item.status == 0 ? 'Unresolved' : 'Resolved'}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm font-semibold" style="text-align: left; max-width: 300px; white-space: pre-wrap;">${item.resolution_remark == null ? '--' : item.resolution_remark}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full" src="${profilePhotoImg}" alt="" loading="lazy" style="${profilePhotoCss}" />
                                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                </div>
                                                <div>
                                                    <p class="font-semibold">${item.Name}</p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                                        ${item.Designation}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            ${moment(item.raised_on).format('DD-MM-YYYY')}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-2 text-sm">
                                                ${item.status == 0 ? `<button id="${item.ID}" class="showEditDataInForm flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                                            </path>
                                                                        </svg>
                                                                    </button>
                                                                    <button onclick="DeleteTheIssue(${item.ID})" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                    </button>` : ''}
                                                
                                            </div>
                                        </td>
                                    </tr>`;

                $('#IssuesTable tbody').append(IssueRows);
            })
            paginationWorking('IssuesTable');
            $("#issue-search-input").on("keyup", function () {
                var searchText = $(this).val().toLowerCase();
                $("#IssuesTable tbody tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });

            $('.showEditDataInForm').on('click', function () {
                $('#raiseNewIssueBtn').addClass('hidden')
                $('#updateIssueBtn').removeClass('hidden')

                var idofrow = $(this).attr('id');
                var modalDiv = document.getElementById("addNewIssueModal");
                modalDiv.__x.$data.isModalOpen = true;

                $.each(data, function (index, row) {
                    if (row.ID == idofrow) {

                        $('#inputIssueTitle').val(row.title);
                        $('#categoryDD').val(row.category);
                        $('#IssueDescriptionInputBox').val(row.description);
                    }
                })
                //update the details
                $('#updateIssueBtn').on('click', function () {
                    $.ajax({
                        url: "php/api/support_UpdateIssue.php",
                        type: "POST",
                        datatype: "JSON",
                        data: {
                            rowid: idofrow,
                            ititle: $('#inputIssueTitle').val(),
                            icategory: $('#categoryDD').val(),
                            idescription: $('#IssueDescriptionInputBox').val(),
                        },
                        success: function (data) {
                            if (data.success) {
                                Swal.fire(
                                    'Issue Updated',
                                    `Issue has been updated Successfully!`,
                                    'success'
                                )
                                ShowAllIssues();
                                $('.addRoomModalCloseBtn').click();
                            }
                        }
                    });
                })
            })

        }
    });
}

function AddNewIssueToDB(uid) {
    $.ajax({
        url: "php/api/support_AddNewIssue.php",
        type: "POST",
        datatype: "JSON",
        data: {
            userID: uid,
            ititle: $('#inputIssueTitle').val(),
            icategory: $('#categoryDD').val(),
            idescription: $('#IssueDescriptionInputBox').val(),
        },
        success: function (data) {
            if (data.success) {
                Swal.fire(
                    'Issue Raised',
                    `New issue has been raised Successfully!`,
                    'success'
                )
                ShowAllIssues();
            }
        }
    });
}

function ShowIssueCategoryDD() {
    $.ajax({
        url: "php/api/support_GetIssueDDList.php",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            $('#categoryDD').empty();
            $.each(data, function (index, item) {
                $('#categoryDD').append(item);
            })
        }
    });
}