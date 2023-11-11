<?php

namespace frontend\modules\imagemanager;

class ImageManager {

    const EVENT_TYPE_ADD = 1;
    const EVENT_TYPE_DELETE = 2;
    const EVENT_TYPE_REPLACE = 3;
    const EVENT_TYPE_ROTATE = 4;

    private static $_form_view = 'form';

    private $_im_fs;
    private $_im_model;

    private $_content_id;
    private $_content_type_id;
    private $_content_field_id;
    private $_alias_to_remove;
    private $_alias_to_rotate;
    private $_file;
    private $_images_path;
    private $_new_file_alias;
    private $_event_type;
    private $_is_update_repo;
    private $_default_queue;

    public function __construct($image_data, $images_path)
    {
        $this->_content_id = $image_data['content_id'];
        $this->_content_type_id = $image_data['content_type_id'];
        $this->_content_field_id = $image_data['content_field_id'];
        $this->_alias_to_remove = $image_data['alias_to_remove'];
        $this->_alias_to_rotate = $image_data['alias_to_rotate'];
        $this->_file = $image_data['file'];
        $this->_images_path = $images_path;
        $this->_im_model = new \app\modules\imagemanager\models\Image();
        $this->_new_file_alias = "";
        $this->_default_queue = 999;
        $this->_event_type = FALSE;

        if ($this->_alias_to_rotate !== FALSE) {
            $this->_event_type = ImageManager::EVENT_TYPE_ROTATE;
        }
        if ($this->_file !== FALSE && $this->_alias_to_remove !== FALSE)
        {
            $this->_event_type = ImageManager::EVENT_TYPE_REPLACE;
        }
        elseif ($this->_file !== FALSE)
        {
            $this->_event_type = ImageManager::EVENT_TYPE_ADD;
        }
        elseif ($this->_alias_to_remove !== FALSE)
        {
            $this->_event_type = ImageManager::EVENT_TYPE_DELETE;
        }
        $this->_is_update_repo = $this->_content_id !== FALSE && $this->_content_field_id !== FALSE ? TRUE : FALSE;
    }

    public function get_event_type()
    {
        $arr = array('event' => $this->_event_type);
        switch ($this->_event_type)
        {
            case ImageManager::EVENT_TYPE_ADD:
                $arr['fs'] = ImageManagerFileSystem::to_add($this->_images_path, $this->_file);
                break;
            case ImageManager::EVENT_TYPE_DELETE:
                $arr['fs'] = ImageManagerFileSystem::to_delete($this->_images_path, $this->_alias_to_remove);
                break;
            case ImageManager::EVENT_TYPE_REPLACE:
                $arr['fs'] = ImageManagerFileSystem::to_replace($this->_images_path, $this->_file, $this->_alias_to_remove);
                break;
            case ImageManager::EVENT_TYPE_ROTATE:
                $arr['fs'] = ImageManagerFileSystem::to_rotate($this->_images_path, $this->_alias_to_rotate);
                break;
            default:
        }
        return $arr;
    }

    public function update_repo($new_alias = '')
    {
        $this->_new_file_alias = $new_alias;

        if (!$this->_is_update_repo)
            return;

        switch ($this->_event_type)
        {
            case ImageManager::EVENT_TYPE_REPLACE:
                $old_data = $this->_im_model->get_image_by_alias($this->_content_id, $this->_content_type_id,
                    $this->_content_field_id, $this->_alias_to_remove);
                $queue = $this->_default_queue;
                if ($old_data)
                {
                    $queue = $old_data['queue'];
                }
                $this->add_repo($queue);
                $this->delete_repo();
                break;
            case ImageManager::EVENT_TYPE_ADD:
                $this->add_repo($this->_default_queue);
                break;
            case ImageManager::EVENT_TYPE_DELETE:
                $this->delete_repo();
                break;
            default:
                break;
        }
        $this->_im_model->update_order($this->_content_id, $this->_content_type_id, $this->_content_field_id);
    }

    public function get_response($fs_resp = NULL)
    {
        if ($fs_resp !== NULL && ! $fs_resp['success'])
            return json_encode($fs_resp);

        $arr = array('success' => FALSE, 'new_file_alias' => NULL);
        if ($this->_event_type !== FALSE)
        {
            $arr['success'] = TRUE;
            $arr['new_file_alias'] = $this->_new_file_alias;
        }
        else
        {
            $arr['error'] = 'Server error. Event type does not exist.';
        }
        return json_encode($arr);
    }

    private function add_repo($queue)
    {
        $this->_im_model->add_image($this->_content_id, $this->_content_type_id, $this->_content_field_id,
            $this->_new_file_alias, $queue, "");
    }

    private function delete_repo()
    {
        $this->_im_model->delete_image($this->_content_id, $this->_content_type_id,
            $this->_content_field_id, $this->_alias_to_remove);
    }

    /**
     * Renders the form.
     *
     * @param   array   config: "path":"<?php echo URL::base(); ?>public/images/",
     *							"model_prefix":"image",
     *							"route":"<?php echo URL::site('model') ?>",
     *							"enable_replace_button":false,
     *							"enable_delete_button":true,
     *							"enable_add_button":true,
     *							"enable_title":false,
     *							"content_id":5,
     *							"content_field_id":1
     *					images:	array
     *								alias
     *								title
     *								queue
     * @return  string  form output (HTML)
     */



}