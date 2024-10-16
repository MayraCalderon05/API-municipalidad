<?php
class GrupoUsuario {
    private $conn;
    private $table = "grupo_usuario";

    public $id;
    public $nombre;

    public function __construct($db){
        $this->conn = $db;
    }

    // Obtener todos los grupo de usuarios en la base de datoss
    public function obtenerGrupos() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //obtengo un grupo por ID
    public function getGroupById($id){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmc = $this->conn->prepare($query);
        $stmc->bindParam(':id', $this->id);
        $stmc->execute();
        return  $stmc;
    }

    // Crear un grupo de usuarios en la base de datos  nuevo
    public function createGrupo() {
        $query = "INSERT INTO " . $this->table . " (nombre) VALUES (:nombre)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $this->nombre);
        return $stmt->execute();
    }

    // Actualizar un grupo de usuarios en la base de datos
    public function updateGrupo($id) {
        $query = "UPDATE " . $this->table . " SET nombre = :nombre WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Eliminar un grupo de usuarios en la base de datos  
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}
?>