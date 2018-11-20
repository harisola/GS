<script type="text/javascript">

$(document).on("click", "#heading6", function(){
 if ( $( this ).hasClass( "in" ) ) {
	$(this).removeClass('in')
 }
 
});

(function($){
	$(window).on("load",function(){
		$(".MonthDays").mCustomScrollbar({
			scrollButtons:{enable:true, scrollType:"stepped"},
			keyboard:{scrollType:"stepped"},
			mouseWheel:{ scrollAmount:128 },
			theme:"rounded-dark",
			autoExpandScrollbar:true,
			snapAmount:128,
			callbacks:{
				onTotalScroll:function(){	loadHtml(this); },
				onTotalScrollBack: function(){ loadHtmlPrepend(this);  },
				onTotalScrollBackOffset: 100,
				whileScrolling:function(){
					var row = $(".hidden_month:mcsInSight(exact)");
					$("#current_month").html('');
					$("#current_month").html( row.html() );
				},
				
				
			}
		});
		
	});
	
	$(document).on("click",".todayGO", function(){
		$('.MonthDays').mCustomScrollbar('scrollTo',['.Today']);
	});
	
	

	
	
	
})(jQuery);

$(function(){
    $("body").delegate("#ScheduleFolllowupDate", "focusin", function(){
		var selectedDate = $("#ScheduleFollowupStartDate").val();
		$(this).datepicker({
			//minDate: selectedDate,
			dateFormat: 'yy-mm-dd',
			prevText: '<i class="fa fa-chevron-left"></i>',
			nextText: '<i class="fa fa-chevron-right"></i>',
			onSelect: function(date) {
				Followup_Availability_Date_Wise(date);
			},
		});
    });
});

function Followup_Availability_Date_Wise(Date){
	//var Date = '2017-05-26';
	if(Date != ''){
		$.ajax({
			url: "<?php echo site_url()?>/master_calendar/master_calendar_ajax/Followup_Availability_Date_Wise",
			type: "POST",
			cache: false,
			data:{RDate:Date},
			dataType:"JSON",
			beforeSend: function() { $("#ajaxloader").show(); },
			success: function(res){
				if(parseInt(res.Cr) > 0){
					$("#Respective_Date_CheckBox").show();
					$("#SetFollowup").hide();
				}else{
					$("#Respective_Date_CheckBox").hide();
					$("#SetFollowup").show();
				}
			},
			complete: function () { $("#ajaxloader").hide(); }
		});
	}
}

function loadHtml(_this){
	var endDate = $("#endDate").val();
	var endGenWe = $("#endGenWe").val();
	var WEEK_NMUBER = $("#WEEK_NMUBER").val();
	
	$.ajax({
		url: "<?php echo site_url()?>/master_calendar/master_calendar_ajax/CallBackHtml",
		type: "POST",
		data:{EndDate:endDate,endGenWe:endGenWe,WEEK_NMUBER:WEEK_NMUBER},
		dataType:'JSON',
		beforeSend: function() { $("#ajaxloader").show(); },
		success: function(res){
			$(".endDate").remove();
			$(".endGenWe").remove();
			$(".WEEK_NMUBER").remove();
			_this.mcs.content.append(res.h);
		},
		complete: function () { $("#ajaxloader").hide(); }
	});
}

function loadHtmlPrepend(_this){	
	var start_date = $("#start_date_hidden").val();
	var START_WEEK_NMUBER = $("#START_WEEK_NMUBER").val();
	var First_Monday = $("#First_Monday").val();
	
	//if(_this.mcs.top == 0 ){
		$.ajax({
		url: "<?php echo site_url()?>/master_calendar/master_calendar_ajax/getBackMonth",
		type: "POST",
		cache: false,
		data:{start_date:start_date,START_WEEK_NMUBER:START_WEEK_NMUBER,First_Monday:First_Monday},
		//dataType:'HTML',
		dataType:"JSON",
		
		beforeSend: function() {
			$("#ajaxloader").show();
        },
		success: function(res){
			//console.log(res.ld);
			$("#First_Monday").remove();
			$("#start_date_hidden").val(res.ld);
			//$("#current_month").html('');
			$("#current_month").html(res.sd);
			_this.mcs.content.prepend(res.h);
			
			setTimeout(function(){
				$(".weekRow").removeAttr( 'style' );
			},1000);
	},
		complete: function () { 
    		$("#ajaxloader").hide();
		}
	});
	//}
}

// Holiday parameter show modal
$(document).on("click",".HolidayParameter",function(){
	var dateID = $(this).attr("data-id");
	var Hijr_Date = $(this).attr("id");
	//var confirmation = confirm("Are you sure you want Set Parameter?");
	//if(confirmation){}
	loadModal('Holiday',dateID,'NHP', Hijr_Date); // NHP for new holiday parameter 
	
});

// Staff Parameter Show modal
$(document).on("click",".StaffParameter",function(){
	var dateID = $(this).attr("data-id");
	var Hijr_Date = $(this).attr("id");
	
	
	


	loadModal('StaffP',dateID,'NTP', Hijr_Date); // NTP for new staff parameter

});


// Student Parameter Show Modal
$(document).on("click",".StudentParameter",function(){
	var dateID = $(this).attr("data-id");
	var Hijr_Date = $(this).attr("id");


	loadModal('StudentP',dateID,'NSP', Hijr_Date); // NSP for new student parameter

});

//Schedule Parameter Show Modal
$(document).on("click",".ScheduleFollowup",function(){
	var dateID = $(this).attr("data-id");
	var Hijr_Date = $(this).attr("id");
	
	var str = dateID;
	var s = str.split("_");
	var Selected_Date = s[1];
	$("#ScheduleFollowupStartDate").val(Selected_Date); 

	loadModal('Schedule',dateID,'NSCF', Hijr_Date); // NSCF for new schedule followup
	
});

