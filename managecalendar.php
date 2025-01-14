<?php
$page = "Calendar";
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
                    <!-- <h1 class="h3 mb-4 text-gray-800">Dashboard</h1> -->

                    <div class="card shadow mb-4">
                        <!-- Card Header -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Calendar</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body" id="Notes">
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var calendarEl = document.getElementById('calendar');

                                    var calendar = new FullCalendar.Calendar(calendarEl, {
                                        initialDate: '<?= date('Y-m-d') ?>',
                                        initialView: 'dayGridMonth',
                                        headerToolbar: {
                                            left: 'prev,next today',
                                            center: 'title',
                                            right: 'dayGridMonth,dayGridWeek'
                                        },
                                        titleFormat: { // will produce something like "Tuesday, September 18, 2018"
                                            month: 'long',
                                            year: 'numeric',
                                            day: 'numeric',
                                            weekday: 'long'
                                        },
                                        select: function(arg) {
                                            console.log(arg.start);
                                            const originalDate = new Date(arg.start);
                                            const formattedDate = originalDate.toLocaleDateString('en-CA'); // Use 'en-CA' for the yyyy-mm-dd format

                                            console.log(formattedDate); // Output: "2023-12-12"

                                            jQuery('#AddModal #Schedule').val(formattedDate);
                                            $('#AddModal').modal('show');
                                        },
                                        eventClick: function(arg) {
                                            var ViewHearing = arg.event.id;
                                            $.ajax({
                                                url: "includes/fetch.php",
                                                method: "POST",
                                                data: {
                                                    ViewHearing: ViewHearing
                                                },
                                                dataType: "json",
                                                success: function(data) {
                                                    jQuery('#ViewModal #CaseNo').val(data.CaseNo);
                                                    jQuery('#ViewModal #Venue').val(data.Venue);
                                                    jQuery('#ViewModal #Schedule').val(data.Schedule);
                                                    jQuery('#ViewModal #Remarks').val(data.Remarks);
                                                },
                                                error: function() {
                                                    alert("Error fetching events from the server.");
                                                },
                                            });
                                            console.log(arg.event.id);
                                            $('#ViewModal').modal('show');
                                        },
                                        height: 'auto',
                                        navLinks: true, // can click day/week names to navigate views
                                        editable: true,
                                        selectable: true,
                                        selectMirror: true,
                                        nowIndicator: true,
                                        events: [
                                            <?php
                                            $result = $conn->query("SELECT * FROM hearings");
                                            while ($row = $result->fetch_object()) {
                                            ?> {
                                                    id: '<?= $row->id ?>',
                                                    title: '<?= $row->Remarks ?>',
                                                    start: '<?= $row->Schedule ?>',
                                                },
                                            <?php
                                            }
                                            ?>

                                        ]
                                    });

                                    calendar.render();
                                });
                            </script>
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Modal -->
            <div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="ViewModalTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ViewModalTitle">View</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">Case No:</p>
                            <input type="text" class="form-control" name="" id="CaseNo" disabled />
                            <p class="text-center">Venue:</p>
                            <input type="text" class="form-control" name="" id="Venue" disabled />
                            <p class="text-center">Schedule:</p>
                            <input type="text" class="form-control" name="" id="Schedule" disabled />
                            <p class="text-center">Remarks:</p>
                            <textarea type="text" class="form-control" name="" id="Remarks" disabled style="resize: none;"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="AddModalTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="AddModalTitle">Add</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="includes/process.php" method="POST" id="AddHearing">
                                <p class="text-center">Case No:</p>
                                <select name="CaseNo" id="CaseNo" class="custom-select" required>
                                    <option value="" selected disabled>--</option>
                                    <?php
                                    $query = "SELECT *  FROM cases";
                                    $result = $conn->execute_query($query, []);
                                    while ($row = $result->fetch_object()) {
                                    ?>
                                        <option value="<?= $row->CaseNo ?>"><?= $row->CaseNo ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <p class="text-center">Venue:</p>
                                <input type="text" class="form-control" name="Venue" id="Venue" required />
                                <p class="text-center">Schedule:</p>
                                <input type="date" class="form-control" name="Schedule" id="Schedule" readonly />
                                <p class="text-center">Remarks:</p>
                                <textarea type="text" class="form-control" name="Remarks" id="Remarks" required style="resize: none;"></textarea>
                                <input type="hidden" name="AddHearing" />
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="AddHearing.submit()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
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