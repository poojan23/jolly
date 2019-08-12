<?php

class ControllerCommonNav extends PT_Controller
{
    public function index()
    {
        $this->load->language('common/nav');

        $data['name'] = $this->config->get('config_name');

        if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
            $data['logo'] = $this->config->get('config_url') . 'image/' . $this->config->get('config_logo');
        } else {
            $data['logo'] = '';
        }

        //page link
        $data['home'] = $this->url->link('common/home');
        
        // about menu page
        $data['profile'] = $this->url->link('information/about/profile');
        $data['vision_mission'] = $this->url->link('information/about/vision_mission');
        $data['office_bearers'] = $this->url->link('information/about/office_bearers');
        $data['board_of_trustees'] = $this->url->link('information/about/board_of_trustees');
        $data['managing_committee'] = $this->url->link('information/about/managing_committee');
        $data['staff'] = $this->url->link('information/about/staff');
        $data['staff'] = $this->url->link('information/about/staff');
        
        //membership menu page
        $data['definition'] = $this->url->link('information/membership/definition');
        $data['transfer_withdrawal'] = $this->url->link('information/membership/transfer_withdrawal');
        $data['enlistment_of_Members'] = $this->url->link('information/membership/enlistment_of_Members');
        $data['membership_fees'] = $this->url->link('information/membership/membership_fees');
        $data['membership_sub_committee'] = $this->url->link('information/membership/membership_sub_committee');
        
        //Sports menu page
        $data['badminton'] = $this->url->link('information/sports/badminton');
        $data['long_tennis_skating_volley_ball'] = $this->url->link('information/sports/long_tennis_skating_volley_ball');
        $data['squash'] = $this->url->link('information/sports/squash');
        $data['billiards'] = $this->url->link('information/sports/billiards');
        $data['table_tennis'] = $this->url->link('information/sports/table_tennis');
        $data['chess_carrom'] = $this->url->link('information/sports/chess_carrom');
        $data['cricket'] = $this->url->link('information/sports/cricket');
        
        //Activites menu page
        $data['swimming_pool'] = $this->url->link('information/activites/swimming_pool');
        $data['health_club'] = $this->url->link('information/activites/health_club');
        $data['gymnasium'] = $this->url->link('information/activites/gymnasium');
        $data['yoga'] = $this->url->link('information/activites/yoga');
        $data['marathon_fitness_training'] = $this->url->link('information/activites/marathon_fitness_training');
        $data['ex_youth_wing'] = $this->url->link('information/activites/ex_youth_wing');

        //Facilities menu page
        $data['restaurant_bar_fast_food'] = $this->url->link('information/facilities/restaurant_bar_fast_food');
        $data['card_room'] = $this->url->link('information/facilities/card_room');
        $data['bulletin_website_affiliation_sub_committee'] = $this->url->link('information/about/bulletin_website_affiliation_sub_committee');
      
        //Venues &amp; Guest room menu page
        $data['jasmine_basement_banquet_hall'] = $this->url->link('information/venues/jasmine_basement_banquet_hall');
        $data['lilac_banquet_hall'] = $this->url->link('information/venues/lilac_banquet_hall');
        $data['terrace_1st_floor'] = $this->url->link('information/venues/terrace_1st_floor');
        $data['lantana_banquet_hall'] = $this->url->link('information/venues/lantana_banquet_hall');
        $data['olive_party_hall'] = $this->url->link('information/venues/olive_party_hall');
        $data['members_guest_room'] = $this->url->link('information/venues/members_guest_room');
        $data['caterers_decorators'] = $this->url->link('information/venues/caterers_decorators');
        $data['venue_sub_committee'] = $this->url->link('information/venues/venue_sub_committee');
        
        //Events menu page
        $data['cultural_events'] = $this->url->link('information/events/cultural_events');
        $data['education_events'] = $this->url->link('information/events/education_events');
        $data['entertainment_events'] = $this->url->link('information/events/entertainment_events');
        $data['sports_events'] = $this->url->link('information/events/sports_events');
        
        $data['gallery'] = $this->url->link('information/gallery');
        $data['media'] = $this->url->link('information/media');
        $data['contact'] = $this->url->link('information/contact');
        
        $data['admin'] = HTTP_SERVER.'admin';
        # information
        $this->load->model('information/information_group');
        $this->load->model('information/information');

        $data['information'] = array();

        $information = $this->model_information_information_group->getInformationGroups();
        
        foreach ($information as $info){
        
            $children_data = array();
            
            $children = $this->model_information_information->getInformationsByGroupId($info['information_group_id']);
        
            foreach ($children as $child) {
                $children_data[] = array(
                    'title'         => $child['title'],
                    'description'   => $child['description'],
                    'href'          => $this->url->link('information/information', 'path=' . $info['information_group_id'] . '_' . $child['information_id'])
                );
            }
            
            $data['information'][] = array(
                    'name'         => $info['group_name'],
                    'children'     => $children_data,
                    'href'         => $this->url->link('information/information', 'path=' . $info['information_group_id'])
                );
        }

        return $this->load->view('common/nav', $data);
    }
}