<?php

require_once(__DIR__ . '/../helpers/PDOConnection.php');


class CategoryModel
{
    private static $db;

    public static function getOneCategory($id)
    {
        self::$db = PDOConnection::getInstance();
        self::$db->getConnection();
        self::$db->prepareStatement("SELECT * FROM categories WHERE id = :id");
        self::$db->executeStatement(array(':id' => (int) $id));
        return self::$db->fetchOne();
    }

    public static function getManyCategories()
    {
        self::$db = PDOConnection::getInstance();
        self::$db->getConnection();
        self::$db->prepareStatement("SELECT * FROM categories");
        self::$db->executeStatement();
        return self::$db->fetchMany();
    }
}
