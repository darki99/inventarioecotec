<?php
require_once '../config/database.php';
require_once '../models/Producto.php';

class ProductoController {

    private $producto;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->producto = new Producto($db);
    }

    public function crear() {
        try {
            $this->producto->crear(
                $_POST['nombre'],
                $_POST['precio'],
                $_POST['stock']
            );
            echo "Producto creado correctamente";
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function listar() {
        return $this->producto->listar();
    }

    public function eliminar() {
        $this->producto->eliminar($_GET['id']);
        header("Location: productos.php");
    }
}