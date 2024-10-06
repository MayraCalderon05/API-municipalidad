<?php
include_once '../controllers/eventoController.php';
include_once '../controllers/usuarioController.php'
include_once '../views/View.php';

$controller = new EventoController();
$userController = new UsuarioController();
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
//switch de los usuarios
switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $result = $userController->getUserById($_GET['id']);
        } else {
            $result = $userController->getAllUsers();
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