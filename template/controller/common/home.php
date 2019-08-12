<?php

class ControllerCommonHome extends PT_Controller
{
    public function index()
    {   
        $this->load->language('common/home');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('tool/image');

        $this->load->model('design/banner');

        $data['sliders'] = array();

        $results = $this->model_design_banner->getBanner(7, 0, 8);

        foreach ($results as $result) {
                $data['sliders'][] = array(
                    'title' => $result['title'],
                    'image' => $result['image']
                );
        }
        
        $data['definition'] = $this->url->link('information/membership/definition');
        $data['newsletter'] = $this->url->link('information/newsletter');
        $data['achievement'] = $this->url->link('information/achievement');
        $data['member_update'] = $this->url->link('information/member_update');
        
        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('common/home', $data));
    }
}
