<?php
class GruposController extends ControladorBase{

    public $conectar;
    public $adapter;
     
    public function __construct() {
        parent::__construct();
          
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
		
    }
    
    public function index(){
        
        //Cargamos Modelo Clientes y creamos objeto clientes
		$grupos=new Grupo($this->adapter);
		$allgrupos=$grupos->getAll();
        //Cargamos la vista index y le pasamos valores
        $this->view("grupos",array(
            "allgrupos"=>$allgrupos,
			"titulo"=>"Grupos",
            "Hola"    =>"Carlos Villar"
        ));
    }
  
    public function listado(){
        
        //Cargamos Modelo Clientes y creamos objeto clientes
		$grupos=new Grupo($this->adapter);
		$allgrupos=$grupos->getAll();
		foreach ($allgrupos as $grupo) {
			// button
			$buttons = '';
			
						
			
				$buttons = '<button type="button" class="btn btn-success" onclick="EditarGrupo('.$grupo->id.')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			

			
				$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeGrupo('.$grupo->id.')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			
				
			
		
			

			//$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][] = array(
				$grupo->id,
				$grupo->nombre,
				$buttons
			);
		} // /foreach		
		
		
		
		echo json_encode($result);
		
		
    }
    public function getGrupo(){
        
        //Cargamos Modelo grupo y creamos objeto clientes
		$grupo=new Grupo($this->adapter);
		
		//Obtenemos grupo por ID
		$grupo=$grupo->getById($_POST['id']);
		echo json_encode($grupo);
		
		
    }
	public function editarGrupo(){
		
		  if(!$_POST['nombre']) {
          	$Mensaje='Todos los campos son obligatorios, revise nuevamente el formulario.';
			echo json_encode(['success' => false, 'messages' => $Mensaje]);  
            exit();
        }
       
		if(isset($_POST["id"])){
            
            //Cargamos Modelo
            $grupo=new Grupo($this->adapter);
			$data = [
				'nombre' => $_POST["nombre"]
			];
            $update = $grupo->update($data,$_POST["id"]);
           
        }
		if($update){
			
				$log = new Logs($this->adapter);
				$log->setTarea('Editar Grupo');
				$log->setLog('Grupo ID: '.$_POST["id"].' Nombre: '.$_POST["nombre"]);
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
		
		  if(!$_POST['nombre']) {
          	$Mensaje='Todos los campos son obligatorios, revise nuevamente el formulario.';
			echo json_encode(['success' => false, 'messages' => $Mensaje]);  
            exit();
        }
       
		
		
        
            //Creamos un Grupo
            $grupo=new Grupo($this->adapter);
            $grupo->setNombre($_POST["nombre"]);
            $save=$grupo->save();
       
		if($save){
				$log = new Logs($this->adapter);
				$log->setTarea('Crear Grupo');
				$log->setLog('Grupo ID: '.$id.' Nombre: '.$_POST["nombre"]);
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
            
            $grupo=new Grupo($this->adapter);
            $delete = $grupo->deleteById($id);
			if($delete){
				$log = new Logs($this->adapter);
				$log->setTarea('Borrar Grupo');
				$log->setLog('Grupo ID: '.$id);
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
