if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.open("GET","books.xml",false);
xmlhttp.send();
xmlDoc=xmlhttp.responseXML; 

var xmlRowString = "";

for (var i = 0; i < xmlDoc.documentElement.childNodes.length; i++)
{
if ( xmlDoc.documentElement.childNodes[i].nodeName == 'book' )
{
for ( var k = 0 ; k < xmlDoc.documentElement.childNodes[i].childNodes.length; k++ )
{
if ( xmlDoc.documentElement.childNodes[i].childNodes[k].nodeName == 'author' )
{
xmlRowString += "<book><author>"+xmlDoc.documentElement.childNodes[i].childNodes[k].textContent+"</author>";
}
if ( xmlDoc.documentElement.childNodes[i].childNodes[k].nodeName == 'title' )
{
xmlRowString += "<title>"+xmlDoc.documentElement.childNodes[i].childNodes[k].textContent+"</title>";
}
if ( xmlDoc.documentElement.childNodes[i].childNodes[k].nodeName == 'description' )
{
xmlRowString += "<description>"+xmlDoc.documentElement.childNodes[i].childNodes[k].textContent+"</description></book>";
}
}
}
if ( xmlRowString === "" )
{
}
else
{
//Here for each book we populate a local stoage row
if (typeof(localStorage) == 'undefined' ) 
{
alert('Your browser does not support HTML5 localStorage. Try upgrading.');
} 
else 
{
try                          
{ 
localStorage.setItem(i, xmlRowString);
} 
catch (e) 
{
alert("save failed!");
if (e == QUOTA_EXCEEDED_ERR) 
{
alert('Quota exceeded!'); //data wasn't successfully saved due to quota exceed so throw an error
}
}
}
xmlRowString = "";  
}
}