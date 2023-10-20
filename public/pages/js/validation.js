function InputNumberOnly(paraID) {
    var Numbers = $('#' + paraID).val();
    if (isNaN(Numbers)) {
        Numbers = Numbers.slice(0, -1);
        $('#' + paraID).val(Numbers);
    }
}

function isPasswordValid(password) {
    // Define regular expressions to check for the required conditions
    const uppercaseRegex = /[A-Z]/;
    const lowercaseRegex = /[a-z]/;
    const symbolRegex = /[-!@#$%^&*()_+|~=`{}\[\]:";'<>?,.\/\\]/;

    // Check the length of the password
    if (password.length < 8) {
        return false;
    }

    // Check if the password contains at least one uppercase letter
    if (!uppercaseRegex.test(password)) {
        return false;
    }

    // Check if the password contains at least one lowercase letter
    if (!lowercaseRegex.test(password)) {
        return false;
    }

    // Check if the password contains at least one symbol
    if (!symbolRegex.test(password)) {
        return false;
    }

    // If all conditions are met, the password is valid
    return true;
}