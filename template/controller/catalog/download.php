<?php

class ControllerCatalogDownload extends PT_Controller {

    private $error = array();

    public function index() {
        $this->load->language('catalog/download');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/download');

        $this->getList();
    }
    
    public function download() {
        $this->load->model('catalog/download');

        if(isset($this->request->get['download_id'])) {
            $download_id = $this->request->get['download_id'];
        } else {
            $download_id = 0;
        }

        $download_info = $this->model_catalog_download->getDownload($download_id);

        if($download_info) {
            $file = DIR_DOWNLOAD . $download_info['filename'];
            $mask = basename($download_info['mask']);

            if(!headers_sent()) {
                if(file_exists($file)) {
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . ($mask ? $mask : basename($file)) . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));

                    if(ob_get_level()) {
                        ob_end_clean();
                    }

                    readfile($file, 'rb');

                    //$this->model_catalog_download->updateViewed($download_info['download_id']);

                    exit();
                } else {
                    exit("Error: Couldn't find the file $file!");
                }
            } else {
                exit("Error: Headers already sent out!");
            }
        } else {
            $this->response->redirect($this->url->link('catalog/download', '', true));
        }
    }
}
