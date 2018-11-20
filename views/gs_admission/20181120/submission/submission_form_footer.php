<!--Forms-->
<script type="text/javascript">
  var selectedValue = [];
  var className = [];
// JavaScript Document
/* JS for overlay Menu */
function openNav() {
    document.getElementById("myNav").style.width = "100%";
}
function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}
/* JS for Menu Dropdown*/
$(document).ready(function(){
  
$(".hasChild").click(function(){
  $(this).children('.subMenu').toggle();
});
  
});

/* JS for Menu class toggler */ 
$(document).ready(function(){
    $(".main_menu li.main").click(function(){
        $(this).children(".main_menu li a").toggleClass("selected");
    });
});

/* JS for Menu icon toggler */
$(document).ready(function(){
    $("#CloseNav").click(function(){
        $("#CloseNav").hide();
    $("#OpenNav").show();
    });
    $("#OpenNav").click(function(){
    $("#OpenNav").hide();
        $("#CloseNav").show();
    });
});

/* Accordion with Toggle Function */
$(document).ready(function(){
    $(".panel-heading").click(function(){
        $("i.more-less").toggleClass("glyphicon-minus");
    });
});

/*------------------------------------------------------------*/
function toggleIcon(e) {
  $(e.target)
    .prev('.panel-heading')
    .find(".more-less")
    .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);

/* JS for Overlay Staff Details */
$(".viewStaffDetails").click(function(){
    $(".StaffCardList").addClass("displayNone");
  $(".StaffDetailOverlay").addClass("displayBlock");
});
$(".backtoStaffList").click(function(){
    $(".StaffCardList").removeClass("displayNone");
  $(".StaffDetailOverlay").removeClass("displayBlock");
});

/* JS for List and Grid View on Staff Page */
$(".ListView").click(function(){
    $(".StaffCardList").addClass("displayNone");
  $(".StaffTableList").addClass("displayBlock");
  $(".ListView").addClass("grayish");
  $(".GridView").removeClass("grayish");
});
$(".GridView").click(function(){
    $(".StaffCardList").removeClass("displayNone");
  $(".StaffTableList").removeClass("displayBlock");
  $(".GridView").addClass("grayish");
  $(".ListView").removeClass("grayish");
});

/* Data table */ 
$(document).ready(function() {
  $('#StaffListing').dataTable();
  $('#AllApplicantList').dataTable({ "order": [[ 0, "desc" ]] });
  $('#HoldList').dataTable();
  $('#WaitListList').dataTable();
  $('#CommunicationListing').dataTable();
  $('#CommunicationsListing').dataTable();
  $('#BatchListingList').dataTable();
  $('#AdmissionFormListing').dataTable({
    "bLengthChange": false,
    "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
    "aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
    "iDisplayLength": 20
  });
});

/* Tooltip JS */
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

/* JS for Advance Filter */
$(".showAdvFilters").click(function(){
    $(".advanceFilter").removeClass("displayNone").addClass("displayBlock");
  $(".showAdvFilters").addClass("displayNone");
  $(".hideAdvFilters").addClass("displayBlock");
});

$(".hideAdvFilters").click(function(){
    $(".advanceFilter").addClass("displayNone").removeClass("displayBlock");
  $(".showAdvFilters").removeClass("displayNone");
  $(".hideAdvFilters").removeClass("displayBlock");
});




/* XEditable Custom + Original JS */
$(function(){
  
   //defaults
   $.fn.editable.defaults.url = '/post'; 

    //enable / disable
   $('#enable').click(function() {
       $('#user .editable').editable('toggleDisabled');
   });    
    
    //editables 
    $('#abridgedName').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'abridgedName',
           title: 'Enter Abridged name'
    });
  $('#callName').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'callName',
           title: 'Call name'
    });officialName
  $('#officialName').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'officialName',
           title: 'Official name'
    });
  $('#dobb').editable();
  $('#gradeSection').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'gradeSection',
           title: 'Enter Grade-Section'
    });  
  var genders = [];
    $.each({"B": "Boy", "G": "Girl"}, function(k, v) {
        genders.push({id: k, text: v});
    }); 
  $('#gender').editable({
        source: genders,
        select2: {
            width: 200,
            placeholder: 'Select gender',
            allowClear: true
        } 
    });
  var houses = [];
    $.each({"J": "Jinnah", "I": "Iqbal", "S": "Syed"}, function(k, v) {
        houses.push({id: k, text: v});
    }); 
  $('#house').editable({
        source: houses,
        select2: {
            width: 200,
            placeholder: 'Select house',
            allowClear: true
        } 
    });
  /* Parent Information Section */
  $('#fatherName').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'fatherName',
           title: 'Enter Father name'
    });
  $('#motherName').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'motherName',
           title: 'Enter Mother name'
    });
  $('#fatherNIC').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'fatherNIC',
           title: 'Enter Father NIC'
    });
  $('#motherNIC').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'motherNIC',
           title: 'Enter Mother NIC'
    });
  $('#fatherMobile').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'fatherMobile',
           title: 'Enter Father Mobile'
    });
  $('#motherMobile').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'motherMobile',
           title: 'Enter Mother Mobile'
    });
  $('#fatherSpec').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'fatherSpec',
           title: 'Enter Father Speciality'
    });
  $('#motherSpec').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'motherSpec',
           title: 'Enter Mother Speciality'
    });
  $('#fatherProf').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'fatherProf',
           title: 'Enter Father Profession'
    });
  $('#motherProf').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'motherProf',
           title: 'Enter Mother Profession'
    });
  $('#fatherOrg').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'fatherOrg',
           title: 'Enter Father Organization'
    });
  $('#motherOrg').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'motherOrg',
           title: 'Enter Mother Organization'
    });
  $('#fatherDept').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'fatherDept',
           title: 'Enter Father Department'
    });
  $('#motherDept').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'motherDept',
           title: 'Enter Mother Department'
    });
  $('#fatherDes').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'fatherDes',
           title: 'Enter Father Designation'
    });
  $('#motherDes').editable({
           url: '/post',
           type: 'text',
           pk: 1,
           name: 'motherDes',
           title: 'Enter Mother Designation'
    });
  
  
  
    
    $('#firstname').editable({
        validate: function(value) {
           if($.trim(value) == '') return 'This field is required';
        }
    });
    
    $('#sex').editable({
        prepend: "not selected",
        source: [
            {value: 1, text: 'Male'},
            {value: 2, text: 'Female'}
        ],
        display: function(value, sourceData) {
             var colors = {"": "gray", 1: "green", 2: "blue"},
                 elem = $.grep(sourceData, function(o){return o.value == value;});
                 
             if(elem.length) {    
                 $(this).text(elem[0].text).css("color", colors[value]); 
             } else {
                 $(this).empty(); 
             }
        }   
    });    
    
    $('#status').editable();   
    
    $('#group').editable({
       showbuttons: false 
    });   

    $('#vacation').editable({
        datepicker: {
            todayBtn: 'linked'
        } 
    });  
        
    $('#dob').editable();
          
    $('#event').editable({
        placement: 'right',
        combodate: {
            firstItem: 'name'
        }
    });      
    
    $('#meeting_start').editable({
        format: 'yyyy-mm-dd hh:ii',    
        viewformat: 'dd/mm/yyyy hh:ii',
        validate: function(v) {
           if(v && v.getDate() == 10) return 'Day cant be 10!';
        },
        datetimepicker: {
           todayBtn: 'linked',
           weekStart: 1
        }        
    });            
    
    $('#comments').editable({
        showbuttons: 'bottom'
    }); 
    
    $('#note').editable(); 
    $('#pencil').click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        $('#note').editable('toggle');
   });   
   
    $('#state').editable({
        source: ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]
    }); 
    
    $('#state2').editable({
        value: 'California',
        typeahead: {
            name: 'state',
            local: ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]
        }
    });   
   
   $('#fruits').editable({
       pk: 1,
       limit: 3,
       source: [
        {value: 1, text: 'banana'},
        {value: 2, text: 'peach'},
        {value: 3, text: 'apple'},
        {value: 4, text: 'watermelon'},
        {value: 5, text: 'orange'}
       ]
    }); 
    
    $('#tags').editable({
        inputclass: 'input-large',
        select2: {
            tags: ['html', 'javascript', 'css', 'ajax'],
            tokenSeparators: [",", " "]
        }
    });   

    var countries = [];
    $.each({"BD": "Bangladesh", "BE": "Belgium", "BF": "Burkina Faso", "BG": "Bulgaria", "BA": "Bosnia and Herzegovina", "BB": "Barbados", "WF": "Wallis and Futuna", "BL": "Saint Bartelemey", "BM": "Bermuda", "BN": "Brunei Darussalam", "BO": "Bolivia", "BH": "Bahrain", "BI": "Burundi", "BJ": "Benin", "BT": "Bhutan", "JM": "Jamaica", "BV": "Bouvet Island", "BW": "Botswana", "WS": "Samoa", "BR": "Brazil", "BS": "Bahamas", "JE": "Jersey", "BY": "Belarus", "O1": "Other Country", "LV": "Latvia", "RW": "Rwanda", "RS": "Serbia", "TL": "Timor-Leste", "RE": "Reunion", "LU": "Luxembourg", "TJ": "Tajikistan", "RO": "Romania", "PG": "Papua New Guinea", "GW": "Guinea-Bissau", "GU": "Guam", "GT": "Guatemala", "GS": "South Georgia and the South Sandwich Islands", "GR": "Greece", "GQ": "Equatorial Guinea", "GP": "Guadeloupe", "JP": "Japan", "GY": "Guyana", "GG": "Guernsey", "GF": "French Guiana", "GE": "Georgia", "GD": "Grenada", "GB": "United Kingdom", "GA": "Gabon", "SV": "El Salvador", "GN": "Guinea", "GM": "Gambia", "GL": "Greenland", "GI": "Gibraltar", "GH": "Ghana", "OM": "Oman", "TN": "Tunisia", "JO": "Jordan", "HR": "Croatia", "HT": "Haiti", "HU": "Hungary", "HK": "Hong Kong", "HN": "Honduras", "HM": "Heard Island and McDonald Islands", "VE": "Venezuela", "PR": "Puerto Rico", "PS": "Palestinian Territory", "PW": "Palau", "PT": "Portugal", "SJ": "Svalbard and Jan Mayen", "PY": "Paraguay", "IQ": "Iraq", "PA": "Panama", "PF": "French Polynesia", "BZ": "Belize", "PE": "Peru", "PK": "Pakistan", "PH": "Philippines", "PN": "Pitcairn", "TM": "Turkmenistan", "PL": "Poland", "PM": "Saint Pierre and Miquelon", "ZM": "Zambia", "EH": "Western Sahara", "RU": "Russian Federation", "EE": "Estonia", "EG": "Egypt", "TK": "Tokelau", "ZA": "South Africa", "EC": "Ecuador", "IT": "Italy", "VN": "Vietnam", "SB": "Solomon Islands", "EU": "Europe", "ET": "Ethiopia", "SO": "Somalia", "ZW": "Zimbabwe", "SA": "Saudi Arabia", "ES": "Spain", "ER": "Eritrea", "ME": "Montenegro", "MD": "Moldova, Republic of", "MG": "Madagascar", "MF": "Saint Martin", "MA": "Morocco", "MC": "Monaco", "UZ": "Uzbekistan", "MM": "Myanmar", "ML": "Mali", "MO": "Macao", "MN": "Mongolia", "MH": "Marshall Islands", "MK": "Macedonia", "MU": "Mauritius", "MT": "Malta", "MW": "Malawi", "MV": "Maldives", "MQ": "Martinique", "MP": "Northern Mariana Islands", "MS": "Montserrat", "MR": "Mauritania", "IM": "Isle of Man", "UG": "Uganda", "TZ": "Tanzania, United Republic of", "MY": "Malaysia", "MX": "Mexico", "IL": "Israel", "FR": "France", "IO": "British Indian Ocean Territory", "FX": "France, Metropolitan", "SH": "Saint Helena", "FI": "Finland", "FJ": "Fiji", "FK": "Falkland Islands (Malvinas)", "FM": "Micronesia, Federated States of", "FO": "Faroe Islands", "NI": "Nicaragua", "NL": "Netherlands", "NO": "Norway", "NA": "Namibia", "VU": "Vanuatu", "NC": "New Caledonia", "NE": "Niger", "NF": "Norfolk Island", "NG": "Nigeria", "NZ": "New Zealand", "NP": "Nepal", "NR": "Nauru", "NU": "Niue", "CK": "Cook Islands", "CI": "Cote d'Ivoire", "CH": "Switzerland", "CO": "Colombia", "CN": "China", "CM": "Cameroon", "CL": "Chile", "CC": "Cocos (Keeling) Islands", "CA": "Canada", "CG": "Congo", "CF": "Central African Republic", "CD": "Congo, The Democratic Republic of the", "CZ": "Czech Republic", "CY": "Cyprus", "CX": "Christmas Island", "CR": "Costa Rica", "CV": "Cape Verde", "CU": "Cuba", "SZ": "Swaziland", "SY": "Syrian Arab Republic", "KG": "Kyrgyzstan", "KE": "Kenya", "SR": "Suriname", "KI": "Kiribati", "KH": "Cambodia", "KN": "Saint Kitts and Nevis", "KM": "Comoros", "ST": "Sao Tome and Principe", "SK": "Slovakia", "KR": "Korea, Republic of", "SI": "Slovenia", "KP": "Korea, Democratic People's Republic of", "KW": "Kuwait", "SN": "Senegal", "SM": "San Marino", "SL": "Sierra Leone", "SC": "Seychelles", "KZ": "Kazakhstan", "KY": "Cayman Islands", "SG": "Singapore", "SE": "Sweden", "SD": "Sudan", "DO": "Dominican Republic", "DM": "Dominica", "DJ": "Djibouti", "DK": "Denmark", "VG": "Virgin Islands, British", "DE": "Germany", "YE": "Yemen", "DZ": "Algeria", "US": "United States", "UY": "Uruguay", "YT": "Mayotte", "UM": "United States Minor Outlying Islands", "LB": "Lebanon", "LC": "Saint Lucia", "LA": "Lao People's Democratic Republic", "TV": "Tuvalu", "TW": "Taiwan", "TT": "Trinidad and Tobago", "TR": "Turkey", "LK": "Sri Lanka", "LI": "Liechtenstein", "A1": "Anonymous Proxy", "TO": "Tonga", "LT": "Lithuania", "A2": "Satellite Provider", "LR": "Liberia", "LS": "Lesotho", "TH": "Thailand", "TF": "French Southern Territories", "TG": "Togo", "TD": "Chad", "TC": "Turks and Caicos Islands", "LY": "Libyan Arab Jamahiriya", "VA": "Holy See (Vatican City State)", "VC": "Saint Vincent and the Grenadines", "AE": "United Arab Emirates", "AD": "Andorra", "AG": "Antigua and Barbuda", "AF": "Afghanistan", "AI": "Anguilla", "VI": "Virgin Islands, U.S.", "IS": "Iceland", "IR": "Iran, Islamic Republic of", "AM": "Armenia", "AL": "Albania", "AO": "Angola", "AN": "Netherlands Antilles", "AQ": "Antarctica", "AP": "Asia/Pacific Region", "AS": "American Samoa", "AR": "Argentina", "AU": "Australia", "AT": "Austria", "AW": "Aruba", "IN": "India", "AX": "Aland Islands", "AZ": "Azerbaijan", "IE": "Ireland", "ID": "Indonesia", "UA": "Ukraine", "QA": "Qatar", "MZ": "Mozambique"}, function(k, v) {
        countries.push({id: k, text: v});
    }); 
  
    $('#country').editable({
        source: countries,
        select2: {
            width: 200,
            placeholder: 'Select country',
            allowClear: true
        } 
    });      


    
    $('#address').editable({
        url: '/post',
        value: {
            city: "Moscow", 
            street: "Lenina", 
            building: "12"
        },
        validate: function(value) {
            if(value.city == '') return 'city is required!'; 
        },
        display: function(value) {
            if(!value) {
                $(this).empty();
                return; 
            }
            var html = '<b>' + $('<div>').text(value.city).html() + '</b>, ' + $('<div>').text(value.street).html() + ' st., bld. ' + $('<div>').text(value.building).html();
            $(this).html(html); 
        }         
    });              
         
   $('#user .editable').on('hidden', function(e, reason){
        if(reason === 'save' || reason === 'nochange') {
            var $next = $(this).closest('tr').next().find('.editable');
            if($('#autoopen').is(':checked')) {
                setTimeout(function() {
                    $next.editable('show');
                }, 300); 
            } else {
                $next.focus();
            } 
        }
   });
   
});



  $(document).on ("keyup", "#Referal_code", function(){
  
  

var  no_spl_char ='';


  var yourInput = $(this).val();
    re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
       no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
      
    }else {
      no_spl_char = $(this).val();
    }



$(this).val( no_spl_char.toUpperCase() );


} );


 

 

