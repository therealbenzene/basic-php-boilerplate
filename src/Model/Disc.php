<?php

namespace App\Model;

use App\Model\Base\Product;

class Disc extends Product
{
    public function getAttribute()
    {
        return  "Size: $this->attribute MB";
    }
}
