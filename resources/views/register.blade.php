<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- this is for the loader -->

    <!-- Custom CSS -->

    <style>
        body {
            background-color: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #333;
            text-align: center;
        }

        .form-control {
            background-color: #f3f6fb;
            border: 1px solid #dce1e7;
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
            font-size: 16px;
            color: #495057;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #5a67d8;
            background-color: #eef0f7;
            box-shadow: none;
        }

        .login-button {
            background-color: #5a67d8;
            border-color: #5a67d8;
            color: #fff;
            border-radius: 25px;
            padding: 0.75rem;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #434eb0;
            border-color: #434eb0;
        }

        .forgot-password {
            text-align: center;
            display: block;
            margin-top: 1rem;
            color: #6c757d;
            font-size: 14px;
        }

        .forgot-password:hover {
            color: #5a67d8;
        }
    </style>
    <style>
        .login_image {
            position: relative;
            background-image: url("{{ asset('images/pexels-photo-301926.webp') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100%;


            overflow: hidden;
            /* Ensure no overflow if needed */
        }

        .login_image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Add a semi-transparent overlay */
            z-index: 1;
            /* Place it behind the content */
        }

        .login-container {
            position: relative;
            z-index: 2;
            /* Ensure the content is above the overlay */
            background: rgba(255, 255, 255, 0.8);
            /* Optional: Add a semi-transparent background for the content */
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            top: 27%;
            left: 33%;
        }

        .button {
            position: relative;
            z-index: 2;
            top: 3%;
            right: 3%;

        }
    </style>


</head>

<body>

    <div class="login_image">
        <div class="d-flex justify-content-end button">
        <a href="{{route('loginpage')}}" class="btn btn-success m-2 px-3">Login</a>
        <a href="{{route('registerpage')}}" class="btn btn-primary m-2 px-3">Signup</a>
        </div>

        <div class="login-container ">
            <div class="login-title">Signup</div>

            <form id="login-form" method="post" action="{{ route('registercontroller') }}">
                @csrf
                <div class="mb-3">
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <div id="email-error" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                    @error('password')
                    <div id="password-error" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-3">
                    <input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password" required>
                    @error('password_confirmation')
                    <div id="password-confirmation-error" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Checkbox Field -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">
                        I agree to the <a href="#" target="_blank">terms and conditions</a>
                    </label>
                    @error('terms')
                    <div id="terms-error" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn login-button">Sign Up</button>
            </form>


        </div>
    </div>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Include Axios for AJAX requests -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // $("#login-form").on("submit", function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         url: "{{ url('/register') }}", // The route you want to send the POST request to
        //         type: "POST", // Use POST method
        //         data: $(this).serialize(),
        //         dataType: "json", // Serialize the form data
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
        //         },
        //         beforeSend: function() {
        //             // Optional: Show a loader or disable the submit button
        //             // $(".login-button").prop('disabled', true);
        //         },
        //         success: function(response) {
        //             if (response.errors) {
        //                 console.log("rohit_singh");
        //                 console.log(response.errors.password)
        //                 if (response.errors.password) {
        //                     console.log("raftaar");
        //                     $("#password-error").text(response.errors.password[0]);
        //                 }
        //             } else {

        //                 Swal.fire({
        //                     title: 'Success!',
        //                     text: 'Your form has been submitted.',
        //                     icon: 'success',
        //                     showConfirmButton: false ,// Hides the confirm button

        //                     timer: 2000, // The alert will be visible for 2 seconds (2000 milliseconds)
        //                     timerProgressBar:true // Optional: Shows a progress bar for the timer
        //                 }).then((result) => {
        //                     // Check if the user clicked the "OK" button or if the timer finished
        //                     if (result.dismiss === Swal.DismissReason.timer) {
        //                         // Redirect after the alert closes
        //                         window.location.href = response.redirect;
        //                     }
        //                 });

        //             }




        //         },
        //         error: function(xhr, status, error) {
        //             // Handle any errors that occur during the request
        //             console.log("An error occurred: " + error);
        //         },

        //     });


        // })
    </script>



</body>

</html>