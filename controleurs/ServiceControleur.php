<?php
require_once '../modeles/Service.php';

class ServiceControleur {
    public function lireServices() {
        $service = new Service();
        return $service->lireTous();
    }

    public function lireService($id) {
        $service = new Service();
        return $service->lireUn($id);
    }
}
?>
