<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



/**
** Function for upload image or files
** @param {string} $new_file : This is main image or file come from file field.
** @param {string} $old_file : This is exit image or file name.
** @param {string} $field : This is field name for upload.
** @param {string} $path : This is image destination path.
** @param {string} $type : This is image type (jpg, png etc).
** @param {string} $max_size : This is for set image max size.
** @param {string} $max_width : This is for set image max width.
** @param {string} $max_height : This is for set image max height.
**/
function uploadImage($new_file, $old_file, $field, $path, $type, $max_size, $max_width, $max_height){
    $config['upload_path']          = $path;
    $config['allowed_types']        = $type;
    if(!empty($max_size)){ $config['max_size'] = $max_size; }
    if(!empty($max_width)){ $config['max_width'] = $max_width; }
    if(!empty($max_height)){ $config['max_height'] = $max_height; }
    
    // load upload library
    $CI =& get_instance();
    $CI->load->library('upload', $config);
    
    // check new file is exit
    if(!empty($new_file)){

        // get delete old file if exit
        if(!empty($old_file)){
            $delete_file = $path.$old_file;
            unlink($delete_file);
        }

        // get upload
        if ( ! $CI->upload->do_upload($field)){
            $CI->session->set_flashdata('error', $CI->upload->display_errors());
        }else{
            $file_data = $CI->upload->data();
            $file = $file_data['file_name'];
        }
    }else{
        // Set old file if new file not choose.
        $file = $old_file;
    }

    return  $file;
}


?>