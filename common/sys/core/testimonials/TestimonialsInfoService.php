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
        $reviews = $this->get_testimonials_repo()->get_testimonials_is_top($count);

        foreach($reviews as $index => &$review) {
            $review['initials'] = self::getInitials($review['author']);
            if (($index+1) % 3 === 0) {
                $color = '#475871';
            } elseif (($index+1) % 2=== 0) {
                $color = '#4F724A';
            } else {
                $color = '#796D5E';
            }

            $review['initials-color'] = $color;
        }

        return $reviews;
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

    public static function getInitials(string $string): string
    {
        $ret = '';
        foreach (explode(' ', $string) as $word)
            $ret .= strtoupper($word[0]);
        return $ret;
    }
}