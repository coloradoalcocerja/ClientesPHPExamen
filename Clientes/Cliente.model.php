<?php
class ClienteModel
{
	private $cn;

	public function __CONSTRUCT()
	{
		try
		{
			$this->cn = new PDO('mysql:host=localhost;dbname=clientes', 'root', 'root');
			$this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->cn->prepare("SELECT * FROM clientes");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$cli = new Cliente();

				$cli->__SET('dni', $r->dni);
				$cli->__SET('nombre', $r->nombre);
				$cli->__SET('direccion', $r->direccion);
				$cli->__SET('telefono', $r->telefono);
		    

				$result[] = $cli;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($dni)
	{
		try 
		{
			$stm = $this->cn->prepare("SELECT * FROM clientes WHERE dni = ?");
			          

			$stm->execute(array($dni));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$cli = new Cliente();

				$cli->__SET('dni', $r->dni);
				$cli->__SET('nombre', $r->nombre);
				$cli->__SET('direccion', $r->direccion);
				$cli->__SET('telefono', $r->telefono);


			return $cli;
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($dni)
	{
		try 
		{
			$stm = $this->cn->prepare("DELETE FROM clientes WHERE dni = ?");			          

			$stm->execute(array($dni));
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Cliente $data)
	{
		try 
		{
			$sql = "UPDATE clientes SET 
						dni          = ?, 
						nombre        = ?,
						direccion            = ?, 
						telefono = ?
						
				    WHERE dni = ?";

			$this->cn->prepare($sql)->execute(
				array(
					$data->__GET('dni'), 
					$data->__GET('nombre'), 
					$data->__GET('direccion'),
					$data->__GET('telefono')
					
					)
				);
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Cliente $data)
	{
		try 
		{
			$sql = "INSERT INTO clientes (dni,nombre,direccion,telefono) VALUES (?, ?, ?, ?)";

			$this->cn->prepare($sql)->execute(
				array(
					$data->__GET('dni'), 
					$data->__GET('nombre'), 
					$data->__GET('direccion'),
					$data->__GET('telefono')
					
				)
			);
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
	public function verClientes()
	{
		try
		{
			$result = array();

			$stm = $this->cn->prepare("SELECT * FROM ventas INNER JOIN clientes ON ventas.dni=clientes.dni");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$cli = new Cliente();

				$cli->__SET('albaran', $r->albaran);
				$cli->__SET('nombre', $r->nombre);
				$cli->__SET('factura', $r->factura);
				$cli->__SET('fecha', $r->fecha);
				$cli->__SET('dni', $r->dni);
				$cli->__SET('total', $r->total);
		    

				$result[] = $cli;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}