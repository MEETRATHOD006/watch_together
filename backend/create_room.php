<?php
include 'db.php';

// Set CORS headers
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // Replace * with a specific domain if needed in production
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Validate POST data
$input = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($input['room_id'], $input['room_name'], $input['admin_name'])) {
    $roomId = trim($input['room_id']);
    $roomName = trim($input['room_name']);
    $adminName = trim($input['admin_name']);

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
    echo json_encode(['status' => 'error', 'message' => 'Invalid request. Please provide Room ID, Room Name, and Admin Name.']);
}
?>
