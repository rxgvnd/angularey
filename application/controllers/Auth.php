<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
  {
			parent::__construct();
  }

	public function index()
	{
		$this->login();
	}

  public function login($param1='',$param2=''){
		if ($param1=='do_login') {
			$username = $this->input->post('username');
			$cekUser = $this->GeneralModel->get_by_id_general('at_pengguna','username',$username);
			if (empty($cekUser)) {
				$cekUser = $this->GeneralModel->get_by_id_general('at_pengguna','email',$username);
			}
			if ($cekUser) {
				$password = sha1($this->input->post('password'));
				$getUser = $this->AuthModel->getAccountLogin($username,$password);
				if (empty($getUser)) {
					$getUser = $this->AuthModel->getAccountLoginEmail($username,$password);
				}
				if ($getUser) {
					foreach ($getUser as $key) {
						if ($key->status_pengguna == 0) {
							$this->session->set_flashdata('notif','<div class="alert alert-danger">Silahkan aktivasi email kamu terlebih dahulu!</div>');
							redirect('/auth/login');
						}

						// if (!empty($key->login_token) && $key->hak_akses == 'member') {
						// 	$this->session->set_flashdata('notif','<div class="alert alert-danger">Mohon maaf akun kamu terdeteksi sedang login di device lain, silahkan keluarkan akun kamu pada device tersebut terlebih dahulu atau silahkan tunggu 5 menit untuk login kembali</div>');
						// 	redirect('/auth/login');
						// }

						$dataAkun = array(
							'id_pengguna' => $key->id_pengguna,
							'hint' => $key->hint,
							'exp' => $key->exp,
							'point' => $key->point,
							'pizza' => $key->pizza,
							'nama_lengkap' => $key->nama_lengkap,
							'username' => $key->username,
							'no_hp' => $key->no_hp,
							'email_pengguna' => $key->email_pengguna,
							'foto_pengguna' => $key->foto_pengguna,
							'hak_akses' => $key->hak_akses,
							'LoggedIN' => TRUE
						);
					}

					$this->session->set_userdata($dataAkun);
					$updateLogin = array(
						'last_login' => date('Y-m-d H:i:s'),
						'login_token' => sha1($dataAkun['username']).strtotime(date('Y-m-d H:i:s'))
					);
					$this->GeneralModel->update_general('at_pengguna','id_pengguna',$dataAkun['id_pengguna'],$updateLogin);
					setcookie('code', $updateLogin['login_token'], time() + (86400 * 30), "/");
					$this->session->set_flashdata('notif','<div class="alert alert-success">Login Success</div>');
					redirect('panel/dashboard');
				}else {
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Wrong username and password</div>');
					redirect('/auth/login');
				}
			}else {
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Account not found</div>');
					redirect('/auth/login');
			}
		}else {
			if (!empty($_COOKIE['code'])) {
			$cekUser = $this->GeneralModel->get_by_id_general('at_pengguna','login_token',$_COOKIE['code']);
			if ($cekUser) {
					foreach ($cekUser as $key) {
						$dataAkun = array(
							'id_pengguna' => $key->id_pengguna,
							'hint' => $key->hint,
							'exp' => $key->exp,
							'point' => $key->point,
							'pizza' => $key->pizza,
							'nama_lengkap' => $key->nama_lengkap,
							'username' => $key->username,
							'email_pengguna' => $key->email_pengguna,
							'foto_pengguna' => $key->foto_pengguna,
							'hak_akses' => $key->hak_akses,
							'LoggedIN' => TRUE
						);
					}

					if ($key->status_pengguna == 0) {
						$this->session->set_flashdata('notif','<div class="alert alert-danger">please activate your email!</div>');
						redirect('/auth/login');
					}
					$this->session->set_userdata($dataAkun);
					$updateLogin = array(
						'last_login' => date('Y-m-d H:i:s'),
						'login_token' => sha1($dataAkun['username']).strtotime(date('Y-m-d H:i:s'))
					);
					$this->GeneralModel->update_general('at_pengguna','id_pengguna',$dataAkun['id_pengguna'],$updateLogin);
					setcookie('code', $updateLogin['loginToken'], time() + (86400 * 30), "/");
					$this->session->set_flashdata('notif','<div class="alert alert-success">Login Success</div>');
					redirect('panel/dashboard');
				}else{
					$data['appsProfile'] = $this->SettingsModel->get_profile();
					$this->load->view('login',$data);
				}
			}else{
				$data['appsProfile'] = $this->SettingsModel->get_profile();
				$this->load->view('login',$data);
			}
		}
  }

	public function logout()
	{
		$updateLogin = array(
			'last_logout' => date('Y-m-d H:i:s'),
			'login_token' => ''
		);
		$this->GeneralModel->update_general('at_pengguna','id_pengguna',$this->session->userdata('id_pengguna'),$updateLogin);
		$this->session->sess_destroy();
		redirect(base_url('auth/login'),'refresh');
	}

	public function access_denied(){
		$data['appsProfile'] = $this->SettingsModel->get_profile();
		$data['title'] = '401';
		$this->load->view('errors/panel/unauthorized_access',$data);
	}

	public function register($param1=''){
		$data['appsProfile'] = $this->SettingsModel->get_profile();
		if ($param1=='doRegister') {
			//---------- VALIDATION -------------//
			$this->form_validation->set_rules(
					'username', 'Username',
					'required|min_length[5]|max_length[12]|is_unique[at_pengguna.username]',
					array(
							'required'      => 'Username tidak boleh kosong',
							'is_unique'     => 'Username tidak dapat digunakan',
							'max_length' => 'Username tidak boleh lebih dari 12 karakter',
							'min_length' => 'Username tidak boleh kurang dari 5 karakter'
					)
			);
			$this->form_validation->set_rules(
					'email', 'Email',
					'required|is_unique[at_pengguna.email]',
					array(
							'required'      => 'Email tidak boleh kosong',
							'is_unique'     => 'Email tidak dapat digunakan, pastikan email anda belum pernah didaftarkan sebelumnya'
					)
			);
			$this->form_validation->set_rules(
					'nama_lengkap', 'Nama Lengkap',
					'required',
					array(
							'required'      => 'Nama Lengkap tidak boleh kosong'
					)
			);
			$this->form_validation->set_rules(
					'no_hp', 'Nomor HP',
					'required',
					array(
							'required'      => 'Nomor HP tidak boleh kosong',
					)
			);
			$this->form_validation->set_rules(
					'password', 'Password',
					'required',
					array(
							'required'      => 'Password tidak boleh kosong',
					)
			);
			$this->form_validation->set_rules(
					're_password', 'Ulangin Password',
					'required|matches[password]',
					array(
							'required'      => 'Ulangi Password tidak boleh kosong',
							'matches'		=> 'Password dan Ulangi Password tidak sama'
					)
			);			
			//---------- END OF VALIDATION -------------//
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('register',$data);
			}else{
				$password = $this->input->post('password');
				$dataPengguna = array(
					'username' => $this->input->post('username'),
					'nama_lengkap' => $this->input->post('nama_lengkap'),
					'email' => $this->input->post('email'),
					'no_hp' => $this->input->post('no_hp'),
					'password' => sha1($password),
					'hak_akses' => 'member',
					'hint' => '2',
					'status_pengguna' => '1'
				);
				if ($this->GeneralModel->create_general('at_pengguna',$dataPengguna) == TRUE) {
					sendMail('Aktivasi', '/email/activation', $this->input->post('email'),$dataPengguna);
					$message = 'Halo *'.$dataPengguna['nama_lengkap'].'*!';
					$message .= "                                                            Selamat bergabung menjadi bagian dari Angularey!";
					$message .= "                                                            ";
					$message .= "                                                            Simpan informasimu baik-baik ya!";
					$message .= "                                                            *Username* : ".$dataPengguna['username'];
					$message .= "                                                            *Password* : ".$password;
					$message .= "                                                            ";
					$message .= "                                                            Satu akun hanya diperbolehkan digunakan oleh satu orang, sistem akan mendeteksi dan memblokir jika ada penggunaan berganda oleh beberapa orang.";
					$message .= "                                                            ";
					$message .= "                                                            ";
					$message .= "                                                            Terima kasih!";
					sendNotifWA($dataPengguna['no_hp'],$message);
					// $this->session->set_flashdata('notif','<div class="alert alert-success">Silahkan cek email untuk melakukan aktivasi akun kamu!. Jika email tidak masuk silahkan cek spam atau kontak admin <a href="https://wa.me/6283867991568?text=hallo admin tolong aktifasi akun dengan username '.$dataPengguna['username'].'" target="_blank">Klik disini</a></div>');					
					$this->session->set_flashdata('notif','<div class="alert alert-success">Congrats! your account was created</div>');					
					redirect('auth/login');
				}
			}
		}else{
			$this->load->view('register',$data);
		}
	}

}