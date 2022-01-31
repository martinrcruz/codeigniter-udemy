<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboardController extends CI_Controller
{

	public function index()
	{
		//importamos la estructura de la pagina por sector
		$this->loadViews('home');
	}

	//example
	public function login()
	{

		if ($_POST['form-username'] && $_POST['form-password']) {
			$login = $this->Site_model->loginUser($_POST);
			if ($login) {
				$array = array(
					"id" => $login[0]->id,
					"nombre" => $login[0]->nombre,
					"apellidos" => $login[0]->apellidos,
					"username" => $login[0]->username,
					"curso" => $login[0]->curso,
				);

				//Aqui guardamos el tipo de usuario
				if (isset($login[0]->is_profesor)) {
					$array['tipo'] = "profesor";
				} else if (isset($login[0]->is_alumno)) {
					$array['tipo'] = "alumno";
				}

				//creamos una session
				$this->session->set_userdata($array);
				//la podemos ver con print_r
				print_r($_SESSION);
			}
		}

		$this->loadViews('login');
		//$this->load->view('login');

	}



	function gestionAlumnos()
	{
		if ($_SESSION['tipo'] == "profesor") {
			$data['alumno'] = $this->Site_model->getAlumnos($_SESSION['curso']);

			$this->loadViews('gestionAlumnos', $data);
		} else {
			redirect(base_url() . "dashboardController", "location");
		}
	}

	function eliminarAlumno()
	{
		if ($_POST['idalumno']) {
			$this->Site_model->deleteAlumno($_POST['idalumno']);
		}
	}

	function crearTareas()
	{
		if ($_POST) {
			if ($_FILES['archivo']) {
				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'gif|jpg|png';
				//$config['max_size']             = 100;
				//$config['max_width']            = 1024;
				//$config['max_height']           = 768;

				$config['file_name'] = uniqid() . $_FILES['archivo']['name'];
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('archivo')) {
					echo "error";
				} else {
					$this->Site_model->uploadTarea($_POST, $config['file_name']);
				}
			} else {
				$this->Site_model->uploadTarea($_POST);
			}
		}
		$this->loadViews("crearTareas");
	}

	function misTareas()
	{

		if (isset($_SESSION['id'])) {

			$data['tarea'] = $this->Site_model->getTareas($_SESSION['curso']);



			$this->loadViews('misTareas', $data);
		} else {
			redirect(base_url() . "dashboardController", "location");
		}
	}

	function mensajes()
	{

		if (isset($_SESSION['id'])) {

			//INSERTAMOS MENSAJES
			if ($_POST) {
				$token = $this->Site_model->getToken($_SESSION['id'], $_SESSION['tipo']);

				$this->Site_model->insertMensaje($_POST, $token);
			}

			//OBTENEMOS LOS USUARIOS
			$data['usuarios'] = $this->Site_model->getUsuarios($_SESSION['tipo'], $_SESSION['curso']);

			//OBTENER MENSAJERIA
			$token = $this->Site_model->getToken($_SESSION['id'], $_SESSION['tipo']);
			$data['mensaje'] = $this->Site_model->getMensajes($token);

			$this->loadViews("mensajes", $data);
		} else {
			redirect(base_url() . "dashboardController", "location");
		}
	}

	public function getMensaje()
	{
		$texto = $this->Site_model->getTextMensaje(($_POST['idMensaje']));
		echo $texto[0]->texto;
	}

	public function traerTareasPendientes()
	{
		if (isset($_SESSION['id'])) {
			$data['tarea'] = $this->Site_model->getTareasPendientes($_SESSION['curso']);
		
		}
	}



	function loadViews($view, $data = null)
	{
		if (isset($_SESSION['username'])) {

			if ($view == "login") {
				redirect(base_url() . "dashboardController", "location");
			}
			$this->load->view('includes/header');
			$this->load->view('includes/sidebar');
			$this->load->view($view, $data); //content
			$this->load->view('includes/footer');
		} else {
			if ($view == "login") {
				$this->load->view('login');
			} else {
				redirect(base_url() . "dashboardController/login", "location");
			}
		}
	}



	public function logout()
	{
		$this->session->sess_destroy();

		redirect(base_url() . "dashboardController/login", "location");
	}
}
