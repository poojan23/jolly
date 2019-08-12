<?php

class ControllerInformationMedia extends PT_Controller {

    public function index() {
        $this->load->language('about/about');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(42);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/media')
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

        $this->response->setOutput($this->load->view('information/media', $data));
    }
    
}
