<?php
class Cliente extends EntidadBase{
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $id_grupo;
    private $observaciones;
    

    public function __construct($adapter) {
        $table="clientes";
        parent::__construct($table, $adapter);
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

    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }
    
	public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    public function getGrupo() {
        return $this->id_grupo;
    }

    public function setGrupo($id_grupo) {
        $this->id_grupo = $id_grupo;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }

    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }
	public function update($data,$id){
		$query = "UPDATE clientes SET ";
		foreach ($data as $clave => $valor):
			$query .= "$clave='$valor',";
		endforeach;
		$query = substr($query, 0, -1);
		$query .= " WHERE id = '$id';";
		$update=$this->db()->query($query);
		return $update;
	}

    public function save(){
        $query="INSERT INTO clientes (id,nombre,apellido,email,id_grupo,observaciones)
                VALUES(NULL,
                       '".$this->nombre."',
                       '".$this->apellido."',
                       '".$this->email."',
                       '".$this->id_grupo."',
                       '".$this->observaciones."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }

}
?>