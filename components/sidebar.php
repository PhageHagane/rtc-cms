<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-text mx-3">
            <?= $website ?>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php
    if (isset($_SESSION["Role"]) && $_SESSION["Role"] == "Admin") {
        ?>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="Admin.php">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="manageusers.php">
                <i class="fas fa-user"></i> <!-- Example icon for User Management -->
                <span>User Management</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="managecases.php">
                <i class="fas fa-briefcase"></i> <!-- Example icon for Case Management -->
                <span>Case Management</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="manageaccused.php">
                <i class="fas fa-users"></i> <!-- Example icon for Accused Management -->
                <span>Accused Management</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="manageviolations.php">
                <i class="fas fa-ban"></i> <!-- Example icon for Accused Management -->
                <span>Violations</span>
            </a>
        </li>

        <!-- <li class="nav-item">
            <a class="nav-link" href="managedocuments.php">
                <i class="fas fa-file"></i>
                <span>Documents</span>
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="managearchived.php">
                <i class="fas fa-briefcase"></i> <!-- Example icon for Case Management -->
                <span>Archived</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="managecalendar.php">
                <i class="fas fa-calendar"></i>
                <span>Calendar</span>
            </a>
        </li>
        <?php
    }
    if (isset($_SESSION["Role"]) && $_SESSION["Role"] == "Operator") {
        ?>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="Operator.php">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="cases.php">
                <i class="fas fa-briefcase"></i> <!-- Example icon for Case Management -->
                <span>Case List</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="accused.php">
                <i class="fas fa-users"></i> <!-- Example icon for Accused Management -->
                <span>Accused List</span>
            </a>
        </li>

        <!-- <li class="nav-item">
            <a class="nav-link" href="documents.php">
                <i class="fas fa-file"></i>
                <span>Documents</span>
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="archived.php">
                <i class="fas fa-briefcase"></i> <!-- Example icon for Case Management -->
                <span>Archived</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="calendar.php">
                <i class="fas fa-calendar"></i> <!-- Example icon for Case Management -->
                <span>Calendar</span>
            </a>
        </li>
        <?php
    }
    ?>
</ul>
<!-- End of Sidebar -->
<script>
    // Get the current page URL
    var currentPageURL = window.location.href.split("/");
    currentPageURL = currentPageURL[currentPageURL.length - 1];

    // Get all the elements with class "nav-link"
    var navLinks = document.getElementsByClassName("nav-link");

    // Loop through the nav-links and check if their href matches the current page URL
    for (var i = 0; i < navLinks.length; i++) {
        var navLink = navLinks[i];
        if (navLink.getAttribute("href") === currentPageURL) {
            // Add the "active" class to the parent <li> element
            navLink.parentElement.classList.add("active");
        }
    }
</script>