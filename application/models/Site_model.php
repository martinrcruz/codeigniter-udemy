<?php
class Site_model extends CI_Model
{

    public function login()
    {
    }

    public function insertProfesor()
    {
        $array = array(
            "nombre" => "Martin",
            "apellidos" => "Rios",
            "curso" => 4
        );

        $this->db->insert("profesor", $array);
    }

    public function getProfesor()
    {

        $this->db->select("*");
        $this->db->from("profesor");
        //$this->db->where("id", 1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function updateProfesor()
    {
        $array = array(
            "nombre" => "Martin",
            "apellidos" => "Rios Cruz",
            "curso" => 1
        );

        $this->db->where("id", 1);
        $this->db->update("profesor", $array);
    }

    public function loginUser($data)
    {
        $this->db->select("*");
        $this->db->from("profesor");
        $this->db->where("username", $data['form-username']);
        $this->db->where("password", md5($data['form-password']));

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {

            $this->db->select("*");
            $this->db->from("alumno");
            $this->db->where("username", $data['form-username']);
            $this->db->where("password", md5($data['form-password']));

            $queryAlumno = $this->db->get();
            if ($queryAlumno->num_rows() > 0) {
                return $queryAlumno->result();
            }
            return NULL;
        }
    }

    public function getAlumnos($curso)
    {
        $this->db->select("*");
        $this->db->from("alumno");
        $this->db->where("curso", $curso);
        $this->db->where("deleted", 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function deleteAlumno($id)
    {
        $array = array(
            "deleted" => 1
        );
        $this->db->where("id", $id);
        $this->db->update("alumno", $array);
    }


    function uploadTarea($data, $archivo = null)
    {
        if ($archivo) {
            $array = array(
                "nombre" => $data['nombreTarea'],
                "descripcion" => $data['descripcionTarea'],
                "fecha_final" => $data['fechaFinalizacion'],
                "archivo" => $archivo,
                "curso" => $data['curso']
            );
        } else {
            $array = array(
                "nombre" => $data['nombreTarea'],
                "descripcion" => $data['descripcionTarea'],
                "fecha_final" => $data['fechaFinalizacion'],
                "archivo" => 'nulo',
                "curso" => $data['curso']
            );
        }


        $this->db->insert("tarea", $array);
    }

    function getTareas($curso)
    {
        $this->db->select("*");
        $this->db->from("tarea");
        $this->db->where("curso=" . $curso);
        $this->db->order_by("fecha_final", "ASC");

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function getUsuarios($tipo, $curso)
    {
        $this->db->select("*");
        if ($tipo == "profesor") {
            $this->db->from("alumno");
        };
        if ($tipo == "alumno") {
            $this->db->from("profesor");
        };

        $this->db->where("curso", $curso);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }


    function insertMensaje($data, $iduser)
    {
        $array = array(
            "texto" => $data['mensaje'],
            "id_from" => $iduser,
            "id_to" => $data['id_to']
        );

        $this->db->insert("mensaje", $array);
    }

    function getToken($id, $tipo)
    {

        $this->db->select("*");
        $this->db->where("id", $id);

        if ($tipo == "profesor") {
            $this->db->from("profesor");
        };
        if ($tipo == "alumno") {
            $this->db->from("alumno");
        };

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result[0]->token_mensaje;
        } else {
            return NULL;
        }
    }

    function getMensajes($token)
    {
        $this->db->select("*");
        $this->db->where("id_to", $token);
        $this->db->from("mensaje");
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function getTextMensaje($idMensaje)
    {
        $this->db->select("*");
        $this->db->from("mensaje");
        $this->db->where("id", $idMensaje);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $array = array(
                "is_read" => 1
            );
            $this->db->where("id", $idMensaje);
            $this->db->update("mensaje", $array);

            return $query->result();
        } else {
            return NULL;
        }
    }

    function getNombre($id)
    {

        $this->db->select("*");
        $this->db->from("alumno");
        $this->db->where("token_mensaje", $id);

        $query1 = $this->db->get_compiled_select();

        $this->db->select("*");
        $this->db->from("profesor");
        $this->db->where("token_mensaje", $id);

        $query2 = $this->db->get_compiled_select();

        $query = $this->db->query($query1 . " UNION " . $query2);

        //print_r($this->db->last_query());


        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function getTareasPendientes($curso)
    {
        $this->db->select("*");
        $this->db->from("tarea");
        $this->db->where("curso", $curso);
        $query = $this->db->get();

        echo $query->num_rows();
        print_r($query);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
}
