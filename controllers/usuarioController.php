<?php
    header("Access-Conttelefono-Allow-Origin: *");  // Permite todas las fuentes
    header("Access-Conttelefono-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  // Métodos permitidos
    header("Access-Conttelefono-Allow-Headers: Content-Type, Authorization");  // Encabezados permitidos

    include_once '../core/Database.php';
    include_once '../models/Usuario.php';

    class UsuarioController {
        private $db;
        private $usuario;

        public function __construct() {
            $database  = new Database();
            $this->db = $database->getConnection();
            $this->usuario = new Usuario($this->db);
        }

        //crear un usuario
        public function  registrarUser($data){
            $this->usuario->nombre = $data->nombre;
            $this->usuario->apellido = $data->apellido;
            $this->usuario->email = $data->email;
            $this->usuario->password = $data->password;
            $this->usuario->telefono = $data->telefono;

            #$id_grupo = $data['id_grupo'] ?? null;
            
            if ($this->usuario->createUser()) {
                return json_encode(["message" => "Usuario creado con éxito"]);
            }
            return json_encode(["message" => "Error al crear el usuario"]);
        }

        //obtener  todos los usuarios desde el meyodo del modelo
        public function getAllUsers(){
            $stmc = $this->usuario->getAllUsers();
            $usuarios = $stmc->fetchALL(PDO::FETCH_ASSOC);
            return json_encode($usuarios);
        }

        //obtener usuario por ID desde el metodo del modelo Usuario
        public function getUserById($id){
            $usuario = $this->usuario->getUserById($id);
            return json_encode($usuario);
        }

        //actualizar un usuario
        public function updateUser($id, $data){
            $this->usuario->nombre = $data->nombre;
            $this->usuario->apellido = $data->apellido;
            $this->usuario->email = $data->email;
            $this->usuario->password = $data->password;
            $this->usuario->telefono = $data->telefono;
            if ($this->usuario->updateUser($id)) {

                return json_encode(["message" => "Usuario actualizado con éxito"]);
            }
            return json_encode(["message"=>"Ha habido un error al actualizar el usuario"]);
        }

        //eliminar un usuario
        public function deleteUsuario($id){
            if ($this->usuario->deleteUsuario($id)) {
                return  json_encode(["message" => "Usuario eliminado con éxito"]);
            }
            return  json_encode(["message" => "Ha habido un error al eliminar el usuario"]);
        }

        public function login($data) {
            $user = $this->usuario->login($data->email, $data->password);
        
            if ($user) {
                // Puedes generar un token o sesión aquí si lo deseas
                return json_encode(["message" => "Inicio de sesión exitoso", "user" => $user]);
            }
            return json_encode(["message" => "Credenciales incorrectas"]);
        }

    }

?>