<?php
require_once '../modeles/Habitat.php';

class HabitatControleur {
    public function lireHabitats() {
        $habitat = new Habitat();
        return $habitat->lireTous();
    }

    public function lireHabitat($id) {
        $habitat = new Habitat();
        return $habitat->lireUn($id);
    }
}
?>
