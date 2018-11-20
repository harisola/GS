<style>
.container {
	width: 100% !important;
}
.BrowsingList {
    border-right: 2px dashed #888;
	padding-left:25px;
    width: 40%;
}
.content-wrapper {
    min-height: 860px !important;
	max-width: 1700px !important;
    margin: 0 auto;
}
div.dataTables_filter input {
	max-width:140px;	
}
.table > thead > tr > th, 
.table > tbody > tr > th, 
.table > tfoot > tr > th, 
.table > thead > tr > td, 
.table > tbody > tr > td, 
.table > tfoot > tr > td {
    padding: 4px 4px;
}
.xedit span.grayish {
    color: #888;
    float: left;
    width: 140px;
}

</style>

<div class="container">
	<div class="row">
    	<div class="col-md-5 BrowsingList " style="">
	    	<div class="LeftListing" style="">
            	<div class="yellowBGHead showOnScroll b" style="display:none;">
                	<div class="col-md-2 no-padding" style="border-right:1px solid #c34a4a;">
                    	<h4 class="text-center totalAtt">
                        	<span data-toggle="tooltip" data-placement="top" data-original-title="Att. Total" data-pin-nopin="true">29</span>
                            <span class="grayish" data-toggle="tooltip" data-placement="top" data-original-title="Fence" data-pin-nopin="true">+1</span>
                        </h4>
                    </div><!-- col-md-2 -->
                    <div class="col-md-8 text-center no-padding">
                    	<h3 class="className">VII-S &nbsp; <a href="#"><img src="/application/views/haris/images/stats-.png" width="20px" data-toggle="tooltip" data-placement="top" data-original-title="Class details" data-pin-nopin="true" /></a></h3>
                    </div><!-- -->
                    <div class="col-md-2 no-padding" style="border-left:1px solid #c34a4a;">
                    	<h4 class="text-center todayAttScore" data-toggle="tooltip" data-placement="top" data-original-title="Today's score" data-pin-nopin="true">
                        	10
                        </h4>
                    </div><!-- col-md-2 -->
                </div><!-- yellowBGHead This will appear on scroll -->
              	<div class="yellowBGHead a LeftListing_headerSection paddingBottom0">
                	<div class="col-md-2 no-padding" style="border-right:1px solid #c34a4a;">
                    	<h4 class="text-center totalAtt">
                        	<span data-toggle="tooltip" data-placement="top" data-original-title="Att. Total" data-pin-nopin="true">29</span>
                            <span class="grayish" data-toggle="tooltip" data-placement="top" data-original-title="Fence" data-pin-nopin="true">+1</span>
                        </h4>
                        <h4 class="text-center girlAtt" data-toggle="tooltip" data-placement="top" data-original-title="Att. Girls" data-pin-nopin="true">
                        	17
                        </h4>
                        <h4 class="text-center boyAtt">
                        	<span  data-toggle="tooltip" data-placement="top" data-original-title="Att. Boys" data-pin-nopin="true">12</span>
                            <span class="grayish" data-toggle="tooltip" data-placement="top" data-original-title="Fence" data-pin-nopin="true">+1</span>
                        </h4>
                    </div><!-- col-md-2 -->
                    <div class="col-md-8 text-center no-padding">
                    	<h3 class="className">VII-S &nbsp; <a href="#"><img src="/application/views/haris/images/stats-.png" width="20px" data-toggle="tooltip" data-placement="top" data-original-title="Class details" data-pin-nopin="true" /></a></h3>
                        <div class="col-md-6 no-padding text-center">
                            <img src="/application/views/haris/images/669.png" width="45" class="marginRight10 maringBottom0 " style="border:1px solid #888;" /><br />
                            <h6>Mehwish Farooq</h6>
                        </div>
                        <div class="col-md-6 no-padding text-center">
                        	<img src="/application/views/haris/images/716.png" width="45" class="marginRight10 maringBottom0 " style="border:1px solid #888;" /><br />
                            <h6>Sidra Humayun</h6>
                        </div>
                    </div><!-- -->
                    <div class="col-md-2 no-padding" style="border-left:1px solid #c34a4a;">
                    	<h4 class="text-center todayAttScore" data-toggle="tooltip" data-placement="top" data-original-title="Today's score" data-pin-nopin="true">
                        	10
                        </h4>
                        <h4 class="text-center TendayAttScore a" data-toggle="tooltip" data-placement="top" data-original-title="10 day score" data-pin-nopin="true">
                        	7.5
                        </h4>
                        <h4 class="text-center SixtydayAttScore a" data-toggle="tooltip" data-placement="top" data-original-title="60 day score" data-pin-nopin="true">
                        	8.5
                        </h4>
                    </div><!-- col-md-2 -->
	            </div><!-- LeftListing_headerSection -->
                <div class="LeftListing_ContentSection">
	            	<table width="100%" border="1" id="EntitityListing" class="table table-striped table-bordered table-hover">
	                  <thead>
	                      <tr>
	                        <th class="text-center no-sort" width="">SR</th>
	                        <th class="text-center no-sort" width="">Class</th>
	                        <th class="" width="">Name</th>
                            <th class="text-center no-sort" width="">Att.</th>
	                        <th class="no-sort text-center" width="">Profiles</th>
                            <th class="no-sort text-center" width="">Badges</th>
	                        <th class="no-sort text-center" width=""><img src="/application/views/haris/images/redBell.jpg" width="15" /></th>
	                      </tr>
                          <!-- 
                          <tr>
	                        <th class="text-center no-sort" width="5%">SR</th>
	                        <th class="text-center no-sort" width="15%">Class</th>
	                        <th class="" width="40%">Name</th>
                            <th class="text-center no-sort" width="15%">Att.</th>
	                        <th class="no-sort text-center" width="20%">Profiles</th>
                            <th class="no-sort text-center" width="20%" style="width:120px !important;">Badges</th>
	                        <th class="no-sort text-center" width="5%"><img src="/application/views/haris/images/redBell.jpg" width="15" /></th>
	                      </tr>
                          -->
	                  </thead><!-- thead -->
					  <tbody>
	                      <tr class="selected">
	                        <td class="text-center">1</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 001" data-pin-nopin="true">VII-A</span> 
	                            	<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
                            <td class="text-center"><span class="AttBox PP" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Pending Verification" data-pin-nopin="true">PP</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileC Academic" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> 
                                <span class="ProfileB Parental" data-toggle="tooltip" data-placement="top" data-original-title="Parental" data-pin-nopin="true">B</span> 
                                <span class="ProfileD Social" data-toggle="tooltip" data-placement="top" data-original-title="Social" data-pin-nopin="true">D</span> 
                                <span class="ProfileA Account" data-toggle="tooltip" data-placement="top" data-original-title="Accounts" data-pin-nopin="true">A</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">2</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 002" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox AA" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Absent Authorized" data-pin-nopin="true">AA</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileC Academic" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> 
                                <span class="ProfileB Parental" data-toggle="tooltip" data-placement="top" data-original-title="Parental" data-pin-nopin="true">B</span> 
                                <span class="ProfileD Social" data-toggle="tooltip" data-placement="top" data-original-title="Social" data-pin-nopin="true">D</span> 
                                <span class="ProfileA Account" data-toggle="tooltip" data-placement="top" data-original-title="Accounts" data-pin-nopin="true">A</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">Q</span> <span class="ProfileD text-center">A</span> </td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">3</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 003" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox AP" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Absence Verification Pending" data-pin-nopin="true">AP</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileC Academic" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> 
                                <span class="ProfileB Parental" data-toggle="tooltip" data-placement="top" data-original-title="Parental" data-pin-nopin="true">B</span> 
                                <span class="ProfileD Social" data-toggle="tooltip" data-placement="top" data-original-title="Social" data-pin-nopin="true">D</span> 
                                <span class="ProfileA Account" data-toggle="tooltip" data-placement="top" data-original-title="Accounts" data-pin-nopin="true">A</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">Z</span> <span class="ProfileC text-center">O</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">4</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 004" data-pin-nopin="true">VII-A</span> 
	                            	<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox AU" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Absent Unauthorized" data-pin-nopin="true">AU</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileC Academic" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> 
                                <span class="ProfileB Parental" data-toggle="tooltip" data-placement="top" data-original-title="Parental" data-pin-nopin="true">B</span> 
                                <span class="ProfileD Social" data-toggle="tooltip" data-placement="top" data-original-title="Social" data-pin-nopin="true">D</span> 
                                <span class="ProfileA Account" data-toggle="tooltip" data-placement="top" data-original-title="Accounts" data-pin-nopin="true">A</span><br />
                            </td>
                            <td class="text-center"><span class="Badge text-center" style="background:#369;">I</span> <span class="Badge text-center" style="background:#666;">T</span> <span class="Badge text-center" style="background:#F00;">L</span> </td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">5</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 005" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox TA" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Tap in Awaited" data-pin-nopin="true">TA</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileC Academic" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> 
                                <span class="ProfileB Parental" data-toggle="tooltip" data-placement="top" data-original-title="Parental" data-pin-nopin="true">B</span> 
                                <span class="ProfileD Social" data-toggle="tooltip" data-placement="top" data-original-title="Social" data-pin-nopin="true">D</span> 
                                <span class="ProfileA Account" data-toggle="tooltip" data-placement="top" data-original-title="Accounts" data-pin-nopin="true">A</span><br />
                            </td>
                            <td class="text-center"><span class="Badge text-center" style="background:#06F">M</span> </td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="Fence">
	                        <td class="text-center">6</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 006" data-pin-nopin="true">VII-A</span> 
	                            	<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">F</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox NE" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Not Expected Today" data-pin-nopin="true">NE</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileC Academic" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> 
                                <span class="ProfileB Parental" data-toggle="tooltip" data-placement="top" data-original-title="Parental" data-pin-nopin="true">B</span> 
                                <span class="ProfileD Social" data-toggle="tooltip" data-placement="top" data-original-title="Social" data-pin-nopin="true">D</span> 
                                <span class="ProfileA Account" data-toggle="tooltip" data-placement="top" data-original-title="Accounts" data-pin-nopin="true">A</span><br />
                            </td>
                            <td class="text-center"></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">7</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 007" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br /> 
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">8</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 008" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">9</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                        		<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 009" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">10</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 010" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">11</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 011" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">12</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 012" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">13</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 013" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">14</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 014" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
                          <tr class="selected">
	                        <td class="text-center">15</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 001" data-pin-nopin="true">VII-A</span> 
	                            	<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
                            <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">16</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 002" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">17</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 003" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">18</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 004" data-pin-nopin="true">VII-A</span> 
	                            	<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">19</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 005" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">20</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 006" data-pin-nopin="true">VII-A</span> 
	                            	<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">21</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 007" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileB">B</span> <span class="ProfileD">D</span> <span class="ProfileA">A</span><br /> 
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">22</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 008" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">23</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                        		<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 009" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">24</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 010" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">25</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 011" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">26</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 012" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">27</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 013" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">28</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 014" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
                          <tr class="selected">
	                        <td class="text-center">29</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 001" data-pin-nopin="true">VII-A</span> 
	                            	<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
                            <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">30</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 002" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">31</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 003" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">32</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 004" data-pin-nopin="true">VII-A</span> 
	                            	<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">33</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 005" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">34</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 006" data-pin-nopin="true">VII-A</span> 
	                            	<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">35</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 007" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br /> 
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">36</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 008" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">37</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                        		<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 009" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">38</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 010" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">39</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 011" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">40</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 012" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">41</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 013" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">42</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 014" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
                          <tr class="selected">
	                        <td class="text-center">43</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 001" data-pin-nopin="true">VII-A</span> 
	                            	<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
                            <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">44</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 002" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">45</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 003" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">46</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 004" data-pin-nopin="true">VII-A</span> 
	                            	<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">47</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 005" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">48</td>
	                        <td class="text-center">
	                        	<span class="class_Name GirlSta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 006" data-pin-nopin="true">VII-A</span> 
	                            	<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">49</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 007" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br /> 
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/grayBell.jpg" width="15" /></td>
	                      </tr>
	                      <tr class="">
	                        <td class="text-center">50</td>
	                        <td class="text-center">
	                        	<span class="class_Name BoySta">
	                            	<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: 008" data-pin-nopin="true">VII-A</span> 
	                                <span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Status: S-CFS" data-pin-nopin="true">S</span>
	                            </span>
	                        </td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a></td>
	                        <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                	<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                </span></td>
	                        <td class="text-center">
                            	<span class="ProfileB">B</span> <span class="ProfileC" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">C</span> <span class="ProfileA">A</span> <span class="ProfileD">D</span><br />
                            </td>
                            <td class="text-center"><span class="ProfileB text-center">B</span> <span class="ProfileC text-center">C</span> <span class="ProfileD text-center">D</span> <span class="ProfileGray text-center">.</span></td>
	                        <td class="text-center"><img src="/application/views/haris/images/redBell.jpg" width="15" /></td>
	                      </tr>
	                  </tbody>
	                </table><!-- ListingTable -->
	            </div><!-- LeftListing_ContentSection -->
	        </div><!-- .StudentListing -->
	    </div><!-- col-md-3 -->
	    <div class="col-md-7 paddingRight0" style="">
	    	<div class="col-md-12 RightInformation_headerSection">
	            <div class="col-md-5 borderRightRed paddingLeft0">
	            	<div class="col-md-4 paddingLeft0 paddingRight0">
	            		<img width="100%" src="/application/views/haris/images/HadiHunaiz.jpg" title="Hadi" data-pin-nopin="true" class="borderRedImage" style="max-width: 105px;">
	            	</div><!-- -->
	            	<div class="col-md-8 paddingRight0">
                        <h2 class="headHeading">Muhammad Haris Ola</h2>
                        <h6 class="normalFont"><span class="leftLab2">GS-ID:</span> <strong>12-123</strong> (S-CFS)</h6>
                        <h6 class="normalFont"><span class="leftLab2">Grade:</span> <strong>VII-S</strong> (Jinnah)</h6>
                        <h6 class="normalFont"><span class="leftLab2">Att. Score:</span> 
                            <span class="AttBox PV" style="width:50%;">
                                <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                            </span>
                        </h6>
	            	</div><!-- -->
	            </div><!-- col-md-5 -->
	            <div class="col-md-4 borderRightRed">
					<h6 style="font-weight:normal;margin-top:5px;">
                    	<span class="leftLab" style="margin-top: 5px;">GS Profiles:</span> 
                        <span class="ProfileB" style="text-align:center;">B</span> <span class="ProfileC" style="text-align:center;">C</span> <span class="ProfileA" style="text-align:center;">A</span> <span class="ProfileD" style="text-align:center;">D</span>
                    </h6>
                    <h6 style="font-weight:normal;">
                    	<span class="leftLab" style="margin-top: 5px;">GF Profiles:</span> 
                        <span class="ProfileB" style="text-align:center;">B</span> <span class="ProfileC" style="text-align:center;">C</span>
                    </h6>
                    <h6 style="font-weight:normal;">
                    	<span class="leftLab">GF-ID:</span> <strong>12-441</strong>(1/3)
                    </h6>
                    <h6 class="normalFont">
                    	<span class="leftLab">Admission:</span> <strong>2012 (PN)</strong>
                    </h6>
	            </div><!-- col-md-4 -->
	            <div class="col-md-3">
					<div class="col-md-12 no-padding no-margin">
                    	<div class="col-md-6 no-padding no-margin">
                        	<img width="65" src="/application/views/haris/images/166309.png" style="margin-bottom:5px;" class="borderRedImage" data-toggle="tooltip" data-placement="top" data-original-title="Ahmed Qureshi" data-pin-nopin="true">
                        </div><!-- col-md-6 -->
                        <div class="col-md-6 no-padding no-margin">
                        	<img width="65" src="/application/views/haris/images/166309 (1).png" class="borderRedImage" data-toggle="tooltip" data-placement="top" data-original-title="Aisha Ahmed" data-pin-nopin="true">
                        </div><!-- -->
                    </div>
	            </div><!-- col-md-3 -->
	            <?php /* ?>
	            <div class="col-md-4 text-center">
	                <div class="col-md-12 entitiyPlace">
	                	ENTITY: <strong>STUDENT</strong>
	                </div><!-- col-md-12 -->
	                <div class="col-md-12 namePlace">
	                	<strong>Sana</strong> Moosa
	                </div><!-- col-md-12 -->
	                <div class="col-md-12 GSPlace">
	                	GS  <strong>12–345</strong> (S–CS)
	                </div><!-- col-md-12 -->
	            </div><!-- col-md-5 -->
	            <div class="col-md-3">
	                <div class="col-md-8">
	                	<img width="135" src="/application/views/haris/images/HadiHunaiz.jpg" title="Hadi" data-pin-nopin="true">
	                </div><!-- col-md-6 -->
	                <div class="col-md-4">
	                	
	                </div><!-- col-md-6  -->
	            </div><!-- col-md-2 -->
	            <div class="col-md-5 text-center detailHeaderRight">
	                <div class="col-md-6">
	                	GF <strong>09-088</strong> <span class="grayish">(1/3)</span>
	                </div><!-- col-md-6 -->
	                <div class="col-md-6">
	                	GF Profile / Lists (P, BL etc)
	                </div><!-- col-md-6 -->
	                <div class="col-md-6" style="background:none;padding:0;">
	                	<div class="col-md-6 noBG">
	                    	VII-S
	                    </div><!-- -->
	                    <div class="col-md-6 noBG">
	                    	Jinnah
	                    </div><!-- -->
	                </div><!-- col-md-6 -->
	                <div class="col-md-6">
	                	Attendance, History
	                </div><!-- col-md-6 -->
	                <div class="col-md-6">
	                	Adm’d 2012  (PN)
	                </div><!-- col-md-6 -->
	                <div class="col-md-6">
	                	GS Profile / Lists
	                </div><!-- col-md-6 -->
	            </div><!-- col-md-5 -->
	            <?php */ ?>
	        </div><!-- RightInformation_headerSection -->
	        <div class="RightInformation">
	            <div class="RightInformation_contentSection">
	                <ul class="nav nav-tabs">
	                    <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
	                    <li><a data-toggle="tab" href="#SMS">SMS</a></li>
	                    <li><a data-toggle="tab" href="#Attendance">Attendance</a></li>
	                    <li><a data-toggle="tab" href="#Grade">Grade</a></li>
	                    <li><a data-toggle="tab" href="#Billing">Billing</a></li>
	                    <li><a data-toggle="tab" href="#Discount">Discount</a></li>
	                    <li><a data-toggle="tab" href="#Arrears-Advance">Arrears/Advance</a></li>
	                    <li><a data-toggle="tab" href="#Timeline">Timeline</a></li>
	                 </ul><!-- nav-tabs -->
	                <div class="tab-content">
	                    <div id="profile" class="tab-pane fade in active">
	                        <h3 class="headingUnderline">Personal Information</h3>
	                        <table id="user" class="table table-bordered table-striped xedit" style="clear: both">
	                            <tbody> 
	                                <tr>         
	                                    <td width="50%"><span class="grayish">Abridged Name: </span> <a href="#" id="abridgedName" data-type="text" data-pk="1" data-title="Abridged name">A Hadi Hunaiz</a></td>
	                                    <td width="50%"><span class="grayish">Call Name: </span> <a href="#" id="callName" data-type="text" data-pk="1" data-title="Call name">Hadi</a></td>
	                                </tr>
	                                <tr>         
	                                    <td width="50%"><span class="grayish">Official Name: </span> <a href="#" id="officialName" data-type="text" data-pk="1" data-title="Official name">Abdul Hadi Hunaiz</a></td>
	                                    <td width="50%"><span class="grayish">DOB: </span> <a href="#" id="dobb" data-type="combodate" data-value="1984-05-15" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1"  data-title="Select Date of birth"></a></td>
	                                </tr>
	                                <tr>         
	                                    <td width="50%"><span class="grayish">Grade section: </span> <a href="#" id="gradeSection" data-type="text" data-pk="1" data-title="Grade-Section">PN-6</a></td>
	                                    <td width="50%"><span class="grayish">Gender: </span><a href="#" id="gender" data-type="select2" data-pk="1" data-value="B" data-title="Select gender"></a></td>
	                                </tr>
	                                <tr>         
	                                    <td width="50%"><span class="grayish">House: </span><a href="#" id="house" data-type="select2" data-pk="1" data-value="J" data-title="Select house"></a></td>
	                                    <td width="50%"><span class="grayish">&nbsp;</span></td>
	                                </tr>
	                            </tbody>
	                        </table>
	                        
	                        <h3 class="headingUnderline">Parents Information</h3>
	                        <table id="user" class="table table-bordered table-striped xedit" style="clear: both">
	                            <tbody> 
	                                <tr>         
	                                    <td width="50%"><span class="grayish">Father Name: </span> <a href="#" id="fatherName" data-type="text" data-pk="1" data-title="Father name">Saleem Ahmed Shaikh</a></td>
	                                    <td width="50%"><span class="grayish">Mother Name: </span> <a href="#" id="motherName" data-type="text" data-pk="1" data-title="Mother name">Kulssom Shaikh</a></td>
	                                </tr>
	                                <tr>         
	                                    <td width="50%"><span class="grayish">Father NIC: </span> <a href="#" id="fatherNIC" data-type="text" data-pk="1" data-title="Father NIC">42501-4559651-3</a></td>
	                                    <td width="50%"><span class="grayish">Mother NIC: </span> <a href="#" id="motherNIC" data-type="text" data-pk="1" data-title="Mother NIC">42201-9558651-5</a></td>
	                                </tr>
	                                <tr>         
	                                    <td width="50%"><span class="grayish">Father Mobile: </span> <a href="#" id="fatherMobile" data-type="text" data-pk="1" data-title="Father Mobile">+92-300-215-5406</a></td>
	                                    <td width="50%"><span class="grayish">Mother Mobile: </span> <a href="#" id="motherMobile" data-type="text" data-pk="1" data-title="Mother Mobile">+92-3332-312-3104</a></td>
	                                </tr>
	                                <tr>         
	                                    <td width="50%"><span class="grayish">Father Speciality: </span><a href="#" id="fatherSpec" data-type="text" data-pk="1" data-title="Father Speciality">Yarn Manufacturing</a></td>
	                                    <td width="50%"><span class="grayish">Mother Speciality: </span><a href="#" id="motherSpec" data-type="text" data-pk="1" data-title="Mother Speciality">N/A</a></td>
	                                </tr>
	                                <tr>         
	                                    <td width="50%"><span class="grayish">Father Profession: </span><a href="#" id="fatherProf" data-type="text" data-pk="1" data-title="Father Profession">Textile Engineer-Retired</a></td>
	                                    <td width="50%"><span class="grayish">Mother Profession: </span><a href="#" id="motherProf" data-type="text" data-pk="1" data-title="Mother Profession">House Wife</a></td>
	                                </tr>
	                                <tr>         
	                                    <td width="50%"><span class="grayish">Father Organization: </span><a href="#" id="fatherOrg" data-type="text" data-pk="1" data-title="Father Organization">Ntv-Sfdac</a></td>
	                                    <td width="50%"><span class="grayish">Mother Organization: </span><a href="#" id="motherOrg" data-type="text" data-pk="1" data-title="Mother Organization">N/A</a></td>
	                                </tr>
	                                <tr>         
	                                    <td width="50%"><span class="grayish">Father Department: </span><a href="#" id="fatherDept" data-type="text" data-pk="1" data-title="Father Department">Textile</a></td>
	                                    <td width="50%"><span class="grayish">Mother Department: </span><a href="#" id="motherDept" data-type="text" data-pk="1" data-title="Mother Department">N/A</a></td>
	                                </tr>
	                                <tr>         
	                                    <td width="50%"><span class="grayish">Father Designation: </span><a href="#" id="fatherDes" data-type="text" data-pk="1" data-title="Father Designation">Associate Professor</a></td>
	                                    <td width="50%"><span class="grayish">Mother Designation: </span><a href="#" id="motherDes" data-type="text" data-pk="1" data-title="Mother Designation">N/A</a></td>
	                                </tr>
	                            </tbody>
	                        </table>
	                    </div><!-- profile -->
	                    <div id="SMS" class="tab-pane fade">
	                      <h3>Menu 1</h3>
	                      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
	                    </div><!-- SMS -->
	                    <div id="Attendance" class="tab-pane fade">
	                      <h3>Menu 2</h3>
	                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
	                    </div><!-- Attendance -->
	                    <div id="Grade" class="tab-pane fade">
	                      <h3>Menu 3</h3>
	                      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	                    </div><!-- Grade -->
	                    <div id="Billing" class="tab-pane fade">
	                      <h3 class="headingUnderline">Billing details</h3>
	                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	                            <div class="panel panel-default">
	                                <div class="panel-heading" role="tab" id="headingOne">
	                                    <h4 class="panel-title">
	                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	                                            <i class="more-less glyphicon glyphicon-plus"></i>
	                                            <div class="col-md-4 ">Oct'16 | Nov'16</div>
	                                            <div class="col-md-4 "><span class="grayish">Bill#</span> 162161197</div>
	                                            <div class="col-md-3 "><span class="grayish">Status:</span> Cleared</div>
	                                        </a>
	                                    </h4><!-- panel-title -->
	                                </div><!-- panel-heading -->
	                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	                                    <div class="panel-body">
	                                        <table id="" class="table table-bordered table-striped no-margin billingTable" style="clear: both">
	                                            <tbody> 
	                                                    <tr>         
	                                                        <td width="33%"><span class="grayish">Bill Months: </span><span class="dataCalling">2</span></td>
	                                                        <td width="33%"><span class="grayish">Issue date: </span><span class="dataCalling">Thu, 6-Oct-2016</span></td>
	                                                        <td width="33%"><span class="grayish">Due date: </span><span class="dataCalling">Mon, 17-Oct-2016</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Payable: </span><span class="dataCalling">25,575</span></td>
	                                                        <td><span class="grayish">Received Amount: </span><span class="dataCalling">25,575</span></td>
	                                                        <td><span class="grayish">Received Date: </span><span class="dataCalling">Thu, 13th Oct 2016</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Tution Fee: </span><span class="dataCalling">33,100</span></td>
	                                                        <td><span class="grayish">Resource Fee: </span><span class="dataCalling">1000</span></td>
	                                                        <td><span class="grayish">Musakhar: </span><span class="dataCalling">0</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Yearly: </span><span class="dataCalling">-</span></td>
	                                                        <td><span class="grayish">Adjustment/Arrears: </span><span class="dataCalling">0</span></td>
	                                                        <td><span class="grayish">Concession: </span><span class="dataCalling">C(TC) 25</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Scholarship: </span><span class="dataCalling">-</span></td>
	                                                        <td><span class="grayish">ADV-TAX: </span><span class="dataCalling">0</span></td>
	                                                        <td><span class="grayish">Smart Card: </span><span class="dataCalling">0</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Magazine: </span><span class="dataCalling">0</span></td>
	                                                        <td><span class="grayish">Late Fee: </span><span class="dataCalling">0</span></td>
	                                                        <td><span class="grayish"></span></td>
	                                                    </tr>
	                                                </tbody>
	                                        </table><!-- billingTable -->
	                                    </div><!-- panel-body -->
	                                </div><!-- collapseOne -->
	                            </div><!-- panel -->
	                            <div class="panel panel-default">
	                                <div class="panel-heading" role="tab" id="headingTwo">
	                                    <h4 class="panel-title">
	                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	                                            <i class="more-less glyphicon glyphicon-plus"></i>
	                                            <div class="col-md-4 ">Oct'16 | Nov'16</div>
	                                            <div class="col-md-4 "><span class="grayish">Bill#</span> 162161197</div>
	                                            <div class="col-md-3 "><span class="grayish">Status:</span> Cleared</div>
	                                        </a>
	                                    </h4>
	                                </div><!-- panel-heading -->
	                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
	                                    <div class="panel-body">
	                                        <table id="" class="table table-bordered table-striped no-margin billingTable" style="clear: both">
	                                            <tbody> 
	                                                    <tr>         
	                                                        <td width="33%"><span class="grayish">Bill Months: </span><span class="dataCalling">2</span></td>
	                                                        <td width="33%"><span class="grayish">Issue date: </span><span class="dataCalling">2</span></td>
	                                                        <td width="33%"><span class="grayish">Due date: </span><span class="dataCalling">2</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Payable: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Received Amount: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Received Date: </span><span class="dataCalling">2</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Tution Fee: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Resource Fee: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Musakhar: </span><span class="dataCalling">2</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Yearly: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Adjustment/Arrears: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Concession: </span><span class="dataCalling">2</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Scholarship: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">ADV-TAX: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Smart Card: </span><span class="dataCalling">2</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Magazine: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Late Fee: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish"></span></td>
	                                                    </tr>
	                                                </tbody>
	                                        </table><!-- billingTable -->
	                                    </div><!-- panel-body -->
	                                </div><!-- collapseTwo -->
	                            </div><!-- panel -->
	                            <div class="panel panel-default">
	                                <div class="panel-heading" role="tab" id="headingThree">
	                                    <h4 class="panel-title">
	                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
	                                            <i class="more-less glyphicon glyphicon-plus"></i>
	                                            <div class="col-md-4 ">Oct'16 | Nov'16</div>
	                                            <div class="col-md-4 "><span class="grayish">Bill#</span> 162161197</div>
	                                            <div class="col-md-3 "><span class="grayish">Status:</span> Cleared</div>
	                                        </a>
	                                    </h4>
	                                </div><!-- panel-heading -->
	                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
	                                    <div class="panel-body">
	                                        <table id="" class="table table-bordered table-striped no-margin billingTable" style="clear: both">
	                                            <tbody> 
	                                                    <tr>         
	                                                        <td width="33%"><span class="grayish">Bill Months: </span><span class="dataCalling">2</span></td>
	                                                        <td width="33%"><span class="grayish">Issue date: </span><span class="dataCalling">2</span></td>
	                                                        <td width="33%"><span class="grayish">Due date: </span><span class="dataCalling">2</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Payable: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Received Amount: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Received Date: </span><span class="dataCalling">2</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Tution Fee: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Resource Fee: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Musakhar: </span><span class="dataCalling">2</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Yearly: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Adjustment/Arrears: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Concession: </span><span class="dataCalling">2</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Scholarship: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">ADV-TAX: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Smart Card: </span><span class="dataCalling">2</span></td>
	                                                    </tr>
	                                                    <tr>         
	                                                        <td><span class="grayish">Magazine: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish">Late Fee: </span><span class="dataCalling">2</span></td>
	                                                        <td><span class="grayish"></span></td>
	                                                    </tr>
	                                                </tbody>
	                                        </table><!-- billingTable -->
	                                    </div><!-- panel-body -->
	                                </div><!-- collapseThree -->
	                            </div><!-- panel -->
	                        </div><!-- panel-group -->
	                    </div><!-- Billing -->
	                    <div id="Discount" class="tab-pane fade">
	                      <h3>Menu 3</h3>
	                      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	                    </div><!-- Discount -->
	                    <div id="Arrears-Advance" class="tab-pane fade">
	                      <h3>Menu 3</h3>
	                      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	                    </div><!-- Arrears-Advance -->
	                    <div id="Timeline" class="tab-pane fade">
	                      <h3>Menu 3</h3>
	                      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	                    </div><!-- Timeline -->
	                </div><!-- tab-content -->
	            </div><!-- .RightInformation_contentSection -->
	        </div><!-- RightInformation -->
	    </div><!-- col-md-9 -->
	</div><!-- row -->
</div><!-- container -->
