var selectedDate;

function Dismiss(iid) {

    var o = "/Schedule/DismissNotification/?notiId=" + iid;


    $.ajax({url: o, type: 'POST',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        success: function(result){
        $('#' + id).hidden();
        }});


}

$(function() {
    $('[data-toggle="popover"]').popover();
      $('.select2').select2({dropdownParent: $(".modal")});
});
function LoadAppointment() {
    var d = moment();

    if (typeof res != 'undefined')
    {

        addNewAppointment(d, res.id);

    }
    else {
        addNewAppointment(d, '');
    }

}
function addNewAppointment(date, resId) {
    $.ajaxSetup({ cache: false });
    var dateAppointment = encodeURIComponent(date.format("DD-MMM-Y"));
    // alert(dateAppointment);
    $("#appPlaceholder").load("/Schedule/AddAppointment?date=" + dateAppointment+"&rId="+resId+"&v=" +guid(),
         function () {
             $('#appointmentModal').modal('show');

             $("#DateString").val('');
             $("#DateString").val(dateAppointment);
             $('#StartTime').datetimepicker('setDate', new Date(date.format('YYYY-MM-DD HH:mm:ss')));
             $('#EndTime').datetimepicker('setDate', new Date(date.add(1, 'hour').format('YYYY-MM-DD HH:mm:ss')));

             $('#appointmentModal form').removeClass('edit2');
             $('#note-area').html('');
            $("#appointmentItems").html(' ');
            $('#appointmentTotal').html(' ');
         });


};

function LoadEvent() {
    //var currentDate = moment().format("DD/MM/YYYY HH:mm").toString();
    $.ajaxSetup({ cache: false });
    var dateAppointment = encodeURIComponent(selectedDate.format());
    $("#appEventPlaceholder").load("/Schedule/AddEvent?date=" + dateAppointment,
        function () {
            $('#eventModal').modal('show');
        });
}
function Datechange() {
    var Date = $("#DateString").val();
    //console.log(Date);
    document.getElementById("DateEndString").setAttribute("value",Date);
    //var Date1 = $("#DateEndString").val();
    //console.log(Date1);


}

//stop the browser caching
function guid() {
    function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
          .toString(16)
          .substring(1);
    }
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
      s4() + '-' + s4() + s4() + s4();
}

function editAppointment(event) {
    $.ajaxSetup({ cache: false });
    if (event.AppointmentType == "Appointment") {
        $("#appPlaceholder").load("/Schedule/EditAppointment/?id=" + event.id + "&appointmentType=" + event.AppointmentType +"&uuid=" + guid(),
            function (response, status, xhr) {
                if (status == "success") {
                    //Loading this way means that the load is completed first, before showing the display.
                    $('#appointmentModal').modal('show');
                }
            });
    }
    else if (event.AppointmentType == "Event") {

        $("#appEventPlaceholder").load("/Schedule/Edit/" + event.id + "?appointmentType=" + event.AppointmentType,
      function (response, status, xhr) {
          if (status == "success") {
              //Loading this way means that the load is completed first, before showing the display.
              $('#eventModal').modal('show');
          }

      });
    }
}

function setHeaderDate() {
    if( $('#calendar').length ) {
        var moment = $('#calendar').fullCalendar('getDate');
        selectedDate = moment;
        $('#DisplayDate').text(moment.format('dddd DD-MMM-YYYY'));
    }
};

if( $('#123 .input-group.date').length ) {
    $('#123 .input-group.date').datepicker(
    {
        todayHighlight: true,
        showOnFocus:true
    }).on('changeDate', function(ev) {
        selectedDate = moment( $('#123 .input-group.date').datepicker('getDate'));
        $('#DisplayDate').text(moment(selectedDate).format('dddd DD-MMM-YYYY'));
        $("#calendar").fullCalendar('gotoDate', selectedDate);
        $('#123 .input-group.date').datepicker('hide');

    });
}

