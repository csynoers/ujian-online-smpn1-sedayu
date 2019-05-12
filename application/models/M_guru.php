<?php 
class M_admin extends CI_Model{
    public function cek_user()
    {
        return $this->db->query("SELECT * FROM users WHERE username='{$this->username}' ")->num_rows();
    }
    public function user_store()
    {
        return $this->db->insert('users',[
            'username'=>$this->post['username'],
            'password'=> md5($this->post['password']),
            'level'=> $this->post['level'],
            'blok'=> 'N',
        ]);
    }
    public function user_update()
    {
        return $this->db->update('users',[
            'password'=> md5($this->post['password']),
        ],['username'=>$this->post['username'] ]);
    }

    public function guru_jk()
    {
        $query = " SHOW COLUMNS FROM `guru` LIKE 'jk' ";
        $row = $this->db->query(" {$query} ")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        return( $enum_fields );
    }

    public function guru_agama()
    {
        $query = " SHOW COLUMNS FROM `guru` LIKE 'agama' ";
        $row = $this->db->query(" {$query} ")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        return( $enum_fields );
    }

    public function siswa_jk()
    {
        $query = " SHOW COLUMNS FROM `siswa` LIKE 'jk' ";
        $row = $this->db->query(" {$query} ")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        return( $enum_fields );
    }

    public function siswa_agama()
    {
        $query = " SHOW COLUMNS FROM `siswa` LIKE 'agama' ";
        $row = $this->db->query(" {$query} ")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        return( $enum_fields );
    }
    
    public function soal_jawaban()
    {
        $query = " SHOW COLUMNS FROM `soal` LIKE 'jawaban' ";
        $row = $this->db->query(" {$query} ")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        return( $enum_fields );
    }

    public function data_guru_edit()
    {
        return $this->db->query("
            SELECT *
            FROM guru
                LEFT JOIN users
                    ON guru.username=users.username
            WHERE guru.username='{$this->username}'
        ")->row();
    }
    
    public function data_guru_update()
    {
        if ( ! empty($this->post['password']) ) {
            $this->user_update();
        } 
        
        $data= [
            'nama'=>$this->post['nama'],
            'alamat'=>$this->post['alamat'],
            'tempat_lahir'=>$this->post['tempat_lahir'],
            'tgl_lahir'=>$this->post['tgl_lahir'],
            'agama'=>$this->post['agama'],
            'no_telp'=>$this->post['telp'],
            'email'=>$this->post['email'],
            'jk'=>$this->post['jk'],
        ];
        
        if ( ! empty($this->post['gambar']) ) {
            $data['gambar']= $this->post['gambar'];
        }

        $where= [
            'username'=>$this->post['username'],
        ];
        return $this->db->update('guru',$data,$where);
    }

    public function data_grup_soal()
    {
        return $this->db->query("
            SELECT *,
                ( (SELECT COUNT(id_soal) FROM soal WHERE soal.id_grup_soal=grup_soal.id_grup_soal) ) AS jumlah_soal
            FROM grup_soal
                LEFT JOIN pbm
                    ON grup_soal.id_pelajaran=pbm.id_pelajaran
                LEFT JOIN pelajaran
                    ON pbm.id_pelajaran=pelajaran.id_pelajaran
                LEFT JOIN kelas
                    ON pelajaran.id_kelas=kelas.id_kelas
            WHERE pbm.nip='{$this->session->userdata('username')}'
                
        ")->result_object();
    }

    public function data_grup_soal_pelajaran()
    {
        return $this->db->query("
        SELECT *
        FROM pbm
            LEFT JOIN pelajaran
                ON pbm.id_pelajaran=pelajaran.id_pelajaran
            LEFT JOIN kelas
                ON pelajaran.id_kelas=kelas.id_kelas
        WHERE pbm.nip='{$this->session->userdata('username')}'
        ")->result_object();
    }
        
    public function data_grup_soal_store()
    {
        $data= [
            'nama_grup_soal'=>$this->post['nama_grup_soal'],
            'id_pelajaran'=>$this->post['id_pelajaran'],
        ];
        return $this->db->insert('grup_soal',$data);
    }

    public function data_grup_soal_edit()
    {
        return $this->db->query("
            SELECT * FROM table WHERE id='{$this->id}'
        ")->row();
    }

    public function data_soal()
    {
        return $this->db->query("
            SELECT *
            FROM soal
                LEFT JOIN grup_soal
                    ON soal.id_grup_soal=grup_soal.id_grup_soal
                LEFT JOIN pbm
                    ON grup_soal.id_pelajaran=pbm.id_pelajaran
                LEFT JOIN pelajaran
                    ON pbm.id_pelajaran=pelajaran.id_pelajaran
                LEFT JOIN kelas
                    ON pelajaran.id_kelas=kelas.id_kelas
            WHERE pbm.nip='{$this->session->userdata('username')}'
                
        ")->result_object();
    }

    public function data_soal_grup_soal()
    {
        return $this->db->query("
        SELECT *
        FROM grup_soal
            LEFT JOIN pbm
                ON grup_soal.id_pelajaran=pbm.id_pelajaran
            LEFT JOIN pelajaran
                ON pbm.id_pelajaran=pelajaran.id_pelajaran
            LEFT JOIN kelas
                ON pelajaran.id_kelas=kelas.id_kelas
        WHERE pbm.nip='{$this->session->userdata('username')}'
        ")->result_object();
    }
        
    public function data_soal_store()
    {
        $data= [
            'soal'=>$this->post['soal'],
            'a'=>$this->post['a'],
            'b'=>$this->post['b'],
            'c'=>$this->post['c'],
            'd'=>$this->post['d'],
            'id_grup_soal'=>$this->post['id_grup_soal'],
            'jawaban'=>$this->post['jawaban'],
        ];
        return $this->db->insert('soal',$data);
    }

    public function data_soal_edit()
    {
        return $this->db->query("
            SELECT * FROM soal WHERE id_soal='{$this->id_soal}'
        ")->row();
    }

    public function data_soal_update()
    {
        $data= [
            'soal'=>$this->post['soal'],
            'a'=>$this->post['a'],
            'b'=>$this->post['b'],
            'c'=>$this->post['c'],
            'd'=>$this->post['d'],
            'id_grup_soal'=>$this->post['id_grup_soal'],
            'jawaban'=>$this->post['jawaban'],
        ];
        $where= [
            'id_soal'=>$this->post['id_soal'],
        ];
        return $this->db->update('soal',$data,$where);
    }
    
}