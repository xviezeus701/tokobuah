<?php
    require APPPATH . 'libraries/REST_Controller.php';
    
    class dokter extends REST_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }
        public function index_get($id = 0)
        {
            if(!empty($id = 0)){
                $data = $this->db->get_where("dokter", ['id_dokter' => $id])->result();
            } else {
                $data = $this->db->get("dokter")->result();
            }
            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function index_post()
        {
            $input = $this->input->post();
            $this->db->insert('dokter', $input);

            $this->response(['Data Dokter Berhasil Dibuat.'], REST_Controller::HTTP_OK);
        }

        /**
         * get All Data from this method
         * 
         * @return Response
         */


         function index_put() {
            $id = $this->put('no_rm');
            $data = array(
                        'no_rm'       => $this->put('no_rm'),
                        'nama'          => $this->put('nama'),
                        'tipe_pasien'    => $this->put('tipe_pasien'),
                        'alamat'          => $this->put('alamat'));
            $this->db->where('no_rm', $id);
            $update = $this->db->update('pasien', $data);
            if ($update) {
                $this->response(array('status' => 'Berhasil Merubah data Dokter'), 201);
            } else {
                $this->response(array('status' => 'Gagal', 502));
            }
        }

         function index_delete() {
            $id = $this->delete('id_dokter');
            $this->db->where('id_dokter', $id);
            $delete = $this->db->delete('dokter');
            if ($delete) {
                $this->response(array('status' => 'Berhasil melakukan Penghapusan'), 201);
            } else {
                $this->response(array('status' => 'Gagal Melakukan Penghapusan', 502));
            }
        }
    }