<?php

require_once __DIR__ . '/../models/User.php';

class AuthController extends BaseController {
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User(null, null, null, null, null);
    }


}