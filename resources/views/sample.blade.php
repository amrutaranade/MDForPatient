<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form</title>
    <link rel="stylesheet" href="/dist/assets/css/sample.css">
</head>
<body>
    <form id="multiStepForm">
        <!-- Step 1 -->
        <div class="step">
            <h2>Contact Party</h2>
            <p>This is the party responsible for this case. They may be contacted about patient information, medical records, payment, and the case report as applicable.</p>
            <label for="relationship">Select relationship to the patient *</label>
            <select id="relationship" name="relationship" required>
                <option value="">Select</option>
                <option value="Patient">Patient</option>
                <!-- Add more options as needed -->
            </select>
            <label for="email">Email address *</label>
            <input type="email" id="email" name="email" required>
            <label for="confirmEmail">Confirm email *</label>
            <input type="email" id="confirmEmail" name="confirmEmail" required>
            <label for="phone">Phone number (include country code) *</label>
            <input type="tel" id="phone" name="phone" required>
            <fieldset>
                <legend>Preferred mode of communication *</legend>
                <input type="radio" id="phoneComm" name="communication" value="Phone" required>
                <label for="phoneComm">Phone</label>
                <input type="radio" id="emailComm" name="communication" value="Email">
                <label for="emailComm">Email</label>
            </fieldset>
            <fieldset>
                <legend>Preferred contact time</legend>
                <input type="radio" id="morning" name="contactTime" value="Morning">
                <label for="morning">Morning</label>
                <input type="radio" id="afternoon" name="contactTime" value="Afternoon">
                <label for="afternoon">Afternoon</label>
                <input type="radio" id="evening" name="contactTime" value="Evening">
                <label for="evening">Evening</label>
            </fieldset>
            <button type="button" onclick="nextStep()">Next</button>
        </div>

        <!-- Step 2 -->
        <div class="step">
            <h2>Referring Physician</h2>
            <p>This physician can be requested to take action on this case and may receive a copy of any resulting reports.</p>
            <label for="firstName">First name *</label>
            <input type="text" id="firstName" name="firstName" required>
            <label for="lastName">Last name *</label>
            <input type="text" id="lastName" name="lastName" required>
            <label for="institution">Institution</label>
            <input type="text" id="institution" name="institution">
            <label for="country">Country *</label>
            <select id="country" name="country" required>
                <option value="">Select</option>
                <option value="India">India</option>
                <!-- Add more options as needed -->
            </select>
            <label for="state">State *</label>
            <select id="state" name="state" required>
                <option value="">Select</option>
                <option value="Madhya Pradesh">Madhya Pradesh</option>
                <!-- Add more options as needed -->
            </select>
            <label for="city">City *</label>
            <input type="text" id="city" name="city" required>
            <label for="postalCode">Postal code *</label>
            <input type="text" id="postalCode" name="postalCode" required>
            <label for="streetAddress">Street address</label>
            <input type="text" id="streetAddress" name="streetAddress">
            <label for="emailPhysician">Email address *</label>
            <input type="email" id="emailPhysician" name="emailPhysician" required>
            <label for="confirmEmailPhysician">Confirm email *</label>
            <input type="email" id="confirmEmailPhysician" name="confirmEmailPhysician" required>
            <label for="phonePhysician">Phone number *</label>
            <input type="tel" id="phonePhysician" name="phonePhysician" required>
            <label for="faxNumber">Fax number</label>
            <input type="tel" id="faxNumber" name="faxNumber">
            <button type="button" onclick="prevStep()">Previous</button>
            <button type="button" onclick="nextStep()">Next</button>
        </div>

        <!-- Step 3 -->
        <div class="step">
            <h2>Expert Opinion Request</h2>
            <p>If this is a time-sensitive or urgent request, please contact 911 or seek local medical care as appropriate.</p>
            <p>Please review the term(s) in the steps below and sign-off to confirm your agreement:</p>
            <label>Are you the patient/patient representative who can agree to the terms?</label>
            <input type="radio" id="agreeYes" name="agreement" value="Yes" required>
            <label for="agreeYes">Yes</label>
            <input type="radio" id="agreeNo" name="agreement" value="No">
            <label for="agreeNo">No</label>
            <div class="tabs">
                <button type="button" class="tablink" onclick="openTab(event, 'Letter')">MD For Patients - Patient Cover Letter</button>
                <button type="button" class="tablink" onclick="openTab(event, 'Agreement')">MD For Patients - Patient Agreement</button>
                <button type="button" class="tablink" onclick="openTab(event, 'Signoff')">Sign-off</button>
            </div>
            <div id="Letter" class="tabcontent">
                <textarea readonly>Thank you for contacting MD For Patients. We provide a uniquely high level of customer service as we perform our consultations...</textarea>
            </div>
            <div id="Agreement" class="tabcontent">
                <textarea readonly>Patient Agreement terms go here...</textarea>
            </div>
            <div id="Signoff" class="tabcontent">
                <textarea readonly>Sign-off information goes here...</textarea>
            </div>
            <button type="button" onclick="prevStep()">Previous</button>
            <button type="submit">Submit</button>
        </div>
    </form>
    <script>
        let currentStep = 0;
        showStep(currentStep);

        function showStep(n) {
            let steps = document.getElementsByClassName("step");
            steps[n].classList.add("active");
            if (n === 0) {
                document.querySelector("button[type='button'][onclick='prevStep()']").style.display = "none";
            } else {
                document.querySelector("button[type='button'][onclick='prevStep()']").style.display = "inline";
            }
            if (n === steps.length - 1) {
                document.querySelector("button[type='button'][onclick='nextStep()']").style.display = "none";
                document.querySelector("button[type='submit']").style.display = "inline";
            } else {
                document.querySelector("button[type='button'][onclick='nextStep()']").style.display = "inline";
                document.querySelector("button[type='submit']").style.display = "none";
            }
        }

        function nextStep() {
            let steps = document.getElementsByClassName("step");
            if (!validateForm()) return false;
            steps[currentStep].classList.remove("active");
            currentStep++;
            if (currentStep >= steps.length) {
                document.getElementById("multiStepForm").submit();
                return false;
            }
            showStep(currentStep);
        }

        function prevStep() {
            let steps = document.getElementsByClassName("step");
            steps[currentStep].classList.remove("active");
            currentStep--;
            showStep(currentStep);
        }

        function validateForm() {
            let valid = true;
            let inputs = document.getElementsByClassName("step")[currentStep].getElementsByTagName("input");
            for (let input of inputs) {
                if (input.hasAttribute("required") && input.value === "") {
                    input.style.borderColor = "red";
                    valid = false;
                } else {
                    input.style.borderColor = "";
                }
            }
            return valid;
        }

        function openTab(evt, tabName) {
            let tablinks = document.getElementsByClassName("tablink");
            for (let tablink of tablinks) {
                tablink.classList.remove("active");
            }
            evt.currentTarget.classList.add("active");
            let tabcontents = document.getElementsByClassName("tabcontent");
            for (let tabcontent of tabcontents) {
                tabcontent.classList.remove("active");
            }
            document.getElementById(tabName).classList.add("active");
        }

    </script>
</body>
</html>
