<?php
$page = "Registration Page";
require_once "includes/public.php";
require_once "components/header.php";
?>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="includes/process.php" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="FirstName" name="FirstName" placeholder="First Name" required />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="MiddleName" name="MiddleName" placeholder="Middle Name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="LastName" name="LastName" placeholder="Last Name" required />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="Email" name="Email" placeholder="Email Address" required />
                                </div>
                                <hr>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="Username" name="Username" placeholder="Username" required />
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" pattern = "^(?=.*\d)(?=.*[a-@-zA-Z])[a-zA-Z\d]{8,}$" title="Must contain number and letter, and at least 8 or more characters" class="form-control form-control-user" id="Password" name="Password" placeholder="Password" required />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" pattern = "^(?=.*\d)(?=.*[a-@-zA-Z])[a-zA-Z\d]{8,}$" title="Must contain number and letter, and at least 8 or more characters" class="form-control form-control-user" id="Verify" name="Verify" placeholder="Repeat Password" required />
                                    </div>
                                </div>
                                <input type="hidden" name="Register" />
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
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

</body>

</html>