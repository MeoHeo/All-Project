function studentPay(pay){

	var option1 = document.createElement('option');
	option1.text = "semester";
	pay.add(option1);

	var option2 = document.createElement('option');
	option2.text = "1 year";
	pay.add(option2);
}

function otherPay(pay){

	var option3 = document.createElement('option');
	option3.text = "1 year";
	pay.add(option3);

	var option4 = document.createElement('option');
	option4.text = "2 years";
	pay.add(option4);
}

function addOptionPay(){
	var pay = document.getElementById('pay');
	var job = document.getElementById('job');
	if(job.selectedIndex == 1)
		{
			if (pay.length==0) {
				studentPay(pay);
			}
			else
			{
				pay.options.length = 0;
				studentPay(pay);
			}
		}
	else if (job.selectedIndex == 2 || job.selectedIndex == 3)
		{
			if (pay.length==0) {
				otherPay(pay);
			}
			else
			{
				pay.options.length = 0;
				otherPay(pay);
			}
		}
	else
	{}
}


 $(document).ready(function()
 {
 	 $("#btn_review").click(function (e) {
 	 	// e.preventDefault();
 	    $.ajax({
 	             type: 'POST',	             
 	             data : $("#formId").serialize(),
 	             url: 'aspFile.asp', 
 	             // dong bo hoa voi du lieu tren form, quan trong
 	             success: function (data) {
 	                $("#info").html(data);

 	                },
 	             error: function (data) {
 	                alert("In error  ");

 	                }
 	           });
 	    // e.preventDefault();
 	});
 });
