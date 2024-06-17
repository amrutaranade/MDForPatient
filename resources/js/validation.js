$(document).ready(function() {
    // Add custom method for string validation
$.validator.addMethod('string', function(value, element) {
    return this.optional(element) || /^[a-zA-Z\s]*$/.test(value); // Only allow letters and spaces
}, 'Please enter a valid string.');

// Add custom method for alphabetic characters with hyphens and apostrophes
$.validator.addMethod('alphaWithHyphenApostrophe', function(value, element) {
    return this.optional(element) || /^[a-zA-Z'-]+$/.test(value); // Only allow letters, hyphens, and apostrophes
}, 'Please enter a valid name.');
// Custom rule for alphanumeric characters with spaces
$.validator.addMethod("alphaNumericWithSpaces", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9\s]+$/i.test(value);
}, "Please enter a valid value with alphanumeric characters and spaces only.");

$.validator.addMethod('emailExists', function(value, element) {
    let exists = false;
    $.ajax({
        type: 'POST',
        url: '/check-email',
        data: {
            email: value,
            _token: $('meta[name="csrf-token"]').attr('content') // Include the CSRF token
        },
        dataType: 'json',
        async: false,
        success: function(response) {
            exists = response.exists;
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            console.error('Response:', xhr.responseText);
        }
    });
    return !exists; // If exists is true, return false (invalid); if false, return true (valid)
}, 'This email is already taken.');

    // Custom rule for strict email validation
$.validator.addMethod('strictEmail', function(value, element) {
    // Regex pattern for validating email addresses
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return this.optional(element) || emailPattern.test(value);
}, 'Please enter a valid email address.');
    $('#progress-form').validate({
        rules: {
            firstname: {
                alphaWithHyphenApostrophe:true
            },
            middlename: {
                alphaWithHyphenApostrophe:true
            },
            lastname: {
                alphaWithHyphenApostrophe:true
            },
            citystep1: {
                alphaWithHyphenApostrophe:true
            },
            postalcodestep1: {
                digits:true
            },
            emailstep1: {
                strictEmail: true,
                emailExists: true // Validate email format
            },
            confirmemailstep1: {
                equalTo: "#email_step1" // Ensure it matches the email field
            },
            relationship_first_name:{
                alphaWithHyphenApostrophe:true
            },
            relationship_last_name:{
                alphaWithHyphenApostrophe:true
            },
            relationship_npi:{
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            relationship_city:{
                alphaWithHyphenApostrophe:true
            },
            relationship_postal_code:{
                digits:true

            },
            relationship_email: {
                strictEmail: true // Validate email format
            },
            relationship_confirm_email: {
                equalTo: "#relationship_email" // Ensure it matches the email field
            },
            relationship_phone_number:{
                digits: true,
                minlength: 10,
                maxlength: 12
            },
            relationship_institution: {
                maxlength: 100, // Adjust max length as needed
                alphaNumericWithSpaces: true // Custom rule for alphanumeric characters with spaces
            },
            relationship_fax_no: {
                digits: true,
                minlength: 10, // Adjust as per fax number requirements
                maxlength: 15 // Adjust as per fax number requirements
            },
            firstnamestep3:{
                alphaWithHyphenApostrophe:true
            },
            lastnamestep3:{
                alphaWithHyphenApostrophe:true
            },
            citystep3:{
                alphaWithHyphenApostrophe:true
            },
            postalcodestep3:{
                digits:true
            },
            phonenumberstep3:{
                digits: true,
                minlength: 10,
                maxlength: 12
            },
            email_step3: {
                strictEmail: true // Validate email format
            },
            confirm_email_step3: {
                equalTo: "#email_step3" // Ensure it matches the email field
            },
        },
        messages: {
            firstname: {
                alphaWithHyphenApostrophe: "Please enter a valid first name."
            },
            middlename: {
                alphaWithHyphenApostrophe: "Please enter a valid middle name."
            },
            lastname: {
                alphaWithHyphenApostrophe: "Please enter a valid last name."
            },
            citystep1: {
                alphaWithHyphenApostrophe: "Please enter a valid city name."
            },
            postalcodestep1: {
                digits: "Please enter only digits."
            },
            emailstep1: {
                strictEmail: "Please enter a valid email address",
                emailExists: "This email is already exists."
            },
            confirmemailstep1: {
               equalTo: "Email addresses do not match."
            },
            relationship_first_name: {
                alphaWithHyphenApostrophe: "Please enter a valid first name."
             },
             relationship_last_name: {
                alphaWithHyphenApostrophe: "Please enter a valid last name."
             },
             relationship_npi: {
                digits: "NPI must contain only digits.",
                minlength: "NPI must be exactly 10 digits long.",
                maxlength: "NPI must be exactly 10 digits long."
             },
             relationship_city: {
                alphaWithHyphenApostrophe: "Please enter a valid city name."
            },
            relationship_postal_code: {
                digits: "Please enter only digits."
            },
            relationship_email: {
                strictEmail: "Please enter a valid email addres.s"
             },
             relationship_confirm_email: {
                equalTo: "Email addresses do not match."
             },
             relationship_confirm_email: {
                equalTo: "Email addresses do not match."
             },
             relationship_phone_number: {
                digits: "Phone number must contain only digits",
                minlength: "Phone number must be at least 10 digits long", // Adjust as per phone number requirements
                maxlength: "Phone number must not exceed 15 digits" // Adjust as per phone number requirements
            },
            relationship_institution: {
                maxlength: "Institution name must be at most 100 characters long",
                alphaNumericWithSpaces: "Please enter a valid institution name with alphanumeric characters and spaces only"
            },
            relationship_fax_no: {
                digits: "Fax number must contain only digits",
                minlength: "Fax number must be at least 10 digits long", // Adjust as per fax number requirements
                maxlength: "Fax number must not exceed 15 digits" // Adjust as per fax number requirements
            },
            firstnamestep3: {
               alphaWithHyphenApostrophe: "Please enter a valid first name."
            },
            lastnamestep3:{
                 alphaWithHyphenApostrophe: "Please enter a valid last name."
            },
            citystep3:{
                alphaWithHyphenApostrophe: "Please enter a valid city name."
            },
            postalcodestep3: {
                digits: "Please enter only digits."
            },
            phonenumberstep3:{
                digits: "Phone number must contain only digits",
                minlength: "Phone number must be at least 10 digits long", // Adjust as per phone number requirements
                maxlength: "Phone number must not exceed 15 digits" // Adjust as per phone number requirements
            },
            email_step3: {
                strictEmail: "Please enter a valid email addres.s"
             },
             confirm_email_step3: {
                equalTo: "Email addresses do not match."
             },
          
        },
        errorElement: 'p', // Use a span element for error messages
        errorClass: 'form__error-text', // Add the 'text-danger' class to the error messages
        highlight: function(element) {
            $(element).attr('aria-invalid', 'true');
        },
        unhighlight: function(element) {
            $(element).removeAttr('aria-invalid');
        },
        
       
    });
});