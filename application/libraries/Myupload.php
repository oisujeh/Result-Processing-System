<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Myupload {

    public function uploadFile($field, $folder, $newname) {
//        print_r($field);
        $new_file = $field['file'];

        $CI =& get_instance();

        //$config['upload_path'] = './public/uploads/' . $folder . '/';
        $config['upload_path'] = FCPATH . $folder;

        $config['allowed_types'] = 'png|gif|jpg|jpeg';

        $config['max_size'] = '100000';

        $config['max_width'] = '100000';

        $config['max_height'] = '100000';

        $CI->load->library('upload', $config);
        $CI->load->library('image_lib');
        $CI->upload->initialize($config);

        $no = count($new_file['name'])-1; 
        $file= $_FILES;
        for ($i=0; $i < $no ; $i++)
        {
            // echo $file['files']['name'][$i]; exit;
            $_FILES['file']['name']=$file['file']['name'][$i];
            $_FILES['file']['type']= $file['file']['type'][$i];
            $_FILES['file']['tmp_name']= $file['file']['tmp_name'][$i];
            $_FILES['file']['error']= $file['file']['error'][$i];
            $_FILES['file']['size']= $file['file']['size'][$i];
            if ($CI->upload->do_upload('file', $newname.'_'.$i))
            {
                $other_images = $CI->upload->data();
                $othimage[] = $other_images['file_name'];
                // print_r($other_images);exit;
                //image resize
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $other_images['file_path'].$other_images['raw_name'].$other_images['file_ext'];
                        $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width']     = 800;
                        $config['height']   = 600;

                        $CI->image_lib->clear();
                        $CI->image_lib->initialize($config);
                        $CI->image_lib->resize();
                        //image resize end

            }else{
                $error = array('error' => $CI->upload->display_errors());
                print_r($error); exit;
            }
        }
    return $othimage;
    }

}

/* End of file Myupload.php */