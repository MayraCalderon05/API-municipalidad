<?php
    header("Access-Conttelefono-Allow-Origin: *");  // Permite todas las fuentes
    header("Access-Conttelefono-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  // Métodos permitidos
    header("Access-Conttelefono-Allow-Headers: Content-Type, Authorization");  // Encabezados permitidos

    include_once '../core/Database.php';
    include_once '../models/GrupoUsuario.php';

    class GrupoController {
        private $db;
        private $grupo;

        public function __construct() {
            $database  = new Database();
            $this->db = $database->getConnection();
            $this->grupo = new GrupoUsuario($this->db);
        }

        //crear un grupo
        public function  createGroup($data){
            $this->grupo->nombre = $data->nombre;
            
            if ($this->grupo->createGrupo()) {
                return json_encode(["message" => "Grupo creado con éxito"]);
            }
            return json_encode(["message" => "Error al crear el grupo"]);
        }

        //obtener  todos los grupos desde el meyodo del modelo
        public function getGrupos(){
            $stmc = $this->grupo->obtenerGrupos();
            $grupos = $stmc->fetchALL(PDO::FETCH_ASSOC);
            return json_encode($grupos);
        }

        //obtener un grupo por id
        public function getGroupById($id){
            $grupo = $this->grupo->getGroupById($id);
            return json_encode($grupo);
        }

        //actualizar un grupo
        public function updateGrupo($id, $data){
            $this->grupo->nombre = $data->nombre;
            if ($this->grupo->updateGrupo($id)) {

                return json_encode(["message" => "Grupo actualizado con éxito"]);
            }
            return json_encode(["message"=>"Ha habido un error al actualizar el grupo"]);
        }

        //eliminar un grupo
        public function deleteGrupo($id){
            if ($this->grupo->delete($id)) {
                return  json_encode(["message" => "Grupo eliminado con éxito"]);
            }
            return  json_encode(["message" => "Ha habido un error al eliminar el grupo"]);
        }

    }

?>