@extends("layoutView")
@section("content")
<div id="loading-screen" style="display: none;" class="fullScreenLoader">
    <div class="loading-icon">
        <img src="/dist/assets/images/loader.gif" />
    </div>
</div>
<div class="">
    <div class="">
        <div class="row">
            <div class="d-lg-none d-xl-block col-xl-2"></div>
            <div class="col-lg-12 col-xl-8 px-xl-0">
                <div class="containerHeader">
                    <div class="titleHeader">Expert Opinion Request</div>
                    <div class="alertHeader">If this is a time-sensitive or urgent request, please contact 911 or seek local medical care as appropriate.</div>
                </div>
                <br/>
            </div>
            <div class="d-lg-none d-xl-block col-xl-2"></div>
        </div>
        <div class="row">
            <div class="d-lg-none d-xl-block col-xl-2"></div>
            <div class="col-lg-12 col-xl-8 px-xl-0">                
                <div class="">
                    <!-- Progress Form -->
                    <form id="progress-form" class="progress-form rounded-bottom-0" action="#" lang="en" novalidate type="post">
                    <!-- Step Navigation -->
                    
                        <div class="d-flex align-items-start p-0 progress-form__tabs step-container" role="tablist">
                            <button id="progress-form__tab-1" class="col m-0 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-1" aria-selected="true" aria-disabled="true" data-complete="true">
                                <div class="step-number">1</div>
                                <div>Patient Details</div>
                            </button>
                            <button id="progress-form__tab-2" class="col m-0 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-2" aria-selected="false" tabindex="-1" aria-disabled="true" data-complete="true">
                                <div class="step-number">2</div>
                                <div>Contact Party</div>
                            </button>
                            <button id="progress-form__tab-3" class="col m-0 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-3" aria-selected="false" tabindex="-1" aria-disabled="true" data-complete="true">
                                    <div class="step-number">3</div><div>Patient's Physician</div>                               
                            </button>
                            <button id="progress-form__tab-4" class="col m-0 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-4" aria-selected="false" tabindex="-1" aria-disabled="true" data-complete="true">
                                <div class="step-number">4</div><div>Primary Concern</div>                                
                            </button>                            
                            <button id="progress-form__tab-5" class="col m-0 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-5" aria-selected="false" tabindex="-1" aria-disabled="true" data-complete="true">
                                <div class="step-number">5</div><div>Consent & Payment</div>                                
                            </button>
                            <button id="progress-form__tab-6" class="col m-0 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-6" aria-selected="false" tabindex="-1" aria-disabled="true" data-complete="true">
                                <div class="step-number">6</div><div>Payment Details</div>                            
                            </button>
                            <button id="progress-form__tab-7" class="col m-0 progress-form__tabs-item step" type="button" role="tab" aria-controls="progress-form__panel-7" aria-selected="false" tabindex="-1" aria-disabled="true" data-complete="true" >
                                <div class="step-number">7</div><div>Medical Document</div>                            
                            </button>                            
                        </div>
                        <!-- / End Step Navigation -->

                        <!-- Step 1 -->
                        <section id="progress-form__panel-1" role="tabpanel" aria-labelledby="progress-form__tab-1" tabindex="0">
                            <div class="p-5 mx-3">
                            <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="first-name">
                                        First Name
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="first-name" type="text" name="firstname" autocomplete="given-name" required value="{{$patientDetails->first_name}}">
                                    </div>

                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="first-name">
                                        Middle Name
                                    </label>
                                    <input disabled  id="middle-name" type="text" name="middlename" autocomplete="given-name" value="{{$patientDetails->middle_name}}">
                                    </div>

                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="last-name">
                                        Last Name
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="last-name" type="text" name="lastname" autocomplete="family-name" required value="{{$patientDetails->last_name}}">
                                    </div>
                                </div>

                                <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="date_of_birth">
                                        Date Of Birth
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="date_of_birth" type="date" name="date_of_birth" autocomplete="given-name" required max="9999-12-31" required value="{{$patientDetails->date_of_birth}}">
                                    </div>
                                </div>

                                <div id="patientMailingAddressHrTag" class="sm:d-grid sm:grid-col-3 sm:mt-3 fw-bold mt-5" >
                                    <div class="left-border-heading">Patient Mailing Address</div>
                                </div>

                                <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                    <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                        <div class="mt-3 sm:mt-0 form__field">
                                        <label for="street_address">
                                            Street Address
                                            <span data-required="true" aria-hidden="true"></span>
                                        </label>
                                        <input disabled  id="street_address" type="text" name="street_address" autocomplete="given-name" required value="{{$patientDetails->street_address}}">
                                        </div>
                                    </div>
                                    <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                        <div class="mt-3 sm:mt-0 form__field">
                                        <label for="City">
                                            City
                                            <span data-required="true" aria-hidden="true"></span>
                                        </label>
                                        <input disabled  id="city" type="text" name="citystep1" autocomplete="given-name" required value="{{$patientDetails->city}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="postal_code">
                                        Postal Code
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="postal_code" type="text" minlength="5" maxlength="6" name="postalcodestep1" autocomplete="given-name" required value="{{$patientDetails->postal_code}}">
                                    </div>
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="Country">
                                        Country
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <select disabled  class="countries" name="countries" id="countries" required>
                                        <option value="">--Select--</option>
                                        @foreach($countries as $country)
                                            <option {{($patientDetails->country==$country['id']) ? 'selected' : null }} value="{{ $country['id'] ?? '' }}" data-country-name="{{ $country['country_name'] ?? '' }}">{{ $country['country_name'] ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    </div>

                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="states">
                                        State
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <select disabled  class="states" name="states" id="states" required>
                                        @foreach($states as $state)
                                            <option {{($patientDetails->state==$state['id']) ? 'selected' : null}} value="{{ $state['id'] ?? '' }}" data-state-name="{{ $state['state_name'] ?? '' }}">{{ $state['state_name'] ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="email">
                                        Email
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled id="email_step1" type="email" name="emailstep1" class ="email" autocomplete="given-name" required value="{{$patientDetails->email}}">
                                    <label id="email-check-result"></label>
                                    </div>

                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="confirm_email">
                                        Confirm Email
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="confirm_email_step1" type="email" name="confirmemailstep1" class="confirm_email" autocomplete="given-name" required value="{{$patientDetails->email}}">
                                    <span id="emailMatchMessage"  style="display: none;">Emails do not match</span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 py-4 text-end border-top mt-4 sm:mt-5">
                                <button type="button" data-action="next" class="step1 btn btn-success rounded" id="continueButton">
                                Next
                                </button>
                            </div>
                        </section>
                        <!-- / End Step 1 -->

                        <!-- Step 2 -->
                        <section id="progress-form__panel-2" role="tabpanel" aria-labelledby="progress-form__tab-2" tabindex="0" hidden>
                            <div class="p-5 mx-3">
                                <div class="mt-3 form__field">
                                <h4 class="fw-bold">This is the party responsible for this case. They may be contacted about patient information, medical records, payment, and the case report as applicable.<br/><br/></h4>
                                </div>
                                <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                    <div class="mt-3 form__field">
                                        <label for="relationship_to_patient">
                                        Select Relationship To The Patient
                                        <span data-required="true" aria-hidden="true"></span>
                                        </label>
                                        <select disabled  id="relationship_to_patient" name="relationship_to_patient" autocomplete="shipping address-level1" required>
                                            <option value="" disabled >Please select</option>
                                            <option value="Patient" @if($contactParty->relationrelationship_to_patient == "Patient") ? 'selected' : null @endif selected>Patient</option>
                                            <option value="Caregiver" @if($contactParty->relationrelationship_to_patient == "Caregiver") ? 'selected' : null @endif>Caregiver</option>
                                            <option value="Referring or local physician" @if ($contactParty->relationrelationship_to_patient == "Referring or local physician") ? 'selected' : null @endif>Referring or local physician</option>
                                            <option value="Parent" @if ($contactParty->relationrelationship_to_patient == "Parent") ? 'selected' : null @endif > Parent</option>
                                            <option value="Legal Guardian" @if($contactParty->relationrelationship_to_patient == "Legal Guardian") ? 'selected' : null @endif>Legal Guardian</option>
                                            <option value="Other" @if($contactParty->relationrelationship_to_patient == "Other") ? 'selected' : null @endif >Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_first_name">
                                        Your First Name
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="relationship_first_name" type="text" name="relationship_first_name" class ="relationship_first_name" value="{{$contactParty->first_name}}">
                                    </div>
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_confirm_email">
                                        Your Last Name
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="relationship_last_name" type="text" name="relationship_last_name" class ="relationship_last_name" value="{{$contactParty->last_name}}">

                                    </div>
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_npi">
                                        NPI
                                    </label>
                                    <input disabled  id="relationship_npi" type="text" name="relationship_npi" value="{{$contactParty->NPI}}">
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_other">
                                        Specify your relationship to the patient
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="relationship_other" type="text" name="relationship_other" class ="relationship_other" value="{{$contactParty->relationship_other}}">
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                    <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                        <div class="mt-3 sm:mt-0 form__field">
                                        <label for="relationship_street_address">
                                            Street Address
                                        </label>
                                        <input disabled  id="relationship_street_address" type="text" name="relationship_street_address" autocomplete="given-name" value="{{$contactParty->street_address}}">
                                        </div>
                                    </div>
                                    <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                        <div class="mt-3 sm:mt-0 form__field">
                                        <label for="relationship_city">
                                            City
                                        </label>
                                        <input disabled  id="relationship_city" type="text" name="relationship_city" autocomplete="given-name" value="{{$contactParty->city}}">
                                        </div>
                                    </div>
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_postal_code">
                                        Postal Code
                                    </label>
                                    <input disabled  id="relationship_postal_code" minlength="5" maxlength="6" type="text" name="relationship_postal_code" autocomplete="given-name" value="{{$contactParty->postal_code}}">
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-3 sm:mt-3">                                
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship__country">
                                        Country
                                    </label>
                                    <select disabled  class="relationship_countries" name="relationship_countries" id="relationship_countries" >
                                        <option value="">--Select--</option>
                                        @foreach($countries as $country)
                                            <option {{($contactParty->country == $country["id"]) ? 'selected' : null}} value="{{ $country['id'] ?? '' }}" data-country-name="{{ $country['country_name'] ?? '' }}">{{ $country['country_name'] ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    </div>

                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_states">
                                        State
                                    </label>
                                    <select disabled  class="relationship_states" name="relationship_states" id="relationship_states" >
                                        @foreach($states as $state)
                                            <option {{($contactParty->state == $state["id"]) ? 'selected' : null}} value="{{ $state['id'] ?? '' }}" data-state-name="{{ $state['state_name'] ?? '' }}">{{ $state['state_name'] ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_email">
                                        Email Address
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="relationship_email" type="email" name="relationship_email" class ="relationship_email"  value="{{$contactParty->email}}">
                                    </div>
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_confirm_email">
                                        Confirm Email
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="relationship_confirm_email" type="email" name="relationship_confirm_email" class ="relationship_confirm_email" value="{{$contactParty->email}}">

                                    </div>
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_phone_number">
                                        Phone Number
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="relationship_phone_number" type="text" name="relationship_phone_number" value="{{$contactParty->phone_number}}">
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_institution">
                                        Institution
                                    </label>
                                    <input disabled  id="relationship_institution" type="text" name="relationship_institution" class ="relationship_institution"  value="{{$contactParty->Instituton}}">
                                    </div>
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="relationship_fax_no">
                                        Fax No.
                                    </label>
                                    <input disabled  id="relationship_fax_no" type="text" name="relationship_fax_no" class ="relationship_fax_no" value="{{$contactParty->fax_number}}">

                                    </div>

                                </div>
                                <div class="sm:d-grid sm:grid-col-3 sm:mt-3">                                
                                    <fieldset class="mt-3 sm:mt-0 form__field ">
                                        <label for="relationship_preferred_mode_of_communication">
                                            Preferred Mode Of Communication
                                            <span data-required="true" aria-hidden="true"></span>
                                        </label>
                                        <div class="d-flex">
                                            <div class="form-check-inline d-flex">
                                                <input disabled  class="form-check-input" type="radio" name="relationship_preferred_mode_of_communication" id="phoneRadio" value="Phone" {{ ($contactParty->preferred_mode_of_communication =='Phone') ? 'checked' : null}}>
                                                <label class="form-check-label pl-1" for="phoneRadio">Phone</label>
                                            </div>
                                            <div class="form-check-inline d-flex pl-2">
                                                <input disabled  class="form-check-input" type="radio" name="relationship_preferred_mode_of_communication" id="emailRadio" value="Email" {{ ($contactParty->preferred_mode_of_communication =='Email') ? 'checked' : null}}>
                                                <label class="form-check-label pl-1" for="emailRadio">Email</label>
                                            </div>  
                                        </div>
                                    </fieldset>
                                
                                    <div class="mt-3 sm:mt-0 form__field">
                                        <label for="relationship_preferred_contact_time">
                                            Preferred Contact Time
                                        </label>  
                                        <div class="d-flex justify-content-between">
                                            <div class=" form-check-inline d-flex">
                                                <input disabled  class="form-check-input" type="radio" name="relationship_preferred_contact_time" id="MorningRadio" value="Morning" {{ ($contactParty->preferred_contact_time =='Morning') ? 'checked' : null}}>
                                                <label class="form-check-label pl-1" for="MorningRadio">Morning</label>
                                            </div>
                                            <div class=" form-check-inline d-flex">
                                                <input disabled  class="form-check-input" type="radio" name="relationship_preferred_contact_time" id="AfternoonRadio" value="Afternoon" {{ ($contactParty->preferred_contact_time =='Afternoon') ? 'checked' : null}}>
                                                <label class="form-check-label pl-1" for="AfternoonRadio">Afternoon</label>
                                            </div> 
                                            
                                            <div class=" form-check-inline d-flex">
                                                <input disabled  class="form-check-input" type="radio" name="relationship_preferred_contact_time" id="EveningRadio" value="Evening" {{ ($contactParty->preferred_contact_time =='Evening') ? 'checked' : null}}>
                                                <label class="form-check-label pl-1" for="EveningRadio">Evening</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 py-4 text-end border-top mt-4 sm:mt-5">
                                <button data-action="prev" type="button" data-action="next" class="btn btn-secondary rounded">
                                    Back
                                </button> &nbsp;&nbsp;
                                <button type="button" data-action="next" class="step1 btn btn-success rounded" id="continueButtonStep2">
                                    Next
                                </button>
                            </div>
                        </section>
                        <!-- / End Step 2 -->

                        <!-- Step 3 -->
                        <section id="progress-form__panel-3" role="tabpanel" aria-labelledby="progress-form__tab-3" tabindex="0" hidden>
                            <div class="p-5 mx-3">
                                <div class="mt-3 form__field">
                                    <h4 class="fw-bold">This physician can be requested to take action on this case and may receive a copy of any resulting reports.<br/><br/></h4>
                                </div>
                                <div class="sm:d-grid sm:grid-col-3 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="first-name">
                                        First Name
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="first-name-step3" type="text" name="firstnamestep3" autocomplete="given-name" required value="{{$referringPhysician->first_name}}">
                                    </div>

                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="last-name">
                                        Last Name
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="last-name-step3" type="text" name="lastnamestep3" autocomplete="family-name" required value="{{$referringPhysician->last_name}}">
                                    </div>
                                </div>

                                <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="institution">
                                        Institution
                                    </label>
                                    <input disabled  id="institution" type="text" name="institution" autocomplete="given-name" value="{{$referringPhysician->institution}}">
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="street_address">
                                        Street Address
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="street_address_step3" type="text" name="street_address" autocomplete="given-name" required value="{{$referringPhysician->street_address}}">
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="city">
                                        City
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="city-step3" type="text" name="citystep3" autocomplete="given-name" required value="{{$referringPhysician->city}}">
                                    </div>

                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="postal_code">
                                        Postal Code
                                    </label>
                                    <input disabled  id="postal_code_step3" type="text" minlength="5" maxlength="6" name="postalcodestep3" autocomplete="given-name" value="{{$referringPhysician->postal_code}}">
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="Country">
                                        Country
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <select disabled  class="countries" name="countries" id="countries-step3" required>
                                        <option value="">--Select--</option>
                                        @foreach($countries as $country)
                                            <option {{($referringPhysician->country==$country['id']) ? 'selected' : null}} value="{{ $country['id'] ?? '' }}" data-country-name="{{ $country['country_name'] ?? '' }}">{{ $country['country_name'] ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    </div>

                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="states">
                                        State
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <select disabled  class="states" name="states" id="states-step3" required>
                                        @foreach($states as $state)
                                            <option {{($referringPhysician->state==$state['id']) ? 'selected' : null}} value="{{ $state['id'] ?? '' }}" data-state-name="{{ $state['state_name'] ?? '' }}">{{ $state['state_name'] ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>                            
                                <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="email">
                                        Email Address 
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="email_step3" type="email" name="email_step3" class ="email" autocomplete="given-name" required value="{{$referringPhysician->email}}">
                                    </div>

                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="confirm_email">
                                        Confirm Email
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="confirm_email_step3" type="email" name="confirm_email_step3" class ="confirm_email" autocomplete="given-name" required value="{{$referringPhysician->email}}">
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="phone_number">
                                        Phone Number
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="phone_number_step3" type="text" name="phonenumberstep3" autocomplete="given-name" required value="{{$referringPhysician->phone_number}}">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5 template-demo"> -->
                            <div class="px-5 py-4 text-end border-top mt-4 sm:mt-5">
                                <button data-action="prev" type="button" class="btn btn-secondary rounded">
                                Back
                                </button> &nbsp;&nbsp;
                                <button type="button" data-action="next" class="step1 btn btn-success rounded" id="continueButtonStep3">
                                Next
                                </button>
                            </div>
                        </section>
                        <!-- / End Step 3 -->

                        <!-- Step 4 -->
                        <section id="progress-form__panel-4" role="tabpanel" aria-labelledby="progress-form__tab-4" tabindex="0" hidden>
                            <div class="p-5 mx-3">
                                <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="primary_diagnosis">
                                        Please provide the Primary Diagnosis* (If known, please let us know)
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <input disabled  id="primary_diagnosis" type="text" name="primary_diagnosis" autocomplete="given-name" required value="{{$patientPrimaryConcern->primary_diagnosis}}">
                                    </div>
                                    <div class="mt-3 sm:mt-0 form__field ">
                                        <label for="address-city">
                                        Has the patient been treated or had surgery for this condition before?
                                            <span data-required="true" aria-hidden="true"></span>
                                        </label>
                                        <div class="d-flex align-items-center h-50">
                                            <div class=" form-check-inline d-flex align-items-center pr-2">
                                                <input disabled  class="form-check-input" type="radio" name="treated_before" id="yesRadio" value="Yes" required {{$patientPrimaryConcern->treated_before =="Yes" ? 'checked' : null}}>
                                                <label class="form-check-label pb-0 pl-2" for="yesRadio">Yes</label>
                                            </div>
                                            <div class="form-check-inline d-flex align-items-center pl-2">
                                                <input disabled  class="form-check-input" type="radio" name="treated_before" id="noRadio" value="No" required {{$patientPrimaryConcern->treated_before =="No" ? 'checked' : null}}>
                                                <label class="form-check-label pb-0 pl-2" for="noRadio">No</label>
                                            </div>  
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:d-grid sm:grid-col-1 sm:mt-3" id="surgeryDescriptionDiv">
                                    
                                    <div class="mt-3 sm:mt-0 form__field ">
                                        <label for="address-city">
                                        If so, please describe
                                            <span data-required="true" aria-hidden="true"></span>
                                        </label>
                                        
                                        <input disabled  id="surgery_description" type="text" name="surgery_description" autocomplete="given-name" required value="{{$patientPrimaryConcern->surgery_description}}"> 
                                    </div>
                                </div>
                                <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                                    <div class="mt-3 sm:mt-0 form__field">
                                    <label for="request_description">
                                    Please add a description of your request including a brief medical history, current treatment plan, specific questions you may have, and any other information you wish to provide.
                                        <span data-required="true" aria-hidden="true"></span>
                                    </label>
                                    <textarea disabled rows="5" cols="40" id="request_description" type="text" name="request_description" autocomplete="given-name" required>{{$patientPrimaryConcern->request_description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 py-4 text-end border-top mt-4 sm:mt-5">
                                <button data-action="prev" type="button" class="btn btn-secondary rounded" >
                                Back
                                </button> &nbsp;&nbsp;
                                <button type="button" data-action="next" class="step1 btn btn-success rounded" id="continueButtonStep4">
                                Next
                                </button>
                            </div>
                        </section>
                        <!-- / End Step 4 -->

                        <!-- Step 5 -->
                        <section id="progress-form__panel-5" role="tabpanel" aria-labelledby="progress-form__tab-5" tabindex="0" hidden>
                            <div class="p-5 mx-3">
                                <div class="mt-3 form__field">
                                    <h4 class="fw-bold fs-3">Documents to review:<br /><br /></h4>
                                </div>
                                <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                                    <div id="tabs">
                                        <span class="tab-button active" onclick="goToTab(0)" id="tabButton0">Patient Cover Letter</span>
                                        <span style="margin-left: -3px;" class="tab-button" onclick="goToTab(1)" id="tabButton1">Patient Agreement</span>
                                    </div>
                        
                                    <div class="tab tab-content" style="display: block">
                                        <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                                            <div class="mt-3 sm:mt-0 form__field">
                                                <iframe
                                                    src="/files/EV_MD_For_Patients_Agreement1_PatientCoverLetter.pdf#toolbar=0&amp;navpanes=0&amp;scrollbar=0"
                                                    style="width: 100%; max-width: 100%" class="documentIframe">
                                                </iframe>
                                            </div>
                        
                                        </div>
                                    </div>
                        
                                    <div class="tab tab-content">
                                        <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                                            <div class="mt-3 sm:mt-0 form__field">
                                                <iframe
                                                    src="/files/EV_MD_For_Patients_Agreement_1_Patient_Agreement.pdf#toolbar=0&amp;navpanes=0&amp;scrollbar=0"
                                                    style="width: 100%; max-width: 100%" class="documentIframe">
                                                </iframe>
                                            </div>
                                        </div>
                                        <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
                                            <div class="mt-1 form__field">
                                                <label class="form__choice-wrapper">
                                                <input disabled checked id="patient_agreement" type="checkbox" name="patient_agreement" value="Yes" class="checkAllAppendix" {{isset($expertOpinionRequests->patient_agreement) ? 'checked' : ''}}
                                                        class="patientAgreement">
                                                    <span>I agree to all of the following:</span>                        
                                                </label>
                                                <label class="form__choice-wrapper">
                                                    <input disabled checked id="patient_agreement" type="checkbox" name="patient_agreement" value="Yes" {{isset($expertOpinionRequests->patient_agreement) ? 'checked' : ''}}
                                                        class="patientAgreement">
                                                    <span>Patient Agreement</span>
                                                </label>
                                                <label class="form__choice-wrapper">
                                                    <input disabled checked id="appendix_1" type="checkbox" name="appendix_1" value="Yes"
                                                        class="patientAgreement" {{isset($expertOpinionRequests->appendix_1) ? 'checked' : ''}}>
                                                    <span>Appendix 1 : Payment Terms</span>
                                                </label>
                                                <label class="form__choice-wrapper">
                                                    <input disabled checked id="appendix_2" type="checkbox" name="appendix_2" value="Yes"
                                                        class="patientAgreement" {{isset($expertOpinionRequests->appendix_2) ? 'checked' : ''}}>
                                                    <span>Appendix 2 : Patient Enrollment Form – MD for Patients</span>
                                                </label>
                                                <label class="form__choice-wrapper">
                                                    <input disabled checked id="appendix_3" type="checkbox" name="appendix_3" value="Yes"
                                                        class="patientAgreement" {{isset($expertOpinionRequests->appendix_3) ? 'checked' : ''}}> 
                                                    <span>Appendix 3: Medicare Opt-Out Agreement</span>
                                                </label>
                                                <label class="form__choice-wrapper">
                                                    <input disabled checked id="appendix_4" type="checkbox" name="appendix_4" value="Yes"
                                                        class="patientAgreement" {{isset($expertOpinionRequests->appendix_4) ? 'checked' : ''}}>
                                                    <span>Appendix 4: Informed Consent</span>
                                                </label>
                                            </div>
                                            <div class="mt-1 form__field">
                                                <div class="mt-3 sm:mt-0 form__field">
                                                    <label for="digital_signature">
                                                        By typing my full legal name below, I hereby indicate that I understand and accept all terms as specified in the Patient Agreement and in each Appendix
                                                    </label>
                                                    <input disabled  id="re_type_name" type="text" name="digital_signature"
                                                        autocomplete="given-name" value="{{$expertOpinionRequests->re_type_name}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 py-4 text-end border-top sm:mt-5 mt-0 bg-white">
                                <button data-action="prev" type="button" class="btn btn-secondary rounded">
                                    Back
                                </button>&nbsp;&nbsp;
                                <button class="step1 btn btn-success rounded agreeButton" id="agreeButton" onclick="nextTab()">Agree & Proceed</button>&nbsp;&nbsp;                             
                                <button class="step1 btn btn-success rounded agreeAfterPaymentButton" id="agreeAfterPaymentButton" onclick="nextTab()" hidden>Next</button>
                            </div>
                        </section>
                        <!-- / End Step 5 -->

                        <!-- Step 6 -->
                        <section id="progress-form__panel-6" role="tabpanel" aria-labelledby="progress-form__tab-6" tabindex="0" hidden> 
                            <div class="card">
                                <div class="card-body p-0">
                                <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                                    <div class="px-5 py-3 mx-3">
                                        <div class="payment-details">
                                            <h3 class="fw-bold">Payment Details</h3>
                                            <br/>                                
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Transaction Id:</strong></td>
                                                        <td><p id="chargeId">{{$paymentDetails->charge_id}}</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Card Used:</strong></td>
                                                        <td><p id="cardNumber">**** **** **** {{$paymentDetails->card_last4}}</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Payment Date:</strong></td>
                                                        <td class="paymentDate">{{$paymentDetails->created_at}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Amount Paid:</strong></td>
                                                        <td class=>{{config("services.stripe.stripe_amount")}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Payment Status:</strong></td>
                                                        <td class="payment-status"><span class="status-icon">&#x2714;</span> PAID</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="px-5 py-4 text-end border-top mt-4 sm:mt-5">
                                        <button data-action="prev" type="button" class="btn btn-secondary rounded" >
                                        Back
                                        </button> &nbsp;&nbsp;
                                        <button type="button" data-action="next" class="step1 btn btn-success rounded" id="continueButtonStep6">
                                        Next
                                        </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </section>
                        <!-- / End Step 6 -->

                        <!-- Step 7 -->
                        <section id="progress-form__panel-7" role="tabpanel" aria-labelledby="progress-form__tab-7" tabindex="0" hidden>
                            <div class="card rounded-top-0">
                                <div class="card-body p-0">
                                    <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                                        <div class="p-5 mx-3"> 
                                            <div class="mt-3 sm:mt-0 form__field">  
                                                <h3>Previously Uploaded Documents<br></h3>
                                            </div>  
                                            @if(isset($customeShareFiles['customeShareFiles']['value']) && count($customeShareFiles['customeShareFiles']['value']) > 0)
                                                @foreach ($customeShareFiles['customeShareFiles']['value'] as $file)  
                                                    <input type="hidden" name="patient_id" id="patientId" value="{{ $patientDetails->id}}" />
                                                    <input type="hidden" name="folder_id" id="folder_id" value="{{ $medicalRecords->folder_id}}" />
                                                    <input type="hidden" name="patient_consulatation_number" id="patient_consulatation_number" value="{{ $patientDetails->patient_consulatation_number}}" />
                                                    <div class="stat-row">
                                                        <div class="d-flex align-items-center">
                                                            <img src="/dist/assets/images/photo.png" alt="ssss">
                                                            <div class="pl-2"><b>Description:</b>{{$file['Name'] }}</div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="pr-4">
                                                                <b>Uploaded:</b>
                                                                {{ (new DateTime($file["CreationDate"]))->format("m-d-Y") }}
                                                            </div>
                                                            <button class="delete-btn">
                                                                <a href="{{ route('view-file', ['id' => $file['Id']]) }}" target="_blank">View</a>
                                                            </button>&nbsp;&nbsp;
                                                            <button class="delete-btn">
                                                                <a target="_blank" href="{{ route('download', ['id' => $file['Id']]) }}"><span class="fa fa-download"></span>Download</a>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                @endforeach      
                                            @endif
                                            <div class="sm:mt-0 form__field">
                                                <h3 class="fw-bold fs-3">Upload Medical Documents</h3><br>
                                                <h4 class="fw-bold fs-4">These may include: medical imaging or digital pathology, radiology or pathology reports, exam or office notes, and/or other medical records.</h4>
                                            </div>                     
                                            <div class="mt-3 sm:mt-0 form__field">   
                                                <div id="fine-uploader-manual-trigger"></div>
                                            </div>   
                                        <div class="px-5 py-4 text-end border-top mt-0 sm:mt-5">
                                            <button data-action="prev" type="button" data-action="next" class="btn btn-secondary" >
                                                Back
                                            </button> &nbsp;&nbsp;

                                            <button id="confirm-upload" class="step1 btn btn-success" type="button" >Submit</button>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                        </section>
                        <!-- / End Step 7 -->

                    </form>
                    <!-- / End Progress Form -->
                </div>                
            </div>
            <div class="d-lg-none d-xl-block col-xl-2"></div>
        </div>
    </div>
    
    <!-- content-wrapper ends -->
    @include("footer")
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


<script>
    console.clear();
    document.querySelectorAll("#confirm-upload").forEach(button => {
        button.addEventListener("click", () => {
            window.location = "/patient_consultation_view/{{ $patientDetails->id}}";
        });
    });

    
    function ready(fn) {
    //var hasTreated = $('input[name="treated_before"]')
    if ($('#yesRadio').is(':checked')) {
        $('#surgery_description').attr('required', 'required');
        $('#surgery_description').closest('.form__field').show();
    }else if($('#noRadio').is(':checked')) {
        $('#surgery_description').removeAttr('required');
        $('#surgery_description').closest('.form__field').hide();
    }

    function toggleFields() {
        var relationship = $('#relationship_to_patient').val();
        var email_step1 = document.getElementById("email_step1").value;

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
            document.getElementById("relationship_email").value = email_step1;
            document.getElementById("relationship_confirm_email").value = email_step1;

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
            document.getElementById("relationship_email").value = null;
            document.getElementById("relationship_confirm_email").value = null;

        }else if(relationship === 'Referring or local physician'){
            $('#relationship_first_name, #relationship_last_name, #relationship_email,#relationship_npi,#relationship_countries,#relationship_states,#relationship_postal_code, #relationship_street_address, #relationship_confirm_email, #relationship_phone_number, #relationship_preferred_mode_of_communication, #relationship_preferred_contact_time, #relationship_institution,#relationship_fax_no, #relationship_city').closest('.form__field').show();
            $('#relationship_email').attr('required', 'required');
            $('#relationship_confirm_email').attr('required', 'required');
            $('#relationship_phone_number').attr('required', 'required');
            $('#relationship_first_name').attr('required', 'required');
            $('#relationship_last_name').attr('required', 'required');
            $('#phoneRadio').attr('required', 'required');
            $('#emailRadio').attr('required', 'required');
            document.getElementById("relationship_email").value = null;
            document.getElementById("relationship_confirm_email").value = null;
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
            document.getElementById("relationship_email").value = null;
            document.getElementById("relationship_confirm_email").value = null;
        }
    }

    // Trigger the function on page load and when the relationship select changes
    toggleFields();
    $('#relationship_to_patient').change(toggleFields);


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
        } //else if (!/^[a-zA-Z0-9-_,\/ ]+$/.test(val)) {
        //     return { isValid: false, message: 'Only alphanumeric characters, hyphens, underscores, commas, and slashes are allowed.' };
        // }
        else {
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
        case  'file': return {
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

document.addEventListener('DOMContentLoaded', function() {
    
    $(".backButtonPaymentDetails").click(function() {
        const panel6 = document.getElementById("progress-form__panel-6");
        const panel5 = document.getElementById("progress-form__panel-5");

        if (panel6 && panel5) {
            panel6.setAttribute("hidden", "");
            panel5.removeAttribute("hidden");
        } else {
            console.error("One or both of the panels (panel 6 or panel 5) not found.");
        }
    });

    $(".agreeAfterPaymentButton").click(function() {
        const panel6 = document.getElementById("progress-form__panel-6");
        const panel5 = document.getElementById("progress-form__panel-5");

        const tab6 = document.getElementById("progress-form__tab-6");
        const tab5 = document.getElementById("progress-form__tab-5");

        if (panel6 && panel5) {
            panel5.setAttribute("hidden", "");
            panel6.removeAttribute("hidden");
            tab5.setAttribute("data-complete", "true");
            tab5.setAttribute("aria-selected", "false");
            tab6.setAttribute("aria-selected", "true");
        } else {
            console.error("One or both of the panels (panel 6 or panel 5) not found.");
        }
    });
});


    // Function to check the state of all checkboxes and enable/disable the submit button for payment
    const submitBtn = document.getElementById('customButton');
    function updateSubmitButtonState() {
        
        const digital_signature = document.getElementById('re_type_name').value.trim();
        const checkboxes = document.querySelectorAll('.patientAgreement');
        let allChecked = true;

        checkboxes.forEach(checkbox => {
            if (!checkbox.checked) {
                allChecked = false;
            }
        });

        
        if (allChecked && digital_signature !== ""){
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }

    // Add event listeners to each checkbox
    document.querySelectorAll('.patientAgreement').forEach(checkbox => {
        checkbox.addEventListener('change', updateSubmitButtonState);
    });
    
    document.addEventListener('DOMContentLoaded', function() {
    const typeNameField = document.querySelector('#re_type_name');
    const submitBtn = document.querySelector('#submitBtn'); // Ensure this is correctly set to your submit button

    function checkForm() {
        if (typeNameField.value.trim() !== '') {
            const checkboxes = document.querySelectorAll('.patientAgreement');
            let allChecked = true;

            checkboxes.forEach(checkbox => {
                if (!checkbox.checked) {
                    allChecked = false;
                }
            });

            submitBtn.disabled = !allChecked;
        } else {
            submitBtn.disabled = true;
        }
    }

    if (typeNameField) {
        typeNameField.addEventListener('keyup', checkForm);
        typeNameField.addEventListener('blur', checkForm);
    } else {
        console.error("Element with ID 're_type_name' not found.");
    }
});


    document.getElementById("email_step1").addEventListener("blur", function() {
        document.getElementById("relationship_email").value = this.value;
        document.getElementById("relationship_confirm_email").value = this.value;
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

        // if (n === 2) {
        //     document.getElementById("submitBtn").classList.remove("hidden");
        // } else {
        //     document.getElementById("submitBtn").classList.add("hidden");
        // }
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
            document.getElementById("agreeButton").setAttribute("hidden", '');
            document.getElementById("agreeAfterPaymentButton").removeAttribute("hidden");

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
        showTab(n);
        // if (document.getElementById(`tabButton${n}`).style.pointerEvents === "auto") {
        //     currentTab = n;
        //     showTab(currentTab);
        // }
    }

    document.querySelectorAll('#continueButton').forEach(checkbox => {
        checkbox.addEventListener('change', updateSubmitButtonState);
    });
</script>

</script>

<script type="text/javascript">
    var paymentDetails = document.getElementById('progress-form__panel-6');
    document.querySelector('#continueButtonStep6').addEventListener('click', function(e) {
        const panel7 = document.getElementById("progress-form__panel-7");
        const panel6 = document.getElementById("progress-form__panel-6");

        const tab7 = document.getElementById("progress-form__tab-7");
        const tab6 = document.getElementById("progress-form__tab-6");
        const tab5 = document.getElementById("progress-form__tab-5");

        if (panel7 && panel6) {
            panel6.setAttribute("hidden", "");
            panel7.removeAttribute("hidden");
            
            tab6.setAttribute("aria-selected", "false");
            tab7.setAttribute("aria-selected", "true");
        }
        
    });
</script>

<script type="text/template" id="qq-template-manual-trigger">
        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="buttons">
                <div class="qq-upload-button-selector qq-upload-button btn btn-success rounded">
                    <div>Select files</div>
                </div>
                <button type="button" id="trigger-upload" class="qq-upload-button-selector qq-upload-button btn btn-success rounded mt-lg-0 mt-md-3">
                    <i class="icon-upload icon-white"></i> Upload
                </button>
            </div>
            <br/>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="qq-upload-file-selector qq-upload-file"></span>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="qq-btn qq-upload-cancel-selector btn btn-danger qq-upload-cancel">Delete</button>
                    <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                    <br/>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Close</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Yes</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog><br/><br/><br/>
        </div>
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $('#fine-uploader-manual-trigger').fineUploader({
            template: 'qq-template-manual-trigger',
            request: {
                endpoint: '/upload',
                customHeaders: {
                    'X-CSRF-TOKEN': csrfToken
                }
            },
            thumbnails: {
                placeholders: {
                    waitingPath: '/fine-uploader/placeholders/waiting-generic.png',
                    notAvailablePath: '/fine-uploader/placeholders/not_available-generic.png'
                }
            },
            autoUpload: false
        });

        $('#trigger-upload').click(function() {
            $('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });
    });
</script>


@endsection