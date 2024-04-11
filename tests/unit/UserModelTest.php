<?php

use PHPUnit\Framework\TestCase;
require_once 'config/config.php';
require_once 'models/UserModel.php';

class UserModelTest extends TestCase
{
    protected $db;
    protected $userModel;

    protected function setUp(): void
    {
        global $db; // Access the $db variable from config.php
        $this->db = $db; // Set $this->db to the database connection
        $this->userModel = new UserModel($this->db);
    }

    public function testCreateUser()
    {
        // Test creating a new user
        $user_name = 'Prakash';
        $user_password = 'Prak@123456';
        $result = $this->userModel->createUser($user_name, $user_password);
        $this->assertTrue($result);

        // Test creating a user with an existing username
        $result = $this->userModel->createUser($user_name, $user_password);
        $this->assertFalse($result);
    }

    public function testLoginUser()
    {
        // Test logging in with correct credentials
        $user_name = 'Karthik';
        $user_password = 'Ka@12345';
        $this->userModel->createUser($user_name, $user_password);
        $result = $this->userModel->loginUser($user_name, $user_password);
        $this->assertTrue($result);

        // Test logging in with incorrect password
        $result = $this->userModel->loginUser($user_name, 'wrongpassword');
        $this->assertFalse($result);

        // Test logging in with non-existing user
        $result = $this->userModel->loginUser('nonexistinguser', 'password');
        $this->assertFalse($result);
    }

    public function testGetUserType()
    {
        // Test getting user type by email
        $user_name = 'Shyam';
        $user_password = 'Shy@m2001';
        $this->userModel->createUser($user_name, $user_password);
        $result = $this->userModel->getUserTypeByEmail($user_name);
        $this->assertEquals('Student', $result);

        // Test getting user type by non-existing email
        $result = $this->userModel->getUserTypeByEmail('nonexistinguser');
        $this->assertNull($result);
    }

    // Add more test cases for other methods as needed
}
?>