// Function for load Modal HTML
function loadModal(Type,dateID,MethodT, Hijri_Date ){
	
	var ResponseDiv='';
	var ActionURL='';
	var ModalToShow='';
	switch( Type ){
		case 'Holiday'  : ResponseDiv='HolidayParameters'; ActionURL='HParamter';     ModalToShow='SetHolidayParameter2'; break;
		case 'HlP'  	: ResponseDiv='HolidayParameters'; ActionURL='HParamterH';     ModalToShow='SetHolidayParameter2'; break;
		case 'StaffP'   :  ResponseDiv='StaffParameters';  ActionURL='SfParamter';    ModalToShow='SetStaffParameters';   break;
		case 'StaffPH'   :  ResponseDiv='StaffParameters';  ActionURL='SfParamterH';    ModalToShow='SetStaffParameters';   break;
		case 'StudentP' : ResponseDiv='StdParameters';     ActionURL='StdParameter';  ModalToShow='SetStudentParameter';  break;
		case 'Schedule' : ResponseDiv='SchFParameters';    ActionURL='SchFParameter'; ModalToShow='SetScheduleFollowup';  break;
		case 'AddEvent' : ResponseDiv='AddEventModalContent'; ActionURL='AddNewEventModalHtml'; ModalToShow='AddEventModal'; break;
		case 'AddEventHijri' : ResponseDiv='AddEventModalContentHijri'; ActionURL='AddNewEventHtmlHijri'; ModalToShow='AddEventModalHijri'; break;
		case 'ViewMoreHere' : ResponseDiv='ViewMoreHereContent'; ActionURL='ViewMoreHereEvent'; ModalToShow='ViewMoreHere'; break;
		
	}
	$("#HolidayParameters").html('');
	$("#StaffParameters").html('');
	$("#StdParameters").html('');
	$("#SchFParameters").html('');
	$("#AddEventModalContent").html('');
	$("#AddEventModalContentHijri").html('');
	$("#ViewMoreHereContent").html('');
	
	
	$.ajax({
		url: "<?=site_url()?>/master_calendar/master_calendar_ajax/"+ActionURL+"",
		type: "POST",
		data:{dataid:dateID,MethodT:MethodT,Hijri_Date:Hijri_Date},
		dataType:'HTML',
		beforeSend: function() { $("#ajaxloader").show(); },
		success: function(res){
			$("#"+ResponseDiv+"").html('');
			$("#"+ResponseDiv+"").html(res);
			$("#"+ModalToShow+"").modal({  backdrop: 'static', show: 'true' });
		},
		complete: function () { $("#ajaxloader").hide(); }
	});

}




// click on Holiday modal button
$(document).on("click","#HPButton", function(){
	
	
	    bootbox.dialog({
            message: "Are you sure you want to Set Holiday Parameter?",
            title: "Please Confirm.",
            buttons: {
              confirm: {
                label: "Yes! Set Holiday Parameter",
                callback: function() { 
				
				
	
	var date_id =  $("#HijriDateBox").val();
	var cl = "#"+date_id.toString();
	var $rows = $(cl);
	var EL = $rows.find(".eventListingHere");
	var ct = $(EL).find('a').length;
	var anchor = parseInt(ct);
	var ShortTitle	= $("#holiday_short_title").val();
	var holiday_title	= $("#holiday_title").val();
	
	var holiday_profile	= parseInt($("#holiday_profile").val());
	var hprofile = $("#holiday_profile option:selected").text();
	var res = hprofile.split(" ",2);
	if( res.length > 1 ){
		var headHP = ( res[0].charAt(0).toUpperCase() ) + ( res[1].charAt(0).toUpperCase() );	
	}else{
		var headHP = res[0].charAt(0).toUpperCase();
	}
	var Tltip = '<span class="tooltipptext">'+holiday_title+'</span>';
	var HpOn = $rows.find(".HolidayParameter");
	HpOn.text( headHP );
	HpOn.prepend(Tltip);
	HpOn.removeClass("HolidayParameter");
	HpOn.addClass("HolidayParameter3");
	
	var Highlight_Hijri=0;
	
	var sdate = date_id.split("_");
	//var sdate = sdate[1];
	
	if($("#Reflect_Hijri").is(':checked')){ 
		var RH = $("#Reflect_Hijri").val(); 
		var HI_Date = 'Holiday_Hijri'
		var Type = 'HolidayH';
		var F_ID= 'HH';
		Highlight_Hijri=1;
		var sdate = "HH_"+sdate[1];
	}else{
		var RH = '';
		var HI_Date = 'Holiday';
		var Type = 'Holiday';
		var F_ID= 'H';
		Highlight_Hijri=0;
		var sdate = "H_"+sdate[1];
	}
	
	
	
	if( ShortTitle != '' && holiday_profile > 0 ){
		SetHolidayParameterFun(Type,RH);	
	}
	
	
	
	
	setTimeout(function(){
		var lastID = $("#AjaxReturnedID").val();
		var ID_FOR = ( F_ID+"_"+lastID ).toString();
		var ID_FOR2 = "#"+ID_FOR;
		var count = $(ID_FOR2).length;
		if( parseInt(count) > 0 ){
			$(ID_FOR2).text(ShortTitle);
		}else{
			//appendToDiv( EL, HI_Date, anchor, ShortTitle, ID_FOR, sdate);	
			appendToDivH( EL, HI_Date, anchor, ShortTitle, ID_FOR, sdate);	
		}
	
		if( Highlight_Hijri == 1 ){
			$rows.find(".ArabicDate").css({"background":"#f2f3dc","color":"#000000","width":"100%", "font-weight":"bold","height":"58px"});
		}
		
		$('.modal.in').modal('hide');	
	}, 1000);
	
	
	
	} //// end callback: 
              },
			  cancel: {
                label: "Cancel",
                callback: function() { }
              },
              
            }
        });
		
		
});
// function form database holiday parmater button
function SetHolidayParameterFun(Type,RH){
	var hp 	= $("#holiday_profile option:selected").val();
	var ht	= $("#holiday_title").val();
	var hst = $("#holiday_short_title").val();
	var hd  = $("#holiday_description").val();
	var OpType  = $("#OpType").val();
	var di 	= $("#date_id").val();
	
	
	if($("#Reflect_Hijri").is(':checked')){ 
		//var RH = $("#Reflect_Hijri").val(); 
		//var Type = 'HolidayH';
	}else{ 
		//var RH=''; 
		//var Type = 'Holiday';
	}
	
	
	CallAjax(Type,hp,ht,hst,hd,di,OpType,RH);
}
// Click On Staff Parameter Modal Button
$(document).on("click", "#SPButton", function(){
	
	
	
	    bootbox.dialog({
            message: "Are you sure you want to Set Staff Supper Profile Parameter?",
            title: "Please Confirm.",
            buttons: {
              confirm: {
                label: "Yes! Set Parameter",
                callback: function() { 
				
				
				
				
	var date_id = $("#date_id_SP").val();
	var cl = "#"+date_id;
	var $rows = $(cl);
	var EL = $rows.find(".eventListingHere");
	var ct = $(EL).find('a').length;
	var anchor = parseInt(ct);
	var ShortTitle	= $("#SPShortTitle").val();
	var SPTitle	= $("#SPTitle").val();
	
	var SuperProfile	= parseInt($("#SuperProfile").val());
	var HpOn = $rows.find(".StaffParameter");
	
	var hprofile = $("#SuperProfile option:selected").text();
	var res = hprofile.split(" ",2);
	if( res.length > 1 ){
	var headHP = ( res[0].charAt(0).toUpperCase() ) + ( res[1].charAt(0).toUpperCase() );	
	}else{
		var headHP = res[0].charAt(0).toUpperCase();
	}
	
	var Tltip = '<span class="tooltipptext">'+SPTitle+'</span>';
	HpOn.text(headHP);
	HpOn.prepend(Tltip);
	HpOn.attr('style', 'background-color: #b964dc !important');
	HpOn.removeClass("StaffParameter");
	HpOn.addClass("StaffParameter3");
	
	
	

	$("#PleaseWait").show();



	StaffParameter(date_id);
	
	var sdate = date_id.split("_");
	
	
	var Highlight_Hijri=0;
	if($("#Reflect_Hijri").is(':checked')){ 
		var RH = $("#Reflect_Hijri").val(); 
		var Type = 'StaffPH';
		var F_ID= 'HH';
		var Highlight_Hijri=1;
		var sdate = "HH_"+sdate[1];
	}else{
		var RH = '';
		var Type = 'StaffP';
		var F_ID= 'H';
		var Highlight_Hijri=0;
		var sdate = "H_"+sdate[1];
	}
	


	setTimeout(function(){ 
		var lastID = $("#AjaxReturnedID").val();
		
		var ID_FOR = ( F_ID+"_"+lastID ).toString();
		var ID_FOR2 = "#"+ID_FOR;
		var count = $(ID_FOR2).length;
		
		if( parseInt(count) > 0 ){
			$(ID_FOR2).text(ShortTitle);
		}else{
			appendToDiv( EL, Type, anchor, ShortTitle,ID_FOR,sdate);
		}
	if( Highlight_Hijri == 1 ){
		$rows.find(".ArabicDate").css({"background":"#f2f3dc","color":"#000000","width":"100%", "font-weight":"bold","height":"58px"});
	}	
	
	
$('.modal.in').modal('hide');	

	//}, 120000);
	}, 1000);
	
	
	} // end callback: 
              },
			  cancel: {
                label: "Cancel",
                callback: function() { }
              },
              
            }
        });

		

	
	
});
function StaffParameter(date_id){
	var sp 		= $("#SuperProfile option:selected").val();
	var st		= $("#SPTitle").val();
	var sst 	= $("#SPShortTitle").val();
	var sd  	= $("#SPDescription").val();
	var OpType  = $("#OpType").val();
	var dtid	= date_id;
	var Type='StaffP';
	
	if($("#Reflect_Hijri").is(':checked')){ 
		var RH = $("#Reflect_Hijri").val(); 
		var Type='StaffPH';
	}else{ 
	var RH=''; 
	
	}
	
	CallAjax(Type, sp, st, sst, sd, dtid, OpType, RH);
	
	$("#PleaseWait").hide();
	
}

