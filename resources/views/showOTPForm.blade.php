@extends("layout")
@section("content")
<div class="col-lg-4 mx-auto">
  <div class="auth-form-light text-left p-5">
        <div id="consultation-section">
            <h3 class="fw-bold">To check the status of a consultation request please enter the consultation number in the field below.</h3>
            <form id="case-form">
                @csrf
                <input type="text" id="case_number" name="case_number" placeholder="Case Number"><br/>
                <button type="submit" class="continueButton continueButtonStep btn btn-success btn-fw" >Validate</button>
            </form>
        </div>

        <div id="otp-section" hidden>
            <h1>Enter OTP</h1>
            <form id="otp-form" action="/verify-otp" method="post">
                @csrf
                <input type="text" id="otp" name="otp" placeholder="OTP">
                <button type="submit" class="continueButton continueButtonStep btn btn-success btn-fw">Verify</button>
            </form>
            <div id="otp-message"></div>
        </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var otpSection = document.getElementById('otp-section');
    var consultationSection = document.getElementById('consultation-section');
        document.getElementById('case-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const caseNumber = document.getElementById('case_number').value;
            axios.post('/validate-case-number', { case_number: caseNumber })
                .then(response => {                    
                    consultationSection.setAttribute('hidden', '');
                    otpSection.removeAttribute('hidden');
                })
                .catch(error => {
                    document.getElementById('otp-section').style.display = 'none';
                });

                
        });

        // document.getElementById('otp-form').addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     const otp = document.getElementById('otp').value;
        //     axios.post('/verify-otp', { otp: otp })
        //         .then(response => {
        //             document.getElementById('otp-message').textContent = response.data.message;
        //         })
        //         .catch(error => {
        //             document.getElementById('otp-message').textContent = error.response.data.message;
        //         });
        // });
    </script>
@endsection