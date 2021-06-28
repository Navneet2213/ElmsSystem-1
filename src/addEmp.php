<?php
include '_db.php';
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    
  header("location: ../index.php");
  
  exit;
}
  
if ($_SERVER['REQUEST_METHOD']=="POST") {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $dob   = $_POST['dob'];
    $number= $_POST['number'];
    $empid = $_POST['empid']; 
    $dname = $_POST['dname'];
    $utype = $_POST['utype'];

    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    
    $common = (new Employee($db, $email));

    $common->check_user();

    Email::sendEmail($email, $empid);

    $common->create_user($empid, $fname, $lname, $dname, $utype);

    $common->create_detail($number, $dob);

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="bg-secondary">
    <div class="w-50 mx-auto">
      <h2>Fill Out The Detail With Valid Email Address</h2>
      <form action="" method="POST">
        <div class="mb-3">
          <label for="fname" class="form-label">First Name</label>
          <input type="text" class="form-control" name="fname" id="fname">
        </div>
        <div class="mb-3">
          <label for="lname" class="form-label">Last Name</label>
          <input type="text" class="form-control" name="lname" id="lname">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="text" class="form-control" name="email" id="email">
        </div>
        <div class="mb-3">
          <label for="dob" class="form-label">Date Of Birth</label>
          <input type="date" class="form-control" name="dob" id="dob">
        </div>
        <div class="mb-3">
          <label for="number" class="form-label">Phone Number</label>
          <input type="number" class="form-control" name="number" id="number">
        </div>
        <div class="mb-3">
          <label for="empid" class="form-label">Emp Id</label>
          <input type="number" class="form-control" name="empid" id="empid">
        </div>
        <div class="mb-4 mt-4 text-center ">
          <select class="col px-md-4 py-md-1" name="dname" id="dname">
            <option value="" disabled selected>Select Department</option>
            <option value=1>Php</option>
            <option value=2>Python</option>
          </select>
          <select class="col px-md-4 py-md-1" name="utype" id="utype">
            <option value="" disabled selected>Select User Type</option>
            <option value=0>User</option>
            <option value=1>Admin</option>
          </select>
        </div>
        
        <div class="col-md-12 text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a class="btn btn-primary" href="admin.php">Cancel</a>
          <button type="reset" class="btn btn-primary">Clear</button>
        </div>
      </form>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>