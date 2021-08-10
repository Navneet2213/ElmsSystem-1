<?php 

require_once '../vendor/autoload.php';

use Azhar\Elms\Common\Database;
use Azhar\Elms\Common\Login;
use Azhar\Elms\Inserting\Department;
use Azhar\Elms\Inserting\Employee;
use Azhar\Elms\Updating\ChangePassword;
use Azhar\Elms\Getting\GetLeave;

$database = new Database();
$db = $database->getConnection();

$login = new Login($db);

if(isset($_POST["dep_name"])) {

    $depart = new Department($_POST["dep_name"], $db);

    echo $depart->checkDept();
}

if(isset($_POST["user_email"])) {

    $emp = new Employee($db, $_POST["user_email"]);

    echo $emp->checkUser();
}

if(isset($_POST["dname"])) {

    $dep = new Department($_POST["dname"], $db);

    $dep->create();

    echo "data successfully inserted";
}

if(isset($_POST["newpass"]) && isset($_POST["oldpass"])) {

    session_start();

    if ($login->checkPassword($_SESSION["id"], $_POST["oldpass"])){

        $pass = password_hash($_POST["newpass"], PASSWORD_DEFAULT);

        ChangePassword::changePass($_SESSION["id"], $pass, $db);

    } else {

        echo "CURRENT PASSWORD DOESNOT MATCH";
    }
}

if (isset($_POST["email"])){

    $emp = new Employee($db, $_POST["email"]);

    $result = $emp->userStatus();

    if ($result == "0") {

        echo "Unable To Logged In Please Check The Email For Logged In";

    } elseif ($result == "2") {

        echo "User Is Blocked Contact Admin";
    }
}

if(isset($_POST["id"])){

    $id = base64_decode($_POST["id"]);

    $result = new GetLeave($db);

    $response = $result->getEachLeave($id);

    echo $response;
}

if(isset($_POST["user_leave_id"])){

    $id = base64_decode($_POST["user_leave_id"]);

    $result = new GetLeave($db);

    $response = $result->userLeaveModal($id);

    echo $response;
}

if(isset($_POST["approve"]) && isset($_POST["ids"])){

    $ids = base64_decode($_POST["ids"]);
    
    $total_leave = GetLeave::totalLeave($db, $ids);

    $id = base64_decode($_POST["approve"]);

    $leave_num = new GetLeave($db);

    $leaves_approved = $leave_num->isMaxLeave($id);

    $result = $leaves_approved + $total_leave;

    echo $result;
}

if(isset($_POST["approveS"])){

    $id = base64_decode($_POST["approveS"]);

    $leave_num = new GetLeave($db);

    $result = $leave_num->maxLeave($id);

    echo $result;
}
?>