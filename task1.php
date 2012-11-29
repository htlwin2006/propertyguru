<?php

	/**
	 * syntax:
	 * php task1.php [integer range] [rule number]
	 * eg. php task1.php 4..11 1
	 */

	try{
		error_reporting(E_ALL);
		ini_set('display_errors','On');
		
		if(!isset($argv[1])) throw new Exception("Positive inter range must be provided. syntax: php task1.php 4..11 1");
		if(!isset($argv[2])) throw new Exception("Rule number must be provided. syntax: php task1.php 4..11 1");
		
		$input = $argv[1];
		$rule = $argv[2];
		
		calculate($input,$rule);
		echo "\n";
	}catch (Exception $e){
		echo $e->getMessage() . "\n";
	}
	
	
	
	
	/*
	 * Assumption:
	 * Integer range should be in following format lower_bound..upper_bound
	 * eg. 12..19
	 * 19..12 might not work
	 */
	function calculate($func,$rule=1){
		$intArr = parseFunctionString($func);
		$adjacency = array(null,null);
		
		if($rule==1){
			foreach($intArr as $item){
				if(isMultiple(3,$item)) echo "Fizz";
				if(isMultiple(5,$item)) echo "Buzz";
				if(!isMultiple(3,$item) && !isMultiple(5,$item)) echo $item;
				echo " ";
			}
		}else{
			foreach($intArr as $item){
				if(isMultiple(3,$item)) { 
					echo "Fizz"; 
					array_shift($adjacency);
					array_push($adjacency, true);
				}
				
				if(isMultiple(5,$item)) { 
					echo "Buzz"; 
					array_shift($adjacency);
					array_push($adjacency, true);
				}
				
				if(!isMultiple(3,$item) && !isMultiple(5,$item)) {
					echo ($adjacency[0] && $adjacency[1] ? "Bazz" : $item);
						
					array_shift($adjacency);
					array_push($adjacency, false);
				}
				echo " ";
			}
		}
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $func
	 */
	function parseFunctionString($func){
		$intArr = array();
		$arr = explode(".", $func);
		
		$lower = $arr[0];
		$upper = $arr[2];
		
		if($lower<0 || $upper<0) throw new Exception("Only positive integer range is accepted.");
		
		for($i=$lower;$i<=$upper;$i++){
			$intArr[] = $i;
		}
		
		return $intArr;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $multiplyer 
	 * @param unknown_type $number
	 */
	function isMultiple($multiplyer,$number){
		if($number%$multiplyer==0) return TRUE;
		return FALSE;
	}

?>