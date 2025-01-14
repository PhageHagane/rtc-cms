<?php
$page = "Profile";
require_once "includes/session.php";
require_once "components/header.php";
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        require_once "components/sidebar.php";
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                require_once "components/topbar.php";
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-4">

                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                    <img src="img/undraw_profile.svg" width="150px" alt="Profile">
                                    <hr>
                                    <h4>
                                        <?= $acc->FirstName ?>
                                        <?= $acc->LastName ?>
                                    </h4>
                                    <h5>
                                        <?= $acc->Role ?>
                                    </h5>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-8">

                            <div class="card">
                                <div class="card-body pt-3">

                                    <!-- Profile Edit Form -->
                                    <form action="includes/process.php" method="POST">

                                        <div class="row mb-3">
                                            <label for="FirstName" class="col-md-4 col-lg-3 col-form-label">First
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="FirstName" type="text" class="form-control" id="FirstName"
                                                    value="<?= $acc->FirstName ?>" required />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="MiddleName" class="col-md-4 col-lg-3 col-form-label">Middle
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="MiddleName" type="text" class="form-control"
                                                    id="MiddleName" value="<?= $acc->MiddleName ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="LastName" class="col-md-4 col-lg-3 col-form-label">Last
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="LastName" type="text" class="form-control" id="LastName"
                                                    value="<?= $acc->LastName ?>" required />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Username"
                                                class="col-md-4 col-lg-3 col-form-label">Username</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="Username" type="text" class="form-control" id="Username"
                                                    value="<?= $acc->Username ?>" required />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="Email" type="email" class="form-control" id="Email"
                                                    value="<?= $acc->Email ?>" required />
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <input type="hidden" name="UpdateProfile" />
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?= $website ?> 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <?php
    require_once "components/footer.php";
    ?>
    <script>
        $('.edit-btn').click(function () {
            var EditAccused = $(this).data('editaccused');
            $.ajax({
                url: "includes/fetch.php",
                method: "POST",
                data: {
                    EditAccused: EditAccused
                },
                dataType: "json",
                success: function (data) {
                    jQuery('#collapseEditAccused #FirstName').val(data.FirstName);
                    jQuery('#collapseEditAccused #MiddleName').val(data.MiddleName);
                    jQuery('#collapseEditAccused #LastName').val(data.LastName);
                    jQuery('#collapseEditAccused #Sex').val(data.Sex);
                    jQuery('#collapseEditAccused #DateOfBirth').val(data.DateOfBirth);
                    jQuery('#collapseEditAccused #Contact').val(data.Contact);
                    jQuery('#collapseEditAccused #Email').val(data.Email);
                    jQuery('#collapseEditAccused #Address').val(data.Address);
                    jQuery('#collapseEditAccused #id').val(EditAccused);
                },
                error: function () {
                    alert("Error fetching events from the server.");
                },
            });
        });
        $('.reject-btn').click(function () {
            var deleteAccusedId = $(this).data('deleteaccused');
            $.ajax({
                url: "includes/fetch.php",
                method: "POST",
                data: {
                    EditAccused: EditAccused
                },
                dataType: "json",
                success: function (data) {
                    jQuery('#collapseEditAccused #FirstName').val(data.FirstName);
                    jQuery('#collapseEditAccused #MiddleName').val(data.MiddleName);
                    jQuery('#collapseEditAccused #LastName').val(data.LastName);
                    jQuery('#collapseEditAccused #Sex').val(data.Sex);
                    jQuery('#collapseEditAccused #DateOfBirth').val(data.DateOfBirth);
                    jQuery('#collapseEditAccused #Contact').val(data.Contact);
                    jQuery('#collapseEditAccused #Email').val(data.Email);
                    jQuery('#collapseEditAccused #Address').val(data.Address);
                    jQuery('#collapseEditAccused #id').val(data.id);
                },
                error: function () {
                    alert("Error fetching events from the server.");
                },
            });
        });
    </script>
</body>

</html>