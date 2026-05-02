<?php

session_start();

header('Content-Type: application/json');

require_once "../controllers/reset.controller.php";
require_once "../models/reset.model.php";

try {

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid request method."
        ]);
        exit;
    }

    $action = $_POST["action"] ?? "";

    if ($action === "validate") {

        $currentUsername = trim($_POST["currentUsername"] ?? "");
        $currentPassword = trim($_POST["currentPassword"] ?? "");

        if ($currentUsername === "" || $currentPassword === "") {
            echo json_encode([
                "status" => "error",
                "message" => "Current username and current password are required."
            ]);
            exit;
        }

        echo json_encode(
            ControllerReset::ctrValidateUser($currentUsername, $currentPassword)
        );
        exit;
    }

    if ($action === "reset") {

        $newUsername = trim($_POST["loginUser"] ?? "");
        $newPassword = trim($_POST["loginPass"] ?? "");

        if ($newUsername === "" || $newPassword === "") {
            echo json_encode([
                "status" => "error",
                "message" => "New username and new password are required."
            ]);
            exit;
        }

        echo json_encode(
            ControllerReset::ctrResetCredentials($newUsername, $newPassword)
        );
        exit;
    }

    echo json_encode([
        "status" => "error",
        "message" => "Invalid action."
    ]);
    exit;

} catch (Throwable $e) {

    echo json_encode([
        "status" => "error",
        "message" => "Server error: " . $e->getMessage()
    ]);
    exit;
}