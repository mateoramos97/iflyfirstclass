<?php

namespace frontend\modules\imagemanager;

use yii\helpers\Url;

class FileUploaderHandler {

    public $allowedExtensions = array();
    public $sizeLimit = null;
    public $inputName = 'qqfile';

    protected $uploadName;

    function __construct()
    {
        $this->sizeLimit = $this->toBytes(ini_get('upload_max_filesize'));
    }

    /**
     * Get the original filename
     */
    public function getName()
    {
        if(isset($_REQUEST['qqfilename'])) {
            return $_REQUEST['qqfilename'];
        }
        if(isset($_FILES[$this->inputName])) {
            return $_FILES[$this->inputName]['name'];
        }
    }

    /**
     * Get the extension of the uploaded file
     */
    public function getExtension()
    {
        if ( ! isset($_FILES[$this->inputName]))
            return null;

        $pathinfo = pathinfo($this->getName());
        $ext = isset($pathinfo['extension']) ? $pathinfo['extension'] : null;

        return $ext;
    }

    /**
     * Get the path of the uploaded file
     */
    public function getFileFromTempDirectory()
    {
        if (isset($_FILES[$this->inputName]))
            return $_FILES[$this->inputName]['tmp_name'];
        return null;
    }

    /**
     * Get the name of the uploaded file
     */
    public function getUploadName()
    {
        return $this->uploadName;
    }

    /**
     * Validate the uploaded file
     */
    public function validate()
    {
        $resp = array(
            'success' => FALSE,
        );

        // Check that the max upload size specified in class configuration does not
        // exceed size allowed by server config
        if ($this->toBytes(ini_get('post_max_size')) < $this->sizeLimit ||
            $this->toBytes(ini_get('upload_max_filesize')) < $this->sizeLimit)
        {
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            $resp['error'] = "Server error. Increase post_max_size and upload_max_filesize to ".$size;
            return $resp;
        }

        if(!isset($_SERVER['CONTENT_TYPE']))
        {
            $resp['error'] = 'No files were uploaded.';
            return $resp;
        } else if (strpos(strtolower($_SERVER['CONTENT_TYPE']), 'multipart/') !== 0)
        {
            $resp['error'] = 'Server error. Not a multipart request. Please set forceMultipart to default value (true).';
            return $resp;
        }

        // Get size and name
        $file = $_FILES[$this->inputName];
        $size = $file['size'];

        $uploadedName = $this->getName();

        // Validate name
        if ($uploadedName === null || $uploadedName === '')
        {
            $resp['error'] = 'File name empty.';
            return $resp;
        }

        // Validate file size
        if ($size == 0)
        {
            $resp['error'] = 'File is empty.';
            return $resp;
        }

        if ($size > $this->sizeLimit)
        {
            $resp['error'] = 'File is too large.';
            return $resp;
        }

        // Validate file extension
        $pathinfo = pathinfo($uploadedName);
        $ext = isset($pathinfo['extension']) ? $pathinfo['extension'] : '';

        if($this->allowedExtensions && !in_array(strtolower($ext), array_map("strtolower", $this->allowedExtensions)))
        {
            $these = implode(', ', $this->allowedExtensions);
            $resp['error'] = 'File has an invalid extension, it should be one of '. $these . '.';
            return $resp;
        }

        $resp['success'] = TRUE;
        return $resp;
    }

    /**
     * Process the upload.
     * @param string $uploadDirectory Target directory.
     * @param string $name Overwrites the name of the file.
     */
    public function handleUpload($uploadDirectory, $name = null)
    {
        $resp = array(
            'success' => FALSE,
        );

        if ($this->isInaccessible($uploadDirectory))
        {
            $resp['error'] = "Server error. Uploads directory isn't writable.";
            return $resp;
        }

        // Get size and name
        $file = $_FILES[$this->inputName];

        $uploadedName = $this->getName();

        // Validate file extension
        $pathinfo = pathinfo($uploadedName);
        $ext = isset($pathinfo['extension']) ? $pathinfo['extension'] : '';

        if ($name === null){
            $name = $pathinfo['filename'];
        }

        # non-chunked upload

        $target = join(DIRECTORY_SEPARATOR, array($uploadDirectory, $name .'.'. $ext));

        if ($target)
        {
            $this->uploadName = basename($target);

            if (!is_dir(dirname($target)))
            {
                mkdir(dirname($target));
            }
            if (move_uploaded_file($file['tmp_name'], $target))
            {
                $resp['success'] = TRUE;
                $this->thumb_img_add($name .'.'. $ext);
                return $resp;
            }
        }

        $resp['error'] = 'Could not save uploaded file.' .
            'The upload was cancelled, or server error encountered';

        return $resp;
    }

