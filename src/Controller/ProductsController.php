<?php

namespace App\Controller;

use App\Base\Request\Request;
use App\Model\Book;
use App\Model\Disc;
use App\Model\Furniture;
use App\Model\Products;

class ProductsController
{
    private Request $request;
    private $errorMessage = "";

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get_front()
    {
        $result = (new Products())->selectAll();
        return $this->render('front', ['result' => $result]);
    }

    public function get_add_product()
    {
        return $this->render('add_products');
    }

    public function store()
    {
        $productType = $this->request->get('type');
        $sku = $this->request->get('sku');       //isset($formData["sku"]) ? $formData["sku"] : "";
        $name = $this->request->get('name');     //isset($formData["name"]) ? $formData["name"] : "";
        $price = $this->request->get('price');   //isset($formData["price"]) ? $formData["price"] : "";
        $weight = $this->request->get('weight'); //isset($formData["weight"]) ? $formData["weight"] : "";
        $size = $this->request->get('size');     //isset($formData["size"]) ? $formData["size"] : "";
        $height = $this->request->get('height'); //isset($formData["height"]) ? $formData["height"] : "";
        $width = $this->request->get('width');   //isset($formData["width"]) ? $formData["width"] : "";
        $length = $this->request->get('length'); //isset($formData["length"]) ? $formData["length"] : "";


        // go ahead to save it

        return $this->get_front();
    }

    public function delete()
    {
        //
    }

    public function __toString()
    {
        return $this->render();
    }


    private function render($view = 'front.template.php', $args = [])
    {
        // make variables avaiable in class
        foreach ($args as $key => $value) {
            # code...
            $this->{$key} = $value;
        }

        ob_start();
        include('resources/view/' . $view . '.template.php'); // or wherever your template is located
        return ob_get_clean();
    }
}
