<?php
require_once '../config/config.php';
require_once '../app/Repositories/UserRepository.php';
require_once '../app/Services/UserService.php';

$userRepository = new UserRepository(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$userService = new UserService($userRepository);

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * 10;
$users = $userService->getUsers($offset);
$totalUsers = $userService->getTotalUsers();
$totalPages = ceil($totalUsers / 10);

$userService->closeConnection();

include '../views/list.php';
