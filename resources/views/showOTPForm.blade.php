@extends("layoutLogin")
@section("content")
<div class="container">
    <div class="dottedDiv">
        <div class="left">
            <p>If you have not already registered, please do so.</p>
            <button class="btn btn-success rounded">Register</button>
        </div>
        <div class="right">
            <form id="case-form">
                @csrf
                <div id="consultation-section">
                    <div class="col-lg-12 col-xl-8 px-xl-0">
                        <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                            <div class="mt-3 sm:mt-0 form__field">
                                <label for="case_number">Check status of an existing consultation request.</label>
                                <div class="d-flex">
                                    <input type="text" id="case_number" name="case_number" placeholder="Case Number" class="form-control me-2">
                                    <button type="submit" class="btn btn-success rounded">Validate</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="otp-section" hidden>
                    <h1>Enter OTP</h1>
                    <form id="otp-form" action="/verify-otp" method="post">
                        @csrf
                        <input type="text" id="otp" name="otp" placeholder="OTP" class="form-control">
                        <button type="submit" class="continueButton continueButtonStep btn btn-success btn-fw mt-2">Verify</button>
                    </form>
                    <div id="otp-message"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-4 mx-auto" hidden>
  <div class="auth-form-light text-left p-5">
        <div id="consultation-section">
            <h3 class="fw-bold">Check status of an existing consultation request.</h3>
            <form id="case-form">
                @csrf
                <div class="d-flex">
                    <input type="text" id="case_number" name="case_number" placeholder="Case Number" class="form-control me-2"><br/>
                    <button type="submit" class="continueButton btn btn-success btn-fw">Validate</button>
                </div>
            </form>
        </div>

        <div id="otp-section" hidden>
            <h1>Enter OTP</h1>
            <form id="otp-form" action="/verify-otp" method="post">
                @csrf
                <input type="text" id="otp" name="otp" placeholder="OTP" class="form-control">
                <button type="submit" class="continueButton continueButtonStep btn btn-success btn-fw mt-2">Verify</button>
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
