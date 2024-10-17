<?php

class Evento {
    private $conn;
    private $table = "eventos";

    public $id;
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
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
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
    public function update($id) {
        $query = "UPDATE " . $this->table . " SET nombre = :nombre, fecha_inicio = :fecha_inicio, fecha_finalizacion = :fecha_finalizacion, descripcion = :descripcion, img = :img WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':fecha_inicio', $this->fecha_inicio);
        $stmt->bindParam(':fecha_finalizacion', $this->fecha_finalizacion);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':img', $this->img);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Eliminar un evento en la base de datos  
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>