@extends("layoutView")
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
                        <br/>
                        <div class="status-message">
                                    Your file have been uploaded successfully. To check your profile again <a href="{{route('redirectToHome')}}">Click here</a>
                        </div><br/>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-lg-2"></div>
</div>
@include("footer")
@endsection