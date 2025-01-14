<?php
$page = "User Management";
$Role = "Admin";
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?= $page ?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-right">
                                <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseAddUser" aria-expanded="false" aria-controls="collapseAddUser">
                                    Add User
                                </button>
                            </p>
                            <div class="collapse mb-3" id="collapseAddUser">
                                <div class="card card-body">
                                    <form class="user" action="includes/process.php" method="POST">
                                        <div class="mb-3 row">
                                            <div class="col-lg-4 col-md-4">
                                                <label for="FirstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="FirstName" name="FirstName" value="" required>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <label for="MiddleName" class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" id="MiddleName" name="MiddleName" value="">
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <label for="LastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="LastName" name="LastName" value="" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Username" class="form-label">Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="Username" name="Username" value="" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="Email" name="Email" value="" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Role" class="form-label">Role <span class="text-danger">*</span></label>
                                                <select class="custom-select" id="Role" name="Role" required>
                                                    <option value="" selected disabled>--</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Operator">Operator</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
                                                <select class="custom-select" id="Status" name="Status" required>
                                                    <option value="" selected disabled>--</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <input type="hidden" name="AddUser" />
                                            <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#collapseAddUser">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="collapse mb-3" id="collapseEditUser">
                                <div class="card card-body">
                                <form class="user" action="includes/process.php" method="POST">
                                        <div class="mb-3 row">
                                            <div class="col-lg-4 col-md-4">
                                                <label for="FirstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="FirstName" name="FirstName" value="" required>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <label for="MiddleName" class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" id="MiddleName" name="MiddleName" value="">
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <label for="LastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="LastName" name="LastName" value="" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Username" class="form-label">Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="Username" name="Username" value="" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="Email" name="Email" value="" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Role" class="form-label">Role <span class="text-danger">*</span></label>
                                                <select class="custom-select" id="Role" name="Role" required>
                                                    <option value="" selected disabled>--</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Operator">Operator</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
                                                <select class="custom-select" id="Status" name="Status" required>
                                                    <option value="" selected disabled>--</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <input type="hidden" name="id" id="id" />
                                            <input type="hidden" name="UpdateUser" />
                                            <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#collapseEditUser">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM users WHERE id != ?";
                                        $result = $conn->execute_query($query, [$acc->id]);
                                        while ($row = $result->fetch_object()) {
                                        ?>
                                            <tr>
                                                <td class="text-center text-nowrap"><?= $row->Username ?></td>
                                                <td class="text-nowrap"><?= $row->Email ?></td>
                                                <td class="text-nowrap"><?= $row->FirstName ?></td>
                                                <td class="text-nowrap"><?= $row->MiddleName ?></td>
                                                <td class="text-nowrap"><?= $row->LastName ?></td>
                                                <td class="text-center text-nowrap"><?= $row->Role ?></td>
                                                <td class="text-center text-nowrap"><?= $row->Status ?></td>
                                                <td class="text-center text-nowrap">
                                                    <button class='upd-btn btn btn-success btn-sm rounded-0 mx-1' data-editUser="<?= $row->id ?>" data-toggle="collapse" data-target="#collapseEditUser" aria-expanded="false" aria-controls="collapseEditUser"><i class="fas fa-edit"></i></button>
                                                    <a class='del-btn btn btn-warning btn-sm rounded-0 mx-1' href="includes/process.php?ResetPassword=<?= $row->id ?>"><i class="fas fa-key"></i></a>
                                                    <a class='del-btn btn btn-danger btn-sm rounded-0 mx-1' href="includes/process.php?DeleteUser=<?= $row->id ?>"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
        $('.upd-btn').click(function() {
            var EditUser = $(this).data('edituser');
            $.ajax({
                url: "includes/fetch.php",
                method: "POST",
                data: {
                    EditUser: EditUser
                },
                dataType: "json",
                success: function(data) {
                    jQuery('#collapseEditUser #FirstName').val(data.FirstName);
                    jQuery('#collapseEditUser #MiddleName').val(data.MiddleName);
                    jQuery('#collapseEditUser #LastName').val(data.LastName);
                    jQuery('#collapseEditUser #Email').val(data.Email);
                    jQuery('#collapseEditUser #Username').val(data.Username);
                    jQuery('#collapseEditUser #Status').val(data.Status);
                    jQuery('#collapseEditUser #Role').val(data.Role);
                    jQuery('#collapseEditUser #id').val(EditUser);
                },
                error: function() {
                    alert("Error fetching events from the server.");
                },
            });
        });
    </script>
</body>

</html>