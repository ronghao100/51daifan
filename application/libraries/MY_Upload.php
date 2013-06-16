<?php
/**
 * Extended / Overloaded CI-Upload Class to handle Flash-Form-Uploaded Images via Application/octet-stream
 *
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Extends the CodeIgniter Upload-Class
 */
class MY_Upload extends CI_Upload
{
    // determines whether to use application/octet-stream for image-processing...
    public $is_flash_upload = FALSE;


    /**
     * Constructor
     *
     * @access    public
     */
    function MY_Upload($props = array())
    {
        if (count($props) > 0)
        {
            $this->initialize($props);
        }

        log_message('debug', 'MY_Upload Class Initialized');
    }
    //


    /**
     * initializes the upload-class by settings some properties given in a config-array as parameter
     *
     * there is only one change in this method:
     *   is_flash_upload
     * this property determines whether to handle a file uploaded by flash as application/octet-stream
     * as a image or not.
     */
    public function initialize($config = array())
    {
        $defaults = array(
            'max_size'            => 0,
            'max_width'            => 0,
            'max_height'        => 0,
            'allowed_types'        => "",
            'file_temp'            => "",
            'file_name'            => "",
            'orig_name'            => "",
            'file_type'            => "",
            'file_size'            => "",
            'file_ext'            => "",
            'upload_path'        => "",
            'overwrite'            => FALSE,
            'encrypt_name'        => FALSE,
            'is_image'            => FALSE,
            'image_width'        => '',
            'image_height'        => '',
            'image_type'        => '',
            'image_size_str'    => '',
            'error_msg'            => array(),
            'mimes'                => array(),
            'remove_spaces'        => TRUE,
            'xss_clean'            => FALSE,
            'temp_prefix'        => "temp_file_",
            'is_flash_upload'   => FALSE   // <------------------  this parameter is new!
        );

        foreach ($defaults as $key => $val)
        {
            if (isset($config[$key]))
            {
                $method = 'set_'.$key;
                if (method_exists($this, $method))
                {
                    $this->$method($config[$key]);
                }
                else
                {
                    $this->$key = $config[$key];
                }
            }
            else
            {
                $this->$key = $val;
            }
        }
    }
    //





    /**
     * when using a flash for file-uploads, the file is sent as application/octet-stream
     * and CI by default cannot determine whether the file really is a image.
     *
     * TODO: This function implements a new feature to determine whether the uploaded file
     * is a image by a simple header-check. this is enabled only when the class-property
     * is_flash_upload is set to TRUE (or 1).
     *
     */
    public function is_image()
    {

        if($this->is_flash_upload)
        {
            log_message('debug', 'MY_Upload->is_image(): Adding application/octet-stream as valid image-mime-type and doing some headerchecks to verify that.');

            // just added the ugly flash-mime type application/octet-stream to the array
            $png_mimes  = array('image/x-png', 'application/octet-stream');
            $jpeg_mimes = array('image/jpg', 'image/jpe', 'image/jpeg', 'image/pjpeg', 'application/octet-stream');
        }
        else
        {
            // IE will sometimes return odd mime-types during upload, so here we just standardize all
            // jpegs or pngs to the same file type.
            $png_mimes  = array('image/x-png');
            $jpeg_mimes = array('image/jpg', 'image/jpe', 'image/jpeg', 'image/pjpeg');
        }

        if (in_array($this->file_type, $png_mimes))
        {
            $this->file_type = 'image/png';
        }

        if (in_array($this->file_type, $jpeg_mimes))
        {
            $this->file_type = 'image/jpeg';
        }

        if($this->is_flash_upload)
        {
            $img_mimes = array(
                'image/gif',
                'image/jpeg',
                'image/png',
                'application/octet-stream'
            );
        }
        else
        {
            $img_mimes = array(
                'image/gif',
                'image/jpeg',
                'image/png',
            );
        }

        return (in_array($this->file_type, $img_mimes, TRUE)) ? TRUE : FALSE;
    }
    //

}
?>  