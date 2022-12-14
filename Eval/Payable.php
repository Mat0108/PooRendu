<?php
require_once("Ticket.php");
//require_once("ShoppingCart.php");
require_once("Item.php");
require_once("FreshItem.php");

class Payable {
    /**
     * @var long
     */
    private $Tax;
    
    private $Item;
    public function __construct($item)
    {
        $this->Item=$item;
        switch(get_class($item)){
            case "Ticket":
                $this->Tax=25;
                break;
            case "Item":
                $this->Tax=10;
                break;
            case "FreshItem":
                $this->Tax= 10-0.1*intdiv($item->getWeight(),1000);
                break;
        }
    }
    public function label(){
        switch(get_class($this->Item)){
            case "Ticket":
                return $this->Item->getReference();
                break;
            case "Item":
                return $this->Item->getName();
                break;
            case "FreshItem":
                return $this->Item->getName();
                break;
        }
        return $this->Item->getName();
    }
    public function cost(){
        return $this->Item->getPrice();
    }
    public function getTax(){
        return $this->Tax;
    }
    public function taxRatePerTenThousand(){
        return $this->Item->getPrice()*((100+(float)$this->Tax)/100);
    }
    public function toString(){
        return "label : ".$this->label()."  prix ht : ".($this->cost()/100)." € prix tcc : ".($this->taxRatePerTenThousand()/100)." €";
    }
}

//$payable = new Payable(new Ticket("RGBY17032012 - Walles-France", 9000));
//$payable2 = new Payable(new FreshItem("viande", 3000,2500,"2022/10/12"));
// print($payable2->label()." ");
// print($payable2->cost()." ");
// print($payable2->taxRatePerTenThousand());