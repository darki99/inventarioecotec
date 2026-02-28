<?php
class Producto {
    private $conn;
    private $table = "productos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear($nombre, $precio, $stock) {

        if(empty($nombre)) {
            throw new Exception("El nombre no puede estar vacío");
        }

        if($precio <= 0) {
            throw new Exception("El precio debe ser mayor a 0");
        }

        if($stock < 0) {
            throw new Exception("El stock no puede ser negativo");
        }

        $query = "INSERT INTO " . $this->table . " 
                  (nombre, precio, stock) 
                  VALUES (:nombre, :precio, :stock)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":stock", $stock);

        return $stmt->execute();
    }

    public function listar() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function actualizar($id, $nombre, $precio, $stock) {

        if(empty($nombre)) {
            throw new Exception("El nombre no puede estar vacío");
        }

        if($precio <= 0) {
            throw new Exception("El precio debe ser mayor a 0");
        }

        if($stock < 0) {
            throw new Exception("El stock no puede ser negativo");
        }

        $query = "UPDATE " . $this->table . " 
                  SET nombre = :nombre, 
                      precio = :precio, 
                      stock = :stock
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":stock", $stock);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}