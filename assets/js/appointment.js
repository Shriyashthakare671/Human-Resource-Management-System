$(document).ready(function(){
    if($("#calendar").length)
    {
        $("#appointment_date").datepicker({dateFormat: 'dd/mm/yy',minDate: new Date()});
        var date = new Date();
        var m = date.getMonth();
        var y = date.getFullYear();
        var target = $('#calendar');
        setInterval(function(){
          target.fullCalendar('refetchEvents');
        },10000);
        target.fullCalendar({
            defaultView: "agendaDay",
            editable: true,
            selectable: true,
            eventLimit: true,
            header: {
                left: 'prev,next,today',
                center: 'title',
                right: 'agendaDay,agendaWeek,month'
            },
            allDaySlot: false,
            // esources: today_employees,
            refetchResourcesOnNavigate: true,
            events: fetch_events,
            minTime: company_stime,
            maxTime: company_etime,
            slotDuration: '00:5:00',
            nowIndicator: true,
            resources: function(callback){
                var calendar_view = $('#calendar').fullCalendar('getView');
                if(calendar_view.name == "agendaDay") {
                    var date = calendar_view.title === null ? "today" : calendar_view.title;
                    setTimeout(function(){
                        $.ajax({
                            url: base_url+"/today_employees",
                            type: 'post',
                            dataType: 'json',
                            data: {date:$(".fc-center h2").text()},
                            success:function(resources){
                                callback(resources);
                            }
                        });
                    },100);    
                }
            },
            dayClick: function(date, jsEvent, view,resourceObj) {
                var cal_view = $('#calendar').fullCalendar('getView');
                    
                $.ajax({
                    url: base_url+"/check_past_appointment",
                    type: 'post',
                    data: {adate: convertDate(date,"YYYY-MM-DD"),atime:convertDate(date,"HH:mm")},
                    dataType: 'json',
                    success:function(response){
                        if(response.status == 1)
                        {
                            // console.log(resourceObj.id);
                            console.log(resourceObj);
                            if(cal_view.name == "agendaDay" && typeof resourceObj !== "undefined")
                                $("#resourceID").val(resourceObj.id);
                                
                            $("#appointment_date").val(convertDate(date,"DD-MM-YYYY"));
                            set_time(date);
                            $("#appointmentModal").modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                        } else {
                            swal("You can not do appointment in past time");   
                        }
                    }
                });
            },
            eventClick: function(event, element) {
                $.ajax({
                    url: base_url+"/view_appointment",
                    type: 'post',
                    dataType: 'json',
                    data:{appointmentId: event.id},
                    success:function(response){
                        if(response.status == 1) {
                            if(response.appointment_status == 1 && response.isWalkin == "Y")
                            {
                                $("#removeAppointment,#editAppointment,#checkoutBtn").show();
                                $("#removeAppointment,#editAppointment,#checkoutBtn").attr("name",response.appointmentId);
                            } else {

                            }
                            $("#view_appointment_info").html(response.html);
                            $("#viewAppointmentModal").modal({backdrop: 'static',keyboard: false});
                        }
                    }
                });
            },
            eventDrop:function(event,date){
                var view = $('#calendar').fullCalendar('getView');
                let staff_id = 0;
                if(view.name == "agendaDay")
                    staff_id = event.resourceId;

                $.ajax({
                    url: base_url+"appointment_drop",
                    type: 'post',
                    dataType: 'json',
                    data:{
                        appointmentId: event.id,
                        new_sdate: convertDate(event.start,"YYYY-MM-DD"),
                        new_stime: convertDate(event.start,"HH:mm"),
                        new_etime: convertDate(event.end,"HH:mm"),
                        staff_id: staff_id
                    },
                    success:function(response){
                        if(response.status === 0)
                            swal(response.message);
                    }
                });
            },
            viewRender:function(view){
                $(".fc-resource-cell").each(function(){
                    var thisTr = $(this);
                    $.ajax({
                        url: base_url+"/get_staff_color",
                        type: 'post',
                        dataType: 'json',
                        data:{
                            staff_id:$(this).attr("data-resource-id")
                        },
                        success:function(response){
                            thisTr.css({"backgroundColor":response.color,"color":"#FFF"});    
                        }
                    });
                });
                
                var calendar_view = $('#calendar').fullCalendar('getView');
                var curTime1 = new Date(calendar_view.title);
                if(view.name == "agendaDay") 
                {
                    var dt = moment(curTime1, "YYYY-MM-DD HH:mm:ss");
                    $("#dayfromdate").text(dt.format('dddd'));
                } else 
                    $("#dayfromdate").text("");
            }
        });
    }
    $("#customer_phone,#customer_name").keyup(function(){
        if($(this).val().length === 0)
            $("#customer_phone,#customer_name,#customer_email,#customer_note").val('');
    });
    $('.fc-button-prev').click(function(){
        var dt = moment($(".fc-header span.fc-header-title h2").text(),'MMMDD,YYYY').format("YYYY-MM-DD");
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var d = new Date(dt);
        $("#dayfromdate").text(days[d.getDay()]);
    });
    $('.fc-button-next').click(function(){
        var dt = moment($(".fc-header span.fc-header-title h2").text(),'MMMDD,YYYY').format("YYYY-MM-DD");
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var d = new Date(dt);
        $("#dayfromdate").text(days[d.getDay()]);
    });
    
    $("#appointmentForm").validate({
        rules:{
            customer_phone:{
                required: true
            },
            customer_name:{
                required: true
            },
            customer_email:{
                email: true
            }
        },
        messages:{
            customer_phone: {
                required: "<small class='error'><i class='la la-warning'></i> Enter customer phone</small>"
            },
            customer_name: {
                required: "<small class='error'><i class='la la-warning'></i> Enter customer name</small>"
            },
            customer_email:{
                email: "<small class='error'><i class='la la-warning'></i> Customer email is invalid</small>"    
            }   
        }
    });
    $("#appointmentForm").submit(function(e){
        e.preventDefault();
        if($("#appointmentForm").valid())
        {
            var status = 1;
            if($("#cart_list table tbody tr").length <= 0) 
            {
                status = 0;
                swal("Your cart is empty please add at least one service.");
            }
            if($("#cart_list table tbody tr").length > 0)
            {
                $("#cart_list table tbody tr").each(function(){
                    if($(this).find("td:eq(1) select:eq(0)").val() === "")
                    {
                        status = 2;
                        $(this).find("td:eq(1) small.error").html("<i class='la la-warning'></i> Select staff");
                    } else {
                        $(this).find("td:eq(1) small.error").html("");
                    }
                }); 
            }
            if(status == 1)
            {
                var formData = new FormData(this);
                formData.append("customer_phone",$("#customer_phone").val());
                formData.append("customer_name",$("#customer_name").val());

                $.ajax({
                    url: base_url+"/add_appointment",
                    type: 'post',
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend:function(){
                        $("#appointmentForm button[type=submit]").html('Loading...').attr("disabled",true);
                    },
                    success:function(response){
                        if(response.status == 1)
                        {
                            window.location.reload();
                        } else {
                            $("#appointmentForm button[type=submit]").html('Add').attr("disabled",false);
                            swal(response.message);
                        } 
                      }
                });       
            } else if(status == 2) {
              swal("Please select staff");
            }
        }
      });

        $("#walkinForm").validate({
            rules:{
                walkin_phone:{
                    required: true
                },
                walkin_name:{
                    required: true
                },
                walkin_email:{
                    email: true
                }
            },
            messages:{
                walkin_phone:{
                    required: "<small class='error'><i class='la la-warning'></i> Enter customer phone</small>"
                },
                walkin_name: {
                    required: "<small class='error'><i class='la la-warning'></i> Enter customer name</small>"
                },
                walkin_email:{
                    email: "<small class='error'><i class='la la-warning'></i> Enter valid customer email</small>"    
                }   
            }
        });
        $("#walkinForm").submit(function(e){
            e.preventDefault();

            if($("#walkinForm").valid())
            {
                  var status  = 1;
                  var errormsg= "";
                  if($("#walkin_cart_list table tbody tr").length <= 0) {
                        status = 0;
                        errormsg = "Your cart is empty please add at least one service.";
                  }

                  if($("#walkin_cart_list table tbody tr").length > 0)
                  {
                        $("#walkin_cart_list table tbody tr").each(function(){
                              if($(this).find("td:eq(1) select").val() == "")
                              {
                                    status = 2;
                                    $(this).find("td:eq(1) small").html("<i class='la la-warning'></i> Select staff");
                              } else {
                                    $(this).find("td:eq(1) small").html("");
                              }
                        }); 
                  }
                  if(parseFloat($("#remaining_amt").val()) != 0)
                  {
                        status = 0;
                        errormsg = "Remaining amount must be 0";
                  }
                  if(status == 0)
                  {
                        swal(errormsg);
                  }
                  if(status == 1)
                  {
                    var formData = new FormData(this);
                        $.ajax({
                              url: base_url+"/add_walkin",
                              type: 'post',
                              dataType: 'json',
                              data: formData,
                              processData: false,
                              contentType: false,
                              success:function(response){
                                    location.reload();
                              }
                        });
                  }
            }
      });
      $("#removeAppointment").click(function(){
            swal({
                  title: 'Are you sure?',
                  text: "To delete this appointment!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if(result.value) {
                        $.ajax({
                              url: base_url+"/remove_appointment",
                              type: 'post',
                              dataType: 'json',
                              data:{
                                    id: $(this).attr("name")
                              },
                              success:function(response){
                                    if(response.status == 1) {
                                          window.location.reload();
                                    } else {
                                          swal(response.message);
                                    }
                              }
                        });
                  }
            });
      });
      $("#checkoutBtn").click(function(){
            var id = $(this).attr("name");
            $.ajax({
                  url: base_url+"/checkout_appointment",
                  type: 'post',
                  dataType: 'json',
                  data:{appointmentId: id},
                  success:function(response){
                        if(response.status == 1) {
                              $("#checkout_appointment").html(response.html);
                              $("#backViewAppointment,#noShowAppointment,#completeBtn").attr("name",id);
                              $("#checkoutModal").modal({backdrop: 'static',keyboard: false});
                              $("#viewAppointmentModal").modal('hide');
                        }
                  }
            });
      });

      $("#backViewAppointment").click(function(){
            $("#viewAppointmentModal").modal({backdrop: 'static',keyboard: false});
            $("#checkoutModal").modal('hide');
      });

      $("#completeBtn").click(function(){
            var id = $(this).attr("name");
            var discount_id = $("#discount_type").val();
            var discountAmt = $("#discounted_amt").val();
            var payments = [];
            $("#paymentHistory input").each(function(){
                  if($(this).val() != "")
                        payments.push({"payment_id":$(this).attr("data-payment-id"),"amount":$(this).val()});
            });
            if(parseInt($("#remainAmt").text()) < 0 || parseInt($("#remainAmt").text()) > 0)
            {
                  swal("Remaining amount must be 0");
            } else {
                  $.ajax({
                        url: base_url+"/complete_appointment",
                        type: 'post',
                        dataType: 'json',
                        data:{
                              appointmentId: id,
                              discount_id: discount_id,
                              discountAmt: discountAmt,
                              payments: payments,
                        },
                        success:function(response){
                              if(response.status == 1) {
                                    window.location.reload();
                              }
                        }
                  });
            }
      });
      $("#noShowAppointment").click(function(){
        $.ajax({
              url: base_url+"/hide_appointment",
              type: 'post',
              dataType: 'json',
              data:{
                    appointmentId: $(this).attr("name")
              },
              success:function(response){
                if(response.status == 1) {
                      window.location.reload();
                }
              }
        });
      });
      $("#editAppointment").click(function(){
            var aid = $(this).attr("name");
            $("#customer_history").show();
            $.ajax({
                  url: base_url+"/edit_appointment",
                  type: 'post',
                  dataType: 'json',
                  data:{
                        appointmentId: aid
                  },
                  success:function(response){
                        if(response.status == 1) {
                              $("#appointmentID").val(aid);
                              $("#appointment_date").val(convertDate(response.moredatainfo.bookingDate,"DD-MM-YYYY"));
                              if(response.appointments.length > 0)
                                    set_time(response.appointments[0].stime,1);      
                              
                              $("#customer_phone").val(response.moredatainfo.customer_phone);
                              $("#customer_name").val(response.moredatainfo.customer_name);
                              $("#customer_email").val(response.moredatainfo.customer_email);
                              $("#customer_note").val(response.moredatainfo.note);
                              $("#customer_phone,#customer_name,#customer_email,#customer_note").attr("disabled",true);
                              $(".nav-scroller .nav-scroller-item:first").trigger("click");
                              $("#cart_list table tbody").html(response.html);
                              get_cart_total();
                              $("#cart_list").show();
                              $("#appointmentForm button[type=submit]").text("Save");
                              $("#viewAppointmentModal").modal('hide');
                              $("#appointmentModal #appointmentModalLabel").text("Edit Appointment");
                              $("#appointmentModal").modal({backdrop: 'static',keyboard: false});
                        }
                  }
            });
      });
        $("#appointment_date,#appointment_time,#customer_email,#customer_note").focus(function(){
            $("#customer_hints,#customer_name_hints").hide();
        });

      $("#customer_phone").hover(function(){
            $("#customer_hints").show();
      });  
});
function get_sub_services(serviceId,serviceNm,flag = 0)
{
    $("#customer_hints,#customer_name_hints").hide();
    $.ajax({
        url: base_url+"/get_sub_services",
        type: 'post',
        dataType: 'json',
        data: {
            serviceId: serviceId,
            serviceNm: serviceNm,
            flag: flag
        },
        success:function(response){
            if(flag == 1)
                $("#walkin_sub_service_list").html(response.content);
            else 
                $("#sub_service_list").html(response.content);
        }
    });
}
function add_to_cart_multiple(id,json,flag,name)
{
      /* var json_obj = $.parseJSON(json);
      if(json_obj.length > 0)
      {
            for(var i = 0; i < json_obj.length; i ++)
            {
                  add_to_cart(id,json_obj[i].id,name,json_obj[i].caption,json_obj[i].special_price,json_obj[i].duration,flag);
            }
      } */
}
function add_to_cart(serviceId,serviceSubId,serviceNm,caption,price,duration,flag)
{
    let showbusystaff = 0;
    var appointmentDate;
    if($("#showbusystaff").prop("checked") == true)
    {
        showbusystaff = 1;
    }
    var element = parseInt(flag) == 0 ? "cart_list" : "walkin_cart_list";
    $("#"+element).show(500);
    
    if(parseInt(flag) == 0)
    {
        var stime = $("#"+element+" table tbody tr").length == 0 ? $("#appointment_time").val() : "";
        appointmentDate = $("#appointment_date").val();
    } else {
        var stime = company_start_time; 
        appointmentDate = $("#walkin_date").val();
    }
    var no = 0;            
    if($("#"+element+" table tbody tr").length != 0)
    {
        let time = $("#"+element+" table tbody tr:last td:eq(2) span").attr("name");
        stime = add_minutes(time,$("#"+element+" table tbody tr:last td:eq(2) small").text()); 
        ntime = add_minutes(stime,duration); 
        no = $("#"+element+" table tbody tr").length+1; 
    } else {
        no = 1;
        ntime = add_minutes(stime,duration); 
    }

    $.ajax({
        url: base_url+"/add_to_cart",
        type: 'post',
        dataType: 'json',
        data: {
            serviceId: serviceId,
            serviceSubId: serviceSubId,
            serviceNm: serviceNm,
            caption: caption,
            price: price,
            stime: stime,
            duration: duration,
            no:no,
            ntime:ntime,
            appointmentDate: appointmentDate,
            flag: flag,
            showbusystaff: showbusystaff,
            resourceID: $("#resourceID").val(),
            isWalkin: $("#isWalkin").val()
        },
        success:function(response){
            $("#"+element+" table tbody").append(response.content);
            get_cart_total(element);
            if(parseInt(flag) == 1)
                  calculate_walkin_item();
        }
    });
}
function remove_from_cart(cart_id,flag)
{
    var element = flag == 0 ? "cart_list" : "walkin_cart_list";

    $("tr[id=cart_"+cart_id+"]").remove();
    if($("#"+element+" table tbody tr").length > 0)
        $("#appointment_time").trigger("change");
    else 
        $("#"+element).hide();
    
    if(flag == 1)
        calculate_walkin_item();
}
function edit_cart_item(element)
{
      var flag = element == "cart_list" ? 0 : 1;

      if(flag == 0)
      {
            let count = 0;
            $("#"+element+" table tbody tr").each(function(i){
                  let duration = parseInt($(this).find("td:eq(2) small").text());
                  $(this).attr("id","cart_"+count);
                  $(this).find("td:eq(0) a").attr("onclick","remove_from_cart('"+count+"','"+flag+"')");
                  if(count == 0)
                  {
                  		let new_min = add_minutes($("#appointment_time option:selected").text(),duration);
                        $(this).attr("name",new_min);
                        $(this).find("td:eq(2) span").text($("#appointment_time option:selected").text());
                        $(this).find("td:eq(2) span").attr("class",convertTime($("#appointment_time option:selected").text()));
                        $(this).find("td:eq(2) input:first").val(convertTime($("#appointment_time option:selected").text()));
                        $(this).find("td:eq(2) input:eq(1)").val(convertTime(new_min));
                  } else {
                        let new_min = add_minutes($("tr[id=cart_"+(count-1)+"]").attr("name"),duration);
                        $(this).attr("name",new_min);
                        $(this).find("td:eq(2) span").text($("#cart_list table tbody tr[id=cart_"+(i-1)+"]").attr("name"));
                        $(this).find("td:eq(2) span").attr("class",convertTime($("#cart_list table tbody tr[id=cart_"+(i-1)+"]").attr("name")));
                        $(this).find("td:eq(2) input:first").val(convertTime($("#cart_list table tbody tr[id=cart_"+(i-1)+"]").attr("name")));
                        $(this).find("td:eq(2) input:eq(1)").val(convertTime(new_min));
                  }
                  count++;
            });
      }
      get_cart_total(element);
}
function get_cart_total(element = "cart_list")
{
      if($("#"+element+" table tbody tr").length > 0)
      {
            var total = 0;
            $("#"+element+" table tbody tr").each(function(){
                  total += parseFloat($(this).find("td:eq(3) span").text());
            });
            $("#"+element+" h5 span").text(total);
      }
}
function add_minutes(time,minutes)
{
      let added_minute = moment.utc(time,'hh:mm').add(parseInt(minutes),'minutes').format('HH:mm');
      return added_minute;
}

