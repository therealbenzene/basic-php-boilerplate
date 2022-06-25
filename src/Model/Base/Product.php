<?php

namespace App\Model\Base;

use App\Base\Database\Database;
use Exception;

// new Product()
abstract class Product extends Database
{
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $attribute;

    public function __construct(
        string $sku   = '',
        string $name  = '',
        string $price = '',
        string $type  = '',
        string $attribute = ''
    ) {

        parent::__construct();

        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->attribute = $attribute;
    }

    public function getSKU()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getType()
    {
        return $this->type;
    }

    abstract public function getAttribute();

    public function setSKU($sku)
    {
        $this->sku = $sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    public function selectAll()
    {

        $products_array = [];

        $query = "SELECT * FROM products";
        $all_products = $this->getConnection()->query($query);

        while ($products = $all_products->fetch_assoc()) {

            $class = '\\App\Model\\' . ucwords($products['type']);

            $products_array[] = new $class(
                $products['sku'],
                $products['name'],
                $products['price'],
                $products['type'],
                $products['attribute']
            );
        }

        $this->getConnection()->close();

        return $products_array;
    }

    public function selectOne($sku)
    {
        if (!$sku) {
            # code...
            throw new Exception("sku was not found", 2);
        }

        $query = "SELECT * FROM products WHERE sku = ?";
        $single_product = $this->getConnection()->prepare($query);
        $single_product->bind_param("s", $sku);
        $single_product->execute();

        $single_product->bind_result($out_id, $out_label);
        $product = null;

        if ($single_product->num_rows > 0) {
            # code...

            $product = $single_product->get_result()->fetch_assoc();

            $class = '\\App\Model\\' . ucwords($product['type']);
        }

        $this->getConnection()->close();

        return new $class(
            $product[0]['sku'],
            $product[0]['name'],
            $product[0]['price'],
            $product[0]['type'],
            $product[0]['attribute']
        );
    }

    public function deleteSelected($ids)
    {

        if (empty($ids)) {
            // throw exception if variable ids is empty
            throw new Exception("no ids supplied for deletion", 3);
        }

        $param = '(';
        $count_ids = count($ids);

        foreach ($ids as $index => $sku) {

            $index = $index + 1;

            $param .= "'$sku'";

            $param .= $index != $count_ids ? ',' : '';
        }

        $param .= ")";

        $query = "DELETE FROM products WHERE sku IN " . $param;

        $delete_selected = $this->getConnection()->query($query);

        if ($delete_selected === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $this->getConnection()->error;
        }

        $this->getConnection()->close();
    }

    public function save(): bool
    {

        if (!$this->sku)
            throw new Exception("sku was not set");

        if (!$this->name)
            throw new Exception("name was not set");

        if (!$this->price)
            throw new Exception("price was not set");

        if (!$this->type)
            throw new Exception("type was not set");

        if (!$this->attribute)
            throw new Exception("attribute was not set");


        $query = "INSERT INTO products (sku, name, price, type, attribute)
                  VALUES ('$this->sku', '$this->name', '$this->price', '$this->type', '$this->attribute')";

        $insert_product = $this->getConnection()->query($query);

        if ($insert_product === TRUE) {
            return true;
        } else {
            echo "Error deleting record: " . $this->getConnection()->error;
        }
    }
}
