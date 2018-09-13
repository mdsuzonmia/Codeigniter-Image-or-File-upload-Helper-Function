<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Controllers extends CI_Controller
{
    
    /**
    ** Apply Function
    **/
    function apply()
    {
        // Get param data
        $params = $this->input->post('param');
        
        // get config file array from helper function
        $config_file = getConfigData('file');
        foreach ($config_file as $key => $config_file_item) {
            $config_field     = $config_file_item[0];
            $config_old_field = $config_file_item[1];
            $config_label     = $config_file_item[2];
            $config_path      = $config_file_item[3];
            $config_default   = $config_file_item[4];

            // Get upload and set param
            $old_file = $this->input->post($config_old_field);
            $new_file = $_FILES[$config_field]['name'];
            $uploaded_file = uploadImage($new_file, $old_file, $config_field, './uploads/logo/', 'gif|jpg|png', '', '', '');
            $params[$config_field][] = $uploaded_file;
        }
        
        $params_data = json_encode($params);

        $data = array(
            'param_data'=> $params_data
        );  
            
    }
    
}

?>