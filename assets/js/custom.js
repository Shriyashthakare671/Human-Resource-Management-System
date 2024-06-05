$(document).ready(function(){
	$('#shift_stime,#shift_etime').datetimepicker({
        format: 'LT'
    });
	// setTimeout(function(){$(".alert-success").hide(1000);},3000);
	var page_title = document.title.split("|");

	$("ul#menu-list li").each(function(){
		if($.trim($(this).text()) == $.trim(page_title[1]))
			$(this).addClass("active");
		else 
			$(this).removeClass("active");
	});
	
	$("#customer_id").change(function(){
		$("#mobile").val($("#customer_id option:selected").attr("data-number"));
		$("#customer_name").val($("#customer_id option:selected").attr("data-name"));
	});

    if($("#customerTbl").length)
    {
  //       $('#customerTbl').DataTable({
		// 	"processing": true,
  //           "serverSide": true,
  //           "ajax":{
  //               url : base_url+"Customer/get_ajx_customers",
  //               dataSrc: 'data',
	 //            deferLoading: 10,
  //               type: "post",  
  //               error: function(){
  //                   $(".employee-grid-error").html("");
  //                   $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
  //                   $("#employee-grid_processing").css("display","none");
 
  //               }
  //           },
  //           'columnDefs': [ {
		//         'targets': [0,-1], /* column index */
		//         'orderable': false, /* true or false */
		//     }]
		// });
    }
    
    $(".parent_service").each(function(){
    	var is_all_child_checked = 1;
    	var parent = $(this);
    	parent.find(".child_checkbox").each(function(){
    		if($(this).prop("checked") === false)
    		{
    			is_all_child_checked = 0;
    		}
    	});
    	if(is_all_child_checked == 1)
    		parent.find("input[id^=stateCheck]").prop("checked",true);
    });

    $("input[id^=stateCheckChild]").click(function(){
        if($(this).prop("checked") === true) 
        {
            var old_val = $("#selected_services").val();
			if(old_val == "")
				$("#selected_services").val($(this).val());
			else 
				$("#selected_services").val(old_val+","+$(this).val());
        } else {
            var selected_services = $("#selected_services").val() == "" ? [] : $("#selected_services").val().split(",");
            removeAllElements(selected_services, $(this).val());
            $("#selected_services").val(selected_services);
        }
    });
	$(".parent_checkbox").click(function(){
	    var parent_flag = "Y";
	    $(".parent_checkbox").each(function(){
	        if($(this).prop("checked") == false)
	            parent_flag = "N";
	    });
	    $("#is_all_selected").val(parent_flag);
	    if(parent_flag == "N")
	    {
	        $("#stateCheckall").prop("checked",false);
	    } else {
	        $("#stateCheckall").prop("checked",true);
	    }
		if($(this).prop("checked") == true) {
			$(this).closest(".parent_service").find(".child_checkbox").prop("checked",true);
			var arr = [];
			$(this).closest(".parent_service").find(".child_checkbox").each(function(){
				arr.push($(this).val());
			});
			if(arr.length > 0){
				var old_val = $("#selected_services").val();
				if(old_val == "")
					$("#selected_services").val(arr.join(","));
				else 
					$("#selected_services").val(old_val+","+arr.join(","));
			}
		} else {
			$(this).closest(".parent_service").find(".child_checkbox").prop("checked",false);
			var arr = [];
			var selected_services = $("#selected_services").val() == "" ? [] : $("#selected_services").val().split(",");
			
			$(this).closest(".parent_service").find(".child_checkbox").each(function(){
				if($.inArray($(this).val(),selected_services) >= 0)
					removeAllElements(selected_services, $(this).val());
			});
			$("#selected_services").val(selected_services);
		} 
	});
	
	if($("#settingForm").length)
	{
		$('#start_time').datetimepicker({
	        format: 'LT',
	        // viewMode: 'months',
	        // showMeridian: true
	    });
	    $('#end_time').datetimepicker({
	        format: 'LT'
	    });
		$("#settingForm").validate({
			rules:{
				company_name:{
					required: true
				},
				company_phone:{
					required: true
				},
				start_time:{
					required: true
				},
				end_time:{
					required: true
				}
			},
			messages:{
				company_name:{
					required: "<small class='error'><i class='la la-warning'></i> Enter company name</small>"
				},
				company_phone:{
					required: "<small class='error'><i class='la la-warning'></i> Enter company phone</small>"
				},
				start_time:{
					required: "<small class='error'><i class='la la-warning'></i> Select start time</small>"
				},
				end_time:{
					required: "<small class='error'><i class='la la-warning'></i> Select end time</small>"
				}
			}
		});
	}

	// Staff
	if($("#staffForm").length)
	{
		$("#staffForm").validate({
			rules:{
				fname:{
					required: true
				},
				mobile:{
					required: true
				},
				password:{
					required: true
				},
				cpassword:{
					required: true,
					equalTo: "#password"
				}
			},
			messages:{
				fname:{
					required: "<small class='error'><i class='la la-warning'></i> Enter first name</small>"
				},
				mobile:{
					required: "<small class='error'><i class='la la-warning'></i> Enter mobile no</small>"
				},
				password:{
					required: "<small class='error'><i class='la la-warning'></i> Enter password</small>"
				},
				cpassword:{
					required: "<small class='error'><i class='la la-warning'></i> Enter confirm password</small>",
					equalTo: "<small class='error'><i class='la la-warning'></i> Confirm password & password must be same</small>"
				}
			}
		});
		if($.trim($("h5.card-header:first").text()) == "Edit Staff")
		{
			$("#staffForm #password").rules('remove','required');
			$("#staffForm #cpassword").rules('remove','required');
		}
	}

	// Group
	if($("#groupForm").length)
	{
		$("#groupForm").validate({
			rules:{
				name:{
					required: true
				},
				color:{
					required: true
				}
			},
			messages:{
				name:{
					required: "<small><i class='la la-warning'></i> Enter service group name</small>"
				},
				color:{
					required: "<small><i class='la la-warning'></i> Select color</small>"
				}
			}
		});
	}

	// Customer
	// $("#customerList").DataTable();
	if($("#customerForm").length)
	{
		$("#customerForm").validate({
			rules:{
				name:{
					required: true
				},
				mobile:{
					required: true
				},
				email:{
					email: true
				}
			},
			messages:{
				name:{
					required: "<small><i class='la la-warning'></i> Enter customer name</small>"
				},
				mobile:{
					required: "<small><i class='la la-warning'></i> Enter customer mobile no</small>"
				},
				email:{
					email: "<small><i class='la la-warning'></i> Enter valid customer email</small>"	
				}
			}
		});
	}

	// Payment Type
	// $("#paymentTypeList").DataTable();
	if($("#pTypeForm").length)
	{
		$("#pTypeForm").validate({
			rules:{
				name:{
					required: true
				}
			},
			messages:{
				name:{
					required: "<small><i class='la la-warning'></i> Enter payement type name</small>"
				}
			}
		});
	}

	// Discount Type
	// $("#discountTypeList").DataTable();
	if($("#dTypeForm").length)
	{
		$("#dTypeForm").validate({
			rules:{
				name:{
					required: true
				},
				type:{
					required: true
				},
				value:{
					required: true
				}
			},
			messages:{
				name:{
					required: "<small><i class='la la-warning'></i> Enter discount name</small>"
				},
				type:{
					required: "<small><i class='la la-warning'></i> Select discount type</small>"
				},
				value:{
					required: "<small><i class='la la-warning'></i> Enter discount value</small>"
				}
			}
		});
	}

	// Discount Type
	// $("#serviceList").DataTable({
		
	// });
	if($("#serviceForm").length)
	{
		$("#serviceForm").validate({
			rules:{
				service_group_id:{
					required: true
				},
				name:{
					required: true
				},
				ptype:{
					required: true
				}
			},
			messages:{
				service_group_id:{
					required: "<small><i class='la la-warning'></i> Select service group</small>"
				},
				name:{
					required: "<small><i class='la la-warning'></i> Enter service name</small>"
				},
				ptype:{
					required: "<small><i class='la la-warning'></i> Select price type</small>"
				}
			}
		});
	}
	
	if($("#brandForm").length)
	{
		$("#brandForm").validate({
			rules:{
				name:{
					required: true
				}
			},
			messages:{
				name:{
					required: "<small><i class='la la-warning'></i> Enter name</small>"
				}
			}
		});
	}
	if($("#categoryForm").length)
	{
		$("#categoryForm").validate({
			rules:{
				name:{
					required: true
				}
			},
			messages:{
				name:{
					required: "<small><i class='la la-warning'></i> Enter name</small>"
				}
			}
		});
	}
	if($("#productForm").length)
	{
		$("#productForm").validate({
			rules:{
				name:{
					required: true
				},
				brand_id:{
					required: true
				},
				category_id:{
					required: true
				},
				rprice:{
					required: true	
				}
			},
			messages:{
				name:{
					required: "<small><i class='la la-warning'></i> Enter name</small>"
				},
				brand_id:{
					required: "<small><i class='la la-warning'></i> Select brand</small>"
				},
				category_id:{
					required: "<small><i class='la la-warning'></i> Enter category</small>"
				},
				rprice:{
					required: "<small><i class='la la-warning'></i> Enter retail price</small>"	
				}
			}
		});
	}
		
    $("#sale").change(function(){
		if($(this).val() == "Y")
			$(".retailSale").show(500);
		else 
			$(".retailSale").hide(500);

	});
});
function removeAllElements(array,elem)
{
	var index = array.indexOf(elem);
    while (index > -1) {
        array.splice(index, 1);
        index = array.indexOf(elem);
    }	
}

