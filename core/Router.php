<?php
include_once '../controllers/EventoController.php';
include_once '../views/Vi.php';

$controller = new EventoController();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['uid'])) {
            $result = $controller->getById($_GET['uid']);
        } else {
            $result = $controller->getAll();
        }
        View::render($result);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $result = $controller->create($data);
        View::render($result);
        break;

    case 'PUT':
        if (isset($_GET['uid'])) {
            $data = json_decode(file_get_contents("php://input"));
            $result = $controller->update($_GET['uid'], $data);
            View::render($result);
        }
        break;

    case 'DELETE':
        if (isset($_GET['uid'])) {
            $result = $controller->delete($_GET['uid']);
            View::render($result);
        }
        break;

    default:
        View::render(json_encode(["message" => "Método no permitido"]));
        break;
}
?>