// Kashif Solangi
$(document).ready(function(){
  
// GF ID  
if ($('#form_no').length) {
  $('#form_no').mask('99999', {
    placeholder: 'X'
  });
} 
  
// Date range
if ($('#date_of_birth').length) {
  
  $('#date_of_birth').datepicker({
    changeMonth: true,
        changeYear: true,
    dateFormat: 'yy-mm-dd',
    prevText: '<i class="fa fa-chevron-left"></i>',
    nextText: '<i class="fa fa-chevron-right"></i>',
    onSelect: function(date) {
      getadmissiongradedob(date);
    },
  }); 

} 

if ($('#f_nic').length) {
  $('#f_nic').mask('99999-9999999-9', {
        placeholder: 'X'
   });
}


// Father NIC
if ($('#father_nic').length) {
  $('#father_nic').mask('99999-9999999-9', {
        placeholder: 'X'
   });
}
// Mother NIC
if ($('#mother_nic').length) {
  $('#mother_nic').mask('99999-9999999-9', {
        placeholder: 'X'
   });
} 
  
  
// // father mobile
// if ($('#father_mobile').length) {
//   $('#father_mobile').mask('0399-9999999', {
//         placeholder: 'X'
//    });
// } 
  

// // mother_mobile 
// if ($('#mother_mobile').length) {
//   $('#mother_mobile').mask('0399-9999999', {
//         placeholder: 'X'
//    });
// } 
  
  
$(document).on("keyup", "#gf_id", function(){
  var gfid = $(this).val();
  var f_nic = '';
  //console.log( value.length );
  if ( gfid.indexOf("X") >= 0 ){
    //console.log( 0 );
  }else{
    //console.log( 1 );
    if( gfid.length == 6 ){
      getdataByGfId(gfid,f_nic);  
    }
    
  }
}); 


// Issuance Form Listing Data Table 
$('#issuanceFormListing').dataTable({
  "order": [],
    "columnDefs": [{ "targets"  : 'no-sort', "orderable": false, }]
});


$("#submission").bind("keypress", function(e) {
  if (e.keyCode == 13) return false;
});
    

});


var checklistRequired = function checklistRequired(){
    var checklistIDs = [ 'ACCIEX', 'APCOSR', 'PRFSSE']
    var checklistFlag = true;
    for (var i = 0; i < checklistIDs.length; i++) {
        // Check if element exists or not
        if($("#"+ checklistIDs[i]).length > 0) {
          if(!$("#"+ checklistIDs[i]).is(':checked')){
            
            $(".div_"+checklistIDs[i] ).addClass("state-error");
            
            checklistFlag = false;
          } else {
            $(".div_"+checklistIDs[i] ).removeClass("state-error");
          }
        }



    }

    return checklistFlag;
  }

//https://jqueryvalidation.org/required-method/   
$(document).on("click", "#greenBTN", function(){

var today = new Date().toISOString().split('T')[0];
$('#discussion_date').attr('min' , today);
checklistRequired();
$("#submission").validate({

rules: {
  official_name: { required: true },
  call_name: { required: true, rangelength: [3, 9]},
  date_of_birth: { required: true },
  gender: { required: true },
  father_name: { required: true },
  father_mobile: { 
    required:true 
  },
  mother_name: { required: true },
  mother_mobile: { required:true },
  father_nic: { required: true },
  father_email: { email:true },
  mother_email:{ email:true  },
  ps:{ required:true  },
  bco:{ required:true  },
  bcc:{ required:true  },
  alevel_supplement: {required:true },
  discussion_date: { required: true },
  discussion_time: { required: true }

  
},
messages: {
  official_name: { required: '' },
  call_name: { required: '' },
  date_of_birth: { required: '' },
  gender: { required: '' },
  father_name: { required: '' },
  father_mobile: { required: '' },
  father_nic: { required: '' },
  father_email: { email: '' },
  mother_email: { email: '' },
  mother_mobile: { required: '' },
  mother_name: { required: '' },
  ps:{ required:''  },
  bco:{ required:''  },
  bcc:{ required:''  },
  alevel_supplement: {required:'' },
  discussion_date: { required: '' },
  discussion_time: { required: '' } 
},
submitHandler: function(form){
  $(form).ajaxSubmit({
    beforeSend: function(){
    if( !$("#alevelChecklisFlag").val() ){
        return checklistRequired();
    }
     $("#ajaxloader").show(); 
   },
    uploadProgress: function (event, position, total, percentComplete){},
    dataType: "JSON",
    success: function(res){

    $("#ajaxloader").hide();
    //refreshForm();
    //reload_table_data();
    call_pdf_submissionForm(res.form_id);
    window.location.reload();
    }
  });
},
errorPlacement: function (error, element) {
error.insertAfter(element.parent());

}
});// end validate

});// end on click button
   
   
   
   
   //https://jqueryvalidation.org/required-method/    
$(document).on("click", "#greenBTN2", function(){

// add the rule here
 $.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg != value;
 }, "Value must not equal arg.");
 
 
$("#submission").validate({
rules: {
  official_name: { required: true },
  call_name: { required: true, rangelength: [3, 9]},
  date_of_birth: { required: true },
  gender: { required: true },
  father_name: { required: true },
  father_mobile: { required:true },
  father_nic: { required: true },
  father_email: { email:true },
  mother_email:{ email:true  },
  batch_name:{  valueNotEquals: "" },
  submission_time:{ valueNotEquals: "" },
  ps:{ required:true  },
  bco:{ required:true  },
  bcc:{ required:true  },
  alevel_supplement: { required: true } },
messages: {
  official_name: { required: '' },
  call_name: { required: '' },
  date_of_birth: { required: '' },
  gender: { required: '' },
  father_name: { required: '' },
  father_mobile: { required: '' },
  father_nic: { required: '' },
  father_email: { email: '' },
  mother_email: { email: '' },
  batch_name: { valueNotEquals: '' },
  submission_time: { valueNotEquals: '' },
  ps:{ required:''  },
  bco:{ required:''  },
  bcc:{ required:''  },
  alevel_supplement: {required:'' }
  
},
submitHandler: function(form){
  $(form).ajaxSubmit({
    beforeSend: function(e){ 
    if( !$("#alevelChecklisFlag").val() ){
        return checklistRequired();
    }     

      $("#ajaxloader").show(); },
    uploadProgress: function (event, position, total, percentComplete){},
    dataType: "JSON",
    success: function(res){
    //console.log(res);
    $("#ajaxloader").hide();
    refreshForm();
    reload_table_data()
    call_pdf_submissionForm(res.form_id);
    window.location.reload();
    }
  });
},
errorPlacement: function (error, element) {
error.insertAfter(element.parent());
}
});// end validate


});// end on click button



 
 
