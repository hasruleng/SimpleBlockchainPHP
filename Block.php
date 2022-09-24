<?php
//writen by Hasrul Ma'ruf (Sept 13, 2021)
class Block {
    public $time_stamp;
    public $transactions;
    public $previous_hash;
    public $nonce;
    public $hash;
    
    function __construct($transactions,$previous_hash) {
	    $this->time_stamp = date("Y-m-d h:m:s");
	    $this->transactions = $transactions;
	    $this->previous_hash = $previous_hash;
	    $this->nonce = 0;	//important piece of Proof-of-Work mechanism
	    $this->hash = $this->generate_hash();
    }
    
    function generate_hash(){
	    $block_header = $this->time_stamp.$this->transactions.$this->previous_hash.$this->nonce;
	    $block_hash = hash ("sha256", $block_header);
	    return $block_hash;
    }
    
    function print_contents(){
	echo "timestamp:".$this->time_stamp."<br/>";
	echo "transactions:".$this->transactions."<br/>";
	echo "current hash:".$this->hash."<br/>";
	echo "previous hash:".$this->previous_hash."<br/>";
    }
    
    function str_contents(){
	    return "timestamp:".$this->time_stamp."<br/>"."transactions:".$this->transactions."<br/>"."current hash:".$this->hash."<br/>"."previous hash:".$this->previous_hash."<br/>";
    }
}
?>