// When click on Schedule Followup Button


function getDateDay(thisDate) {
    var d = new Date(thisDate);
    var weekday = new Array(7);
    weekday[0] = "Sun";
    weekday[1] = "Mon";
    weekday[2] = "Tue";
    weekday[3] = "Wed";
    weekday[4] = "Thu";
    weekday[5] = "Fri";
    weekday[6] = "Sat";

    var n = weekday[d.getDay()];
   return n;
}

$(document).on("click", "#SetFollowup", function(){
	
	
	    bootbox.dialog({
            message: "Are you sure you want to Set ?",
            title: "Please Confirm.",
            buttons: {
              confirm: {
                label: "Yes!",
                callback: function() { 
				
				
				
	var date_id = $("#ScheduleFCurrentDate").val();
	var cl = "#"+date_id;
	var $rows = $(cl);
	var EL = $rows.find(".eventListingHere");
	var ct = $(EL).find('a').length;
	var anchor = parseInt(ct);
	var ShortTitle	= $("#ScheduleFolllowupTitle").val();
	var Respect_Dated = $("#ScheduleFolllowupDate").val(); // Respective Date 2017-05-05
	
	
	
	ScheduleParameter(date_id);
	var sdate = date_id.split("_");
	//var sdate = sdate[1];
	var sdate = "H_"+sdate[1];
	var F_ID= 'H';
	
	
	
	
	
	
	var res = ShortTitle.split(" ",2);
	if( res.length > 1 ){
		var headHP = ( res[0].charAt(0).toUpperCase() ) + ( res[1].charAt(0).toUpperCase() );	
	}else{
		var headHP = res[0].charAt(0).toUpperCase();
	}
	var Tltip = '<span class="tooltipptext">'+ShortTitle+'</span>';
	var HpOn = $rows.find(".ScheduleFollowup");
	HpOn.text( headHP );
	HpOn.prepend(Tltip);
	HpOn.removeClass("ScheduleFollowup");
	HpOn.addClass("ScheduleFollowup3");
	
	
	if($("#addfollow").is(':checked')){
		
		setTimeout(function(){
		var lastID = $("#AjaxReturnedID").val();
		var ID_FOR = ( F_ID+"_"+lastID ).toString();
		var ID_FOR2 = "#"+ID_FOR;
		var count = $(ID_FOR2).length;
		if( parseInt(count) > 0 ){
		$(ID_FOR2).text(ShortTitle);
		}else{
		appendToDiv( EL, 'Schedule', anchor, ShortTitle,ID_FOR,sdate);
		}
		}, 1000);
		
		
		
		var Selected_Respected_Date = Respect_Dated.toString();
		var ResDay = getDateDay(Selected_Respected_Date); // Day name like monday, tuesday, wendesday
		var date_id2 = ( ResDay+"Box_"+Selected_Respected_Date);
		var cl2 = "#"+date_id2;
		var $rows2 = $(cl2);
		var EL2 = $rows2.find(".eventListingHere");
		var ct2 = $(EL2).find('a').length;
		var anchor2 = parseInt(ct2);
		setTimeout(function(){
		var lastID2 = $("#AjaxReturnedID").val();
		var lastID2 = (parseInt(lastID2)+1);
		
		var ID_FOR = ( F_ID+"_"+lastID2 ).toString();
		var ID_FOR2 = "#"+ID_FOR;
		var count2 = $(ID_FOR2).length;
		if( parseInt(count2) > 0 ){
			$(ID_FOR2).text(ShortTitle);
		}else{
			appendToDiv( EL2, 'Schedule', anchor2, ShortTitle,ID_FOR,sdate);
		}
		$('.modal.in').modal('hide');		
		}, 1000);
		
    }else{
		
		setTimeout(function(){ 
		var lastID = $("#AjaxReturnedID").val();
		var ID_FOR = ( F_ID+"_"+lastID ).toString();
		var ID_FOR2 = "#"+ID_FOR;
		var count = $(ID_FOR2).length;
		if( parseInt(count) > 0 ){
			$(ID_FOR2).text(ShortTitle);
		}else{
			appendToDiv( EL, 'Schedule', anchor, ShortTitle,ID_FOR,sdate);
		}
		$('.modal.in').modal('hide');	
		}, 1000);
		
	}
	
	

} // end callback: 
              },
			  cancel: {
                label: "Cancel",
                callback: function() { }
              },
              
            }
        });

		
});


