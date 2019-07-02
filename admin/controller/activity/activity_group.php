<?php

class ControllerActivityActivityGroup extends PT_Controller {

    private $error = array();

    public function index() {
        $this->load->language('activity/activity_group');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('activity/activity_group');

        $this->getList();
    }

    public function add() {
        $this->load->language('activity/activity_group');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('activity/activity_group');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_activity_activity_group->addActivityGroup($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('activity/activity_group', 'user_token=' . $this->session->data['user_token'], true));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('activity/activity_group');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('activity/activity_group');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_activity_activity_group->editActivityGroup($this->request->get['banner_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('activity/activity_group', 'user_token=' . $this->session->data['user_token'], true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('activity/activity_group');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('activity/activity_group');

        if (isset($this->request->post['selected'])) {
            foreach ($this->request->post['selected'] as $banner_id) {
                $this->model_activity_activity_group->deleteActivityGroup($banner_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('activity/activity_group', 'user_token=' . $this->session->data['user_token'], true));
        }

        $this->getList();
    }

    protected function getList() {
        $this->document->addStyle("view/dist/plugins/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css");
        $this->document->addStyle("view/dist/plugins/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css");
        $this->document->addStyle("view/dist/plugins/DataTables/FixedHeader-3.1.4/css/fixedHeader.bootstrap4.min.css");
        $this->document->addStyle("view/dist/plugins/DataTables/Responsive-2.2.2/css/responsive.bootstrap4.min.css");
        $this->document->addScript("view/dist/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/Buttons-1.5.6/js/buttons.bootstrap4.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/JSZip-2.5.0/jszip.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/pdfmake-0.1.36/pdfmake.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/pdfmake-0.1.36/vfs_fonts.js");
        $this->document->addScript("view/dist/plugins/DataTables/Buttons-1.5.6/js/buttons.html5.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/Buttons-1.5.6/js/buttons.print.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/FixedHeader-3.1.4/js/dataTables.fixedHeader.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/FixedHeader-3.1.4/js/fixedHeader.bootstrap4.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/Responsive-2.2.2/js/dataTables.responsive.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/Responsive-2.2.2/js/responsive.bootstrap4.min.js");

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('activity/activity_group', 'user_token=' . $this->session->data['user_token'])
        );

        $data['add'] = $this->url->link('activity/activity_group/add', 'user_token=' . $this->session->data['user_token']);
        $data['delete'] = $this->url->link('activity/activity_group/delete', 'user_token=' . $this->session->data['user_token']);

        $data['banners'] = array();

        $results = $this->model_activity_activity_group->getActivityGroups();
       
        foreach ($results as $result) {
            $data['banners'][] = array(
                'banner_id' => $result['banner_id'],
                'name' => $result['name'],
                'status' => $result['status'],
                'edit' => $this->url->link('activity/activity_group/edit', 'user_token=' . $this->session->data['user_token'] . '&banner_id=' . $result['banner_id']),
                'delete' => $this->url->link('activity/activity_group/delete', 'user_token=' . $this->session->data['user_token'] . '&banner_id=' . $result['banner_id'])
            );
        }

        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array) $this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('activity/activity_group_list', $data));
    }

