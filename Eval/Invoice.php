<?php
require_once("Payable.php");
class Invoice{
     /**
     * @var array
     */
    private $listeAPayer;
    private $pdo;
    public $table;

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
    public function getPdo(){
        if (!$this->pdo){
            try{
                $xml = simplexml_load_file('./config.xml');
                //echo var_dump($xml);
                $this->table = $xml->table;
                //echo var_dump($this);
                try{
                    $this->pdo = new \PDO("mysql:host=$xml->host;dbname=$xml->dbname","$xml->user","$xml->password",array(
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'));
                    //echo var_dump($this);
                }catch(\PDOException $erreur){

                }
            }catch(\Exception $erreur){
                echo "Impossible d'extraire les info du config.xml <br>";
            }
        }
        //echo var_dump($this);
        return $this->pdo;
    }
    public function toBdd(){
        $produit ="";
        $qty = 0;
        $total = 0.0;
        $tax = 0.0;
        foreach ($this->listeAPayer as &$value) {
            $produit=$produit.'{"'.$value->label().'","'.$value->cost().'","'.$value->getTax().'"},';
            $qty++;
        }
        $produit = substr($produit, 0, -1);
        $total = $this->totalAmount();
        $tax=$this->totalTax();
        var_dump($produit);
        var_dump($qty);
        var_dump($total);
        var_dump($tax);
        $this->getPdo();    
        $sql = "INSERT INTO ".$this->table."VALUES ('".$produit ."','".$qty."','".$total."','".$tax."')";
        $this->getPdo()->query($sql);
        
    }
}
$Invoice = new Invoice();
$Invoice->add(new Payable(new Ticket("RGBY17032012 - Walles-France", 9000)));
$Invoice->add(new Payable(new FreshItem("viande", 3000,2500,"2022/10/12")));
print($Invoice->toString());
//$Invoice->toBdd();