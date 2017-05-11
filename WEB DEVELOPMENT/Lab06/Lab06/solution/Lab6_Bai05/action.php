<!DOCTYPE html>
<html>
<body>
	<div style="border:solid 1px">
		<h1>Result</h1>
		<?php
			$firstNumber = $secondNumber = $operator = $result = "";
			// ==========================submit action==============================
			if (isset($_POST['submit'])) { 
				// ==========================Choosen firstNumber==============================
				if (!empty($_POST['firstNumber'])) { 
					$firstNumber=$_POST['firstNumber'];
				}
	    		else { echo "You must add first number <br>"; }
	    		// ==========================Choosen secondNumber==============================
				if (!empty($_POST['secondNumber'])) { 
					$secondNumber=$_POST['secondNumber'];
				}
	    		else { echo "You must add second number <br>"; }
				// ==========================Choosen operator==============================
				if (!empty($_POST['operator'])) { 
					$operator=$_POST['operator'];
				}
	    		else { echo "You must choose operator <br>"; }
	    		// ==========================Caculator==============================
	    		if(!empty($_POST['firstNumber']) && !empty($_POST['secondNumber']) && !empty($_POST['operator']))
	    		{
	    			switch ($operator) {
	    			case '+':
	    				$result = $firstNumber + $secondNumber;
	    				break;
	    			case '-':
	    				$result = $firstNumber - $secondNumber;
	    				break;
	    			case '*':
	    				$result = $firstNumber * $secondNumber;
	    				break;
	    			case '/':
	    				$result = $firstNumber / $secondNumber;
	    				break;
	    			case '^':
	    				{
	    					$result = 1;
	    					for($i=0;$i<$secondNumber;$i++)
		    				{
		    					$result = $result*$firstNumber;
		    				}
	    					break;
	    				}
	    			case '~':
	    				$result = 1/($firstNumber / $secondNumber);
	    				break;				
	    			default:
	    				echo "You choose wrong operator <br>";
	    				break;
	    			}//switch
	    			if($operator=='~')
		    		{
		    			echo "Nghich dao cua ".$firstNumber."/".$secondNumber." la: ".$result;
		    		}
		    		else    			
		    			echo $firstNumber.$operator.$secondNumber."=".$result;

	    		}//if_empty
	    		else{}
	    	}//if_submit	
	    		
			// ==========================not submit==============================
	  		else { echo "Please submit the form."; }
		?>
	</div>
</body>
</html>

