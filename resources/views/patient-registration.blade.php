@extends("layout")
@section("content")
<div class="">
    <div class="">
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-8 col-lg-8">
                <!-- <div class="card">
                    <div class="row">
                        <div class="col-md-3 col-lg-3">
                            
                            <div class="page-header">
                                <h2 class="page-title pageHeader"><div class= "verticalHeader"></div>Expert opinion request</h2>
                            </div>
                        </div>
                        <div class="col-md-9 col-lg-9">
                            <div class="page-header">
                                <div class="infoTag">If this is a time-sensitive or urgent request, please contact 911 or seek local medical care as appropriate.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/> -->
                <div class="containerHeader">
                    <div class="titleHeader">Expert Opinion Request</div>
                    <div class="alertHeader">If this is a time-sensitive or urgent request, please contact 911 or seek local medical care as appropriate.</div>
                </div>
                <br/>
            </div>
            <div class="col-md-2 col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Progress Form -->
                        <form id="progress-form" class="p-4 progress-form" action="https://httpbin.org/post" lang="en" novalidate>
                        <!-- Step Navigation -->
                        
                        <div class="d-flex align-items-start mb-3 sm:mb-5 progress-form__tabs step-container" role="tablist">
                            <button id="progress-form__tab-1" class="flex-1 px-0 pt-2 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-1" aria-selected="true" aria-disabled="true">
                                <span class="" aria-hidden="true"><div class="step-number">1</div>
                                <div>Patient Details</div></span>
                            </button>
                            <button id="progress-form__tab-2" class="flex-1 px-0 pt-2 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-2" aria-selected="false" tabindex="-1" aria-disabled="true">
                                <span  aria-hidden="true"><div class="step-number">2</div>
                                <div>Contact Party</div></span>
                            </button>
                            <button id="progress-form__tab-3" class="flex-1 px-0 pt-2 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-3" aria-selected="false" tabindex="-1" aria-disabled="true">
                                <span  aria-hidden="true"><div class="step-number">3</div><div>Patient's Physician</div></span>
                                
                            </button>
                            <button id="progress-form__tab-4" class="flex-1 px-0 pt-2 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-4" aria-selected="false" tabindex="-1" aria-disabled="true">
                                <span  aria-hidden="true"><div class="step-number">4</div><div>Primary Concern</div></span>
                                
                            </button>                            
                            <button id="progress-form__tab-5" class="flex-1 px-0 pt-2 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-5" aria-selected="false" tabindex="-1" aria-disabled="true">
                                <span  aria-hidden="true"><div class="step-number">5</div><div>Consent & Payment</div></span>
                                
                            </button>
                            <button id="progress-form__tab-6" class="flex-1 px-0 pt-2 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-6" aria-selected="false" tabindex="-1" aria-disabled="true">
                                <span  aria-hidden="true"><div class="step-number">7</div><div>Medical Document</div></span>
                            
                            </button>
                        </div>
                        <!-- / End Step Navigation -->

                        <!-- Step 1 -->
                        <section id="progress-form__panel-1" role="tabpanel" aria-labelledby="progress-form__tab-1" tabindex="0">
                            <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="first-name">
                                    First Name
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="first-name" type="text" name="first-name" autocomplete="given-name" required>
                                </div>

                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="first-name">
                                    Middle Name
                                </label>
                                <input id="middle-name" type="text" name="middle-name" autocomplete="given-name">
                                </div>

                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="last-name">
                                    Last Name
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="last-name" type="text" name="last-name" autocomplete="family-name" required>
                                </div>
                            </div>

                            <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="date_of_birth">
                                    Date Of Birth
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="date_of_birth" type="date" name="date_of_birth" autocomplete="given-name" required>
                                </div>
                            </div>
                            <br/><span id="patientMailingAddressHrTag" class="fw-bold" >Patient Mailing Address</span><hr></hr>
                            <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="street_address">
                                        Street Address
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input id="street_address" type="text" name="street_address" autocomplete="given-name" required>
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="City">
                                        City
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input id="city" type="text" name="city" autocomplete="given-name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="postal_code">
                                    Postal Code
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="postal_code" type="text" name="postal_code" autocomplete="given-name" required>
                                </div>
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="Country">
                                    Country
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <select class="countries" name="countries" id="countries" required>
                                    <option value="">--Select--</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country['id'] ?? '' }}" data-country-name="{{ $country['country_name'] ?? '' }}">{{ $country['country_name'] ?? '' }}</option>
                                    @endforeach
                                </select>
                                </div>

                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="states">
                                    State
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <select class="states" name="states" id="states" required>
                                    <option value="">--Select--</option>
                                </select>
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="email">
                                    Email
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="email_step1" type="email" name="email" class ="email" autocomplete="given-name" required>
                                <label id="email-check-result"></label>
                                </div>

                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="confirm_email">
                                    Confirm Email
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="confirm_email_step1" type="email" name="confirm_email" class="confirm_email" autocomplete="given-name" required>
                                <span id="emailMatchMessage"  style="display: none;">Emails do not match</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                                <button type="button" data-action="next" class="continueButton step1 btn btn-success btn-fw" id="continueButton">
                                Save & Next
                                </button>
                            </div>
                        </section>
                        <!-- / End Step 1 -->

                        <!-- Step 2 -->
                        <section id="progress-form__panel-2" role="tabpanel" aria-labelledby="progress-form__tab-2" tabindex="0" hidden>
                            <div class="mt-3 form__field">
                            <h4 class="fw-bold">This is the party responsible for this case. They may be contacted about patient information, medical records, payment, and the case report as applicable.<br/><br/></h4>
                            </div>
                            <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                <div class="mt-3 form__field">
                                    <label for="relationship_to_patient">
                                    Select Relationship To The Patient
                                    <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <select id="relationship_to_patient" name="relationship_to_patient" autocomplete="shipping address-level1" required>
                                        <option value="" disabled >Please select</option>
                                        <option value="Patient" selected>Patient</option>
                                        <option value="Caregiver">Caregiver</option>
                                        <option value="Referring or local physician">Referring or local physician</option>
                                        <option value="Parent">Parent</option>
                                        <option value="Legal Guardian">Legal Guardian</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="relationship_first_name">
                                    Your First Name
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="relationship_first_name" type="text" name="relationship_first_name" class ="relationship_first_name" >
                                </div>
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="relationship_confirm_email">
                                    Your Last Name
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="relationship_last_name" type="text" name="relationship_last_name" class ="relationship_last_name" >

                                </div>
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="relationship_npi">
                                    NPI
                                </label>
                                <input id="relationship_npi" type="text" name="relationship_npi">
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="relationship_other">
                                    Specify your relationship to the patient
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="relationship_other" type="text" name="relationship_other" class ="relationship_other" >
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_street_address">
                                        Street Address
                                    </label>
                                    <input id="relationship_street_address" type="text" name="relationship_street_address" autocomplete="given-name">
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_city">
                                        City
                                    </label>
                                    <input id="relationship_city" type="text" name="relationship_city" autocomplete="given-name" >
                                    </div>
                                </div>
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="relationship_postal_code">
                                    Postal Code
                                </label>
                                <input id="relationship_postal_code" type="text" name="relationship_postal_code" autocomplete="given-name" >
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-3 sm:mt-3">                                
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="relationship__country">
                                    Country
                                </label>
                                <select class="relationship_countries" name="relationship_countries" id="relationship_countries" >
                                    <option value="">--Select--</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country['id'] ?? '' }}" data-country-name="{{ $country['country_name'] ?? '' }}">{{ $country['country_name'] ?? '' }}</option>
                                    @endforeach
                                </select>
                                </div>

                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="relationship_states">
                                    State
                                </label>
                                <select class="relationship_states" name="relationship_states" id="relationship_states" >
                                    <option value="">--Select--</option>
                                </select>
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="relationship_email">
                                    Email Address
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="relationship_email" type="email" name="relationship_email" class ="relationship_email" >
                                </div>
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="relationship_confirm_email">
                                    Confirm Email
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="relationship_confirm_email" type="email" name="relationship_confirm_email" class ="relationship_confirm_email" >

                                </div>
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="relationship_phone_number">
                                    Phone Number
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="relationship_phone_number" type="text" name="relationship_phone_number" >
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="relationship_institution">
                                    Institution
                                </label>
                                <input id="relationship_institution" type="text" name="relationship_institution" class ="relationship_institution"  >
                                </div>
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="relationship_fax_no">
                                    Fax No.
                                </label>
                                <input id="relationship_fax_no" type="text" name="relationship_fax_no" class ="relationship_fax_no" >

                                </div>

                            </div>
                            <div class="sm:d-grid sm:grid-col-3 sm:mt-3">                                
                                <fieldset class="mt-3 sm:mt-0 form__field ">
                                    <label for="relationship_preferred_mode_of_communication">
                                        Preferred Mode Of Communication
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    
                                    <div class=" form-check-inline">
                                        <input class="form-check-input" type="radio" name="relationship_preferred_mode_of_communication" id="phoneRadio" value="Phone" >
                                        <label class="form-check-label" for="phoneRadio">Phone</label>
                                    </div>
                                    <div class=" form-check-inline">
                                        <input class="form-check-input" type="radio" name="relationship_preferred_mode_of_communication" id="emailRadio" value="Email" >
                                        <label class="form-check-label" for="emailRadio">Email</label>
                                    </div>  
                                </fieldset>
                            
                                <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_preferred_contact_time">
                                        Preferred Contact Time
                                    </label>  
                                    
                                    <div class=" form-check-inline">
                                        <input class="form-check-input" type="radio" name="relationship_preferred_contact_time" id="MorningRadio" value="Morning">
                                        <label class="form-check-label" for="MorningRadio">Morning</label>
                                    </div>
                                    <div class=" form-check-inline">
                                        <input class="form-check-input" type="radio" name="relationship_preferred_contact_time" id="AfternoonRadio" value="Afternoon">
                                        <label class="form-check-label" for="AfternoonRadio">Afternoon</label>
                                    </div> 
                                    
                                    <div class=" form-check-inline">
                                        <input class="form-check-input" type="radio" name="relationship_preferred_contact_time" id="EveningRadio" value="Evening">
                                        <label class="form-check-label" for="EveningRadio">Evening</label>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                                <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
                                Back
                                </button>
                                <button type="button" data-action="next" class="continueButton continueButtonStep" id="continueButtonStep2">
                                Continue
                                </button>
                            </div> -->
                            <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5 template-demo">
                                <button data-action="prev" type="button" data-action="next" class="btn btn-secondary btn-fw" >
                                Back
                                </button> &nbsp;&nbsp;
                                <button type="button" data-action="next" class="continueButton continueButtonStep btn btn-success btn-fw" id="continueButtonStep2">
                                Save & Next
                                </button>
                            </div>
                        </section>
                        <!-- / End Step 2 -->

                        <!-- Step 3 -->
                        <section id="progress-form__panel-3" role="tabpanel" aria-labelledby="progress-form__tab-3" tabindex="0" hidden>
                            <div class="mt-3 form__field">
                            <h4 class="fw-bold">This physician can be requested to take action on this case and may receive a copy of any resulting reports.<br/><br/></h4>
                            </div>
                            <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="first-name">
                                    First Name
                                </label>
                                <input id="first-name-step3" type="text" name="first-name" autocomplete="given-name" >
                                </div>

                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="last-name">
                                    Last Name
                                </label>
                                <input id="last-name-step3" type="text" name="last-name" autocomplete="family-name" >
                                </div>
                            </div>

                            <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="institution">
                                    Institution
                                </label>
                                <input id="institution" type="text" name="institution" autocomplete="given-name" >
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="street_address">
                                    Street Address
                                </label>
                                <input id="street_address_step3" type="text" name="street_address" autocomplete="given-name" >
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="city">
                                    City
                                </label>
                                <input id="city-step3" type="text" name="city" autocomplete="given-name" >
                                </div>

                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="postal_code">
                                    Postal Code
                                </label>
                                <input id="postal_code_step3" type="text" name="postal_code" autocomplete="given-name" >
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="Country">
                                    Country
                                </label>
                                <select class="countries" name="countries" id="countries-step3">
                                    <option value="">--Select--</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country['id'] ?? '' }}" data-country-name="{{ $country['country_name'] ?? '' }}">{{ $country['country_name'] ?? '' }}</option>
                                    @endforeach
                                </select>
                                </div>

                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="states">
                                    State
                                </label>
                                <select class="states" name="states" id="states-step3">
                                    <option value="">--Select--</option>
                                </select>
                                </div>
                            </div>                            
                            <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="email">
                                    Email Address
                                </label>
                                <input id="email_step3" type="email" name="email" class ="email" autocomplete="given-name" >
                                </div>

                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="confirm_email">
                                    Confirm Email
                                </label>
                                <input id="confirm_email_step3" type="email" name="confirm_email" class ="confirm_email" autocomplete="given-name" >
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="phone_number">
                                    Phone Number
                                </label>
                                <input id="phone_number_step3" type="text" name="phone_number" autocomplete="given-name" >
                                </div>
                            </div>

                            <!--<div class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                                <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
                                Back
                                </button>
                                <button type="button" data-action="next" class="continueButton continueButtonStep" id="continueButtonStep3">
                                Continue
                                </button>
                            </div> -->
                            <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5 template-demo">
                                <button data-action="prev" type="button" data-action="next" class="btn btn-secondary btn-fw" >
                                Back
                                </button> &nbsp;&nbsp;
                                <button type="button" data-action="next" class="continueButton continueButtonStep btn btn-success btn-fw" id="continueButtonStep3">
                                Save & Next
                                </button>
                            </div>
                        </section>
                        <!-- / End Step 3 -->

                        <!-- Step 4 -->
                        <section id="progress-form__panel-4" role="tabpanel" aria-labelledby="progress-form__tab-4" tabindex="0" hidden>
                            <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="primary_diagnosis">
                                    Please Provide The Primary Diagnosis* (If unknown, please list unknown)
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="primary_diagnosis" type="text" name="primary_diagnosis" autocomplete="given-name" required>
                                </div>
                                <div class="mt-3 sm:mt-0 form__field ">
                                    <label for="address-city">
                                    Has The Patient Been Treated Or Had Surgery For This Condition Before?
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    
                                    <div class=" form-check-inline">
                                        <input class="form-check-input" type="radio" name="treated_before" id="yesRadio" value="Yes">
                                        <label class="form-check-label" for="yesRadio">Yes</label>
                                    </div>
                                    <div class=" form-check-inline">
                                        <input class="form-check-input" type="radio" name="treated_before" id="noRadio" value="No">
                                        <label class="form-check-label" for="noRadio">No</label>
                                    </div>  
                                </div>
                            </div>

                            <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                
                                <div class="mt-3 sm:mt-0 form__field ">
                                    <label for="address-city">
                                    If so, please describe
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    
                                    <input id="surgery_description" type="text" name="surgery_description" autocomplete="given-name" required> 
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">
                                <label for="request_description">
                                Please add a description of your request including a brief medical history, current treatment plan, specific questions you may have, and any other information you wish to provide.
                                    <span data-required="true" aria-hidden="true"></span>
                                </label>
                                <textarea rows="5" cols="40" id="request_description" type="text" name="request_description" autocomplete="given-name" required></textarea>
                                </div>
                            </div>

                            <!-- <div class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                                <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
                                Back
                                </button>
                                <button type="button" data-action="next" class="continueButton" id="continueButtonStep4">
                                Continue
                                </button>
                            </div> -->
                            <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5 template-demo">
                                <button data-action="prev" type="button" data-action="next" class="btn btn-secondary btn-fw" >
                                Back
                                </button> &nbsp;&nbsp;
                                <button type="button" data-action="next" class="continueButton continueButtonStep btn btn-success btn-fw" id="continueButtonStep4">
                                Save & Next
                                </button>
                            </div>
                        </section>
                        <!-- / End Step 4 -->

                        <!-- Step 5 -->
                        <section id="progress-form__panel-5" role="tabpanel" aria-labelledby="progress-form__tab-5" tabindex="0" hidden>
                            <div class="mt-3 form__field">
                            <h4 class="fw-bold">Documents to review:<br/><br/></h4>
                            </div>
                            <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                            <div id="tabs">
                                <span class="tab-button active" onclick="goToTab(0)" id="tabButton0">Patient Cover Letter</span>
                                <span class="tab-button" onclick="goToTab(1)" id="tabButton1">Patient Agreement</span>
                            </div>
                            
                                <div class="tab tab-content">
                                    <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                                        <div class="mt-3 sm:mt-0 form__field">
                                            <iframe src="/files/EV_MD_For_Patients_Agreement1_PatientCoverLetter.pdf#toolbar=0&amp;navpanes=0&amp;scrollbar=0" class="">                                    
                                            </iframe>
                                        </div>
                                        <div class="mt-3 sm:mt-0 form__field">
                                            <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5 template-demo">
                                                <button type="button"  class="btn btn-success btn-fw agreeButton" onclick="nextTab()">
                                                Agree & Proceed
                                                </button>
                                            </div>
                                            <!-- <button type="button" class="agreeButton" onclick="nextTab()">Agree & Proceed</button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab tab-content">
                                    <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                                        <div class="mt-3 sm:mt-0 form__field">
                                            <iframe src="/files/EV_MD_For_Patients_Agreement_1_Patient_Agreement.pdf#toolbar=0&amp;navpanes=0&amp;scrollbar=0" class="">                                    
                                            </iframe>
                                        </div>
                                    </div>
                                    <div class="sm:d-grid sm:grid-col-2 sm:mt-3">                                        
                                        <div class="mt-1 form__field">
                                            <label class="">
                                                <span>I confirm that, I have read the Patient Agreement and each appendix checked below</span>
                                                            
                                            </label>
                                            <label class="form__choice-wrapper">
                                                <input id="email-newsletter" type="checkbox" name="email-newsletter" value="Yes" class="patientAgreement">
                                                <span>Patient Agreement</span>                                            
                                            </label>
                                            <label class="form__choice-wrapper">
                                                <input id="email-newsletter" type="checkbox" name="email-newsletter" value="Yes" class="patientAgreement">
                                                <span>Appendix 1 : Payment Terms</span>                                            
                                            </label>
                                            <label class="form__choice-wrapper">
                                                <input id="email-newsletter" type="checkbox" name="email-newsletter" value="Yes" class="patientAgreement">
                                                <span>Appendix 2 : Patient Enrollment Form – MD for Patients</span>                                            
                                            </label>
                                            <label class="form__choice-wrapper">
                                                <input id="email-newsletter" type="checkbox" name="email-newsletter" value="Yes" class="patientAgreement" >
                                                <span>Appendix 3: Medicare Opt-Out Agreement</span>                                            
                                            </label>
                                            <label class="form__choice-wrapper">
                                                <input id="email-newsletter" type="checkbox" name="email-newsletter" value="Yes" class="patientAgreement">
                                                <span>Appendix 4: Informed Consent</span>                                            
                                            </label>
                                        </div>
                                        <div class="mt-1 form__field">
                                            <div class="mt-3 sm:mt-0 form__field">
                                                <label for="digital_signature">
                                                By typing the full name below, I hereby indicate that I understand and accept all terms as specified in the Patient Agreement and in each Appendix
                                                </label>
                                                <input id="digital_signature" type="text" name="digital_signature" autocomplete="given-name" >
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                        <div class="mt-3 sm:mt-0 form__field">
                                            <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5 template-demo">
                                                <button type="button" onclick="previousTab()" class="btn btn-secondary btn-fw previousButton">
                                                Previous
                                                </button> &nbsp;&nbsp;
                                                <button type="button" data-action="next" class="agreeButton btn btn-success btn-fw" id="btnPatientAgreementConfirm" onclick="nextTab()">
                                                Agree & Proceed
                                                </button>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5 template-demo">
                                        <button type="button" onclick="previousTab()" class="btn btn-secondary btn-fw previousButton">
                                        Previous
                                        </button> &nbsp;&nbsp;
                                        <!-- <button type="button" data-action="next" class="agreeButton btn btn-success btn-fw" id="btnPatientAgreementConfirm">
                                        Agree & Proceed to Payment
                                        </button> -->
                                        <form action="#" method="POST">
                                        @csrf
                                        <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="{{ env('STRIPE_KEY') }}"
                                            data-amount="19900"
                                            data-name="MD For Patients"
                                            data-description="Payment for consulation fee   "
                                            data-image="/dist/assets/images/logo-mini.png"
                                            data-locale="auto"
                                            data-currency="usd"
                                            data-label="Agree & Proceed to Payment"
                                            data-class="agreeButton btn btn-success btn-fw">
                                        </script>
                                    </form>
                                    </div>
                                </div>
                                <!-- <div class="tab tab-content">
                                    <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                                        <div class="mt-3 sm:mt-0 form__field">
                                            <label for="first-name">
                                                <b>Digital signature</b>
                                                <span data-required="true" aria-hidden="true"></span><br>
                                                By signing below you confirm that you have read and agree to all the previous documents.
                                                <button type="button" class="agreeButton" onclick="clearCanvas()">Clear Signature</button>
                                            </label>
                                            <canvas id="signatureCanvas"></canvas>
                                        </div>
                                        <div class="mt-3 sm:mt-0 form__field">
                                            <button type="button" class="previousButton" onclick="previousTab()">Previous</button>
                                        </div>
                                    </div>                            
                                </div> -->
                            
                            </div>
                            <!-- <div class="sm:d-grid sm:grid-col-12 sm:mt-3 hidden">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button onclick="showTabInPatientConsent(0)" class="nav-link active" id="nav-patientCoverLetter-tab" data-bs-toggle="tab" data-bs-target="#nav-patientCoverLetter" type="button" role="tab" aria-controls="nav-patientCoverLetter" aria-selected="true">Patient Cover Letter</button>
                                        <button onclick="showTabInPatientConsent(1)" class="nav-link" id="nav-patientAgreement-tab" data-bs-toggle="tab" data-bs-target="#nav-patientAgreement" type="button" role="tab" aria-controls="nav-patientAgreement" aria-selected="false">Patient Agreement</button>
                                        <button onclick="showTabInPatientConsent(2)" class="nav-link" id="nav-signOff-tab" data-bs-toggle="tab" data-bs-target="#nav-signOff" type="button" role="tab" aria-controls="nav-signOff" aria-selected="false">signOff</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-patientCoverLetter" role="tabpanel" aria-labelledby="nav-patientCoverLetter-tab">
                                        <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                                            <div class="mt-3 sm:mt-0 form__field">
                                                <iframe src="/files/EV_MD_For_Patients_Agreement1_PatientCoverLetter.pdf#toolbar=0&amp;navpanes=0&amp;scrollbar=0" class="">                                    
                                                </iframe>
                                            </div>
                                            <div class="mt-3 sm:mt-0 form__field">
                                                <button type="button" onclick="nextTabInPatientConsent()">Agree & Proceed</button>
                                            </div>
                                        </div>                                
                                    </div>
                                    <div class="tab-pane fade" id="nav-patientAgreement" role="tabpanel" aria-labelledby="nav-patientAgreement-tab">
                                        <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                                            <div class="mt-3 sm:mt-0 form__field">
                                                <iframe src="/files/EV_MD_For_Patients_Agreement_1_Patient_Agreement.pdf#toolbar=0&amp;navpanes=0&amp;scrollbar=0" class="">                                    
                                                </iframe>
                                                <button type="button" onclick="nextTabInPatientConsent()">Agree & Proceed</button>
                                            </div>
                                        </div>                                
                                    </div>
                                    <div class="tab-pane fade" id="nav-signOff" role="tabpanel" aria-labelledby="nav-signOff-tab">
                                        <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                                            <div class="mt-3 sm:mt-0 form__field">
                                                <label for="first-name">
                                                    Digital signature* (If unknown, please list unknown)
                                                    <span data-required="true" aria-hidden="true"> By signing below you confirm that you have <strong>read and agree to all the previous documents</span>
                                                </label>
                                                <canvas id="signatureCanvas"></canvas>
                                                <br>
                                                <button type="button" onclick="clearCanvas()">Clear Signature</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                                <button type="button" class="mt-1 sm:mt-0 btn btn-secondary btn-fw" data-action="prev">
                                Back
                                </button>
                            </div>
                        </section>
                        <!-- / End Step 5 -->

                        <!-- Step 6 -->
                        <!-- <section id="progress-form__panel-6" role="tabpanel" aria-labelledby="progress-form__tab-6" tabindex="0" hidden>
                            <div class="mt-3 form__field">
                            <h4>Pay $500 retainer<br/><br/></h4>
                            </div>
                            <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                <div class="mt-3 sm:mt-0 form__field">                                    
                                    <form action="#" method="POST">
                                        @csrf
                                        <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="{{ env('STRIPE_KEY') }}"
                                            data-amount="50000"
                                            data-name="MD For Patients"
                                            data-description="Payment for consulation fee   "
                                            data-image="/dist/assets/images/logo-mini.png"
                                            data-locale="auto"
                                            data-currency="usd">
                                        </script>
                                    </form> -->
                                <!-- </div>
                                <div class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                                <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
                                Back
                                </button>
                                <button type="button" data-action="next" class="continueButton">
                                Continue
                                </button>
                            </div>
                            </div>
                        </section> -->
                        <!-- / End Step 6 -->

                        <!-- Step 7 -->
                        <section id="progress-form__panel-7" role="tabpanel" aria-labelledby="progress-form__tab-7" tabindex="0" hidden>
                            <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                                <div class="mt-3 form__field">
                                    <h3>UPLOAD MEDICAL DOCUMENTS<br></h3>
                                    <h4>These may include: medical imaging or digital pathology, radiology or pathology reports, exam or office notes, other medical reports, videos or pictures of symptoms, etc.</h4>
                                </div>
                            </div>
                            <div class="sm:d-grid sm:grid-col-12 sm:mt-3 dropzone" id="myDropzone">                                    
                                <div class="mt-3 form__field">
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
                                    <script>
                                        Dropzone.autoDiscover = false;

                                        var myDropzone = new Dropzone("#myDropzone", {
                                            url: "upload.php",
                                            autoProcessQueue: false,
                                            addRemoveLinks: true,
                                            maxFiles: 10,
                                            init: function() {
                                                this.on("addedfile", function() {
                                                    if (this.files.length > 0) {
                                                        document.getElementById('confirmUploadBtn').disabled = false;
                                                    }
                                                });

                                                this.on("removedfile", function() {
                                                    if (this.files.length === 0) {
                                                        document.getElementById('confirmUploadBtn').disabled = true;
                                                    }
                                                });

                                                this.on("complete", function(file) {
                                                    // Handle file complete event (optional)
                                                });
                                            }
                                        });

                                        document.getElementById('confirmUploadBtn').addEventListener('click', function() {
                                            myDropzone.processQueue(); // Manually process the queue
                                        });
                                    </script>      
                                </div>        
                            </div>
                            <div class="mt-3 form__field">
                                <button id="confirmUploadBtn" class="agreeButton" disabled>Confirm Upload</button>
                            </div> 
                            
                            <div class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                                <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
                                Back
                                </button>
                                <button type="button" data-action="next" class="continueButton" id="submitBtn">
                                Submit Your Application
                                </button>
                            </div>
                        </section>
                        <!-- / End Step 7 -->

                        <!-- Thank You -->
                        <section id="progress-form__thank-you" hidden>
                        <p>Thank you for your submission!</p>
                        <p>We appreciate you contacting us. One of our team members will get back to you very&nbsp;soon.</p>
                        </section>
                        <!-- / End Thank You -->

                    </form>
                    <!-- / End Progress Form -->
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-lg-2"></div>
        </div>
    </div>
    
    <!-- content-wrapper ends -->
    @include("footer")
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>

