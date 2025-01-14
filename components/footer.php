<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="includes/logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php
if (!is_null($acc->ChangePassword)) {
?>
    <!-- Change Password Modal -->
    <div class="modal fade" id="passwordModal" data-backdrop="static" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Change Password</h5>
                </div>
                <div class="modal-body">
                    <!-- Password change form -->
                    <form class="user" action="includes/process.php" method="POST">
                        <div class="mb-3">
                            <label for="NewPassword" class="form-label">New Password</label>

                            <input type="password"  id="myInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="Must contain number, one uppercase and one lowercase letter, special characters and at least 8 or more characters" class="form-control" id="NewPassword" name="NewPassword" required> 
<input type="checkbox" onclick="myFunction()">Show Password

<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
                       
                       
                       
                            <!-- Show pass-->
                        </div>
                        <div class="mb-3">
                            <label for="VerifyPassword" class="form-label">Confirm New Password</label>
                            <input type="password"  id="Input" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="Must contain number, one uppercase and one lowercase letter, special characters and at least 8 or more characters" class="form-control" id="VerifyPassword" name="VerifyPassword" required> 
<input type="checkbox" onclick="Function()">Show Password

<script>
function Function() {
  var x = document.getElementById("Input");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
                      
                      
                      
                      
                            <!-- Show pass-->
                       











    <!---asta frends lang-->
                        </div>
                        <hr>
                        <div class="mb-3">
                            <input type="hidden" name="ChangePassword" />
                            <a href="includes/logout.php" class="btn btn-secondary">Logout</a>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a href="#" data-toggle="modal" data-target="#passwordModal">asdasdas</a>
    <script>
        window.onload = function() {
            $('#passwordModal').modal('show');
        };
    </script>
<?php
}
?>


<script>
    function downloadJS(cert) {
        window.jsPDF = window.jspdf.jsPDF;

        var doc = new jsPDF();

        // Source HTMLElement or a string containing HTML.
        var elementHTML = document.querySelector(cert);

        doc.html(elementHTML, {
            callback: function(doc) {
                // Save the PDF
                doc.save(cert + '.pdf');
            },
            x: 15,
            y: 15,
            width: 170, // target width in the PDF document
            windowWidth: 650 // window width in CSS pixels
        });
    }
</script>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>