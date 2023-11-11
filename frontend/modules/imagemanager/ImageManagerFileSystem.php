<?php

namespace frontend\modules\imagemanager;

use yii\helpers\Url;

class ImageManagerFileSystem {

    private $_path;
    private $_file;
    private $_alias_to_remove;
    private $_alias_to_rotate;

    private $_image_alias;


    public function __construct($path, $file = FALSE, $alias_to_remove = FALSE, $alias_to_rotate = FALSE)
    {
        $this->_path = $path;
        $this->_alias_to_remove = $alias_to_remove;
        $this->_alias_to_rotate = $alias_to_rotate;
        $this->_file = $file;

        if ($this->_file !== FALSE)
        {
            //$this->_image_alias = Utils::generate_GUID();
            $this->_image_alias = uniqid();
        }
    }

    public static function to_add($path, $file)
    {
        return new self($path, $file, FALSE, FALSE);
    }

    public static function to_delete($path, $alias_to_remove)
    {
        return new self($path, FALSE, $alias_to_remove, FALSE);
    }

    public static function to_replace($path, $file, $alias_to_remove)
    {
        return new self($path, $file, $alias_to_remove, FALSE);
    }

    public static function to_rotate($path, $alias_to_rotate)
    {
        return new self($path, FALSE, FALSE, $alias_to_rotate);
    }

    public function save()
    {
        if ($this->_file)
        {
            $uploader = new FileUploaderHandler();

            // Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
            $uploader->allowedExtensions = array("jpeg", "jpg", "bmp", "png"); // all files types allowed by default

            // Specify max file size in bytes.
            $uploader->sizeLimit = 2 * 1024 * 1024; // default is 2 MiB (now 50 MiB)

            // Specify the input name set in the javascript.
            $uploader->inputName = "upload_file"; // matches Fine Uploader's default inputName value by default

            $method = $_SERVER["REQUEST_METHOD"];
            if ($method == "POST") {
                header("Content-Type: text/plain");

                $validation = $uploader->validate();

                if ( ! $validation['success'])
                {
                    return $validation;
                }

                // Call handleUpload() with the name of the folder, relative to PHP's getcwd()
                $result = $uploader->handleUpload($this->_path, $this->_image_alias);

                // To return a name used for uploaded file you can use the following line.
                $result["upload_name"] = $uploader->getUploadName();


                /*if ($result['success'] == true)
                    return $result["uploadName"];*/


                return $result;
            }
            else {
                header("HTTP/1.0 405 Method Not Allowed");
            }
        }
        return array('success' => FALSE, 'error' => 'Server error. File not exists.');
    }

    public function remove_old_thumb_img($alias)
    {
        $thumb_directory = \Yii::$app->params['docRoot']. "/web/public/images/thumbs/";
        $link = $thumb_directory . $alias;
        if (file_exists(realpath($link))) {
            unlink($link);
        }
    }

    public function remove_old_image()
    {
        if ($this->_alias_to_remove)
        {
            $link = $this->_path . $this->_alias_to_remove;
            if (file_exists(realpath($link))) {
                unlink($link);
            }
            $this->remove_old_thumb_img($this->_alias_to_remove);
        }
    }

    public function remove_images($aliases)
    {
        foreach ($aliases as $alias)
        {
            $link = $this->_path . $alias;
            if (file_exists(realpath($link))) {
                unlink($link);
            }
        }
    }

    private function rotate_thumb_img($alias)
    {
        /*ini_set('max_execution_time', 1000);
        ini_set('memory_limit', '-1');*/
        $thumb_directory =  \Yii::$app->params['docRoot']. "/web/public/images/thumbs/";
        $link = $thumb_directory . $alias;
        if (file_exists(realpath($link))) {
            $source = imagecreatefromstring(file_get_contents($link));
            $rotate = imagerotate($source, -90, 0);
            imagejpeg($rotate, realpath($link));
            imagedestroy($source);
            imagedestroy($rotate);
        }
    }

    public function rotate_image()
    {
        /*ini_set('max_execution_time', 1000);
        ini_set('memory_limit', '-1');*/
        if ($this->_alias_to_rotate)
        {
            $link = $this->_path . $this->_alias_to_rotate;
            if (file_exists(realpath($link))) {
                $source = imagecreatefromstring(file_get_contents($link));
                $rotate = imagerotate($source, -90, 0);
                imagejpeg($rotate, realpath($link));
                imagedestroy($source);
                imagedestroy($rotate);
                $this->rotate_thumb_img($this->_alias_to_rotate);
                //$this->thumb_img_add($this->_alias_to_rotate);
            }
        }
    }

}