    protected function getForm() {
        $this->document->addStyle("view/dist/plugins/iCheck/all.css");
        $this->document->addScript("view/dist/plugins/ckeditor/ckeditor.js");
        $this->document->addScript("view/dist/plugins/ckeditor/adapters/jquery.js");
        $this->document->addScript("view/dist/plugins/iCheck/icheck.min.js");

        $data['text_form'] = !isset($this->request->get['banner_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }

        if (isset($this->error['banner_image'])) {
            $data['error_banner_image'] = $this->error['banner_image'];
        } else {
            $data['error_banner_image'] = array();
        }

        if (isset($this->error['keyword'])) {
            $data['keyword_err'] = $this->error['keyword'];
        } else {
            $data['keyword_err'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('activity/activity_group', 'user_token=' . $this->session->data['user_token'])
        );

        if (!isset($this->request->get['banner_id'])) {
            $data['action'] = $this->url->link('activity/activity_group/add', 'user_token=' . $this->session->data['user_token']);
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_add'),
                'href' => $this->url->link('activity/activity_group/add', 'user_token=' . $this->session->data['user_token'])
            );
        } else {
            $data['action'] = $this->url->link('activity/activity_group/edit', 'user_token=' . $this->session->data['user_token'] . '&banner_id=' . $this->request->get['banner_id']);
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('activity/activity_group/edit', 'user_token=' . $this->session->data['user_token'] . '&banner_id=' . $this->request->get['banner_id'])
            );
        }

        $data['cancel'] = $this->url->link('activity/activity_group', 'user_token=' . $this->session->data['user_token']);

        if (isset($this->request->get['banner_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
           $banner_info = $this->model_activity_activity_group->getActivityGroup($this->request->get['banner_id']);
        }
        
        $data['user_token'] = $this->session->data['user_token'];

        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($banner_info)) {
            $data['name'] = $banner_info['name'];
        } else {
            $data['name'] = '';
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($banner_info)) {
            $data['status'] = $banner_info['status'];
        } else {
            $data['status'] = true;
        }
        
        if (isset($this->request->post['sport_group_id'])) {
            $data['sport_group_id'] = $this->request->post['sport_group_id'];
        } elseif (!empty($event_info)) {
            $data['sport_group_id'] = $event_info['sport_group_id'];
        } else {
            $data['sport_group_id'] = '';
        }

        $this->load->model('activity/activity_group_group');

        $data['sport_groups'] = $this->model_activity_activity_group_group->getActivityGroupGroups();
        
        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        $this->load->model('tool/image');

        if (isset($this->request->post['banner_image'])) {
            $banner_images = $this->request->post['banner_image'];
        } elseif (isset($this->request->get['banner_id'])) {
            $banner_images = $this->model_activity_activity_group->getActivityGroupImages($this->request->get['banner_id']);
        } else {
            $banner_images = array();
        }

        $data['banner_images'] = array();

        foreach ($banner_images as $key => $value) {
            foreach ($value as $banner_image) {
                if (is_file(DIR_IMAGE . $banner_image['image'])) {
                    $image = $banner_image['image'];
                    $thumb = $banner_image['image'];
                } else {
                    $image = '';
                    $thumb = 'no-image.png';
                }

                $data['banner_images'][$key][] = array(
                    'title' => $banner_image['title'],
                    'link' => $banner_image['link'],
                    'image' => $image,
                    'thumb' => $this->model_tool_image->resize($thumb, 100, 100),
                    'sort_order' => $banner_image['sort_order']
                );
            }
        }

        $data['placeholder'] = $this->model_tool_image->resize('no-image.png', 100, 100);

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('activity/activity_group_form', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'activity/activity_group')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if (isset($this->request->post['banner_image'])) {
            foreach ($this->request->post['banner_image'] as $language_id => $value) {
                foreach ($value as $banner_image_id => $banner_image) {
                    if ((utf8_strlen($banner_image['title']) < 2) || (utf8_strlen($banner_image['title']) > 64)) {
                        $this->error['banner_image'][$language_id][$banner_image_id] = $this->language->get('error_title');
                    }
                }
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('delete', 'activity/activity_group')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function autocomplete() {
        $json = array();

        if (isset($this->request->get['filter_name'])) {
            $this->load->model('activity/activity_group');

            $filter_data = [
                'filter_name' => $this->request->get['filter_name'],
                'sort' => 'name',
                'order' => 'ASC',
                'start' => 0,
                'limit' => 5
            ];

            $results = $this->model_activity_activity_group->getActivityGroups($filter_data);

            foreach ($results as $result) {
                $json[] = [
                    'banner_id' => $result['banner_id'],
                    'name' => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
                ];
            }

            $sort_order = array();

            foreach ($json as $key => $value) {
                $sort_order[$key] = $value['name'];
            }

            array_multisort($sort_order, SORT_ASC, $json);

            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }
    }

}