<script>
    console.clear();

    function ready(fn) {
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
        setTimeout(fn, 1);
        document.removeEventListener('DOMContentLoaded', fn);
    } else {
        document.addEventListener('DOMContentLoaded', fn);
    }
    }

    ready(function() {

    // Global Constants

    const progressForm = document.getElementById('progress-form');

    const tabItems  = progressForm.querySelectorAll('[role="tab"]')
        , tabPanels = progressForm.querySelectorAll('[role="tabpanel"]');

    let currentStep = 0;

    // Form Validation

    /*****************************************************************************
     * Expects a string.
     *
     * Returns a boolean if the provided value *reasonably* matches the pattern
     * of a US phone number. Optional extension number.
     */

    const isValidPhone = val => {
        const regex = new RegExp(/^[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?$/);

        return regex.test(val);
    };

    /*****************************************************************************
     * Expects a string.
     *
     * Returns a boolean if the provided value *reasonably* matches the pattern
     * of a real email address.
     *
     * NOTE: There is no such thing as a perfect regular expression for email
     *       addresses; further, the validity of an email address cannot be
     *       verified on the front end. This is the closest we can get without
     *       our own service or a service provided by a third party.
     *
     * RFC 5322 Official Standard: https://emailregex.com/
     */

    const isValidEmail = val => {
        const regex = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);

        return regex.test(val);
    };

    /*****************************************************************************
     * Expects a Node (input[type="text"] or textarea).
     */

    const validateText = field => {
        const val = field.value.trim();

        if (val === '' && field.required) {
        return {
            isValid: false
        };
        } else {
        return {
            isValid: true
        };
        }
    };

    /*****************************************************************************
     * Expects a Node (input[type="date"]).
     */

     const validateDate = field => {
        const val = field.value.trim();

        if (val === '' && field.required) {
        return {
            isValid: false
        };
        } else {
        return {
            isValid: true
        };
        }
    };

    /*****************************************************************************
     * Expects a Node (select).
     */

    const validateSelect = field => {
        const val = field.value.trim();

        if (val === '' && field.required) {
        return {
            isValid: false,
            message: 'Please select an option from the dropdown menu.'
        };
        } else {
        return {
            isValid: true
        };
        }
    };

    /*****************************************************************************
     * Expects a Node (fieldset).
     */

    const validateGroup = fieldset => {
        const choices = fieldset.querySelectorAll('input[type="radio"], input[type="checkbox"]');

        let isRequired = false
        , isChecked  = false;

        for (const choice of choices) {
        if (choice.required) {
            isRequired = true;
        }

        if (choice.checked) {
            isChecked = true;
        }
        }
        
        if (!isChecked && isRequired) {
        return {
            isValid: false,
            message: 'Please make a selection.'
        };
        } else {
        return {
            isValid: true
        };
        }
    };

    /*****************************************************************************
     * Expects a Node (input[type="radio"] or input[type="checkbox"]).
     */

    const validateChoice = field => {
        console.log(field.closest('fieldset'));
        return validateGroup(field.closest('fieldset'));
    };

    /*****************************************************************************
     * Expects a Node (input[type="tel"]).
     */

    const validatePhone = field => {
        const val = field.value.trim();

        if (val === '' && field.required) {
        return {
            isValid: false
        };
        } else if (val !== '' && !isValidPhone(val)) {
        return {
            isValid: false,
            message: 'Please provide a valid US phone number.'
        };
        } else {
        return {
            isValid: true
        };
        }
    };

    /*****************************************************************************
     * Expects a Node (input[type="email"]).
     */

    const validateEmail = field => {
        const val = field.value.trim();

        if (val === '' && field.required) {
        return {
            isValid: false
        };
        } else if (val !== '' && !isValidEmail(val)) {
        return {
            isValid: false,
            message: 'Please provide a valid email address.'
        };
        } else {
        return {
            isValid: true
        };
        }
    };

    /*****************************************************************************
     * Expects a Node (field or fieldset).
     *
     * Returns an object describing the field's overall validity, as well as
     * a possible error message where additional information may be helpful for
     * the user to complete the field.
     */

    const getValidationData = field => {
        switch (field.type) {
        case 'text':
        case 'textarea':
            return validateText(field);
        case 'select-one':
            return validateSelect(field);
        case 'fieldset':
            return validateGroup(field);
        case 'radio':
        case 'checkbox':
            return validateChoice(field);
        case 'tel':
            return validatePhone(field);
        case 'email':
            return validateEmail(field);
        case 'date':
            return validateDate(field);  
        case  'hidden': return {
            isValid: true
        };
        default:
            throw new Error(`The provided field type '${field.tagName}:${field.type}' is not supported in this form.`);
        }
    };

    /*****************************************************************************
     * Expects a Node (field or fieldset).
     *
     * Returns the field's overall validity based on conditions set within
     * `getValidationData()`.
     */

    const isValid = field => {
        return getValidationData(field).isValid;
    };

    /*****************************************************************************
     * Expects an integer.
     *
     * Returns a promise that either resolves if all fields in a given step are
     * valid, or rejects and returns invalid fields for further processing.
     */

    const validateStep = currentStep => {
        const fields = tabPanels[currentStep].querySelectorAll('fieldset, input:not([type="radio"]):not([type="checkbox"]), select, textarea');

        // Skip validation for steps 5 and 6
        if (currentStep === 5 || currentStep === 6) {
            return Promise.resolve();
        }

        const invalidFields = [...fields].filter(field => {
        return !isValid(field);
        });

        return new Promise((resolve, reject) => {
        if (invalidFields && !invalidFields.length) {
            resolve();
        } else {
            reject(invalidFields);
        }
        });
    };

    // Form Error and Success

    const FIELD_PARENT_CLASS = 'form__field'
        , FIELD_ERROR_CLASS  = 'form__error-text';

    /*****************************************************************************
     * Expects a Node (fieldset) that contains any number of radio or checkbox
     * input elements, and a string representing the group's validation status.
     */

    function updateChoice(fieldset, status, errorId = '') {
        const choices = fieldset.querySelectorAll('[type="radio"], [type="checkbox"]');

        for (const choice of choices) {
        if (status) {
            choice.setAttribute('aria-invalid', 'true');
            choice.setAttribute('aria-describedby', errorId);
        } else {
            choice.removeAttribute('aria-invalid');
            choice.removeAttribute('aria-describedby');
        }
        }
    }

    /*****************************************************************************
     * Expects a Node (field or fieldset) that either has the class name defined
     * by `FIELD_PARENT_CLASS`, or has a parent with that class name. Optional
     * string defines the error message.
     *
     * Builds and appends an error message to the parent element, or updates an
     * existing error message.
     *
     * https://www.davidmacd.com/blog/test-aria-describedby-errormessage-aria-live.html
     */

    function reportError(field, message = 'Please complete this required field.') {
        const fieldParent = field.closest(`.${FIELD_PARENT_CLASS}`);

        if (progressForm.contains(fieldParent)) {
        let fieldError   = fieldParent.querySelector(`.${FIELD_ERROR_CLASS}`)
            , fieldErrorId = '';

        if (!fieldParent.contains(fieldError)) {
            fieldError = document.createElement('p');

            if (field.matches('fieldset')) {
            fieldErrorId = `${field.id}__error`;

            updateChoice(field, true, fieldErrorId);
            } else if (field.matches('[type="radio"], [type="checkbox"]')) {
            fieldErrorId = `${field.closest('fieldset').id}__error`;

            updateChoice(field.closest('fieldset'), true, fieldErrorId);
            } else {
            fieldErrorId = `${field.id}__error`;

            field.setAttribute('aria-invalid', 'true');
            field.setAttribute('aria-describedby', fieldErrorId);
            }

            fieldError.id = fieldErrorId;
            fieldError.classList.add(FIELD_ERROR_CLASS);

            fieldParent.appendChild(fieldError);
        }

        fieldError.textContent = message;
        }
    }

    /*****************************************************************************
     * Expects a Node (field or fieldset) that either has the class name defined
     * by `FIELD_PARENT_CLASS`, or has a parent with that class name.
     *
     * https://www.davidmacd.com/blog/test-aria-describedby-errormessage-aria-live.html
     */

    function reportSuccess(field) {
        const fieldParent = field.closest(`.${FIELD_PARENT_CLASS}`);

        if (progressForm.contains(fieldParent)) {
        const fieldError = fieldParent.querySelector(`.${FIELD_ERROR_CLASS}`);

        if (fieldParent.contains(fieldError)) {
            if (field.matches('fieldset')) {
            updateChoice(field, false);
            } else if (field.matches('[type="radio"], [type="checkbox"]')) {
            updateChoice(field.closest('fieldset'), false);
            } else {
            field.removeAttribute('aria-invalid');
            field.removeAttribute('aria-describedby');
            }

            fieldParent.removeChild(fieldError);
        }
        }
    }

    /*****************************************************************************
     * Expects a Node (field or fieldset).
     *
     * Reports the field's overall validity to the user based on conditions set
     * within `getValidationData()`.
     */

    function reportValidity(field) {
        const validation = getValidationData(field);

        if (!validation.isValid && validation.message) {
        reportError(field, validation.message);
        } else if (!validation.isValid) {
        reportError(field);
        } else {
        reportSuccess(field);
        }
    }

    // Form Progression

    /*****************************************************************************
     * Resets the state of all tabs and tab panels.
     */

    function deactivateTabs() {
        // Reset state of all tab items
        tabItems.forEach(tab => {
        tab.setAttribute('aria-selected', 'false');
        tab.setAttribute('tabindex', '-1');
        });

        // Reset state of all panels
        tabPanels.forEach(panel => {
        panel.setAttribute('hidden', '');
        });
    }

    /*****************************************************************************
     * Expects an integer.
     *
     * Shows the desired tab and its associated tab panel, then updates the form's
     * current step to match the tab's index.
     */

    function activateTab(index) {
        console.log(tabPanels);
        const thisTab   = tabItems[index]
            , thisPanel = tabPanels[index];

        // Close all other tabs
        deactivateTabs();

        // Focus the activated tab for accessibility
        thisTab.focus();

        // Set the interacted tab to active
        thisTab.setAttribute('aria-selected', 'true');
        thisTab.removeAttribute('tabindex');

        // Display the associated tab panel
        thisPanel.removeAttribute('hidden');

        // Update the current step with the interacted tab's index value
        currentStep = index;
    }

    /*****************************************************************************
     * Expects an event from a click listener.
     */

    function clickTab(e) {
        activateTab([...tabItems].indexOf(e.currentTarget));
    }

    /*****************************************************************************
     * Expects an event from a keydown listener.
     */

    function arrowTab(e) {
        const { keyCode, target } = e;

        /**
         * If the current tab has an enabled next/previous sibling, activate it.
         * Otherwise, activate the tab at the beginning/end of the list.
         */

        const targetPrev  = target.previousElementSibling
            , targetNext  = target.nextElementSibling
            , targetFirst = target.parentElement.firstElementChild
            , targetLast  = target.parentElement.lastElementChild;

        const isDisabled = node => node.hasAttribute('aria-disabled');

        switch (keyCode) {
        case 37: // Left arrow
            if (progressForm.contains(targetPrev) && !isDisabled(targetPrev)) {
            activateTab(currentStep - 1);
            } else if (!isDisabled(targetLast)) {
            activateTab(tabItems.length - 1);
            } break;
        case 39: // Right arrow
            if (progressForm.contains(targetNext) && !isDisabled(targetNext)) {
            activateTab(currentStep + 1);
            } else if (!isDisabled(targetFirst)) {
            activateTab(0);
            } break;
        }
    }

    /*****************************************************************************
     * Expects a boolean.
     *
     * Updates the visual state of the progress bar and makes the next tab
     * available for interaction (if there is a next tab).
     */

    // Immediately attach event listeners to the first tab (happens only once)
    tabItems[0].addEventListener('click', clickTab);
    tabItems[0].addEventListener('keydown', arrowTab);

    function handleProgress(isComplete) {
        const currentTab = tabItems[currentStep]
            , nextTab    = tabItems[currentStep + 1];

        if (isComplete) {
        currentTab.setAttribute('data-complete', 'true');

        /**
         * Verify that there is, indeed, a next tab before modifying or listening
         * to it. In case we've reached the last item in the tablist.
         */

        if (progressForm.contains(nextTab)) {
            nextTab.removeAttribute('aria-disabled');

            nextTab.addEventListener('click', clickTab);
            nextTab.addEventListener('keydown', arrowTab);
        }

        } else {
        currentTab.setAttribute('data-complete', 'false');
        }
    }

    // Form Interactions

    /*****************************************************************************
     * Returns a function that only executes after a delay.
     *
     * https://davidwalsh.name/javascript-debounce-function
     */

    const debounce = (fn, delay = 500) => {
        let timeoutID;

        return (...args) => {
        if (timeoutID) {
            clearTimeout(timeoutID);
        }

        timeoutID = setTimeout(() => {
            fn.apply(null, args);
            timeoutID = null;
        }, delay);
        };
    };

    /*****************************************************************************
     * Waits 0.5s before reacting to any input events. This reduces the frequency
     * at which the listener is fired, making the errors less "noisy". Improves
     * both performance and user experience.
     */

    progressForm.addEventListener('input', debounce(e => {
        const { target } = e;

        validateStep(currentStep).then(() => {

        // Update the progress bar (step complete)
        handleProgress(true);

        }).catch(() => {

        // Update the progress bar (step incomplete)
        handleProgress(false);

        });

        // Display or remove any error messages
        reportValidity(target);
    }));

    /****************************************************************************/

    progressForm.addEventListener('click', e => {
        const { target } = e;

        if (target.matches('[data-action="next"]')) {
        validateStep(currentStep).then(() => {
            // Update the progress bar (step complete)
            handleProgress(true);
            // Progress to the next step
            activateTab(currentStep + 1);

        }).catch(invalidFields => {
            // Update the progress bar (step incomplete)
            handleProgress(false);

            // Show errors for any invalid fields
            if (invalidFields!=null && Array.isArray(invalidFields)) {
                // Show errors for any invalid fields
                invalidFields.forEach(field => {
                    reportValidity(field);
                });

                // Focus the first found invalid field for the user
                invalidFields[0].focus();
            } 
        });
        }

        if (target.matches('[data-action="prev"]')) {

        // Revisit the previous step
        activateTab(currentStep - 1);

        }
    });

    // Form Submission

    /*****************************************************************************
     * Returns the user's IP address.
     */

    async function getIP(url = 'https://api.ipify.org?format=json') {
        const response = await fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
        });

        if (!response.ok) {
        throw new Error(response.statusText);
        }

        return response.json();
    }

    /*****************************************************************************
     * POSTs to the specified endpoint.
     */

    async function postData(url = '', data = {}) {
        const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
        });

        if (!response.ok) {
        throw new Error(response.statusText);
        }

        return response.json();
    }

    /****************************************************************************/

    function disableSubmit() {
        const submitButton = progressForm.querySelector('[type="submit"]');

        if (progressForm.contains(submitButton)) {

        // Update the state of the submit button
        submitButton.setAttribute('disabled', '');
        submitButton.textContent = 'Submitting...';

        }
    }

    /****************************************************************************/

    function handleSuccess(response) {
        const thankYou = progressForm.querySelector('#progress-form__thank-you');

        // Clear all HTML Nodes that are not the thank you panel
        while (progressForm.firstElementChild !== thankYou) {
        progressForm.removeChild(progressForm.firstElementChild);
        }

        thankYou.removeAttribute('hidden');

        // Logging the response from httpbin for quick verification
        //console.log(response);
    }

    /****************************************************************************/

    function handleError(error) {
        const submitButton = progressForm.querySelector('[type="submit"]');

        if (progressForm.contains(submitButton)) {
        const errorText = document.createElement('p');

        // Reset the state of the submit button
        submitButton.removeAttribute('disabled');
        submitButton.textContent = 'Submit';

        // Display an error message for the user
        errorText.classList.add('m-0', 'form__error-text');
        errorText.textContent = `Sorry, your submission could not be processed.
            Please try again. If the issue persists, please contact our support
            team. Error message: ${error}`;

        submitButton.parentElement.prepend(errorText);
        }
    }

    /****************************************************************************/

    progressForm.addEventListener('submit', e => {

        // Prevent the form from submitting
        e.preventDefault();

        // Get the API endpoint using the form action attribute
        const form = e.currentTarget
            , API  = new URL(form.action);

        validateStep(currentStep).then(() => {

        // Indicate that the submission is working
        disableSubmit();

        // Prepare the data
        const formData   = new FormData(form)
            , formTime   = new Date().getTime()
            , formFields = [];

        // Format the data entries
        for (const [name, value] of formData) {
            formFields.push({
            'name': name,
            'value': value
            });
        }

        // Get the user's IP address (for fun)
        // Build the final data structure, including the IP
        // POST the data and handle success or error
        getIP().then(response => {
            return {
            'fields': formFields,
            'meta': {
                'submittedAt': formTime,
                'ipAddress': response.ip
            }
            };
        })
        .then(data => postData(API, data))
        .then(response => {
            setTimeout(() => {
            handleSuccess(response)
            }, 5000); // An artificial delay to show the state of the submit button
        })
        .catch(error => {
            setTimeout(() => {
            handleError(error)
            }, 5000); // An artificial delay to show the state of the submit button
        });

        }).catch(invalidFields => {

        // Show errors for any invalid fields
        invalidFields.forEach(field => {
            reportValidity(field);
        });

        // Focus the first found invalid field for the user
        if (invalidFields!=null && Array.isArray(invalidFields)) {
            invalidFields[0].focus();
        }

        });
    });
    });
