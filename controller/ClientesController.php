<?php
class ClientesController extends ControladorBase{

    public $conectar;
    public $adapter;
     
    public function __construct() {
        parent::__construct();
          
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
		
    }
    
    public function index(){
        
        //Cargamos Modelo Clientes y creamos objeto clientes
		$clientes=new ClientesModel($this->adapter);
		
		//Conseguimos todos los clientes
        $allclientes=$clientes->getClientes();
		
        //var_dump($allclientes);
   
       
        //Cargamos la vista index y le pasamos valores
        $this->view("index",array(
            "allclientes"=>$allclientes,
			"titulo" => "Clientes",
            "Hola"    =>"Carlos Villar"
        ));
    }
  
    public function listado(){
        
        //Cargamos Modelo Clientes y creamos objeto clientes
		$clientes=new ClientesModel($this->adapter);
		
		//Conseguimos todos los clientes
        $allclientes=$clientes->getClientes();
		
        //var_dump($allclientes);
   
		$grupos=new Grupo($this->adapter);
		$allgrupos=$grupos->getAll();
		
		foreach ($allclientes as $cliente) {
			// button
			$buttons = '';
			
						
			
				$buttons = '<button type="button" class="btn btn-success" onclick="EditarCliente('.$cliente->id.')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			

			
				$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeCli('.$cliente->id.')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			
				$select = '<select class="form-control" id="grupo_cliente_'.$cliente->id.'" name="grupo_cliente_'.$cliente->id.'" style="width:100%" onChange="CambiarGrupo(this.value,'.$cliente->id.');">';
                   
				foreach($allgrupos as $grupo):
					if($grupo->id==$cliente->id_grupo){
						$selected="selected";
					}else{
						$selected="";
					}
					$select .= '<option value="'.$grupo->id.'" '.$selected.'>'.$grupo->nombre.'</option>';
				endforeach;
				$select .= '</select>'; 
	

			//$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][] = array(
				$cliente->id,
				$cliente->nombre,
				$cliente->apellido,
				$cliente->email,
				$select,
				$buttons
			);
		} // /foreach		
		
		
		
