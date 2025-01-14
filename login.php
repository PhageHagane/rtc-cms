<?php
$page = "Login Page";
require_once "includes/public.php";
require_once "components/header.php";
?>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="includes/process.php" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="Username"
                                                name="Username" placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" pattern = "^{8,}$" title="Must contain at least 8 or more characters" class="form-control form-control-user password"
                                                id="Password" name="Password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="showPassword">
                                                <label class="custom-control-label" for="showPassword">Show
                                                    Password</label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="Login" />
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <!-- <a class="small" href="password.php">Forgot Password?</a> -->
                                    </div>
                                    <div class="text-center">
                                        <!-- <a class="small" href="register.php">Create an Account!</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Function to toggle password visibility
            $('#showPassword').change(function () {
                var passwordField = $('#Password');
                var passwordFieldType = passwordField.attr('type');

                // Toggle the password field type
                passwordField.attr('type', passwordFieldType === 'password' ? 'text' : 'password');
            });
        });
    </script>
</body>

</html>