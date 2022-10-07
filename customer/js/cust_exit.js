function exit(){
		$.ajax({
			type:"POST",
			url:"logout.php",
			success: function(data)
			{
				window.location = '../index.php';
			}
		})
	
}