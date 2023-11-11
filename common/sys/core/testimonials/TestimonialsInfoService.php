<?php

namespace common\sys\core\testimonials;

use common\sys\repository\testimonials\TestimonialsRepository;

class TestimonialsInfoService
{
    private $testimonials_repo;
    private function get_testimonials_repo()
    {
        if($this->testimonials_repo != null)
            return $this->testimonials_repo;
        $this->testimonials_repo = new TestimonialsRepository();
        return $this->testimonials_repo;
    }

    public function get_testimonials_is_top($count)
    {
        return $this->get_testimonials_repo()->get_testimonials_is_top($count);
    }

    public function get_testimonials_by_id($id)
    {
        return $this->get_testimonials_repo()->get_testimonials_by_id($id);
    }

    public function get_testimonials_images($content_id)
    {
        return $this->get_testimonials_repo()->get_testimonials_images($content_id);
    }

    public function TestimonialsDataProvider($params)
    {
        return $this->get_testimonials_repo()->TestimonialsDataProvider($params);
    }
}