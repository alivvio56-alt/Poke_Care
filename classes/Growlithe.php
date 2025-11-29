<?php
require_once 'Pokemon.php';

class Growlithe extends Pokemon {
    public function __construct() {
        parent::__construct("Growlithe", "Api", 5, 50);
    }

    // Polymorphism: Override specialMove
    public function specialMove() {
        return "Flamethrower: Menembakkan api panas yang dapat membakar musuh dengan intensitas tinggi.";
    }

    // Polymorphism: Override train (pengaruh tipe Api: fokus Attack, peningkatan lebih cepat)
    public function train($type, $intensity) {
        $oldLevel = $this->level;
        $oldHp = $this->hp;

        switch ($type) {
            case 'Attack':
                $this->level += 2 * $intensity; // Lebih cepat untuk tipe Api
                $this->hp += 1 * $intensity;
                break;
            case 'Defense':
                $this->level += 1 * $intensity;
                $this->hp += 2 * $intensity;
                break;
            case 'Speed':
                $this->level += 1 * $intensity;
                $this->hp += 1 * $intensity;
                break;
        }

        return [
            'oldLevel' => $oldLevel,
            'newLevel' => $this->level,
            'oldHp' => $oldHp,
            'newHp' => $this->hp
        ];
    }
}
?>