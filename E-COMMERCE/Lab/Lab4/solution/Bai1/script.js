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

function reviewClick(){

	$("#info").empty();
	var lname = document.getElementById("lastName").value;
	var fname = document.getElementById("firstName").value;
	var email = document.getElementById("email").value;
	var address = document.getElementById("address").value;
	var birthday = document.getElementById("birthday").value;
	var job = document.getElementById("job").value;
	var pay = document.getElementById("pay").value;
	var picture = document.getElementById("picture").value;



	var info = document.getElementById("info");
	info.innerHTML += "Name: " + fname + " " + lname + "<br>"; 
	info.innerHTML += "Email: " + email+ "<br>";
	info.innerHTML += "Address: " + address + "<br>";

	if(document.getElementById("r1").checked){
		info.innerHTML += "Sex: " + document.getElementById("r1").value + "<br>";
	}
	if(document.getElementById("r2").checked){
		info.innerHTML += "Sex: " + document.getElementById("r2").value + "<br>";
	}

	info.innerHTML += "Birthday: " + birthday + "<br>";
	info.innerHTML += "Job: " + job + "<br>";
	info.innerHTML += "You want to pay for: " + pay + "<br>";
	info.innerHTML += "Your picture: " + picture + "<br>";

}
									
function calculate_age()
{
    var today_date = new Date();
    var today_year = today_date.getFullYear();
    var today_month = today_date.getMonth();
    var today_day = today_date.getDate();


    var birthday = document.getElementById("birthday").value;
    var birth = new Date(birthday);
    var birth_year = birth.getFullYear();
    var birth_month = birth.getMonth();
    var birth_day = birth.getDate();

    age = today_year - birth_year;

    if ( today_month < (birth_month))
    {
        age--;
    }
    if (((birth_month) == today_month) && (today_day < birth_day))
    {
        age--;
    }
    if(age<18)
    {
    	alert("Ban chua du 18 tuoi, moi nhap lai ngay sinh!");
    }
}