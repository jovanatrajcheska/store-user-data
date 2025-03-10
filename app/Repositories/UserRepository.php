<?php
class UserRepository
{
    private $conn;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createUser($user)
    {
        $stmt = $this->conn->prepare("INSERT INTO users (full_name, email, phone, date_of_birth) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user->full_name, $user->email, $user->phone, $user->date_of_birth);
        $stmt->execute();
        $stmt->close();
    }

    public function getUsers($sortColumn = 'full_name', $sortOrder = 'ASC', $limit = 10, $offset = 0)
    {
        $allowedColumns = ['full_name', 'date_of_birth'];
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'full_name';
        }

        $sortOrder = strtoupper($sortOrder) === 'DESC' ? 'DESC' : 'ASC';

        $query = "SELECT * FROM users ORDER BY $sortColumn $sortOrder LIMIT ? OFFSET ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getTotalUsers()
    {
        $query = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }


    public function close()
    {
        $this->conn->close();
    }
}
