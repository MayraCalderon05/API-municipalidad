<?php
class Usuario {
    private $conn;
    private $table = "usuario";

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $id_grupo;


    public function  __construct($db) {
        $this->conn = $db;
    }

    //obtengo todos los usuarios de la tabla
    public function getAllUsers() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmc = $this->conn->prepare($query);
        $stmc->execute();
        return $stmc;
    }
    //obtengo un usuario por ID
    public function getUserById($id){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmc = $this->conn->prepare($query);
        $stmc->bindParam(':id', $this->id);
        $stmc->execute();
        return  $stmc;
    }
    //crear un usuario nuevo
    public function createUser() {
        $query = 'INSERT INTO ' . $this->table . ' (nombre, apellido, email, password, telefono) VALUES (:nombre, :apellido, :email, :password, :telefono)';
        $stmc = $this->conn->prepare($query);
        $stmc->bindParam(':nombre', $this->nombre);
        $stmc->bindParam(':apellido', $this->apellido);
        $stmc->bindParam(':email', $this->email);
        $stmc->bindParam(':password', $this->password);
        $stmc->bindParam(':telefono', $this->telefono);
        $stmc->execute();
        return $stmc;

    }
    //actualizar usuario
    public function updateUsuario($id){
        $query = 'UPDATE ' . $this->table . ' SET nombre = :nombre, apellido = :apellido, email = :email, password = :password, telefono = :telefono WHERE  id = :id';
        $stmc = $this->conn->prepare($query);
        $stmc->bindParam(':nombre', $this->nombre);
        $stmc->bindParam(':apellido', $this->apellido);
        $stmc->bindParam(':email', $this->email);
        $stmc->bindParam(':password', $this->password);
        $stmc->bindParam(':telefono', $this->telefono);
        $stmc->execute();
        return $stmc;
    }
    //eliminar un usuario
    public function deleteUsuario($id){
        $query =  'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmc =  $this->conn->prepare($query);
        $stmc->bindParam(':id', $this->id);
        return $stmc->execute();
    }

    public function login($email, $password) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email LIMIT 1';
        $stmc = $this->conn->prepare($query);
        $stmc->bindParam(':email', $email);
        $stmc->execute();
    
        if ($stmc->rowCount() > 0) {
            $user = $stmc->fetch(PDO::FETCH_ASSOC);
    
            // Verifica la contraseña (considera usar password_hash y password_verify para mayor seguridad)
            if ($user['password'] === $password) {  // Cambia esto por password_verify si usas hashing
                return $user; // Devuelve los datos del usuario
            }
        }
        return null; // Usuario no encontrado o contraseña incorrecta
    }
    
}
?>