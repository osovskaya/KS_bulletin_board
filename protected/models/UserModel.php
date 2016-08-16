<?php

if (!file_exists(__DIR__ . '/../helpers/PDOConnection.php'))
{
    return false;
}

require_once(__DIR__ . '/../helpers/PDOConnection.php');
require_once(__DIR__ . '/../helpers/Validator.php');


class UserModel
{
    private static $db;

    private static $fields = array(
        'firstname', 'lastname', 'email', 'password',
        );

    private static $validationRules = array(
        'firstname' => [
            'string' => ['length_max' => 20],
        ],
        'lastname' => [
            'string' => ['length_maxh' => 20],
            ],
        'email' => [
            'string' => ['length_max' => 50],
            ],
        'password' => [
            'string' => ['length_strict' => 8],
            ],
        );

    /**
     * @return bool|mixed
     */
    public static function addUser()
    {
        $validator = new Validator(self::$fields, self::$validationRules);
        // check for required and extra fields
        if (!$validator->checkFields(array_keys($_POST))) return false;

        // validate data
        if (!$validator->validateFields($_POST)) return false;

        // save user in database
        self::$db = PDOConnection::getInstance();
        self::$db->getConnection();
        self::$db->prepareStatement(
                'INSERT INTO users (firstname, lastname, email, password)
                 VALUES (:firstname, :lastname, :email, :password)'
            );

        self::$db->executeStatement(array(
            ':firstname' => $_POST['firstname'],
            ':lastname'  => $_POST['lastname'],
            ':email'     => $_POST['email'],
            ':password'  => hash('sha512', $_POST['password']),
        ));

        return self::getUserInfo(self::$db->getLastInsertId('users_id_seq'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getUserInfo($id)
    {
        self::$db = PDOConnection::getInstance();
        self::$db->getConnection();
        self::$db->prepareStatement("SELECT * FROM users WHERE id = :id");
        self::$db->executeStatement(array('id' => (int) $id));
        return self::$db->fetchOne();
    }

    /**
     * @return bool|mixed
     */
    public static function updateUserInfo()
    {
        $validator = new Validator(self::$fields, self::$validationRules);

        // validate data
        if (!$validator->validateFields($_POST)) return false;

        // save user in database
        self::$db = PDOConnection::getInstance();
        self::$db->getConnection();
        self::$db->prepareStatement(
            'UPDATE users set firstname = :firstname, lastname = :lastname, email = :email where id = :id'
        );

        self::$db->executeStatement(array(
            ':firstname' => $_POST['firstname'],
            ':lastname'  => $_POST['lastname'],
            ':email'     => $_POST['email'],
            ':id'        => $_POST['id'],
        ));

        return self::$db->executeStatement(array(
            ':firstname' => $_POST['firstname'],
            ':lastname'  => $_POST['lastname'],
            ':email'     => $_POST['email'],
            ':id'        => $_POST['id'],
        ));
    }

    /**
     * @return mixed
     */
    public static function authorize()
    {
        self::$db = PDOConnection::getInstance();
        self::$db->getConnection();
        self::$db->prepareStatement("SELECT * FROM users WHERE email = :email AND password = :password");
        self::$db->executeStatement(array(':email' => $_POST['email'], ':password' => hash('sha512', $_POST['password'])));
        return self::$db->fetchOne();
    }
}