    private function thumb_img_add($alias)
    {
        $thumb_directory = \Yii::$app->params['docRoot']. "/web/public/images/thumbs/";
        $orig_directory = \Yii::$app->params['docRoot']. "/web/public/images/";

        //var $simg = null;

        $allowed_types=array('jpg','jpeg','gif','png'); // Список обрабатываемых расширений
        $file_parts=array();
        $ext='';
        $title='';

        $file = $alias;
        $file_parts = explode('.',$file);       //Разделяем имя файла на части
        $ext = strtolower(array_pop($file_parts));

        $title = implode('.',$file_parts);
        $title = htmlspecialchars($title);

        if(in_array($ext,$allowed_types))
        {
            $source = $orig_directory . $alias;
            $stype = explode(".", $source);
            $stype = $stype[count($stype)-1];
            $dest = $thumb_directory . $file;

            $size = getimagesize($source);

            $w = $size[0];
            $h = $size[1];

            if ($h <= $w) {
                if ($w >= 3000 && $h >= 3000) {
                    $nw = $size[0] / 10;
                    $nh = $size[1] / 10;
                }
                elseif ($w >= 3000 && $h >= 2000) {
                    $nw = $size[0] / 9;
                    $nh = $size[1] / 9;
                }
                elseif ($w >= 1400 && $h >= 1000) {
                    $nw = $size[0] / 3;
                    $nh = $size[1] / 3;
                }
                elseif ($w > 2000 && $h > 1500) {
                    $nw = $size[0] / 4;
                    $nh = $size[1] / 4;
                }
                else {
                    $nw = $size[0] / 2;
                    $nh = $size[1] / 2;
                }

            }
            elseif ($h > $w) {
                if ($w >= 3000 && $h >= 3000) {
                    $nw = $size[0] / 10;
                    $nh = $size[1] / 10;
                }
                elseif ($w >= 2000 && $h >= 3000) {
                    $nw = $size[0] / 9;
                    $nh = $size[1] / 9;
                }
                elseif ($w >= 1400 && $h >= 1000) {
                    $nw = $size[0] / 3;
                    $nh = $size[1] / 3;
                }
                elseif ($w > 2000 && $h > 1500) {
                    $nw = $size[0] / 4;
                    $nh = $size[1] / 4;
                }
                else {
                    $nw = $size[0] / 2;
                    $nh = $size[1] / 2;
                }
            }
            elseif ($w <= 300) {
                $nw = $size[0];
                $nh = $size[1];
            }
            else {
                $nw = 150;
                $nh = 200;
            }


            switch($stype) {
                case 'jpe':
                case 'jpeg':
                case 'JPG':
                case 'jpg':
                    $simg = imagecreatefromjpeg($source);
                    break;
                case 'gif':
                    $simg = imagecreatefromgif($source);
                    break;
                case 'PNG':
                case 'png':
                    $simg = imagecreatefrompng($source);
                    break;
            }

            $nw = (int)($nw);
            $nh = (int)($nh);

            $dimg = imagecreatetruecolor($nw, $nh);
            $black = imagecolorallocate($dimg, 0, 0, 0);

            if($stype == "gif" or $stype == "png" or $stype == 'PNG'){
                imagecolortransparent($dimg, imagecolorallocatealpha($dimg, 0, 0, 0, 127));
                imagealphablending($dimg, false);
                imagesavealpha($dimg, true);
            }

            $wm = (int)($w/$nw);
            $hm = (int)($h/$nh);
            $h_height = (int)($nh/2);
            $w_height = (int)($nw/2);

            if($w> $h) {
                $adjusted_width = (int)($w / $hm);
                $half_width = (int)($adjusted_width / 2);
                $int_width = (int)($half_width - $w_height);
                imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
            } elseif(($w <$h) || ($w == $h)) {
                $adjusted_height = (int)($h / $wm);
                $half_height = (int)($adjusted_height / 2);
                $int_height = (int)($half_height - $h_height);

                imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
            } else {
                imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
            }
            switch($stype){
                case 'jpe':
                case 'jpeg':
                case 'JPG':
                case 'jpg':
                    imagejpeg($dimg, $dest, 100);
                    break;
                case 'gif':
                    imagegif($dimg, $dest);
                    break;
                case 'PNG':
                case 'png':
                    imagepng($dimg, $dest);
                    break;
            }
        }
    }

    /**
     * Converts a given size with units to bytes.
     * @param string $str
     */
    protected function toBytes($str){
        // $val = trim($str);
        // $last = strtolower($str[strlen($str)-1]);
        // switch($last) {
        //     case 'g': $val = $val * 1024;
        //     case 'm': $val = $val * 1024;
        //     case 'k': $val = $val * 1024;
        // }
        // return $val;
        return preg_replace_callback('/^\s*(\d+)\s*(?:([kmgt]?)b?)?\s*$/i', function ($m) {
            switch (strtolower($m[2])) {
              case 't': $m[1] *= 1024;
              case 'g': $m[1] *= 1024;
              case 'm': $m[1] *= 1024;
              case 'k': $m[1] *= 1024;
            }
            return $m[1];
        }, $str);
    }

    /**
     * Determines whether a directory can be accessed.
     *
     * is_writable() is not reliable on Windows
     *  (http://www.php.net/manual/en/function.is-executable.php#111146)
     * The following tests if the current OS is Windows and if so, merely
     * checks if the folder is writable;
     * otherwise, it checks additionally for executable status (like before).
     *
     * @param string $directory The target directory to test access
     */
    protected function isInaccessible($directory) {
        $isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
        $folderInaccessible = ($isWin) ? !is_writable($directory) : ( !is_writable($directory) && !is_executable($directory) );
        return $folderInaccessible;
    }

}