function getdataByGfId(gf_id,f_nic){  
var lenght = gf_id.length;
$.ajax({
type: "POST",
url : "<?=base_url();?>index.php/gs_admission/ajax_base/getDataByGfId/",
data: {gf_id:gf_id,f_nic:f_nic},
dataType: "JSON",
beforeSend: function(){},
success: function(res){
$("#father_name").val('');
$("#father_mobile").val('');
$("#father_nic").val('');
$("#father_email").val('');
$("#mother_name").val('');
$("#mother_mobile").val('');
$("#mother_nic").val('');
$("#mother_email").val('');
$("#family_exists").val(0);
if(!res){ }else{
var gf_id = parseInt( res.f_id );
var single_parent = parseInt( res.s_p );
var primary_contact = parseInt( res.p_c);


$("#father_name").val( res.f_name );
$("#father_mobile").val(res.f_mobile_phone);
$("#father_nic").val(res.f_nic);
$("#father_email").val(res.f_email);
$("#mother_name").val( res.m_name );
$("#mother_mobile").val(res.m_mobile_phone);
$("#mother_nic").val(res.m_nic);
$("#mother_email").val(res.m_email);

$("#father_nic").prop("readonly",true);
if( primary_contact == 1){
$( "#primary_contact1" ).prop( "checked", false );
$( "#primary_contact2" ).prop( "checked", true );
$("#mother_name").prop("readonly",true);
$("#mother_mobile").prop("readonly",true);
}else{
$( "#primary_contact2" ).prop( "checked", false );
$( "#primary_contact1" ).prop( "checked", true );
$("#father_name").prop("readonly",true);
$("#father_mobile").prop("readonly",true);
}
if( single_parent == 1 ){
$( "#c2" ).prop( "checked", true ); 
}else{
$( "#c2" ).prop( "checked", false );
}
if( gf_id == '' ){
$("#family_exists").val(gf_id);
}else{
$("#family_exists").val(gf_id); 
}
}
},
complete:function(){ },
error:function(){}
});
    
  //}
  
}



$(document).on("click", ".view_n_print", function(){
  
  var data_id = $(this).attr("data-id");
  var data_id = parseInt( data_id );
  console.log(data_id);
  
  call_pdf_submissionForm(data_id);
  
});

$(document).on("click", ".view_n_Edit", function(){
  
  var data_id = $(this).attr("data-id");
  var data_id = parseInt( data_id );
  //console.log(data_id);
  
  getAppDtEdt( data_id );
  
});

$(document).on("click", ".print_discussion_sheet", function(){
  
  var data_id = $(this).attr("data-id");
  var data_id = parseInt( data_id );
  console.log(data_id);
  
  call_pdf_getDiscussionSheet( data_id );
  
});

$(document).on("change", ".switch-input",  function(){

    var discussion_status =  $('input[name=discussion_status]:checked').val();
    if(discussion_status == 'today'){

        $('#discussion_date').hide();
        $('#discussion_time').hide();        
        var today = new Date();
        var dd = today.getDate();

        var mm = today.getMonth()+1; 
        var yyyy = today.getFullYear();
        if(dd<10) 
        {
            dd='0'+dd;
        } 

        if(mm<10) 
        {
            mm='0'+mm;
        } 
        today = yyyy+'-'+mm+'-'+dd;
        var today_time =  new Date().toLocaleTimeString('en-US', { hour12: false, 
                                             hour: "numeric", 
                                             minute: "numeric"});
        $('#discussion_date').val(today);
        $('#discussion_time').val(today_time);
        $('#discussion_date').rules('remove', 'required');
        $('#discussion_time').rules('remove', 'required');


        
    } else {
        $('#discussion_date').show();
        $('#discussion_time').show();        
       $('#discussion_date').val('');
       $('#discussion_time').val('');      
    }
 

});
function getAppDtEdt(data_id){
  
  var ad = $("#form_data");
  if( data_id > 0 ){
    $.ajax({
    type: "POST",
    url : "<?=base_url();?>index.php/gs_admission/ajax_base/submissionDetailsEdit2",
    data: {data_id:data_id},
    dataType: "HTML",
    beforeSend: function(){},
    success: function(res){
      //console.log(res)
      ad.html('');
      ad.html(res);
      
    },
    complete:function(){ },
    error:function(){}
    });
  }
}


function getadmissiongradedob(dateOfBirth){
  //console.log(dateOfBirth)
    $.ajax({
    type: "POST",
    url : "<?=base_url();?>index.php/gs_admission/ajax_base/admissionGrade",
    data: {dob:dateOfBirth},
    dataType: "JSON",
    beforeSend: function(){},
    success: function(res){
      $("#admission_grade").val( res[0].grade_name );
      $("#admission_grade_id").val( parseInt( res[0].grade_id ) );
    },
    complete:function(){ },
    error:function(){}
    });
  
}



function refreshForm(){
  
    $.ajax({
    type: "POST",
    url : "<?=base_url();?>index.php/gs_admission/ajax_base/refreshFormSubmission",
    dataType: "HTML",
    beforeSend: function(){},
    success: function(res){
      $("#form_data").html('');
      $("#form_data").html(res);
    },
    complete:function(){ },
    error:function(){}
    });
  
}



function reload_table_data(){
  //console.log(dateOfBirth)
    $.ajax({
    type: "POST",
    url : "<?=base_url();?>index.php/gs_admission/ajax_base/reloadSubmissionTable",
    dataType: "HTML",
    beforeSend: function(){},
    success: function(res){
      $("#MaroonBorderBox2").html('');
      $("#MaroonBorderBox2").html(res);
    },
    complete:function(){ },
    error:function(){}
    });
  
}

//$(document).on("click", "#greenBTN3", function(){ refreshForm(); });

$(document).on("click", "#greenBTN3", function(){ 
//refreshForm();
 $('.submission_form').hide();

 $('#form_no').val(''); 
 
});

$(document).on("click","#reloadList", function(){
  
  $.ajax({
    type: "POST",
    url : "<?=base_url();?>index.php/gs_admission/ajax_base/reloadFormList",
    dataType: "JSON",
    beforeSend: function(){},
    success: function(res){
      //console.log(res)
      $("#myTotal").html('');
      $("#myTotal").html(res.ml);
      $("#grandTotal").html('');
      $("#grandTotal").html(' / '+res.gt);
      reload_table_data();
    },
    complete:function(){ },
    error:function(){}
    });
    
});


