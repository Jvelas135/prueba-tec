<?php

$dirWithoutController = str_replace('controllers', '', __DIR__); 
$newPath = $dirWithoutController  . 'models' . DIRECTORY_SEPARATOR . 'LoginModel.php';
require_once $newPath;
class Login {
    
    private $LoginModel;

    public function __construct($connection) {
        $this->LoginModel = new LoginModel($connection);
    }

    public function index() {

        $data = [
            'title' => 'Iniciar Sesión'
        ];
        $this->view('login', $data);
    }

    public function getUsers() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        header('Content-Type: application/json');
        $user = $this->LoginModel->getUsers(); 
        echo json_encode([
            'success' => true,
            'message' => $user
        ]);
      
    }

    public function login() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
    
        if (!isset($data['username']) || !isset($data['password'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Faltan parámetros.'
            ]);
            return;
        }
    
        $username = $data['username'];
        $password = $data['password'];
    
        $user = $this->LoginModel->login($username,$password); 

        if ($user && $user['user'] === $username) {
            session_start();
            $_SESSION['username'] = $user['user'];
    
            echo json_encode([
                'success' => true,
                'message' => "Bienvenido, " . $user['user']
            ]);

        } else {
            echo json_encode([
                'success' => true,
                'message' => 'Credenciales incorrectas.'
            ]);
        }
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
}

