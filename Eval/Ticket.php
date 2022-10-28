<?php
class Ticket{
    /** @var String */
    private $Reference;
    /** @var long */
    private $Price;
    public function __construct($reference,$price)
    {
        $this->Reference=$reference;
        $this->Price=$price;
    }
    

    /** @return  String */ 
    public function getReference(){return $this->Reference;}

    /** @return  long */ 
    public function getPrice(){return $this->Price;}
}

// $ticket = new Ticket("RGBY17032012 - Walles-France", 9000);
// var_dump($ticket);