// Function for append to eventListingHere 

function appendToDiv( EL, appendType, anchor, ShortTitle,lastID,sdate){
	
var appendClass='';
switch(appendType){
	case 'Holiday'	: appendClass='HolidayParameterSet '; break;
	case 'Holiday_Hijri' : appendClass='HolidayParameterSet'; break;
	case 'StaffP'	: appendClass='StaffParameterSet';   break;
	case 'StaffPH'	: appendClass='StaffParameterSet Staff_Hijri';   break;
	case 'StudentP' : appendClass='StudentParameterSet'; break;
	case 'Schedule' : appendClass='ScheduleFollowupSet EditSchedule'; break;
	case 'AdEnt' : appendClass='ScheduleFollowupSet EditAddEvent'; break;
	case 'AdEntH' : appendClass='ScheduleFollowupSet EditAddEventH'; break;
	case 'AdEntH2' : appendClass='ScheduleFollowupSet EdtAdEntH'; break;
}
 //"View 10 more..";
var AnchorID = "#"+sdate;
var currentAnchor = $(AnchorID);
var t = currentAnchor.text();
var num = t.substring(5, 9);
var num2 = parseInt(num);
var num3 = (num2+1);


if( anchor < 5  ){
	if(anchor == 4 ){
		EL.append('<a class="'+ appendClass +'" href="#" id="'+lastID+'" data-toggle="modal" data-target="#SetStaffParameter">'+ShortTitle+'</a>');
		var n1 = anchor+1;
		var acht = "View "+n1+" more..";
		var htm = '<a class="ViewMoreHere" id="'+sdate+'" href="#">'+acht+'</a>';
		EL.append(htm);
	}else{
		EL.append('<a class="'+ appendClass +'" href="#" id="'+lastID+'" data-toggle="modal" data-target="#SetStaffParameter">'+ShortTitle+'</a>');
	}
}else{
	var ct = $(EL).find('a').length;
	if( parseInt(ct) > 1 ){
		var ct1 = (parseInt(ct)-1);	
		var Grand_Total = (ct1-5);
	}else{
		var ct1 = parseInt(ct);
		var Grand_Total = ct1;
	}
	
	
	var ct2 = $(EL).find('a').last();
	var ct3 = ct2.text(); // 
	var ct3 = ct3.substring(0, 7); 
	var sp = ct3.split(' ');
	
	//var num = sp[1];
	//var num1 = parseInt(num);
	//var More_Numer = parseInt(num1)+1;
	
	
	ct2.text('View '+num3+' more..');
	
}

}



function appendToDivH( EL, appendType, anchor, ShortTitle,lastID,sdate){
var appendClass='';

switch(appendType){
	case 'Holiday'		 : appendClass='HolidayParameterSet '; break;
	case 'Holiday_Hijri' : appendClass='HolidayParameterSet3 HlP'; break;
	case 'StaffP'	: appendClass='StaffParameterSet';   break;
	case 'StaffPH'	: appendClass='StaffParameterSet3 Staff_Hijri';   break;
	case 'StudentP' : appendClass='StudentParameterSet'; break;
	case 'Schedule' : appendClass='ScheduleFollowupSet EditSchedule'; break;
	case 'AdEnt'    : appendClass='ScheduleFollowupSet EditAddEvent'; break;
	case 'AdEntH'   : appendClass='ScheduleFollowupSet EditAddEventH'; break;
	case 'AdEntH2'  : appendClass='ScheduleFollowupSet3 EdtAdEntH'; break;
}


var AnchorID = "#"+sdate;
var currentAnchor = $(AnchorID);
var t = currentAnchor.text();
var num = t.substring(5, 9);
var num2 = parseInt(num);
var num3 = (num2+1);


if( anchor < 5  ){
	if(anchor == 4 ){
		EL.append('<a class="'+ appendClass +'" href="#" id="'+lastID+'" data-toggle="modal" data-target="#SetStaffParameter">'+ShortTitle+'</a>');
		//EL.append('<a class="ViewMoreHere" id="'+sdate+'" href="#">View more..</a>');
		
		var n1 = anchor+1;
		var acht = "View "+n1+" more..";
		var htm = '<a class="ViewMoreHere" id="'+sdate+'" href="#">'+acht+'</a>';
		EL.append(htm);
		
		
	}else{
		EL.append('<a class="'+ appendClass +'" href="#" id="'+lastID+'" data-toggle="modal" data-target="#SetStaffParameter">'+ShortTitle+'</a>');
	}
}else{
	var ct = $(EL).find('a').length;
	if( parseInt(ct) > 1 ){
		var ct1 = (parseInt(ct)-1);	
		var Grand_Total = (ct1-5);
	}else{
		var ct1 = parseInt(ct);
		var Grand_Total = ct1;
	}
	
	
	var ct2 = $(EL).find('a').last();
	var ct3 = ct2.text(); // 
	var ct3 = ct3.substring(0, 7); 
	var sp = ct3.split(' ');
	
	var num = sp[1];
		
	ct2.text('View '+num3+' more..');
	
}

}


