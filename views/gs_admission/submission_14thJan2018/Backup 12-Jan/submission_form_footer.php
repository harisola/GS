<!--Forms-->
<script type="text/javascript">
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


// Kashif Solangi
$(document).ready(function(){
  
// GF ID  
if ($('#form_no').length) {
  $('#form_no').mask('9999', {
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


  
//https://jqueryvalidation.org/required-method/   
$(document).on("click", "#greenBTN", function(){

var today = new Date().toISOString().split('T')[0];
$('#discussion_date').attr('min' , today);

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
  mother_mobile: { 
    required:true 
  },
  father_nic: { required: true },
  father_email: { email:true },
  mother_email:{ email:true  },
  ps:{ required:true  },
  bco:{ required:true  },
  bcc:{ required:true  },
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
  ps:{ required:''  },
  bco:{ required:''  },
  bcc:{ required:''  },
  discussion_date: { required: '' },
  discussion_time: { required: '' }
},
submitHandler: function(form){
  $(form).ajaxSubmit({
    beforeSend: function(){ $("#ajaxloader").show(); },
    uploadProgress: function (event, position, total, percentComplete){},
    dataType: "JSON",
    success: function(res){
    //console.log(res);
    $("#ajaxloader").hide();
    refreshForm();
    reload_table_data();
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
  bcc:{ required:true  }
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
  batch_name: { valueNotEquals: '' },
  submission_time: { valueNotEquals: '' },
  ps:{ required:''  },
  bco:{ required:''  },
  bcc:{ required:''  }
  
},
submitHandler: function(form){
  $(form).ajaxSubmit({
    beforeSend: function(){ $("#ajaxloader").show(); },
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
      for (var i = 0; i < mobile_numbers.length; i++) {
    
        if(  mobile_numbers[i] != null && mobile_numbers[i] != undefined && mobile_numbers[i] != '' ){

          var number = mobile_numbers[i].split('-');
          mobileNumberHTML += '<input name="'+name+'_mobile_other[]" type="text" class="col-md-10 other_mobile_numbers" placeholder="Mobile" id="'+name+'_mobile_'+i+'"  value="+'+number[0]+number[1]+'">';
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
        } else {
            $("#discussion_date").val('')
            $("#discussion_time").val('')          
            $(".alevelBox").show()
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

        $('.other_mobile_numbers').remove()

        // $('#father_mobile').nextAll('input').remove();
        $( "#student_mobile_div" ).after( multiplePhoneHTML('student',res.Student_mobile ) );
        
        $( "#father_mobile" ).after( multiplePhoneHTML('father',res.Father_mobile_other ) );
        $( "#mother_mobile" ).after( multiplePhoneHTML('mother',res.Mother_mobile_other ) );

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

        $("#father_mobile").delay( 800 ).fadeIn("slow",function(){ $(this).val( '+92'+father_mob_number 
           ) ; });
        $("#father_nic").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Father_nic); });
        $("#father_email").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Father_email); });
        $("#mother_name").delay( 800 ).fadeIn("slow",function(){ $(this).val(res.Mother_name); });
        var mother_mob_number = res.Mother_mobile;
        mother_mob_number = mother_mob_number.substring(1);
        mother_mob_number = mother_mob_number.replace('-','');
        $("#mother_mobile").delay( 800 ).fadeIn("slow",function(){ $(this).val('+92'+mother_mob_number); });
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

<link rel="stylesheet" href="<?=base_url();?>components/gs_theme/css/jquery-ui.css">

<script src="<?=base_url();?>components/gs_theme/js/jquery-ui.js"></script>

<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>

<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>

</body>
</html>