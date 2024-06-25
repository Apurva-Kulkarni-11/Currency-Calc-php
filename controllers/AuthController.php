<?php
require_once '../config/db.php';
require_once '../models/user.php';

class AuthController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function login($username, $password, $ip) {
        return $this->user->validateUser($username, $password, $ip);
    }

    public function logout() {
        session_destroy();
    }
}
?> 
