<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shortlister User Data Management app</title>
    <link rel="stylesheet" href="/store-user-data/public/css/style.css">
</head>

<body>

    <div class="form-container">
        <div class="form-header">
            <h2>Create User</h2>
            <a href="/store-user-data/public/index.php" class="view-user-button">View Users</a>
        </div>

        <?php if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        } ?>

        <form action="" method="post" id="createUserForm">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" placeholder="Enter full name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" placeholder="Enter phone number" required pattern="[0-9]+" title="Please enter digits only">

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>

            <input type="submit" value="Submit">
        </form>
    </div>

    <script>
        document.getElementById('createUserForm').addEventListener('submit', function(event) {
            const form = event.target;
            if (!form.checkValidity()) {
                event.preventDefault();
                alert("Please fill in all fields correctly before submitting.");
            }
        });
    </script>

</body>

</html>