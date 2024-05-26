<?php
SESSION_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once ('db.php');
function validateData($data)
{
    $resultData = htmlspecialchars(stripslashes(trim($data)));
    return $resultData;
}
if (isset($_POST['action']) && $_POST['action'] == 'registration') {
    $first_name = validateData($_POST['firstName']);
    $last_name = validateData($_POST['lastName']);
    $email_id = validateData($_POST['emailId']);
    $company = validateData($_POST['company']);
    $title = validateData($_POST['title']);
    $password = validateData($_POST['password']);
    $confirm_password = validateData($_POST['confirmPassword']);
    $error_message = '';
    $checkEmailQuery = $conn->prepare("SELECT * FROM register WHERE email_id = ?");
    $checkEmailQuery->bind_param("s", $emailId);
    $checkEmailQuery->execute();
    $result = $checkEmailQuery->get_result();
    if ($result->num_rows > 0) {
        $error_message = "Email ID already exists !";
        echo $error_message;
    } else {
        $insertQuery = $conn->prepare("INSERT INTO register(first_name, last_name, email_id, company,  title, password) VALUES(?, ?, ?, ?, ?, ?)");
        $password = md5($password);
        $insertQuery->bind_param("ssssss", $first_name, $last_name, $email_id, $company, $title, $password);
        if ($insertQuery->execute()) {
            echo "Thankyou for registering with xXx Car Dealers. You can login now.";
            exit();
        } else {
            $error_message = "error";
        }
        $insertQuery->close();
        $conn->close();

        echo $error_message;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $email_id = validateData($_POST['emailId']);
    $password = validateData($_POST['password']);
    $password = md5($password);
    $error_message = '';
    $selectQuery = $conn->prepare("SELECT * FROM register WHERE email_id = ? and password = ?");
    $selectQuery->bind_param("ss", $email_id, $password);
    $selectQuery->execute();
    $result = $selectQuery->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['username'] = $row['first_name'] . " " . $row['last_name'];
   $member_id = $row['id'];
    $_SESSION['id'] = $member_id;
    $_SESSION['email_id'] = $row['email_id'];
    $_SESSION['password'] = $row['password'];
            $_SESSION['loggedIn'] = true;
            require_once "coverletter.php";
            exit();
        } // endwhile
    } // endif
else {
        $error_message = "error";
    } // endElse
    $conn->close();
    echo $error_message;
}
?>
