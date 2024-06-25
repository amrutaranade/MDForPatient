$(document).ready(function() {
    let patientId = null;
    let applicationCode = null;
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

    //for contries -state relation within step 2
    $('.relationship_countries').change(function() {
        var selectedOption = $(this).find('option:selected');
        var country_id = selectedOption.val();
        var country_name = selectedOption.data('country-name'); 
        if (country_name) {
            $.ajax({
                url: '/get-states/' + country_name,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('.relationship_states').empty();
                    $('.relationship_states').append('<option value="">--Select--</option>');
                    $.each(data, function(key, value) {
                        $('.relationship_states').append('<option value="' + value.id + '">' + value.state_name + '</option>');
                    });
                }
            });
        } else {
            $('.relationship_states').empty();
            $('.relationship_states').append('<option value="">--Select--</option>');
        }
    });


    //patient registration details  section 1
    document.getElementById('continueButton').addEventListener('click', async function() {
        const data = {
        firstName: document.getElementById('first-name').value,
        middleName: document.getElementById('middle-name').value ?? "",
        lastName: document.getElementById('last-name').value,
        email: document.getElementById('email_step1').value,
        confirm_email: document.getElementById('confirm_email_step1').value,
        dateOfBirth: document.getElementById('date_of_birth').value,
        gender: document.querySelector('input[name="gender"]:checked')?.value ?? '',
        country: document.getElementById('countries').value ?? '',
        state: document.getElementById('states').value ?? '' ,
        city: document.getElementById('city').value,
        postalCode: document.getElementById('postal_code').value,
        streetAddress: document.getElementById('street_address').value,
    };


    $('.error-message').text('');

  if (!await checkConnection()) {
    alert("Internet connection lost! Please reconnect and try again.");
    return; 
  }
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
            patientId = response.id;
            document.getElementById("patientId").value = patientId;
            
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

document.getElementById('continueButtonStep2').addEventListener('click', async function() {
    // console.log(document.getElementById('first-name').value);
    const data = {
        relationship_to_patient: document.getElementById('relationship_to_patient').value,
        relationship_email: document.getElementById('relationship_email').value ,
        relationship_confirm_email: document.getElementById('relationship_confirm_email').value ,
        relationship_phone_number: document.getElementById('relationship_phone_number').value,
        relationship_preferred_mode_of_communication: document.querySelector('input[name="relationship_preferred_mode_of_communication"]:checked')?.value ?? '',
        relationship_preferred_contact_time: document.querySelector('input[name="relationship_preferred_contact_time"]:checked')?.value ?? '',
        relationship_first_name: document.getElementById('relationship_first_name').value ?? '', 
        relationship_last_name: document.getElementById('relationship_last_name').value ?? '', 
        relationship_npi: document.getElementById('relationship_npi').value ?? '', 
        relationship_street_address: document.getElementById('relationship_street_address').value ?? '', 
        relationship_city: document.getElementById('relationship_city').value ?? '', 
        relationship_postal_code: document.getElementById('relationship_postal_code').value ?? '', 
        relationship_countries: document.getElementById('relationship_countries').value ?? '', 
        relationship_states: document.getElementById('relationship_states').value ?? '', 
        relationship_institution: document.getElementById('relationship_institution').value ?? '', 
        relationship_fax_no: document.getElementById('relationship_fax_no').value ?? '', 
        relationship_other: document.getElementById('relationship_other').value ?? '', 
        
    };
    data.patientId = patientId;

    // Check internet connection before proceeding
    if (!await checkConnection()) {
        alert("Internet connection lost! Please reconnect and try again.");
        return; 
    }    
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

document.getElementById('continueButtonStep3').addEventListener('click',async function() {
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
        confirm_email: document.getElementById('confirm_email_step3').value ?? '',
        phone_number: document.getElementById('phone_number_step3').value ?? '',

    };
    data.patientId = patientId;

    // Check internet connection before proceeding
    if (!await checkConnection()) {
        alert("Internet connection lost! Please reconnect and try again.");
        return; 
    }      // Get CSRF token from the page's meta tag
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

document.getElementById('continueButtonStep4').addEventListener('click', async function() {
    // console.log(document.getElementById('first-name').value);
    const data = {
        primary_diagnosis: document.getElementById('primary_diagnosis').value ?? '',
        treated_before: document.querySelector('input[name="treated_before"]:checked')?.value ?? '',
        surgery_description: document.getElementById('surgery_description').value ?? '' ,
        request_description: document.getElementById('request_description').value ?? '',

    };
    data.patientId = patientId;

    // Check internet connection before proceeding
    if (!await checkConnection()) {
        alert("Internet connection lost! Please reconnect and try again.");
        return; 
    }      // Get CSRF token from the page's meta tag
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

  $('#email_step1').on('blur', function() {
    var email = $(this).val();
    if (email === '') {
        $('#email-check-result').text('');
        return;
    }
    // Get CSRF token from the page's meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Add CSRF token to the headers of the AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
    $.ajax({
        url: '/check-email',
        type: 'POST',
        data: {
            email: email,
        },
        success: function(response) {
            if (response.exists) {
                $('#email-check-result')
                .text('Email already exists')
                .addClass('form__error-text');
                $('#continueButton').prop('disabled', true);
            } else {
                $('#email-check-result')
                .text('')
                .removeClass('form__error-text'); // Remove the class if not exists
                $('#continueButton').prop('disabled', false);
            }
        }
    });
});


async function checkConnection() {
    try {
      const response = await fetch('https://www.google.com/generate_204', {
        mode: 'no-cors'
      });
      // The response is opaque, but the fetch succeeded
      return true;
    } catch (error) {
      return false;
    }
  }
  
  // Usage example
  checkConnection().then(isConnected => {
    if (isConnected) {
      console.log('Internet is working');
    } else {
      console.log('No internet connection');
    }
  });
  
  
  
});