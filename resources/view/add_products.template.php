<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Add Products
    </title>
</head>

<body>

    <h2>Add Products</h2>
    <a href="/">go back home</a>
    <ul>
        <?php foreach ($this->getProducts() as $product) : ?>
            <li><?php echo $product->getName() ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>