function CallAjax(Type, ProfileID, Title, STitle, Des, DateID, OpType, RH ){
	
	var ParaType='';
	var last_id;
	switch(Type){
		case 'Holiday'  :  ParaType='Holiday'; break;
		case 'HolidayH'  :  ParaType='HolidayH'; break;
		case 'StaffP'    :  ParaType='StaffP'; break;
		case 'StaffPH'   :  ParaType='StaffPH'; break;
		case 'StudentP' :  ParaType='StudentP'; break;
		case 'Schedule' :  ParaType='Schedule'; break;
		case 'AddEvent' :  ParaType='AddEvent'; break;
		case 'AddEventHijri' :  ParaType='AddEventHijri'; break;
	}
	 $.ajax({
		type:"POST",
		url: "<?=site_url()?>/master_calendar/master_calendar_ajax/db_hp",
		data:{ OperationType:ParaType, ProfileID:ProfileID, Title:Title, STitle:STitle, Des:Des, DateID:DateID,OpType:OpType,RH:RH },
		dataType:"JSON",
		async: false,
        cache: false,
        beforeSend: function(){
			//$("#ajaxloader").show();
		},
		success: function(res){
			$("#AjaxReturnedID").val(0);
			$("#AjaxReturnedID").val( res.lId );
			var arr = DateID.split('_');
			var From_date = arr[1];
			var To_Date = arr[1];
			
			if( ParaType ==  'Holiday' || ParaType ==  'HolidayH' || ParaType ==  'StaffP' || ParaType ==  'StaffPH' ){
				if( OpType == 2 ){
					var From_date = $("#Standard_date").val();
					var To_Date = $("#Standard_date").val();
				}else{
					var From_date = arr[1];
				}
				Update_Weekly_Time_Sheet(From_date, To_Date);
				
			}else if( ParaType ==  'Schedule' ){
				
				if( OpType == 2 ){
					var From_date = $("#Schedule_hidden_date").val();
					var To_Date = $("#Schedule_hidden_date").val();
				}else{
					var From_date = arr[1];
				}
				
				if( Des == 1 ){
					Update_In_Luie(From_date, STitle);	
				}else{
					Update_In_Luie2(From_date, STitle);
				}
				
			}
			
			//return true;
		},
		complete: function (res){ 
			//$("#ajaxloader").hide();
			
		}
	});
	
	//return last_id;
}

function Update_Weekly_Time_Sheet(From_date,To_Date){
	$("#Generations_AjaxLoader").show();
	
	$.ajax({
	type:"POST",
	url: "<?=site_url()?>/master_calendar/update_weekly2",
	cache : false, 
	data:{ From_date:From_date,To_Date:To_Date},
	success: function(res){  $("#Generations_AjaxLoader").hide(); },
	complete: function (){   $("#Generations_AjaxLoader").hide(); }
	});
	
	
}


function Update_In_Luie(From_date,To_Date){
	$("#Generations_AjaxLoader").show();
	$.ajax({
	type:"POST",
	url: "<?=site_url()?>/master_calendar/update_weekly2/Update_InLuie",
	cache : false,
	data:{ From_date:From_date,To_Date:To_Date},
	success: function(res){ $("#Generations_AjaxLoader").hide(); },
	complete: function (){  $("#Generations_AjaxLoader").hide(); }
	});
}

function Update_In_Luie2(From_date,To_Date){
	$("#Generations_AjaxLoader").show();
	$.ajax({
	type:"POST",
	url: "<?=site_url()?>/master_calendar/update_weekly2/Update_InLuie2",
	cache : false,
	data:{ From_date:From_date,To_Date:To_Date},
	success: function(res){ $("#Generations_AjaxLoader").hide();  },
	complete: function (){  $("#Generations_AjaxLoader").hide(); }
	});
}

	
$(document).on("click", ".HolidayParameterSet", function(){
	var ID=$(this).prop("id")
	var dataID=$(this).attr("data-id")
	
	var i =ID.split("_");
	var ID = parseInt(i[1]);
	
	var str = ( i[0].toString() );
	if( str == "H"){
		var Type="EHP";
	}else{
		var Type="EHHP";
	}
	


	loadModal('Holiday',ID,Type,dataID); // EHP for new edit holiday parameter

});


$(document).on("click", ".StaffParameterSet", function(){
	var ID=$(this).prop("id")
	var dataID=$(this).attr("data-id")
	
	
	
	
	var i =ID.split("_");
	var ID = parseInt(i[1]);
	
	
	
	var str = ( i[0].toString() );
	
	if( str == "H"){
		var Type="ETP";
		var StaffP = "StaffP";
	}else{
		var Type="ETPH";
		var StaffP = "StaffPH";
	}
	
	


	loadModal(StaffP,ID, Type,dataID); // EHP for new edit holiday parameter

});


// Function for show add new event modal html,
// @param: AddEvent modal for add event
// @param: event_date date for event scheduled
// @param: AdEnt for Add new event EdEnt for Edit Event
$(document).on("click", ".AddEventLink", function(){
	var event_date = $(this).attr("data-id");
	var HDate = $(this).attr("id");


	loadModal('AddEvent',event_date,'AdEnt',HDate); // EHP for new edit holiday parameter
	
});

$(document).on("click", "#AddEventButton", function(){
	
	
	 bootbox.dialog({
            message: "Are you sure you want to Add Event here?",
            title: "Please Confirm.",
            buttons: {
              confirm: {
                label: "Yes! Add Event.",
                callback: function() { 
				
				
				
	var date_id = $("#AdNwEnt").val();
	var cl = "#"+date_id;
	var $rows = $(cl);
	var EL = $rows.find(".eventListingHere");
	var ct = $(EL).find('a').length;
	var anchor = parseInt(ct);
	
	var ShortTitle	= $("#EventTitle").val();
	
	var HpOn = $rows.find(".AddEventLink");
	
	var AdNwEntDate	= $("#AdNwEntDate").val();
	
	var sdate = date_id.split("_");
	AddEventDatabase(date_id);
	
	var Highlight_Hijri=0;
	if($("#Reflect_Hijri").is(':checked')){
		var appendType='AdEntH2'; 
		var F_ID= 'HH';
		var sdate = "HH_"+sdate[1];
		var Highlight_Hijri=1;
	}else{ 
		var appendType='AdEnt'; 
		var F_ID= 'H';
		var sdate = "H_"+sdate[1];
		var Highlight_Hijri=0;
	}
	setTimeout(function(){ 
		var lastID = $("#AjaxReturnedID").val();
		var ID_FOR = ( F_ID+"_"+lastID ).toString();
		var ID_FOR2 = "#"+ID_FOR;
		var count = $(ID_FOR2).length;
		if( parseInt(count) > 0 ){
			$(ID_FOR2).text(ShortTitle);
		}else{
			appendToDiv( EL, appendType, anchor, ShortTitle,ID_FOR,sdate);
		}
	if( Highlight_Hijri == 1 ){
		$rows.find(".ArabicDate").css({"background":"#f2f3dc","color":"#000000","width":"100%", "font-weight":"bold","height":"58px"});
	}	
		$('.modal.in').modal('hide');		
	}, 1000);
	
	
} // end call back
              },
			  cancel: {
                label: "Cancel",
                callback: function() { }
              },
              
            }
        });

		
	});

