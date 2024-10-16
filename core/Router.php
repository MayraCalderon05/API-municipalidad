<?php
include_once '../controllers/eventoController.php';
include_once '../controllers/usuarioController.php';
include_once '../views/View.php';

#$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
#$segments = explode('/', trim($route, '/'));

$method = $_SERVER['REQUEST_METHOD'];
#$entity = isset($segments[3]) ? $segments[3] : '';  // Extrae la entidad de la ruta

if (strpos($_SERVER['REQUEST_URI'],'/eventos') !== false) {
    $controller = new EventoController();
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
} elseif (strpos($_SERVER['REQUEST_URI'],'/registro') !== false) {
    $controller = new UsuarioController();
    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                $result = $controller->getUserById($_GET['id']);
            } else {
                $result = $controller->getAllUsers();
            }
            View::render($result);
            break;
    
        case 'POST':
            $data = json_decode(file_get_contents("php://input"));
            $result = $controller->registrarUser($data);
            View::render($result);
            break;
    
        case 'PUT':
            if (isset($_GET['id'])) {
                $data = json_decode(file_get_contents("php://input"));
                $result = $controller->updateUser($_GET['id'], $data);
                View::render($result);
            }
            break;
    
        case 'DELETE':
            if (isset($_GET['id'])) {
                $result = $controller->deleteUsuario($_GET['id']);
                View::render($result);
            }
            break;
    
        default:
            View::render(json_encode(["message" => "Método no permitido"]));
            break;
    }
} elseif (strpos($_SERVER['REQUEST_URI'], '/login') !== false) {
    $controller = new UsuarioController();
    switch ($method) {
        case 'POST':
            $data = json_decode(file_get_contents("php://input"));
            $result = $controller->login($data);
            View::render($result);
            break;
        default:
            View::render(json_encode(["message" => "Método no permitido"]));
            break;
    } 

} else {
    //ruta no encontrada
    View::render(json_encode(["message" => "Ruta no encontrada"]));
}

?>