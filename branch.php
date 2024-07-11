<?php
include 'db.php';

$action = $_GET['action'];

if ($action == 'create') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO branches (name, location, phone) VALUES ('$name', '$location', '$phone')";
    if ($conn->query($sql) === TRUE) {
        $id = $conn->insert_id;
        echo json_encode(["id" => $id, "status" => "success", "message" => "Branch created successfully"]);
    } else {
        echo json_encode(["status" => "fail", "message" => "Error: " . $conn->error]);
    }
}

if ($action == 'read') {
    $sql = "SELECT * FROM branches";
    $result = $conn->query($sql);
    $branches = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $branches[] = $row;
        }
        echo json_encode($branches);
    } else {
        echo json_encode([]);
    }
}

if ($action == 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];

    $sql = "UPDATE branches SET name='$name', location='$location', phone='$phone' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Branch updated successfully"]);
    } else {
        echo json_encode(["status" => "fail", "message" => "Error: " . $conn->error]);
    }
}

if ($action == 'delete') {
    $id = $_POST['id'];

    $sql = "DELETE FROM branches WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Branch deleted successfully"]);
    } else {
        echo json_encode(["status" => "fail", "message" => "Error: " . $conn->error]);
    }
}

$conn->close();
?>
