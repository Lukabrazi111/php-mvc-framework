<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{
    protected string $firstname;
    protected string $lastname;
    protected string $username;
    protected string $email;
    protected string $password;
    protected string $confirmPassword;

    public function rules()
    {
        return [
            'firstname' => [self::$RULE_REQUIRED],
            'lastname' => [self::$RULE_REQUIRED],
            'username' => [self::$RULE_REQUIRED, [self::$RULE_MIN, 'min' => 7]],
            'email' => [self::$RULE_REQUIRED, self::$RULE_EMAIL],
            'password' => [self::$RULE_REQUIRED, [self::$RULE_MAX, 'max' => 60]],
            'confirmPassword' => [self::$RULE_MATCH, 'match' => 'password'],
        ];
    }

    public function loadData($data)
    {
        return $data;
    }

}