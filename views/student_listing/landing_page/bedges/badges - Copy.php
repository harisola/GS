<!-- Bedges Modal -->
    	<div class="modal fade in TimeLineModal" id="BadgeModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Badge Details</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12" style="padding-bottom:0;">
                        <div class="MaroonBorderBox">
                            <div class="inner" style="">
                            	<div class="col-md-12 padding">
                                    <div class="portlet" id="ListBadges">
									
                                        <h3>All badges <a href="#" class="AddNewBadge ButtonAnchor">Add New Badge</a></h3>
										
                                          <table width="100%" border="1" id="BadgeList" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                  <th class="text-center no-sort" width="">&nbsp;</th>
                                                  <th class="" width="">Badge Title</th>
                                                  <th class="" width="">Assigned to</th>
                                                  <th class="no-sort text-center" width="">Action</th>
                                                </tr>
                                            </thead><!-- thead -->
                                            <tbody>
                                                <tr class="">
                                                  <td class="text-center"><span class="badgeShow" style="background:#000;">S</span></td>
                                                  <td class="">Shame Sehar</td>
                                                  <td class="">10</td>
                                                  <td class="text-center"><a href="#" class="AddNewBadge">Edit</a> | <a href="#" class="AddNewBadge">Assign</a></td>
                                                </tr>
                                                <tr class="">
                                                  <td class="text-center"><span class="badgeShow" style="background:#b74545;">R</span></td>
                                                  <td class="">Robotics</td>
                                                  <td class="">08</td>
                                                  <td class="text-center"><a href="#">Edit</a> | <a href="#">Assign</a></td>
                                                </tr>
                                                <tr class="">
                                                  <td class="text-center"><span class="badgeShow" style="background:#9dbd5f;">F</span></td>
                                                  <td class="">Football</td>
                                                  <td class="">20</td>
                                                  <td class="text-center"><a href="#">Edit</a> | <a href="#">Assign</a></td>
                                                </tr>
                                                <tr class="">
                                                  <td class="text-center"><span class="badgeShow" style="background:#495433;">B</span></td>
                                                  <td class="">Badminton</td>
                                                  <td class="">15</td>
                                                  <td class="text-center"><a href="#">Edit</a> | <a href="#">Assign</a></td>
                                                </tr>
                                                <tr class="">
                                                  <td class="text-center"><span class="badgeShow" style="background:#4683c1;">A</span></td>
                                                  <td class="">Assessment</td>
                                                  <td class="">14</td>
                                                  <td class="text-center"><a href="#">Edit</a> | <a href="#">Assign</a></td>
                                                </tr>
                                                <tr class="">
                                                  <td class="text-center"><span class="badgeShow" style="background:#6783a0;">P</span></td>
                                                  <td class="">Paper Based Assessment</td>
                                                  <td class="">15</td>
                                                  <td class="text-center"><a href="#">Edit</a> | <a href="#">Assign</a></td>
                                                </tr>
                                            </tbody>
                                          </table><!-- ListingTable -->
                                    </div><!-- .MaroonBorderBox -->
                                    
                                    <div class="portlet" id="AddNewBadgeArea" style="display:none;">
                                    	<h3 style="margin-bottom:20px;">Add a new Badge <a href="#" id="BackBadge">Back to Badges</a></h3>
                                        	<div class="col-md-5 no-padding border-right extrapadding">
                                            	<div class="col-md-12 paddingBottom15">
                                                    <div class="col-md-3 paddingTop5 text-right">
                                                        Title
                                                    </div><!-- col-md-3 -->
                                                    <div class="col-md-9">
                                                        <input type="text" placeholder="Badge title" />
                                                    </div><!-- col-md-9 -->
                                                </div><!-- col-md-12 -->
                                                <div class="col-md-12 paddingBottom15">
                                                    <div class="col-md-3 paddingTop5 text-right">
                                                        Code
                                                    </div><!-- col-md-3 -->
                                                    <div class="col-md-9">
                                                        <input type="text" placeholder="Badge code" />
                                                    </div><!-- col-md-9 -->
                                                </div><!-- col-md-12 -->
                                                <div class="col-md-12 paddingBottom15">
                                                    <div class="col-md-3 paddingTop5 text-right">
                                                        Expiry
                                                    </div><!-- col-md-3 -->
                                                    <div class="col-md-9">
                                                        <input type="date" placeholder="Expiry date" />
                                                    </div><!-- col-md-9 -->
                                                </div><!-- col-md-12 -->
                                                <div class="col-md-12 paddingBottom15">
                                                    <div class="col-md-3 paddingTop5 text-right">
                                                        Color
                                                    </div><!-- col-md-3 -->
                                                    <div class="col-md-9">
                                                        <input type="color" value="#ff0000" />
                                                    </div><!-- col-md-9 -->
                                                </div><!-- col-md-12 -->
                                                <div class="col-md-12 paddingBottom15">
                                                    <div class="col-md-3 paddingTop5 text-right">
                                                        Priority
                                                    </div><!-- col-md-3 -->
                                                    <div class="col-md-9">
                                                        <select>
                                                          <option value="1">1</option>
                                                          <option value="2">2</option>
                                                          <option value="3">3</option>
                                                          <option value="4">4</option>
                                                        </select>
                                                    </div><!-- col-md-9 -->
                                                </div><!-- col-md-12 -->
                                                <div class="col-md-12 paddingBottom15">
                                                    <div class="col-md-3 text-right">
                                                        Description
                                                    </div><!-- col-md-3 -->
                                                    <div class="col-md-9">
                                                        <textarea rows="5"></textarea>
                                                    </div><!-- col-md-9 -->
                                                </div><!-- col-md-12 -->
                                            </div><!-- col-md-5 no-padding -->
                                            <div class="col-md-7">
                                            	<table width="100%" border="1" id="BadgeAllocation" class="table table-striped table-bordered table-hover">
                                          <thead>
                                              <tr>
                                                <th class="text-center no-sort" width=""><input type="checkbox" /></th>
                                                <th class="text-center" width="">GS-ID</th>
                                                <th class="" width="">Name</th>
                                                <th class="no-sort text-center" width="">Badges</th>
                                              </tr>
                                          </thead><!-- thead -->
                                          <tbody>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-123</td>
                                                <td class="">Affan <strong>Maqsood</strong> Khan</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-124</td>
                                                <td class="">Muhammad <strong>Haris</strong> Ola</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-123</td>
                                                <td class="">Affan <strong>Maqsood</strong> Khan</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-124</td>
                                                <td class="">Muhammad <strong>Haris</strong> Ola</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-123</td>
                                                <td class="">Affan <strong>Maqsood</strong> Khan</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-124</td>
                                                <td class="">Muhammad <strong>Haris</strong> Ola</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-123</td>
                                                <td class="">Affan <strong>Maqsood</strong> Khan</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-124</td>
                                                <td class="">Muhammad <strong>Haris</strong> Ola</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-123</td>
                                                <td class="">Affan <strong>Maqsood</strong> Khan</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-124</td>
                                                <td class="">Muhammad <strong>Haris</strong> Ola</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-123</td>
                                                <td class="">Affan <strong>Maqsood</strong> Khan</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-124</td>
                                                <td class="">Muhammad <strong>Haris</strong> Ola</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-123</td>
                                                <td class="">Affan <strong>Maqsood</strong> Khan</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-124</td>
                                                <td class="">Muhammad <strong>Haris</strong> Ola</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-123</td>
                                                <td class="">Affan <strong>Maqsood</strong> Khan</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                              <tr class="">
                                                <td class="text-center"><input type="checkbox" /></td>
                                                <td class="text-center">12-124</td>
                                                <td class="">Muhammad <strong>Haris</strong> Ola</td>
                                                <td class="text-center"><span class="ProfileB text-center">G</span> <span class="ProfileC text-center">M</span> <span class="ProfileD text-center">A</span> <span class="ProfileGray text-center">.</span></td>
                                              </tr>
                                          </tbody>
                                        </table><!-- ListingTable -->
                                            </div><!-- col-md-7 -->
                                        <hr />
                                        <div class="col-md-12 text-center">
                                        	<input type="submit" class="centerGreenBtn" value="Add New Badge" />
                                        </div><!-- col-md-12 -->
                                    </div>
                                </div><!-- col-md-12 -->
                              
                            </div><!-- inner -->
                        </div><!-- .MaroonBorderBox -->
                    </div><!-- col-md-12 -->
                </div><!-- modal-body -->
              </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div><!-- AddDetails -->
    