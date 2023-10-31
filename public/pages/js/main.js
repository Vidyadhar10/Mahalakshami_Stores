// notification modal showing js 
function ShowNotificationModal() {
    var modalDiv = document.getElementById("notificationDiv");
    modalDiv.__x.$data.isModalOpen = true;
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
                    $(this).text(translations['Menubar'][key][lang]);
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
                    $(this).text(translations[pageName][key][lang]);


                    if (key == 'CustomerInputSearchBox') {
                        $(this).attr('placeholder', `${translations[pageName][key][lang]}`)
                    }
                }
            });
        }
    });
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
// AdminSide
// 	1. ShowAdminDashbordCardsData()
// 	2. ShowRecentTransactionsDetails()
// 	3. ShowCustomerListWithPreviousReadingForDropdown()


function ShowAdminDashbordCardsData() {
    $.ajax({
        url: "php/api/GetAdminDashCardsDetails.php",
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
        url: "php/api/GetRecentTransactions.php",
        type: "POST",
        datatype: "JSON",
        // data: {
        //     adminID: adminID,
        // },
        success: function (data) {
            console.log(data);
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

function ShowCustomerListWithPreviousReadingForDropdown(adminID) {
    $.ajax({
        url: "api/customerListDropdown",
        type: "POST",
        datatype: "JSON",
        data: {
            adminID: adminID,
        },
        success: function (data) {
            // Process data and populate customer list dropdown with previous reading
        }
    });
}
// UserSide
// 	1. ShowUserDashbordData()
// 	2. ShowUserTransactionData(userID)
function ShowUserDashbordData(userID) {
    $.ajax({
        url: "php/api/GetUserDashCardsData.php",
        type: "POST",
        datatype: "JSON",
        data: {
            userID: userID,
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
        url: "php/api/GetUserTxnHistoryData.php",
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
                var elecBill = item.meter_reading * item.meter_rate;
                var moneyTxtColor = '';
                if (parseInt(item.pendingAmt) < 0) {
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
                                <td class="px-4 py-3 text-sm" style="text-align: right;">
                                    ${item.meter_reading == null ? '0' : item.meter_reading}
                                </td>
                                <td class="px-4 py-3 text-sm" style="text-align: right;">
                                    ${item.meter_reading == null ? '0' : item.meter_reading} x ${item.meter_rate == null ? '0' : item.meter_rate} = <span class="font-semibold">${item.meter_reading * item.meter_rate}</span>
                                </td>
                                <td class="px-4 py-3 text-sm" style="text-align: right;">
                                    ${item.rent}
                                </td>
                                <td class="px-4 py-3 text-sm" style="text-align: right;">
                                    ${item.rent} + ${item.meter_reading * item.meter_rate} = <span class="font-semibold">${parseInt(item.rent) + elecBill}</span>
                                </td>
                                <td class="px-4 py-3 text-sm" style="text-align: right;">
                                ₹ ${item.amt_paid}
                                </td>
                                <td class="px-4 py-3 text-sm" style="text-align: right;">
                                ${parseInt(item.rent) + elecBill} - ${item.amt_paid} = <span class="font-semibold ${moneyTxtColor}">${parseInt(item.rent) + elecBill - item.amt_paid}</span>
                                </td>
                            </tr>`;
                $('#Customers-txn-table tbody').append(Trow);
                totalPendingAmt += parseInt(item.pendingAmt);
            })
            var tableFooter = `<tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm" colspan="6"></td>
                                    <td class="px-4 py-3 text-sm" style="text-align: right;" colspan="2"><strong>TOTAL AMOUNT PENDING: <span class="text-red-700">₹ ${totalPendingAmt}</span></strong></td>
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
function showCardsData() {
    $.ajax({
        url: "api/roomCardsData",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            // Process data and display room cards data
        }
    });
}

function GetRoomTypeForDropdown() {
    $.ajax({
        url: "api/roomTypesDropdown",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            // Process data and populate room type dropdown
        }
    });
}

function AddNewRoomToDB(roomData) {
    $.ajax({
        url: "api/addRoomToDB",
        type: "POST",
        datatype: "JSON",
        data: roomData,
        success: function (data) {
            // Process data and handle the addition of a new room to the database
        }
    });
}

// customer_list.php
// 	1. ShowCustomerList()
function ShowCustomerList() {
    $.ajax({
        url: "api/customerList",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            // Process data and display the list of customers
        }
    });
}

// customer_details.php
// 	1. ShowTenantProfileData()
// 	2. SendNotification()
// 	3. GetTransactionTableData()
// 	4. GetFormData() //previous reading.

function ShowTenantProfileData(tenantID) {
    $.ajax({
        url: "api/tenantProfileData",
        type: "POST",
        datatype: "JSON",
        data: {
            tenantID: tenantID,
        },
        success: function (data) {
            // Process data and display tenant profile data
        }
    });
}

function SendNotification(notificationData) {
    $.ajax({
        url: "api/sendNotification",
        type: "POST",
        datatype: "JSON",
        data: notificationData,
        success: function (data) {
            // Process data and send a notification
        }
    });
}

function GetTransactionTableData(tenantID) {
    $.ajax({
        url: "api/transactionTableData",
        type: "POST",
        datatype: "JSON",
        data: {
            tenantID: tenantID,
        },
        success: function (data) {
            // Process data and display transaction table data
        }
    });
}

function GetFormData() {
    $.ajax({
        url: "api/formData",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            // Process data and handle form data
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
            console.log(data);
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

function GetUserData(userID) {
    $.ajax({
        url: "api/userData",
        type: "POST",
        datatype: "JSON",
        data: {
            userID: userID,
        },
        success: function (data) {
            // Process data and display user data
        }
    });
}

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
