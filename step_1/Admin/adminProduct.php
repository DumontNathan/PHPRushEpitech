<?php

class Product
{
    private $name;
    private $price;
    private $id;

    public function __construct($produit = null)
    {
        $this->name = $produit['name'] ? $produit['name'] : null;
        $this->price = $produit['price'] ? $produit['price'] : null;
        $this->id = $produit['id'] ? $produit['id'] : null;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($newName)
    {
        $this->name = $newName;
    }

    public function setPrice($newPrice)
    {
        $this->price = $newPrice;
    }

}

class Model
{
    public function __construct(){}

    public function addProduct($product)
    {
        $name = $product->getName();
        $price = $product->getPrice();
        if($this->nameExists($name))
            echo "This product already exists.";
        else
        {
            $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
            $sql = "INSERT INTO products(name, price) VALUES(:name, :price)";
            $sth = $conn->prepare($sql);
            $sth->bindParam(':name', $name, PDO::PARAM_STR);
            $sth->bindParam(':price', $price, PDO::PARAM_INT);
            $sth->execute();
            echo "Product added";
        }
    }

    public function nameExists($name)
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
        $sql = "SELECT name FROM products WHERE name = ?";
        $sth = $conn->prepare($sql);
        $sth->bindParam(1, $name, PDO::PARAM_STR);
        $sth->execute();
        if($sth->rowCount() < 1)
          return false;
        else 
          return true;
    }

    public function getProduct($id)
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
        $sql = "SELECT * FROM products WHERE id = ?";
        $sth = $conn->prepare($sql);
        $sth->bindParam(1, $id, PDO::PARAM_INT);
        $sth->execute();
        $product = $sth->fetch(PDO::FETCH_ASSOC);
        return $product;
    }

    public function getAllProducts()
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
        $sql = "SELECT * FROM products";
        $sth = $conn->prepare($sql);
        $sth->execute();
        $products = $sth->fetch(PDO::FETCH_ASSOC);
        return $products;
    }

    public function updateProduct($product)
    {
       $name = $product->getName();
       $price = $product->getPrice();
       $id = $product->getId();
       $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
       $sql = "UPDATE products SET name = ?, price = ? WHERE id = ?";
       $sth = $conn->prepare($sql);
       $sth->bindParam(1, $name, PDO::PARAM_STR);
       $sth->bindParam(2, $price, PDO::PARAM_INT);
       $sth->bindParam(3, $id, PDO::PARAM_INT);
       $sth->execute();
    }

    public function deleteProduct($product)
    {
       $id = $product->getId();
       $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
       $sql = "DELETE FROM products WHERE id = ?";
       $sth = $conn->prepare($sql);
       $sth->bindParam(1, $id, PDO::PARAM_INT);
       $sth->execute();
    }
}

function updateProduct($id, $newName, $newPrice)
{
    if(isset($id))
    {
     if(idExists($id))
     {
        if(!empty($newName) && empty($newPrice))
        {
            $model = new Model();
            $productArray = $model->getProduct($id);
            $product = new Product($productArray);
            $product->setName($newName);
            $model->updateProduct($product);
            echo "Product modified";
        }
        elseif(!empty($newPrice) && empty($newName))
        {
            $model = new Model();
            $productArray = $model->getProduct($id);
            $product = new Product($productArray);
            $product->setPrice($newPrice);
            $model->updateProduct($product);
            echo "Product modified";
        }
        elseif(!empty($newName) && !empty($newPrice))
        { 
            $model = new Model();
            $productArray = $model->getProduct($id);
            $product = new Product($productArray);
            $product->setName($newName);
            $product->setPrice($newPrice);
            $model->updateProduct($product);
            echo "Product modified";
        }
        else
            echo "You must fill at least one field.\n";
     }
     else
        echo "This id does not exists.\n";
    
    }
}

function idExists($id)
{
  $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
  $sql = "SELECT id FROM users where id = ?";
  $sth = $conn->prepare($sql);
  $sth->bindParam(1, $id, PDO::PARAM_STR);
  $sth->execute();
  if($sth->rowCount() < 1)
    return false;
  else 
    return true;
}

?>