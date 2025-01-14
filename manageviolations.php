<?php
$page = "Violations";
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
                            <h6 class="m-0 font-weight-bold text-primary">Violations List</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-right">
                                <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseAddViolation" aria-expanded="false" aria-controls="collapseAddViolation">
                                    Add Violation
                                </button>
                            </p>
                            <form class="float-left">
                                <div class="mb-3 row">
                                    <div class="col-lg-1 col-md-1">
                                        <label class="form-label">Filter:</label>
                                        <select name="Classification" class="custom-select">
                                            <option value="" selected disabled>-Classification-</option>
                                            <option value="Family">Family</option>
                                            <option value="Drug">Drug</option>
                                            <option value="Regular">Regular</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <label class="form-label"><br></label>
                                        <select name="Case" class="custom-select">
                                            <option value="" selected disabled>-Case-</option>
                                            <?php
                                            $query = "SELECT * FROM violations";
                                            $result = $conn->execute_query($query);
                                            while ($row = $result->fetch_object()) {
                                            ?>
                                                <option value="<?= $row->id ?>"><?= $row->Case ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <label class="form-label"><br></label>
                                        <select name="Violation" class="custom-select">
                                            <option value="" selected disabled>-Violation-</option>
                                            <?php
                                            $query = "SELECT * FROM violations";
                                            $result = $conn->execute_query($query);
                                            while ($row = $result->fetch_object()) {
                                            ?>
                                                <option value="<?= $row->id ?>"><?= $row->Violation ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="collapse mb-3" id="collapseAddViolation">
                                <div class="card card-body">
                                    <form class="user" action="includes/process.php" method="POST">
                                        <div class="mb-3 row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Classification" class="form-label">Classification <span class="text-danger">*</span></label>
                                                <select name="Classification" class="custom-select">
                                                    <option value="" selected disabled>--</option>
                                                    <option value="Family">Family</option>
                                                    <option value="Drug">Drug</option>
                                                    <option value="Regular">Regular</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Case" class="form-label">Case</label>
                                                <input type="text" class="form-control" id="Case" name="Case" value="" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Violation" class="form-label">Violation <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="Violation" name="Violation" value="" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Description" class="form-label">Description</label>
                                            <textarea class="form-control" id="Description" name="Description" required></textarea>
                                        </div>
                                        <div class="text-right">
                                            <input type="hidden" name="AddViolation" />
                                            <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#collapseAddViolation">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="collapse mb-3" id="collapseEditViolation">
                                <div class="card card-body">
                                    <form class="user" action="includes/process.php" method="POST">
                                        <div class="mb-3 row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Classification" class="form-label">Classification <span class="text-danger">*</span></label>
                                                <select id="Classification" name="Classification" class="custom-select">
                                                    <option value="" selected disabled>--</option>
                                                    <option value="Family">Family</option>
                                                    <option value="Drugs">Drug</option>
                                                    <option value="Regular">Regular</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Case" class="form-label">Case</label>
                                                <input type="text" class="form-control" id="Case" name="Case" value="" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Violation" class="form-label">Violation <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="Violation" name="Violation" value="" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Description" class="form-label">Description</label>
                                            <textarea class="form-control" id="Description" name="Description" required></textarea>
                                        </div>
                                        <div class="text-right">
                                            <input type="hidden" name="id" id="id" />
                                            <input type="hidden" name="UpdateViolation" />
                                            <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#collapseEditViolation">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Violation ID</th>
                                            <th>Classification</th>
                                            <th>Case</th>
                                            <th>Violation</th>
                                            <!-- <th>Description</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM violations";
                                        $result = $conn->execute_query($query, []);
                                        while ($row = $result->fetch_object()) {
                                        ?>
                                            <tr>
                                                <td class="text-center text-nowrap"><?= $row->id ?></td>
                                                <td class="text-nowrap"><?= $row->Classification ?></td>
                                                <td class="text-nowrap"><?= $row->Case ?></td>
                                                <td class="text-nowrap"><?= $row->Violation ?></td>
                                                <!-- <td class="text-nowrap"><?= $row->Description ?></td> -->
                                                <td class="text-center text-nowrap">
                                                    <button class='upd-btn btn btn-success btn-sm rounded-0 mx-1' data-editviolation="<?= $row->id ?>" data-toggle="collapse" data-target="#collapseEditViolation" aria-expanded="false" aria-controls="collapseEditViolation"><i class="fas fa-edit"></i></button>
                                                    <a class='del-btn btn btn-danger btn-sm rounded-0 mx-1' href="includes/process.php?DeleteViolation=<?= $row->id ?>"><i class="fas fa-trash"></i></a>
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
            var EditViolation = $(this).data('editviolation');
            $.ajax({
                url: "includes/fetch.php",
                method: "POST",
                data: {
                    EditViolation: EditViolation
                },
                dataType: "json",
                success: function(data) {
                    jQuery('#collapseEditViolation #Classification').val(data.Classification);
                    jQuery('#collapseEditViolation #Case').val(data.Case);
                    jQuery('#collapseEditViolation #Violation').val(data.Violation);
                    jQuery('#collapseEditViolation #Description').val(data.Description);
                    jQuery('#collapseEditViolation #id').val(EditViolation);
                },
                error: function() {
                    alert("Error fetching events from the server.");
                },
            });
        });
    </script>
</body>

</html>