<?php

class Usuarios{

    public $usu_id;
    public $usu_mail;
    public $usu_nombre;
    public $usu_perfil;
    public $usu_clave;
    public $usu_foto;
    public $usu_fecha_alta;
    public $usu_fecha_baja;

    public function crearUsuario($rutaArchivo)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO usuarios  (usu_mail,usu_nombre,usu_perfil,usu_clave,usu_foto,usu_fecha_alta,usu_fecha_baja)VALUES (:mail,:nombre,:tipo,:clave,:foto,:fechaAlta,:fechaBaja)");
        $consulta->bindValue(':mail', $this->usu_mail, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $this->usu_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->usu_perfil, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->usu_clave, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $rutaArchivo, PDO::PARAM_STR);
        $consulta->bindValue(':fechaAlta',date('Y-m-d'), PDO::PARAM_STR);
        $consulta->bindValue(':fechaBaja',"N/A", PDO::PARAM_STR);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }


    public static function obtenerUno($nombre , $clave){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuarios where usu_nombre = :nombre and usu_clave = :clave");
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuarios');

    }

    
    public static function TraerPorId($id)
    {
        $objAccesoDatos = AccesoDatos::ObtenerInstancia();
        $req = $objAccesoDatos->PrepararConsulta("SELECT * FROM usuarios WHERE usu_id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_CLASS, 'Usuarios');
    }


    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuarios");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuarios');
    }

    
}