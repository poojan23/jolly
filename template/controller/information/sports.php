<?php
class ControllerInformationSports extends PT_Controller {

    public function badminton() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(13);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/sports/badminton')
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

        $this->response->setOutput($this->load->view('information/sports/badminton', $data));
    }

    public function long_tennis_skating_volley_ball() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(14);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/sports/long_tennis_skating_volley_ball')
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

        $this->response->setOutput($this->load->view('information/sports/long_tennis_skating_volley_ball', $data));
    }
    
    public function squash() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(15);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/sports/squash')
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

        $this->response->setOutput($this->load->view('information/sports/squash', $data));
    }

    public function billiards() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(16);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/sports/billiards')
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

        $this->response->setOutput($this->load->view('information/sports/billiards', $data));
    }
     public function table_tennis() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(17);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/sports/table_tennis')
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

        $this->response->setOutput($this->load->view('information/sports/table_tennis', $data));
    }

    public function chess_carrom() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(18);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/sports/chess_carrom')
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

        $this->response->setOutput($this->load->view('information/sports/chess_carrom', $data));
    }

    public function cricket() {
        $this->load->language('membership/membership');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/information');
        
        $data['information_info'] = array();

        $information_info = $this->model_information_information->getInformation(19);

        foreach ($information_info as $info) {
             
            $data['breadcrumbs'][] = array(
                'text' => $info['title'],
                'href' => $this->url->link('information/sports/cricket')
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

        $this->response->setOutput($this->load->view('information/sports/cricket', $data));
    }
}