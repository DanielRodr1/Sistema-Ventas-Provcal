<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");
$nombreProducto = (isset($_POST['nombreProducto'])) ? $_POST['nombreProducto'] : null;

$productos = obtenerProductos($nombreProducto);

$cartas = [
    ["titulo" => "No. Productos", "icono" => "fa fa-box", "total" => count($productos), "color" => "#3578FE"],
    ["titulo" => "Total productos", "icono" => "fa fa-shopping-cart", "total" => obtenerNumeroProductos(), "color" => "#4F7DAF"],
    ["titulo" => "Total inventario", "icono" => "fa fa-money-bill", "total" => "S/.". obtenerTotalInventario(), "color" => "#1FB824"],
    //["titulo" => "Ganancia", "icono" => "fa fa-wallet", "total" => "S/.". calcularGananciaProductos(), "color" => "#D55929"],
];
?>
<div class="container mt-3">
    <br>
    <h1>
        <a class="btn btn-success btn-lg" href="agregar_producto.php">
            <i class="fa" style="color:#fff; background:#466320;"></i>
            Agregar
        </a>
        Productos
    </h1><br>
    <?php include_once "cartas_totales.php"; ?>

    <form action="" method="post" class="input-group mb-3 mt-3">
        <input autofocus name="nombreProducto" type="text" class="form-control" placeholder="Escribe el nombre o código del producto que deseas buscar" aria-label="Nombre producto" aria-describedby="button-addon2" maxlength="12">
        <button type="submit" name="buscarProducto" class="btn btn-primary" id="button-addon2">
            <i class="fa fa-search"></i>
            Buscar
        </button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Precio compra</th>
                <th>Precio venta</th>
                <th>Ganancia</th>
                <th>Existencia</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($productos as $producto){
            ?>
                <tr>
                    <td><?= $producto->codigo; ?></td>
                    <td><?= $producto->nombre; ?></td>
                    <td><?= 'S/.'.$producto->compra; ?></td>
                    <td><?= 'S/.'.$producto->venta; ?></td>
                    <td><?= 'S/.'. floatval($producto->venta - $producto->compra); ?></td>
                    <td>
                    <?php 
                        if($producto->existencia == 0){
                            ?><div>
                                <a class="btn btn-danger">
                                Sin Stock
                                </a>
                            </div><?php
                        } else {
                            echo $producto->existencia;
                        }
                    ?>
                    </td>
                    <td>
                        <a class="btn" style="color:#fff; background:#466320;" href="editar_producto.php?id=<?= $producto->id; ?>">
                            <i class="fa fa-edit"></i>
                            Editar
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="eliminar_producto.php?id=<?= $producto->id; ?>" onclick="return confirmarEliminacion();" >
                            <i class="fa fa-trash"></i>
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
function confirmarEliminacion() {
    return confirm('¿Estás seguro de que deseas eliminar este producto?');
}
</script>