var multiplePhoneHTML = function multiplePhoneHTML(name, numbers){

      if( numbers === null || numbers == ''){
          return '';
      } else if( numbers.indexOf(",") == -1){
         // var html = '<input name="'+name+'_mobile[]" type="text" class="col-md-10" placeholder="Mobile" id="'+name+'_mobile" value="'+numbers+'"><br><br><br> '; 
          //return html;
        }
        
      var mobile_numbers = numbers.split(',');

      var mobileNumberHTML = '';
      selectedValue = [];
      className = [];
      for (var i = 0; i < mobile_numbers.length; i++) {
    
        if(  mobile_numbers[i] != null && mobile_numbers[i] != undefined && mobile_numbers[i] != '' ){

          var number = mobile_numbers[i].split('-');
          var buttonHtml = ' <a href="#" class="remove_field'+(name == 'student' ? "": ( name == 'father' ? 1 : 2 ) )+'">X</a>';
          if(i == 0 && name == 'student' ){
            buttonHtml = '<button type="button" class="add_field_button">+</button>';
          } 
          mobileNumberHTML += '<div class="other_mobile_numbers input_fields_wrap'+(name == 'student' ? "" : "_additional_"+name )+'"><select class="'+name+'_mobile_code_'+i+' countryCodeNumber" name="'+name+'_mobile_code[]" > <!-- Countries often selected by users can be moved to the top of the list. --> <!-- Countries known to be subject to general US embargo are commented out by default. --> <!-- The data-countryCode attribute is populated with ISO country code, and value is int l calling code. --> <option data-countrycode="US" value="1">+1</option> <option data-countrycode="GB" value="44">+44</option> <option data-countrycode="DZ" value="213">+213</option> <option data-countrycode="AD" value="376">+376</option> <option data-countrycode="AO" value="244">+244</option> <option data-countrycode="AI" value="1264">+1264</option> <option data-countrycode="AG" value="1268">+1268</option> <option data-countrycode="AR" value="54">+54</option> <option data-countrycode="AM" value="374">+374</option> <option data-countrycode="AW" value="297">+297</option> <option data-countrycode="AU" value="61">+61</option> <option data-countrycode="AT" value="43">+43</option> <option data-countrycode="AZ" value="994">+994</option> <option data-countrycode="BS" value="1242">+1242</option> <option data-countrycode="BH" value="973">+973</option> <option data-countrycode="BD" value="880">+880</option> <option data-countrycode="BB" value="1246">+1246</option> <option data-countrycode="BY" value="375">+375</option> <option data-countrycode="BE" value="32">+32</option> <option data-countrycode="BZ" value="501">+501</option> <option data-countrycode="BJ" value="229">+229</option> <option data-countrycode="BM" value="1441">+1441</option> <option data-countrycode="BT" value="975">+975</option> <option data-countrycode="BO" value="591">+591</option> <option data-countrycode="BA" value="387">+387</option> <option data-countrycode="BW" value="267">+267</option> <option data-countrycode="BR" value="55">+55</option> <option data-countrycode="BN" value="673">+673</option> <option data-countrycode="BG" value="359">+359</option> <option data-countrycode="BF" value="226">+226</option> <option data-countrycode="BI" value="257">+257</option> <option data-countrycode="KH" value="855">+855</option> <option data-countrycode="CM" value="237">+237</option> <option data-countrycode="CA" value="1">+1</option> <option data-countrycode="CV" value="238">+238</option> <option data-countrycode="KY" value="1345">+1345</option> <option data-countrycode="CF" value="236">+236</option> <option data-countrycode="CL" value="56">+56</option> <option data-countrycode="CN" value="86">+86</option> <option data-countrycode="CO" value="57">+57</option> <option data-countrycode="KM" value="269">+269</option> <option data-countrycode="CG" value="242">+242</option> <option data-countrycode="CK" value="682">+682</option> <option data-countrycode="CR" value="506">+506</option> <option data-countrycode="HR" value="385">+385</option> <!-- <option data-countryCode="CU" value="53">Cuba +53</option> --> <option data-countrycode="CY" value="90">+90</option> <option data-countrycode="CY" value="357">+357</option> <option data-countrycode="CZ" value="420">+420</option> <option data-countrycode="DK" value="45">+45</option> <option data-countrycode="DJ" value="253">+253</option> <option data-countrycode="DM" value="1809">+1809</option> <option data-countrycode="DO" value="1809">+1809</option> <option data-countrycode="EC" value="593">+593</option> <option data-countrycode="EG" value="20">+20</option> <option data-countrycode="SV" value="503">+503</option> <option data-countrycode="GQ" value="240">+240</option> <option data-countrycode="ER" value="291">+291</option> <option data-countrycode="EE" value="372">+372</option> <option data-countrycode="ET" value="251">+251</option> <option data-countrycode="FK" value="500">+500</option> <option data-countrycode="FO" value="298">+298</option> <option data-countrycode="FJ" value="679">+679</option> <option data-countrycode="FI" value="358">+358</option> <option data-countrycode="FR" value="33">+33</option> <option data-countrycode="GF" value="594">+594</option> <option data-countrycode="PF" value="689">+689</option> <option data-countrycode="GA" value="241">+241</option> <option data-countrycode="GM" value="220">+220</option> <option data-countrycode="GE" value="7880">+7880</option> <option data-countrycode="DE" value="49">+49</option> <option data-countrycode="GH" value="233">+233</option> <option data-countrycode="GI" value="350">+350</option> <option data-countrycode="GR" value="30">+30</option> <option data-countrycode="GL" value="299">+299</option> <option data-countrycode="GD" value="1473">+1473</option> <option data-countrycode="GP" value="590">+590</option> <option data-countrycode="GU" value="671">+671</option> <option data-countrycode="GT" value="502">+502</option> <option data-countrycode="GN" value="224">+224</option> <option data-countrycode="GW" value="245">+245</option> <option data-countrycode="GY" value="592">+592</option> <option data-countrycode="HT" value="509">+509</option> <option data-countrycode="HN" value="504">+504</option> <option data-countrycode="HK" value="852">+852</option> <option data-countrycode="HU" value="36">+36</option> <option data-countrycode="IS" value="354">+354</option> <option data-countrycode="IN" value="91">+91</option> <option data-countrycode="ID" value="62">+62</option> <option data-countrycode="IQ" value="964">+964</option> <!-- <option data-countryCode="IR" value="98">Iran +98</option> --> <option data-countrycode="IE" value="353">+353</option> <option data-countrycode="IL" value="972">+972</option> <option data-countrycode="IT" value="39">+39</option> <option data-countrycode="JM" value="1876">+1876</option> <option data-countrycode="JP" value="81">+81</option> <option data-countrycode="JO" value="962">+962</option> <option data-countrycode="KZ" value="7">+7</option> <option data-countrycode="KE" value="254">+254</option> <option data-countrycode="KI" value="686">+686</option> <option data-countrycode="KR" value="82">+82</option> <option data-countrycode="KW" value="965">+965</option> <option data-countrycode="KG" value="996">+996</option> <option data-countrycode="LA" value="856">+856</option> <option data-countrycode="LV" value="371">+371</option> <option data-countrycode="LB" value="961">+961</option> <option data-countrycode="LS" value="266">+266</option> <option data-countrycode="LR" value="231">+231</option> <option data-countrycode="LY" value="218">+218</option> <option data-countrycode="LI" value="417">+417</option> <option data-countrycode="LT" value="370">+370</option> <option data-countrycode="LU" value="352">+352</option> <option data-countrycode="MO" value="853">+853</option> <option data-countrycode="MK" value="389">+389</option> <option data-countrycode="MG" value="261">+261</option> <option data-countrycode="MW" value="265">+265</option> <option data-countrycode="MY" value="60">+60</option> <option data-countrycode="MV" value="960">+960</option> <option data-countrycode="ML" value="223">+223</option> <option data-countrycode="MT" value="356">+356</option> <option data-countrycode="MH" value="692">+692</option> <option data-countrycode="MQ" value="596">+596</option> <option data-countrycode="MR" value="222">+222</option> <option data-countrycode="YT" value="269">+269</option> <option data-countrycode="MX" value="52">+52</option> <option data-countrycode="FM" value="691">+691</option> <option data-countrycode="MD" value="373">+373</option> <option data-countrycode="MC" value="377">+377</option> <option data-countrycode="MN" value="976">+976</option> <option data-countrycode="MS" value="1664">+1664</option> <option data-countrycode="MA" value="212">+212</option> <option data-countrycode="MZ" value="258">+258</option> <option data-countrycode="MN" value="95">+95</option> <option data-countrycode="NA" value="264">+264</option> <option data-countrycode="NR" value="674">+674</option> <option data-countrycode="NP" value="977">+977</option> <option data-countrycode="NL" value="31">+31</option> <option data-countrycode="NC" value="687">+687</option> <option data-countrycode="NZ" value="64">+64</option> <option data-countrycode="NI" value="505">+505</option> <option data-countrycode="NE" value="227">+227</option> <option data-countrycode="NG" value="234">+234</option> <option data-countrycode="NU" value="683">+683</option> <option data-countrycode="NF" value="672">+672</option> <option data-countrycode="NP" value="670">+670</option> <option data-countrycode="NO" value="47">+47</option> <option data-countrycode="OM" value="968">+968</option> <option selected="" data-countrycode="PK" value="92">+92</option> <option data-countrycode="PW" value="680">+680</option> <option data-countrycode="PA" value="507">+507</option> <option data-countrycode="PG" value="675">+675</option> <option data-countrycode="PY" value="595">+595</option> <option data-countrycode="PE" value="51">+51</option> <option data-countrycode="PH" value="63">+63</option> <option data-countrycode="PL" value="48">+48</option> <option data-countrycode="PT" value="351">+351</option> <option data-countrycode="PR" value="1787">+1787</option> <option data-countrycode="QA" value="974">+974</option> <option data-countrycode="RE" value="262">+262</option> <option data-countrycode="RO" value="40">+40</option> <option data-countrycode="RU" value="7">+7</option> <option data-countrycode="RW" value="250">+250</option> <option data-countrycode="SM" value="378">+378</option> <option data-countrycode="ST" value="239">+239</option> <option data-countrycode="SA" value="966">+966</option> <option data-countrycode="SN" value="221">+221</option> <option data-countrycode="CS" value="381">+381</option> <option data-countrycode="SC" value="248">+248</option> <option data-countrycode="SL" value="232">+232</option> <option data-countrycode="SG" value="65">+65</option> <option data-countrycode="SK" value="421">+421</option> <option data-countrycode="SI" value="386">+386</option> <option data-countrycode="SB" value="677">+677</option> <option data-countrycode="SO" value="252">+252</option> <option data-countrycode="ZA" value="27">+27</option> <option data-countrycode="ES" value="34">+34</option> <option data-countrycode="LK" value="94">+94</option> <option data-countrycode="SH" value="290">+290</option> <option data-countrycode="KN" value="1869">+1869</option> <option data-countrycode="SC" value="1758">+1758</option> <option data-countrycode="SR" value="597">+597</option> <option data-countrycode="SD" value="249">+249</option> <option data-countrycode="SZ" value="268">+268</option> <option data-countrycode="SE" value="46">+46</option> <option data-countrycode="CH" value="41">+41</option> <!-- <option data-countryCode="SY" value="963">Syria +963</option> --> <option data-countrycode="TW" value="886">+886</option> <option data-countrycode="TJ" value="992">+992</option> <option data-countrycode="TH" value="66">+66</option> <option data-countrycode="TG" value="228">+228</option> <option data-countrycode="TO" value="676">+676</option> <option data-countrycode="TT" value="1868">+1868</option> <option data-countrycode="TN" value="216">+216</option> <option data-countrycode="TR" value="90">+90</option> <option data-countrycode="TM" value="993">+993</option> <option data-countrycode="TC" value="1649">+1649</option> <option data-countrycode="TV" value="688">+688</option> <option data-countrycode="UG" value="256">+256</option> <option data-countrycode="UA" value="380">+380</option> <option data-countrycode="AE" value="971">+971</option> <option data-countrycode="UY" value="598">+598</option> <option data-countrycode="UZ" value="998">+998</option> <option data-countrycode="VU" value="678">+678</option> <option data-countrycode="VA" value="379">+379</option> <option data-countrycode="VE" value="58">+58</option> <option data-countrycode="VN" value="84">+84</option> <option data-countrycode="VG" value="1">+1</option> <option data-countrycode="VI" value="1">+1</option> <option data-countrycode="WF" value="681">+681</option> <option data-countrycode="YE" value="969">+969</option> <option data-countrycode="YE" value="967">+967</option> <option data-countrycode="ZM" value="260">+260</option> <option data-countrycode="ZW" value="263">+263</option> </select><input type="number" class="col-md-10" placeholder="Mobile" id="'+name+'_mobile_'+i+'" value="'+number[1]+'" style="padding-left:80px;" name="'+name+'_mobile_phone[]">'+ buttonHtml +'</div>' ;

            selectedValue.push(number[0])
            className.push('.'+name+'_mobile_code_'+i)
            //$('.father_mobile_code_0' ).val(number[0])         
            // console.log(x.value);
            

         // mobileNumberHTML += '<input name="'+name+'_mobile_other[]" type="text" class="col-md-10 other_mobile_numbers" placeholder="Mobile" id="'+name+'_mobile_'+i+'"  value="+'+number[0]+number[1]+'">';
        }


      }
      return mobileNumberHTML;
}
$(document).on("keyup", "#form_no", function(){
  
  $('.submission_form').show();

  var formno = $(this).val();
  //console.log(form_no);
  
  $("#form_id").val('');
  $("#Fmly_Reg_ID").val('');
  
  
  $("#father_name").val('');
  $("#father_mobile").val('');
  $("#father_nic").val('');
  $("#father_email").val('');
  $("#mother_name").val('');
  $("#mother_mobile").val('');
  $("#mother_nic").val('');
  $("#mother_email").val('');
  
        
        
  if ( formno.indexOf("X") >= 0 ){

    $('.submission_form').hide();

  }else{
    
    
    $.ajax({
    type: "POST",
    url : "<?=base_url();?>index.php/gs_admission/submission_ajax/getFormData",
    data:{form_no:formno},
    dataType: "JSON",
    beforeSend: function(){},
    success: function(res){
    //console.log(res)
    //,
    
    // Form_status
    
    /*{"Form_id":"21","Form_no":"1","Token_no":"1","Gf_id":"16002","Applicate_name":"Boy 1","Call_name":"by1"
,"Dob":"2009-12-30","Batch_id":"1","Gender":"B","Photo_submitted":"1","Birth_o":"1","Birth_c":"1","Grade_id"
:"6","Grade_name":"III","Academic":"9","Form_status":"1","Submission_date":"2017-01-16","Campus":"1"
,"Comments":"Comments Will Come Here","Family_reg_id":"18","Primary_contact":"0","Father_name":"Kashif
 Mustafa Solangi","Father_mobile":"0331-3538835","Father_nic":"41201-4862879-5","Mother_name":"Mother
 Name","Mother_mobile":"0331-3538835","Mother_nic":"41201-4862879-5","Father_email":"kashifmustafasolangi
@gmail.com","Mother_email":"mother_email@gmail.com","single_parent":"0","primary_contact":"0"}*/

    if(!res){ }else{
          
        //var gf_id = parseInt( res.f_id );
        //var single_parent = parseInt( res.s_p );
        //var primary_contact = parseInt( res.p_c);
        
        
        
        //$("#official_name").val( res.Applicate_name );
        //$("#call_name").val( res.Call_name );
        //$("#date_of_birth").val( res.Dob );
        
        $("#Referal_code").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.referal_code); });


        $("#official_name").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Applicate_name); });
        $("#official_name").prop("disabled", true);
        $("#call_name").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Call_name); });
        $("#call_name").prop("disabled", true);
        $("#date_of_birth").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Dob); });
        $("#date_of_birth").prop("disabled", true);
        
        $("#admission_grade").val( res.Grade_name );
        var grades = ['A1', 'A2']
        $("#admission_grade").val( res.Grade_name );

        if( grades.indexOf(res.Grade_name) == -1  ){
              $("#discussion_date").val('')
              $("#discussion_time").val('')
              $(".alevelBox").hide()
              $("#alevelChecklisFlag").val(1)
        } else {
            $("#discussion_date").val('')
            $("#discussion_time").val('')          
            $(".alevelBox").show()
            $("#alevelChecklisFlag").val(0)
        }
        $("#admission_grade").prop("disabled", true);
        $("#admission_grade_id").val( res.Grade_id );
        
        $("#primary_contact").val( res.primary_contact );
        
        
        if( res.Grade_id > 2  ){ 
          $("#previousData").show();
        }else{
          $("#previousData").hide();  
        }
        
        //$("#gender").val( res.Gender );
        
        $('#gender option').each(function() {
          if($(this).val() == res.Gender ) {
            $(this).prop("selected", true);
          }
          $("#gender").prop("disabled", true);
        });
        
        var selected = 0;

        $('#previous_school option').each(function() {
          

          if($(this).val() == res.PS_id ) {
            $(this).prop("selected", true);
            selected = 1;

          }
          
        });  
        $('#previous_grade option').each(function() {
          if($(this).val() == res.PG_id ) {
            $(this).prop("selected", true);
          }
        });

        if(selected == 0){
          $('#previous_school').val('Previous School');
          $('#previous_grade').val('Previous Grade');
          
        }      
        // setInterval(function(){ 
        

        
        // }, 3000);
        
        // setInterval(function(){ 
        
        // $('#previous_grade option').each(function() {
        //   if($(this).val() == res.PG_id ) {
        //     $(this).prop("selected", true);
        //   }
        // });
        
        // }, 3000);
        
        //$('#father_name').animate({'opacity': 0}, 1000, function () {$(this).val(res.Father_name);});
   
        $('#student_mobile_div').nextAll('input').remove();
        $('#student_mobile_div').nextAll('br').remove();
        $('#father_mobile').nextAll('br').remove();

        

        $('.other_mobile_numbers').remove()

        // $('#father_mobile').nextAll('input').remove();
        $( "#student_mobile_div" ).after( multiplePhoneHTML('student',res.Student_mobile ) );
        //Setting country code for selectbox for student other mobile number
        for(var i = 0 ; i< selectedValue.length; i++){
          
          $(className[i]).val(selectedValue[i])
        }
        
        $( "#father_mobile" ).after( multiplePhoneHTML('father',res.Father_mobile_other ) );
        //Setting country code for selectbox for father other mobile number
        for(var i = 0 ; i< selectedValue.length; i++){
          
          $(className[i]).val(selectedValue[i])
        }        
        $( "#mother_mobile" ).after( multiplePhoneHTML('mother',res.Mother_mobile_other ) );

       //Setting country code for selectbox for father other mobile number
        for(var i = 0 ; i< selectedValue.length; i++){
          
          $(className[i]).val(selectedValue[i])
        }
        $("#discussion_date").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Form_discussion_date); });
        $("#discussion_time").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Form_discussion_time); });

        if(res.Alevel_checklist !== null){
          var checklist = res.Alevel_checklist;
          checklist = checklist.split(',');
          for (var i = 0; i < checklist.length; i++) {
            $( "#"+checklist[i] ).prop( "checked", true );
          }
        }

        $("#form_id").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Form_id); });
        $("#Fmly_Reg_ID").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Family_reg_id); });
        $("#student_mobile").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Student_mobile); });
        $("#student_email").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Student_email); });
        $("#student_nic").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Student_nic); });        
        $("#father_name").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Father_name); });
        var father_mob_number = res.Father_mobile;
        father_mob_number = father_mob_number.substring(1);
        father_mob_number = father_mob_number.replace('-','');

        $("#father_mobile").delay( 800 ).fadeIn("slow",function(){ $(this).val( father_mob_number 
           ) ; });
        $("#father_nic").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Father_nic); });
        $("#father_email").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Father_email); });
        $("#mother_name").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Mother_name); });
        var mother_mob_number = res.Mother_mobile;
        mother_mob_number = mother_mob_number.substring(1);
        mother_mob_number = mother_mob_number.replace('-','');
        $("#mother_mobile").delay( 800 ).fadeIn("slow",function(){ $(this).val(mother_mob_number); });
        $("#mother_nic").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Mother_nic); });
        $("#mother_email").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Mother_email); });
        $("#father_nic").prop("readonly",true); 
        $("#father_name").prop("readonly",true);
        var primary_contact = parseInt( res.primary_contact);
        
        if( primary_contact == 1 ){
          $("#mother_name").prop("readonly",true);  
          $("#mother_mobile").prop("readonly",true);  
          $("#mother_name").attr("placeholder", "Mother Name *");
          $("#mother_mobile").attr("placeholder", "Mother Mobile *");
          $("#mother_nic").attr("placeholder", "Mother NIC *");
          
          $("#father_name").attr("placeholder", "Father Name");
          $("#father_mobile").attr("placeholder", "Father Mobile");
          $("#father_nic").attr("placeholder", "Father NIC");
          
          
        }else{
          //$("#father_mobile").prop("readonly",true);  
          $("#mother_name").attr("placeholder", "Mother Name");
          $("#mother_mobile").attr("placeholder", "Mother Mobile");
          $("#mother_nic").attr("placeholder", "Mother NIC");
          $("#mother_email").attr("placeholder", "Mother Email");
          
          $("#father_name").attr("placeholder", "Father Name *");
          $("#father_mobile").attr("placeholder", "Father Mobile *");
          $("#father_nic").attr("placeholder", "Father NIC *");
          
        }
        
        //console.log(res.Photo_submitted);
        if( res.Photo_submitted == 1 ){
          $( "#ps" ).prop( "checked", true ); 
        }else{
          $( "#ps" ).prop( "checked", false );  
        }

        if( res.Alevel_supplement == 1 ){
          $( "#alevel_supplement" ).prop( "checked", true ); 
        }else{
          $( "#alevel_supplement" ).prop( "checked", false );  
        }
        
        if( parseInt(res.Birth_o) == 1 ){
          $( "#bco" ).prop( "checked", true );  
        }else{
          $( "#bco" ).prop( "checked", false );
        }
        if( parseInt(res.Birth_c ) == 1 ){
          $( "#bcc" ).prop( "checked", true );  
        }else{
          $( "#bcc" ).prop( "checked", false ); 
        }
        
        $("#comments").val(res.Comments);
        ///console.log( "Form_status" + res.Form_status );
        if( parseInt( res.Form_status ) > 1 ){
          $("#submitButton").hide();
          $("#error_message").show();
          
        }else{
          $("#error_message").hide();
          $("#submitButton").show();
        }
        if( $("#mother_mobile").val() == ''){

          $("#mother_mobile").hide();
        }

      
        }
        
    },
    complete:function(){ },
    error:function(){}
    });
    
    
  }
  
  
});


