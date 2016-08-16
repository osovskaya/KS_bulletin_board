<?php

require_once(__DIR__ . '/../helpers/PDOConnection.php');
require_once(__DIR__ . '/../helpers/Validator.php');


class AdModel
{
    private static $db;

    private static $fields = array(
        'title', 'category', 'short_description', 'description', 'image', 'phone', 'author',
        );

    private static $validationRules = array(
        'title' => [
            'string' => ['length_max' => 50],
        ],
        'category' => [
            'integer',
            ],
        'short_description' => [
            'string' => ['length_max' => 50],
            ],
        'description' => [
            'string' => ['length_max' => 255],
            ],
        'image' => [
            'file' => ['mime-type' => 'image/jpeg', 'size' => 1048576],
        ],
        'phone' => [
            'string' => ['length_strict' => 12],
        ],
        'author' => [
            'integer',
        ],
        );

    /**
     * @param $id
     * @return mixed
     */
    public static function getOneAd($id)
    {
        self::$db = PDOConnection::getInstance();
        self::$db->getConnection();
        self::$db->prepareStatement("SELECT ads.*, categories.name, users.firstname, users.lastname 
                                      FROM ads LEFT JOIN categories ON ads.category=categories.id  
                                      LEFT JOIN users on ads.author=users.id
                                      WHERE ads.id = :id");
        self::$db->executeStatement(array(':id' => (int) $id));
        return self::$db->fetchOne();
    }

    public static function getManyAds($filter=false, $offset=0)
    {
        if(!file_exists(__DIR__ . '/../config.php'))
        {
            return false;
        }

        include(__DIR__ . '/../config.php');

        self::$db = PDOConnection::getInstance();
        self::$db->getConnection();

        if ($filter)
        {
            self::$db->prepareStatement("SELECT ads.*, categories.name, users.firstname, users.lastname 
                                      FROM ads LEFT JOIN categories ON ads.category=categories.id  
                                      LEFT JOIN users on ads.author=users.id
                                      WHERE ads.category = :filter ORDER BY ads.created_at DESC LIMIT :limit OFFSET :offset");
            self::$db->executeStatement(array(':filter' => (int) $filter, ':limit' => $config['pagination'], ':offset' => $offset));
        }
        else
        {
            self::$db->prepareStatement("SELECT ads.*, categories.name, users.firstname, users.lastname 
                                      FROM ads LEFT JOIN categories ON ads.category=categories.id   
                                      LEFT JOIN users on ads.author=users.id ORDER BY ads.created_at DESC LIMIT :limit OFFSET :offset");
            self::$db->executeStatement(array(':limit' => $config['pagination'], ':offset' => $offset));
        }
        return self::$db->fetchMany();
    }

    public static function getOwnAds($author, $offset=0)
    {
        if(!file_exists(__DIR__ . '/../config.php'))
        {
            return false;
        }

        include(__DIR__ . '/../config.php');

        self::$db = PDOConnection::getInstance();
        self::$db->getConnection();
        self::$db->prepareStatement("SELECT ads.*, categories.name, users.firstname, users.lastname 
                                      FROM ads JOIN categories ON ads.category=categories.id  
                                      JOIN users on ads.author=users.id
                                      WHERE author = :author ORDER BY ads.created_at DESC LIMIT :limit");
        self::$db->executeStatement(array(':author' => $author, ':limit' => $config['pagination']));
        return self::$db->fetchMany();
    }

    /**
     * @return bool|mixed
     */
    public static function addAd()
    {
        $validator = new Validator(self::$fields, self::$validationRules);

        // check for required and extra fields
        if (!$validator->checkFields(array_keys($_POST))) return false;

        // validate data
        if (!$validator->validateFields($_POST)) return false;

        // validate and upload file
        if (!$validator->validateFiles($_FILES)) return false;
        $filepath = self::uploadFiles();
        if (!$filepath) return false;

        // save user in database
        self::$db = PDOConnection::getInstance();
        self::$db->getConnection();
        self::$db->prepareStatement(
                'INSERT INTO ads (title, category, short_description, description, image, phone, author)
                 VALUES (:title, :category, :short_description, :description, :image, :phone, :author)'
            );

        self::$db->executeStatement(array(
            ':title' => $_POST['title'],
            ':category'  => (int) $_POST['category'],
            ':short_description' => $_POST['short_description'],
            ':description'  => $_POST['description'],
            ':image' => $filepath,
            ':phone' => $_POST['phone'],
            ':author' => (int) $_POST['author'],
        ));

        return self::getOneAd(self::$db->getLastInsertId('ads_id_seq'));
    }

    /**
     * @return bool|mixed
     */
    public static function updateAd()
    {
        self::$db = PDOConnection::getInstance();
        self::$db->getConnection();
        self::$db->prepareStatement(
            'UPDATE ads set title = :title, category = :category, short_description = :short_description, 
            description = :description, phone = :phone, author = :author where id = :id'
        );

        return self::$db->executeStatement(array(
            ':title' => $_POST['title'],
            ':category'  => $_POST['category'],
            ':short_description' => $_POST['short_description'],
            ':description'  => $_POST['description'],
            ':phone' => $_POST['phone'],
            ':author' => (int) $_POST['author'],
            ':id' => (int) $_POST['id'],
        ));
    }

    public static function deleteAd()
    {
        self::$db = PDOConnection::getInstance();
        self::$db->getConnection();
        self::$db->prepareStatement('DELETE FROM ads WHERE id = :id');
        return self::$db->executeStatement(array(':id' => (int) $_POST['id']));
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

    /**
     * @return bool
     */
    protected static function uploadFiles()
    {
        if (count($_FILES) > 1) return false;

        foreach ($_FILES as $key => $file)
        {
            $fileContent = file_get_contents($file['tmp_name']);

            if ($fileContent === false) return false;

            if ($file['type'] != 'image/jpeg') return false;

            $filepath = self::makeFilePath($file['name']);
            $filepathFull = $_SERVER['DOCUMENT_ROOT'] . $filepath;

            if (file_put_contents($filepathFull, $fileContent) === false) return false;
        }
        return $filepath;
    }

    /**
     * @param $prefix
     * @param $oldname
     * @return string
     */
    protected static function makeFilePath($oldname)
    {
        $name = explode('.', $oldname);
        $extension = array_pop($name);

        return '/uploads/ads/' . implode('', $name) . '_' . time() . '.' . $extension;
    }
}
