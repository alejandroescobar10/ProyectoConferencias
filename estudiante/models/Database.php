<?php
class Database
{
    private static $instance = null;

    public static function connect()
    {
        if (!self::$instance) {
            try {
                self::$instance = new PDO("mysql:host=localhost;port=3307;dbname=parcial_3", "root", "");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
