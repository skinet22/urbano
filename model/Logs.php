<?php
class Logs extends EntidadBase{
    private $id;
    private $tarea;
    private $log;
    private $fecha;
	
    public function __construct($adapter) {
        $table="logs";
        parent::__construct($table,$adapter);
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getTarea() {
        return $this->tarea;
    }

    public function setTarea($tarea) {
        $this->tarea = $tarea;
    }

    public function getLog() {
        return $this->log;
    }

    public function setLog($log) {
        $this->log = $log;
    }

    public function getFecha() {
        return $this->fecha;
    }


	public function update($data,$id){
		$query = "UPDATE logs SET ";
		foreach ($data as $clave => $valor):
			$query .= "$clave='$valor',";
		endforeach;
		$query = substr($query, 0, -1);
		$query .= " WHERE id = '$id';";
		$update=$this->db()->query($query);
		return $update;
	}
    public function save(){
        $query="INSERT INTO logs (id,tarea,log,fecha)
                VALUES(NULL,
                       '".$this->tarea."','".$this->log."','".date('Y-m-d h:i:s')."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }

}
?>