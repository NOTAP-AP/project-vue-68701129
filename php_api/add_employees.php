<?php
include 'condb.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
    exit;
}

// Validate required fields
$required_fields = ['emp_id', 'full_name', 'department', 'salary'];
foreach ($required_fields as $field) {
    if (!isset($data[$field]) || empty(trim($data[$field]))) {
        echo json_encode(['status' => 'error', 'message' => "Field '$field' is required"]);
        exit;
    }
}

$emp_id = trim($data['emp_id']);
$full_name = trim($data['full_name']);
$department = trim($data['department']);
$salary = trim($data['salary']);
$active = isset($data['active']) ? (int)$data['active'] : 1;

try {
    // Check if emp_id already exists
    $stmt = $conn->prepare("SELECT emp_id FROM employees WHERE emp_id = ?");
    $stmt->execute([$emp_id]);
    if ($stmt->fetch()) {
        echo json_encode(['status' => 'error', 'message' => 'Employee ID already exists']);
        exit;
    }

    // Insert new employee
    $stmt = $conn->prepare("INSERT INTO employees (emp_id, full_name, department, salary, active) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$emp_id, $full_name, $department, $salary, $active]);

    echo json_encode(['status' => 'success', 'message' => 'Employee added successfully']);

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>