function get_discount_type(discount,flag = 0)
{
      var dis_amt = flag == 0 ? "discounted_amt" : "walkin_discounted_amt";
      var dis_txt = flag == 0 ? "disAmt" : "walkin_cart_list table tfoot tr:eq(1) td:eq(1) span";
      var sub_amt = flag == 0 ? "subAmt" : "walkin_cart_list table tfoot tr:first td:eq(1) span";
      var tot_amt = flag == 0 ? "totAmt" : "walkin_cart_list table tfoot tr:last td:eq(1) span";
      var remain  = flag == 0 ? "remainAmt" : "walkin_cart_list table tfoot tr:last td:eq(1) span";
      if(discount == "")
      {
            $("#"+dis_amt).val('');
            $("#"+dis_txt).text("0");
            $("#"+tot_amt).text($("#"+sub_amt).text());
            $("#"+remain).text($("#"+sub_amt).text());
            if(flag == 1)
                  $("#remaining_amt").val(parseFloat($("#"+sub_amt).text()));
      } else {
            var type = discount.split("_");
            if(parseInt(type[1]) == 1)
            {
                  var disAmt = (parseFloat($("#"+sub_amt).text())*parseFloat(type[2]))/100;      
                  $("#"+dis_amt).val(disAmt);
                  $("#"+dis_txt).text(disAmt);
                  $("#"+tot_amt).text(parseFloat($("#"+sub_amt).text())-disAmt);
                  $("#"+remain).html(parseFloat($("#"+sub_amt).text())-disAmt);
                  if(flag == 1)
                        $("#remaining_amt").val(parseFloat($("#"+sub_amt).text())-disAmt);
            } else {
                  var disAmt = (parseFloat($("#"+sub_amt).text())-parseFloat(type[2]));
                  $("#"+dis_amt).val(type[2]);
                  $("#"+dis_txt).text(type[2]);
                  $("#"+tot_amt).text(parseFloat($("#"+sub_amt).text())-type[2]);
                  $("#"+remain).html(parseFloat($("#"+sub_amt).text())-type[2]);
                  if(flag == 1)
                        $("#remaining_amt").val(parseFloat($("#"+sub_amt).text())-type[2]);
            }
      }
}
function check_digit(e)
{
    var total = parseFloat($("#totAmt").text());
    var payment = 0;
    $("input[name^=payment_type_amt]").each(function(){
        if($.trim($(this).val()) != "")
        {
            payment = payment + parseFloat($(this).val());
        }
    });
    $("#remainAmt").html(total-payment);
}
function check_walkin_digit(e)
{
      var total = parseFloat($("#walkin_cart_list table tfoot tr:last td:eq(1) span").text());
      var payment = 0;
      $("input[name^=walkin_payment_type_amt]").each(function(){
            if($.trim($(this).val()) != "")
            {
                  payment = payment + parseFloat($(this).val());
            }
      });
      $("#remaining_amt").val(total-payment);
}
function get_customer_info(phone,flag = 0,text = "phone")
{
      var element = flag == 0 ? "customer_hints" : "walkin_customer_hints"; 
      if(flag == 0 && text == "phone")
            element = "customer_hints";

      if(flag == 0 && text == "name")
            element = "customer_name_hints";
            
      if(phone == "")
      {
            $("#"+element).html("");
            $("#"+element).css({"border": "none","padding":"0px"});
      } else {
            $.ajax({
                  url: base_url+"/get_customer_info",
                  type: 'post',
                  dataType: 'json',
                  data: {phone:phone,flag:flag,text:text},
                  success:function(response){
                        $("#"+element).show();
                        $("#"+element).html(response.content);
                        $("#"+element).css({"border": "1px solid #efefef","padding":"5px"});
                  }
            });     
      }
}
function set_customer_info(phone,name,email,flag,note)
{     
      if(flag == 0)
      {
            $("#customer_phone").val(phone);
            $("#customer_name").val(name);
            $("#customer_email").val(email);
            $("#customer_note").val(note);
            $("#customer_hints").html("");
            $("#customer_hints").css({"border": "none","padding":"0px"});
            $("#customer_name_hints").html("");
            $("#customer_name_hints").css({"border": "none","padding":"0px"});
      } else {
            $("#walkin_phone").val(phone);
            $("#walkin_name").val(name);
            $("#walkin_email").val(email);
            $("#customer_note").val(note);
            $("#walkin_customer_hints").html("");
            $("#walkin_customer_hints").css({"border": "none","padding":"0px"});
      }
      $("#customer_history").show();
}
function clear_appointment()
{
      $("#appointment_date,#customer_phone,#customer_name,#customer_email,#customer_note,#appointmentID,#resourceID").val('');
      $("#appointment_date,#customer_phone,#customer_name,#customer_email,#customer_note").attr("disabled",false);
      $("#appointment_time").val($("#appointment_time option:first").val());
      $("#sub_service_list").html('');
      $("#cart_list table tbody").html('');
      $("#cart_list,#customer_hints,#customer_name_hints").hide();
      $("#customer_history").hide();
      $("#appointmentModalLabel").text("New Appointment");
      $("#appointmentForm button[type=submit]").text("Add");
      $("#isWalkin").val("0");
}
function clear_walkin()
{
      $("#walkin_date,#walkin_phone,#walkin_name,#walkin_email,#walkin_note").val('');
      $("#walkin_sub_service_list").html('');
      $("#walkin_cart_list table tbody").html('');
      $("#walkin_cart_list").hide();
}
function convertDate(date,format)
{
      var fdate = moment(date).format(format);
      return fdate;
}
function set_time(date,flag = 0)
{
      // alert(date);
      $("#appointment_time option").each(function(){  
            if(flag == 0)
            {
                  if($.trim($(this).text()) == $.trim(convertDate(date,"hh:mm A")))
                        $(this).prop("selected",true);
            } else {
                  if($.trim($(this).val()) == date)
                        $(this).prop("selected",true);
            }
      });
}
function open_walkin()
{
      var date = new Date();
      let mont = (date.getMonth()+1) < 10 ? "0"+(date.getMonth()+1) : (date.getMonth()+1);
      $("#walkin_date").val(date.getDate()+"-"+mont+"-"+date.getFullYear());
      $("#isWalkin").val("1");
      $("#walkinModal").modal({backdrop: 'static',keyboard: false});
}
function calculate_walkin_item()
{
    var element = "walkin_cart_list table tfoot tr:first td:eq(1) span";
    var discount = "walkin_cart_list table tfoot tr:eq(1) td:eq(1) span";
    
    $("#"+element).text($("#walkin_cart_list h5 span").text());
    $("#walkin_cart_list table tfoot tr:last td:eq(1) span").text(parseFloat($("#"+element).text())-parseFloat($("#"+discount).text()));
    $("#remaining_amt").val(parseFloat($("#"+element).text())-parseFloat($("#"+discount).text()));
}
function convertTime(time)
{
	var dt = moment(time, ["h:mm A"]).format("HH:mm:ss");
	return dt;
}
function formatTime(time)
{
    var dt = moment(time, ["HH:mm:ss"]).format("h:mm A");

    var date = moment(dt, ["h:mm A"]).format("h");
    if(parseInt(date) < 10)
        date = "0"+date;

    var whole_date = moment(dt, ["h:mm A"]).format("mm A");
    dt = date+":"+whole_date;

    return dt;
}
function get_selected_staff_name(no,flag)
{
    let showbusystaff = 0;
    if($("#showbusystaff").prop("checked") == true)
    {
        swal({
            title: 'Are you sure?',
            text: "This staff is already busy are you still want to book appointment?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if(result.value) {
                $("#selected_staff_name_"+no).val(($("#selected_staff_id_"+no+" option:selected").text()));
                $("#selected_staff_color_"+no).val(($("#selected_staff_id_"+no+" option:selected").attr("data-color")));        
                $("#is_busy_staff_"+no).val("Y");
            } else {
                $("#selected_staff_id_"+no).val($("#selected_staff_id_"+no+" option:first").val());
                $("#selected_staff_name_"+no).val("");
                $("#selected_staff_color_"+no).val("");        
            }
        });
    } else {
        $("#selected_staff_name_"+no).val(($("#selected_staff_id_"+no+" option:selected").text()));
        $("#selected_staff_color_"+no).val(($("#selected_staff_id_"+no+" option:selected").attr("data-color")));
    }
}
function get_customer_history()
{
  if($("#customer_phone").val() != "")
  {
    $.ajax({
          url: base_url+"get_customer_history",
          type: 'post',
          dataType: 'json',
          data: {phone:$("#customer_phone").val()},
          success:function(response){
            if(response.status == 1)
            {
              $("#customer_history_info").html(response.html);
              $("#customerHistoryModal").modal({
                      backdrop: 'static',
                      keyboard: false
                  });
            } else {
              swal(response.message);
            }
          }
    });        
  }
}
function change_appointment_date(status,val)
{
    if(parseInt($("#cart_list table tbody tr").length) > 0)
    {
        var element = "cart_list";
        let no = 0;
        let showbusystaff = 0;
        if($("#showbusystaff").prop("checked") == true)
        {
            showbusystaff = 1;
        }

        if(status == 0)
        {
            let count = 0;
            $("#cart_list table tbody tr").each(function(i){
                let duration = parseInt($(this).find("td:eq(2) small").text());
            
                $(this).attr("id","cart_"+count);
                $(this).find("td:eq(0) a").attr("onclick","remove_from_cart('"+count+"',0)");
                if(count == 0)
                {
                    $(this).find("td:eq(2) span").text($("#appointment_time option:selected").text());
                    $(this).find("td:eq(2) span").attr("class",convertTime($("#appointment_time option:selected").text()));
                    $(this).find("td:eq(2) span").attr("name",convertTime($("#appointment_time option:selected").text()));
                    let new_min = add_minutes($("#appointment_time").val(),duration);
                    $(this).find("td:eq(2) input:first").val(convertTime($("#appointment_time option:selected").text()));
                    $(this).find("td:eq(2) input:eq(1)").val(convertTime(new_min));
                    $(this).attr("name",new_min+":00");
                } else {
                    let new_min = add_minutes($("tr[id=cart_"+(count-1)+"]").attr("name"),duration);
                    $(this).attr("name",new_min+":00");
                    $(this).find("td:eq(2) span").text(formatTime($("#cart_list table tbody tr[id=cart_"+(i-1)+"]").attr("name")));
                    $(this).find("td:eq(2) span").attr("class",convertTime($("#cart_list table tbody tr[id=cart_"+(i-1)+"]").attr("name")));
                    $(this).find("td:eq(2) span").attr("name",convertTime($("#cart_list table tbody tr[id=cart_"+(i-1)+"]").attr("name")));
                    $(this).find("td:eq(2) input:first").val(convertTime($("#cart_list table tbody tr[id=cart_"+(i-1)+"]").attr("name")));
                    $(this).find("td:eq(2) input:eq(1)").val(convertTime(new_min));
                }
                count++;
            });
        }
        $("#cart_list table tbody tr").each(function(){
            var old_staff = $(this).find("td:eq(1) select").val();

            var thisTr = $(this);
            if(status == 0 && no == 0)
            {
                stime = val; 
            } else {
                let time = $(this).find("td:eq(2) span").attr("name");
                stime = time;    
            } 
            let duration = parseInt($(this).find("td:eq(2) small").text());
            if(!isNaN(duration))
            {
                ntime = add_minutes(stime,duration);  
            } else {
                ntime = "00:00 AM";
                duration = "5";  
            }
            let serviceId = $(this).find("td:eq(0) input:eq(0)").val();
            let serviceSubId = $(this).find("td:eq(0) input:eq(1)").val();
            let serviceNm = $(this).find("td:eq(0) input:eq(2)").val();
            let caption = $(this).find("td:eq(0) input:eq(3)").val();
            let price = $(this).find("td:eq(3) input").val();

            $.ajax({
                url: base_url+"/change_appointment_date",
                type: 'post',
                dataType: 'json',
                data: {
                    serviceId: serviceId,
                    serviceSubId: serviceSubId,
                    serviceNm: serviceNm,
                    caption: caption,
                    price: price,
                    stime: stime,
                    duration: duration,
                    no:no,
                    ntime:ntime,
                    appointmentDate: $("#appointment_date").val(),
                    flag: 1,
                    showbusystaff: showbusystaff,
                    isWalkin: $("#isWalkin").val()
                },
                success:function(response){
                    var option = "";
                    option += "<option value=''>Staff</option>";
                    for(var i = 0; i < response.length; i ++)
                    {
                        if(parseInt(response[i].status) == 1)
                        {
                            if(old_staff == response[i].id)
                                option +="<option value='"+(response[i].id)+"' data-color='"+(response[i].color)+"' selected>"+(response[i].name)+"</option>";
                            else 
                                option +="<option value='"+(response[i].id)+"' data-color='"+(response[i].color)+"'>"+(response[i].name)+"</option>";
                        }
                    }
                    thisTr.find("td:eq(1) select").html(option);
                }
            });
            no++;
        });
    }
}
function somethingAsynchonous(a,b,c)
{
    setTimeout(function(){
        var calendar_view = $('#calendar').fullCalendar('getView');
        if(calendar_view.name == "agendaDay") 
        {
            $.ajax({
                url: base_url+"today_employees",
                type: 'post',
                dataType: 'json',
                data: {date:calendar_view.title},
                success:function(response){
                    successCallback(response);
                }
            });
        }        
    },500);
}
function successCallback(employees)
{
    return employees;
}