$(function () {

    if( $("#openerCal").length ) {
        $("#openerCal").click(function () {
            $("#Mydialog").dialog({ autoOpen: true, modal: true, width: 256 });
        });
    }
    
    if( $("#navLeft").length ) {
        $("#navLeft").click(function () {
            $('#calendar').fullCalendar('prev');
            setHeaderDate();
        });
    }

    if( $("#navToday").length ) {
        $('#navToday').click(function () {
            //$('#calendar').fullCalendar('option', 'groupByDateAndResource', false);
            $('#calendar').fullCalendar('today');
            setHeaderDate();
        });
    }

    if( $("#navRight").length ) {
        $("#navRight").click(function () {
            $('#calendar').fullCalendar('next');
            setHeaderDate();
        });
    }

    if( $("#viewDay").length ) {
        $("#viewDay").click(function () {
            //$('#calendar').fullCalendar('option', 'groupByDateAndResource', false);
            $('#calendar').fullCalendar('changeView', "agendaDay");
        });
    }

    if( $("#viewWeek").length ) {
        $("#viewWeek").click(function () {
            //$('#calendar').fullCalendar('option', 'groupByDateAndResource', false);
            $('#calendar').fullCalendar('changeView', "agendaWeek", moment(selectedDate).format('YYYY-MM-DD'));

        });
    }

    if( $("#viewMonth").length ) {
        $("#viewMonth").click(function () {
            $('#calendar').fullCalendar('changeView', "month");
        });
    }

    if( $("#viewTimeLine").length ) {
        $("#viewTimeLine").click(function () {
            $('#calendar').fullCalendar('changeView', "timelineFiveDays");
        });
    }

});

$(function() {
    tinymce.init({
        selector: 'textarea.tinymce-textarea'
    });
});

$(function () {

    if( $("#tabsNew").length ) {
        $("#tabsNew").tabs();
    }
    if( $("#PetName").length ) {
        $("#PetName").autocomplete({
            source: "",
            minLength: 3,
            position: { collision: "fit", within: window },
            select: function (event, ui) {

                if (ui.item.Price > 0) {

                    if (confirm('Add ' + ui.item.PetBreedName + ' Service?'))
                        addNewRow(ui.item.PetBreedName + ' Service', ui.item.Price, 1, '');

                }

                $("#PetName").val(ui.item.PetBreedLastName);
                $("#petId").val(ui.item.Id);
                $("#clientId").val(ui.item.ClientId);
                toggleMag();
                // Go and get client and pet rating
                $("#rating").load('/Client/Rating?clientId=' + ui.item.ClientId + '&petId=' + ui.item.Id);
                return false;
            }
        }).data("uiAutocomplete")
            ._renderItem = function (ul, pet) {
                return $("<li></li>")
                    .data("ui-autocomplete-item", pet)
                    .append("<table  class='no-border'><tr><td><i class='" + pet.Alert + "' title='" + pet.AlertMessage + "'></i><a href='#'>" + pet.PetBreedLastName + "</a></td></tr></table>")
                    .appendTo(ul);

        };
    }
});

function loadClient() {
    // var cId = $("#clientId").val();

    // if (cId.length > 0) {
    //     window.location.replace("/Client/Edit/" + cId);

    // } else {
    //     alert('You must select a client');
    // }
}

function loadResource() {
    var cId = $("#ResourceId").val();

    if (cId.length > 0) {
        window.location.replace("/User/Edit/" + cId);

    } else {
        alert('You must select a resource');
    }
}

if( $("#ResourceName2").length ) {
    $("#ResourceName2").autocomplete({
        source: "/Schedule/ResourceSearch",
        minLength: 3,
        select: function (event, ui) {
            $("#ResourceName2").val(ui.item.ResourceName);
            $("#ResourceId").val(ui.item.Id);
            return false;
        }
    }).data("uiAutocomplete")._renderItem = function (ul, resource) {
        return $("<li></li>")
            .data("item.autocomplete", resource)
            .append("<a>" + resource.ResourceName + "</a>")
            .appendTo(ul);

    };
}

function toggleMag() {
    $("#petMag").toggle();
}

