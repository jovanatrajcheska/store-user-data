<?php
require_once '../config/config.php';
require_once '../app/Models/User.php';
require_once '../app/Repositories/UserRepository.php';
require_once '../app/Services/UserService.php';

$userRepository = new UserRepository(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$userService = new UserService($userRepository);

$validSortColumns = ['full_name', 'date_of_birth'];
$sortColumn = isset($_GET['sort']) && in_array($_GET['sort'], $validSortColumns) ? $_GET['sort'] : 'full_name';
$sortOrder = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$users = $userService->getUsers($sortColumn, $sortOrder, $limit, $offset);
$totalUsers = $userService->getTotalUsers();
$totalPages = ceil($totalUsers / $limit);
?>


<head>
    <meta charset="UTF-8">
    <title>Shortlister User Data Management app</title>
    <link rel="stylesheet" href="/store-user-data/public/css/style.css">
</head>
<div class="table-container">
    <div class="table-header">
        <h2>Users List</h2>
        <a href="/store-user-data/public/create.php" class="add-user-button">Create User</a>
    </div>
    <table class="styled-table">
        <thead>
            <tr>
                <th><a href="?sort=full_name&order=<?php echo $sortOrder === 'ASC' ? 'desc' : 'asc'; ?>&page=<?php echo $page; ?>">Full Name</a></th>
                <th>Email</th>
                <th>Phone</th>
                <th><a href="?sort=date_of_birth&order=<?php echo $sortOrder === 'ASC' ? 'desc' : 'asc'; ?>&page=<?php echo $page; ?>">Date of Birth</a></th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                    <td><a href="mailto:<?php echo htmlspecialchars($user['email']); ?>"><?php echo htmlspecialchars($user['email']); ?></a></td>
                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                    <td><?php echo htmlspecialchars($user['date_of_birth']); ?></td>
                    <td>
                        <?php
                        $dob = new DateTime($user['date_of_birth']);
                        $now = new DateTime();
                        $interval = $now->diff($dob);
                        echo $interval->y;
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>&sort=<?php echo $sortColumn; ?>&order=<?php echo strtolower($sortOrder); ?>" class="prev">&larr; Previous</a>
        <?php endif; ?>
        <span class="page-info">Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>
        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>&sort=<?php echo $sortColumn; ?>&order=<?php echo strtolower($sortOrder); ?>" class="next">Next &rarr;</a>
        <?php endif; ?>
    </div>
</div>