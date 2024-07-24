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
