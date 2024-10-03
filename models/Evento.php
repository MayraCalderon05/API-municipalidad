<?php

class Evento {
    private $conn;
    private $table = "eventos";

    public $uid;
    public $nombre;
    public $fecha_inicio;
    public $fecha_finalizacion;
    public $descripcion;
    public $img;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los evento en la base de datoss
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Obtener un solo evento en la base de datos   por ID
    public function getById($uid) {
        $query = "SELECT * FROM " . $this->table . " WHERE uid = :uid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":uid", $uid);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un evento en la base de datos  nuevo
    public function create() {
        $query = "INSERT INTO " . $this->table . " (nombre, fecha_inicio, fecha_finalizacion, descripcion, img) VALUES (:nombre, :fecha_inicio, :fecha_finalizacion, :descripcion, :img)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':fecha_inicio', $this->fecha_inicio);
        $stmt->bindParam(':fecha_finalizacion', $this->fecha_finalizacion);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':img', $this->img);
        return $stmt->execute();
    }

    // Actualizar un evento en la base de datos
    public function update($uid) {
        $query = "UPDATE " . $this->table . " SET nombre = :nombre, fecha_inicio = :fecha_inicio, fecha_finalizacion = :fecha_finalizacion, descripcion = :descripcion, img = :img WHERE uid = :uid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':fecha_inicio', $this->fecha_inicio);
        $stmt->bindParam(':fecha_finalizacion', $this->fecha_finalizacion);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':img', $this->img);
        return $stmt->execute();
    }

    // Eliminar un evento en la base de datos  
    public function delete($uid) {
        $query = "DELETE FROM " . $this->table . " WHERE uid = :uid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':uid', $uid);
        return $stmt->execute();
    }
}
?>