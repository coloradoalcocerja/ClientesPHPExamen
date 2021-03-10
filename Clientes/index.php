<?php
require_once 'Cliente.entidad.php';
require_once 'Cliente.model.php';

// Logica
$cli = new Cliente();
$model = new ClienteModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$cli->__SET('dni',              $_REQUEST['dni']);
			$cli->__SET('nombre',          $_REQUEST['nombre']);
			$cli->__SET('direccion',        $_REQUEST['direccion']);
			$cli->__SET('telefono',            $_REQUEST['telefono']);
		

			$model->Actualizar($cli);
			header('Location: index.php');
			break;

		case 'registrar':
			$cli->__SET('dni',          $_REQUEST['dni']);
			$cli->__SET('nombre',        $_REQUEST['nombre']);
			$cli->__SET('direccion',            $_REQUEST['direccion']);
			$cli->__SET('telefono', $_REQUEST['telefono']);
			

			$model->Registrar($cli);
			header('Location: index.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['dni']);
			header('Location: index.php');
			break;

		case 'editar':
			$cli = $model->Obtener($_REQUEST['dni']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>PRACTICA CRUD 2DAW</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $cli->dni > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="id" value="<?php echo $cli->__GET('dni'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">DNI</th>
                            <td><input type="text" name="dni" value="<?php echo $cli->__GET('dni'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $cli->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Dirección</th>
                            <td><input type="text" name="direccion" value="<?php echo $cli->__GET('direccion'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Telefono</th>
                            <td><input type="text" name="telefono" value="<?php echo $cli->__GET('telefono'); ?>" style="width:100%;" /></td>
                        </tr>
                 
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">DNI</th>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Direccion</th>
                            <th style="text-align:left;">Telefono</th>
                         
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('dni'); ?></td>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('direccion'); ?></td>
                            <td><?php echo $r->__GET('telefono'); ?></td>
                            
                            <td>
                                <a href="?action=editar&dni=<?php echo $r->dni; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&dni=<?php echo $r->dni; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>                   
            </div>
        </div>
		 <a href="listado.php">Ver Listado de ventas</a> 
    </body>
</html>