$(function () {
    if( $("#dialogInfo").length ) {
        $("#dialogInfo").dialog({
            autoOpen: false,
            title: "Pet Search Information",
            modal: true,
            resizable: false
        });
    }
});
function openInformation() {
    $("#dialogInfo").dialog('open');
}

function ValidateAppointment() {
    var appointmentIsValid = false;

    var startDate = moment($("#DateString").val(), "D-MMM-YYYY").format("D-MMM-YYYY");
    var endDate = moment($("#DateEndString").val(), "D-MMM-YYYY").format("D-MMM-YYYY");
    var endTime = moment($("#EndTime").val(), "h:mm A").format("h:mm A");
    var startTime = moment($("#StartTime").val(), "h:mm A").format("h:mm A");
    var startDateTime = moment(startDate + ' ' + startTime, "D-MMM-YYYY h:mm A").format("D-MMM-YYYY h:mm A");
    var endDateTime = moment(endDate + ' ' + endTime, "D-MMM-YYYY h:mm A").format("D-MMM-YYYY h:mm A");
    var pet_id2 = $('#pet_id').val();
    var startDate2= $('#DateString').val();
    var startTime2 = $('#StartTime').val();
    var endTime2 = $('#EndTime').val();

    if(typeof(startDate2) == "undefined" || startDate2 == '' || typeof(startTime2) == "undefined" || startTime2 == '' || typeof(endTime2) == "undefined" || endTime2 == '')
    { 
        appointmentIsValid = false;
        alert("Error: Date & time are required");
        return false;

    }
    else if (moment(startDateTime, "D-MMM-YYYY h:mm A").isAfter(moment(endDateTime, "D-MMM-YYYY h:mm A")) || moment(startDateTime, "D-MMM-YYYY h:mm A").isSame(moment(endDateTime, "D-MMM-YYYY h:mm A"))) {
        appointmentIsValid = false;
        alert("Error: End time must be after start time.");
        return false;
    }
    else if(typeof(pet_id2) == "undefined" || pet_id2 == null)
    {
        appointmentIsValid = false;
        alert("Error: Please select a pet from list");
        return false;
    } else {
        appointmentIsValid = true;

    }
    if (moment(startTime, "h:mm A").isAfter(moment(endTime, "h:mm A"))) {
        appointmentIsValid = false;
        document.getElementById("EndTime").value = '';
        alert("Error: End time must be after Start time.");

    }

    // if ($("#petId").val() == "") {
    //     appointmentIsValid = false;
    //     alert("Error: Please select a pet from list");
    // }

    if (appointmentIsValid) {
        // $("form:first").submit();
        $('#appointmentModal').find('form').submit();
    }
    else {
        return false;
    }

}

function validateSetting() {
    var appointmentIsValid = false;

    var endTime = moment($("#EndTime").val(), "h:mm A").format("h:mm A");
    var startTime = moment($("#StartTime").val(), "h:mm A").format("h:mm A");
    var startTime2 = $('#StartTime').val();
    var endTime2 = $('#EndTime').val();

    if(typeof(startTime2) == "undefined" || startTime2 == '' || typeof(endTime2) == "undefined" || endTime2 == '')
    {
        appointmentIsValid = false;
        alert("Error: Date & time are required");

    }
    else {
        appointmentIsValid = true;
    }

    if (moment(startTime, "h:mm A").isAfter(moment(endTime, "h:mm A"))) {
        appointmentIsValid = false;
        document.getElementById("EndTime").value = '';
        alert("Error: End time must be after Start time.");

    }
    if (appointmentIsValid){
        $('#settingForm').submit();
    }
}

function calculateLineTotal(id) {
    var quantity = $("#quantity_" + id).val();
    var price = $("#price_" + id).val();
    var tax = 0.00;
    $("#total_" + id).html(CurrencyFormatted(quantity * price * ( 1.0 + tax / 100.0)  ));
    $("#tax_" + id).html(CurrencyFormatted(quantity * price *  tax / 100.0  ));

    calcappointmentTotal();
}


function calcappointmentTotal() {
   
    var total = 0;
    $(".lineTotal").each(function () {
        total += Number($(this).text());
    });

    $("#appointmentTotal").text(CurrencyFormatted(total));
}

