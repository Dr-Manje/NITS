// autocomplet : this function will be executed every time we change the text 
function autocomplet() {
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#memberNumberS').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'AutocompleteGetMemberDetails.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#cont_list_id').show();
				$('#cont_list_id').html(data);
			}
		});
	} else {
		$('#cont_list_id').hide();
	}
}
        
// set_item : this function will be executed when we select an item
function set_item(item,item2) {
//                var names = ui.item.data.split("|");						
//		$('#country_id1').val(names[1]);
//		$('#phone_code_1').val(names[2]);
//		$('#country_code_1').val(names[3]);
//	// change input value
	$('#cont_id').val(item);
        $('#cont_id1').val(item2);
//	// hide proposition list
	$('#cont_list_id').hide();
}