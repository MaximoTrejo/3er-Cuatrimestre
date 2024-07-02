<?php

class Archivo
{
    public static function GuardarArchivoPeticion($directorio, $nuevoNombre, $key, $extension)
    {
        if (!is_dir($directorio))
            mkdir($directorio, 0777, true);

        if (!isset($_FILES[$key]))
            return "N/A";

        $tmpName = $_FILES[$key]["tmp_name"];
        $destino = $directorio . $nuevoNombre . $extension;

        if (move_uploaded_file($tmpName, $destino))
            return $destino;
        else
            return "N/A";
    }


}
