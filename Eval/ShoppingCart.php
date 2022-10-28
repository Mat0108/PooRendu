<?php
require_once("Item.php");
require_once("FreshItem.php");
$globalid = 1;
class ShoppingCart{
    /**
     * @var array
     */
    private $listeCart;
    /**
     * @var int
     */
    private $id;
        
    public function __construct()
    {
        global $globalid;
        $this->listeCart = array();
        $this->id = $globalid++;
        
    }
    /**
     * @return Int
     */
    public function getId(){
        return $this->id;
    }
    public function addItem($item){
        if(empty($this->listeCart) && $item->getWeight() < 10000){
            $this->listeCart[]=$item;
        }else{
            if(($this->totalWeight() + $item->getWeight()) < 10000){
                $this->listeCart[]=$item;
            }}
        }
        
    public function removeItem($item){
        if(in_array($item,$this->listeCart))
        {
            if (($key = array_search($item, $this->listeCart)) !== false) {
                unset($this->listeCart[$key]);
            }
        }else{print("false");}
    }
    public function itemCount(){
        return count($this->listeCart, COUNT_RECURSIVE);
    }
    public function totalWeight(){
        $nb = 0;    
        foreach ($this->listeCart as &$value) {
            $nb = $nb + $value->getWeight();
        }
        
        return($nb);
    }
    public function totalPrice(){
        $nb = 0;
        foreach ($this->listeCart as &$value) {
            $nb = $nb + $value->getPrice();
        }
        return($nb);
    }
    public function toString()
    {
        $l1= "id :".$this->id."  count item :".$this->itemCount();
        $l2= "";
        foreach ($this->listeCart as &$value) {
            $l2 = $l2."<p>".$value->toString()."</p>";
        }
        return (<<<HTML
        <html>
        <body><h1>$l1</h1>
        $l2
        </body>
        </html>
    HTML);
    }
}

$shoppingCart = new ShoppingCart();

$shoppingCart->addItem(new Item("corn flakes", 500,1500));
$shoppingCart->addItem(new Item("pomme", 200,30));
$shoppingCart->addItem(new FreshItem("viande", 300,3000,"2022/10/12"));
// var_dump($shoppingCart);
$shoppingCart->removeItem(new Item("corn flakes", 500,1500));
// var_dump($shoppingCart);
// print("item count : ".$shoppingCart->itemCount());
// print(" total price : ".$shoppingCart->totalPrice());
// print(" total weight : ".$shoppingCart->totalWeight());
print($shoppingCart->toString());

// $shoppingCart2 = new ShoppingCart();