function AddEventDatabase(date_id){
	var EventCategory	= $("#EventCategory").val();
	var EventTitle		= $("#EventTitle").val();
	var EventLevel		= $("#EventLevel").val();
	var EventVisibilty	= $("#EventVisibilty").val();
	var EventTimeStart	= $("#EventTimeStart").val();
	var EventTimeEnd	= $("#EventTimeEnd").val();
	//var fullday			= $("#fullday").val();
	var EventDes		= $("#EventDes").val();
	var AdNwEntDate		= $("#AdNwEntDate").val();
	var checkboxs = [];
	var i=0;
	

	//$('input.ads_Checkbox:checkbox:checked').each(function () { arr.push($(this).val()); });

	if( $('input.ads_Checkbox:checkbox:checked') ){
		$('input.ads_Checkbox:checkbox:checked').each(function () { checkboxs[i++] = $(this).val(); });	
	}else{
		var checkboxs = [];
	}
    
	
	var OperationType='AddNewEvent';
	
	var hiddenEventID	= parseInt($("#hiddenEventID").val());
	if( hiddenEventID > 0){
		var OpType=2;
	}else{
		var OpType=1;
	}
	
	if($("#Reflect_Hijri").is(':checked')){ 
		var RH = $("#Reflect_Hijri").val(); 
	}else{ var RH=''; }
	
	
	if($("#fullday").is(':checked')){ 
		var fullday	= $("#fullday").val();
	}else{ var fullday	= ''; }
	
	// Now send variables to ajax function.
	$.ajax({
		type:"POST",
		url: "<?=site_url()?>/master_calendar/master_calendar_ajax/db_Event",
		data:{OperationType:OperationType,
		ProfileID:EventCategory,
		Title:EventTitle,
		STitle:EventLevel,
		EventVisibilty:EventVisibilty,
		EventTimeStart:EventTimeStart,
		EventTimeEnd:EventTimeEnd,fullday:fullday,EventDes:EventDes,OpType:OpType,DateID:date_id,hiddenID:hiddenEventID,AdNwEntDate:AdNwEntDate,checkboxs:checkboxs,RH:RH},
		dataType:"JSON",
		beforeSend: function(){ },
		success: function(res){
			$("#AjaxReturnedID").val(0);
			$("#AjaxReturnedID").val( res.lId );
		},
		complete: function (){  }
	});
	
}

$(document).on("click",".EditAddEvent", function(){
	var ID = $(this).prop("id");
	//var Type = $(this).prop("data-id");
	
	var i =ID.split("_");
	var ID = parseInt(i[1]);
	


	loadModal('AddEvent',ID,'EdtAdEnt'); // EHP for new edit holiday parameter
	
});

$(document).on("click", ".EditSchedule", function(){
	var ID = $(this).prop("id");
	//var Type= $(this).prop("data-id");
	
	var i =ID.split("_");
	var ID = parseInt(i[1]);
	


	loadModal('Schedule',ID, 'EdtSch'); // EHP for new edit holiday parameter
	
});


// Schedule Followup Function for add new edit previous records save in database
function ScheduleParameter(date_id){
var Title	= $("#ScheduleFolllowupTitle").val();
var STitle	= $("#ScheduleFolllowupDate").val(); // Respective Date

if($("#addfollow").is(':checked')){
	//var Des	= $("#addfollow").val();
	var Des	= 1;
}else{
	var Des	= 0;
}

    var hst='ShortTitleTesting';
	var OpType  = $("#OpTypeForS").val();
	var DateID 	= $("#ScheduleFCurrentDate").val();
	var Type = 'Schedule';
	var ProfileID=1;
	var checkboxs = [];
	var i=0;
    $('.ads_Checkbox2:checked').each(function () {
		checkboxs[i++] = $(this).val();
    });
	
	if($("#Reflect_Hijri").is(':checked')){ 
		var RH = $("#Reflect_Hijri").val(); 
	}else{ var RH=''; }
	
	CallAjax(Type, checkboxs, Title, STitle, Des, DateID,OpType,RH);
}

// #Starter1
$(document).on("click", "#Starter1", function(){
	
	var clss = $(this).attr('class');
	if( clss == 'ads_Checkbox'){
		var cn = '.ads_Checkbox';
	}else{
		var cn = '.ads_Checkbox2';
	}
	
	if ( $(this).is(':checked') ) {
		$(cn).each(function (i) {
			if( $(this).val() == 'PN' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'N' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'PG' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'KG' ){ $(this).prop("checked",true) }
		});
	}else {
		$(cn).each(function (i) {
			if( $(this).val() == 'PN' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'N' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'PG' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'KG' ){ $(this).prop("checked",false) }
		});
    }
});



// #Starter2
$(document).on("click", "#Starter2", function(){
	
		var clss = $(this).attr('class');
	if( clss == 'ads_Checkbox'){
		var cn = '.ads_Checkbox';
	}else{
		var cn = '.ads_Checkbox2';
	}
	
	if ( $(this).is(':checked') ) {
		$(cn).each(function (i) {
			if( $(this).val() == 'I' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'II' ){ $(this).prop("checked",true) }
		});
	}else {
		$(cn).each(function (i) {
			if( $(this).val() == 'I' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'II' ){ $(this).prop("checked",false) }
			
		});
    }
	
	
	
});



