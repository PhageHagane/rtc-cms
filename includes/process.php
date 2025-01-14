<?php

// requires
require_once 'conn.php';
require_once "sendmail.php";

session_start();

$response = array();

if (isset($_POST['ForgotPassword'])) {
    $Email = $conn->real_escape_string($_POST['Email']);
    $ChangePassword = substr(strtoupper(uniqid()), 0, 8);
    $HashedPassword = password_hash($ChangePassword, PASSWORD_DEFAULT);
    $ExpiryPassword = time() + (2 * 60);

    $query = "UPDATE users SET ChangePassword = '$ChangePassword', HashedPassword = '$HashedPassword', ExpiryPassword = $ExpiryPassword WHERE Email = '$Email'";

    $query2 = "SELECT * FROM users WHERE `Email` = ?";
    $result2 = $conn->execute_query($query2, [$Email]);

    if ($result2->num_rows > 0) {
        $row = $result2->fetch_object();
        sendEmail($row->Email, 'HOJ Password Reset Request', "Hello " . $row->FirstName . " " . $row->LastName . ",\n\nWe received a request to reset your password. If you didn't make this request, you can ignore this email. Otherwise, please login using the provided password to reset your previous password:\n\nReset Password: " . $ChangePassword . "\n\nThe password will expire in 120 seconds.\n\nIf you have any questions or need further assistance, please don't hesitate to contact us.\n\nThank you for choosing our service!\n\nSincerely, HOJ Admin\nHall of Justice");

        $response['status'] = 'success';
        $response['message'] = 'Temporary Password Sent!';
        $response['redirect'] = '../login.php';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Email not found!';
    }
}
if (isset($_GET['ResetPassword'])) {
    $ChangePassword = substr(strtoupper(uniqid()), 0, 8);
    $HashedPassword = password_hash($ChangePassword, PASSWORD_DEFAULT);
    $ExpiryPassword = time() + (2 * 60);

    $conn->query("UPDATE users SET `ChangePassword` = '$ChangePassword', `Password` = '$HashedPassword', `ExpiryPassword` = $ExpiryPassword WHERE `id` = '" . $_GET['ResetPassword'] . "'");

    $query2 = "SELECT * FROM users WHERE `id` = ?";
    $result2 = $conn->execute_query($query2, [$_GET['ResetPassword']]);
    while ($row = $result2->fetch_object()) {
        sendEmail($row->Email, 'HOJ Password Reset Request', "Hello " . $row->FirstName . " " . $row->LastName . ",\n\nWe received a request to reset your password. If you didn't make this request, you can ignore this email. Otherwise, please login using the provided password to reset your previous password:\n\nReset Password: " . $ChangePassword . "\n\nThe password will expire in 120 seconds.\n\nIf you have any questions or need further assistance, please don't hesitate to contact us.\n\nThank you for choosing our service!\n\nSincerely, HOJ Admin\nHall of Justice");

        $response['status'] = 'success';
        $response['message'] = 'Temporary Password sent!';
        $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../manageusers.php' : '../users.php';
    }
}

