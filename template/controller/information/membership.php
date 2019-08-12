<?php

class ControllerInformationMembership extends PT_Controller {

    public function definition() {
        
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

       
        $this->load->model('information/membership');
        
        $data['download_info'] = array();
   
        $download_info = $this->model_information_membership->getDownload();
//        
//        foreach ($download_info as $info) {
//            
//            $data['download_info'][] = array(
//                'id' => $info['download_id'],
//                'name' => $info['name'],
//                'filename' => $info['filename']
//            );
//            
//        }
        //print_r($data['download_info']);
        
        
        //$results = $this->model_catalog_product->getDownloadFile($product_id);

        foreach ($download_info as $info) {
            if (file_exists(DIR_DOWNLOAD . $info['filename'])) {
                $size = filesize(DIR_DOWNLOAD . $info['filename']);

                $i = 0;

                $suffix = array(
                    'B',
                    'KB',
                    'MB',
                    'GB',
                    'TB',
                    'PB',
                    'EB',
                    'ZB',
                    'YB'
                );

                while (($size / 1024) > 1) {
                    $size = $size / 1024;
                    $i++;
                }

                $size = round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i];

                $data['download_info'][] = array(
                    'download_id' => $info['download_id'],
                    'name' => $info['name'],
                    'filename' => $info['filename'],
                    'mask' => strtolower(substr(strrchr($info['mask'], '.'), 1)),
                    'size' => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i],
                    'href' => $this->url->link('catalog/download/download', 'download_id=' . $info['download_id'])
                );
            }
        }
//        print_r($data['download_info']);
        
        $this->load->model('information/information');
         
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(7);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/membership/definition')
            );
             
            $this->document->setTitle($info['title']);
            
            $data['information_info'][] = array(
                'id' => $info['information_id'],
                'name' => $info['title'],
                'description' => html_entity_decode($info['description'], ENT_QUOTES, 'UTF-8')
            );
            
        }
        
        $data['continue'] = $this->url->link('common/home');
        
        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('information/membership/definition', $data));
        
    }

    public function transfer_withdrawal() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(8);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/membership/transfer_withdrawal')
            );
             
            $this->document->setTitle($info['title']);
            
            $data['information_info'][] = array(
                'id' => $info['information_id'],
                'name' => $info['title'],
                'description' => html_entity_decode($info['description'], ENT_QUOTES, 'UTF-8')
            );
            
        }
        
        $data['continue'] = $this->url->link('common/home');
        
        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('information/membership/transfer_withdrawal', $data));
    }

    public function enlistment_of_Members() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(9);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/membership/enlistment_of_Members')
            );
             
            $this->document->setTitle($info['title']);
            
            $data['information_info'][] = array(
                'id' => $info['information_id'],
                'name' => $info['title'],
                'description' => html_entity_decode($info['description'], ENT_QUOTES, 'UTF-8')
            );
            
        }
        
        $data['continue'] = $this->url->link('common/home');
        
        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('information/membership/enlistment_of_Members', $data));
    }

    public function membership_fees() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(10);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/membership/membership_fees')
            );
             
            $this->document->setTitle($info['title']);
            
            $data['information_info'][] = array(
                'id' => $info['information_id'],
                'name' => $info['title'],
                'description' => html_entity_decode($info['description'], ENT_QUOTES, 'UTF-8')
            );
            
        }
        
        $data['continue'] = $this->url->link('common/home');
        
        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('information/membership/membership_fees', $data));
    }

    public function membership_sub_committee() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(12);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/membership/membership_sub_committee')
            );
             
            $this->document->setTitle($info['title']);
            
            $data['information_info'][] = array(
                'id' => $info['information_id'],
                'name' => $info['title'],
                'description' => html_entity_decode($info['description'], ENT_QUOTES, 'UTF-8')
            );
            
        }
        
        $data['continue'] = $this->url->link('common/home');
        
        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('information/membership/membership_sub_committee', $data));
    }

}