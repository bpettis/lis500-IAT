var output = document.getElementById("wordcount");
output.value = 0;
var textarea = document.getElementById("textbox");
var formoutput = document.getElementById("formwordcount")
	
textarea.onkeyup = function (event) {
	var words = textarea.value.split(" ");
	output.innerHTML = words.length;
	formoutput.value = words.length;

}