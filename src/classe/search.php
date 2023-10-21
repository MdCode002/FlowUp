<?php
namespace App\classe;
use App\Entity\Category;

class search
{
    /** 
     * @var  string
     */
    public $string = "";
    /** 
     * @var  Category
     */
    public $categories = [];

    public function __toString()
    {
        return $this->string;
    }
} 