$(document).on("change", "#batch_name", function(){
  var form_batch_id = $(this).val();
  var form_id = $("#form_id").val();
  
  if( form_batch_id != '' ){
    $.ajax({
    type: "POST",
    url : "<?=base_url();?>index.php/gs_admission/submission_ajax/formBatchSlots",
    data:{fbid:form_batch_id,form_id:form_id},
    dataType: "JSON",
    beforeSend: function(){},
    success: function(res){
      //console.log(res.option)
      $('#submission_time').find('option').remove().end().append(res.option);
    },
    complete:function(){ },
    error:function(){}
    });
  }
  
});



$(document).on("change", "#submission_time",  function(){
  var Current_Batch_id = parseInt($("#Current_Batch_id").val());
  var Selected_form_batch_id = parseInt( $("#batch_name").val() );
  var Current_Time_Slot_id = parseInt($("#Current_Time_Slot_id").val());
  var Selected_Time_Slot =  parseInt($(this).val());
  
  if( Selected_Time_Slot > 0 ){
    
  if( ( Current_Batch_id > 0 && Selected_form_batch_id==Current_Batch_id ) && ( Current_Time_Slot_id >0 && Selected_Time_Slot==Current_Time_Slot_id) ){
    $("#Current_Batch_Time_Slot_id_Change").val(1);
  }else{
    $("#Current_Batch_Time_Slot_id_Change").val(0);
  }
  
  }else{
    $("#Current_Batch_Time_Slot_id_Change").val(0); 
  }
  
});

function call_pdf_submissionForm(FormID){
  var url = "<?php echo base_url(); ?>index.php/gs_admission/admission_form_print_ajax/print_admission_assessment_slip?FormID="+FormID;
  var win = window.open(url, '_blank');
  if(win){
      //Browser has allowed it to be opened
      win.focus();
  }else{
      //Broswer has blocked it
      alert('Please allow popups for this site');
  }
}


// Get Discussion Sheet
function call_pdf_getDiscussionSheet(FormID){
  var url = "<?php echo base_url(); ?>index.php/gs_admission/admission_form_print_ajax/discussion_sheet_alevel?FormID="+FormID;
  var win = window.open(url, '_blank');
  if(win){
      //Browser has allowed it to be opened
      win.focus();
  }else{
      //Broswer has blocked it
      alert('Please allow popups for this site');
  }
}

$(document).on("click",".showBatches", function(){
  var form_id = $("#admission_grade_id").val();
  
  
  
  
  if( form_id > 0 ){
  
    $.ajax({
    type: "POST",
    url : "<?=base_url();?>index.php/gs_admission/submission_ajax/availableBatch",
    data:{form_id:form_id},
    dataType: "JSON",
    beforeSend: function(){},
    success: function(res){
      //console.log(res.option)
      
      $("#modal-dialog").html('');
      $("#modal-dialog").html(res.b);
      
      $("#batchAvailable").modal({ 
        "backdrop"  : "static",
        "keyboard"  : true,
        "show"      : true 
      });
      
      
    },
    complete:function(){ },
    error:function(){}
    });
  }
});

$(document).on("change", "#previous_school", function(){
  var prs = $(this).val();
  
  if( prs == '52000' ){
    $('#otherSchools').show(); 
    $( "#addHere" ).addClass("paddingTop20");
  }else{
    $('#otherSchools').hide(); 
    $( "#addHere" ).removeClass("paddingTop20");
  }

});

