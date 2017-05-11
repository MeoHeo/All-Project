
<%
dim lname, fname, email, address, sex, birthday, job, pay, picture  
lname = Request.Form("lastName")
fName = Request.Form("firstName")
email = Request.Form("email")
address = Request.Form("address")
sex = Request.Form("sex")
birthday = Request.Form("birthday")
job = Request.Form("job")
pay = Request.Form("pay")
picture = Request.Form("picture")
Response.Write("Name: " &fname& " " &lname& "<br>")
Response.Write("Email: " &email& "<br>")
Response.Write("Address: " &address& "<br>")
Response.Write("Sex: " &sex& "<br>")
Response.Write("Birthday: " &birthday& "<br>")
Response.Write("Job: " &job& "<br>")
Response.Write("You want to pay for: " &pay& "<br>")
Response.Write("Picture: " &picture& "<br>")

%>
