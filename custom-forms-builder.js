/* custom-forms-builder.js */

document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('custom-form');

    form.addEventListener('submit', function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    function validateForm() {
        var isValid = true;

        // Validate Email
        isValid = validateField('email', 'email', 'Please enter a valid email address.') && isValid;

        // Validate Name
        isValid = validateField('name', 'text', 'Please enter your name.') && isValid;

        // Validate Phone Number
        isValid = validateField('phone', 'tel', 'Please enter a valid phone number.') && isValid;

        // Add more validation for other fields as needed

        return isValid;
    }

    function validateField(fieldName, fieldType, errorMessage) {
        var input = document.getElementById(fieldName);
        var value = input.value.trim();

        // Additional field type validation can be added based on requirements

        if (value === '' || (fieldType === 'email' && !validateEmail(value)) || (fieldType === 'tel' && !validatePhoneNumber(value))) {
            alert(errorMessage);
            input.focus();
            return false;
        }

        return true;
    }

    function validateEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function validatePhoneNumber(phoneNumber) {
        // You can add custom phone number validation logic here
        // For simplicity, let's assume a valid phone number is a 10-digit number
        var phoneRegex = /^\d{10}$/;
        return phoneRegex.test(phoneNumber);
    }
});
