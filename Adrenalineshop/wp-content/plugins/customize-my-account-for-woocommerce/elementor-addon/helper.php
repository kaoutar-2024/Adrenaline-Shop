<?php 
namespace Elementor;

if (!function_exists('wxmtx_category_elementor_init')) {

function wxmtx_category_elementor_init(){
    Plugin::instance()->elements_manager->add_category(
        'customize-my-account',
        [
            'title'  => 'SysBasics Customize My Account',
            'icon' => 'eicon-my-account'
        ],
        1
    );
}
}
add_action('elementor/init', 'Elementor\wxmtx_category_elementor_init');