</script>
<script>

    // Function to check the state of all checkboxes and enable/disable the submit button
    function updateSubmitButtonState() {
        const checkboxes = document.querySelectorAll('.patientAgreement');
        let allChecked = true;

        checkboxes.forEach(checkbox => {
            if (!checkbox.checked) {
                allChecked = false;
            }
        });

        // Enable button if all checkboxes are checked
        const submitBtn = document.getElementById('btnPatientAgreementConfirm');
        if (allChecked) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }

    // Add event listeners to each checkbox
    document.querySelectorAll('.patientAgreement').forEach(checkbox => {
        checkbox.addEventListener('change', updateSubmitButtonState);
    });

    let currentTab = 0;
    document.addEventListener("DOMContentLoaded", function () {
        showTab(currentTab);
    });

    function showTab(n) {
        let tabs = document.getElementsByClassName("tab");
        let tabButtons = document.getElementsByClassName("tab-button");
        for (let i = 0; i < tabs.length; i++) {
            tabs[i].style.display = "none";
            tabButtons[i].classList.remove("active");
        }
        tabs[n].style.display = "block";
        tabButtons[n].classList.add("active");

        if (n === 2) {
            document.getElementById("submitBtn").classList.remove("hidden");
        } else {
            document.getElementById("submitBtn").classList.add("hidden");
        }
    }

    function enableTabButton(tabIndex) {
        document.getElementById(`tabButton${tabIndex}`).style.pointerEvents = "auto";
        document.getElementById(`tabButton${tabIndex}`).style.opacity = "1";
    }

    // Enable tab buttons when the "Agree & Proceed" button is clicked
    function enableTabButtons() {
        for (let i = 0; i <= currentTab; i++) {
            enableTabButton(i);
        }
    }

    // Next tab function to advance to the next tab and enable previously visited tabs
    function nextTab() {
        let tabs = document.getElementsByClassName("tab");
        if (currentTab < tabs.length - 1) {
            currentTab++;
            showTab(currentTab);
            enableTabButtons();
        }
    }

    // Previous tab function to go back to the previous tab
    function previousTab() {
        if (currentTab > 0) {
            currentTab--;
            showTab(currentTab);
        }
    }

    // Function to go to a specific tab
    function goToTab(n) {
        if (document.getElementById(`tabButton${n}`).style.pointerEvents === "auto") {
            currentTab = n;
            showTab(currentTab);
        }
    }

    // const canvas = document.getElementById('signatureCanvas');
    // const ctx = canvas.getContext('2d');
    // let drawing = false;

    // // Resize canvas
    // function resizeCanvas() {
    //     canvas.width = window.innerWidth * 0.8;
    //     canvas.height = 200;
    // }
    // window.addEventListener('resize', resizeCanvas);
    // resizeCanvas();

    // // Start drawing
    // canvas.addEventListener('mousedown', (event) => {
    //     drawing = true;
    //     ctx.beginPath();
    //     ctx.moveTo(event.offsetX, event.offsetY);
    // });

    // // Drawing
    // canvas.addEventListener('mousemove', (event) => {
    //     if (drawing) {
    //         ctx.lineTo(event.offsetX, event.offsetY);
    //         ctx.stroke();
    //     }
    // });

    // // Stop drawing
    // canvas.addEventListener('mouseup', () => {
    //     drawing = false;
    // });

    // // Touch events for mobile devices
    // canvas.addEventListener('touchstart', (event) => {
    //     event.preventDefault();
    //     drawing = true;
    //     const touch = event.touches[0];
    //     const mouseEvent = new MouseEvent('mousedown', {
    //         clientX: touch.clientX,
    //         clientY: touch.clientY
    //     });
    //     canvas.dispatchEvent(mouseEvent);
    // });

    // canvas.addEventListener('touchmove', (event) => {
    //     event.preventDefault();
    //     const touch = event.touches[0];
    //     const mouseEvent = new MouseEvent('mousemove', {
    //         clientX: touch.clientX,
    //         clientY: touch.clientY
    //     });
    //     canvas.dispatchEvent(mouseEvent);
    // });

    // canvas.addEventListener('touchend', (event) => {
    //     event.preventDefault();
    //     drawing = false;
    // });

    // // Clear canvas
    // function clearCanvas() {
    //     ctx.clearRect(0, 0, canvas.width, canvas.height);
    // }

    document.querySelectorAll('#continueButton').forEach(checkbox => {
        checkbox.addEventListener('change', updateSubmitButtonState);
    });
    $("#continueButton").on("click", function() {
        // Perform your desired action here
    });
    $(document).ready(function() {
        //  $("#continueButton").on("blur", function() {
        //     // Validate the email and confirm email fields
        //     var valid = true;
        //     console.log(valid);
        //      if ($("#confirm_email_step1").val() !== $("#email_step1").val()) {
        //         $('#continueButton').prop('disabled', true);
        //         $("#confirm_email_step1").next("p.form__error-text").remove();
        //         $("#confirm_email_step1").after('<p class="form__error-text">Email addresses must match.</p>');
        //         valid = false;
        //     }else{
        //         $('#continueButton').prop('disabled', false);

        //     }
 
        // });

    let typingTimer;
    let doneTypingInterval = 1000; // time in ms (1 second)

    // on keyup, start the countdown
    $('#email_step1, #confirm_email_step1').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    // on keydown, clear the countdown
    $('#email_step1, #confirm_email_step1').on('keydown', function() {
        clearTimeout(typingTimer);
    });

    // user is "finished typing," do something
    function doneTyping() {
        // Get the values of the email fields
        let email = $('#email_step1').val();
        let confirmEmail = $('#confirm_email_step1').val();
        if(confirmEmail != ""){
        // Check if the emails match
        if (email !== confirmEmail) {
            $('#emailMatchMessage').show();
            $('#emailMatchMessage').addClass('form__error-text');
            $('#continueButton').prop('disabled', true);
        } else {
            $('#emailMatchMessage').hide();
            $('#emailMatchMessage').removeClass('form__error-text');
            $('#continueButton').prop('disabled', false);
        }
        }

    }
    });

    $(document).ready(function() {
    // Function to show/hide fields based on the selected relationship
    function toggleFields() {
        var relationship = $('#relationship_to_patient').val();

        // Hide all fields initially
        $('#relationship_first_name, #relationship_last_name, #relationship_npi, #relationship_street_address, #relationship_city, #relationship_postal_code, #relationship_countries, #relationship_states, #relationship_email, #relationship_confirm_email, #relationship_phone_number, #relationship_institution, #relationship_fax_no, #relationship_preferred_mode_of_communication, #relationship_preferred_contact_time, #relationship_other').closest('.form__field').hide();

        $('#relationship_email').removeAttr('required');
            $('#relationship_confirm_email').removeAttr('required');
            $('#relationship_phone_number').removeAttr('required');
            $('#phoneRadio').removeAttr('required');
            $('#emailRadio').removeAttr('required');
            $('#relationship_first_name').removeAttr('required');
            $('#relationship_last_name').removeAttr('required');
            $('#relationship_other').removeAttr('required');

        if (relationship === 'Patient') {
            // Show specific fields for 'Patient'
            $('#relationship_email, #relationship_confirm_email, #relationship_phone_number, #relationship_preferred_mode_of_communication, #relationship_preferred_contact_time').closest('.form__field').show();
            $('#relationship_email').attr('required', 'required');
            $('#relationship_confirm_email').attr('required', 'required');
            $('#relationship_phone_number').attr('required', 'required');
            $('#phoneRadio').attr('required', 'required');
            $('#emailRadio').attr('required', 'required');

        } else if (relationship === 'Caregiver' || relationship === 'Parent' || relationship === 'Legal Guardian') {
            // Show specific fields for 'Caregiver'
            $('#relationship_first_name, #relationship_last_name, #relationship_email, #relationship_confirm_email, #relationship_phone_number, #relationship_preferred_mode_of_communication, #relationship_preferred_contact_time').closest('.form__field').show();
            $('#relationship_email').attr('required', 'required');
            $('#relationship_confirm_email').attr('required', 'required');
            $('#relationship_phone_number').attr('required', 'required');
            $('#relationship_first_name').attr('required', 'required');
            $('#relationship_last_name').attr('required', 'required');
            $('#phoneRadio').attr('required', 'required');
            $('#emailRadio').attr('required', 'required');

        }else if(relationship === 'Referring or local physician'){
            $('#relationship_first_name, #relationship_last_name, #relationship_email,#relationship_npi,#relationship_countries,#relationship_states,#relationship_postal_code, #relationship_street_address, #relationship_confirm_email, #relationship_phone_number, #relationship_preferred_mode_of_communication, #relationship_preferred_contact_time, #relationship_institution,#relationship_fax_no, #relationship_city').closest('.form__field').show();
            $('#relationship_email').attr('required', 'required');
            $('#relationship_confirm_email').attr('required', 'required');
            $('#relationship_phone_number').attr('required', 'required');
            $('#relationship_first_name').attr('required', 'required');
            $('#relationship_last_name').attr('required', 'required');
            $('#phoneRadio').attr('required', 'required');
            $('#emailRadio').attr('required', 'required');
        }else if(relationship === 'Other'){
             // Show specific fields for 'Caregiver'
             $('#relationship_first_name, #relationship_last_name, #relationship_email, #relationship_confirm_email, #relationship_phone_number, #relationship_preferred_mode_of_communication, #relationship_preferred_contact_time, #relationship_other').closest('.form__field').show();
            $('#relationship_email').attr('required', 'required');
            $('#relationship_confirm_email').attr('required', 'required');
            $('#relationship_phone_number').attr('required', 'required');
            $('#relationship_first_name').attr('required', 'required');
            $('#relationship_last_name').attr('required', 'required');
            $('#relationship_other').attr('required', 'required');
            $('#phoneRadio').attr('required', 'required');
            $('#emailRadio').attr('required', 'required');
        }
    }

    // Trigger the function on page load and when the relationship select changes
    toggleFields();
    $('#relationship_to_patient').change(toggleFields);
});



</script>

</script>
<script src="{{ mix('js/patient.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    document.getElementById('btnPatientAgreementConfirm').addEventListener('click', function() {
        // Get user confirmation
        if (confirm('Are you sure you want to proceed with the payment?')) {
            // Initialize Stripe with your publishable key
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');

            // Make a request to your backend to create a Checkout Session
            fetch("{{ route('create-checkout-session') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(session) {
                // Redirect to Stripe Checkout
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    alert(result.error.message);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
        }
    });
</script>
@endsection