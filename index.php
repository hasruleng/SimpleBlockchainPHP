<html>

<?php
//writen by Hasrul Ma'ruf (Sept 13, 2021)
require_once('Blockchain.php');
   
    $block_1_transactions = '{"sender":"Alice", "receiver": "Bob", "amount":"50"}';
    $block_2_transactions = '{"sender": "Bob", "receiver":"Cole", "amount":"25"}';
    $block_3_transactions = '{"sender":"Alice", "receiver":"Cole", "amount":"35"}';
    $fake_transactions = '{"sender": "Bob", "receiver":"Cole, Alice", "amount":"25"}';

    $test_blockchain= new Blockchain();
    
    $test_blockchain->add_block($block_1_transactions);
    $test_blockchain->add_block($block_2_transactions);
    $test_blockchain->add_block($block_3_transactions);
    $test_blockchain->print_blocks();
   

    //*1: Trying to tamper one block transaction(s)
    echo "<br/>Trying to change one transaction in of the block, but not changing the hash value of that block<br/>";
    $test_blockchain->chain[2]->transactions = $fake_transactions;
    $test_blockchain->validate_chain();
    //*/

    /*2: Trying to be smart by also changing the hash value of the tampered block
    echo "<br/><br/>This time changing the hash value of that block, hoping it will be recognized as valid block<br/>";
    $test_blockchain->chain[2]->transactions = $block_2_transactions;//restoring the value
    $test_blockchain->chain[2]->transactions = $fake_transactions;
    $block_header_for_new_hash	= $test_blockchain->chain[2]->time_stamp.$fake_transactions.$test_blockchain->chain[2]->previous_hash.$test_blockchain->chain[2]->nonce; //using all data from original block, except for the transactions 
    $test_blockchain->chain[2]->hash = $test_blockchain->chain[2]->generate_hash(); //updating the hash value of block #2
    $test_blockchain->validate_chain();    
        
    echo "<br/><br/>Apparently you can't succeed! Unless you have THE COMPUTING POWER to update all the hash values from the generic block (Block #0) to your tampered block IN MAJORITY OF PARTICIPANTS IN THE NETWORK";
    echo "<br/><br/>Well, lets say I and my friends believed that we had such computing power. How much power/time does it take to manipulate transactions in the chain?";
    //*/
?>

</html>