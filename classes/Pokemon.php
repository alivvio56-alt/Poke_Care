<?php
abstract class Pokemon {
    protected $name;
    protected $type;
    protected $level;
    protected $hp;

    public function __construct($name, $type, $level, $hp) {
        $this->name = $name;
        $this->type = $type;
        $this->level = $level;
        $this->hp = $hp;
    }

    // Encapsulation: Getter dan Setter
    public function getName() { return $this->name; }
    public function getType() { return $this->type; }
    public function getLevel() { return $this->level; }
    public function getHp() { return $this->hp; }
    public function setLevel($level) { $this->level = $level; }
    public function setHp($hp) { $this->hp = $hp; }

    // Abstraction: Method abstract
    abstract public function specialMove();
    abstract public function train($type, $intensity);
}
?>