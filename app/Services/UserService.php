<?php
class UserService
{
    private $userRepository;

    public function __construct($userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser($user)
    {
        $this->userRepository->createUser($user);
    }

    public function getTotalUsers()
    {
        return $this->userRepository->getTotalUsers();
    }

    public function getUsers($sortColumn = 'full_name', $sortOrder = 'ASC', $limit = 10, $offset = 0)
    {
        return $this->userRepository->getUsers($sortColumn, $sortOrder, $limit, $offset);
    }

    public function closeConnection()
    {
        $this->userRepository->close();
    }
}
