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

    // Obtener todos los productos
    public function getAll() {
        $stmt = $this->evento->getAll();
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($eventos);
    }

    // Obtener un producto por ID
    public function getById($uid) {
        $evento = $this->evento->getById($uid);
        return json_encode($evento);
    }

    // Crear un nuevo producto
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

    // Actualizar un producto
    public function update($uid, $data) {
        $this->evento->nombre = $data->nombre;
        $this->evento->fecha_inicio = $data->fecha_inicio;
        $this->evento->fecha_finalizacion = $data->fecha_finalizacion;
        $this->evento->descripcion = $data->descripcion;
        $this->evento->img = $data->img;
        if ($this->evento->update($uid)) {
            return json_encode(["message" => "Producto actualizado con éxito"]);
        }
        return json_encode(["message" => "Error al actualizar el producto"]);
    }

    // Eliminar un producto
    public function delete($uid) {
        if ($this->evento->delete($uid)) {
            return json_encode(["message" => "Evento eliminado con éxito"]);
        }
        return json_encode(["message" => "Error al eliminar el evento"]);
    }
}
?>