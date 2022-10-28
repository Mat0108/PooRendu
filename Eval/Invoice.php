<?php
require_once("Payable.php");
class Invoice{
     /**
     * @var array
     */
    private $listeAPayer;
    
    public function __construct()
    {
        $this->listeAPayer = array();
    }
    public function add(Payable $p){
        $this->listeAPayer[]=$p;
    }
    public function totalAmount(){
        $nb= 0;
        foreach ($this->listeAPayer as &$value) {
            $nb = $nb+$value->cost();
        }
        return $nb/100;
    }
    public function totalTax(){
        $nb= 0;
        foreach ($this->listeAPayer as &$value) {
            $nb = $nb+$value->taxRatePerTenThousand()-$value->cost();
        }
        return $nb/100;
    }
    public function toString(){
        $l1= "";
        foreach ($this->listeAPayer as &$value) {
            $l1 = $l1."<p>".$value->toString()."</p>";
        }
        $prixtotal = "prix total tc : ".$this->totalAmount()." € prix taxe : ".$this->totalTax()."  €";
        return (<<<HTML
        <html>
        <body><h1>facture</h1>
        $l1
        <p>$prixtotal</p>
        </body>
        </html>
        HTML);
    }
}
$Invoice = new Invoice();
$Invoice->add(new Payable(new Ticket("RGBY17032012 - Walles-France", 9000)));
$Invoice->add(new Payable(new FreshItem("viande", 3000,2500,"2022/10/12")));
print($Invoice->toString());