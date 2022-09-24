<?php
//writen by Hasrul Ma'ruf (Sept 13, 2021)
require_once('Block.php');

class Blockchain {

    public $chain;
    public $all_transactions;
    
    function __construct() {
	    $this->chain = [];
	    $this->all_transactions = [];
	    $this->genesis_block();//must create genesis block (first block)
    }
    
    function genesis_block(){
	    $transactions = "{}";
	    $genesis_block = new Block($transactions,"0"); //this is genesis block (first block)
	    array_push($this->chain,$genesis_block); //append genesis_block to the chain
	    return $this->chain;
    }
    
    //print all contents of blockchain
    function print_blocks(){
	    for ($i = 0; $i<count($this->chain); $i++){
		$current_block = $this->chain[$i];
		sprintf("Block %s %s ", $i, $current_block->str_contents());
		$current_block->print_contents();
	    }
    }
   
    function proof_of_work($block, $difficulty){
	    $proof = $block->generate_hash();
	    //~ print("difficulty level:".str_repeat('0',$difficulty));
	    while (substr($proof,0,$difficulty) != str_repeat('0',$difficulty)){
		$block->nonce += 1;
		$proof = $block->generate_hash();
		/*/3: Uncomment this to see how much computing power required to recreate the blockchain in the network from genesis_block to your tampered block
			print($block->nonce.":".$proof."<br/>"); //*/
	    }
	    $block->nonce = 0;
	    return $proof;
    }
    
    function add_block($transactions){
	    $prev_block_hash = $this->chain[count($this->chain)-1]->hash;
	    $new_block = new Block($transactions, $prev_block_hash);
	    $proof = $this->proof_of_work($new_block,2); //4: Lets add the difficulty level here to see how it affects the computing power required to tamper a blockchain
	    array_push($this->chain, $new_block);	//append new block
	    return [$proof, $new_block];
    }
    
    function validate_chain(){
	    for ($i = 1; $i<count($this->chain); $i++){ //start from 1
		$current = $this->chain[$i];
		$previous = $this->chain[$i-1];	//the reason why start from 1
		if ($current->hash != $current->generate_hash()){
		    print("<b>The current hash of the block does not equal the generated hash of the block.</b>");
		    return false;
		} 
		if($current->previous_hash != $previous->generate_hash()){
		    print("<b>The previous block's hash does not equal the previous hash value stored in the current block.</b>");
		    return false;
		}
	    }
    }
    
}
?>