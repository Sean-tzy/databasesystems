<?php

class ControllerReset
{
    static public function ctrValidateUser($currentUsername, $currentPassword)
    {
        $table = "userrights";

        $currentUsername = trim($currentUsername);
        $currentPassword = trim($currentPassword);

        $user = ModelReset::mdlGetUserByUsername($table, $currentUsername);

        if (!$user) {
            unset($_SESSION["reset_user_id"]);

            return [
                "status" => "error",
                "message" => "Invalid login credential!"
            ];
        }

        $storedPassword = trim($user["upassword"] ?? "");

        if (!hash_equals($storedPassword, $currentPassword)) {
            unset($_SESSION["reset_user_id"]);

            return [
                "status" => "error",
                "message" => "Invalid login credential!"
            ];
        }

        $_SESSION["reset_user_id"] = $user["id"];

        return [
            "status" => "success",
            "message" => "Validation successful. You may now enter your new username and password."
        ];
    }

    static public function ctrResetCredentials($newUsername, $newPassword)
    {
        if (!isset($_SESSION["reset_user_id"])) {
            return [
                "status" => "error",
                "message" => "Please validate your information first."
            ];
        }

        $newUsername = trim($newUsername);
        $newPassword = trim($newPassword);

        if (strlen($newUsername) < 3) {
            return [
                "status" => "error",
                "message" => "New username must be at least 3 characters."
            ];
        }

        if (strlen($newUsername) > 20) {
            return [
                "status" => "error",
                "message" => "New username must not exceed 20 characters."
            ];
        }

        if (strlen($newPassword) < 1) {
            return [
                "status" => "error",
                "message" => "New password is required."
            ];
        }

        if (strlen($newPassword) > 20) {
            return [
                "status" => "error",
                "message" => "New password must not exceed 20 characters."
            ];
        }

        $table = "userrights";
        $userId = $_SESSION["reset_user_id"];

        $existingUser = ModelReset::mdlGetUserByUsername($table, $newUsername);

        if ($existingUser && (int)$existingUser["id"] !== (int)$userId) {
            return [
                "status" => "error",
                "message" => "Username is already taken. Please choose another username."
            ];
        }

        $data = [
            "id" => $userId,
            "username" => $newUsername,
            "upassword" => $newPassword
        ];

        $answer = ModelReset::mdlUpdateCredentials($table, $data);

        if ($answer === "ok") {
            unset($_SESSION["reset_user_id"]);

            return [
                "status" => "success",
                "message" => "User account succesfully resseted!"
            ];
        }

        return [
            "status" => "error",
            "message" => $answer
        ];
    }
}