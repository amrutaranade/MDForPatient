$(document).ready(function() {
    let patientId = null;


    //for contries -state relation
    $('#countries').change(function() {
        var selectedOption = $(this).find('option:selected');
        var country_id = selectedOption.val();
        var country_name = selectedOption.data('country-name'); 
        if (country_name) {
            $.ajax({
                url: '/get-states/' + country_name,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#states').empty();
                    $('#states').append('<option value="">--Select--</option>');
                    $.each(data, function(key, value) {
                        $('#states').append('<option value="' + value.id + '">' + value.state_name + '</option>');
                    });
                }
            });
        } else {
            $('#states').empty();
            $('#states').append('<option value="">--Select--</option>');
        }
    });


    //patient registration details  section 1
    document.getElementById('continueButton').addEventListener('click', function() {
    const data = {
        firstName: document.getElementById('first-name').value,
        middleName: document.getElementById('middle-name').value ?? "",
        lastName: document.getElementById('last-name').value,
        dateOfBirth: document.getElementById('date_of_birth').value,
        gender: document.querySelector('input[name="gender"]:checked')?.value ?? '',
        country: document.getElementById('countries').value ?? '',
        state: document.getElementById('states').value ?? '' ,
        city: document.getElementById('city').value,
        postalCode: document.getElementById('postal_code').value,
        streetAddress: document.getElementById('street_address').value,
    };
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
        error: function(xhr, status, error) {
            // Handle error response
            console.error(error);
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

});