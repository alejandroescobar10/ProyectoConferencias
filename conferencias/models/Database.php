<?php
class Database
{
    private static $instance = null;

    public static function connect()
    {
        if (!self::$instance) {
            try {
                self::$instance = new PDO("mysql:host=localhost;dbname=parcial3", "alejandroEscobar", "Edwardjunior10");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
