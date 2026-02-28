<?php
require_once '../controllers/ProductoController.php';
$controller = new ProductoController();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->crear();
}

if(isset($_GET['eliminar'])) {
    $controller->eliminar();
}

$productos = $controller->listar();
?>

<h2>Crear Producto</h2>

<form method="POST">
    Nombre: <input type="text" name="nombre" required><br>
    Precio: <input type="number" step="0.01" name="precio" required><br>
    Stock: <input type="number" name="stock" required><br>
    <button type="submit">Guardar</button>
</form>

<h2>Lista de Productos</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acción</th>
    </tr>

    <?php foreach($productos as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nombre'] ?></td>
        <td><?= $p['precio'] ?></td>
        <td><?= $p['stock'] ?></td>
        <td>
            <a href="?eliminar=true&id=<?= $p['id'] ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>