// Registration
if (isset($_POST['Register'])) {
    $FirstName = $conn->real_escape_string($_POST['FirstName']);
    $MiddleName = $conn->real_escape_string($_POST['MiddleName']);
    $LastName = $conn->real_escape_string($_POST['LastName']);
    $Email = $conn->real_escape_string($_POST['Email']);
    $Username = $conn->real_escape_string($_POST['Username']);
    $Password = $conn->real_escape_string($_POST['Password']);
    $Verify = $conn->real_escape_string($_POST['Verify']);

    if ($Verify == $Password) {
        $HashedPassword = password_hash($Password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `users` (`FirstName`,`MiddleName`,`LastName`,`Email`,`Username`,`Password`) VALUES (?,?,?,?,?,?)";
        try {

            $result = $conn->execute_query($query, [$FirstName, $MiddleName, $LastName, $Email, $Username, $HashedPassword]);

            if ($result) {

                $response['status'] = 'success';
                $response['message'] = 'Registration successful!';
                $response['redirect'] = '../login.php';
            } else {

                $response['status'] = 'error';
                $response['message'] = 'Registration failed!';
            }
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
        }
    } else {

        $response['status'] = 'error';
        $response['message'] = 'Password don\'t match!';
    }
}

// Login
if (isset($_POST['Login'])) {

    $Username = $conn->real_escape_string($_POST['Username']);
    $Password = $conn->real_escape_string($_POST['Password']);

    $query = "SELECT * FROM users where Username=?";

    try {
        $result = $conn->execute_query($query, [$Username]);

        if ($result && $result->num_rows === 1) {

            $row = $result->fetch_object();


            if (!empty($row->ExpiryPassword)) {
                if (time() > intval($row->ExpiryPassword)) {

                    $response['status'] = 'error';
                    $response['message'] = 'Expired Temporary Password!';
                } else {
                    if (password_verify($Password, $row->Password)) {

                        $_SESSION['Username'] = $Username;
                        $_SESSION['Role'] = $row->Role;

                        unset($_SESSION["HashedPassword"]);

                        $response['status'] = 'success';
                        $response['message'] = 'Login successful!';
                        $response['redirect'] = '../index.php';
                    } else {

                        $response['status'] = 'error';
                        $response['message'] = 'Invalid Password!';
                    }
                }
            } else {

                if (password_verify($Password, $row->Password)) {

                    $_SESSION['Username'] = $Username;
                    $_SESSION['Role'] = $row->Role;

                    $response['status'] = 'success';
                    $response['message'] = 'Login successful!';
                    $response['redirect'] = '../index.php';
                } else {

                    $response['status'] = 'error';
                    $response['message'] = 'Invalid Password!';
                }
            }
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Username not found!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

// Update Profile
if (isset($_POST['UpdateProfile'])) {
    $FirstName = $conn->real_escape_string($_POST['FirstName']);
    $MiddleName = $conn->real_escape_string($_POST['MiddleName']);
    $LastName = $conn->real_escape_string($_POST['LastName']);
    $Username = $conn->real_escape_string($_POST['Username']);
    $Email = $conn->real_escape_string($_POST['Email']);

    $query = "UPDATE `users` SET `Username`=?,`FirstName`=?,`MiddleName`=?,`LastName`=?,`Email`=? WHERE `Username`=?";
    try {

        $result = $conn->execute_query($query, [$Username, $FirstName, $MiddleName, $LastName, $Email, $_SESSION["Username"]]);

        if ($result) {

            $_SESSION["Username"] = $Username;

            $response['status'] = 'success';
            $response['message'] = 'Profile Updated!';
            $response['redirect'] = '../profile.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Failed Updating Profile!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

// Update Password
if (isset($_POST['UpdatePassword'])) {
    $CurrentPassword = $conn->real_escape_string($_POST['CurrentPassword']);
    $NewPassword = $conn->real_escape_string($_POST['NewPassword']);
    $VerifyPassword = $conn->real_escape_string($_POST['VerifyPassword']);

    $query = "SELECT * FROM users where Username=?";

    try {
        $result = $conn->execute_query($query, [$_SESSION['Username']]);

        if ($result && $result->num_rows === 1) {

            $row = $result->fetch_object();

            if (password_verify($CurrentPassword, $row->Password)) {
                if ($NewPassword == $VerifyPassword) {
                    $HashedPassword = password_hash($NewPassword, PASSWORD_DEFAULT);
                    $query2 = "UPDATE `users` SET `Password`=? WHERE `Username`=?";
                    try {

                        $result2 = $conn->execute_query($query2, [$HashedPassword, $_SESSION["Username"]]);

                        if ($result2) {

                            $response['status'] = 'success';
                            $response['message'] = 'Password Changed!';
                            $response['redirect'] = '../profile.php';
                        } else {

                            $response['status'] = 'error';
                            $response['message'] = 'Failed changing password!';
                        }
                    } catch (Exception $e) {
                        $response['status'] = 'error';
                        $response['message'] = $e->getMessage();
                    }
                } else {

                    $response['status'] = 'error';
                    $response['message'] = 'Password don\'t match!';
                }
            } else {

                $response['status'] = 'error';
                $response['message'] = 'Invalid Password!';
            }
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Username not found!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}
// Update Password
if (isset($_POST['ChangePassword'])) {
    $NewPassword = $conn->real_escape_string($_POST['NewPassword']);
    $VerifyPassword = $conn->real_escape_string($_POST['VerifyPassword']);

    $query = "SELECT * FROM users where Username=?";

    try {
        $result = $conn->execute_query($query, [$_SESSION['Username']]);

        if ($result && $result->num_rows === 1) {
            if ($NewPassword == $VerifyPassword) {
                $HashedPassword = password_hash($NewPassword, PASSWORD_DEFAULT);
                $query2 = "UPDATE `users` SET `Password` = ?, `ChangePassword` = NULL, `ExpiryPassword` = NULL WHERE `Username` = ?";
                try {

                    $result2 = $conn->execute_query($query2, [$HashedPassword, $_SESSION["Username"]]);

                    if ($result2) {

                        $response['status'] = 'success';
                        $response['message'] = 'Password Changed!';
                        $response['redirect'] = '../' . $_SESSION['Role'] . '.php';
                    } else {

                        $response['status'] = 'error test';
                        $response['message'] = 'Failed changing password!';
                    }
                } catch (Exception $e) {
                    $response['status'] = 'error';
                    $response['message'] = $e->getMessage();
                }
            } else {

                $response['status'] = 'error';
                $response['message'] = 'Password don\'t match!';
            }
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Username not found!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

// Modify Accused
if (isset($_POST['AddAccused'])) {
    $AccusedID = rand(10000000, 99999999);
    $FirstName = $conn->real_escape_string($_POST['FirstName']);
    $MiddleName = $conn->real_escape_string($_POST['MiddleName']);
    $LastName = $conn->real_escape_string($_POST['LastName']);
    $Sex = $conn->real_escape_string($_POST['Sex']);
    $DateOfBirth = $conn->real_escape_string($_POST['DateOfBirth']);
    $Contact = $conn->real_escape_string($_POST['Contact']);
    $Email = $conn->real_escape_string($_POST['Email']);
    $Address = $conn->real_escape_string($_POST['Address']);

    $query = "INSERT INTO `accused`( `AccusedID`, `FirstName`, `MiddleName`, `LastName`, `Sex`, `DateOfBirth`, `Contact`, `Email`, `Address`) VALUES(?,?,?,?,?,?,?,?,?)";
    try {
        $result = $conn->execute_query($query, [$AccusedID, $FirstName, $MiddleName, $LastName, $Sex, $DateOfBirth, $Contact, $Email, $Address]);
        if ($result) {

            $response['status'] = 'success';
            $response['message'] = 'Accused Inserted!';
            $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../manageaccused.php' : '../accused.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Registration failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_POST['UpdateAccused'])) {
    $FirstName = $conn->real_escape_string($_POST['FirstName']);
    $MiddleName = $conn->real_escape_string($_POST['MiddleName']);
    $LastName = $conn->real_escape_string($_POST['LastName']);
    $Sex = $conn->real_escape_string($_POST['Sex']);
    $DateOfBirth = $conn->real_escape_string($_POST['DateOfBirth']);
    $Contact = $conn->real_escape_string($_POST['Contact']);
    $Email = $conn->real_escape_string($_POST['Email']);
    $Address = $conn->real_escape_string($_POST['Address']);

    $query = "UPDATE `accused` SET `FirstName` = ?, `MiddleName` = ?, `LastName` = ?, `Sex` = ?, `DateOfBirth` = ?, `Contact` = ?, `Email` = ?, `Address` = ? WHERE `id` = ?";
    try {
        $result = $conn->execute_query($query, [$FirstName, $MiddleName, $LastName, $Sex, $DateOfBirth, $Contact, $Email, $Address, $_POST['id']]);
        if ($result) {

            $response['status'] = 'success';
            $response['message'] = 'Accused Updated!';
            $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../manageusers.php' : '../users.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Update failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_GET['DeleteAccused'])) {
    ?>
    <script>
    // JavaScript confirmation prompt
    if (confirm("Are you sure you want to delete?")) {
        window.location.href = "<?php echo $_SERVER['PHP_SELF'] . '?confirmedDelete=' . $_GET['DeleteAccused']; ?>";
    } else {
        // Redirect back to the previous page or any other page as needed
        window.location.href = "<?php echo $_SESSION['Role'] == 'Admin' ? '../manageaccused.php' : '../accused.php'; ?>";
    }
    </script>
    <?php
}

if (isset($_GET['confirmedDelete'])) {
    $idToDelete = $_GET['confirmedDelete'];
    $query = "DELETE FROM accused WHERE `id` = ?";
    try {
        $result = $conn->execute_query($query, [$idToDelete]);
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'Accused Deleted!';
            $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../manageaccused.php' : '../accused.php';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Delete failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}



// Modify User
if (isset($_POST['AddUser'])) {
    $FirstName = $conn->real_escape_string($_POST['FirstName']);
    $MiddleName = $conn->real_escape_string($_POST['MiddleName']);
    $LastName = $conn->real_escape_string($_POST['LastName']);
    $Username = $conn->real_escape_string($_POST['Username']);
    $Email = $conn->real_escape_string($_POST['Email']);
    $Role = $conn->real_escape_string($_POST['Role']);
    $Status = $conn->real_escape_string($_POST['Status']);
    $Password = substr(strtoupper(uniqid()), 0, 8);

    $HashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    $query = "INSERT INTO `users`(`FirstName`, `MiddleName`, `LastName`, `Username`, `Password`, `Email`, `Role`, `Status`, `ChangePassword`) VALUES(?,?,?,?,?,?,?,?,?)";
    try {
        $result = $conn->execute_query($query, [$FirstName, $MiddleName, $LastName, $Username, $HashedPassword, $Email, $Role, $Status, $Password]);
        if ($result) {

            sendEmail($Email, 'Your HOJ Account Information', "Hello " . $FirstName . " " . $LastName . ",\n\nYour account has been created. Here are your login details:\n\nUsername: " . $Username . "\nPassword: " . $Password . "\n\nYou can now use these credentials to log in to your account.\n\nIf you have any questions or need further assistance, please don't hesitate to contact us.\n\nThank you for choosing our service!\n\nSincerely, HOJ Admin\nHall of Justice");

            $response['status'] = 'success';
            $response['message'] = 'New User Inserted!';
            $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../manageusers.php' : '../users.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Adding failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_POST['UpdateUser'])) {
    $FirstName = $conn->real_escape_string($_POST['FirstName']);
    $MiddleName = $conn->real_escape_string($_POST['MiddleName']);
    $LastName = $conn->real_escape_string($_POST['LastName']);
    $Username = $conn->real_escape_string($_POST['Username']);
    $Email = $conn->real_escape_string($_POST['Email']);
    $Role = $conn->real_escape_string($_POST['Role']);
    $Status = $conn->real_escape_string($_POST['Status']);

    $query = "UPDATE `users` SET `FirstName` = ?, `MiddleName` = ?, `LastName` = ?, `Username` = ?, `Email` = ?, `Role` = ?, `Status` = ? WHERE `id` = ?";
    try {
        $result = $conn->execute_query($query, [$FirstName, $MiddleName, $LastName, $Username, $Email, $Role, $Status, $_POST['id']]);
        if ($result) {

            $response['status'] = 'success';
            $response['message'] = 'User Updated!';
            $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../manageusers.php' : '../users.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Update failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_GET['DeleteUser'])) {
    ?>
    <script>
    // JavaScript confirmation prompt
    if (confirm("Are you sure you want to delete?")) {
        window.location.href = "<?php echo $_SERVER['PHP_SELF'] . '?confirmedDelete=' . $_GET['DeleteUser']; ?>";
    } else {
        // Redirect back to the previous page or any other page as needed
        window.location.href = "<?php echo $_SESSION['Role'] == 'Admin' ? '../manageusers.php' : '../users.php'; ?>";
    }
    </script>
    <?php
}

if (isset($_GET['confirmedDelete'])) {
    $idToDelete = $_GET['confirmedDelete'];
    $query = "DELETE FROM users WHERE `id` = ?";
    try {
        $result = $conn->execute_query($query, [$idToDelete]);
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'User Deleted!';
            $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../manageusers.php' : '../users.php';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Delete failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}





//Modify Violations
if (isset($_POST['AddViolation'])) {
    $Classification = $conn->real_escape_string($_POST['Classification']);
    $Case = $conn->real_escape_string($_POST['Case']);
    $Violation = $conn->real_escape_string($_POST['Violation']);
    $Description = $conn->real_escape_string($_POST['Description']);

    $query = "INSERT INTO `violations`( `Classification`, `Case`, `Violation`, `Description`) VALUES(?,?,?,?)";
    try {
        $result = $conn->execute_query($query, [$Classification, $Case, $Violation, $Description]);
        if ($result) {

            $response['status'] = 'success';
            $response['message'] = 'Violation Inserted!';
            $response['redirect'] = '../manageviolations.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Registration failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_POST['UpdateViolation'])) {
    $Classification = $conn->real_escape_string($_POST['Classification']);
    $Case = $conn->real_escape_string($_POST['Case']);
    $Violation = $conn->real_escape_string($_POST['Violation']);
    $Description = $conn->real_escape_string($_POST['Description']);

    $query = "UPDATE `violations` SET `Classification` = ?, `Case` = ?, `Violation` = ?, `Description` = ? WHERE `id` = ?";
    try {
        $result = $conn->execute_query($query, [$Classification, $Case, $Violation, $Description, $_POST['id']]);
        if ($result) {

            $response['status'] = 'success';
            $response['message'] = 'Violation Updated!';
            $response['redirect'] = '../manageviolations.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Update failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_GET['DeleteViolation'])) {

    $query = "DELETE FROM violations WHERE `id` = ?";
    try {
        $result = $conn->execute_query($query, [$_GET['DeleteViolation']]);
        if ($result) {

            $response['status'] = 'success';
            $response['message'] = 'Violation Deleted!';
            $response['redirect'] = '../manageviolations.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Delete failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

//Modify Cases
if (isset($_POST['AddCase'])) {
    $CaseNo = '23-' . rand(100000, 999999);
    $AuthorID = $conn->real_escape_string($_POST['AuthorID']);
    $AccusedID = $conn->real_escape_string($_POST['AccusedID']);
    $ViolationID = $conn->real_escape_string($_POST['ViolationID']);
    $Status = $conn->real_escape_string($_POST['Status']);
    $Description = $conn->real_escape_string($_POST['Description']);
    $TrialDate = $conn->real_escape_string($_POST['TrialDate']);
    $HearingDate = $conn->real_escape_string($_POST['HearingDate']);
    $Verdict = $conn->real_escape_string($_POST['Verdict']);
    $Sentence = $conn->real_escape_string($_POST['Sentence']);

    $query = "INSERT INTO `cases`( `CaseNo`, `AuthorID`, `AccusedID`, `ViolationID`, `Status`, `Description`, `TrialDate`, `HearingDate`, `Verdict`, `Sentence`) VALUES(?,?,?,?,?,?,?,?,?,?)";
    try {
        $result = $conn->execute_query($query, [$CaseNo, $AuthorID, $AccusedID, $ViolationID, $Status, $Description, $TrialDate, $HearingDate, $Verdict, $Sentence]);
        if ($result) {

            $id = $conn->insert_id;
            $result2 = $conn->query("SELECT * FROM cases c LEFT JOIN accused a ON c.AccusedID=a.id WHERE c.id=$id");
            while ($row = $result2->fetch_object()) {
                sendEmail($row->Email, 'HOJ - Case Filed', "Hello " . $row->FirstName . " " . $row->LastName . ",\n\nI hope this email finds you well. We would like to inform you of the upcoming hearing for your case with the following details:\n\nCase Number: " . $CaseNo . "\nDate: " . $HearingDate . "\nTime: 8:30 AM\n\n\nPlease make sure to arrive at least 10 minutes before the scheduled time. If you have any questions or concerns, please don't hesitate to contact this email.\n\nYour presence at the hearing is crucial, and we appreciate your cooperation in this matter. If, for any reason, you are unable to attend, please notify us as soon as possible.\n\nThank you for your attention to this matter, and we look forward to the resolution of your case.\n\nSincerely, HOJ Admin\nHall of Justice");
            }

            $response['status'] = 'success';
            $response['message'] = 'Case Inserted!';
            $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../managecases.php' : '../cases.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Registration failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_POST['EditCase'])) {
    $AccusedID = $conn->real_escape_string($_POST['AccusedID']);
    $ViolationID = $conn->real_escape_string($_POST['ViolationID']);
    $Status = $conn->real_escape_string($_POST['Status']);
    $Description = $conn->real_escape_string($_POST['Description']);

    $query = "UPDATE `cases` SET `AccusedID` = ?, `ViolationID` = ?, `Status` = ?, `Description` = ? WHERE `id` = ?";
    try {
        $result = $conn->execute_query($query, [$AccusedID, $ViolationID, $Status, $Description, $_POST['id']]);
        if ($result) {

            $response['status'] = 'success';
            $response['message'] = 'Case Updated!';
            $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../managecases.php' : '../cases.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Update failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_GET['DeleteCase'])) {
    ?>
    <script>
    // JavaScript confirmation prompt
    if (confirm("Are you sure you want to delete?")) {
        window.location.href = "<?php echo $_SERVER['PHP_SELF'] . '?confirmedDelete=' . $_GET['DeleteCase']; ?>";
    } else {
        // Redirect back to the previous page or any other page as needed
        window.location.href = "<?php echo $_SESSION['Role'] == 'Admin' ? '../managecases.php' : '../cases.php'; ?>";
    }
    </script>
    <?php
}

if (isset($_GET['confirmedDelete'])) {
    $idToDelete = $_GET['confirmedDelete'];
    $query = "DELETE FROM cases WHERE `id` = ?";
    try {
        $result = $conn->execute_query($query, [$idToDelete]);
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'Case Deleted!';
            $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../managecases.php' : '../cases.php';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Delete failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}





//Modify Document
if (isset($_POST['AddDocument'])) {
    $File = $_FILES['File']['name'];
    $extension = pathinfo($File, PATHINFO_EXTENSION);
    $Document = $conn->real_escape_string($_POST['Document']);
    $Case = $conn->real_escape_string($_POST['Case']);
    $Description = $conn->real_escape_string($_POST['Description']);

    $FileName = uniqid() . '.' . $extension;
    $FileTmp = $_FILES['File']['tmp_name'];
    $Destination = 'uploads/' . $FileName;

    if (move_uploaded_file($FileTmp, $Destination)) {
        $query = "INSERT INTO `documents`( `Document`, `Description`, `FilePath`, `CaseNum`) VALUES(?,?,?,?)";
        try {
            $result = $conn->execute_query($query, [$Document, $Description, $Destination, $Case]);
            if ($result) {

                $response['status'] = 'success';
                $response['message'] = 'Document Inserted!';
                $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../managedocuments.php' : '../documents.php';
            } else {

                $response['status'] = 'error';
                $response['message'] = 'Registration failed!';
            }
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to upload file!';
    }
}

if (isset($_POST['UpdateDocument'])) {
    $Document = $conn->real_escape_string($_POST['Document']);
    $Case = $conn->real_escape_string($_POST['Case']);
    $Description = $conn->real_escape_string($_POST['Description']);

    $query = "UPDATE `documents` SET `Document` = ?, `CaseNum` = ?, `Description` = ? WHERE `id` = ?";
    try {
        $result = $conn->execute_query($query, [$Document, $Case, $Description, $_POST['id']]);
        if ($result) {

            $response['status'] = 'success';
            $response['message'] = 'Document Updated!';
            $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../managedocuments.php' : '../documents.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Update failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_GET['DeleteDocument'])) {

    $query = "DELETE FROM documents WHERE `id` = ?";
    try {
        $result = $conn->execute_query($query, [$_GET['DeleteDocument']]);
        if ($result) {

            $response['status'] = 'success';
            $response['message'] = 'Document Deleted!';
            $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../managedocuments.php' : '../documents.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Delete failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}


if (isset($_POST['AddHearing'])) {
    $CaseNo = $conn->real_escape_string($_POST['CaseNo']);
    $Venue = $conn->real_escape_string($_POST['Venue']);
    $Schedule = $conn->real_escape_string($_POST['Schedule']);
    $Remarks = $conn->real_escape_string($_POST['Remarks']);

    $query = "INSERT INTO `hearings`( `CaseNo`, `Venue`, `Schedule`, `Remarks`) VALUES(?,?,?,?)";
    try {
        $result = $conn->execute_query($query, [$CaseNo, $Venue, $Schedule, $Remarks]);
        if ($result) {

            $response['status'] = 'success';
            $response['message'] = 'Hearing Scheduled!';
            $response['redirect'] = $_SESSION['Role'] == 'Admin' ? '../managecalendar.php' : '../calendar.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Registration failed!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Response Page</title>
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <script>
        // Parse the JSON response from PHP
        var response = <?php echo $responseJSON; ?>;

        // Display a SweetAlert notification based on the response
        if (response.status == 'success') {
            Swal.fire({
                title: 'Success',
                text: response.message,
                icon: 'success',
            }).then(function () {
                // Redirect to the specified URL
                window.location.href = response.redirect;
            });
        } else if (response.status == 'error') {
            Swal.fire({
                title: 'Error',
                text: response.message,
                icon: 'error',
            }).then(function () {
                // Redirect to the specified URL
                history.back();
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: 'there is something wrong!',
                icon: 'error',
            }).then(function () {
                // Redirect to the specified URL
                history.back();
            });
        }
    </script>
</body>

</html>