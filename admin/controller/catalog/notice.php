<?php

class ControllerCatalogNotice extends PT_Controller {

    private $error = array();

    public function index() {
        $this->load->language('catalog/notice');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/notice');

        $this->getList();
    }

    public function add() {
        $this->load->language('catalog/notice');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/notice');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_notice->addNotice($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('catalog/notice', 'user_token=' . $this->session->data['user_token']));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('catalog/notice');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/notice');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_notice->editNotice($this->request->get['notice_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('catalog/notice', 'user_token=' . $this->session->data['user_token']));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('catalog/notice');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/notice');

        if (isset($this->request->post['selected'])) {
            foreach ($this->request->post['selected'] as $notice_id) {
                $this->model_catalog_notice->deleteNotice($notice_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('catalog/notice', 'user_token=' . $this->session->data['user_token']));
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
            'href' => $this->url->link('catalog/notice', 'user_token=' . $this->session->data['user_token'])
        );

        $data['add'] = $this->url->link('catalog/notice/add', 'user_token=' . $this->session->data['user_token']);
        $data['delete'] = $this->url->link('catalog/notice/delete', 'user_token=' . $this->session->data['user_token']);

        $data['notices'] = array();

        $results = $this->model_catalog_notice->getNotices();

        foreach ($results as $result) {
            $data['notices'][] = array(
                'notice_id' => $result['notice_id'],
                'date' => $result['date'],
                'title' => $result['title'],
                'filename' => $result['filename'],
                'edit' => $this->url->link('catalog/notice/edit', 'user_token=' . $this->session->data['user_token'] . '&notice_id=' . $result['notice_id'])
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

        $this->load->model('user/user');

        $user_info = $this->model_user_user->getUser($this->user->getId());

        if ($user_info) {
            $data['user_group'] = $user_info['user_group'];
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/notice_list', $data));
    }

    protected function getForm() {
        $this->document->addStyle("view/dist/plugins/iCheck/all.css");
        $this->document->addScript("view/dist/plugins/ckeditor/ckeditor.js");
        $this->document->addScript("view/dist/plugins/ckeditor/adapters/jquery.js");
        $this->document->addScript("view/dist/plugins/iCheck/icheck.min.js");
        $data['user_token'] = $this->session->data['user_token'];
        $data['text_form'] = !isset($this->request->get['notice_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->error['title'])) {
            $data['title_err'] = $this->error['title'];
        } else {
            $data['title_err'] = '';
        }

        if (isset($this->error['filename'])) {
            $data['filename_err'] = $this->error['filename'];
        } else {
            $data['filename_err'] = '';
        }

        if (isset($this->error['mask'])) {
            $data['mask_err'] = $this->error['mask'];
        } else {
            $data['mask_err'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/notice', 'user_token=' . $this->session->data['user_token'])
        );

        if (!isset($this->request->get['notice_id'])) {
            $data['action'] = $this->url->link('catalog/notice/add', 'user_token=' . $this->session->data['user_token']);
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_add'),
                'href' => $this->url->link('catalog/notice/add', 'user_token=' . $this->session->data['user_token'])
            );
        } else {
            $data['action'] = $this->url->link('catalog/notice/edit', 'user_token=' . $this->session->data['user_token'] . '&notice_id=' . $this->request->get['notice_id']);
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('catalog/notice/edit', 'user_token=' . $this->session->data['user_token'])
            );
        }

        $data['cancel'] = $this->url->link('catalog/notice', 'user_token=' . $this->session->data['user_token']);

        if (isset($this->request->get['notice_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $notice_info = $this->model_catalog_notice->getNotice($this->request->get['notice_id']);
        }

        if (isset($this->request->post['filename'])) {
            $data['filename'] = $this->request->post['filename'];
        } elseif (!empty($notice_info)) {
            $data['filename'] = $notice_info['filename'];
        } else {
            $data['filename'] = '';
        }

        if (isset($this->request->post['date'])) {
            $data['date'] = $this->request->post['date'];
        } elseif (!empty($notice_info)) {
            $data['date'] = $notice_info['date'];
        } else {
            $data['date'] = '';
        }

        if (isset($this->request->post['title'])) {
            $data['title'] = $this->request->post['title'];
        } elseif (!empty($notice_info)) {
            $data['title'] = $notice_info['title'];
        } else {
            $data['title'] = '';
        }

        if (isset($this->request->post['mask'])) {
            $data['mask'] = $this->request->post['mask'];
        } elseif (!empty($notice_info)) {
            $data['mask'] = $notice_info['mask'];
        } else {
            $data['mask'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/notice_form', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'catalog/notice')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['title']) < 3) || (utf8_strlen($this->request->post['title']) > 128)) {
            $this->error['title'] = $this->language->get('error_title');
        }
        
        if ((utf8_strlen($this->request->post['filename']) < 3) || (utf8_strlen($this->request->post['filename']) > 128)) {
            $this->error['filename'] = $this->language->get('error_filename');
        }

        if (!is_file(DIR_DOWNLOAD . $this->request->post['filename'])) {
            $this->error['filename'] = $this->language->get('error_exists');
        }

        if ((utf8_strlen($this->request->post['mask']) < 3) || (utf8_strlen($this->request->post['mask']) > 128)) {
            $this->error['mask'] = $this->language->get('error_mask');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('delete', 'catalog/notice')) {
            $this->error['warning'] = $this->language->get('error_delete');
        }

        foreach ($this->request->post['selected'] as $notice_id) {
            if ($this->user->getId() == $notice_id) {
                $this->error['warning'] = $this->language->get('error_account');
            }
        }

        return !$this->error;
    }

    public function upload() {
        $this->load->language('catalog/notice');

        $json = array();

        // Check user has permission
        if (!$this->user->hasPermission('modify', 'catalog/notice')) {
            $json['error'] = $this->language->get('error_permission');
        }

        if (!$json) {
            if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
                // Sanitize the filename
                $filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));

                // Validate the filename length
                if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
                    $json['error'] = $this->language->get('error_filename');
                }

                // Allowed file extension types
                $allowed = array();

                $extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));

                $filetypes = explode("\n", $extension_allowed);

                foreach ($filetypes as $filetype) {
                    $allowed[] = trim($filetype);
                }

                if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
                    $json['error'] = $this->language->get('error_filetype');
                }

                // Allowed file mime types
                $allowed = array();

                $mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));

                $filetypes = explode("\n", $mime_allowed);

                foreach ($filetypes as $filetype) {
                    $allowed[] = trim($filetype);
                }

                if (!in_array($this->request->files['file']['type'], $allowed)) {
                    $json['error'] = $this->language->get('error_filetype');
                }

                // Check to see if any PHP files are trying to be uploaded
                $content = file_get_contents($this->request->files['file']['tmp_name']);

                if (preg_match('/\<\?php/i', $content)) {
                    $json['error'] = $this->language->get('error_filetype');
                }

                // Return any upload error
                if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
                    $json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
                }
            } else {
                $json['error'] = $this->language->get('error_upload');
            }
        }

        if (!$json) {
            $file = $filename;

            move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . $file);

            $json['filename'] = $file;
            $json['mask'] = $filename;

            $json['success'] = $this->language->get('text_upload');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

}
