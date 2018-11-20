var Cal = function(divId) {

  //Store div id
  this.divId = divId;

  // Week Counter //
  this.WeekCounter = [
    'Week'
  ];
  // Days of week, starting on Sunday
  this.DaysOfWeek = [
    'Sun',
    'Mon',
    'Tue',
    'Wed',
    'Thu',
    'Fri',
    'Sat'
  ];

  // Months, stating on January
  this.Months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ];

  // Set the current month, year
  var d = new Date();

  this.currMonth = d.getMonth();
  this.currYear = d.getFullYear();
  this.currDay = d.getDate();

};

// Goes to next month

Cal.prototype.nextMonth = function() {
  if ( this.currMonth == 11 ) {
    this.currMonth = 0;
    this.currYear = this.currYear + 1;
  }
  else {
    this.currMonth = this.currMonth + 1;
  }
  this.showcurr();
};

// Goes to previous month
Cal.prototype.previousMonth = function() {
  if ( this.currMonth == 0 ) {
    this.currMonth = 11;
    this.currYear = this.currYear - 1;
  }
  else {
    this.currMonth = this.currMonth - 1;
  }
  this.showcurr();
};

// Show current month
Cal.prototype.showcurr = function() {
  this.showMonth(this.currYear, this.currMonth);
};

// Show month (year, month)
Cal.prototype.showMonth = function(y, m) {

  var d = new Date()
  // First day of the week in the selected month
  , firstDayOfMonth = new Date(y, m, 1).getDay()
  // Last day of the selected month
  , lastDateOfMonth =  new Date(y, m+1, 0).getDate()
  // Last day of the previous month
  , lastDayOfLastMonth = m == 0 ? new Date(y-1, 11, 0).getDate() : new Date(y, m, 0).getDate();


  var html = '<table>';

  // Write selected month and year
  html += '<thead><tr>';
  //html += '<td><button id="btnPrev" type="button">Prev</button></td>';
  html += '<td colspan="8">' + this.Months[m] + ' ' + y + '</td>';
  //html += '<td><button id="btnNext" type="button">Next</button></td>';
  html += '</tr></thead>';


  // Write the header of the days of the week
  html += '<tr class="days">';
  // for(var i=0; i < this.WeekCounter.length;i++) {
  //  html += '<td>' + this.WeekCounter[i] + '</td>';
  // }
  for(var i=0; i < this.DaysOfWeek.length;i++) {
	if(i==0){
		html += '<td class="firstCol">' + 'WN' + '</td>';
	}
    html += '<td>' + this.DaysOfWeek[i] + '</td>';
  }
  html += '</tr>';

  // Write the days
  var i=1;
  do {

    var dow = new Date(y, m, i).getDay();

    // If Sunday, start new row
    if ( dow == 0 ) {
      html += '<tr class="tiger">';
	  	if(dow==0 || dow==7 || dow==14 || dow==21 || dow==28 || dow==35){
			html += '<td class="firstCol">' + '<span class="EngWNum tooltipp2">10 <span class="tooltipptext2">Georgian Week</span></span><br /><span class="HijriWNum tooltipp2">16<span class="tooltipptext2">Hijri Week</span></span>' + '</td>';
		}
    }
    // If not Sunday but first day of the month
    // it will write the last days from the previous month
    else if ( i == 1 ) {
      html += '<tr class="jumbo">';
      var k = lastDayOfLastMonth - firstDayOfMonth+1;
      for(var j=0; j < firstDayOfMonth; j++) {
		if(j==0 || j==6 || j==12 || j==18 || j==24 || j==30){
			html += '<td class="firstCol">' + '<span class="EngWNum tooltipp2">10 <span class="tooltipptext2">Georgian Week</span></span><br /><span class="HijriWNum tooltipp2">16<span class="tooltipptext2">Hijri Week</span></span>' + '</td>';
		}
        html += '<td class="not-current">' + k + '</td>';
        k++;
      }
    }/*else{
		if(i==0 || i==7 || i==14 || i==21 || i==28 || i==35){
			html += '<td>' + '' + '</td>';
		}
	}*/

    // Write the current day in the loop
    var chk = new Date();
    var chkY = chk.getFullYear();
    var chkM = chk.getMonth();
    if (chkY == this.currYear && chkM == this.currMonth && i == this.currDay) { 
	
      html += '<td class="today"><a href="#" class="leftSelection" data-toggle="modal" data-target="#AddEvent"><div class="georgianDate">' + i + '<br />' + this.Months[m] + '</div><div class="hijriDate"><h5>14</h5><span class="hijriMonth">SAFFAR</span></div></a><div class="rightSelection"><div class="topParameterArea"><a href="#" class="holiday tooltipp HolidayParameterSet" data-toggle="modal" data-target="#SetHolidayParameter"><span class="tooltipptext">Holiday Parameter</span>H</a><a href="#" class="StaffParameter tooltipp StaffParameterSet" data-toggle="modal" data-target="#SetStaffParameter"><span class="tooltipptext">Staff Parameter</span>TP</a><a href="#" class="StudentParameter tooltipp StudentParameterSet" data-toggle="modal" data-target="#SetStudentParameter"><span class="tooltipptext ">Student Parameter</span>SP</a><a href="#" class="ScheduleFollowup tooltipp" data-toggle="modal" data-target="#SetScheduleFollowup"><span class="tooltipptext">Schedule Followup</span>SF</a></div><div class="listEvents"><a href="#" class="HolidayParameterSet"><strong>T</strong> - Pakistan Day</a><a href="#" class="StudentParameterSet">M - PTM Middle</a><a href="#" class="StaffParameterSet">S - 23rd Marach Event</a><a href="#" class="StudentParameterSet">J - PTM Junior</a><a href="#" class="viewMore">View 3 more +</a></div></div></td>';
    } else {
	 /* All Blank */	
     html += '<td class="normal"><a href="#" class="leftSelection"  data-toggle="modal" data-target="#AddEvent"><div class="georgianDate">' + i + '<br />' + this.Months[m] + '</div><div class="hijriDate"><h5>14</h5><span class="hijriMonth">SAFFAR</span></div></a><div class="rightSelection"><div class="topParameterArea"><a href="#" class="holiday tooltipp " data-toggle="modal" data-target="#SetHolidayParameter"><span class="tooltipptext">Holiday Parameter</span>H</a><a href="#" class="StaffParameter tooltipp " data-toggle="modal" data-target="#SetStaffParameter"><span class="tooltipptext">Staff Parameter</span>TP</a><a href="#" class="StudentParameter tooltipp " data-toggle="modal" data-target="#SetStudentParameter"><span class="tooltipptext ">Student Parameter</span>SP</a><a href="#" class="ScheduleFollowup tooltipp" data-toggle="modal" data-target="#SetScheduleFollowup"><span class="tooltipptext">Schedule Followup</span>SF</a></div><div class="listEvents"></div></div></td>';
	  
	  /* Only Holiday */
	  //html += '<td class="normal"><a href="#" class="leftSelection"><div class="georgianDate">' + i + '<br />' + this.Months[m] + '</div><div class="hijriDate"><h5>14</h5><span class="hijriMonth">SAFFAR</span></div></a><div class="rightSelection"><div class="topParameterArea"><a href="#" class="holiday tooltipp HolidayParameterSet" data-toggle="modal" data-target="#SetHolidayParameter"><span class="tooltipptext">Holiday Parameter</span>H</a><a href="#" class="StaffParameter tooltipp" data-toggle="modal" data-target="#SetStaffParameter"><span class="tooltipptext">Staff Parameter</span>TP</a><a href="#" class="StudentParameter tooltipp" data-toggle="modal" data-target="#SetStudentParameter"><span class="tooltipptext ">Student Parameter</span>SP</a><a href="#" class="ScheduleFollowup tooltipp" data-toggle="modal" data-target="#SetScheduleFollowup"><span class="tooltipptext">Schedule Followup</span>SF</a></div><div class="listEvents"><a href="#" class="HolidayParameterSet"><strong>T</strong> - Pakistan Day Holiday</a></div></div></td>';
	  
	  /* Staff Parameter Only */ 
	  //html += '<td class="normal"><a href="#" class="leftSelection"><div class="georgianDate">' + i + '<br />' + this.Months[m] + '</div><div class="hijriDate"><h5>14</h5><span class="hijriMonth">SAFFAR</span></div></a><div class="rightSelection"><div class="topParameterArea"><a href="#" class="holiday tooltipp" data-toggle="modal" data-target="#SetHolidayParameter"><span class="tooltipptext">Holiday Parameter</span>H</a><a href="#" class="StaffParameter tooltipp StaffParameterSet" data-toggle="modal" data-target="#SetStaffParameter"><span class="tooltipptext">Staff Parameter</span>TP</a><a href="#" class="StudentParameter tooltipp" data-toggle="modal" data-target="#SetStudentParameter"><span class="tooltipptext ">Student Parameter</span>SP</a><a href="#" class="ScheduleFollowup tooltipp" data-toggle="modal" data-target="#SetScheduleFollowup"><span class="tooltipptext">Schedule Followup</span>SF</a></div><div class="listEvents"><a href="#" class="StaffParameterSet">S - 23rd Marach Event</a></div></div></td>';
	  
	  /* Student Parameters Only */ 
	  //html += '<td class="normal"><a href="#" class="leftSelection"><div class="georgianDate">' + i + '<br />' + this.Months[m] + '</div><div class="hijriDate"><h5>14</h5><span class="hijriMonth">SAFFAR</span></div></a><div class="rightSelection"><div class="topParameterArea"><a href="#" class="holiday tooltipp" data-toggle="modal" data-target="#SetHolidayParameter"><span class="tooltipptext">Holiday Parameter</span>H</a><a href="#" class="StaffParameter tooltipp" data-toggle="modal" data-target="#SetStaffParameter"><span class="tooltipptext">Staff Parameter</span>TP</a><a href="#" class="StudentParameter tooltipp StudentParameterSet" data-toggle="modal" data-target="#SetStudentParameter"><span class="tooltipptext ">Student Parameter</span>SP</a><a href="#" class="ScheduleFollowup tooltipp" data-toggle="modal" data-target="#SetScheduleFollowup"><span class="tooltipptext">Schedule Followup</span>SF</a></div><div class="listEvents"><a href="#" class="StudentParameterSet">M - PTM Middle</a><a href="#" class="StudentParameterSet">J - PTM Junior</a><a href="#" class="StudentParameterSet">M - PTM Middle</a></div></div></td>';
	  
	  /* All Parameters */ 
	  //html += '<td class="normal"><a href="#" class="leftSelection"><div class="georgianDate">' + i + '<br />' + this.Months[m] + '</div><div class="hijriDate"><h5>14</h5><span class="hijriMonth">SAFFAR</span></div></a><div class="rightSelection"><div class="topParameterArea"><a href="#" class="holiday tooltipp HolidayParameterSet" data-toggle="modal" data-target="#SetHolidayParameter"><span class="tooltipptext">Holiday Parameter</span>H</a><a href="#" class="StaffParameter tooltipp StaffParameterSet" data-toggle="modal" data-target="#SetStaffParameter"><span class="tooltipptext">Staff Parameter</span>TP</a><a href="#" class="StudentParameter tooltipp StudentParameterSet" data-toggle="modal" data-target="#SetStudentParameter"><span class="tooltipptext ">Student Parameter</span>SP</a><a href="#" class="ScheduleFollowup tooltipp" data-toggle="modal" data-target="#SetScheduleFollowup"><span class="tooltipptext">Schedule Followup</span>SF</a></div><div class="listEvents"><a href="#" class="HolidayParameterSet"><strong>T</strong> - Pakistan Day Holiday</a><a href="#" class="StudentParameterSet">M - PTM Middle</a><a href="#" class="StaffParameterSet">S - 23rd Marach Event</a><a href="#" class="StudentParameterSet">J - PTM Junior</a><a href="#" class="StudentParameterSet">M - PTM Middle</a><a href="#" class="viewMore">View 3 more +</a></div></div></td>';
    }
    // If Saturday, closes the row
    if ( dow == 6 ) {
      html += '</tr>';
    }
    // If not Saturday, but last day of the selected month
    // it will write the next few days from the next month
    else if ( i == lastDateOfMonth ) {
      var k=1;
      for(dow; dow < 6; dow++) {
        html += '<td class="not-current">' + k + '</td>';
        k++;
      }
    }

    i++;
  }while(i <= lastDateOfMonth);

  // Closes table
  html += '</table>';

  // Write HTML to the div
  document.getElementById(this.divId).innerHTML = html;
};

// On Load of the window
window.onload = function() {

  // Start calendar
  var c = new Cal("divCal");			
  c.showcurr();

  // Bind next and previous button clicks
  getId('btnNext').onclick = function() {
    c.nextMonth();
  };
  getId('btnPrev').onclick = function() {
    c.previousMonth();
  };
}

// Get element by id
function getId(id) {
  return document.getElementById(id);
}