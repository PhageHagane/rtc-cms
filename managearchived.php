<?php
$page = "Case Management";
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
                    <h1 class="h3 mb-2 text-gray-800">
                        <?= $page ?>
                    </h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Cases List</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-right">
                                <!-- <button class="btn btn-outline-primary" type="button" data-toggle="collapse"
                                    data-target="#collapseAddCase" aria-expanded="false"
                                    aria-controls="collapseAddCase">
                                    Add Violation
                                </button> -->
                            </p>
                            <div class="collapse mb-3" id="collapseAddCase">
                                <div class="card card-body">
                                    <form class="user" action="includes/process.php" method="POST">
                                        <div class="mb-3 row">
                                            <div class="col-lg-6 col-md-6">
                                                <label class="form-label">AccusedID <span
                                                        class="text-danger">*</span></label>
                                                <select name="AccusedID" class="custom-select">
                                                    <option value="" selected disabled>--</option>
                                                    <?php
                                                    $query = "SELECT * FROM accused";
                                                    $result = $conn->execute_query($query);
                                                    while ($row = $result->fetch_object()) {
                                                        ?>
                                                        <option value="<?= $row->id ?>">
                                                            <?= $row->AccusedID ?> |
                                                            <?= $row->FirstName ?>
                                                            <?= $row->LastName ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label class="form-label">ViolationID</label>
                                                <select name="ViolationID" class="custom-select">
                                                    <option value="" selected disabled>--</option>
                                                    <?php
                                                    $query = "SELECT * FROM violations";
                                                    $result = $conn->execute_query($query);
                                                    while ($row = $result->fetch_object()) {
                                                        ?>
                                                        <option value="<?= $row->id ?>">
                                                            <?= $row->Violation ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="Status" class="custom-select">
                                                <option value="" selected disabled>--</option>
                                                <option value="Filed">Filed</option>
                                                <option value="Under Investigation">Under Investigation</option>
                                                <option value="On Trial">On Trial</option>
                                                <option value="Closed">Closed</option>
                                                <option value="Convicted">Convicted</option>
                                                <option value="Acquitted">Acquitted</option>
                                                <option value="Dismissed">Dismissed</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 row">
                                            <!-- ... existing code ... -->
                                            <div class="col-lg-6 col-md-6">
                                                <label class="form-label">Trial Date</label>
                                                <input type="date" class="form-control" name="TrialDate">
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label class="form-label">Hearing Date</label>
                                                <input type="date" class="form-control" name="HearingDate">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Verdict</label>
                                            <input type="text" class="form-control" name="Verdict">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sentence</label>
                                            <input type="text" class="form-control" name="Sentence">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Notes</label>
                                            <textarea class="form-control" name="Description" required></textarea>
                                        </div>
                                        <div class="text-right">
                                            <input type="hidden" name="AuthorID" value="<?= $acc->id ?>" />
                                            <input type="hidden" name="AddCase" />
                                            <button type="button" class="btn btn-secondary" data-toggle="collapse"
                                                data-target="#collapseAddCase">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="collapse mb-3" id="collapseEditCase">
                                <div class="card card-body">
                                    <form class="user" action="includes/process.php" method="POST">
                                        <div class="mb-3 row">
                                            <div class="col-lg-6 col-md-6">
                                                <label class="form-label">AccusedID <span
                                                        class="text-danger">*</span></label>
                                                <select name="AccusedID" id="AccusedID" class="custom-select">
                                                    <option value="" selected disabled>--</option>
                                                    <?php
                                                    $query = "SELECT * FROM accused";
                                                    $result = $conn->execute_query($query);
                                                    while ($row = $result->fetch_object()) {
                                                        ?>
                                                        <option value="<?= $row->id ?>">
                                                            <?= $row->AccusedID ?> |
                                                            <?= $row->FirstName ?>
                                                            <?= $row->LastName ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label class="form-label">ViolationID</label>
                                                <select name="ViolationID" id="ViolationID" class="custom-select">
                                                    <option value="" selected disabled>--</option>
                                                    <?php
                                                    $query = "SELECT * FROM violations";
                                                    $result = $conn->execute_query($query);
                                                    while ($row = $result->fetch_object()) {
                                                        ?>
                                                        <option value="<?= $row->id ?>">
                                                            <?= $row->Violation ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="Status" id="Status" class="custom-select">
                                                <option value="" selected disabled>--</option>
                                                <option value="Filed">Filed</option>
                                                <option value="Under Investigation">Under Investigation</option>
                                                <option value="On Trial">On Trial</option>
                                                <option value="Closed">Closed</option>
                                                <option value="Convicted">Convicted</option>
                                                <option value="Acquitted">Acquitted</option>
                                                <option value="Dismissed">Dismissed</option>
                                                <option value="Archived">Archived</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <!-- ... existing code ... -->
                                            <div class="col-lg-6 col-md-6">
                                                <label class="form-label">Trial Date</label>
                                                <input type="date" class="form-control" name="TrialDate">
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label class="form-label">Hearing Date</label>
                                                <input type="date" class="form-control" name="HearingDate">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Verdict</label>
                                            <input type="text" class="form-control" name="Verdict">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sentence</label>
                                            <input type="text" class="form-control" name="Sentence">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Notes</label>
                                            <textarea class="form-control" name="Description" id="Description"
                                                required></textarea>
                                        </div>
                                        <div class="text-right">
                                            <input type="hidden" name="id" id="id" />
                                            <input type="hidden" name="AuthorID" value="<?= $acc->id ?>" />
                                            <input type="hidden" name="EditCase" />
                                            <button type="button" class="btn btn-secondary" data-toggle="collapse"
                                                data-target="#collapseEditCase">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Case No.</th>
                                            <th>Accused ID</th>
                                            <th>Name</th>
                                            <th>Case</th>
                                            <th>Violation</th>
                                            <th>Status</th>
                                            <th>Date Archived</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT
                                            c.id,
                                            c.`CaseNo`,
                                            a.`AccusedID`,
                                            CONCAT(a.`FirstName` , ' ' , a.`LastName`) as Name,
                                            v.`Case`,
                                            v.`Violation`,
                                            c.`Status`,
                                            c.`UpdatedAt`
                                        FROM cases c
                                            LEFT JOIN users u ON c.`AuthorID` = c.id
                                            LEFT JOIN accused a ON c.`AccusedID` = a.id
                                            LEFT JOIN violations v ON c.`ViolationID` = v.id WHERE c.Status='Archived'";
                                        $result = $conn->execute_query($query, []);
                                        while ($row = $result->fetch_object()) {
                                            ?>
                                            <tr>
                                                <td class="text-center text-nowrap">
                                                    <?= $row->CaseNo ?>
                                                </td>
                                                <td class="text-nowrap">
                                                    <?= $row->AccusedID ?>
                                                </td>
                                                <td class="text-nowrap">
                                                    <?= $row->Name ?>
                                                </td>
                                                <td class="text-nowrap">
                                                    <?= $row->Case ?>
                                                </td>
                                                <td class="text-nowrap">
                                                    <?= $row->Violation ?>
                                                </td>
                                                <td class="text-nowrap">
                                                    <?= $row->Status ?>
                                                </td>
                                                <td class="text-nowrap">
                                                    <?= date_format(date_create($row->UpdatedAt),'d/m/Y') ?>
                                                </td>
                                                <td class="text-center text-nowrap">
                                                    <button class='upd-btn btn btn-success btn-sm rounded-0 mx-1'
                                                        data-editcase="<?= $row->id ?>" data-toggle="collapse"
                                                        data-target="#collapseEditCase" aria-expanded="false"
                                                        aria-controls="collapseEditCase"><i
                                                            class="fas fa-edit"></i></button>
                                                    <a class='del-btn btn btn-danger btn-sm rounded-0 mx-1'
                                                        href="includes/process.php?DeleteCase=<?= $row->id ?>"><i
                                                            class="fas fa-trash"></i></a>
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
        $('.upd-btn').click(function () {
            var EditCase = $(this).data('editcase');
            $.ajax({
                url: "includes/fetch.php",
                method: "POST",
                data: {
                    EditCase: EditCase
                },
                dataType: "json",
                success: function (data) {
                    jQuery('#collapseEditCase #AccusedID').val(data.AccusedID);
                    jQuery('#collapseEditCase #ViolationID').val(data.ViolationID);
                    jQuery('#collapseEditCase #Status').val(data.Status);
                    jQuery('#collapseEditCase #Description').val(data.Description);
                    jQuery('#collapseEditCase #id').val(EditCase);
                },
                error: function () {
                    alert("Error fetching events from the server.");
                },
            });
        });
    </script>
</body>

</html>