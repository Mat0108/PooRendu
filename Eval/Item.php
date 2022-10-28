<?php

class Item{
    /**
     * @var String
     */
    private $Name;
    /**
     * @var long
     */
    private $Price;
    /**
     * @var Int
     */
    private $Weight;
    public function __construct($name,$price,$weight)
    {
        $this->Name = $name;
        $this->Price = $price;
        $this->Weight = $weight;
    }
    /**
     * @return String
     */
    public function getName(){
        return $this->Name;
    }
    /**
     * @return long
     */
    public function getPrice(){
        return $this->Price;    
    }
    /**
     * @return Int
     */
    public function getWeight(){
        return $this->Weight;
    }
    public function toString(){
        return $this->getName().": ".$this->getPrice(). " € poids : ".$this->getWeight();
    }
    


}
function fvar_dump($item){
    $string = $item->getName().": ".$item->getPrice(). " €"; 
    print($string);
}
// $item = new Item("corn flakes", 500);
// var_dump($item->getPrice());
// var_dump($item->getName()); 
// fvar_dump($item);
// $chewingGum = new Item("chewing gum",403);
// fvar_dump($chewingGum);     