</script>
<script>
$(document).ready(function() {
    var max_fields      = 2; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var wrapper1        = $(".fatherContactArea"); //Fields wrapper
    var wrapper2         = $(".motherContactArea"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var add_button1      = $(".add_field_button_father"); //Add button ID
    var add_button2      = $(".add_field_button_mother"); //Add button ID
    
    var x = 1; //initlal text box count
    var x1 = 1; //initlal text box count
    var x2 = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="input_fields_wrap_additional"><select class="countryCodeNumber" name="student_mobile_code[]"> <!-- Countries often selected by users can be moved to the top of the list. --> <!-- Countries known to be subject to general US embargo are commented out by default. --> <!-- The data-countryCode attribute is populated with ISO country code, and value is int l calling code. --> <option data-countryCode="US" value="1" >+1</option> <option data-countryCode="GB" value="44">+44</option> <option data-countryCode="DZ" value="213">+213</option> <option data-countryCode="AD" value="376">+376</option> <option data-countryCode="AO" value="244">+244</option> <option data-countryCode="AI" value="1264">+1264</option> <option data-countryCode="AG" value="1268">+1268</option> <option data-countryCode="AR" value="54">+54</option> <option data-countryCode="AM" value="374">+374</option> <option data-countryCode="AW" value="297">+297</option> <option data-countryCode="AU" value="61">+61</option> <option data-countryCode="AT" value="43">+43</option> <option data-countryCode="AZ" value="994">+994</option> <option data-countryCode="BS" value="1242">+1242</option> <option data-countryCode="BH" value="973">+973</option> <option data-countryCode="BD" value="880">+880</option> <option data-countryCode="BB" value="1246">+1246</option> <option data-countryCode="BY" value="375">+375</option> <option data-countryCode="BE" value="32">+32</option> <option data-countryCode="BZ" value="501">+501</option> <option data-countryCode="BJ" value="229">+229</option> <option data-countryCode="BM" value="1441">+1441</option> <option data-countryCode="BT" value="975">+975</option> <option data-countryCode="BO" value="591">+591</option> <option data-countryCode="BA" value="387">+387</option> <option data-countryCode="BW" value="267">+267</option> <option data-countryCode="BR" value="55">+55</option> <option data-countryCode="BN" value="673">+673</option> <option data-countryCode="BG" value="359">+359</option> <option data-countryCode="BF" value="226">+226</option> <option data-countryCode="BI" value="257">+257</option> <option data-countryCode="KH" value="855">+855</option> <option data-countryCode="CM" value="237">+237</option> <option data-countryCode="CA" value="1">+1</option> <option data-countryCode="CV" value="238">+238</option> <option data-countryCode="KY" value="1345">+1345</option> <option data-countryCode="CF" value="236">+236</option> <option data-countryCode="CL" value="56">+56</option> <option data-countryCode="CN" value="86">+86</option> <option data-countryCode="CO" value="57">+57</option> <option data-countryCode="KM" value="269">+269</option> <option data-countryCode="CG" value="242">+242</option> <option data-countryCode="CK" value="682">+682</option> <option data-countryCode="CR" value="506">+506</option> <option data-countryCode="HR" value="385">+385</option> <!-- <option data-countryCode="CU" value="53">Cuba +53</option> --> <option data-countryCode="CY" value="90">+90</option> <option data-countryCode="CY" value="357">+357</option> <option data-countryCode="CZ" value="420">+420</option> <option data-countryCode="DK" value="45">+45</option> <option data-countryCode="DJ" value="253">+253</option> <option data-countryCode="DM" value="1809">+1809</option> <option data-countryCode="DO" value="1809">+1809</option> <option data-countryCode="EC" value="593">+593</option> <option data-countryCode="EG" value="20">+20</option> <option data-countryCode="SV" value="503">+503</option> <option data-countryCode="GQ" value="240">+240</option> <option data-countryCode="ER" value="291">+291</option> <option data-countryCode="EE" value="372">+372</option> <option data-countryCode="ET" value="251">+251</option> <option data-countryCode="FK" value="500">+500</option> <option data-countryCode="FO" value="298">+298</option> <option data-countryCode="FJ" value="679">+679</option> <option data-countryCode="FI" value="358">+358</option> <option data-countryCode="FR" value="33">+33</option> <option data-countryCode="GF" value="594">+594</option> <option data-countryCode="PF" value="689">+689</option> <option data-countryCode="GA" value="241">+241</option> <option data-countryCode="GM" value="220">+220</option> <option data-countryCode="GE" value="7880">+7880</option> <option data-countryCode="DE" value="49">+49</option> <option data-countryCode="GH" value="233">+233</option> <option data-countryCode="GI" value="350">+350</option> <option data-countryCode="GR" value="30">+30</option> <option data-countryCode="GL" value="299">+299</option> <option data-countryCode="GD" value="1473">+1473</option> <option data-countryCode="GP" value="590">+590</option> <option data-countryCode="GU" value="671">+671</option> <option data-countryCode="GT" value="502">+502</option> <option data-countryCode="GN" value="224">+224</option> <option data-countryCode="GW" value="245">+245</option> <option data-countryCode="GY" value="592">+592</option> <option data-countryCode="HT" value="509">+509</option> <option data-countryCode="HN" value="504">+504</option> <option data-countryCode="HK" value="852">+852</option> <option data-countryCode="HU" value="36">+36</option> <option data-countryCode="IS" value="354">+354</option> <option data-countryCode="IN" value="91">+91</option> <option data-countryCode="ID" value="62">+62</option> <option data-countryCode="IQ" value="964">+964</option> <!-- <option data-countryCode="IR" value="98">Iran +98</option> --> <option data-countryCode="IE" value="353">+353</option> <option data-countryCode="IL" value="972">+972</option> <option data-countryCode="IT" value="39">+39</option> <option data-countryCode="JM" value="1876">+1876</option> <option data-countryCode="JP" value="81">+81</option> <option data-countryCode="JO" value="962">+962</option> <option data-countryCode="KZ" value="7">+7</option> <option data-countryCode="KE" value="254">+254</option> <option data-countryCode="KI" value="686">+686</option> <option data-countryCode="KR" value="82">+82</option> <option data-countryCode="KW" value="965">+965</option> <option data-countryCode="KG" value="996">+996</option> <option data-countryCode="LA" value="856">+856</option> <option data-countryCode="LV" value="371">+371</option> <option data-countryCode="LB" value="961">+961</option> <option data-countryCode="LS" value="266">+266</option> <option data-countryCode="LR" value="231">+231</option> <option data-countryCode="LY" value="218">+218</option> <option data-countryCode="LI" value="417">+417</option> <option data-countryCode="LT" value="370">+370</option> <option data-countryCode="LU" value="352">+352</option> <option data-countryCode="MO" value="853">+853</option> <option data-countryCode="MK" value="389">+389</option> <option data-countryCode="MG" value="261">+261</option> <option data-countryCode="MW" value="265">+265</option> <option data-countryCode="MY" value="60">+60</option> <option data-countryCode="MV" value="960">+960</option> <option data-countryCode="ML" value="223">+223</option> <option data-countryCode="MT" value="356">+356</option> <option data-countryCode="MH" value="692">+692</option> <option data-countryCode="MQ" value="596">+596</option> <option data-countryCode="MR" value="222">+222</option> <option data-countryCode="YT" value="269">+269</option> <option data-countryCode="MX" value="52">+52</option> <option data-countryCode="FM" value="691">+691</option> <option data-countryCode="MD" value="373">+373</option> <option data-countryCode="MC" value="377">+377</option> <option data-countryCode="MN" value="976">+976</option> <option data-countryCode="MS" value="1664">+1664</option> <option data-countryCode="MA" value="212">+212</option> <option data-countryCode="MZ" value="258">+258</option> <option data-countryCode="MN" value="95">+95</option> <option data-countryCode="NA" value="264">+264</option> <option data-countryCode="NR" value="674">+674</option> <option data-countryCode="NP" value="977">+977</option> <option data-countryCode="NL" value="31">+31</option> <option data-countryCode="NC" value="687">+687</option> <option data-countryCode="NZ" value="64">+64</option> <option data-countryCode="NI" value="505">+505</option> <option data-countryCode="NE" value="227">+227</option> <option data-countryCode="NG" value="234">+234</option> <option data-countryCode="NU" value="683">+683</option> <option data-countryCode="NF" value="672">+672</option> <option data-countryCode="NP" value="670">+670</option> <option data-countryCode="NO" value="47">+47</option> <option data-countryCode="OM" value="968">+968</option> <option selected data-countryCode="PK" value="92" selected >+92</option> <option data-countryCode="PW" value="680">+680</option> <option data-countryCode="PA" value="507">+507</option> <option data-countryCode="PG" value="675">+675</option> <option data-countryCode="PY" value="595">+595</option> <option data-countryCode="PE" value="51">+51</option> <option data-countryCode="PH" value="63">+63</option> <option data-countryCode="PL" value="48">+48</option> <option data-countryCode="PT" value="351">+351</option> <option data-countryCode="PR" value="1787">+1787</option> <option data-countryCode="QA" value="974">+974</option> <option data-countryCode="RE" value="262">+262</option> <option data-countryCode="RO" value="40">+40</option> <option data-countryCode="RU" value="7">+7</option> <option data-countryCode="RW" value="250">+250</option> <option data-countryCode="SM" value="378">+378</option> <option data-countryCode="ST" value="239">+239</option> <option data-countryCode="SA" value="966">+966</option> <option data-countryCode="SN" value="221">+221</option> <option data-countryCode="CS" value="381">+381</option> <option data-countryCode="SC" value="248">+248</option> <option data-countryCode="SL" value="232">+232</option> <option data-countryCode="SG" value="65">+65</option> <option data-countryCode="SK" value="421">+421</option> <option data-countryCode="SI" value="386">+386</option> <option data-countryCode="SB" value="677">+677</option> <option data-countryCode="SO" value="252">+252</option> <option data-countryCode="ZA" value="27">+27</option> <option data-countryCode="ES" value="34">+34</option> <option data-countryCode="LK" value="94">+94</option> <option data-countryCode="SH" value="290">+290</option> <option data-countryCode="KN" value="1869">+1869</option> <option data-countryCode="SC" value="1758">+1758</option> <option data-countryCode="SR" value="597">+597</option> <option data-countryCode="SD" value="249">+249</option> <option data-countryCode="SZ" value="268">+268</option> <option data-countryCode="SE" value="46">+46</option> <option data-countryCode="CH" value="41">+41</option> <!-- <option data-countryCode="SY" value="963">Syria +963</option> --> <option data-countryCode="TW" value="886">+886</option> <option data-countryCode="TJ" value="992">+992</option> <option data-countryCode="TH" value="66">+66</option> <option data-countryCode="TG" value="228">+228</option> <option data-countryCode="TO" value="676">+676</option> <option data-countryCode="TT" value="1868">+1868</option> <option data-countryCode="TN" value="216">+216</option> <option data-countryCode="TR" value="90">+90</option> <option data-countryCode="TM" value="993">+993</option> <option data-countryCode="TC" value="1649">+1649</option> <option data-countryCode="TV" value="688">+688</option> <option data-countryCode="UG" value="256">+256</option> <option data-countryCode="UA" value="380">+380</option> <option data-countryCode="AE" value="971">+971</option> <option data-countryCode="UY" value="598">+598</option> <option data-countryCode="UZ" value="998">+998</option> <option data-countryCode="VU" value="678">+678</option> <option data-countryCode="VA" value="379">+379</option> <option data-countryCode="VE" value="58">+58</option> <option data-countryCode="VN" value="84">+84</option> <option data-countryCode="VG" value="1">+1</option> <option data-countryCode="VI" value="1">+1</option> <option data-countryCode="WF" value="681">+681</option> <option data-countryCode="YE" value="969">+969</option> <option data-countryCode="YE" value="967">+967</option> <option data-countryCode="ZM" value="260">+260</option> <option data-countryCode="ZW" value="263">+263</option> </select><input name="student_mobile_phone[]" type="number" class="col-md-10" placeholder="Mobile" id="" value="" style="padding-left:80px;" /> <a href="#" class="remove_field">X</a></div>'); //add input box
        }
    });
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('.input_fields_wrap_additional').remove(); x--;
    })
  /* */
  $(add_button1).click(function(e){ //on add input button click
        e.preventDefault();
        if(x1 < max_fields){ //max input box allowed
            x1++; //text box increment
            $(wrapper1).append('<div class="input_fields_wrap_additional_father"><select class="countryCodeNumber" name="father_mobile_code[]"> <!-- Countries often selected by users can be moved to the top of the list. --> <!-- Countries known to be subject to general US embargo are commented out by default. --> <!-- The data-countryCode attribute is populated with ISO country code, and value is int l calling code. --> <option data-countryCode="US" value="1" >+1</option> <option data-countryCode="GB" value="44">+44</option> <option data-countryCode="DZ" value="213">+213</option> <option data-countryCode="AD" value="376">+376</option> <option data-countryCode="AO" value="244">+244</option> <option data-countryCode="AI" value="1264">+1264</option> <option data-countryCode="AG" value="1268">+1268</option> <option data-countryCode="AR" value="54">+54</option> <option data-countryCode="AM" value="374">+374</option> <option data-countryCode="AW" value="297">+297</option> <option data-countryCode="AU" value="61">+61</option> <option data-countryCode="AT" value="43">+43</option> <option data-countryCode="AZ" value="994">+994</option> <option data-countryCode="BS" value="1242">+1242</option> <option data-countryCode="BH" value="973">+973</option> <option data-countryCode="BD" value="880">+880</option> <option data-countryCode="BB" value="1246">+1246</option> <option data-countryCode="BY" value="375">+375</option> <option data-countryCode="BE" value="32">+32</option> <option data-countryCode="BZ" value="501">+501</option> <option data-countryCode="BJ" value="229">+229</option> <option data-countryCode="BM" value="1441">+1441</option> <option data-countryCode="BT" value="975">+975</option> <option data-countryCode="BO" value="591">+591</option> <option data-countryCode="BA" value="387">+387</option> <option data-countryCode="BW" value="267">+267</option> <option data-countryCode="BR" value="55">+55</option> <option data-countryCode="BN" value="673">+673</option> <option data-countryCode="BG" value="359">+359</option> <option data-countryCode="BF" value="226">+226</option> <option data-countryCode="BI" value="257">+257</option> <option data-countryCode="KH" value="855">+855</option> <option data-countryCode="CM" value="237">+237</option> <option data-countryCode="CA" value="1">+1</option> <option data-countryCode="CV" value="238">+238</option> <option data-countryCode="KY" value="1345">+1345</option> <option data-countryCode="CF" value="236">+236</option> <option data-countryCode="CL" value="56">+56</option> <option data-countryCode="CN" value="86">+86</option> <option data-countryCode="CO" value="57">+57</option> <option data-countryCode="KM" value="269">+269</option> <option data-countryCode="CG" value="242">+242</option> <option data-countryCode="CK" value="682">+682</option> <option data-countryCode="CR" value="506">+506</option> <option data-countryCode="HR" value="385">+385</option> <!-- <option data-countryCode="CU" value="53">Cuba +53</option> --> <option data-countryCode="CY" value="90">+90</option> <option data-countryCode="CY" value="357">+357</option> <option data-countryCode="CZ" value="420">+420</option> <option data-countryCode="DK" value="45">+45</option> <option data-countryCode="DJ" value="253">+253</option> <option data-countryCode="DM" value="1809">+1809</option> <option data-countryCode="DO" value="1809">+1809</option> <option data-countryCode="EC" value="593">+593</option> <option data-countryCode="EG" value="20">+20</option> <option data-countryCode="SV" value="503">+503</option> <option data-countryCode="GQ" value="240">+240</option> <option data-countryCode="ER" value="291">+291</option> <option data-countryCode="EE" value="372">+372</option> <option data-countryCode="ET" value="251">+251</option> <option data-countryCode="FK" value="500">+500</option> <option data-countryCode="FO" value="298">+298</option> <option data-countryCode="FJ" value="679">+679</option> <option data-countryCode="FI" value="358">+358</option> <option data-countryCode="FR" value="33">+33</option> <option data-countryCode="GF" value="594">+594</option> <option data-countryCode="PF" value="689">+689</option> <option data-countryCode="GA" value="241">+241</option> <option data-countryCode="GM" value="220">+220</option> <option data-countryCode="GE" value="7880">+7880</option> <option data-countryCode="DE" value="49">+49</option> <option data-countryCode="GH" value="233">+233</option> <option data-countryCode="GI" value="350">+350</option> <option data-countryCode="GR" value="30">+30</option> <option data-countryCode="GL" value="299">+299</option> <option data-countryCode="GD" value="1473">+1473</option> <option data-countryCode="GP" value="590">+590</option> <option data-countryCode="GU" value="671">+671</option> <option data-countryCode="GT" value="502">+502</option> <option data-countryCode="GN" value="224">+224</option> <option data-countryCode="GW" value="245">+245</option> <option data-countryCode="GY" value="592">+592</option> <option data-countryCode="HT" value="509">+509</option> <option data-countryCode="HN" value="504">+504</option> <option data-countryCode="HK" value="852">+852</option> <option data-countryCode="HU" value="36">+36</option> <option data-countryCode="IS" value="354">+354</option> <option data-countryCode="IN" value="91">+91</option> <option data-countryCode="ID" value="62">+62</option> <option data-countryCode="IQ" value="964">+964</option> <!-- <option data-countryCode="IR" value="98">Iran +98</option> --> <option data-countryCode="IE" value="353">+353</option> <option data-countryCode="IL" value="972">+972</option> <option data-countryCode="IT" value="39">+39</option> <option data-countryCode="JM" value="1876">+1876</option> <option data-countryCode="JP" value="81">+81</option> <option data-countryCode="JO" value="962">+962</option> <option data-countryCode="KZ" value="7">+7</option> <option data-countryCode="KE" value="254">+254</option> <option data-countryCode="KI" value="686">+686</option> <option data-countryCode="KR" value="82">+82</option> <option data-countryCode="KW" value="965">+965</option> <option data-countryCode="KG" value="996">+996</option> <option data-countryCode="LA" value="856">+856</option> <option data-countryCode="LV" value="371">+371</option> <option data-countryCode="LB" value="961">+961</option> <option data-countryCode="LS" value="266">+266</option> <option data-countryCode="LR" value="231">+231</option> <option data-countryCode="LY" value="218">+218</option> <option data-countryCode="LI" value="417">+417</option> <option data-countryCode="LT" value="370">+370</option> <option data-countryCode="LU" value="352">+352</option> <option data-countryCode="MO" value="853">+853</option> <option data-countryCode="MK" value="389">+389</option> <option data-countryCode="MG" value="261">+261</option> <option data-countryCode="MW" value="265">+265</option> <option data-countryCode="MY" value="60">+60</option> <option data-countryCode="MV" value="960">+960</option> <option data-countryCode="ML" value="223">+223</option> <option data-countryCode="MT" value="356">+356</option> <option data-countryCode="MH" value="692">+692</option> <option data-countryCode="MQ" value="596">+596</option> <option data-countryCode="MR" value="222">+222</option> <option data-countryCode="YT" value="269">+269</option> <option data-countryCode="MX" value="52">+52</option> <option data-countryCode="FM" value="691">+691</option> <option data-countryCode="MD" value="373">+373</option> <option data-countryCode="MC" value="377">+377</option> <option data-countryCode="MN" value="976">+976</option> <option data-countryCode="MS" value="1664">+1664</option> <option data-countryCode="MA" value="212">+212</option> <option data-countryCode="MZ" value="258">+258</option> <option data-countryCode="MN" value="95">+95</option> <option data-countryCode="NA" value="264">+264</option> <option data-countryCode="NR" value="674">+674</option> <option data-countryCode="NP" value="977">+977</option> <option data-countryCode="NL" value="31">+31</option> <option data-countryCode="NC" value="687">+687</option> <option data-countryCode="NZ" value="64">+64</option> <option data-countryCode="NI" value="505">+505</option> <option data-countryCode="NE" value="227">+227</option> <option data-countryCode="NG" value="234">+234</option> <option data-countryCode="NU" value="683">+683</option> <option data-countryCode="NF" value="672">+672</option> <option data-countryCode="NP" value="670">+670</option> <option data-countryCode="NO" value="47">+47</option> <option data-countryCode="OM" value="968">+968</option> <option selected data-countryCode="PK" value="92" selected>+92</option> <option data-countryCode="PW" value="680">+680</option> <option data-countryCode="PA" value="507">+507</option> <option data-countryCode="PG" value="675">+675</option> <option data-countryCode="PY" value="595">+595</option> <option data-countryCode="PE" value="51">+51</option> <option data-countryCode="PH" value="63">+63</option> <option data-countryCode="PL" value="48">+48</option> <option data-countryCode="PT" value="351">+351</option> <option data-countryCode="PR" value="1787">+1787</option> <option data-countryCode="QA" value="974">+974</option> <option data-countryCode="RE" value="262">+262</option> <option data-countryCode="RO" value="40">+40</option> <option data-countryCode="RU" value="7">+7</option> <option data-countryCode="RW" value="250">+250</option> <option data-countryCode="SM" value="378">+378</option> <option data-countryCode="ST" value="239">+239</option> <option data-countryCode="SA" value="966">+966</option> <option data-countryCode="SN" value="221">+221</option> <option data-countryCode="CS" value="381">+381</option> <option data-countryCode="SC" value="248">+248</option> <option data-countryCode="SL" value="232">+232</option> <option data-countryCode="SG" value="65">+65</option> <option data-countryCode="SK" value="421">+421</option> <option data-countryCode="SI" value="386">+386</option> <option data-countryCode="SB" value="677">+677</option> <option data-countryCode="SO" value="252">+252</option> <option data-countryCode="ZA" value="27">+27</option> <option data-countryCode="ES" value="34">+34</option> <option data-countryCode="LK" value="94">+94</option> <option data-countryCode="SH" value="290">+290</option> <option data-countryCode="KN" value="1869">+1869</option> <option data-countryCode="SC" value="1758">+1758</option> <option data-countryCode="SR" value="597">+597</option> <option data-countryCode="SD" value="249">+249</option> <option data-countryCode="SZ" value="268">+268</option> <option data-countryCode="SE" value="46">+46</option> <option data-countryCode="CH" value="41">+41</option> <!-- <option data-countryCode="SY" value="963">Syria +963</option> --> <option data-countryCode="TW" value="886">+886</option> <option data-countryCode="TJ" value="992">+992</option> <option data-countryCode="TH" value="66">+66</option> <option data-countryCode="TG" value="228">+228</option> <option data-countryCode="TO" value="676">+676</option> <option data-countryCode="TT" value="1868">+1868</option> <option data-countryCode="TN" value="216">+216</option> <option data-countryCode="TR" value="90">+90</option> <option data-countryCode="TM" value="993">+993</option> <option data-countryCode="TC" value="1649">+1649</option> <option data-countryCode="TV" value="688">+688</option> <option data-countryCode="UG" value="256">+256</option> <option data-countryCode="UA" value="380">+380</option> <option data-countryCode="AE" value="971">+971</option> <option data-countryCode="UY" value="598">+598</option> <option data-countryCode="UZ" value="998">+998</option> <option data-countryCode="VU" value="678">+678</option> <option data-countryCode="VA" value="379">+379</option> <option data-countryCode="VE" value="58">+58</option> <option data-countryCode="VN" value="84">+84</option> <option data-countryCode="VG" value="1">+1</option> <option data-countryCode="VI" value="1">+1</option> <option data-countryCode="WF" value="681">+681</option> <option data-countryCode="YE" value="969">+969</option> <option data-countryCode="YE" value="967">+967</option> <option data-countryCode="ZM" value="260">+260</option> <option data-countryCode="ZW" value="263">+263</option> </select><input type="number" class="col-md-10" placeholder="Mobile" id="" value="" style="padding-left:80px;" name="father_mobile_phone[]" /> <a href="#" class="remove_field1">X</a></div>'); //add input box
        }
    });
  $(wrapper1).on("click",".remove_field1", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('.input_fields_wrap_additional_father').remove(); x--;
    })
  /* */
  $(add_button2).click(function(e){ //on add input button click
        e.preventDefault();
        if(x2 < max_fields){ //max input box allowed
            x2++; //text box increment
            $(wrapper2).append('<div class="input_fields_wrap_additional_mother"><select class="countryCodeNumber" name="mother_mobile_code[]"> <!-- Countries often selected by users can be moved to the top of the list. --> <!-- Countries known to be subject to general US embargo are commented out by default. --> <!-- The data-countryCode attribute is populated with ISO country code, and value is int l calling code. --> <option data-countryCode="US" value="1" >+1</option> <option data-countryCode="GB" value="44">+44</option> <option data-countryCode="DZ" value="213">+213</option> <option data-countryCode="AD" value="376">+376</option> <option data-countryCode="AO" value="244">+244</option> <option data-countryCode="AI" value="1264">+1264</option> <option data-countryCode="AG" value="1268">+1268</option> <option data-countryCode="AR" value="54">+54</option> <option data-countryCode="AM" value="374">+374</option> <option data-countryCode="AW" value="297">+297</option> <option data-countryCode="AU" value="61">+61</option> <option data-countryCode="AT" value="43">+43</option> <option data-countryCode="AZ" value="994">+994</option> <option data-countryCode="BS" value="1242">+1242</option> <option data-countryCode="BH" value="973">+973</option> <option data-countryCode="BD" value="880">+880</option> <option data-countryCode="BB" value="1246">+1246</option> <option data-countryCode="BY" value="375">+375</option> <option data-countryCode="BE" value="32">+32</option> <option data-countryCode="BZ" value="501">+501</option> <option data-countryCode="BJ" value="229">+229</option> <option data-countryCode="BM" value="1441">+1441</option> <option data-countryCode="BT" value="975">+975</option> <option data-countryCode="BO" value="591">+591</option> <option data-countryCode="BA" value="387">+387</option> <option data-countryCode="BW" value="267">+267</option> <option data-countryCode="BR" value="55">+55</option> <option data-countryCode="BN" value="673">+673</option> <option data-countryCode="BG" value="359">+359</option> <option data-countryCode="BF" value="226">+226</option> <option data-countryCode="BI" value="257">+257</option> <option data-countryCode="KH" value="855">+855</option> <option data-countryCode="CM" value="237">+237</option> <option data-countryCode="CA" value="1">+1</option> <option data-countryCode="CV" value="238">+238</option> <option data-countryCode="KY" value="1345">+1345</option> <option data-countryCode="CF" value="236">+236</option> <option data-countryCode="CL" value="56">+56</option> <option data-countryCode="CN" value="86">+86</option> <option data-countryCode="CO" value="57">+57</option> <option data-countryCode="KM" value="269">+269</option> <option data-countryCode="CG" value="242">+242</option> <option data-countryCode="CK" value="682">+682</option> <option data-countryCode="CR" value="506">+506</option> <option data-countryCode="HR" value="385">+385</option> <!-- <option data-countryCode="CU" value="53">Cuba +53</option> --> <option data-countryCode="CY" value="90">+90</option> <option data-countryCode="CY" value="357">+357</option> <option data-countryCode="CZ" value="420">+420</option> <option data-countryCode="DK" value="45">+45</option> <option data-countryCode="DJ" value="253">+253</option> <option data-countryCode="DM" value="1809">+1809</option> <option data-countryCode="DO" value="1809">+1809</option> <option data-countryCode="EC" value="593">+593</option> <option data-countryCode="EG" value="20">+20</option> <option data-countryCode="SV" value="503">+503</option> <option data-countryCode="GQ" value="240">+240</option> <option data-countryCode="ER" value="291">+291</option> <option data-countryCode="EE" value="372">+372</option> <option data-countryCode="ET" value="251">+251</option> <option data-countryCode="FK" value="500">+500</option> <option data-countryCode="FO" value="298">+298</option> <option data-countryCode="FJ" value="679">+679</option> <option data-countryCode="FI" value="358">+358</option> <option data-countryCode="FR" value="33">+33</option> <option data-countryCode="GF" value="594">+594</option> <option data-countryCode="PF" value="689">+689</option> <option data-countryCode="GA" value="241">+241</option> <option data-countryCode="GM" value="220">+220</option> <option data-countryCode="GE" value="7880">+7880</option> <option data-countryCode="DE" value="49">+49</option> <option data-countryCode="GH" value="233">+233</option> <option data-countryCode="GI" value="350">+350</option> <option data-countryCode="GR" value="30">+30</option> <option data-countryCode="GL" value="299">+299</option> <option data-countryCode="GD" value="1473">+1473</option> <option data-countryCode="GP" value="590">+590</option> <option data-countryCode="GU" value="671">+671</option> <option data-countryCode="GT" value="502">+502</option> <option data-countryCode="GN" value="224">+224</option> <option data-countryCode="GW" value="245">+245</option> <option data-countryCode="GY" value="592">+592</option> <option data-countryCode="HT" value="509">+509</option> <option data-countryCode="HN" value="504">+504</option> <option data-countryCode="HK" value="852">+852</option> <option data-countryCode="HU" value="36">+36</option> <option data-countryCode="IS" value="354">+354</option> <option data-countryCode="IN" value="91">+91</option> <option data-countryCode="ID" value="62">+62</option> <option data-countryCode="IQ" value="964">+964</option> <!-- <option data-countryCode="IR" value="98">Iran +98</option> --> <option data-countryCode="IE" value="353">+353</option> <option data-countryCode="IL" value="972">+972</option> <option data-countryCode="IT" value="39">+39</option> <option data-countryCode="JM" value="1876">+1876</option> <option data-countryCode="JP" value="81">+81</option> <option data-countryCode="JO" value="962">+962</option> <option data-countryCode="KZ" value="7">+7</option> <option data-countryCode="KE" value="254">+254</option> <option data-countryCode="KI" value="686">+686</option> <option data-countryCode="KR" value="82">+82</option> <option data-countryCode="KW" value="965">+965</option> <option data-countryCode="KG" value="996">+996</option> <option data-countryCode="LA" value="856">+856</option> <option data-countryCode="LV" value="371">+371</option> <option data-countryCode="LB" value="961">+961</option> <option data-countryCode="LS" value="266">+266</option> <option data-countryCode="LR" value="231">+231</option> <option data-countryCode="LY" value="218">+218</option> <option data-countryCode="LI" value="417">+417</option> <option data-countryCode="LT" value="370">+370</option> <option data-countryCode="LU" value="352">+352</option> <option data-countryCode="MO" value="853">+853</option> <option data-countryCode="MK" value="389">+389</option> <option data-countryCode="MG" value="261">+261</option> <option data-countryCode="MW" value="265">+265</option> <option data-countryCode="MY" value="60">+60</option> <option data-countryCode="MV" value="960">+960</option> <option data-countryCode="ML" value="223">+223</option> <option data-countryCode="MT" value="356">+356</option> <option data-countryCode="MH" value="692">+692</option> <option data-countryCode="MQ" value="596">+596</option> <option data-countryCode="MR" value="222">+222</option> <option data-countryCode="YT" value="269">+269</option> <option data-countryCode="MX" value="52">+52</option> <option data-countryCode="FM" value="691">+691</option> <option data-countryCode="MD" value="373">+373</option> <option data-countryCode="MC" value="377">+377</option> <option data-countryCode="MN" value="976">+976</option> <option data-countryCode="MS" value="1664">+1664</option> <option data-countryCode="MA" value="212">+212</option> <option data-countryCode="MZ" value="258">+258</option> <option data-countryCode="MN" value="95">+95</option> <option data-countryCode="NA" value="264">+264</option> <option data-countryCode="NR" value="674">+674</option> <option data-countryCode="NP" value="977">+977</option> <option data-countryCode="NL" value="31">+31</option> <option data-countryCode="NC" value="687">+687</option> <option data-countryCode="NZ" value="64">+64</option> <option data-countryCode="NI" value="505">+505</option> <option data-countryCode="NE" value="227">+227</option> <option data-countryCode="NG" value="234">+234</option> <option data-countryCode="NU" value="683">+683</option> <option data-countryCode="NF" value="672">+672</option> <option data-countryCode="NP" value="670">+670</option> <option data-countryCode="NO" value="47">+47</option> <option data-countryCode="OM" value="968">+968</option> <option selected data-countryCode="PK" value="92" selected>+92</option> <option data-countryCode="PW" value="680">+680</option> <option data-countryCode="PA" value="507">+507</option> <option data-countryCode="PG" value="675">+675</option> <option data-countryCode="PY" value="595">+595</option> <option data-countryCode="PE" value="51">+51</option> <option data-countryCode="PH" value="63">+63</option> <option data-countryCode="PL" value="48">+48</option> <option data-countryCode="PT" value="351">+351</option> <option data-countryCode="PR" value="1787">+1787</option> <option data-countryCode="QA" value="974">+974</option> <option data-countryCode="RE" value="262">+262</option> <option data-countryCode="RO" value="40">+40</option> <option data-countryCode="RU" value="7">+7</option> <option data-countryCode="RW" value="250">+250</option> <option data-countryCode="SM" value="378">+378</option> <option data-countryCode="ST" value="239">+239</option> <option data-countryCode="SA" value="966">+966</option> <option data-countryCode="SN" value="221">+221</option> <option data-countryCode="CS" value="381">+381</option> <option data-countryCode="SC" value="248">+248</option> <option data-countryCode="SL" value="232">+232</option> <option data-countryCode="SG" value="65">+65</option> <option data-countryCode="SK" value="421">+421</option> <option data-countryCode="SI" value="386">+386</option> <option data-countryCode="SB" value="677">+677</option> <option data-countryCode="SO" value="252">+252</option> <option data-countryCode="ZA" value="27">+27</option> <option data-countryCode="ES" value="34">+34</option> <option data-countryCode="LK" value="94">+94</option> <option data-countryCode="SH" value="290">+290</option> <option data-countryCode="KN" value="1869">+1869</option> <option data-countryCode="SC" value="1758">+1758</option> <option data-countryCode="SR" value="597">+597</option> <option data-countryCode="SD" value="249">+249</option> <option data-countryCode="SZ" value="268">+268</option> <option data-countryCode="SE" value="46">+46</option> <option data-countryCode="CH" value="41">+41</option> <!-- <option data-countryCode="SY" value="963">Syria +963</option> --> <option data-countryCode="TW" value="886">+886</option> <option data-countryCode="TJ" value="992">+992</option> <option data-countryCode="TH" value="66">+66</option> <option data-countryCode="TG" value="228">+228</option> <option data-countryCode="TO" value="676">+676</option> <option data-countryCode="TT" value="1868">+1868</option> <option data-countryCode="TN" value="216">+216</option> <option data-countryCode="TR" value="90">+90</option> <option data-countryCode="TM" value="993">+993</option> <option data-countryCode="TC" value="1649">+1649</option> <option data-countryCode="TV" value="688">+688</option> <option data-countryCode="UG" value="256">+256</option> <option data-countryCode="UA" value="380">+380</option> <option data-countryCode="AE" value="971">+971</option> <option data-countryCode="UY" value="598">+598</option> <option data-countryCode="UZ" value="998">+998</option> <option data-countryCode="VU" value="678">+678</option> <option data-countryCode="VA" value="379">+379</option> <option data-countryCode="VE" value="58">+58</option> <option data-countryCode="VN" value="84">+84</option> <option data-countryCode="VG" value="1">+1</option> <option data-countryCode="VI" value="1">+1</option> <option data-countryCode="WF" value="681">+681</option> <option data-countryCode="YE" value="969">+969</option> <option data-countryCode="YE" value="967">+967</option> <option data-countryCode="ZM" value="260">+260</option> <option data-countryCode="ZW" value="263">+263</option> </select><input name="mother_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id="" value="" style="padding-left:80px;" /> <a href="#" class="remove_field2">X</a></div>'); //add input box
        }
    });
  $(wrapper2).on("click",".remove_field2", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('.input_fields_wrap_additional_mother').remove(); x--;
    })
    
});
</script>
<link rel="stylesheet" href="<?=base_url();?>components/gs_theme/css/jquery-ui.css">

<script src="<?=base_url();?>components/gs_theme/js/jquery-ui.js"></script>

<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>

<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</body>
</html>