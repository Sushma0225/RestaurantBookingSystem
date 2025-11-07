<?php
session_start();
include 'db.php'; // Your DB connection file

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $email = trim($data['email'] ?? '');
    $password = trim($data['password'] ?? '');
    $dob = trim($data['dob'] ?? '');
    $action = $data['action'] ?? '';

    // Validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Invalid email format."]);
        exit;
    }

    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Password must be at least 6 characters."]);
        exit;
    }

    if ($action === "register") {
        // Check if email already exists
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(["status" => "error", "message" => "Email already registered."]);
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (email, password,dob) VALUES (?, ?,?)");
            $stmt->bind_param("sss", $email, $hashed,$dob);
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Registration successful."]);
            } else {
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => "Something went wrong."]);
            }
            $stmt->close();
        }
        $check->close();
    }

    elseif ($action === "login") {
        $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 1) {
            $row = $res->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Set session
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];

                echo json_encode([
                    "status" => "success",
                    "message" => "Login successful!",
                    "user" => [
                        "id" => $row['id'],
                        "email" => $row['email']
                    ]
                ]);
            } else {
                http_response_code(401);
                echo json_encode(["status" => "error", "message" => "Incorrect password."]);
            }
        } else {
            http_response_code(404);
            echo json_encode(["status" => "error", "message" => "User not found."]);
        }
        $stmt->close();
    }

    else {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Invalid action."]);
    }

    $conn->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["status" => "error", "message" => "Only POST method allowed."]);
}
?>