function remove_price_row(id)
{
	$("#priceType_"+id).remove();
}
function remove_staff(id)
{
	remove_record(id,'remove_staff',"Once you removed this staff than you can not recover!");
}
function remove_group(id,photo)
{
	remove_record(id,'remove_group',"Once removed this service group than you can not recover!",photo);
}
function remove_customer(id)
{
	remove_record(id,'remove_customer',"Once you removed this customer than you can not recover!");
}
function remove_payment_type(id)
{
	remove_record(id,'remove_payment_type',"Once removed this payment type than you can not recover!");
}
function remove_discount_type(id)
{
	remove_record(id,'remove_discount_type',"Once removed this discount type than you can not recover!");
}
function remove_service(id)
{
	remove_record(id,'remove_service',"Once removed this service than you can not recover!");
}
function remove_brand(id)
{
	remove_record(id,'remove_brand',"Once removed this brand than you can not recover!");
}
function remove_category(id)
{
	remove_record(id,'remove_category',"Once removed this category than you can not recover!");
}
function remove_product(id)
{
	remove_record(id,'remove_product',"Once removed this product than you can not recover!");
}
function remove_record(id,url,title,photo = "")
{
	swal({
		title: 'Are you sure?',
        text: title,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
   	}).then((result) => {
        if(result.value) {
        	$.ajax({
				url: base_url+url,
				type: 'post',
				data:{
					id: id,
					photo: photo
				},
				success:function(response){
					window.location.reload();
				}
			});
        }
    });
}
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function get_checked_checkbox()
{
	var arr = [];
	$("input[id^=stateCheckChild]").each(function(){
		if($(this).prop("checked") == true)
			arr.push($(this).val());
	});	
	return arr;
}
function remove_photo(photo)
{
    swal({
		title: 'Are you sure?',
        text: "Once you removed it can not recover!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!'
   	}).then((result) => {
        if(result.value) {
        	$.ajax({
        		url: base_url+"Admin/remove_photo",
        		type: 'post',
        		dataType: 'json',
        		data:{photo:photo},
        		success:function(response){
        			if(response.status == 1)
        			    location.reload();
        		    else 
        		        swal(response.message);
        		}
        	});
        }
    });
}
function change_company_status(company_id,status)
{
	$.ajax({
		url: base_url+"change_company_status",
		type: 'post',
		dataType: 'json',
		data:{company_id:company_id,status:status},
		success:function(response){
			if(response.status == 1)
			{
				location.reload();		
			} else {
				swal("Oops something went wrong please try again later.");
			}
		}
	});
}
function get_sub_service(id)
{
	$.ajax({
		url: base_url+"get_sub_service",
		type: 'post',
		dataType: 'json',
		data:{service_id:id,service_nm: $("#group_id option:selected").text()},
		success:function(response){
			if(response.status == 1)
			{
				location.reload();
			}
		}
	});
}

function get_report_card()
{
	if($("#customer_phone").val() != "")
  	{
    	$.ajax({
          	url: base_url+"get_report_card",
          	type: 'post',
          	dataType: 'json',
          	data: {phone:$("#customer_phone").val()},
          	success:function(response){
	        	if(response.status == 1)
	            {
	              	$("#customerReportCardModal .modal-body").html(response.html);
	              	$("#customerReportCardModal").modal({
	              		backdrop: 'static',
	                   	keyboard: false
	               	});
	            } else {
	              	swal(response.message);
	            }
	      	}
    	}); 
    } else {
    	swal("Customer Phone is required");
    }       
}
function remove_report_card(id)
{
	remove_record(id,'remove_report_card',"Once removed this report card group than you can not recover!");	
}