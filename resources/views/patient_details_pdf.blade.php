<!DOCTYPE html>
<html>
<head>
    <title>Patient Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        h3, h3, h3 {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed; /* Ensures the table width is fixed */
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            font-size:14px;
        }
        th, td {
            width: 50%; /* Fixed width for columns */
            word-wrap: break-word; /* Ensures content wraps within the cell */
            text-align: left;
        }
        td{
            font-size:13px;
            font-weight: normal;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Patient Details</h3>
        <table>
        <tr>
                <th>Consultation Number</th>
                <td>{{ $patientDetails->patient_consulatation_number }}</td>
            </tr>
            <tr>
                <th>First Name</th>
                <td>{{ $patientDetails->first_name }}</td>
            </tr>
            <tr>
                <th>Middle Name</th>
                <td>{{ $patientDetails->middle_name }}</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>{{ $patientDetails->last_name }}</td>
            </tr>            
            <tr>
                <th>Date Of Birth</th>
                <td><?php $dateOfBirth = isset($patientDetails->date_of_birth) ? new DateTime($patientDetails->date_of_birth) : null;
                    echo $formattedDateOfBirth = $dateOfBirth ? $dateOfBirth->format('m-d-Y') : ''; ?></td>
            </tr>
            <tr>
                <th>Street Address</th>
                <td>{{ $patientDetails->street_address }}</td>
            </tr>
            <tr>
                <th>Postal Code</th>
                <td>{{ $patientDetails->postal_code }}</td>
            </tr>
            <tr>
                <th>City</th>
                <td>{{ $patientDetails->city }}</td>
            </tr>
            <tr>
                <th>Country</th>
                <td>
                    <?php
                        foreach($countries as $country) {
                            if($patientDetails->country==$country['id']) {
                                echo $country['country_name'];
                            }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <th>State</th>
                <td>
                <?php
                    foreach($states as $state) {
                        if($patientDetails->state==$state['id']) {
                            echo $state['state_name'];
                        }
                    }
                ?>
                </td>
            </tr>            
            <tr>
                <th>Email</th>
                <td>{{ Crypt::decryptString($patientDetails->email) }}</td>
            </tr>
        </table>

        <h3>Contact Party</h3>
        <table>
            <tr>
                <th>Relationship To The Patient</th>
                <td>{{ $contactParty->relationship_to_patient }}</td>
            </tr>
            @if($contactParty->relationship_to_patient == 'Patient') 
            <tr>
                <th>Email Address</th>
                <td>{{ $contactParty->email }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $contactParty->phone_number }}</td>
            </tr>
            <tr>
                <th>Preferred Mode Of Communication</th>
                <td>{{ $contactParty->preferred_mode_of_communication }}</td>
            </tr>
            <tr>
                <th>Preferred Contact Time</th>
                <td>{{ $contactParty->preferred_contact_time }}</td>
            </tr>
            @endif

            @if($contactParty->relationship_to_patient == 'Caregiver') 
            <tr>
                <th>First Name</th>
                <td>{{ $contactParty->first_name }}</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>{{ $contactParty->last_name }}</td>
            </tr> 
            <tr>
                <th>Email Address</th>
                <td>{{ $contactParty->email }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $contactParty->phone_number }}</td>
            </tr>
            <tr>
                <th>Preferred Mode Of Communication</th>
                <td>{{ $contactParty->preferred_mode_of_communication }}</td>
            </tr>
            <tr>
                <th>Preferred Contact Time</th>
                <td>{{ $contactParty->preferred_contact_time }}</td>
            </tr>
            @endif

            @if($contactParty->relationship_to_patient == 'Referring or local physician') 
            <tr>
                <th>First Name</th>
                <td>{{ $contactParty->first_name }}</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>{{ $contactParty->last_name }}</td>
            </tr> 
            <tr>
                <th>NPI</th>
                <td>{{ $contactParty->NPI }}</td>
            </tr> 
            <tr>
                <th>Street Address</th>
                <td>{{ $contactParty->street_address }}</td>
            </tr> 
            <tr>
                <th>Postal Code</th>
                <td>{{ $contactParty->postal_code }}</td>
            </tr>
            <tr>
                <th>City</th>
                <td>{{ $contactParty->city }}</td>
            </tr>
            <tr>
                <th>Country</th>
                <td>
                <?php
                    foreach($countries as $country) {
                        if($contactParty->country==$country['id']) {
                            echo $country['country_name'];
                        }
                    }
                ?>
                </td>
            </tr>
            <tr>
                <th>State</th>
                <td>
                    <?php
                        foreach($states as $state) {
                            if($contactParty->state==$state['id']) {
                                echo $state['state_name'];
                            }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <th>Email Address</th>
                <td>{{ $contactParty->email }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $contactParty->phone_number }}</td>
            </tr>
            <tr>
                <th>Institution</th>
                <td>{{ $contactParty->Instituton }}</td>
            </tr>
            <tr>
                <th>Fax No.</th>
                <td>{{ $contactParty->fax_number }}</td>
            </tr>
            <tr>
                <th>Preferred Mode Of Communication</th>
                <td>{{ $contactParty->preferred_mode_of_communication }}</td>
            </tr>
            <tr>
                <th>Preferred Contact Time</th>
                <td>{{ $contactParty->preferred_contact_time }}</td>
            </tr>
            @endif

            @if($contactParty->relationship_to_patient == 'Parent') 
            <tr>
                <th>First Name</th>
                <td>{{ $contactParty->first_name }}</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>{{ $contactParty->last_name }}</td>
            </tr> 
            <tr>
                <th>Email Address</th>
                <td>{{ $contactParty->email }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $contactParty->phone_number }}</td>
            </tr>
            <tr>
                <th>Preferred Mode Of Communication</th>
                <td>{{ $contactParty->preferred_mode_of_communication }}</td>
            </tr>
            <tr>
                <th>Preferred Contact Time</th>
                <td>{{ $contactParty->preferred_contact_time }}</td>
            </tr>
            @endif

            @if($contactParty->relationship_to_patient == 'Legal Guardian') 
            <tr>
                <th>First Name</th>
                <td>{{ $contactParty->first_name }}</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>{{ $contactParty->last_name }}</td>
            </tr> 
            <tr>
                <th>Email Address</th>
                <td>{{ $contactParty->email }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $contactParty->phone_number }}</td>
            </tr>
            <tr>
                <th>Preferred Mode Of Communication</th>
                <td>{{ $contactParty->preferred_mode_of_communication }}</td>
            </tr>
            <tr>
                <th>Preferred Contact Time</th>
                <td>{{ $contactParty->preferred_contact_time }}</td>
            </tr>
            @endif

            @if($contactParty->relationship_to_patient == 'Other') 
            <tr>
                <th>First Name</th>
                <td>{{ $contactParty->first_name }}</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>{{ $contactParty->last_name }}</td>
            </tr>
            <tr>
                <th>Relationship to the patient</th>
                <td>{{ $contactParty->relationship_other }}</td>
            </tr>
            <tr>
                <th>Email Address</th>
                <td>{{ $contactParty->email }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $contactParty->phone_number }}</td>
            </tr>
            <tr>
                <th>Preferred Mode Of Communication</th>
                <td>{{ $contactParty->preferred_mode_of_communication }}</td>
            </tr>
            <tr>
                <th>Preferred Contact Time</th>
                <td>{{ $contactParty->preferred_contact_time }}</td>
            </tr>
            @endif
            
        </table>
        

        <h3>Referring Physician Details</h3>
        <table>
            <tr>
                <th>First Name</th>
                <td>{{ $referringPhysician->first_name }}</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>{{ $referringPhysician->last_name }}</td>
            </tr> 
            <tr>
                <th>Institution</th>
                <td>{{ $referringPhysician->institution }}</td>
            </tr> 
            <tr>
                <th>Street Address</th>
                <td>{{ $referringPhysician->street_address }}</td>
            </tr>
            <tr>
                <th>Postal Code</th>
                <td>{{ $referringPhysician->postal_code }}</td>
            </tr>
            <tr>
                <th>City</th>
                <td>{{ $referringPhysician->city }}</td>
            </tr>
            <tr>
                <th>Country</th>
                <td>
                <?php
                    foreach($countries as $country) {
                        if($referringPhysician->country==$country['id']) {
                            echo $country['country_name'];
                        }
                    }
                ?>
                </td>
            </tr>
            <tr>
                <th>State</th>
                <td>
                    <?php
                        foreach($states as $state) {
                            if($referringPhysician->state==$state['id']) {
                                echo $state['state_name'];
                            }
                        }
                    ?>
                </td>
            </tr>            
            <tr>
                <th>Email</th>
                <td>{{ $referringPhysician->email }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $referringPhysician->phone_number }}</td>
            </tr>
        </table>

        <h3>Primary Concern</h3>
        <table>
            <tr>
                <th>Primary Diagnosis</th>
                <td>{{ $patientPrimaryConcern->primary_diagnosis }}</td>
            </tr>
            <tr>
                <th>Has the patient been treated or had surgery for this condition before</th>
                <td>{{ $patientPrimaryConcern->treated_before }}</td>
            </tr>
            @if($patientPrimaryConcern->treated_before == 'Yes')
            <tr>
                <th>If so, please describe</th>
                <td>{{ $patientPrimaryConcern->surgery_description }}</td>
            </tr>
            @endif
            <tr>
                <th>Description</th>
                <td>{{ $patientPrimaryConcern->request_description }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
