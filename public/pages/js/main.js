
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
        if (translations[pageName]) {
            // Iterate through elements with data-translate attribute
            $('[data-translate]').each(function () {
                var key = $(this).data('translate');
                if (translations[pageName][key] && translations[pageName][key][lang]) {
                    // Update the element's content with the translation
                    $(this).text(translations[pageName][key][lang]);
                }
            });
        }
    });
}