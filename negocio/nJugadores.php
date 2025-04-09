<?php
require_once '../persistencia/jugadores.php';
require_once '../persistencia/BD.php';

date_default_timezone_set('America/Mexico_City');

// CLASE PARA MANEJAR LOS ELEMENTOS DE LA CLASE PERMISO (PARA LOS USUARIOS)
class NJugadores{
    private $bd;

    public function __construct() {
        $this->bd = new BD();
    }

    public function convertirAJugador($info){
        $res = [];
        if ($info) {
            foreach ($info as $fila) {
                $res[] = new Jugador($fila);
            }
        }
        
        return $res;
    }

    /**
     * BUSCAR JUGADOR POR NOMBRE
     * @param string $nombre Nombre del jugador dado por el usuario
     * @return array Devuelve un arreglo con el jugador encontrado
     */
    public function buscarJugador($nombre) {
        $consulta = "SELECT * FROM clausura2025 WHERE NOMBRE = :nombre";
        $parametros = [':nombre' => $nombre];
        $resultados = $this->bd->consultaSelect($consulta, $parametros);
        return $this->convertirAJugador($resultados);
    }

    /**
     * OBTENER TODOS LOS JUGADORES
     * @return array Devuelve un arreglo con todos los jugadores
     */
    public function obtenerJugadores() {
        $consulta = "SELECT * FROM clausura2025";
        $resultados = $this->bd->consultaSelect($consulta);
        return $this->convertirAJugador($resultados);
    }

    /**
     * OBTENER TODOS LOS JUGADORES DE UNA SOLA TEMPORADA
     * @param int $temporada Temporada seleccionada
     * @return array Devuelve un arreglo con todos los jugadores
     */
    public function obtenerJugadoresPorTemporada($temporada) {
        $consulta = "SELECT * FROM equipos WHERE TEMPORADA LIKE :temporada";
        $parametros = [':temporada' => $temporada];
        $resultados = $this->bd->consultaSelectP($consulta, $parametros);
    
        $jugadoresMap = [];
    
        foreach ($resultados as $fila) {
            $key = $fila['NOMBRE'] . '|' . $fila['POSICION'];
    
            if (!isset($jugadoresMap[$key])) {
                $jugadoresMap[$key] = new Jugador($fila);
            } else {
                $jugadoresMap[$key]->agregarEquipo($fila['EQUIPO']);
            }
        }
    
        return array_values($jugadoresMap);
    }
    
    

}
?>
