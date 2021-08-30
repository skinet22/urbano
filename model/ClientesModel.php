<?php
class ClientesModel extends ModeloBase{
    private $table;
    
    public function __construct($adapter){
        $this->table="clientes";
        parent::__construct($this->table, $adapter);
    }

    
    //Metodos de consulta
    public function getUnCliente($id=null){
		if($id){
			$query="SELECT * FROM clientes WHERE id='$id'";
			$cliente=$this->ejecutarSql($query);
		}else{
			$query="SELECT * FROM clientes WHERE id='1'";
			$cliente=$this->ejecutarSql($query);
		}
        return $cliente;
    }
	
    public function getClientes($id=null){
		if($id){
			$query="SELECT clientes.*,clientes_grupos.nombre Grupo FROM clientes LEFT JOIN clientes_grupos ON clientes_grupos.ID = clientes.id_grupo WHERE clientes.id='$id'";
			$cliente=$this->ejecutarSql($query);
		}else{
			$query="SELECT clientes.*,clientes_grupos.nombre Grupo  FROM clientes LEFT JOIN clientes_grupos ON clientes_grupos.ID = clientes.id_grupo";
			$cliente=$this->ejecutarSql($query);
		}
        return $cliente;
    }

    public function searchClientes($search,$id_grupo){
		if($id_grupo!="Todos"){
			$query="SELECT clientes.*,clientes_grupos.nombre Grupo FROM clientes LEFT JOIN clientes_grupos ON clientes_grupos.ID = clientes.id_grupo WHERE (clientes.nombre LIKE '%$search%' OR clientes.apellido LIKE '%$search%' OR clientes.email LIKE '%$search%') AND clientes.id_grupo = '$id_grupo'";
			$cliente=$this->ejecutarSql($query);
		}else{
			$query="SELECT clientes.*,clientes_grupos.nombre Grupo FROM clientes LEFT JOIN clientes_grupos ON clientes_grupos.ID = clientes.id_grupo WHERE clientes.nombre LIKE '%$search%' OR clientes.apellido LIKE '%$search%' OR clientes.email LIKE '%$search%'";
			$cliente=$this->ejecutarSql($query);
		}
        return $cliente;
    }
	
}
?>
