<?php
require_once '../config/config.php';
require_once '../app/Models/User.php';
require_once '../app/Repositories/UserRepository.php';
require_once '../app/Services/UserService.php';

$userRepository = new UserRepository(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$userService = new UserService($userRepository);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $date_of_birth = $_POST['date_of_birth'];

    if (!empty($full_name) && filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/^[0-9]+$/', $phone) && !empty($date_of_birth)) {
        $user = new User($full_name, $email, $phone, $date_of_birth);
        $userService->createUser($user);
        header("Location: /store-user-data/public/index.php");
        exit;
    } else {
        $error = "Please fill in all fields correctly.";
    }
}

$userService->closeConnection();

include '../views/form.php';
