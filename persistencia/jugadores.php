<?php

// CLASE JUGADOR
class Jugador {
    private string $numero;
    private string $nombre;
    private string $posicion;
    private string $pais;
    private array $equipos;

    public function __construct(array $data) {
        $this->numero = $data['NUMERO'] ?? '';
        $this->nombre = $data['NOMBRE'] ?? '';
        $this->posicion = $data['POSICION'] ?? '';
        $this->pais = $data['NACIONALIDAD'] ?? '';
        $this->equipos = [$data['EQUIPO'] ?? ''];
    }

    // ********************************************************
    // *********************** GETTERS ************************
    // ********************************************************
    public function getNumero(): string { return $this->numero; }
    public function getNombre(): string { return $this->nombre; }
    public function getPosicion(): string { return $this->posicion; }
    public function getPais(): string { return $this->pais; }
    public function getEquipo(): array { return $this->equipos; }

    // ********************************************************
    // *********************** SETTERS ************************
    // ********************************************************

    public function setNumero(string $numero): void { $this->numero = $numero; }
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }
    public function setPosicion(string $posicion): void { $this->posicion = $posicion; }
    public function setPais(string $pais): void { $this->pais = $pais; }
    public function setEquipo(array $equipos): void { $this->equipos = $equipos; }

    // Setter adicional para agregar equipos
    public function agregarEquipo(string $equipo): void {
        if (!in_array($equipo, $this->equipos)) {
            $this->equipos[] = $equipo;
        }
    }

}
?>
