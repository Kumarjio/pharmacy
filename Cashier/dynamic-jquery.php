<html>
<head>
	<?php include_once('../common/header.php'); ?>
<title>jQuery add / remove textbox example</title>
 

<style type="text/css">
	div{
		padding:8px;
	}
</style>

</head>

<body>

<h1>jQuery add / remove textbox example</h1>

<script type="text/javascript">

$(document).ready(function(){
    var counter = 2;
		
    $("#addButton").click(function () {
				
	if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
                
	newTextBoxDiv.after().html('<label>Textbox #'+ counter + ' : </label>' +
	      '<input type="text" name="textbox' + counter + 
	      '" id="textbox' + counter + '" value="" > <a href="#" id="removeButton">Remove</a>');
            
	newTextBoxDiv.appendTo("#TextBoxesGroup");

				
	counter++;
     });

    // $('#remScnt').live('click', function() { 
    // 	alert("click")
    //             if( i > 2 ) {
    //                     $(this).parents('TextBoxDiv').remove();
    //                     i--;
    //             }
    //             return false;
    //     });



     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
	counter--;
			
        $("#TextBoxDiv" + counter).remove();
			
     });
		
     $("#getButtonValue").click(function () {
		
	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
	}
    	  alert(msg);
     });
  });
</script>
<script type="text/javascript">
	$(function() {
        var scntDiv = $('#p_scents');
        var i = $('#p_scents p').size() + 1;
        
        $('#addScnt').live('click', function() {
                $('<p><label for="p_scnts"><input type="text" id="p_scnt" size="20" name="p_scnt_' + i +'" value="" placeholder="Input Value" /></label> <a href="#" id="remScnt">Remove</a></p>').appendTo(scntDiv);
                i++;
                return false;
        });
        
        $('#remScnt').live('click', function() { 
                if( i > 2 ) {
                        $(this).parents('p').remove();
                        i--;
                }
                return false;
        });
});

</script>
</head><body>

<div id='TextBoxesGroup'>
	<div id="TextBoxDiv1">
		<label>Textbox #1 : </label><input type='textbox' id='textbox1' >
	</div>
</div>
<input type='button' value='Add Button' id='addButton'>
<input type='button' value='Remove Button' id='removeButton'>
<input type='button' value='Get TextBox Value' id='getButtonValue'>


<h2><a href="#" id="addScnt">Add Another Input Box</a></h2>

<div id="p_scents">
    <p>
        <label for="p_scnts"><input type="text" id="p_scnt" size="20" name="p_scnt" value="" placeholder="Input Value" /></label>
    </p>
</div>
</body>
</html>