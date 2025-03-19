<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'classes/UserExcelEditor.php';

try {
    if (!isset($_POST['users']) || empty($_POST['users'])) {
        throw new Exception("No user data provided");
    }

    $usersJson = $_POST['users'];
    $users = json_decode($usersJson, true);

    if ($users === null) {
        throw new Exception("Invalid JSON format");
    }

    $editor = new UserExcelEditor();
    $processedData = $editor->processAndSave('output/users.xlsx', $users);

    $_SESSION['processed_data'] = $processedData;
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
}

header('Location: index.php');
exit;