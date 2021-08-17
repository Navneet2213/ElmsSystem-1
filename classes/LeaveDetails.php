<?php

namespace Azhar\ELMS;

class LeaveDetails
{
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function specificLeaveDetail($leave_id)
    {
        $sql = "SELECT * FROM leave_details WHERE leave_id = '$leave_id'";

        $result = $this->conn->query($sql);

        return $result;
    }

    public function createLeaveStatus($date1, $date2, $id)
    {
        $result = $this->conn->query("SELECT id FROM leave_requests WHERE user_id = '$id' ORDER BY id DESC LIMIT 1");

        $last_id = (int)$result->fetch_assoc()["id"];

        $start = date("Y-m-d", strtotime($date1));
        $end = date("Y-m-d", strtotime($date2));

        $sql = "INSERT INTO leave_status (requests_id, from_date, to_date) VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("iss", $last_id, $start,  $end);

        $stmt->execute();
    }

    public function updateLeave($start, $end, $id)
    {
        $date1 = date("Y-m-d", strtotime($start));

        $date2 = date("Y-m-d", strtotime($end));

        $sql = "UPDATE leave_status SET from_date = '$date1', to_date = '$date2', status = 1 WHERE requests_id = '$id'";

        $sql1 = "UPDATE leave_requests SET status = 1 WHERE id = $id";

        $this->conn->query($sql);

        $this->conn->query($sql1);
    }

    public function maxLeave($id)
    {
        $extract = "SELECT * FROM leave_requests lr JOIN leave_details ld ON lr.id = ld.leave_id WHERE lr.id = '$id'";

        $rows = $this->conn->query($extract);

        $user_id = $rows->fetch_assoc()["user_id"];

        $sql = "SELECT * FROM leave_details ld JOIN leave_requests lr ON ld.leave_id = lr.id WHERE lr.user_id = '$user_id' and ld.status = 1 and year(curdate()) = year(ld.leave_applied)";

        $result = mysqli_query($this->conn, $sql);

        $row = mysqli_num_rows($result);

        return $row;
    }

    public function approveUserRequest($id)
    {
        $sql =  "UPDATE leave_status SET status = 1 WHERE requests_id = $id";

        $sql1 = "UPDATE leave_requests SET status = 1 WHERE id = $id";
        
        mysqli_query($this->conn, $sql);

        mysqli_query($this->conn, $sql1);
    }

    public function rejectUserRequest($id, $reason)
    {
        $sql =  "UPDATE leave_status SET status = 2, reason = '$reason' WHERE requests_id = $id";

        $sql1 = "UPDATE leave_requests SET status = 1 WHERE id = $id";
    
        mysqli_query($this->conn, $sql);

        mysqli_query($this->conn, $sql1);
    }

    public function rejectEachLeave($id, $id1)
    {
        $sql = "UPDATE leave_status SET status = 2 WHERE id = '$id'";

        $sql1 = "UPDATE leave_requests SET status = 1 WHERE id = $id1";

        mysqli_query($this->conn, $sql);

        mysqli_query($this->conn, $sql1);
    }

    public function approveEachLeave($id, $id1)
    {
        $sql = "UPDATE leave_status SET status = 1 WHERE id = '$id'";

        $sql1 = "UPDATE leave_requests SET status = 1 WHERE id = $id1";

        mysqli_query($this->conn, $sql);

        mysqli_query($this->conn, $sql1);
    }

    public function showLeaves()
    {
        $sql = "SELECT * FROM leave_requests lr JOIN leave_status ls ON lr.id = ls.requests_id JOIN users u ON u.id = lr.user_id";

        $result = $this->conn->query($sql);

        return $result;
    }
}

?>