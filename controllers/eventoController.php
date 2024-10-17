<?php
header("Access-Control-Allow-Origin: *");  // Permite todas las fuentes
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization");  // Encabezados permitidos

include_once '../models/Evento.php';
include_once '../core/Database.php';

class EventoController {
    private $db;
    private $evento;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->evento = new Evento($this->db);
    }

    // Obtener todos los eventos
    public function getAll() {
        $stmt = $this->evento->getAll();
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($eventos);
    }

    // Obtener un evento por ID
    public function getById($id) {
        $evento = $this->evento->getById($id);
        return json_encode($evento);
    }

    // Crear un nuevo evento
    public function create($data) {
        $this->evento->nombre = $data->nombre;
        $this->evento->fecha_inicio = $data->fecha_inicio;
        $this->evento->fecha_finalizacion = $data->fecha_finalizacion;
        $this->evento->descripcion = $data->descripcion;
        $this->evento->img = $data->img;
        if ($this->evento->create()) {
            return json_encode(["message" => "Evento creado con éxito"]);
        }
        return json_encode(["message" => "Error al crear el evento"]);
    }

    // Actualizar un evento
    public function update($id, $data) {
        $this->evento->nombre = $data->nombre;
        $this->evento->fecha_inicio = property_exists($data, 'fecha_inicio') ? $data->fecha_inicio : null;
    $this->evento->fecha_finalizacion = property_exists($data, 'fecha_finalizacion') ? $data->fecha_finalizacion : null;
        $this->evento->descripcion = $data->descripcion;
        $this->evento->img = $data->img;
        if ($this->evento->update($id)) {
            return json_encode(["message" => "Evento actualizado con éxito"]);
        }
        return json_encode(["message" => "Error al actualizar el evento"]);
    }

    // Eliminar un evento
    public function delete($id) {
        if ($this->evento->delete($id)) {
            return json_encode(["message" => "Evento eliminado con éxito"]);
        }
        return json_encode(["message" => "Error al eliminar el evento"]);
    }
}
?>