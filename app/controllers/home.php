<?php

$dirWithoutController = str_replace('controllers', '', __DIR__); 
$newPath = $dirWithoutController . 'models' . DIRECTORY_SEPARATOR . 'HomeModel.php';
require_once $newPath;

class home {
    private $HomeModel;

    public function __construct($connection) {
        $this->HomeModel = new HomeModel($connection);
    }

    public function index() {
        $this->view('shared/header');
        $this->view(view: 'home');
        $this->view('shared/footer');
    }

    public function getAreas() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        header('Content-Type: application/json');
        $areas = $this->HomeModel->getAreas(); 
        echo json_encode([
            'success' => true,
            'data' => $areas
        ]);
    }

    public function getRoles() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        header('Content-Type: application/json');
        $roles = $this->HomeModel->getRoles(); 
        echo json_encode([
            'success' => true,
            'data' => $roles
        ]);
    }
    
    public function createEmpleado() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['nombre']) || !isset($data['email']) || !isset($data['sexo']) || !isset($data['area']) ||
           !isset($data['boletin']) || !isset($data['descripcion']) || !isset($data['rol'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Faltan parámetros.'
            ]);
            return;
        }

        $nombre = utf8_decode($data['nombre']);
        $email = $data['email'];
        $sexo = $data['sexo'];
        $area = $data['area'];
        $boletin = $data['boletin'];
        $descripcion =  utf8_decode($data['descripcion']);
        $rol = $data['rol'];

        $success = $this->HomeModel->createEmpleado($nombre, $email, $sexo, $area, $boletin, $descripcion, $rol); 

        if ($success) {
            echo json_encode([
                'success' => $success,
                'message' => "Empleado creado correctamente"
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Error al crear el empleado"
            ]);
        }
    }

    public function getEmpleados() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        header('Content-Type: application/json');
        $empleados = $this->HomeModel->getEmpleados(); 
        echo json_encode([
            'success' => true,
            'data' => $empleados
        ]);
    }

    public function getEmpleado() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        $empleado = $this->HomeModel->getEmpleado($data["id"]); 
        echo json_encode([
            'success' => true,
            'data' => $empleado
        ]);
    }

    private function view($view, $data = []) {
        extract($data);
        $dirWithoutController = str_replace('controllers', '', __DIR__); 
        $viewPath = $dirWithoutController."views/" . $view . ".php";
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            die("Vista no encontrada: " . $viewPath);
        }
    }

    public function updateEmpleado() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['nombre']) || !isset($data['email']) || !isset($data['sexo']) || !isset($data['area']) ||
           !isset($data['boletin']) || !isset($data['descripcion']) || !isset($data['rol'])|| !isset($data['id'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Faltan parámetros.'
            ]);
            return;
        }

        $nombre = utf8_decode($data['nombre']);
        $email = $data['email'];
        $sexo = $data['sexo'];
        $area = $data['area'];
        $boletin = $data['boletin'];
        $descripcion =  utf8_decode($data['descripcion']);
        $rol = $data['rol'];
        $id = $data['id'];


        $success = $this->HomeModel->updateEmpleado($nombre, $email, $sexo, $area, $boletin, $descripcion, $rol,$id); 

        if ($success) {
            echo json_encode([
                'success' => $success,
                'message' => "Empleado editado correctamente"
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Error al crear el empleado"
            ]);
        }
    }

    public function eliminarEmpleado() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['id'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Faltan parámetros.'
            ]);
            return;
        }

        $id = $data['id'];

        $success = $this->HomeModel->eliminarEmpleado($id); 

        if ($success) {
            echo json_encode([
                'success' => $success,
                'message' => "Empleado editado correctamente"
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Error al crear el empleado"
            ]);
        }
    }
}
