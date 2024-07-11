<?php
include 'db.php';

$action = $_GET['action'];

if ($action == 'create') {
    $position_name = $_POST['position'];
    $department = $_POST['department'];
    $description = $_POST['description'];

    $sql = "INSERT INTO positions (position_name, department, description) VALUES ('$position_name', '$department', '$description')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Position created successfully"]);
    } else {
        echo json_encode(["status" => "fail", "message" => "Error: " . $conn->error]);
    }
}

if ($action == 'read') {
    $sql = "SELECT * FROM positions";
    $result = $conn->query($sql);
    $positions = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $positions[] = $row;
        }
        echo json_encode($positions);
    } else {
        echo json_encode([]);
    }
}

if ($action == 'update') {
    $id = $_POST['id'];
    $position_name = $_POST['position'];
    $department = $_POST['department'];
    $description = $_POST['description'];

    $sql = "UPDATE positions SET position_name='$position_name', department='$department', description='$description' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Position updated successfully"]);
    } else {
        echo json_encode(["status" => "fail", "message" => "Error: " . $conn->error]);
    }
}

if ($action == 'delete') {
    $id = $_POST['id'];

    $sql = "DELETE FROM positions WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Position deleted successfully"]);
    } else {
        echo json_encode(["status" => "fail", "message" => "Error: " . $conn->error]);
    }
}

$conn->close();
?>