		echo json_encode($result);
		
		
    }
	
    public function buscar(){
        
        //Cargamos Modelo Clientes y creamos objeto clientes
		$clientes=new ClientesModel($this->adapter);
		if(!$_GET['search'] && ($_GET['id_grupo_search']="Todos")){
			$allclientes=$clientes->getClientes();
		}else{
			$allclientes=$clientes->searchClientes($_GET['search'],$_GET['id_grupo_search']);
		}
		//var_dump($allclientes);
  
		$grupos=new Grupo($this->adapter);
		$allgrupos=$grupos->getAll();
		
		if(is_array($allclientes)){
			foreach ($allclientes as $cliente) {
				// button
				$buttons = '';
					$buttons = '<button type="button" class="btn btn-success" onclick="EditarCliente('.$cliente->id.')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';

					$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeCli('.$cliente->id.')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';

					$select = '<select class="form-control" id="grupo_cliente_'.$cliente->id.'" name="grupo_cliente_'.$cliente->id.'" style="width:100%" onChange="CambiarGrupo(this.value,'.$cliente->id.');">';

					foreach($allgrupos as $grupo):
						if($grupo->id==$cliente->id_grupo){
							$selected="selected";
						}else{
							$selected="";
						}
						$select .= '<option value="'.$grupo->id.'" '.$selected.'>'.$grupo->nombre.'</option>';
					endforeach;
					$select .= '</select>'; 


				//$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

				$result['data'][] = array(
					$cliente->id,
					$cliente->nombre,
					$cliente->apellido,
					$cliente->email,
					$select,
					$buttons
				);
			} // /foreach		
		}else{
			if(is_object($allclientes)){
				//var_dump($allclientes);
				// button
				$buttons = '';
					$buttons = '<button type="button" class="btn btn-success" onclick="EditarCliente('.$allclientes->id.')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';

					$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeCli('.$allclientes->id.')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';

					$select = '<select class="form-control" id="grupo_cliente_'.$allclientes->id.'" name="grupo_cliente_'.$allclientes->id.'" style="width:100%" onChange="CambiarGrupo(this.value,'.$allclientes->id.');">';

					foreach($allgrupos as $grupo):
						if($grupo->id==$allclientes->id_grupo){
							$selected="selected";
						}else{
							$selected="";
						}
						$select .= '<option value="'.$grupo->id.'" '.$selected.'>'.$grupo->nombre.'</option>';
					endforeach;
					$select .= '</select>'; 


				//$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

				$result['data'][] = array(
					$allclientes->id,
					$allclientes->nombre,
					$allclientes->apellido,
					$allclientes->email,
					$select,
					$buttons
				);
				
			}else{
				$result['data']='';
			}
		}
		
		
		
		echo json_encode($result);
		
		
    }
	
    public function getCliente(){
        
        //Cargamos Modelo Clientes y creamos objeto clientes
		$cliente=new Cliente($this->adapter);
		
		//Obtenemos Cliente por ID
		$cliente=$cliente->getById($_POST['id']);
		echo json_encode($cliente);
		
		
    }
	
	
	public function editarCliente(){
		
		  if(!$_POST['nombre'] || !$_POST['apellido'] || !$_POST['email'] || !$_POST['id_grupo'] || !$_POST['observaciones'] ) {
          	$Mensaje='Todos los campos son obligatorios, revise nuevamente el formulario.';
			echo json_encode(['success' => false, 'messages' => $Mensaje]);  
            exit();
        }
       
		if (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
			$Mensaje="Esta dirección de correo (".$_POST['email'].") no es válida.";
			echo json_encode(['success' => false, 'messages' => $Mensaje]);  
			exit();

		}

		if(isset($_POST["id"])){
            
            //Cargamos Modelo
            $cliente=new Cliente($this->adapter);
			$data = [
				'nombre' => $_POST["nombre"],
				'apellido' => $_POST["apellido"],
				'email' => $_POST["email"],
				'id_grupo' => $_POST["id_grupo"],
				'observaciones' => $_POST["observaciones"],
			];
            $update = $cliente->update($data,$_POST["id"]);
           
        }
		if($update){
				$log = new Logs($this->adapter);
				$log->setTarea('Editar Cliente');
				$log->setLog('Cliente ID: '.$_POST["id"].' Nombre: '.$_POST["nombre"].' Apellido: '.$_POST["apellido"].' email: '.$_POST["email"].' Grupo ID: '.$_POST["id_grupo"].' Observaciones: '.$_POST["observaciones"]);
				$log->save();
			
		$res=[
			'success' => true,
			'messages' => 'Cambios realizados con exito!'
		];
		}else{
		$res=[
			'success' => false,
			'messages' => 'Ocurrio un problema, intente nuevamente. Si el problema persiste contacte al administrador.'
		];
		}
		
		echo json_encode($res);
        //$this->redirect("Clientes", "index");
    }
		
	public function cambiarGrupo(){
        if(isset($_POST["id"])){
            
            //Cargamos Modelo
            $usuario=new Cliente($this->adapter);
			$data = [
				'id_grupo' => $_POST["id_grupo"]
			];
            $update = $usuario->update($data,$_POST["id"]);
           
        }
		if($update){
				$log = new Logs($this->adapter);
				$log->setTarea('Editar Cliente -> Cambio Grupo');
				$log->setLog('Cliente ID: '.$_POST["id"].' Grupo ID: '.$_POST["id_grupo"]);
				$log->save();
		$res=[
			'success' => true,
			'messages' => 'Cambios realizados con exito!'
		];
		}else{
		$res=[
			'success' => false,
			'messages' => 'Ocurrio un problema, intente nuevamente. Si el problema persiste contacte al administrador.'
		];
		}
		
		echo json_encode($res);
        //$this->redirect("Clientes", "index");
    }
	
    public function crear(){
		
		  if(!$_POST['nombre'] || !$_POST['apellido'] || !$_POST['email'] || !$_POST['id_grupo'] || !$_POST['observaciones'] ) {
          	$Mensaje='Todos los campos son obligatorios, revise nuevamente el formulario.';
			echo json_encode(['success' => false, 'messages' => $Mensaje]);  
            exit();
        }
       
		if (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
			$Mensaje="Esta dirección de correo (".$_POST['email'].") no es válida.";
			echo json_encode(['success' => false, 'messages' => $Mensaje]);  
			exit();

		}
		
        
            //Creamos un usuario
            $cliente=new Cliente($this->adapter);
            $cliente->setNombre($_POST["nombre"]);
            $cliente->setApellido($_POST["apellido"]);
            $cliente->setEmail($_POST["email"]);
            $cliente->setGrupo($_POST["id_grupo"]);
            $cliente->setObservaciones($_POST["observaciones"]);
            $save=$cliente->save();
       
		if($save){
			
				$log = new Logs($this->adapter);
				$log->setTarea('Crear Cliente');
				$log->setLog('Cliente ID: '.$_POST["id"].' Nombre: '.$_POST["nombre"].' Apellido: '.$_POST["apellido"].' email: '.$_POST["email"].' Grupo ID: '.$_POST["id_grupo"].' Observaciones: '.$_POST["observaciones"]);
				$log->save();
			
		$res=[
			'success' => true,
			'messages' => 'Registro Agregado con Exito!'
		];
		}else{
		$res=[
			'success' => false,
			'messages' => 'Ocurrio un problema, intente nuevamente. Si el problema persiste contacte al administrador.'
		];
		}
		
		echo json_encode($res);
    }
    
    public function borrar(){
        if(isset($_GET["id"])){ 
            $id=(int)$_GET["id"];
            
            $cliente=new Cliente($this->adapter);
            $delete = $cliente->deleteById($id);
			if($delete){
				$log = new Logs($this->adapter);
				$log->setTarea('Borrar Cliente');
				$log->setLog('Cliente ID: '.$_GET["id"]);
				$log->save();

				$res=[
					'success' => true,
					'messages' => 'Registro Eliminado con Exito!'
				];
			}else{
				$res=[
					'success' => false,
					'messages' => 'Ocurrio un problema, intente nuevamente. Si el problema persiste contacte al administrador.'
				];
			}

			echo json_encode($res);
			
        }
    }
    
    
    public function hola(){
        $clientes=new ClientesModel($this->adapter);
        $cli=$clientes->getUnCliente();
        var_dump($cli);
    }

}
?>
