$(document).ready(function(){
	if($(".alert-success").length)
		show_toast('Success',$(".alert-success").text(),'success');

	if($(".alert-danger").length)
		show_toast('Error',$(".alert-danger").text(),'danger');		

	if($("#loginForm").length)
		login();
});
function login()
{
	$("#loginForm").validate({
		rules:{
			username:{
				required: true
			},
			password:{
				required: true
			}
		},
		messages:{
			username:  {
				required: "<span class='error'><i class='la la-warning'></i> Enter email</span>"
			},
			password:{
				required: "<span class='error'><i class='la la-warning'></i> Enter password</span>"
			}
		}
	});

	$("#loginForm").submit(function(e){
		e.preventDefault();

		if($("#loginForm").valid())
		{
			$.ajax({
				url: $("#loginForm").attr("action"),
				type: 'post',
				dataType: 'json',
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				beforeSend:function(){
					show_loader("loginForm button[type=submit]");
				},
				success:function(response){
					if(response.status == 1)
						window.location.replace(response.redirect);
					else {
						alert(response.message);
						hide_loader("loginForm button[type=submit]","Sign In");
					}
				}
			});
		}
	});
}
function remove_row(url,type="delete")
{
	swal({
        title: 'Are you sure?',
        text: "To remove this entry permanently!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if(result.value) {
            $.ajax({
				url: url,
				type: type,
				dataType: "json",
				success:function(response){
					if(response.success == 1)
					{
					    alert(response.message);
					    window.location.reload();   
					} else 
						show_toast('Error',response.message,'error');
				}
			});
        }
    });
}
function show_loader(element)
{
	$("#"+element).html('Loading').attr("disabled",true);
}
function hide_loader(element,title)
{
	$("#"+element).html(title).attr("disabled",false);
}
function show_toast(type,message,icon,hideAfter = 3000)
{
	$.toast({
	    heading: type,
	    text: message,
	    showHideTransition: 'fade',
	    icon: icon,
	    hideAfter: hideAfter   
	});
}