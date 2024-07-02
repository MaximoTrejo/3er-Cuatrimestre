<?php

class Tienda{

    public $tie_id;
    public $tie_nombre;
    public $tie_precio;
    public $tie_tipo;
    public $tie_talla;
    public $tie_color;
    public $tie_stock;


    public function crearTienda()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO tienda  (tie_nombre,tie_precio,tie_tipo,tie_talla,tie_color,tie_stock)VALUES (:nombre ,:precio,:tipo,:talla,:color,:stock)");
        $consulta->bindValue(':nombre', $this->tie_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->tie_precio, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->tie_tipo, PDO::PARAM_STR);
        $consulta->bindValue(':talla', $this->tie_talla, PDO::PARAM_STR);
        $consulta->bindValue(':color', $this->tie_color, PDO::PARAM_STR);
        $consulta->bindValue(':stock', $this->tie_stock, PDO::PARAM_STR);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }


    public static function obtenerUno($nombre , $tipo){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM tienda where tie_nombre = :nombre and tie_tipo = :tipo");
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Tienda');

    }


    public function modStock($stock , $id){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("UPDATE tienda set tie_stock = :stock  where tie_id  = :id");
        $consulta->bindValue(':stock', $stock, PDO::PARAM_STR);
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Tienda');
    }
    public function modPrecio($id , $precio){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("UPDATE tienda set tie_precio = :precio where tie_id  = :id");
        $consulta->bindValue(':precio', $precio, PDO::PARAM_STR);
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Tienda');
    }


    public static function productosEntreValores($precioDesde,$precioHasta){

        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * from tienda where tie_precio >= :precioDesde and tie_precio <= :precioHasta");
        $consulta->bindValue(':precioDesde', $precioDesde, PDO::PARAM_STR);
        $consulta->bindValue(':precioHasta', $precioHasta, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Tienda');

    }

    public static function productosMasVendido(){

        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT p.tie_nombre, p.tie_tipo, p.tie_talla, p.tie_color, p.tie_precio, SUM(v.ven_stock) as cantidad_vendida FROM tienda p JOIN ventas v ON p.tie_nombre = v.ven_nombre AND p.tie_tipo = v.ven_tipo AND p.tie_talla = v.ven_talla GROUP BY p.tie_id ORDER BY cantidad_vendida DESC LIMIT 1");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS);

    }


    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM tienda");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Tienda');
    }

}