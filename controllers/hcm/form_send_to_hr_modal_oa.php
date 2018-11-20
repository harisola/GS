<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Form_send_to_hr_modal_oa extends CI_Controller {
	public function __construct(){
		parent::__construct();
    $this->load->model('hcm/career_form_model');
    $this->load->model('hcm/career_form_uni_model');
    $this->load->model('hcm/career_form_emp_model');
    $this->load->model('hcm/career_form_interactions');
    $this->load->model('hcm/career_form_interaction_centre');
    $this->load->model('hcm/career_form_interaction_grade');
    $this->load->model('hcm/career_form_interaction_tags');  
	}

	public function index()
	{	
		$this_career_id = $this->input->get(NULL, TRUE);
		if($this_career_id == false)
		{
		}else{
      $career_id = $this_career_id['career_id'];
      


      // **********************************************
      // Getting all the information from DB
      $interaction_centre = $this->career_form_interaction_centre->get();      
      $interaction_grade = $this->career_form_interaction_grade->get();
      $career_form = $this->career_form_model->get_by(array('id' => $career_id));
      $interaction_tags = $this->career_form_interaction_tags->get();
      $interaction_tags_count = $this->career_form_interaction_tags->getTagsCount();
      $interactions = $this->career_form_interactions->get();
      $recommended_interaction_centre = $this->career_form_model->getStage2HRFormData_GCID($career_id);
      // **********************************************
      // **********************************************
            
      $modal_line_s1 = "";
      $modal_line_interaction_center = "";
      $modal_line_submit_button = "";
      $modal_line_end = "";


      // **********************************************
      // Setting up Modal            
      $thisEmail = explode("@", $career_form[0]->email);

      $modal_line_s1 .= '
      <div class="dark-block bg-cold-grey text-yellow-muted pull-right">From No :<br>' . $career_form[0]->gc_id . '<br><br> Name :<br>'
      . $career_form[0]->name . '
      </div>';


      // Interaction Center
      $modal_line_interaction_center .= '
      <form method="post" action="' . site_url() . '/hcm/interaction_centre_review_oa/add2" class="orb-form">
        <input type="hidden" name="career_id" value="' . $career_id . '">
        <input type="hidden" name="interaction_centre_id" value="0">
        <div class="row">
          <div class="col col-4">
            <div class="Send Form?">
              <p class="lead">Yes! send form back to HR.</p>
            </div>
          </div>
        </div>';

      $modal_line_submit_button .= '<section>
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