<?php

namespace common\sys\core\testimonials;

use common\sys\repository\testimonials\TestimonialsRepository;

class TestimonialsEditService
{
    private $testimonials_repo;
    private function get_testimonials_repo()
    {
        if($this->testimonials_repo != null)
            return $this->testimonials_repo;
        $this->testimonials_repo = new TestimonialsRepository();
        return $this->testimonials_repo;
    }

    public function add_item($params, $images)
    {
        return $this->get_testimonials_repo()->add_item($params, $images);
    }

    public function update_item($params, $images)
    {
        return $this->get_testimonials_repo()->update_item($params, $images);
    }

    public function delete_item($id)
    {
        return $this->get_testimonials_repo()->delete_item($id);
    }
}