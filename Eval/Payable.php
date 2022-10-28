<?php
require_once("Ticket.php");
require_once("ShoppingCart.php");

class Payable {
    /**
     * @var long
     */
    private $Tax;
    
    private $item;
    public function __construct($item)
    {
        switch(get_class($item)){
            case "Ticket":
                $this->Tax=10;
        }
        print(get_class($item));
    }
    public function label(){

    }
    public function cost(){
    }
    /**
     * @return  long
     */ 
    public function taxRatePerTenThousand(){
        if(!isset($this->Tax)){
        }

    }
}

$payable = new Payable(new Ticket("RGBY17032012 - Walles-France", 9000));
//$payable->taxRatePerTenThousand();