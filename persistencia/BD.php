<?php

require_once '../passwords.php';

// CLASE DE LA BASE DE DATOS
class BD {
    private $pdo = null;
    private static $host;
    private static $user;
    private static $password;
    protected $db;

    /**
     * CONSTRUCTOR DE LA BASE DE DATOS.
     * @param string|null $host Dirección del host de la base de datos
     * @param string|null $db Nombre de la base de datos
     * @param string|null $username Usuario de la base de datos
     * @param string|null $password Contraseña de la base de datos
     */
    public function __construct($host = null, $db = null, $username = null, $password = null) {
        global $h, $u, $p, $bd;

        // Asignar valores desde parámetros o archivo de configuración
        self::$host = $host ?: $h;
        self::$user = $username ?: $u;
        self::$password = $password ?: $p;
        $this->db = $db ?: $bd;
    }

    /**
     * Conectar a la base de datos.
     * @return PDO Instancia de la conexión
     */
    private function conectar() {
        if ($this->pdo === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";dbname=" . $this->db . ";charset=utf8mb4";
                $this->pdo = new PDO($dsn, self::$user, self::$password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                error_log("Error en la conexión a la base de datos: " . $e->getMessage());
                throw new Exception("Error al conectar con la base de datos.");
            }
        }
        return $this->pdo;
    }

    /**
     * Ejecuta una consulta SELECT sin parámetros.
     * @param string $consulta SQL de la consulta
     * @return array Datos obtenidos
     */
    public function consultaSelect($consulta) {
        try {
            $conexion = $this->conectar();
            $stmt = $conexion->prepare($consulta);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error en consultaSelect: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Ejecuta una consulta SELECT con parámetros.
     * @param string $consulta SQL de la consulta
     * @param array $parametros Parámetros a enlazar
     * @return array Datos obtenidos
     */
    public function consultaSelectP($consulta, $parametros = []) {
        try {
            $conexion = $this->conectar();
            $stmt = $conexion->prepare($consulta);
            $stmt->execute($parametros);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error en consultaSelectP: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Ejecuta una consulta INSERT, UPDATE o DELETE.
     * @param string $consulta SQL de la consulta
     * @param array $params Parámetros a enlazar
     * @return int Número de filas afectadas
     */
    public function consultaAccion($consulta, $params = []) {
        try {
            $conexion = $this->conectar();
            $stmt = $conexion->prepare($consulta);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Error en consultaAccion: " . $e->getMessage());
            return 0;
        }
    }
}
?>
