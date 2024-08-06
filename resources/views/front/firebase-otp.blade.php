@extends('front.layout.app')
@section('title', 'OTP Verification')
@section('content')


    <div class="otp-container">
        <div class="alert alert-danger" id="error" style="display: none;"></div>
        <div class="alert alert-success" id="sentSuccess" style="display: none;"></div>
        <form class="otp-form" action="javascript:;" method="POST">
            <h2>OTP Verification</h2>
            <p>Please enter your phone number to receive an OTP:</p>
            <div>
                <input id="phoneNumber" class="form-control my-2" type="text" placeholder="Enter phone number" required>
            </div>
            <div id="recaptcha-container"></div>
            <button type="button" class="submit-btn" onclick="sendOTP();">Send OTP</button>

            <div style="margin-top: 20px;">
                <p>Enter the OTP you received:</p>
                <input id="verificationCode" class="form-control my-2" type="text" maxlength="6" placeholder="Enter OTP" required>
                <button type="button" class="submit-btn" onclick="verifyOTP();">Verify OTP</button>
            </div>
        </form>
    </div>

@endsection
@section('js')
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-auth.js"></script>

    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyBnAziQw5C6d0JkerTgQ0xB5I3D_mXYaSk",
            authDomain: "admin-panel-bb81e.firebaseapp.com",
            projectId: "admin-panel-bb81e",
            storageBucket: "admin-panel-bb81e.appspot.com",
            messagingSenderId: "321090440645",
            appId: "1:321090440645:web:e1f2e2b8f733de3f2c0fac",
            measurementId: "G-5W4LLTM0SL"
        };

        firebase.initializeApp(firebaseConfig);

        // window.onload = function () {
        //     render();
        // };

        // function render() {
        //     window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        //     recaptchaVerifier.render();
        // }

        function setupRecaptcha() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                'size': 'invisible',
                'callback': function (response) {
                    // reCAPTCHA solved - allow sendOTP function to proceed
                    sendOTP();
                }
            });
        }

        let isSubmitting = false;

        function sendOTP() {
            if (isSubmitting) return;

            isSubmitting = true;
            let phoneNumber = $("#phoneNumber").val();
            let appVerifier = window.recaptchaVerifier;

            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                .then(function (confirmationResult) {
                    // Successfully sent OTP
                    isSubmitting = true;
                    window.confirmationResult = confirmationResult;
                    $("#sentSuccess").text("OTP sent successfully.");
                    $("#sentSuccess").show();
                })
                .catch(function (error) {
                    // Failed to send OTP
                    isSubmitting = false;
                    console.error("Error during signInWithPhoneNumber", error);
                    console.error("error.message", error.message);
                    $("#error").text(error.message);
                    $("#error").show();
                    window.recaptchaVerifier.reset(); // Reset the reCAPTCHA if it failed
                });
        }

        window.onload = function () {
            setupRecaptcha();
        };

        function sendOTPs() {
            let number = $("#phoneNumber").val();

            firebase.auth().signInWithPhoneNumber(number)
                .then(function (confirmationResult) {
                    window.confirmationResult = confirmationResult;
                    $("#sentSuccess").text("OTP sent successfully.");
                    $("#sentSuccess").show();
                })
                .catch(function (error) {
                    $("#error").text(error.message);
                    $("#error").show();
                });
        }

        function verifyOTP() {
            let code = $("#verificationCode").val();

            if (window.confirmationResult) {
                window.confirmationResult.confirm(code)
                    .then(function (result) {
                        var user = result.user;
                        $("#sentSuccess").text("Verification successful.");
                        $("#sentSuccess").show();
                    })
                    .catch(function (error) {
                        $("#error").text("Verification failed: " + error.message);
                        $("#error").show();
                    });
            } else {
                $("#error").text("No OTP sent. Please request an OTP first.");
                $("#error").show();
            }
        }
    </script>
@endsection
