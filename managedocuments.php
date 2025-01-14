<?php
$page = "Documents";
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
                            <h6 class="m-0 font-weight-bold text-primary">Documents List</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-right">
                                <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseAddDocument" aria-expanded="false" aria-controls="collapseAddDocument">
                                    Add Document
                                </button>
                            </p>
                            <div class="collapse mb-3" id="collapseAddDocument">
                                <div class="card card-body">
                                    <form class="user" action="includes/process.php" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="File" class="form-label">File <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="FileAddon">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="File" name="File" aria-describedby="FileAddon">
                                                    <label class="custom-file-label" for="File">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Document" class="form-label">Document Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="Document" name="Document" value="" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Case" class="form-label">Case</label>
                                                <select name="Case" class="custom-select" required>
                                                    <option value="" selected disabled>--</option>
                                                    <?php
                                                    $query = "SELECT *  FROM cases";
                                                    $result = $conn->execute_query($query, []);
                                                    while ($row = $result->fetch_object()) {
                                                    ?>
                                                        <option value="<?= $row->id ?>"><?= $row->CaseNo ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Description" class="form-label">Description</label>
                                            <textarea class="form-control" id="Description" name="Description" required></textarea>
                                        </div>
                                        <div class="text-right">
                                            <input type="hidden" name="AddDocument" />
                                            <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#collapseAddDocument">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="collapse mb-3" id="collapseEditDocument">
                                <div class="card card-body">
                                    <form class="user" action="includes/process.php" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3 row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Document" class="form-label">Document Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="Document" name="Document" value="" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="Case" class="form-label">Case</label>
                                                <select name="Case" id="Case" class="custom-select" required>
                                                    <option value="" selected disabled>--</option>
                                                    <?php
                                                    $query = "SELECT *  FROM cases";
                                                    $result = $conn->execute_query($query, []);
                                                    while ($row = $result->fetch_object()) {
                                                    ?>
                                                        <option value="<?= $row->id ?>"><?= $row->CaseNo ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Description" class="form-label">Description</label>
                                            <textarea class="form-control" id="Description" name="Description" required></textarea>
                                        </div>
                                        <div class="text-right">
                                            <input type="hidden" name="id" id="id" />
                                            <input type="hidden" name="UpdateDocument" />
                                            <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#collapseEditDocument">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Document ID</th>
                                            <th>Document Name</th>
                                            <th>Description</th>
                                            <th>Case Number</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT d.*, c.CaseNo  FROM documents d JOIN cases c ON d.CaseNum=c.id";
                                        $result = $conn->execute_query($query, []);
                                        while ($row = $result->fetch_object()) {
                                        ?>
                                            <tr>
                                                <td class="text-center text-nowrap"><?= $row->id ?></td>
                                                <td class="text-nowrap"><a href="includes/<?= $row->FilePath ?>" target="_blank"><?= $row->Document ?></a></td>
                                                <td class="text-nowrap"><?= $row->Description ?></td>
                                                <td class="text-nowrap"><?= $row->CaseNo ?></td>
                                                <td class="text-nowrap"><?= $row->CreatedAt ?></td>
                                                <td class="text-center text-nowrap">
                                                    <button class='upd-btn btn btn-success btn-sm rounded-0 mx-1' data-editdocument="<?= $row->id ?>" data-toggle="collapse" data-target="#collapseEditDocument" aria-expanded="false" aria-controls="collapseEditDocument"><i class="fas fa-edit"></i></button>
                                                    <a class='del-btn btn btn-danger btn-sm rounded-0 mx-1' href="includes/process.php?DeleteDocument=<?= $row->id ?>"><i class="fas fa-trash"></i></a>
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
            var EditDocument = $(this).data('editdocument');
            $.ajax({
                url: "includes/fetch.php",
                method: "POST",
                data: {
                    EditDocument: EditDocument
                },
                dataType: "json",
                success: function(data) {
                    jQuery('#collapseEditDocument #Document').val(data.Document);
                    jQuery('#collapseEditDocument #Case').val(data.CaseNum);
                    jQuery('#collapseEditDocument #Description').val(data.Description);
                    jQuery('#collapseEditDocument #id').val(EditDocument);
                },
                error: function() {
                    alert("Error fetching events from the server.");
                },
            });
        });
    </script>
</body>

</html>