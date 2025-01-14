<?php
$page = "Dashboard";
$Role = "Operator";
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
                    <!-- <h1 class="h3 mb-4 text-gray-800">Dashboard</h1> -->

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Accused Card Example -->
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Accused</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $conn->query("SELECT * FROM accused")->num_rows; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Active Cases
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $conn->query("SELECT * FROM cases WHERE status!='Archived'")->num_rows; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Archived Cases Card Example -->
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Archived Cases</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $conn->query("SELECT * FROM cases WHERE status='Archived'")->num_rows; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-8 col-lg-7">
                            <div class="mb-3">
                                <label for="caseNo" class="form-label">Case No.:</label>
                                <input type="text" id="inputCaseNo" onkeyup="findCaseNo()" class="form-control w-50" id="caseNo" />
                            </div>
                            <div class="mb-3">
                                <label for="violation" class="form-label">For:</label>
                                <textarea class="form-control" id="violation"></textarea>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-5">
                            <div class="mb-3">
                                <label for="dateFiled" class="form-label">Date Filed:</label>
                                <input type="date" class="form-control" id="dateFiled" />
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Most Recent Cases</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="caseRecordsTable" style="cursor:pointer" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-nowrap">Case No</th>
                                                    <th class="text-nowrap">Accused ID</th>
                                                    <th class="text-nowrap">First Name</th>
                                                    <th class="text-nowrap">Middle Name</th>
                                                    <th class="text-nowrap">Last Name</th>
                                                    <th class="text-nowrap">Case</th>
                                                    <th class="text-nowrap">Violation</th>
                                                    <th class="text-nowrap">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_GET['Classification'])) {
                                                    $violations = "SELECT * FROM `cases` WHERE `Classification` = ?";
                                                    $result = $conn->execute_query($violations, [$_GET['Classification']]);
                                                } else {
                                                    $violations = "SELECT *, cr.Description as Notes FROM `cases` cr LEFT JOIN `accused` ca ON cr.AccusedID = ca.id LEFT JOIN `violations` cv ON cr.ViolationID = cv.id LIMIT 0,5";
                                                    $result = $conn->execute_query($violations, []);
                                                }

                                                while ($row = $result->fetch_object()) {
                                                ?>
                                                    <tr onclick="document.getElementById('Notes').innerHTML = '<?= $row->Notes ?>';document.getElementById('violation').value = '<?= $row->Violation ?>'">
                                                        <td class="text-nowrap">
                                                            <?= $row->CaseNo ?>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <?= $row->AccusedID ?>
                                                        </td>
                                                        <td>
                                                            <?= $row->FirstName ?>
                                                        </td>
                                                        <td>
                                                            <?= $row->MiddleName ?>
                                                        </td>
                                                        <td>
                                                            <?= $row->LastName ?>
                                                        </td>
                                                        <td>
                                                            <?= $row->Case ?>
                                                        </td>
                                                        <td>
                                                            <?= $row->Violation ?>
                                                        </td>
                                                        <td>
                                                            <?= $row->Status ?>
                                                        </td>
                                                        <!-- <td class="small text-center text-nowrap"><button class="small btn btn-primary" data-toggle="modal" data-target="#modalViolation<?= $row->id ?>">Edit</button> <button class="small btn btn-danger" onclick="location = confirm('Are you sure?') == true?'?deleteViolation=<?= $row->id ?>':'#'">Delete</button></td> -->
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <script>
                                            function findCaseNo() {
                                                var input, filter, table, tr, td, i, txtValue;
                                                input = document.getElementById("inputCaseNo");
                                                filter = input.value.toUpperCase();
                                                table = document.getElementById("caseRecordsTable");
                                                tr = table.getElementsByTagName("tr");
                                                for (i = 0; i < tr.length; i++) {
                                                    td = tr[i].getElementsByTagName("td")[0];
                                                    if (td) {
                                                        txtValue = td.textContent || td.innerText;
                                                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                            tr[i].style.display = "";
                                                        } else {
                                                            tr[i].style.display = "none";
                                                        }
                                                    }
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Notes</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" id="Notes">
                                    Notes will display here...
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
                        <span>Copyright &copy;
                            <?= $website ?> 2020
                        </span>
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

</body>

</html>