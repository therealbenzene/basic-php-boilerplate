<?php

namespace App\Model;

use App\Model\Base\Product;

class Furniture extends Product
{
    public function getAttribute()
    {
        return  "Dimension: $this->attribute";
    }
}
