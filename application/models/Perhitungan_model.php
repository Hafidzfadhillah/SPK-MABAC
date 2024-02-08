<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Perhitungan_model extends CI_Model {
       
        public function get_kriteria()
        {
            $query = $this->db->get('kriteria');
            return $query->result();
        }
        public function get_alternatif()
        {
            $query = $this->db->get('alternatif');
            return $query->result();
        }
		
		public function data_nilai($id_alternatif,$id_kriteria)
		{
			$query = $this->db->query("SELECT * FROM penilaian JOIN sub_kriteria WHERE penilaian.nilai=sub_kriteria.id_sub_kriteria AND penilaian.id_alternatif='$id_alternatif' AND penilaian.id_kriteria='$id_kriteria';");
			return $query->row_array();
		}

		public function get_max_min($id_kriteria)
		{
			$query = $this->db->query("SELECT max(sub_kriteria.nilai) as max, min(sub_kriteria.nilai) as min, sub_kriteria.nilai as nilai, 
			kriteria.jenis FROM `penilaian` 
			JOIN sub_kriteria ON penilaian.nilai=sub_kriteria.id_sub_kriteria 
			JOIN kriteria ON penilaian.id_kriteria=kriteria.id_kriteria 
			WHERE penilaian.id_kriteria='$id_kriteria';");
			return $query->row_array();
		}
		
		public function get_nilai_v($id_alternatif,$id_kriteria)
		{
			$query = $this->db->query("SELECT * FROM nilai_v WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
			return $query->row_array();
		}
		
		public function get_nilai_g($id_kriteria)
		{
			$query = $this->db->query("SELECT * FROM nilai_g WHERE id_kriteria='$id_kriteria';");
			return $query->row_array();
		}
		
		public function get_t_alt()
		{
			$query = $this->db->query("SELECT * FROM alternatif;");
			return $query->num_rows();
		}
		
		public function get_hasil()
        {
			$query = $this->db->query("SELECT * FROM hasil ORDER BY nilai DESC;");
            return $query->result();
        }
		
		public function get_hasil_alternatif($id_alternatif)
		{
			$query = $this->db->query("SELECT * FROM alternatif WHERE id_alternatif='$id_alternatif';");
			return $query->row_array();		
		}
		
		public function insert_nilai_hasil($hasil_akhir = [])
        {
            $result = $this->db->insert('hasil', $hasil_akhir);
            return $result;
        }
		
		public function hapus_hasil()
        {
            $query = $this->db->query("TRUNCATE TABLE hasil;");
			return $query;
        }
		
		public function insert_nilai_v($n_v = [])
        {
            $result = $this->db->insert('nilai_v', $n_v);
            return $result;
        }
		
		public function hapus_nilai_v()
        {
            $query = $this->db->query("TRUNCATE TABLE nilai_v;");
			return $query;
        }
		
		public function insert_nilai_g($n_g = [])
        {
            $result = $this->db->insert('nilai_g', $n_g);
            return $result;
        }
		
		public function hapus_nilai_g()
        {
            $query = $this->db->query("TRUNCATE TABLE nilai_g;");
			return $query;
        }
    }
    