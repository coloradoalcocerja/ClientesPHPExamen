<?php
require_once 'Cliente.entidad.php';
require_once 'Cliente.model.php';
// Logica
$cli = new Cliente();
$model = new ClienteModel();
?>

<html>
<head>
<style>
table {
	border:1px solid black;
}
</style>
</head>
<body>
<table>
<h1>Listado de Ventas</h1>
<tr>
    <th>Albaran</th>
    <th>Nombre</th>
    <th>factura</th>
    <th>Fecha</th>
    <th>DNI</th>
    <th>Total</th>


</tr>
<?php foreach($model->verClientes() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('albaran'); ?></td>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('factura'); ?></td>
                            <td><?php echo $r->__GET('fecha'); ?></td>
                            <td><?php echo $r->__GET('dni'); ?></td>
                            <td><?php echo $r->__GET('total'); ?></td>
                            
                            
                        </tr>
                    <?php endforeach; ?>
</table>
</body>

</html>