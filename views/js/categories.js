$(".table").on("click", ".btnEditCategory", function(){
	var idCategory = $(this).attr("idCategory");
	var datum = new FormData();
	datum.append("idCategory", idCategory);

	$.ajax({
		url: "ajax/categories.ajax.php",
		method: "POST",
      	data: datum,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(answer){
     		$("#editCategory").val(answer["category"]);
     		$("#idCategory").val(answer["id"]);
     	}

	})

});

$(".table").on("click", ".btnDeleteCategory", function(){
	 var idCategory = $(this).attr("idCategory");

	 Swal.fire({
	 	title: 'Are you sure you want to delete the category?',
		text: "If you're not sure you can cancel!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancel',
		confirmButtonText: 'Yes, delete category!'
	 }).then(function(result){
	 	if(result.value){
	 		window.location = "index.php?route=categories&idCategory="+idCategory;
	 	}
	 })
});