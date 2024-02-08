<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Perhitungan extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->library('pagination');
            $this->load->library('form_validation');
            $this->load->model('Perhitungan_model');
        }

        public function index()
        {
            if ($this->session->userdata('id_user_level') != "1") {
            ?>
				<script type="text/javascript">
                    alert('Anda tidak berhak mengakses halaman ini!');
                    window.location='<?php echo base_url("Login/home"); ?>'
                </script>
            <?php
			}
			
			$kriteria = $this->Perhitungan_model->get_kriteria();
            $alternatif = $this->Perhitungan_model->get_alternatif();
			
			$this->Perhitungan_model->hapus_nilai_v();
			foreach ($alternatif as $keys){
				foreach ($kriteria as $key){
					$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif,$key->id_kriteria);
					$min_max=$this->Perhitungan_model->get_max_min($key->id_kriteria);
					$bobot = $key->bobot;
					if($min_max['jenis']=='Benefit'){
						$n_r = @(($data_pencocokan['nilai']-$min_max['min'])/($min_max['max']-$min_max['min']));
					}else{
						$n_r = @(($data_pencocokan['nilai']-$min_max['max'])/($min_max['min']-$min_max['max']));
					}
					$nilai_vk = ($bobot*$n_r)+$bobot;
					
					$n_v = [
						'id_alternatif' => $keys->id_alternatif,
						'id_kriteria' => $key->id_kriteria,
						'nilai' => $nilai_vk
					];
					$this->Perhitungan_model->insert_nilai_v($n_v);
				}
			}
			
			$this->Perhitungan_model->hapus_nilai_g();
			foreach ($kriteria as $key){
				$n_b = 1;
				foreach ($alternatif as $keys){
					$nilai_b = $this->Perhitungan_model->get_nilai_v($keys->id_alternatif,$key->id_kriteria);
					$n_b *= $nilai_b['nilai'];
				}
				$t_alt = $this->Perhitungan_model->get_t_alt();
				$ng = pow($n_b,1/$t_alt);
				$n_g = [
					'id_kriteria' => $key->id_kriteria,
					'nilai' => $ng
				];
				$this->Perhitungan_model->insert_nilai_g($n_g);
			}
			
			$data = [
                'page' => "Perhitungan",
                'kriteria'=> $this->Perhitungan_model->get_kriteria(),
                'alternatif'=> $this->Perhitungan_model->get_alternatif(),
            ];
			
            $this->load->view('Perhitungan/perhitungan', $data);
        }
		
		public function hasil()
        {
            $data = [
                'page' => "Hasil",
				'hasil'=> $this->Perhitungan_model->get_hasil()
            ];
			
            $this->load->view('Perhitungan/hasil', $data);
        }
    
    }
    
    