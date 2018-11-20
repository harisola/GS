<?php  
  $ImageName = base_url() . $this->data['staff_150_photo_path'] . $this->data['staff_registered_data'][0]->employee_id . $this->data['photo_file'];
  $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
  $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
  $ImageFound = "Yes";

  if (!file_exists($this->data['staff_150_photo_path'] . $this->data['staff_registered_data'][0]->employee_id . $this->data['photo_file'])) {
      if($this->data['staff_registered_data'][0]->gender == 'M'){
          $ImageName = $ImageMale;
      }else if($this->data['staff_registered_data'][0]->gender == 'F'){
          $ImageName = $ImageFemale;
      }

      $ImageFound = "No";

      /*http://placehold.it/150x150*/
  }
?>


  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable"> 
            
            <!-- New widget -->
            
            
          <div class="powerwidget cold-grey powerwidget-sortable" id="profile" data-widget-editbutton="false" role="widget" style="">
              <header role="heading">
                <h2>Profile <small><?php echo ucwords($this->data['staff_registered_data'][0]->abridged_name); ?></small></h2>
              <div class="powerwidget-ctrls" role="menu">               
                <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
                <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
              </div><span class="powerwidget-loader"></span></header>
              <div class="inner-spacer" role="content"> 
                
                <!--Profile-->
                <div class="user-profile">
                  <div class="main-info">
                    <div class="user-img"><img src="<?php echo $ImageName; ?>" alt="User Picture"></div>
                    <h1><?php echo ucwords($this->data['staff_registered_data'][0]->abridged_name); ?></h1>
                    <!-- ABC: 451 | XYZ: 45 | 123: 22 --> </div>
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="item item1"> </div>
                      <div class="item item2"></div>
                      <div class="item item3 active"></div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a> <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a> </div>
                  <div class="user-profile-info">
                    <div class="tabs-white">
                      <ul id="myTab" class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#home" data-toggle="tab"></a></li>
                        <!-- <li class="active"><a href="#home" data-toggle="tab">About</a></li> -->
                        <!-- <li><a href="#followers" data-toggle="tab">Followers</a></li>
                        <li><a href="#activity" data-toggle="tab">Activity</a></li>
                        <li><a href="#blog" data-toggle="tab">Blogs</a></li>
                        <li><a href="#chat" data-toggle="tab">Chat</a></li> -->
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <?php
                          if(validation_errors() != false) {
                            echo '<div class="callout callout-danger">' . validation_errors() . "</div>";
                          }else{
                            if(count($_POST)){
                              echo '<div class="callout callout-info"> Your password changed successfully. </div>';              
                            }
                          }
                        ?>
                        <div class="tab-pane in active" id="home">
                          <div class="profile-header">Settings</div>
                            <div class="inner-spacer" role="content">          


                    <!-- New user form opening -->
                    <form id="new_user_form" action="<?php echo site_url()?>/profile/profile_view" method="post" enctype="multipart/form-data" class="orb-form" novalidate="novalidate">
                    <!-- New user form opening -->
                    <h3>Change Password</h3>
                      <fieldset>
                        <div class="row">
                          <section class="col col-4">
                            <label class="input"> <i class="icon-append fa fa-user"></i>
                              <input type="password" id="old_password" name="old_password" placeholder="Old Password">
                            </label>
                          </section>                         
                        </div>

                        <div class="row">
                          <section class="col col-4">
                            <label class="input"> <i class="icon-append fa fa-lock"></i>
                              <input type="password" id="new_password" name="new_password" placeholder="New Password (min 8 characters)">
                            </label>
                          </section>
                        </div>

                        <div class="row">
                          <section class="col col-4">
                            <label class="input"> <i class="icon-append fa fa-lock"></i>
                              <input type="password" id="new_password_confirm" name="new_password_confirm" placeholder="Retype New Password">
                            </label>
                          </section>
                        </div>

                      <footer>
                        <button type="submit" class="btn btn-orb-org">Submit</button>
                      </footer>       
                    </form>
                  </div>
                          <!-- <div class="profile-header">About</div>
                          <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                          <table class="table">
                            <tbody><tr>
                              <td><strong>Age:</strong></td>
                              <td>789</td>
                              <td><strong>Affilation:</strong></td>
                              <td>Jedi</td>
                            </tr>
                            <tr>
                              <td><strong>Email:</strong></td>
                              <td>yoda@skywalkers.com</td>
                              <td><strong>Midi-Chlorians:</strong></td>
                              <td>High</td>
                            </tr>
                            <tr>
                              <td><strong>Status:</strong></td>
                              <td>Forever Alone</td>
                              <td><strong>Height:</strong></td>
                              <td>0,66 Meters</td>
                            </tr>
                            <tr>
                              <td><strong>Sex:</strong></td>
                              <td>Male</td>
                              <td><strong>Mass:</strong></td>
                              <td>17 Kg</td>
                            </tr>
                            <tr>
                              <td><strong>Side:</strong></td>
                              <td>Dark Side</td>
                              <td><strong>Species:</strong></td>
                              <td>Unknown</td>
                            </tr>
                          </tbody></table>
                                                  </div>
                                                  <div class="tab-pane" id="followers">
                          <div class="profile-header"> Following <span class="badge">224</span>
                            <div class="btn-group btn-group-xs pull-right">
                              <button class="btn btn-default">Show all</button>
                            </div>
                          </div>
                          <div class="row"> 
                            
                            Tiny User Block
                            <div class="col-md-4 col-sm-6">
                              <div class="tiny-user-block clearfix">
                                <div class="user-img"> <img src="http://placehold.it/150x150" alt="User"> </div>
                                <h3>Gluck Dorris</h3>
                                <ul>
                                  <li>Followers: <strong>1251</strong></li>
                                  <li>Following: <strong>1443</strong></li>
                                </ul>
                                <button class="btn btn-sm btn-success">Follow</button>
                                <button class="btn btn-sm btn-warning">Unfollow</button>
                              </div>
                            </div>
                            /Tiny User Block 
                            
                            Tiny User Block
                            <div class="col-md-4 col-sm-6">
                              <div class="tiny-user-block clearfix">
                                <div class="user-img"> <img src="http://placehold.it/150x150" alt="User"> </div>
                                <h3>Spiderman</h3>
                                <ul>
                                  <li>Followers: <strong>151</strong></li>
                                  <li>Following: <strong>224</strong></li>
                                </ul>
                                <button class="btn btn-sm btn-success">Follow</button>
                                <button class="btn btn-sm btn-warning">Unfollow</button>
                              </div>
                            </div>
                            /Tiny User Block 
                            
                            Tiny User Block
                            <div class="col-md-4 col-sm-6">
                              <div class="tiny-user-block clearfix">
                                <div class="user-img"> <img src="http://placehold.it/150x150" alt="User"> </div>
                                <h3>Barack Muchu</h3>
                                <ul>
                                  <li>Followers: <strong>235</strong></li>
                                  <li>Following: <strong>244</strong></li>
                                </ul>
                                <button class="btn btn-sm btn-success">Follow</button>
                                <button class="btn btn-sm btn-warning">Unfollow</button>
                              </div>
                            </div>
                            /Tiny User Block 
                            
                            Tiny User Block
                            <div class="col-md-4 col-sm-6">
                              <div class="tiny-user-block clearfix">
                                <div class="user-img"> <img src="http://placehold.it/150x150" alt="User"> </div>
                                <h3>Piggy Muppet</h3>
                                <ul>
                                  <li>Followers: <strong>451</strong></li>
                                  <li>Following: <strong>1778</strong></li>
                                </ul>
                                <button class="btn btn-sm btn-success">Follow</button>
                                <button class="btn btn-sm btn-warning">Unfollow</button>
                              </div>
                            </div>
                            /Tiny User Block 
                            
                            Tiny User Block
                            <div class="col-md-4 col-sm-6">
                              <div class="tiny-user-block clearfix">
                                <div class="user-img"> <img src="http://placehold.it/150x150" alt="User"> </div>
                                <h3>Chewbacca</h3>
                                <ul>
                                  <li>Followers: <strong>678</strong></li>
                                  <li>Following: <strong>1304</strong></li>
                                </ul>
                                <button class="btn btn-sm btn-success">Follow</button>
                                <button class="btn btn-sm btn-warning">Unfollow</button>
                              </div>
                            </div>
                            /Tiny User Block 
                            
                            Tiny User Block
                            <div class="col-md-4 col-sm-6">
                              <div class="tiny-user-block clearfix">
                                <div class="user-img"> <img src="http://placehold.it/150x150" alt="User"> </div>
                                <h3>Piggy Muppet</h3>
                                <ul>
                                  <li>Followers: <strong>4519</strong></li>
                                  <li>Following: <strong>44</strong></li>
                                </ul>
                                <button class="btn btn-sm btn-success">Follow</button>
                                <button class="btn btn-sm btn-warning">Unfollow</button>
                              </div>
                            </div>
                            /Tiny User Block 
                            
                          </div>
                          <div class="profile-header"> Followers <span class="badge">451</span>
                            <div class="btn-group btn-group-xs pull-right">
                              <button class="btn btn-default">Show all</button>
                            </div>
                          </div>
                          <div class="row"> 
                            
                            Tiny User Block
                            <div class="col-md-4 col-sm-6">
                              <div class="tiny-user-block clearfix">
                                <div class="user-img"> <img src="http://placehold.it/150x150" alt="User"> </div>
                                <h3>Piggy Muppet</h3>
                                <ul>
                                  <li>Followers: <strong>999</strong></li>
                                  <li>Following: <strong>7681</strong></li>
                                </ul>
                                <button class="btn btn-sm btn-success">Follow</button>
                                <button class="btn btn-sm btn-warning">Unfollow</button>
                              </div>
                            </div>
                            /Tiny User Block 
                            
                            Tiny User Block
                            <div class="col-md-4 col-sm-6">
                              <div class="tiny-user-block clearfix">
                                <div class="user-img"> <img src="http://placehold.it/150x150" alt="User"> </div>
                                <h3>Piggy Muppet</h3>
                                <ul>
                                  <li>Followers: <strong>451</strong></li>
                                  <li>Following: <strong>145</strong></li>
                                </ul>
                                <button class="btn btn-sm btn-success">Follow</button>
                                <button class="btn btn-sm btn-warning">Unfollow</button>
                              </div>
                            </div>
                            /Tiny User Block 
                            
                            Tiny User Block
                            <div class="col-md-4 col-sm-6">
                              <div class="tiny-user-block clearfix">
                                <div class="user-img"> <img src="http://placehold.it/150x150" alt="User"> </div>
                                <h3>Piggy Muppet</h3>
                                <ul>
                                  <li>Followers: <strong>451</strong></li>
                                  <li>Following: <strong>811</strong></li>
                                </ul>
                                <button class="btn btn-sm btn-success">Follow</button>
                                <button class="btn btn-sm btn-warning">Unfollow</button>
                              </div>
                            </div>
                            /Tiny User Block 
                            
                            Tiny User Block
                            <div class="col-md-4 col-sm-6">
                              <div class="tiny-user-block clearfix">
                                <div class="user-img"> <img src="http://placehold.it/150x150" alt="User"> </div>
                                <h3>Piggy Muppet</h3>
                                <ul>
                                  <li>Followers: <strong>451</strong></li>
                                  <li>Following: <strong>212</strong></li>
                                </ul>
                                <button class="btn btn-sm btn-success">Follow</button>
                                <button class="btn btn-sm btn-warning">Unfollow</button>
                              </div>
                            </div>
                            /Tiny User Block 
                            
                            Tiny User Block
                            <div class="col-md-4 col-sm-6">
                              <div class="tiny-user-block clearfix">
                                <div class="user-img"> <img src="http://placehold.it/150x150" alt="User"> </div>
                                <h3>Piggy Muppet</h3>
                                <ul>
                                  <li>Followers: <strong>651</strong></li>
                                  <li>Following: <strong>190</strong></li>
                                </ul>
                                <button class="btn btn-sm btn-success">Follow</button>
                                <button class="btn btn-sm btn-warning">Unfollow</button>
                              </div>
                            </div>
                            /Tiny User Block 
                            
                            Tiny User Block
                            <div class="col-md-4 col-sm-6">
                              <div class="tiny-user-block clearfix">
                                <div class="user-img"> <img src="http://placehold.it/150x150" alt="User"> </div>
                                <h3>Piggy Muppet</h3>
                                <ul>
                                  <li>Followers: <strong>451</strong></li>
                                  <li>Following: <strong>244</strong></li>
                                </ul>
                                <button class="btn btn-sm btn-success">Follow</button>
                                <button class="btn btn-sm btn-warning">Unfollow</button>
                              </div>
                            </div>
                            /Tiny User Block 
                            
                          </div>
                                                  </div>
                                                  <div class="tab-pane" id="activity">
                          <div class="profile-header">Timeline</div>
                          <ul class="tmtimeline">
                            <li>
                              <time class="tmtime" datetime="2013-04-10 18:30"><span>4/10/13</span> <span>18:30</span></time>
                              <div class="tmicon bg-cold-grey fa-camera"></div>
                              <div class="tmlabel">
                                <h2>Added photo</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam cursus turpis quis neque imperdiet, eleifend feugiat erat consectetur. Donec eget fringilla lorem, eget auctor sapien.</p>
                              </div>
                            </li>
                            <li>
                              <time class="tmtime" datetime="2013-04-11T12:04"><span>4/11/13</span> <span>12:04</span></time>
                              <div class="tmicon bg-cold-grey fa-comment"></div>
                              <div class="tmlabel">
                                <h2>Added comment</h2>
                                <p>Caulie dandelion maize lentil collard greens radish arugula 
                                  sweet pepper water spinach kombu courgette lettuce. Celery coriander 
                                  bitterleaf epazote radicchio shallot winter purslane collard greens 
                                  spring onion squash lentil. Artichoke salad bamboo shoot black-eyed pea 
                                  brussels sprout garlic kohlrabi.</p>
                              </div>
                            </li>
                            <li>
                              <time class="tmtime" datetime="2013-04-13 05:36"><span>4/13/13</span> <span>05:36</span></time>
                              <div class="tmicon bg-cold-grey fa-coffee"></div>
                              <div class="tmlabel">
                                <h2>Drinked tea</h2>
                                <p>Nam tincidunt neque nec est bibendum, ut cursus nulla egestas. Etiam at mi vel sem viverra euismod. Nam scelerisque metus urna, ut facilisis augue dictum quis.</p>
                              </div>
                            </li>
                            <li>
                              <time class="tmtime" datetime="2013-04-15 13:15"><span>4/15/13</span> <span>13:15</span></time>
                              <div class="tmicon bg-cold-grey fa-cloud"></div>
                              <div class="tmlabel">
                                <h2>Uploaded files to cloud</h2>
                                <p> Donec fringilla metus dui, placerat pulvinar lectus elementum ullamcorper. Quisque dignissim nulla at purus volutpat placerat. In a justo purus.</p>
                              </div>
                            </li>
                            <li>
                              <time class="tmtime" datetime="2013-04-16 21:30"><span>4/16/13</span> <span>21:30</span></time>
                              <div class="tmicon bg-cold-grey bg-cold-grey fa-heart"></div>
                              <div class="tmlabel">
                                <h2>Falling in love</h2>
                                <p>Fusce pretium nibh eros, at adipiscing neque euismod eget. Suspendisse sollicitudin justo vel urna sollicitudin, sed pellentesque dolor ultricies.</p>
                              </div>
                            </li>
                            <li>
                              <time class="tmtime" datetime="2013-04-17 12:11"><span>4/17/13</span> <span>12:11</span></time>
                              <div class="tmicon bg-cold-grey fa-thumbs-up"></div>
                              <div class="tmlabel">
                                <h2>Giving Some Likes</h2>
                                <p> Fusce feugiat ornare libero sed gravida. Aenean metus est, suscipit nec condimentum ac, facilisis eget lorem. Suspendisse rutrum lorem orci. Ut in ligula neque. Phasellus a enim at leo pellentesque dapibus. Integer dignissim sem eu venenatis facilisis. Sed quis neque nec lectus gravida euismod. Nam sollicitudin, nisl nec lacinia blandit, magna felis pharetra enim, et lacinia metus ipsum et est.</p>
                              </div>
                            </li>
                          </ul>
                                                  </div>
                                                  <div class="tab-pane" id="blog">
                          <div class="profile-header">Blogs</div>
                          User Blog Entry
                          <div class="user-blog-entry">
                            <h2><a href="#">Dart Wader Sucks!</a></h2>
                            <div class="info">
                              <p class="month">Oct</p>
                              <p class="day">28</p>
                              <p class="time">23:29</p>
                            </div>
                            Fusce feugiat ornare libero sed gravida. Aenean metus est, suscipit nec condimentum ac, facilisis eget lorem. Suspendisse rutrum lorem orci. Ut in ligula neque. Phasellus a enim at leo pellentesque dapibus. Integer dignissim sem eu venenatis facilisis. Sed quis neque nec lectus gravida euismod. Nam sollicitudin, nisl nec lacinia blandit, magna felis pharetra enim, et lacinia metus ipsum et est.
                            <div class="blog-tags padding"> <a href="#" rel="tag">Sex</a> <a href="#" rel="tag">Envato</a> <a href="#" rel="tag">Modern Design</a> <a href="#" rel="tag">SEO Optimization</a> <a href="#" rel="tag">Big Money Deal</a> <a href="#" rel="tag">Hipsta</a></div>
                          </div>
                          /User Blog Entry 
                          
                          User Blog Entry
                          <div class="user-blog-entry">
                            <h2><a href="#">Death Star destroyed must be</a></h2>
                            <div class="info">
                              <p class="month">Oct</p>
                              <p class="day">25</p>
                              <p class="time">23:29</p>
                            </div>
                            Fusce feugiat ornare libero sed gravida. Aenean metus est, suscipit nec condimentum ac, facilisis eget lorem. Suspendisse rutrum lorem orci. Ut in ligula neque. Phasellus a enim at leo pellentesque dapibus. Integer dignissim sem eu venenatis facilisis. Sed quis neque nec lectus gravida euismod. Nam sollicitudin, nisl nec lacinia blandit, magna felis pharetra enim, et lacinia metus ipsum et est.
                            <div class="blog-tags padding"> <a href="#" rel="tag">CSS3</a> <a href="#" rel="tag">HTML5</a> <a href="#" rel="tag">jQuery</a> <a href="#" rel="tag">Premium Theme</a> <a href="#" rel="tag">Design</a> <a href="#" rel="tag">Cool</a> <a href="#" rel="tag">Love</a></div>
                          </div>
                          /User Blog Entry 
                          
                          User Blog Entry
                          <div class="user-blog-entry">
                            <h2><a href="#">Empire Earth</a></h2>
                            <div class="info">
                              <p class="month">Oct</p>
                              <p class="day">21</p>
                              <p class="time">23:29</p>
                            </div>
                            Etiam hendrerit dolor nec feugiat fringilla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget porttitor nibh. Maecenas mauris nibh, imperdiet nec fermentum ac, feugiat eget neque. Sed eget augue nec metus hendrerit commodo at nec felis. Nam viverra neque lacus, vitae dignissim ante hendrerit sit amet. In eros justo, mollis sit amet rutrum vel, sollicitudin sit amet elit. Fusce consequat vel justo eget pulvinar. Vestibulum aliquet lectus volutpat, condimentum eros eget, molestie nisi. Phasellus facilisis vel elit quis gravida. In tincidunt sagittis eros, ullamcorper convallis enim molestie non.
                            <div class="blog-tags padding"> <a href="#" rel="tag">CSS3</a> <a href="#" rel="tag">HTML5</a> <a href="#" rel="tag">jQuery</a> <a href="#" rel="tag">Premium Theme</a></div>
                          </div>
                          /User Blog Entry 
                          
                                                  </div>
                                                  Chat Tab
                                                  <div class="tab-pane in" id="chat">
                          <div class="profile-header">Chat</div>
                          <div class="chat-messages user-profile-chat">
                            <ul>
                              <li class="left clearfix">
                                <div class="user-img pull-left"> <img src="http://placehold.it/150x150" alt="User Avatar"> </div>
                                <div class="chat-body clearfix">
                                  <div class="header"> <span class="name">Gluck Dorris</span><span class="name"></span> <span class="badge"><i class="fa fa-clock-o"></i>14 mins ago</span></div>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent porttitor nulla vitae interdum fermentum. Ut in vulputate neque. Praesent luctus lacus a dolor tempus pellentesque. Cras sit amet urna eu augue suscipit eleifend. Mauris mollis pharetra faucibus. Phasellus eu massa quam. Nunc id metus placerat neque feugiat commodo. </p>
                                </div>
                              </li>
                              <li class="right clearfix"><span class="user-img pull-right"> <img src="http://placehold.it/150x150" alt="User Avatar"> </span>
                                <div class="chat-body clearfix">
                                  <div class="header"> <span class="name">Anton Durant</span><span class=" badge"><i class="fa fa-clock-o"></i>13 mins ago</span> </div>
                                  <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales. </p>
                                </div>
                              </li>
                              <li class="left clearfix"><span class="user-img pull-left"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle"> </span>
                                <div class="chat-body clearfix">
                                  <div class="header"> <span class="name">Spiderman</span> <span class="badge"><i class="fa fa-clock-o"></i>14 mins ago</span> </div>
                                  <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales. </p>
                                </div>
                              </li>
                              <li class="right clearfix"><span class="user-img pull-right"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle"> </span>
                                <div class="chat-body clearfix">
                                  <div class="header"><span class="name">Muchu</span><small class="badge"><i class="fa fa-clock-o"></i>15 mins ago</small></div>
                                  <p>Nunc ipsum dui, tempus id sagittis eu, rutrum ac libero. Morbi non enim a tortor pulvinar feugiat at consectetur nunc. Curabitur pulvinar tincidunt nisi id bibendum. Nulla ut diam iaculis, venenatis velit hendrerit, fringilla arcu. Mauris accumsan pulvinar augue, non blandit justo vestibulum a. Proin non eros semper, accumsan nisl in, imperdiet justo. Pellentesque convallis commodo porttitor. Nam feugiat dignissim felis sed tempor. Sed pretium eros nec mi semper aliquam. Phasellus eget accumsan felis. Nulla varius risus quis dapibus porta. Donec vel magna viverra, semper velit eu, adipiscing arcu. Integer sollicitudin elementum est eget ullamcorper. Mauris eget sollicitudin erat. Nullam et lacinia nibh, a aliquam nunc. Curabitur ullamcorper metus ac purus commodo, sit amet mattis arcu mollis. </p>
                                </div>
                              </li>
                              <li class="left clearfix"><span class="user-img pull-left"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle"> </span>
                                <div class="chat-body clearfix">
                                  <div class="header"> <span class="name">Gluck Dorris</span> <span class="badge"><i class="fa fa-clock-o"></i>14 mins ago</span></div>
                                  <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales. </p>
                                </div>
                              </li>
                              <li class="right clearfix"><span class="user-img pull-right"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle"> </span>
                                <div class="chat-body clearfix">
                                  <div class="header"> <span class="name">Anton Durant</span><span class=" badge"><i class="fa fa-clock-o"></i>13 mins ago</span> </div>
                                  <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales. </p>
                                </div>
                              </li>
                              <li class="left clearfix"><span class="user-img pull-left"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle"> </span>
                                <div class="chat-body clearfix">
                                  <div class="header"> <span class="name">Spiderman</span> <span class="badge"><i class="fa fa-clock-o"></i>14 mins ago</span> </div>
                                  <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales. </p>
                                </div>
                              </li>
                              <li class="right clearfix"><span class="user-img pull-right"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle"> </span>
                                <div class="chat-body clearfix">
                                  <div class="header"> <span class="name">Spiderman</span> <span class="badge"><i class="fa fa-clock-o"></i>14 mins ago</span></div>
                                  <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales. </p>
                                </div>
                              </li>
                            </ul>
                          </div>
                          Chat-form
                          <div class="chat-message-form">
                            <div class="row">
                              <div class="col-md-12">
                                <textarea placeholder="Write Your Message Here" class="form-control margin-bottom" rows="2"></textarea>
                              </div>
                              <div class="col-md-8 col-sm-8 col-xs-8">
                                <div class="btn-group">
                                  <button class="btn btn-default tooltiped" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add Location"><i class="fa fa-location-arrow"></i></button>
                                  <button class="btn btn-default tooltiped" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add Photo"><i class="fa fa-camera"></i></button>
                                  <button class="btn btn-default tooltiped" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add Music"><i class="fa fa-music"></i></button>
                                  <button class="btn btn-default tooltiped" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add File"><i class="fa fa-file"></i></button>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-4">
                                <button class="btn btn-default pull-right" type="button">Chat!</button>
                              </div>
                            </div>
                          </div> -->
                          
                          <!-- /Chat-form --> 
                          
                        </div>
                      </div>
                      
                      <!--/Chat Tab-->
                      
                      <div class="social-buttons">
                        <!-- <ul class="social">
                          <li><a href="http://facebook.com/"><i class="entypo-facebook-circled"></i></a></li>
                          <li><a href="http://linkedin.com/"><i class="entypo-linkedin-circled"></i></a></li>
                          <li><a href="http://google.com/"><i class="entypo-gplus-circled"></i></a></li>
                          <li><a href="http://twitter.com/"><i class="entypo-twitter-circled"></i></a></li>
                          <li><a href="http://pinterest.com/"><i class="entypo-pinterest-circled"></i></a></li>
                          <li><a href="http://tumblr.com/"><i class="entypo-tumblr-circled"></i></a></li>
                          <li><a href="http://stumbleupon.com/"><i class="entypo-stumbleupon-circled"></i></a></li>
                          <li><a href="http://dribble.com/"><i class="entypo-dribbble-circled"></i></a></li>
                          <li><a href="http://vimeo.com/"><i class="entypo-vimeo-circled"></i></a></li>
                          <li><a href="http://mixi.com/"><i class="entypo-mixi"></i></a></li>
                          <li><a href="http://lastfm.com/"><i class="entypo-lastfm-circled"></i></a></li>
                          <li><a href="http://instagram.com/"><i class="entypo-instagram"></i></a></li>
                          <li><a href="http://vk.com/"><i class="entypo-vkontakte"></i></a></li>
                          <li><a href="http://flickr.com/"><i class="entypo-flickr-circled"></i></a></li>
                        </ul> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--/Profile--> 
            </div>
        </div>