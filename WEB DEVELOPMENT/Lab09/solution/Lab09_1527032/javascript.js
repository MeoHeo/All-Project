function createTable() {
    var x = document.createElement("TABLE");
    x.setAttribute("id", "myTable");
    document.body.appendChild(x);

    for(i=0;i<2;i++)
    {
        var y = document.createElement("TR");
        var currentTR = "tr" + i;
        y.setAttribute("id",currentTR);
        document.getElementById("myTable").appendChild(y);

        for(j = 0;j<2;j++)
        {
            var z = document.createElement("TD");
            var t = document.createTextNode("myCell");
            z.appendChild(t);
            document.getElementById(currentTR).appendChild(z);
        }       
    }
}

function addRow(){
    var table = document.getElementById("myTable");
    var len = myTable.rows[1].cells.length;
    var row = table.insertRow(0);
    for(i=0;i<len;i++)
    {      
        var cell1 = row.insertCell(i);
        cell1.innerHTML = "NEW CELL";
    }
}

function addColumn(){
    var table = document.getElementById("myTable");
    var len = myTable.rows[1].cells.length;
    for(i=0;i<myTable.rows.length;i++)
    {
        var cell = table.rows[i].insertCell(len); 
        cell.innerHTML = "NEW COLUMN";
    }
}
function delTable(){
    var table = document.getElementById("myTable");
    var len = myTable.rows.length;
    for(i=0;i<len;i++)
    {
        table.deleteRow(0);
    }
}
function delCol(col){
    for(i=0;i<myTable.rows.length;i++)
    {
        myTable.rows[i].deleteCell(col);
    }
}
function del(){
    var table = document.getElementById("myTable");
    var row = document.getElementById("row").value;
    var col = document.getElementById("col").value;
    var len = myTable.rows[1].cells.length;
    if(row>myTable.rows.length)
    {
        alert("Invalid row, please fill agains");
    }    
    else if(col>len)
    {
        alert("Invalid column, please fill agains");
    }
    else
    {
        table.deleteRow(row);
        delCol(col);
    }

}