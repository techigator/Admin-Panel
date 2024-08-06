@extends('front.layout.app')
@section('title', 'OTP Verification')
@section('content')

    <div class="otp-container">
        <div class="alert alert-danger" id="error" style="display: none;"></div>
        <div class="alert alert-success" id="sentSuccess" style="display: none;"></div>

        <form class="otp-form" action="javascript:;" method="POST">
            <h2>Enter Verification Code</h2>
            <p>Please enter the OTP receive to your phone:</p>
            <div>
                <input class="otp-input" type="text" id="verificationCode" name="verification_code" placeholder="Enter verification code" required>
            </div>
            <button type="button" class="submit-btn" onclick="codeverify();">Verify Code</button>
        </form>
    </div>

@endsection
@section('js')
    <script type="text/javascript">
        function codeverify() {

            let code = $("#verificationCode").val();

            coderesult.confirm(code).then(function (result) {
                var user = result.user;

                $("#successRegsiter").text("you are register Successfully.");
                $("#successRegsiter").show();

            }).catch(function (error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
    </script>
@endsection
