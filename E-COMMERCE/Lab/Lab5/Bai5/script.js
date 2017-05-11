 function beginDesign(){
 $("#textDesign").hide();
 $("#bordertShirt").css("border","none");


 var btn1 = $('<button/>', {
        text: 'Add text', 
        class: 'btnCreate',
        id: 'btnAddText',
        //click btn1 even
        click: function () { 
        	var textArea = $('<textarea/>',{
        		cols: '30',
        		rows: '3',
        		placeholder: 'Your text',
        		id: 'textArea'
        	});//create textarea
        	var btnOk = $('<button/>',{
        		text: 'OK',
        		id: 'btnOk',
        		click: function (){
        			if($('#textArea').val().length != 0){
        				var text = $('#textArea').val();
        				$("#textDesign").html(text);
        				 $("#textDesign").show();
        			}
        		}
        	});//create btnOK
        	var arrayColor = {};
        	for(i = 0; i <7; i++) {
	        	arrayColor[i] =	$('<button/>',{
	        		id: 'color' + i,
	        		class: 'basicColor',
	        		click: function (){
	        			var x = $(this).css('background-color');
	        			$('#textDesign').css('color', x);
	        		} 
	        	});
        	}//create basic color
        	var moreColor = $('<input/>',{
        		type: 'color',
        		id: 'moreColor',
        		change: function (){
        			var y = $('#moreColor').val();
        			$('#textDesign').css('color', y);
        		}
        	});//create more color
        	$('#design').append(textArea);
        	$('#design').append(btnOk);
        	$('#design').append("<br><br>");
        	$('#design').append("Basic color<br><br>");
        	for (var i = 0; i<7; i++) {
        		$('#design').append(arrayColor[i]);
        	}
        	$('#design').append("<br><br>");
        	$('#design').append("And more<br><br>");
        	$('#design').append(moreColor);
        	$('#design').append("<br><br>");

        }//end btn1 even
        //================================================
    });//end btn1

 var btn2 = $('<button/>', {
	        text: 'Add picture', 
	        class: 'btnCreate',
	        id: 'btnAddPicture',
	        click: function (){
		    $('#design').append("Choose a file: <br><br>");
		    var file = $('<input/>',{
			    	type: 'file',
			    	id: 'file',
			    	value: 'Choose a file'
		    	});
		    var btnOk2 = $('<button/>',{
        		text: 'OK',
        		id: 'btnOk2',
        		click: function (){
        			var f = $('#file').val().replace(/C:\\fakepath\\/i, '');
  					var imgF = $('<img/>',{
  						src: './img/'+ f,
  						id: 'imgF'
  					})
  					$("#bordertShirt").append(imgF);
        		}
        	});//create btnOK
        	var top = $('<input/>',{
        		type: 'number',
        		value: '0',
        		change: function(){
        			var top = $(this).val() + 'px';
        			$('#imgF').css('margin-top', top);
        		}
        	})//top
        	var left = $('<input/>',{
        		type: 'number',
        		value: '0',
        		change: function(){
        			var left = $(this).val() + 'px';
        			$('#imgF').css('margin-left', left);
        		}

        	})//left
		    $('#design').append(file);
		    $('#design').append("<br><br>");
		    $('#design').append(btnOk2);
		    $('#design').append('<br>Top:');
		    $('#design').append(top);
		    $('#design').append('px');
		    $('#design').append('<br>Left:');
		    $('#design').append(left);
		    $('#design').append('px');
	    }//click button2

    });//end btn2

 $('#design').html(btn1);
 $('#design').append(btn2);

//text color select

};


