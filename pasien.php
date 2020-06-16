<?php
    require APPPATH . 'libraries/REST_Controller.php';
    
    class pasien extends REST_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }
        public function index_get($id = 0)
        {
            if(!empty($id = 0)){
                $data = $this->db->get_where("pasien", ['no_rm' => $id])->result();
            } else {
                $data = $this->db->get("pasien")->result();
            }
            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function index_post()
        {
            $input = $this->input->post();
            $this->db->insert('pasien', $input);

            $this->response(['Data Pasien Berhasil dibuat.'], REST_Controller::HTTP_OK);
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
                $this->response(array('status' => 'Berhasil Merubah data pasien'), 201);
            } else {
                $this->response(array('status' => 'Gagal', 502));
            }
        }

         function index_delete() {
            $id = $this->delete('no_rm');
            $this->db->where('no_rm', $id);
            $delete = $this->db->delete('pasien');
            if ($delete) {
                $this->response(array('status' => 'Berhasil menghapus data pasien'), 201);
            } else {
                $this->response(array('status' => 'Gagal Menghapus data pasien', 502));
            }
        }
    }