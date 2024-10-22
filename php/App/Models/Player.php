<?php
namespace Joc4enRatlla\Models;

/**
 * Clase Player
 * 
 * Esta clase representa a un jugador con atributos como nombre, color y si el jugador es automático.
 * 
 * Atributos:
 * @property string $name Nombre del jugador.
 * @property string $color Color del jugador.
 * @property bool $isAutomatic Indica si el jugador es automático.
 * 
 * Métodos:
 * 
 * @method string getName() Obtener el nombre del jugador.
 * @method string getColor() Obtener el color del jugador.
 * @method bool getIsAutomatic() Comprobar si el jugador es automático.
 * @method void setName(string $name) Establecer el nombre del jugador.
 * @method void setColor(string $color) Establecer el color del jugador.
 * @method void setIsAutomatic(bool $isAutomatic) Establecer si el jugador es automático.
 */
class Player {
    private $name;      
    private $color;     
    private $isAutomatic;

    /**
     * Constructor de la clase Player.
     *
     * @param string $name El nombre del jugador.
     * @param string $color El color asociado al jugador.
     * @param bool $isAutomatic Indica si el jugador es automático. Valor por defecto es false.
     */
    public function __construct( $name, $color, $isAutomatic = false){
        $this->name = $name;
        $this->color = $color;
        $this->isAutomatic = $isAutomatic;
    }

    /**
     * Obtiene el nombre del jugador.
     *
     * @return string El nombre del jugador.
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Obtiene el color del jugador.
     *
     * @return string El color del jugador.
     */
    public function getColor(){
        return $this->color;
    }

    /**
     * Obtiene el estado automático del jugador.
     *
     * @return bool Devuelve true si el jugador está en modo automático, false en caso contrario.
     */
    public function getIsAutomatic(){
        return $this->isAutomatic;
    }

    /**
     * Establece el nombre del jugador.
     *
     * @param string $name El nombre del jugador.
     * @return void
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * Establece el color del jugador.
     *
     * @param string $color El color a establecer.
     * @return void
     */
    public function setColor($color){
        $this->color = $color;
    }

    /**
     * Establece si el jugador es automático.
     *
     * @param bool $isAutomatic Indica si el jugador es automático.
     * @return void
     */
    public function setIsAutomatic($isAutomatic){
        $this->isAutomatic = $isAutomatic;
    }


   
}