// #Starter3
$(document).on("click", "#Starter3", function(){
	
		var clss = $(this).attr('class');
	if( clss == 'ads_Checkbox'){
		var cn = '.ads_Checkbox';
	}else{
		var cn = '.ads_Checkbox2';
	}
	
	if ( $(this).is(':checked') ) {
		$(cn).each(function (i) {
			if( $(this).val() == 'III' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'IV' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'V' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'VI' ){ $(this).prop("checked",true) }
		});
	}else {
		$(cn).each(function (i) {
			if( $(this).val() == 'III' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'IV' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'V' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'VI' ){ $(this).prop("checked",false) }
		});
    }
});



// #Starter4
$(document).on("click", "#Starter4", function(){
	
		var clss = $(this).attr('class');
	if( clss == 'ads_Checkbox'){
		var cn = '.ads_Checkbox';
	}else{
		var cn = '.ads_Checkbox2';
	}
	
	if ( $(this).is(':checked') ) {
		$(cn).each(function (i) {
			if( $(this).val() == 'VII' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'VIII' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'IX' ){ $(this).prop("checked",true) }
		});
	}else {
		$(cn).each(function (i) {
			if( $(this).val() == 'VII' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'VIII' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'IX' ){ $(this).prop("checked",false) }
		});
    }
});



// #Starter5
$(document).on("click", "#Starter5", function(){
	
		var clss = $(this).attr('class');
	if( clss == 'ads_Checkbox'){
		var cn = '.ads_Checkbox';
	}else{
		var cn = '.ads_Checkbox2';
	}
	
	if ( $(this).is(':checked') ) {
		$(cn).each(function (i) {
			if( $(this).val() == 'X' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'XI' ){ $(this).prop("checked",true) }
		});
	}else {
		$(cn).each(function (i) {
			if( $(this).val() == 'X' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'XI' ){ $(this).prop("checked",false) }
			
		});
    }
});



// #Starter6
$(document).on("click", "#Starter6", function(){
	
		var clss = $(this).attr('class');
	if( clss == 'ads_Checkbox'){
		var cn = '.ads_Checkbox';
	}else{
		var cn = '.ads_Checkbox2';
	}
	
	if ( $(this).is(':checked') ) {
		$(cn).each(function (i) {
			if( $(this).val() == 'A1' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'A2' ){ $(this).prop("checked",true) }
		});
	}else {
		$(cn).each(function (i) {
			if( $(this).val() == 'A1' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'A2' ){ $(this).prop("checked",false) }
			
		});
    }
});



// #Starter6
$(document).on("click", "#Generosity", function(){
	var clss = $(this).attr('class');
	if( clss == 'ads_Checkbox'){
		var cn = '.ads_Checkbox';
	}else{
		var cn = '.ads_Checkbox2';
	}
	
	if ( $(this).is(':checked') ) {
		$(cn).each(function (i) {
			if( $(this).val() == 'GenU' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'Coordination' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'Software' ){ $(this).prop("checked",true) }
			
		});
	}else {
		$(cn).each(function (i) {
			if( $(this).val() == 'GenU' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'Coordination' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'Software' ){ $(this).prop("checked",false) }
		});
    }
});


// #Admin
$(document).on("click", "#Admin", function(){
	
	var clss = $(this).attr('class');
	if( clss == 'ads_Checkbox'){
		var cn = '.ads_Checkbox';
	}else{
		var cn = '.ads_Checkbox2';
	}
	
	if ( $(this).is(':checked') ) {
		$(cn).each(function (i) {
			if( $(this).val() == 'DI' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'SIS' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'Finance' ){ $(this).prop("checked",true) }
			if( $(this).val() == 'Operations' ){ $(this).prop("checked",true) }
			
		});
	}else {
		$(cn).each(function (i) {
			if( $(this).val() == 'DI' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'SIS' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'Finance' ){ $(this).prop("checked",false) }
			if( $(this).val() == 'Operations' ){ $(this).prop("checked",false) }
		});
    }
});


$(document).on("click", ".ViewMoreHere", function(){
	var Sel_Date = $(this).attr("id");
	var Type="";


	loadModal('ViewMoreHere',Sel_Date,'BMH'); // NSCF for new schedule followup

});


$(document).on("click", ".hijriForm", function(){
var Se = $(this).attr("id");
var ss = Se.split("_");
var Hijri_Month = ss[0];
var Hijri_Date = ss[1];
var Hijri_CDate = ss[2];

$("#Hijri_Date3").val('');
$("#Hijri_Date3").val(Hijri_Date);

$("#Hijri_Date4").val('');
$("#Hijri_Date4").val(Hijri_CDate);


$('#SuperProfile1')
    .empty()
    .append('<option selected="selected" value="'+Hijri_Month+'">'+Hijri_Month+'</option>');
	
});

$(document).on("click", "#HijriButton", function(){


    bootbox.dialog({
            message: "Are you sure you want to?",
            title: "Please Confirm.",
            buttons: {
              confirm: {
                label: "Yes! ",
                callback: function() { 
				
				
var Hijr_Date = $("#Hijri_Date3").val();
var Hijri_Date4 = $("#Hijri_Date4").val();
var Hi_Month  = $('#SuperProfile1').val();
var SuperProfile2  = $('#SuperProfile2').val();
var pathname = window.location.pathname; // Returns path only
$("#ajaxloader").show();

$.ajax({
		type:"POST",
		url: "<?=site_url()?>/master_calendar/master_calendar_ajax/Update_Hijri",
		data:{Hijr_Date:Hijr_Date,Hi_Month:Hi_Month,Hijri_Date4:Hijri_Date4,SuperProfile2:SuperProfile2},
		dataType:"JSON",
		beforeSend: function(){
			
		},
		success: function(res){
			$("#ajaxloader").hide();
			console.log(res.Cr);
			
			if(pathname == '/gs/index.php/master_calendar/master_calendar'){
				window.location.href = "<?=site_url()?>/master_calendar/master_calendar";	
			}else{
				window.location.href = "<?=site_url()?>/master_calendar/master_calendar2";	
			}
			
			//return true;
		},
		complete: function (){ 
			
		}
	});
	
	$('.modal.in').modal('hide');	
	} // end callback: 
              },
			  cancel: {
                label: "Cancel",
                callback: function() { }
              },
              
            }
        });
		
		
});


$(document).on("click", ".AddEventLinkHijri", function(){
	var event_date = $(this).attr("data-id");
	var ID = $(this).attr("id");
	var ThirdP = 'AdEntHijri_'+ID;
	var Type="";


	loadModal('AddEventHijri',event_date, ThirdP ); // EHP for new edit holiday parameter

});