function addNewRow(item,price,quantity,notes) {

    if (quantity ==0) {
        quantity = 1.00;
    }
    var lastRowId = $("#appointmentItems > div:last").attr("data-rowid");
    
    var nextRowId = 1;

    if ( lastRowId != null ) {
        nextRowId = 1 + Number(lastRowId);
    }
    var newRow = $("#jobItemTemplate").tmpl({ item: item,  price: price, quantity: quantity, id: nextRowId , currency:'' , notes: notes });

    $("#appointmentItems").append(newRow);

    var nameText = "#price_" + nextRowId;
    $(nameText).numeric();
    enableItemAutoComplete(nextRowId);
    calculateLineTotal(nextRowId);
    calcappointmentTotal();

}

function removeRow(id) {
    $("#itemRow_" + id + "").remove();
    calcappointmentTotal();
}


function toggleNotes(id) {
    $("#appointmentItems > tbody > tr[data-notesrowid=" + id + "]").toggle();

}


function validateappointmentItems()
{
    var errorCount = 0;

    $("#appointmentItems > tbody > tr").each(function() {

        var rowId = $(this).attr("data-rowid");


        var item = document.getElementById("AppointmentItemEntry_item_" + rowId).value;

        if (item == "" ) {
            errorCount++;
            $("#AppointmentItemEntry_error_" + rowId).css('visibility' , 'visible');
        }
        else {
            $("#AppointmentItemEntry_error_" + rowId).css('visibility' , 'hidden');
        }
    });

    return errorCount == 0;
}


function enableItemAutoComplete(id) {
    $("#AppointmentItemEntry_item_" + id)
        .autocomplete(
        {
            source: "/Schedule/ItemSearch",
            focus: function (event,ui) {
                $("#AppointmentItemEntry_item_" + id).val(ui.item.Name);
                return false;
            },
            select : function (event,ui) {

                $("#AppointmentItemEntry" + id).val(ui.item.Name);
                $("#price_" + id).val(ui.item.Price);
                $("#quantity_" + id).val(ui.item.Quantity);
                calculateLineTotal(id);
                calcappointmentTotal();
                return false;
            }
        }
        ).data("uiAutocomplete")
        ._renderItem = function(ul, product) {
            return $("<li></li>")
                .data("item.autocomplete", product)
                .append("<a>" + product.Name + "</a>")
                .appendTo(ul);
        };
}


 function searchPet(data){
    $.ajax({
    url: 'schedules/search-pet',
    type: 'GET',
    data: 
    {
    customer_id: data},
    success: function(data){
        data = JSON.parse(data);
        $('#pet_id').html('');
        $.each(data, function(index, val) {
            console.log(val);
            $('#pet_id').append('<option value="'+val.id+'">'+val.name+'</option>');
        });
    }
});
 }
