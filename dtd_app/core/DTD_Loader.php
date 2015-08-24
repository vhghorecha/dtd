<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DTD_Loader extends CI_Loader {
    
	public function template($template_name, $vars = array(), $return = FALSE)
    {
		define("BASE_URL", base_url());
		define("RES_URL", base_url() . "dtd_asset/");
		$router =& load_class('Router', 'core');
		$CI =& get_instance();
		$vars['user_info'] = $CI->session->userdata('userinfo');
		$vars['current_page'] = $router->fetch_class();
		$vars['current_action'] = $router->fetch_method();
        if($return):
			$content  = $this->view('header', $vars, $return);
			$content  = $this->view('nav', $vars, $return);
			$content .= $this->view($template_name, $vars, $return);
			$content .= $this->view('footer', $vars, $return);
			return $content;
		else:
			$this->view('header', $vars);
			$this->view('nav', $vars);
			$this->view($template_name, $vars);
			$this->view('footer', $vars);
		endif;
    }
}
?>