$(document).ready(function(){

	ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );

	$('#selectAllBoxes').click(function(event){

		if(this.checked) {

			$('.post_checkbox').each(function(){

				this.checked = true;
			});

		} else {

			$('.post_checkbox').each(function(){

				this.checked = false;
			});
		}

	});

$('#confirmDelete').click(function(){

	return confirm("Are you sure you want delete this item?");

});



})






