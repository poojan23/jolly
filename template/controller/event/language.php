<?php

class ControllerEventLanguage extends PT_Controller
{
    public function index(&$route, &$args, &$template)
    {
        foreach ($this->language->all() as $key => $value) {
            if (!isset($args[$key])) {
                $args[$key] = $value;
            }
        }
    }

    # 1. Before controller load store all current loaded language data
    public function before()
    {
        $this->language->set('backup', $this->language->all());
    }

    # 2. After controller load restore old language data
    public function after()
    {
        $data = $this->language->get('backup');

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $this->language->set($key, $value);
            }
        }
    }
}