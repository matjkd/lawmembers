$(document).ready(function(){
//Setting some variables needed, don't edit these
	var displaySubmit=false, newRowCount=0;
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//Define some variables - edit to suit your needs
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	var maxRows=5;
	var rowSpeed = 300;
	var $table = $("#myTable");
	var $tableBody = $("tbody",$table);
	var $addRowBtn = $("#controls #addRow");
	var $removeAllBtn= $("#controls #removeAllRows");
	var $hiddenControls = $("#controls .hiddenControls");
	var blankRowID = "blankRow";
	var newRowClass = "newRow";
	var oddRowClass = "rowOdd";
	var evenRowClass = "rowEven"
	var hiddenClass = "hidden"
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	
	
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//click the add button
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	$addRowBtn.click(function(){
		if(newRowCount < maxRows){
			newRowCount++;
			//get the class on the first row...
			if($tableBody.find("tr:first-child").hasClass(evenRowClass)){
				//the curent first row is even, so we add an odd class
				newClasses = hiddenClass+" "+newRowClass+" "+oddRowClass;
			}else{
				//the current first row is odd, so we add an even row
				newClasses = hiddenClass+" "+newRowClass+" "+evenRowClass;
			}
			//clone the blank row, put the clone at the top, set the correct classes, remove the ID, animate the divs inside
			//normally I'd use .addClass(), but I want the classes I set to replace the current set classes, so I use .attr("class") to overwrite the classes
			newRow = $("#"+blankRowID,$tableBody).clone().prependTo($tableBody).attr("class",newClasses).removeAttr("id").show().find("td div").slideDown(rowSpeed,function(){
				//run this once animations finish
				showHideSubmit();
			});
			//Add click event to the remove button on the newly added row
			newRow.find(".removeRow").click(function(){
				thisRow = $(this).parents("tr");
				rowRemoved=false;
				newRowCount--;
				//animate the row
				thisRow.find("td div").slideUp(rowSpeed,function(){
					//this is run once the animation completes
					if(!rowRemoved){ //this only lets it fire once per row
						thisRow.remove();
						showHideSubmit();
						//make sure alternating rows are correct once a row is removed
						$tableBody.find("tr:odd").removeClass(evenRowClass).addClass(oddRowClass); //odd rows have an odd class
						$tableBody.find("tr:even").removeClass(oddRowClass).addClass(evenRowClass);//even rows have an even class
						if(newRowCount < maxRows){
							$addRowBtn.removeAttr("disabled");//re-enable the add button
						}
					}
					rowRemoved=true;
				}); 
				return false; //kill the browser default action
			});
		}
		//disable button so you know you've reached the max
		if(newRowCount >= maxRows){
			$addRowBtn.attr("disabled","disabled");//set the "disabled" property on the button
		}
		return false; //kill the browser default action
	});
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


	
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//Click the remove all button
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	$removeAllBtn.click(function(){
		//Close all the newly created rows
		$tableBody.find("tr."+newRowClass+"").each(function(){
			newRowCount--;
			showHideSubmit();
			//this happens once for every div that slides - no harm done though
			$(this).find("td div").slideUp(rowSpeed,function(){
				$(this).parents("."+newRowClass).remove(); //remove this row
				$addRowBtn.removeAttr("disabled"); //re-enable the add button
			});
		});
		return false;
	});
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~



//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//Function to show or hide the submit/cancel buttons
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	function showHideSubmit(){
		if(newRowCount > 0 && !displaySubmit){
				//at least one new row is visible, show the hidden controls
				$hiddenControls.fadeIn(rowSpeed);
				//partially fade out all rows that are not new and disable links within
				$tableBody.find("tr:not(#"+blankRowID+", ."+newRowClass+")").fadeTo(rowSpeed,0.25, function(){
					$(this).find("a").click(function(){return false;});//makes all clicked links go nowhere
				});
				displaySubmit= true;
		}else if(newRowCount <= 0){
			//no new rows are shown, hide the controls
			$hiddenControls.fadeOut(rowSpeed);
			//fade old rows back in and re-enable links
			$tableBody.find("tr:not(#"+blankRowID+", ."+newRowClass+")").fadeTo(rowSpeed,1,function(){
				$(this).find("a").unbind("click");//removes the click event we site above
			});
			newRowCount=0;//Make sure the count is reset to 0...just in case
			displaySubmit= false;
		}
	}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
});