@extends("layout")
@section("content")
<style>
    .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .status-icon {
            font-size: 48px;
            color: green;
        }
        .status-title {
            font-size: 24px;
            margin: 20px 0;
        }
        .status-message {
            font-size: 16px;
            color: #666;
        }
        .consultation-code {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #f1f1f1;
            font-size: 18px;
            color: #333;
        }

</style>
<div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-8 col-lg-8">  
                <div class="">
                    
                    <div class="container">
                        <div class="status-icon"><img src="/dist/assets/images/verified_logo.svg"/></div>
                        <div class="status-title fw-bold">Thank you! We will be in contact with you shortly.</div><br/>
                        <div class="status-message">
                                    Please record your unique consultation number shown below. This<br/>number will allow you to upload additional records in the future.
                        </div><br/>
                        <div class="consultation-code align-items-center justify-center ">
                        {{session("patient_consulatation_number")}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-lg-2"></div>
</div>
@include("footer")
@endsection