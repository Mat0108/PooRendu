<?php 
require_once("Item.php");
class FreshItem extends Item{
    /**
     * @var date
     */
    private $bestBeforeDate;
    
    public function __construct($name,$price,$weight,$date)
    {
        parent::__construct($name,$price,$weight);
        $this->bestBeforeDate = date('Y-m-y ',strtotime($date));
    }
    public function toString(){
        return "data limite : ".$this->bestBeforeDate." ".parent::getName().": ".parent::getPrice(). " € poids : ".parent::getWeight();
    }

}
// $freshItem = new FreshItem("pomme", 200,0.5,"2022/10/12");
// var_dump($freshItem);   