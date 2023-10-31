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

// AdminSide
// 	1. ShowAdminDashbordCardsData()
// 	2. ShowRecentTransactionsDetails()
// 	3. ShowCustomerListWithPreviousReadingForDropdown()


function ShowAdminDashbordCardsData(adminID) {
    $.ajax({
        url: "api/adminDashCard",
        type: "POST",
        datatype: "JSON",
        data: {
            adminID: adminID,
        },
        success: function (data) {
            // Process data and display admin dashboard cards
        }
    });
}

function ShowRecentTransactionsDetails(adminID) {
    $.ajax({
        url: "api/recentTransactions",
        type: "POST",
        datatype: "JSON",
        data: {
            adminID: adminID,
        },
        success: function (data) {
            // Process data and display recent transaction details
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
        url: "api/userDashData",
        type: "POST",
        datatype: "JSON",
        data: {
            userID: userID,
        },
        success: function (data) {
            // Process data and display user dashboard data
        }
    });
}

function ShowUserTransactionData(userID) {
    $.ajax({
        url: "api/userTransactionData",
        type: "POST",
        datatype: "JSON",
        data: {
            userID: userID,
        },
        success: function (data) {
            // Process data and display user transaction data
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
// 	1.GetRoomTypeData()
// 	2.Addroomtypedata()
// 	3.GetRoomDepositAmt()
// 	4.UpdateRoomDepositAmt()
// 	5.GetMeterData()
// 	6.UpdateMeterData()

function GetRoomTypeData() {
    $.ajax({
        url: "api/roomTypeData",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            // Process data and display room type data
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

function GetRoomDepositAmt() {
    $.ajax({
        url: "api/roomDepositAmt",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            // Process data and display room deposit amount
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

function GetMeterData() {
    $.ajax({
        url: "api/meterData",
        type: "POST",
        datatype: "JSON",
        success: function (data) {
            // Process data and display meter data
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
