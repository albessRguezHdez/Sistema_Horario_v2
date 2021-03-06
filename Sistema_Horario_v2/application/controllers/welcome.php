<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * welcome: Control principal del sistema horarios v2
 * @Sirio
 * @Jesús
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Welcome extends CI_Controller {

	function __construct()
 	{
   	parent::__construct();
   		$this->load->model('modelo_Horarios');		
 	}
        
        //Cambiar la página de inicio: Login------------------------------------
        public function index()
	{
            //$this->load->view('prueba_sirio');
            //$this->load->view('view_Principal');
		$this->db->where('Logeado','1');
 		$prueba= $this->db->get('usuarios');
 		if($prueba->num_rows() == 1){
 			//redirect('welcome/home');
 			//$this->load->view('header/header_vista');
			$this->load->view('autenticar');
			echo "Entro al if";
			//$this->load->view('footer/vista');
 		}else{
	   		//$this->load->view('header/header_vista');
			$this->load->view('autenticar');
			echo "Entro al else";
			//$this->load->view('footer/vista');
	    }
	}
        
        public function prueba_sirio()
	{
            $this->load->view('prueba_sirio');
            //$this->load->view('view_Principal');
	}
        //Página principal------------------------------------------------------
        public function home(){
 		//$this->load->view('head/head_vista');
        //$this->load->view('header/header_vista');
		$this->load->view('view_Principal');
		//$this->load->view('footer/footer_vista');
 	}
        
        //Información del sistema-----------------------------------------------
        public function acerca_de(){
		$this->load->view('acerca_de');
 	}

        //Horario:--------------------------------------------------------------
	public function vista_horario(){	
		//$this->load->view('view_Horario');
		$this->load->view('prueba_sirio');
	}
//las funciones get_info_horario() y web_service() quedan simplificadas en:
//vista_horario() pero aún se esta tratando de modificar 
//@Sirio
//@Jesús
 	public function get_info_horario(){
 		$salon = $_POST['salon'];
 		$this->db->select('Dia,Hora,NCR');
 		$this->db->from('horario');
 		$this->db->where('IDS', $salon);

 		$this->db->order_by("IDHor", "desc"); 
 		$query = $this->db->get();
 		echo json_encode($query->result());
 	}

 	public function web_service(){
		$salon = $_POST['salon'];
		$dia   = $_POST['dia'];
		$hora  = $_POST['hora'];
		$nrc  = $_POST['nrc'];

		switch ($dia) {
			case 1:
				$dia = 'Lunes';
				break;
			case 2:
				$dia = 'Martes';
				break;
			case 3:
				$dia = 'Miercoles';
				break;
			case 4:
				$dia = 'Jueves';
				break;
			case 5:
				$dia = 'Viernes';
				break;
			default:
				$dia = 'Sabado';
				break;
		}

		switch ($hora) {
			case 1:
				$hora = 7;
				break;
			case 2:
				$hora = 9;
				break;
			case 3:
				$hora = 11;
				break;
			case 4:
				$hora = 13;
				break;
			case 5:
				$hora = 15;
				break;
			case 6:
				$hora = 17;
				break;
			default:
				$hora = 19;
				break;
		}

 		$data = array(
 			'IDS' => $salon,
 			'Dia' => $dia,
 			'Hora' => $hora,
 			'NCR' => $nrc
 		);

 		$this->db->insert('horario', $data); 
 		echo 'EXITO!';
 	}

 	public function BHorario(){
		$salon = $_POST['salon'];
		$nrc  = $_POST['nrc'];

		
 		$data = array(
 			'IDS' => $salon,
 			'NCR' => $nrc
 		);
 		$this->db->where($data);
 		$this->db->delete('horario'); 
 		echo 'EXITO!';
 	}
//Función salir aún sin probar
	public function salir(){
 		$this->db->where('Logeado','1');
 		$prueba= $this->db->get('usuarios');
 		if($prueba->num_rows() == 1){
 			foreach ($prueba ->result() as $row){
 				$data=array(
              'Logeado'=>'0',
            );
            $this->db->where('Usuario',$row->Usuario);
            $this->db->update('usuarios',$data);
            redirect(base_url());
 			}
 		}
 	}
        
//En caso de tratar de acceder a un recurso no disponible
//Aún no quedá finalizada la función
 	public function error_001(){
		$this->load->view('error_001');
 	}      
        
//Funciones de Agregar, Editar, Eliminar y Vistas:
        
        //Cursos:--------------------------------------------------------------
        public function agregar_curso(){
		$this->load->view('add_Curso');
	}

        	public function editar_curso(){
		/*$NRC= $this->uri->segment(3);
		$obtenerDatos= $this->modelo_Horarios->consulta_Curso($NRC);
		if($obtenerDatos != False){
			foreach ($obtenerDatos->result() as $key) {
					$IDA= $key->IDA;
					$IDM= $key->IDM;
			}
			$data = array(
				'NRC'=>$NRC,
				'IDA'=>$IDA,
				'IDM'=>$IDM
				);
		}else{
			return FALSE;
		}*/
		//$this->load->view('edit_Curso',$data);
		$this->load->view('edit_Curso');
	}
        
        public function eliminar_curso(){
			//$NRC = $this->uri-> segment(3);
			//$this->modelo_Horarios->eliminar_Curso($NRC);
			$this->load->view('delete_Curso');
	}
        
	public function vista_curso(){
		$this->load->view('home_Curso');
	}

        //Materias:-------------------------------------------------------------
	public function agregar_materias(){
		$this->load->view('add_Materias');
	}
        
	public function editar_Materias(){
		$IDA = $this->uri->segment(3);
		$obtenerDatos= $this->modelo_Horarios->consulta_Asignatura($IDA);
		if($obtenerDatos != FALSE){
			foreach ($obtenerDatos->result() as $row){
				
				$Asignatura= $row->Asignatura;
				$Carrera=$row->Carrera;
				$Horas=$row->Horas;
				$Requerimiento=$row->Requerimiento;
				$Creditos=$row->Creditos;
			}
			$data = array(
					'IDA'=>$IDA,
					'Asignatura'=>$Asignatura,
					'Carrera'=>$Carrera,
					'Horas'=>$Horas,
					'Requerimiento'=>$Requerimiento,
					'Creditos'=>$Creditos,
				);
		}else{
			return FALSE;
		}
		//$this->load->view('edit_Materias',$data);
		$this->load->view('edit_Materias');
	}
        
        public function eliminar_Materias(){
			$IDA = $this->uri-> segment(3);
			$this->modelo_Horarios->eliminar_Asignatura($IDA);
			$this->load->view('delete_Materias');
	}
        
        public function vista_materias(){
		$this->load->view('home_Materias');
	}

        //Maestro:--------------------------------------------------------------
	public function agregar_maestro(){
		$this->load->view('add_Maestro');
	}

        public function editar_Maestro(){
		$IDM = $this->uri->segment(3);
		$obtenerDatos= $this->modelo_Horarios->consulta_Maestros($IDM);
		if($obtenerDatos != FALSE){
			foreach ($obtenerDatos->result() as $row){
				
				$Nombre= $row->Nombre;
				$ApellidoP=$row->ApellidoP;
				$ApellidoM=$row->ApellidoM;
			}
			$data = array(
					'IDM'=>$IDM,
					'Nombre'=>$Nombre,
					'ApellidoP'=>$ApellidoP,
					'ApellidoM'=>$ApellidoM,
				);
		}else{
			return FALSE;
		}
		//$this->load->view('edit_Maestro',$data);
		$this->load->view('edit_Maestro');
	}
        
        public function eliminar_Maestro(){
		$IDM = $this->uri-> segment(3);
		$this->modelo_Horarios->eliminar_Maestros($IDM);
		$this->load->view('delete_Maestro');
	}
        
        public function vista_maestro(){
		$this->load->view('home_Maestro');
	}
        
        //Salón:----------------------------------------------------------------
        public function agregar_Salon(){
		$this->load->view('add_Salon');
	}
        
        public function editar_Salon(){
                $this->load->view('edit_Salon');
        }
        
        public function eliminar_Salon(){
			$NRC = $this->uri-> segment(3);
			$this->modelo_Horarios->eliminar_Salon($NRC);
			$this->load->view('home_Salon');
	}
        
        public function vista_Salon(){
		$this->load->view('home_Salon');
	}
        
        //Carrera:----------------------------------------------------------------
        public function agregar_Carrera(){
		$this->load->view('add_Carrera');
	}
        
        public function editar_Carrera(){
                $this->load->view('edit_Carrera');
        }
        
        public function eliminar_Carrera(){
			$NRC = $this->uri-> segment(3);
			$this->modelo_Horarios->eliminar_Carrera($NRC);
			$this->load->view('delete_Carrera');
	}
        
        public function vista_Carrera(){
		$this->load->view('home_Carrera');
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