$(document).on("click", "#AddEventButtonHijri", function(){
	
	    bootbox.dialog({
            message: "Are you sure you want to Edit Event?",
            title: "Please Confirm.",
            buttons: {
              confirm: {
                label: "Yes! Edit",
                callback: function() { 
				
				
				
	var date_id =  $("#AdNwEntHijri").val();
	var cl = "#"+date_id.toString();
	 
	var $rows = $(cl);
	var EL = $rows.find(".eventListingHere");
	var ct = $(EL).find('a').length;
	var anchor = parseInt(ct);
	
	var ShortTitle	= $("#EventTitle").val();
	
	
	var AdNwEntDate	= $("#AdNwEntDateHijri").val(); // Hijri Date
	
	var sdate = date_id.split("_");
	var sdate = sdate[1];
	
	AddEventDatabaseHijri(AdNwEntDate,date_id);
	var Highlight_Hijri=0;
	
	if($("#Reflect_Hijri").is(':checked')){ 
		var RH = $("#Reflect_Hijri").val(); 
		var HI_Date = 'Holiday_Hijri'
		var Type = 'HolidayH';
		var F_ID= 'HH';
		var Highlight_Hijri=1;
	}else{
		var RH = '';
		var HI_Date = 'Holiday';
		var Type = 'Holiday';
		var F_ID= 'H';
		var Highlight_Hijri=0;
	}
	
	setTimeout(function(){ 
		var lastID = $("#AjaxReturnedID").val();
		var ID_FOR = ( F_ID+"_"+lastID ).toString();
		var ID_FOR2 = "#"+ID_FOR;
		var count = $(ID_FOR2).length;
		if( parseInt(count) > 0 ){
			$(ID_FOR2).text(ShortTitle);
		}else{
			appendToDiv( EL, 'AdEntH', anchor, ShortTitle,ID_FOR,sdate);
		}
		if( Highlight_Hijri == 1 ){
			$rows.find(".ArabicDate").css({"background":"#f2f3dc","color":"#000000","width":"100%", "font-weight":"bold","height":"58px"});
		}
		$('.modal.in').modal('hide');	
	}, 1000); 
	
	
	} // end callback: 
              },
			  cancel: {
                label: "Cancel",
                callback: function() { }
              },
              
            }
        });
		
		
});


function AddEventDatabaseHijri(date_id,date_id2){
	var EventCategory	= $("#EventCategory").val();
	var EventTitle		= $("#EventTitle").val();
	var EventLevel		= $("#EventLevel").val();
	var EventVisibilty	= $("#EventVisibilty").val();
	var EventTimeStart	= $("#EventTimeStart").val();
	var EventTimeEnd	= $("#EventTimeEnd").val();
	//var fullday			= $("#fullday").val();
	var EventDes		= $("#EventDes").val();
	var AdNwEntDate		= $("#AdNwEntDateHijri").val();
	var checkboxs = [];
	var i=0;
    $('.ads_Checkbox:checked').each(function () {
		checkboxs[i++] = $(this).val();
    });
	var OperationType='AddNewEventH';
	
	var hiddenEventID	= parseInt($("#hiddenEventIDH").val());
	if( hiddenEventID > 0){
		var OpType=2;
	}else{
		var OpType=1;
	}
	
	if($("#fullday").is(':checked')){ 
		var fullday	= $("#fullday").val();
	}else{ var fullday	= ''; }
	
	// Now send variables to ajax function.
	$.ajax({
		type:"POST",
		url: "<?=site_url()?>/master_calendar/master_calendar_ajax/db_Hijri_Event",
		data:{OperationType:OperationType,
		ProfileID:EventCategory,
		Title:EventTitle,
		STitle:EventLevel,
		EventVisibilty:EventVisibilty,
		EventTimeStart:EventTimeStart,
		EventTimeEnd:EventTimeEnd,fullday:fullday,EventDes:EventDes,OpType:OpType,DateID:date_id2,hiddenID:hiddenEventID,AdNwEntDate:AdNwEntDate,checkboxs:checkboxs},
		dataType:"JSON",
		beforeSend: function(){
			//$("#ajaxloader").show();
		},
		success: function(res){
			$("#AjaxReturnedID").val(0);
			$("#AjaxReturnedID").val( res.lId );
			//return true;
		},
		complete: function (){ 
			//$("#ajaxloader").hide();
		}
	});
	
}

$(document).on("click",".EdtAdEntH", function(){
	var ID = $(this).prop("id");
	var Type="Hijri_Type";
	
	var i =ID.split("_");
	var ID = parseInt(i[1]);
	


	loadModal('AddEventHijri',ID,'EdtAdEntH'); // EHP for new edit holiday parameter
	
});


$(document).on("click",".edtHP", function(){
	var ID = $(this).prop("id");
	var Type="Hijri_Type";


	loadModal('AddEventHijri',ID,'Hday_Hijri'); // EHP for new edit holiday parameter
	
});


//Schedule Parameter Show Modal
$(document).on("click",".HlP",function(){
	var dateID = $(this).attr("data-id");
	var ID = $(this).attr("id");
	
	var i =ID.split("_");
	var ID = parseInt(i[1]);


	loadModal('HlP',ID,'Hlpara', dateID); // NSCF for new schedule followup
	
});


//Schedule Parameter Show Modal

$(document).on("click",".Staff_Hijri",function(){
	var dateID = $(this).attr("data-id");
	var ID = $(this).attr("id");
	
	var i =ID.split("_");
	var ID = parseInt(i[1]);
	
	
	
	var i =ID.split("_");
	var ID = parseInt(i[1]);
	
	var str = ( i[0].toString() );
	if( str == "H"){
		var Type="EHP";
	}else{
		var Type="EHHP";
	}
	


	loadModal('StaffPH', ID, Type, dateID); // NSCF for new schedule followup
	
	
});

</script>
   
<link rel="stylesheet" href="<?=base_url();?>components/date_picker/jquery-ui.css" />

<!--script src="<base_url();?>components/js/jquery.min.js"></script-->

<script src="<?=base_url();?>components/date_picker/jquery-1.9.1.js"></script>

<script src="<?=base_url();?>components/js/bootstrap.min.js"></script>

<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>

<script src="<?=base_url();?>components/date_picker/jquery-ui.js"></script>
<script src="<?=base_url();?>components/assets_metronic362/global/plugins/bootbox/bootbox.min.js"></script>
</body>
</html>
