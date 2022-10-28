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
    public function toString(){
        $l1= "";
        foreach ($this->listeAPayer as &$value) {
            $l1 = $l1."<p>".$value->toString()."</p>";
        }
        return (<<<HTML
        <html>
        <body><h1>facture</h1>
        $l1
        </body>
        </html>
        HTML);
    }
}
$Invoice = new Invoice();
$Invoice->add(new Payable(new Ticket("RGBY17032012 - Walles-France", 9000)));
$Invoice->add(new Payable(new FreshItem("viande", 300,2500,"2022/10/12")));
print($Invoice->toString());