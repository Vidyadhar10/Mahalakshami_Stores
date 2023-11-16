// preloader stops when page loads completely
document.addEventListener("DOMContentLoaded", function () {
    // Remove the preloader when the content is loaded
    document.getElementById("preloader").style.display = "none";
});

// notification modal showing js 
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

// Set the default language to English and store it in localStorage
if (!localStorage.getItem('language')) {
    localStorage.setItem('language', 'eng');
}
// language toggler 
function ToggleLanguageBtn() {
    var currentLang = localStorage.getItem('language');

    // Update the image source based on the selected language
    if (currentLang === 'eng') {
        currentLang = 'mar';
        var newSrc = './images/lang-mar.png';
    } else {
        var newSrc = './images/lang-eng.png';
        currentLang = 'eng';
    }
    languageChosen(currentLang);

    $('#languageIconImg').attr('src', newSrc);
    localStorage.setItem('language', currentLang);
}

$(document).ready(function () {
    // Initialize the language icon based on the stored language
    var storedLanguage = localStorage.getItem('language');
    if (storedLanguage === 'eng') {
        $('#languageIconImg').attr('src', './images/lang-eng.png');
    } else {
        $('#languageIconImg').attr('src', './images/lang-mar.png');
    }
    languageChosen(storedLanguage);
})

//show language chosen appropriate
function languageChosen(lang) {
    toggleFontStyle()
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
                }
            });
        }
        if (translations[pageName]) {
            // Iterate through elements with data-translate attribute
            $('[data-translate]').each(function () {
                var key = $(this).data('translate');
                if (translations[pageName][key] && translations[pageName][key][lang]) {
                    // Update the element's content with the translation
                    $(this).html(translations[pageName][key][lang]);


                    if (key == 'CustomerInputSearchBox') {
                        $(this).attr('placeholder', `${translations[pageName][key][lang]}`)
                    }
                }
            });
        }
    });
}
var activeFontLink = 0; // 0 represents the first link, 1 represents the second link
var fontLinks = [
    "https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Marathi&display=swap",
    "https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap"
];
function toggleFontStyle() {
    activeFontLink = 1 - activeFontLink; // Toggle between 0 and 1

    // Remove the current font link
    $('#fontStyleForLanguage').remove();

    // Add the selected font link to the head
    $('head').append('<link id="fontStyleForLanguage" rel="stylesheet" href="' + fontLinks[activeFontLink] + '">');

    // Apply the font-family style to the body
    if (activeFontLink === 0) {
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


// AdminSide
// 	1. ShowAdminDashbordCardsData()
// 	2. ShowRecentTransactionsDetails()
// 	3. ShowCustomerListWithPreviousReadingForDropdown()


function ShowAdminDashbordCardsData() {
    $.ajax({
        url: "php/api/dashboard_GetAdminCardsData.php",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            $('#adminTodaysTxnCount').text(data.TodaysTxnCount);
            $('#adminTotalPendAmt').text(data.totalPendAmt);
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

            $.each(data, function (index, item) {
                var Trow = `<tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="20">
                                    ${srno++}
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="100">
                                    ${item.AccNo}
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="100">
                                    ${item.Room_No}
                                </td>
                                <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy" />
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
                                        <td colspan="8" class="px-4 py-3 text-sm font-semibold" style="text-align: center;" width="20">
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
function showRoomsCardsData() {
    $.ajax({
        url: "php/api/rooms_GetRoomCardsData.php",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            // console.log(data);
            $('#roomCardsDiv').empty();
            $.each(data, function (ind, item) {
                //iterate
                var cardString = ` <div class="flex roomCard flex-wrap -mx-4 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                        <div class="w-full  px-4 mb-2">
                                        <h4 class="mb-2  font-medium text-gray-600 dark:text-gray-400" data-translate="RoomDetails">
                                            Room Details
                                        </h4>
                                        </div>
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
                                        <div class="w-1/2 md:w-1/2 px-4 mb-2">
                                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-translate="RoomNum">
                                            Room Number
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
                                        <span class="px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
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
                        
                                        <button onclick="window.location.href='./customer_list.php?roomid=${item.ID}'" class="px-4 py-2 ml-2 w-full text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="window.location.href='./customer_add_form.php'" data-translate="ViewBtn">
                                        View
                                        </button>
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
                    var roomNoTr = `<td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="100">
                                        ${item.Room_No}
                                    </td>`;
                    var pendingAmtTr = `<td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="100">
                                        ${item.PendingAmt}
                                    </td>`
                } else {
                    var roomNoTr, pendingAmtTr = '';
                }
                var tablerow = `  <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm  font-semibold" style="text-align: right;" width="20">
                                            ${srno++}
                                        </td>
                                        <td class="px-4 py-3 text-sm font-semibold" style="text-align: right;" width="100">
                                            ${item.Account_No}
                                        </td>
                                        ${roomNoTr}
                                        <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy" />
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
            $.each(data.room_depo, function (index, item) {
                var badgeStr = `<span class="px-2 py-1  mt-2 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                    ${item.deposit_amt}
                                </span>`;
                $('#fixedDepositAmt').append(badgeStr);
            })

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
                                                    ${item.room_num}
                                                </td>
                                                <td class="px-4 py-3 text-sm reqDate" style="text-align: right;">
                                                    ${moment(item.datetime).format('DD-MM-YYYY')}
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