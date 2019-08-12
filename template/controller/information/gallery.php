<?php

class ControllerInformationGallery extends PT_Controller {

    public function index() {
        $this->load->language('about/about');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->load->model('information/gallery');

        $data['gallery_group'] = array();

        $gallery_group = $this->model_information_gallery->getGalleryGroup();

        foreach($gallery_group as $gallery) {
            
        $children_data = array();

        $children = $this->model_information_gallery->getGallery($gallery['gallery_group_id']);
           
            foreach($children as $child) {
                
                $children_data_child = array();

                $children_child = $this->model_information_gallery->getGalleryImage($child['gallery_id']);

                    foreach($children_child as $child2) {
                        $children_data_child[] = array(
                            'gallery_id'  => $child2['gallery_id'],
                            'name'  => $child2['title'],
                            'image'  => $child2['image'],
                            'link'  => $child2['link']
                        );
                    }
            
                $children_data[] = array(
                    'gallery_id'  => $child['gallery_id'],
                    'children'  => $children_data_child,
                    'name'  => $child['name']
                );
            }

            $data['gallery_group'][] = array(
                'gallery_group_id'   => $gallery['gallery_group_id'],
                'children_child'  => $children_data,
                'name'  =>  $gallery['name']
            );
        }
        
        $data['continue'] = $this->url->link('common/home');
        
        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('information/gallery', $data));
    }
    
}
