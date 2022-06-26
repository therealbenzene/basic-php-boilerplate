<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <h2><?= $this->title ?></h2>
    <ul>
        <li><a href="/add-product">add products</a></li>
    </ul>
    <ul>
        <?php foreach ($this->result as $product) : ?>
            <li><?= $product->getName() ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>