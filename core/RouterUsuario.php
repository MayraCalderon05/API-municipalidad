<?php
include_once '../controllers/usuarioController.php'
include_once '../views/View.php';

$userController = new UsuarioController();
$method = $_SERVER['REQUEST_METHOD'];

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
        $result = $userController->registrarUser($data);
        View::render($result);
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $data = json_decode(file_get_contents("php://input"));
            $result = $userController->update($_GET['id'], $data);
            View::render($result);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $result = $userController->delete($_GET['id']);
            View::render($result);
        }
        break;

    default:
        View::render(json_encode(["message" => "Método no permitido"]));
        break;
}
?>