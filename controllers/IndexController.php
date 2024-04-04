<?php
require_once 'models/IndexModel.php';

class ImageController {
    private $imageModel;

    public function __construct($db) {
        $this->imageModel = new ImageModel($db);
    }

    public function getActiveImages() {
        return $this->imageModel->getActiveImages();
    }
}
?>
