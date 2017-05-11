var numTask = 0;
var totalTask = 0;
//check checkbox
	function checkCheckBox(cb){
		if(cb.checked){
			$(cb).parents('tr').css('text-decoration', 'line-through');
			numTask --;
			$('#numTask').html(numTask);
		}
		else{
			$(cb).parents('tr').css('text-decoration', 'none');
			numTask ++;
			$('#numTask').html(numTask);
		}								
	}

$(document).ready(function () {

	//add task
	function addTask(c1,c2){
	$('#myTable').append('<tr>'+'<td>'+ c1[0].outerHTML + '</td>'+'<td>' + c2 +'</td>'+'</tr>');
		/*var row = $('<tr></tr>');
		var cell = $('<td></td>');
		cell.append(c1);
		row.append(cell);
		$('#myTable').append(row);*/
	}
	
	//enter 
	$('#task').keypress(function(e) {
	        if (e.keyCode == 13) {
	            if($('#task').val().length !== 0){

	            	var c1 = $('<input class="checkBox" onchange="checkCheckBox(this);" type="checkbox">');

	            	var c2 = $('#task').val();

	            	addTask(c1,c2);

	            	numTask ++;
	            	$('#numTask').html(numTask);

	            	totalTask ++;
	            	$('#totalTask').html(totalTask);

	            	$('#task').val("");

	            }
				
	            return false; // prevent the button click from happening
	        }

	});

});
