$(document).ready(function() {
    let patientId = null;
    let browserAgent = getBrowserAgent();
    let latitude = 0;
    let longitude = 0;

  
    //for contries -state relation
    $('.countries').change(function() {
        var selectedOption = $(this).find('option:selected');
        var country_id = selectedOption.val();
        var country_name = selectedOption.data('country-name'); 
        if (country_name) {
            $.ajax({
                url: '/get-states/' + country_name,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('.states').empty();
                    $('.states').append('<option value="">--Select--</option>');
                    $.each(data, function(key, value) {
                        $('.states').append('<option value="' + value.id + '">' + value.state_name + '</option>');
                    });
                }
            });
        } else {
            $('.states').empty();
            $('.states').append('<option value="">--Select--</option>');
        }
    });


    //patient registration details  section 1
    document.getElementById('continueButton').addEventListener('click', function() {
    const data = {
        firstName: document.getElementById('first-name').value,
        middleName: document.getElementById('middle-name').value ?? "",
        lastName: document.getElementById('last-name').value,
        email: document.getElementById('email_step1').value,
        dateOfBirth: document.getElementById('date_of_birth').value,
        gender: document.querySelector('input[name="gender"]:checked')?.value ?? '',
        country: document.getElementById('countries').value ?? '',
        state: document.getElementById('states').value ?? '' ,
        city: document.getElementById('city').value,
        postalCode: document.getElementById('postal_code').value,
        streetAddress: document.getElementById('street_address').value,
    };
    data.latitude = latitude;
    data.longitude = longitude
    data.browserAgent = browserAgent

    $('.error-message').text('');
    if(data.firstName && data.lastName && data.dateOfBirth && data.city && data.postalCode && data.streetAddress){
    // Get CSRF token from the page's meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Add CSRF token to the headers of the AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
    $.ajax({
        url: '/save-patients-details-form',
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function(response) {
           console.log('response');
           console.log(response.id);
           patientId = response.id;
        },
        error: function(xhr) {
            // Handle error response
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(key, value) {
                    $('#' + key + '-error').text(value[0]);
                });
            }
        }
    });

}
});


//contact parties section 2

document.getElementById('continueButtonStep2').addEventListener('click', function() {
    // console.log(document.getElementById('first-name').value);
    const data = {
        relationship_to_patient: document.getElementById('relationship_to_patient').value,
        email: document.getElementById('email').value ,
        phone_number: document.getElementById('phone_number').value,
        preferred_mode_of_communication: document.querySelector('input[name="preferred_mode_of_communication"]:checked')?.value ?? '',
        preferred_contact_time: document.querySelector('input[name="preferred_contact_time"]:checked')?.value ?? '',
    };
    data.patientId = patientId;
    data.latitude = latitude;
    data.longitude = longitude
    data.browserAgent = browserAgent
    console.log(data);
    // Get CSRF token from the page's meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Add CSRF token to the headers of the AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
    $.ajax({
        url: '/save-contact-party-form',
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function(response) {
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error(error);
        }
    });

});


//patient physician  section 3

document.getElementById('continueButtonStep3').addEventListener('click', function() {
    // console.log(document.getElementById('first-name').value);
    const data = {
        firstName: document.getElementById('first-name-step3').value ?? '',
        lastName: document.getElementById('last-name-step3').value ?? '' ,
        institution: document.getElementById('institution').value ?? '' ,
        country: document.getElementById('countries-step3').value ?? '',
        state: document.getElementById('states-step3').value ?? '' ,
        city: document.getElementById('city-step3').value ?? '',
        postalCode: document.getElementById('postal_code_step3').value ?? '' ,
        streetAddress: document.getElementById('street_address_step3').value ?? '',
        email: document.getElementById('email_step3').value ?? '',
        phone_number: document.getElementById('phone_number_step3').value ?? '',

    };
    data.patientId = patientId;
    data.latitude = latitude;
    data.longitude = longitude
    data.browserAgent = browserAgent
    console.log(data);
    // Get CSRF token from the page's meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Add CSRF token to the headers of the AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
    $.ajax({
        url: '/save-patients-physician-form',
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function(response) {
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

});

//primary concerns  section 4

document.getElementById('continueButtonStep4').addEventListener('click', function() {
    // console.log(document.getElementById('first-name').value);
    const data = {
        primary_diagnosis: document.getElementById('primary_diagnosis').value ?? '',
        treated_before: document.querySelector('input[name="treated_before"]:checked')?.value ?? '',
        surgery_description: document.getElementById('surgery_description').value ?? '' ,
        request_description: document.getElementById('request_description').value ?? '',

    };
    data.patientId = patientId;
    data.latitude = latitude;
    data.longitude = longitude
    data.browserAgent = browserAgent
    console.log(data);
    // Get CSRF token from the page's meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Add CSRF token to the headers of the AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
    $.ajax({
        url: '/save-primary-concerns-form',
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function(response) {
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

});


function getBrowserAgent() {
    return navigator.userAgent;
  }




});