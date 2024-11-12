<?php

class User
{
    private $db;

    public function __construct($db)
    {

        $this->db = $db;
    }

    public function register($codigo, $correo, $clave, $rol)
    {
        $hashedPassword = password_hash($clave, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO usuarios (codigo,correo, clave, rol ) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$codigo, $correo, $hashedPassword, $rol]);
    }

    public function login($correo, $clave)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        $user = $stmt->fetch();

        if ($user && password_verify($clave, $user['clave'])) {
            return $user; // Retorna datos del usuario si el login es exitoso
        }

        return false;
    }
}
