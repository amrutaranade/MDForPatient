/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/patient.js ***!
  \*********************************/
$(document).ready(function () {
  var patientId = null;
  var browserAgent = getBrowserAgent();
  var latitude = 0;
  var longitude = 0;

  //for contries -state relation
  $('.countries').change(function () {
    var selectedOption = $(this).find('option:selected');
    var country_id = selectedOption.val();
    var country_name = selectedOption.data('country-name');
    if (country_name) {
      $.ajax({
        url: '/get-states/' + country_name,
        type: 'GET',
        dataType: 'json',
        success: function success(data) {
          $('.states').empty();
          $('.states').append('<option value="">--Select--</option>');
          $.each(data, function (key, value) {
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
  $('.relationship_countries').change(function () {
    var selectedOption = $(this).find('option:selected');
    var country_id = selectedOption.val();
    var country_name = selectedOption.data('country-name');
    if (country_name) {
      $.ajax({
        url: '/get-states/' + country_name,
        type: 'GET',
        dataType: 'json',
        success: function success(data) {
          $('.relationship_states').empty();
          $('.relationship_states').append('<option value="">--Select--</option>');
          $.each(data, function (key, value) {
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
  document.getElementById('continueButton').addEventListener('click', function () {
    var _document$getElementB, _document$querySelect, _document$querySelect2, _document$getElementB2, _document$getElementB3;
    var data = {
      firstName: document.getElementById('first-name').value,
      middleName: (_document$getElementB = document.getElementById('middle-name').value) !== null && _document$getElementB !== void 0 ? _document$getElementB : "",
      lastName: document.getElementById('last-name').value,
      email: document.getElementById('email_step1').value,
      dateOfBirth: document.getElementById('date_of_birth').value,
      gender: (_document$querySelect = (_document$querySelect2 = document.querySelector('input[name="gender"]:checked')) === null || _document$querySelect2 === void 0 ? void 0 : _document$querySelect2.value) !== null && _document$querySelect !== void 0 ? _document$querySelect : '',
      country: (_document$getElementB2 = document.getElementById('countries').value) !== null && _document$getElementB2 !== void 0 ? _document$getElementB2 : '',
      state: (_document$getElementB3 = document.getElementById('states').value) !== null && _document$getElementB3 !== void 0 ? _document$getElementB3 : '',
      city: document.getElementById('city').value,
      postalCode: document.getElementById('postal_code').value,
      streetAddress: document.getElementById('street_address').value
    };
    $('.error-message').text('');
    if (data.firstName && data.lastName && data.dateOfBirth && data.city && data.postalCode && data.streetAddress) {
      // Get CSRF token from the page's meta tag
      var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
        success: function success(response) {
          console.log('response');
          console.log(response.id);
          patientId = response.id;
        },
        error: function error(xhr) {
          // Handle error response
          if (xhr.status === 422) {
            var errors = xhr.responseJSON.errors;
            $.each(errors, function (key, value) {
              $('#' + key + '-error').text(value[0]);
            });
          }
        }
      });
    }
  });

  //contact parties section 2

  document.getElementById('continueButtonStep2').addEventListener('click', function () {
    var _document$querySelect3, _document$querySelect4, _document$querySelect5, _document$querySelect6;
    // console.log(document.getElementById('first-name').value);
    var data = {
      relationship_to_patient: document.getElementById('relationship_to_patient').value,
      relationship_email: document.getElementById('relationship_email').value,
      relationship_phone_number: document.getElementById('relationship_phone_number').value,
      relationship_preferred_mode_of_communication: (_document$querySelect3 = (_document$querySelect4 = document.querySelector('input[name="relationship_preferred_mode_of_communication"]:checked')) === null || _document$querySelect4 === void 0 ? void 0 : _document$querySelect4.value) !== null && _document$querySelect3 !== void 0 ? _document$querySelect3 : '',
      relationship_preferred_contact_time: (_document$querySelect5 = (_document$querySelect6 = document.querySelector('input[name="relationship_preferred_contact_time"]:checked')) === null || _document$querySelect6 === void 0 ? void 0 : _document$querySelect6.value) !== null && _document$querySelect5 !== void 0 ? _document$querySelect5 : ''
    };
    data.patientId = patientId;
    console.log(data);
    // Get CSRF token from the page's meta tag
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
      success: function success(response) {},
      error: function error(xhr, status, _error) {
        // Handle error response
        console.error(_error);
      }
    });
  });

  //patient physician  section 3

  document.getElementById('continueButtonStep3').addEventListener('click', function () {
    var _document$getElementB4, _document$getElementB5, _document$getElementB6, _document$getElementB7, _document$getElementB8, _document$getElementB9, _document$getElementB10, _document$getElementB11, _document$getElementB12, _document$getElementB13;
    // console.log(document.getElementById('first-name').value);
    var data = {
      firstName: (_document$getElementB4 = document.getElementById('first-name-step3').value) !== null && _document$getElementB4 !== void 0 ? _document$getElementB4 : '',
      lastName: (_document$getElementB5 = document.getElementById('last-name-step3').value) !== null && _document$getElementB5 !== void 0 ? _document$getElementB5 : '',
      institution: (_document$getElementB6 = document.getElementById('institution').value) !== null && _document$getElementB6 !== void 0 ? _document$getElementB6 : '',
      country: (_document$getElementB7 = document.getElementById('countries-step3').value) !== null && _document$getElementB7 !== void 0 ? _document$getElementB7 : '',
      state: (_document$getElementB8 = document.getElementById('states-step3').value) !== null && _document$getElementB8 !== void 0 ? _document$getElementB8 : '',
      city: (_document$getElementB9 = document.getElementById('city-step3').value) !== null && _document$getElementB9 !== void 0 ? _document$getElementB9 : '',
      postalCode: (_document$getElementB10 = document.getElementById('postal_code_step3').value) !== null && _document$getElementB10 !== void 0 ? _document$getElementB10 : '',
      streetAddress: (_document$getElementB11 = document.getElementById('street_address_step3').value) !== null && _document$getElementB11 !== void 0 ? _document$getElementB11 : '',
      email: (_document$getElementB12 = document.getElementById('email_step3').value) !== null && _document$getElementB12 !== void 0 ? _document$getElementB12 : '',
      phone_number: (_document$getElementB13 = document.getElementById('phone_number_step3').value) !== null && _document$getElementB13 !== void 0 ? _document$getElementB13 : ''
    };
    data.patientId = patientId;
    console.log(data);
    // Get CSRF token from the page's meta tag
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
      success: function success(response) {},
      error: function error(xhr, status, _error2) {
        console.error(_error2);
      }
    });
  });

  //primary concerns  section 4

  document.getElementById('continueButtonStep4').addEventListener('click', function () {
    var _document$getElementB14, _document$querySelect7, _document$querySelect8, _document$getElementB15, _document$getElementB16;
    // console.log(document.getElementById('first-name').value);
    var data = {
      primary_diagnosis: (_document$getElementB14 = document.getElementById('primary_diagnosis').value) !== null && _document$getElementB14 !== void 0 ? _document$getElementB14 : '',
      treated_before: (_document$querySelect7 = (_document$querySelect8 = document.querySelector('input[name="treated_before"]:checked')) === null || _document$querySelect8 === void 0 ? void 0 : _document$querySelect8.value) !== null && _document$querySelect7 !== void 0 ? _document$querySelect7 : '',
      surgery_description: (_document$getElementB15 = document.getElementById('surgery_description').value) !== null && _document$getElementB15 !== void 0 ? _document$getElementB15 : '',
      request_description: (_document$getElementB16 = document.getElementById('request_description').value) !== null && _document$getElementB16 !== void 0 ? _document$getElementB16 : ''
    };
    data.patientId = patientId;
    console.log(data);
    // Get CSRF token from the page's meta tag
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
      success: function success(response) {},
      error: function error(xhr, status, _error3) {
        console.error(_error3);
      }
    });
  });
  function getBrowserAgent() {
    return navigator.userAgent;
  }
  $('#email_step1').on('blur', function () {
    var email = $(this).val();
    if (email === '') {
      $('#email-check-result').text('');
      return;
    }
    // Get CSRF token from the page's meta tag
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
        email: email
      },
      success: function success(response) {
        if (response.exists) {
          $('#email-check-result').text('Email already exists').addClass('form__error-text');
          $('#continueButton').prop('disabled', true);
        } else {
          $('#email-check-result').text('').removeClass('form__error-text'); // Remove the class if not exists
          $('#continueButton').prop('disabled', false);
        }
      }
    });
  });
});
/******/ })()
;