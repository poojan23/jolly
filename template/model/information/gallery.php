<?php

class ModelInformationGallery extends PT_Model {
    
    public function getGalleryGroup() {

        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "gallery_group WHERE status = '1'");

        return $query->rows;
    }
    public function getGallery($gallery_group_id) {

        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "gallery WHERE gallery_group_id =".$gallery_group_id);

        return $query->rows;
    }
    public function getGalleryImage($gallery_id) {

        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "gallery_image WHERE gallery_id =".$gallery_id);

        return $query->rows;
    }
    
}