<?php

class ControllerInformationEvents extends PT_Controller {

    public function cultural_events() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(36);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/events/cultural_events')
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

        $this->response->setOutput($this->load->view('information/events/cultural_events', $data));
    }
    public function education_events() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(37);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/events/education_events')
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

        $this->response->setOutput($this->load->view('information/events/education_events', $data));
    }
    public function entertainment_events() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(38);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/events/entertainment_events')
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

        $this->response->setOutput($this->load->view('information/events/entertainment_events', $data));
    }
    public function sports_events() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(39);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/events/sports_events')
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

        $this->response->setOutput($this->load->view('information/events/sports_events', $data));
    }
     
}