@extends("layoutLogin")
@section("content")
<div class="container">
    <div class="dottedDiv">
        <div class="left">
            <label>If you have not already registered, please do so.</label>
            <button class="btn btn-success rounded register">Register</button>
        </div>
        <div class="right">
                <div id="consultation-section">
                    <div class="col-lg-12 col-xl-8 px-xl-0">
                        <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                            <div class="mt-3 sm:mt-0 form__field">
                                <label for="case_number">Check status of an existing consultation request.</label>
                                <div class="d-flex">
                                    <form id="case-form">
                                    @csrf
                                    <input type="text" id="case_number" name="case_number" placeholder="Case Number" class="form-control"><br/>
                                    <button type="submit" class="btn btn-success rounded">Validate</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="otp-section" hidden>     
                    <div class="col-lg-12 col-xl-8 px-xl-0">
                        <div class="sm:d-grid sm:grid-col-1 sm:mt-3">
                            <div class="mt-3 sm:mt-0 form__field">
                                <label for="case_number">Enter OTP</label>
                                <div class="d-flex">
                                    <form id="otp-form" action="/verify-otp" method="post">
                                        @csrf
                                        <input type="text" id="otp" name="otp" placeholder="OTP" class="form-control"><br/>
                                        <button type="submit" class="btn btn-success rounded">Verify</button>
                                    </form>
                                <div id="otp-message"></div>
                                </div>
                            </div>
                        </div>
                    </div>               
                    
                </div>
            
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
</script>
@endsection
