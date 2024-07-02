<?php

class Venta{
    public $ven_id;
    public $ven_numPedido;
    public $ven_mail;
    public $ven_nombre;
    public $ven_tipo;
    public $ven_talla;
    public $ven_stock;
    public $ven_fecha;

    public function crearVenta()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO ventas  (ven_numPedido,ven_mail,ven_nombre,ven_tipo,ven_talla,ven_stock,ven_fecha)VALUES (:numPedido,:mail,:nombre,:tipo,:talla,:stock,:fecha)");
        $consulta->bindValue(':numPedido', $this->ven_numPedido, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->ven_mail, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $this->ven_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->ven_tipo, PDO::PARAM_STR);
        $consulta->bindValue(':talla', $this->ven_talla, PDO::PARAM_STR);
        $consulta->bindValue(':stock', $this->ven_stock, PDO::PARAM_STR);
        $consulta->bindValue(':fecha', date('Y-m-d'), PDO::PARAM_STR);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function NuevoNumPedido()
	{
		$random = random_int(1000, 9999);
		do {
			$existe = false;
            $pedido= Venta::existeNumPedido($random);
			if (!empty($pedido)){
				$random = random_int(1000, 9999);
				$existe = true;
			}
		} while ($existe);
		return $random;
	}

    public static function existeNumPedido($numPedido){

        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * from ventas where ven_numPedido = :numPedido");
        $consulta->bindValue(':numPedido', $numPedido, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Venta');

    }


    public static function ventaPorFecha($fecha){

        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * from ventas where ven_fecha = :fecha");
        $consulta->bindValue(':fecha', $fecha, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Venta');

    }

    public static function ventaPorUsuario($usuario){

        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * from ventas where ven_mail = :usuario");
        $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Venta');

    }

    
    public static function ventaPorProducto($art){

        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * from ventas where ven_tipo = :tipo");
        $consulta->bindValue(':tipo', $art, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Venta');

    }


    public static function gananciaPorFecha($fecha){

        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT sum(t.tie_precio * v.ven_stock) as total from ventas v inner join tienda t on t.tie_nombre = v.ven_nombre where v.ven_fecha = :fecha ");
        $consulta->bindValue(':fecha', $fecha, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchColumn();

    }

    public static function gananciaTotal(){

        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT sum(t.tie_precio * v.ven_stock) as total from ventas v inner join tienda t on t.tie_nombre = v.ven_nombre");

        //SELECT sum(t.tie_precio) as totalPorDia , v.ven_fecha from ventas v inner join tienda t on t.tie_nombre = v.ven_nombre GROUP BY v.ven_fecha;
        $consulta->execute();
        return $consulta->fetchColumn();

    }


    public static function obtenerUno($numeroPedido){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM ventas where ven_id = :id");
        $consulta->bindValue(':id', $numeroPedido, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Venta');

    }


    public  function modificarVenta($numeroPedido,$mail,$nombre,$tipo,$talla,$cantidad){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("UPDATE ventas set ven_mail = :mail , ven_nombre = :nombre , ven_tipo = :tipo ,ven_talla = :talla , ven_stock = :cantidad where ven_id = :id");
        $consulta->bindValue(':id', $numeroPedido, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $mail, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->bindValue(':talla', $talla, PDO::PARAM_STR);
        $consulta->bindValue(':cantidad', $cantidad, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Venta');

    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM ventas");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Venta');
    }

}