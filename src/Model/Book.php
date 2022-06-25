<?php

namespace App\Model;

use App\Model\Base\Product;

class Book extends Product
{
    public function getAttribute()
    {
        return "Weight: $this->attribute KG";
    }
}