function searchCustomer(data, type){
        $.ajax({
            url: '/dashboard/customers/search-letter',
            type: 'GET',
            data: {
            letter: data,
            type: type},
             success: function(data){
                if(data != -1){
                 $('#demoFour').html('');
                 data = JSON.parse(data);

                 $.each(data, function(index, val) {
                    var address = '' ,address2 = '' , phone = '', pets = '';
                    if(val.mobile_phone != null && val.mobile_phone !== undefined)
                        phone = val.mobile_phone;
                    if(val.address != null)
                        address = val.address;
                     if(val.address2 != null){
                        if(address)
                         address2 = ', ' + val.address2
                          else 
                         address2 = val.address2;
                     }

                    if(val.pet_results)
                        pets = val.pet_results;

                     $('#demoFour').append('<a href="/dashboard/customers/detail/'+val.id+'" class="list-group-item myBlue"><h5 class="list-group-item-heading">'+val.first_name +' ' +val.last_name+'</h5> <div><i class="fa fa-mobile-phone"></i>'+phone+'</div><div><i class="fa fa-building-o"></i>'+address+address2+'</div><div><i class="fa fa-paw">'+ pets +'</i> </div></a>')
                 });
                console.log(data) ;
                }
                else  $('#demoFour').html('<li class="ln-no-match" style="">No results to display, try selecting another letter?</li>');
             }
        })
}
// page is now ready, initialize the calendar...
$(document).ready(function () {
     searchCustomer('a', 'last_name');
    $('.search-customer.ln-letters a').click(function(event) {
         event.preventDefault();
         $('.ln-letters a').removeClass('ln-selected');
         $(this).addClass('ln-selected');
        var val = $(this).html();
        searchCustomer(val, 'last_name');
    });
    $('#btnsearchCustomer').click(function(event) {
         event.preventDefault();
         var val = $('#ClientName').val();
         if(val != ''){
             searchCustomer(val, 'all');
         }
    });
    $('.search_pet').click(function(event) {
        searchPet($('#customer_id').val());
    });

    $('#customer_id').change(function(event) {
        searchPet($(this).val());
        
    });
    function closePopovers() {
        $('.popover').not(this).popover('hide');
    }

    setHeaderDate();

    $('.switch-btn').bootstrapSwitch();

    if( $(".datetime").length ) {
        $(".datetime").datetimepicker({ autoclose: true, pickTime: false, todayHighlight: true, forceParse: true, format: "d-M-yyyy" });
    }
    if( $(".sTime").length ) {
        $('.sTime').datetimepicker({
            showMeridian: true,
            minuteStep: 5,
            autoclose: true,
            minView: 0,
            maxView: 1,
            pickDate: false,
            startView: 1,
            format: 'H:ii P',
            pickerPosition: 'bottom-left',
        }).on("show", function(){
            $(".table-condensed .prev").css('visibility', 'hidden');
            $(".table-condensed .switch").css('visibility', 'hidden');
            $(".table-condensed .next").css('visibility', 'hidden');
        });

        var default_date = $('.sTime').data('default-date');
        if (default_date)
            $('.sTime').datetimepicker('setDate', new Date(default_date));
    }

    if( $(".eTime").length ) {
        $('.eTime').datetimepicker({
            showMeridian: true,
            minuteStep: 5,
            autoclose: true,
            minView: 0,
            maxView: 1,
            pickDate: false,
            startView: 1,
            format: 'H:ii P',
            pickerPosition: 'bottom-left',
        }).on("show", function(){
            $(".table-condensed .prev").css('visibility', 'hidden');
            $(".table-condensed .switch").css('visibility', 'hidden');
            $(".table-condensed .next").css('visibility', 'hidden');
        });

        var default_date = $('.eTime').data('default-date');
        if (default_date)
            $('.eTime').datetimepicker('setDate', new Date(default_date));
    }

    if( $(".bTime").length ) {
        $('.bTime').datetimepicker({
            showMeridian: true,
            minuteStep: 5,
            autoclose: true,
            minView: 0,
            maxView: 1,
            startView: 1,
            format: 'H:ii P',
            pickerPosition: 'bottom-left'
        });
        $('.bTime').data('datetimepicker').picker.addClass('timepicker');
    }

    if( $("#appointmentItems").length ) {
        $("#appointmentItems").delegate("input", "change", function() {
            var id = $(this).attr("data-rowid");
            calculateLineTotal(id);
        });
    }

    if( $('#customer-list').length ) {
        $('#customer-list').DataTable({
        });
    }

    if( $('#groomer-list').length ) {
        $('#groomer-list').DataTable({
        });
    }
    $('.datepicker').datepicker({
        format: 'd-M-yyyy',
    });

    $('#pet-dob').parents('.input-group').find('.btn').on('click', function(e){
        e.preventDefault();
        $('#pet-dob').focus();
    });

$(document).on('mouseover','.select2-container', function(e) {
    // $(this).prev("select").select2("open");
    var group = $(this).parents('.input-group').find('#pet_id');
    var form = $(this).parents('form').hasClass('edit2');
    if(group.length>0 && form == true){
            $('.greenmodal').show();
    }   

});
$(document).on('mouseleave', '.select2-container', function(e) {
    // $(this).prev("select").select2("open");
    $('.greenmodal').hide();
});

});









