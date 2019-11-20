<?php

Class Product
{
    private $name;
    private $price;
    private $id;

    public function __construct($product)
    {
        $this->name = $product['name'];
        $this->price = $product['price'];
        $this->id = $product['id'];
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
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

    public function addProduct($name, $price)
    {
        if($this->nameExists($name))
        echo "Impossible : a product already have this name\n";
        else
        {
            $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
            $sql = "INSERT INTO products(name, price) VALUES(:name, :price)";
            $sth = $conn->prepare($sql);
            $sth->bindParam(':name', $name, PDO::PARAM_STR);
            $sth->bindParam(':price', $price, PDO::PARAM_INT);
            $sth->execute();
        }
    }

    private function nameExists($name)
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
        $product = $sth->fetch(PDO::FETCH_ASSOC);
        return $product;
    }

    public function updateProduct($product)
    {
       $name = $product->name;
       $price = $product->price;
       $id = $product->id;
       $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
       $sql = "UPDATE products SET name = ?, price = ? WHERE id = ?";
       $sth = $conn->prepare($sql);
       $sth->bindParam(1, $name, PDO::PARAM_STR);
       $sth->bindParam(2, $price, PDO::PARAM_STR);
       $sth->bindParam(3, $id, PDO::PARAM_INT);
       $sth->execute();
    }

    public function deleteProduct($product)
    {
       $id = $product->id;
       $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
       $sql = "DELETE FROM products WHERE $id = ?";
       $sth = $conn->prepare($sql);
       $sth->bindParam(1, $id, PDO::PARAM_INT);
       $sth->execute();
    }

}

class Humain extends Product
{
    
}

$billy = new Humain('Billy', 5000);
$billy2 = new Humain('Billy', 4);

$billy->addProduct();
$billy2->addProduct();



?>