<?php
class User
{
    public $full_name;
    public $email;
    public $phone;
    public $date_of_birth;

    public function __construct($full_name, $email, $phone, $date_of_birth)
    {
        $this->full_name = $full_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->date_of_birth = $date_of_birth;
    }
}
