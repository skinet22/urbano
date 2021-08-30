<?php
class Grupo extends EntidadBase{
    private $id;
    private $nombre;
    
    public function __construct($adapter) {
        $table="clientes_grupos";
        parent::__construct($table,$adapter);
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

	public function update($data,$id){
		$query = "UPDATE clientes_grupos SET ";
		foreach ($data as $clave => $valor):
			$query .= "$clave='$valor',";
		endforeach;
		$query = substr($query, 0, -1);
		$query .= " WHERE id = '$id';";
		$update=$this->db()->query($query);
		return $update;
	}
    public function save(){
        $query="INSERT INTO clientes_grupos (id,nombre)
                VALUES(NULL,
                       '".$this->nombre."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }

}
?>