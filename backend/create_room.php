<?php
include 'db.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Origin: *");  // Or specify a specific domain instead of *
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Validate POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['room_id']) && isset($_POST['room_name']) && isset($_POST['admin_name'])) {
    $roomId = $_POST['room_id'];
    $roomName = $_POST['room_name'];
    $adminName = $_POST['admin_name'];

    if (empty($roomId) || empty($roomName) || empty($adminName)) {
        echo json_encode(['status' => 'error', 'message' => 'Room ID, Room Name, and Admin Name cannot be empty']);
        exit();
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO rooms (room_id, room_name, admin_name) VALUES (?, ?, ?)");
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
        exit();
    }

    $stmt->bind_param("sss", $roomId, $roomName, $adminName);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Room created successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Execute failed: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
