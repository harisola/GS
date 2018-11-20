<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Interaction_recommended_by_centre_modal_oa extends CI_Controller {
	public function __construct(){
		parent::__construct();    
	}

	public function index()
	{	
		$this_career_id = $this->input->get(NULL, TRUE);
		if($this_career_id == false)
		{
		}else{

      $this->load->model('hcm/career_ic_allowed_model');
      $this->load->model('staff/staff_registered_model');
      $staff_data = array($this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id'))));
      $staff_ic_allowed = (array($this->career_ic_allowed_model->get_by(array('staff_id' => $staff_data[0][0]->id))));      


      $this->load->model('hcm/career_form_model');
      $this->load->model('hcm/career_form_uni_model');
      $this->load->model('hcm/career_form_emp_model');
      $this->load->model('hcm/career_form_interactions');
      $this->load->model('hcm/career_form_interaction_centre');
      $this->load->model('hcm/career_form_interaction_grade');
      $this->load->model('hcm/career_form_interaction_tags');


      $career_id = $this_career_id['career_id'];
      


      // **********************************************
      // Getting all the information from DB
      $interaction_centre = $this->career_form_interaction_centre->get();      
      $interaction_grade = $this->career_form_interaction_grade->get();
      $career_form = $this->career_form_model->get_by(array('id' => $career_id));
      $interaction_tags = $this->career_form_interaction_tags->get();
      $interaction_tags_count = $this->career_form_interaction_tags->getTagsCount();
      $interactions = $this->career_form_interactions->get();
      // **********************************************
      // **********************************************


      $modal_line_s1 = "";
      $modal_line_interaction_center = "";
      $modal_line_interaction = "";
      $modal_line_grade = "";
      $modal_line_comments = "";
      $modal_line_tags = "";
      $modal_line_6 = "";
      $modal_line_7 = "";
      $modal_line_8 = "";
      $modal_line_9 = "";
      $modal_line_10 = "";
      $modal_line_11 = "";
      $modal_line_12 = "";
      $modal_line_13 = "";
      $modal_line_14 = "";


      $modal_line_end = "";
      $modal_line_submit_button = "";

      $recommended_by_centre = $staff_ic_allowed[0][0]->interaction_centre_id;

      // **********************************************
      // Setting up Modal            
      /*$thisEmail = str_split($career_form[0]->email, 16);*/
      $thisEmail = explode("@", $career_form[0]->email);

      if(isset($thisEmail[0]) && isset($thisEmail[1])){
        $modal_line_s1 .= '
        <div class="dark-block bg-cold-grey text-yellow-muted pull-right">From No :<br>' . $career_form[0]->gc_id . '<br><br> Name :<br>'
        . $career_form[0]->name . '<br><br> Mobile Phone : <br>'
        . $career_form[0]->mobile_phone . '<br><br> Email : <br>'
        . $thisEmail[0] . '<br>@'
        . $thisEmail[1] . '<br><br><br><br>      
        </div>';
      }else{
        $modal_line_s1 .= '
        <div class="dark-block bg-cold-grey text-yellow-muted pull-right">From No :<br>' . $career_form[0]->gc_id . '<br><br> Name :<br>'
        . $career_form[0]->name . '<br><br> Mobile Phone : <br>'
        . $career_form[0]->mobile_phone . '<br><br>
        </div>';
      }


      // Interaction Center
      $modal_line_interaction_center .= '
      <form method="post" action="' . site_url() . '/hcm/interaction_centre_review_oa/add" class="orb-form">
        <input type="hidden" name="career_id" value="' . $career_id . '">
        <input type="hidden" name="recommended_by_centre" value="' . $recommended_by_centre . '">        
        <fieldset>
          <section>
            <label class="label">Select Interaction Centre</label>
            <label class="select">
              <select name="interaction_id">';
      foreach($interaction_centre as $center) {
        $modal_line_interaction_center .= '<option value="' . $center->id . '">' . $center->name . '</option>';
      }
      $modal_line_interaction_center .= '
              </select>
              <i></i>
            </label>
          </section></fieldset>';



      // Interaction
      $modal_line_interaction .= '<fieldset><section>
            <label class="label">Select Interaction</label>
            <label class="select">
              <select name="interaction_centre_id">';
      foreach($interactions as $interaction) {
        $modal_line_interaction .= '<option value="' . $interaction->id . '">' . $interaction->name . '</option>';
      }
      $modal_line_interaction .= '
              </select>
              <i></i>
            </label>
          </section></fieldset>';



      // Grade
      $modal_line_grade .= '<fieldset><section>
            <label class="label">Select Grade</label>
            <label class="select">
              <select name="grade_id">';
      foreach($interaction_grade as $grade) {
        $modal_line_grade .= '<option value="' . $grade->id . '">' . $grade->name . '</option>';
      }
      $modal_line_grade .= '
              </select>
              <i></i>
            </label>
          </section>
        </fieldset>';



      // Comments
      $modal_line_comments .= '<fieldset>
      <section>
        <label class="label">Comments</label>
        <label class="textarea">
          <textarea rows="3" name="forward_comments"></textarea>
        </label>
        <!--<div class="note"><strong>Note:</strong> height of the textarea depends on the rows attribute.</div>-->
      </section></fieldset>';



      // Tags
      $counter = 0;
      $listItems = round($interaction_tags_count/3)+1;
      $modal_line_tags .= '<fieldset><section>
            <label class="label">Tag</label>
            <div class="row">
              <div class="col col-4">';
      for($i=1; $i<=$listItems; $i++){
        if($counter < $interaction_tags_count){
          $modal_line_tags .= '<label class="checkbox"><input type="checkbox" name="tag[]" value="' . $interaction_tags[$counter]->name . '"><i></i>' . $interaction_tags[$counter]->name . '</label>';        
          $counter++;
        }
      }        
      $modal_line_tags .= '</div>
              <div class="col col-4">';
      for($i=1; $i<=$listItems; $i++){
        if($counter < $interaction_tags_count){
          $modal_line_tags .= '<label class="checkbox"><input type="checkbox" name="tag[]" value="' . $interaction_tags[$counter]->name . '"><i></i>' . $interaction_tags[$counter]->name . '</label>';
          $counter++;
        }
      }
      $modal_line_tags .= '</div>
              <div class="col col-4">';
      for($i=1; $i<=$listItems; $i++){
        if($counter < $interaction_tags_count){          
          $modal_line_tags .= '<label class="checkbox"><input type="checkbox" name="tag[]" value="' . $interaction_tags[$counter]->name . '"><i></i>' . $interaction_tags[$counter]->name . '</label>';
          $counter++;
        }
      }
      $modal_line_tags .= '</div>
            </div>
          </section></fieldset>';

      

      $modal_line_submit_button .= '<section><br><br>
      <div class="row">
        <div class="col col-1">
          <button type="submit" class="btn btn-primary btn-lg">Save
          </button>
        </div>
      </div>
      </section>';

      
      $modal_line_end .= '</form>';      


      echo $modal_line_s1
      . $modal_line_interaction_center
      . $modal_line_interaction      
      . $modal_line_grade
      . $modal_line_comments
      /*. $modal_line_tags */     
      . $modal_line_submit_button
      . $modal_line_end;
      

      

        /*<fieldset>
          <section>
            <label class="label">Interaction Centre</label>
            <label class="input">
              <input type="text">
            </label>
          </section>
          <section>
            <label class="label">File input</label>
            <label for="file" class="input input-file">
            <div class="button">
              <input type="file" id="file">
              Browse</div>
            <input type="text" readonly="">
            </label>
          </section>          
        </fieldset>

        <fieldset>
          <section>
            <label class="label">Select</label>
            <label class="select">
              <select>
                <option value="0">Choose name</option>
                <option value="1">Alexandra</option>
                <option value="2">Alice</option>
                <option value="3">Anastasia</option>
                <option value="4">Avelina</option>
              </select>
              <i></i> </label>
          </section>
          <section>
            <label class="label">Multiple select</label>
            <label class="select select-multiple">
              <select multiple="">
                <option value="1">Alexandra</option>
                <option value="2">Alice</option>
                <option value="3">Anastasia</option>
                <option value="4">Avelina</option>
                <option value="5">Basilia</option>
                <option value="6">Beatrice</option>
                <option value="7">Cassandra</option>
                <option value="8">Clemencia</option>
                <option value="9">Desiderata</option>
              </select>
            </label>
            <div class="note"><strong>Note:</strong> hold down the ctrl/cmd button to select multiple options.</div>
          </section>
        </fieldset>
        <fieldset>
          <section>
            <label class="label">Textarea</label>
            <label class="textarea">
              <textarea rows="3"></textarea>
            </label>
            <div class="note"><strong>Note:</strong> height of the textarea depends on the rows attribute.</div>
          </section>
          <section>
            <label class="label">Textarea resizable</label>
            <label class="textarea textarea-resizable">
              <textarea rows="3"></textarea>
            </label>
          </section>
          <section>
            <label class="label">Textarea expandable</label>
            <label class="textarea textarea-expandable">
              <textarea rows="3"></textarea>
            </label>
            <div class="note"><strong>Note:</strong> expands on focus.</div>
          </section>
        </fieldset>
        <fieldset>
          <section>
            <label class="label">Columned radios</label>
            <div class="row">
              <div class="col col-4">
                <label class="radio">
                  <input type="radio" name="radio" checked="">
                  <i></i>Alexandra</label>
                <label class="radio">
                  <input type="radio" name="radio">
                  <i></i>Alice</label>
                <label class="radio">
                  <input type="radio" name="radio">
                  <i></i>Anastasia</label>
              </div>
              <div class="col col-4">
                <label class="radio">
                  <input type="radio" name="radio">
                  <i></i>Avelina</label>
                <label class="radio">
                  <input type="radio" name="radio">
                  <i></i>Basilia</label>
                <label class="radio">
                  <input type="radio" name="radio">
                  <i></i>Beatrice</label>
              </div>
              <div class="col col-4">
                <label class="radio">
                  <input type="radio" name="radio">
                  <i></i>Cassandra</label>
                <label class="radio">
                  <input type="radio" name="radio">
                  <i></i>Clemencia</label>
                <label class="radio">
                  <input type="radio" name="radio">
                  <i></i>Desiderata</label>
              </div>
            </div>
          </section>
          <section>
            <label class="label">Inline radios</label>
            <div class="inline-group">
              <label class="radio">
                <input type="radio" name="radio-inline" checked="">
                <i></i>Alexandra</label>
              <label class="radio">
                <input type="radio" name="radio-inline">
                <i></i>Alice</label>
              <label class="radio">
                <input type="radio" name="radio-inline">
                <i></i>Anastasia</label>
              <label class="radio">
                <input type="radio" name="radio-inline">
                <i></i>Avelina</label>
              <label class="radio">
                <input type="radio" name="radio-inline">
                <i></i>Beatrice</label>
            </div>
          </section>
        </fieldset>
        <fieldset>
          <section>
            <label class="label">Columned checkboxes</label>
            <div class="row">
              <div class="col col-4">
                <label class="checkbox">
                  <input type="checkbox" name="checkbox" checked="">
                  <i></i>Alexandra</label>
                <label class="checkbox">
                  <input type="checkbox" name="checkbox">
                  <i></i>Alice</label>
                <label class="checkbox">
                  <input type="checkbox" name="checkbox">
                  <i></i>Anastasia</label>
              </div>
              <div class="col col-4">
                <label class="checkbox">
                  <input type="checkbox" name="checkbox">
                  <i></i>Avelina</label>
                <label class="checkbox">
                  <input type="checkbox" name="checkbox">
                  <i></i>Basilia</label>
                <label class="checkbox">
                  <input type="checkbox" name="checkbox">
                  <i></i>Beatrice</label>
              </div>
              <div class="col col-4">
                <label class="checkbox">
                  <input type="checkbox" name="checkbox">
                  <i></i>Cassandra</label>
                <label class="checkbox">
                  <input type="checkbox" name="checkbox">
                  <i></i>Clemencia</label>
                <label class="checkbox">
                  <input type="checkbox" name="checkbox">
                  <i></i>Desiderata</label>
              </div>
            </div>
          </section>
          <section>
            <label class="label">Inline checkboxes</label>
            <div class="inline-group">
              <label class="checkbox">
                <input type="checkbox" name="checkbox-inline" checked="">
                <i></i>Alexandra</label>
              <label class="checkbox">
                <input type="checkbox" name="checkbox-inline">
                <i></i>Alice</label>
              <label class="checkbox">
                <input type="checkbox" name="checkbox-inline">
                <i></i>Anastasia</label>
              <label class="checkbox">
                <input type="checkbox" name="checkbox-inline">
                <i></i>Avelina</label>
              <label class="checkbox">
                <input type="checkbox" name="checkbox-inline">
                <i></i>Beatrice</label>
            </div>
          </section>
        </fieldset>
        <fieldset>
          <div class="row">
            <section class="col col-5">
              <label class="label">Toggles based on radios</label>
              <label class="toggle">
                <input type="radio" name="radio-toggle" checked="">
                <i></i>Alexandra</label>
              <label class="toggle">
                <input type="radio" name="radio-toggle">
                <i></i>Anastasia</label>
              <label class="toggle">
                <input type="radio" name="radio-toggle">
                <i></i>Avelina</label>
            </section>
            <div class="col col-2"></div>
            <section class="col col-5">
              <label class="label">Toggles based on checkboxes</label>
              <label class="toggle">
                <input type="checkbox" name="checkbox-toggle" checked="">
                <i></i>Cassandra</label>
              <label class="toggle">
                <input type="checkbox" name="checkbox-toggle">
                <i></i>Clemencia</label>
              <label class="toggle">
                <input type="checkbox" name="checkbox-toggle">
                <i></i>Desiderata</label>
            </section>
          </div>
        </fieldset>
        <fieldset>
          <section>
            <label class="label">Ratings with different icons</label>
            <div class="rating">
              <input type="radio" name="stars-rating" id="stars-rating-5">
              <label for="stars-rating-5"><i class="fa fa-star"></i></label>
              <input type="radio" name="stars-rating" id="stars-rating-4">
              <label for="stars-rating-4"><i class="fa fa-star"></i></label>
              <input type="radio" name="stars-rating" id="stars-rating-3">
              <label for="stars-rating-3"><i class="fa fa-star"></i></label>
              <input type="radio" name="stars-rating" id="stars-rating-2">
              <label for="stars-rating-2"><i class="fa fa-star"></i></label>
              <input type="radio" name="stars-rating" id="stars-rating-1">
              <label for="stars-rating-1"><i class="fa fa-star"></i></label>
              Stars </div>
            <div class="rating">
              <input type="radio" name="trophies-rating" id="trophies-rating-7">
              <label for="trophies-rating-7"><i class="fa fa-trophy"></i></label>
              <input type="radio" name="trophies-rating" id="trophies-rating-6">
              <label for="trophies-rating-6"><i class="fa fa-trophy"></i></label>
              <input type="radio" name="trophies-rating" id="trophies-rating-5">
              <label for="trophies-rating-5"><i class="fa fa-trophy"></i></label>
              <input type="radio" name="trophies-rating" id="trophies-rating-4">
              <label for="trophies-rating-4"><i class="fa fa-trophy"></i></label>
              <input type="radio" name="trophies-rating" id="trophies-rating-3">
              <label for="trophies-rating-3"><i class="fa fa-trophy"></i></label>
              <input type="radio" name="trophies-rating" id="trophies-rating-2">
              <label for="trophies-rating-2"><i class="fa fa-trophy"></i></label>
              <input type="radio" name="trophies-rating" id="trophies-rating-1">
              <label for="trophies-rating-1"><i class="fa fa-trophy"></i></label>
              Trophies </div>
            <div class="rating">
              <input type="radio" name="asterisks-rating" id="asterisks-rating-10">
              <label for="asterisks-rating-10"><i class="fa fa-asterisk"></i></label>
              <input type="radio" name="asterisks-rating" id="asterisks-rating-9">
              <label for="asterisks-rating-9"><i class="fa fa-asterisk"></i></label>
              <input type="radio" name="asterisks-rating" id="asterisks-rating-8">
              <label for="asterisks-rating-8"><i class="fa fa-asterisk"></i></label>
              <input type="radio" name="asterisks-rating" id="asterisks-rating-7">
              <label for="asterisks-rating-7"><i class="fa fa-asterisk"></i></label>
              <input type="radio" name="asterisks-rating" id="asterisks-rating-6">
              <label for="asterisks-rating-6"><i class="fa fa-asterisk"></i></label>
              <input type="radio" name="asterisks-rating" id="asterisks-rating-5">
              <label for="asterisks-rating-5"><i class="fa fa-asterisk"></i></label>
              <input type="radio" name="asterisks-rating" id="asterisks-rating-4">
              <label for="asterisks-rating-4"><i class="fa fa-asterisk"></i></label>
              <input type="radio" name="asterisks-rating" id="asterisks-rating-3">
              <label for="asterisks-rating-3"><i class="fa fa-asterisk"></i></label>
              <input type="radio" name="asterisks-rating" id="asterisks-rating-2">
              <label for="asterisks-rating-2"><i class="fa fa-asterisk"></i></label>
              <input type="radio" name="asterisks-rating" id="asterisks-rating-1">
              <label for="asterisks-rating-1"><i class="fa fa-asterisk"></i></label>
              Asterisks </div>
            <div class="note"><strong>Note:</strong> you can use more than 300 vector icons for rating.</div>
          </section>
        </fieldset>
        <footer>
          <button type="submit" class="btn btn-default">Submit</button>
        </footer>
      </form>*/
		}
	}
}