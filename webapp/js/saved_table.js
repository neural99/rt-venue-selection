function sortTable() {
	$theTable = $(".saved_table").tablesorter();
	
	$("#filter").keyup(function() {
	$.uiTableFilter( $theTable, this.value, 'Namn');
  });

  $('#filter-form').submit(function(){
    $theTable.find("tbody > tr:visible > td:eq(1)").mousedown();
    return false;
  }).focus(); //Give focus to input field
}

$(sortTable);