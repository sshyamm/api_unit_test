<?php

use PHPUnit\Framework\TestCase;
require_once '../../config/config.php';
require_once '../models/UserModel.php';

class UserModelTest extends TestCase
{
    protected $db;
    protected $userModel;

    protected function setUp(): void
    {
        $this->userModel = new UserModel($this->db);
    }

    public function testCreateUser()
    {
        // Test creating a new user
        $user_name = 'testuser';
        $user_password = 'testpassword';
        $result = $this->userModel->createUser($user_name, $user_password);
        $this->assertTrue($result);

        // Test creating a user with an existing username
        $result = $this->userModel->createUser($user_name, $user_password);
        $this->assertFalse($result);
    }

    public function testLoginUser()
    {
        // Test logging in with correct credentials
        $user_name = 'testuser';
        $user_password = 'testpassword';
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
        $user_name = 'testuser';
        $user_password = 'testpassword';
        $this->userModel->createUser($user_name, $user_password);
        $result = $this->userModel->getUserTypeByEmail($user_name);
        $this->assertEquals('common', $result);

        // Test getting user type by non-existing email
        $result = $this->userModel->getUserTypeByEmail('nonexistinguser');
        $this->assertNull($result);
    }

    // Add more test cases for other methods as needed
}
?>