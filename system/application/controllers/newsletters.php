<?php

class Newsletters extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('companies_model');
        $this->load->model('users_model');
        $this->load->model('Gallery_model');
        $this->load->model('newsletter_model');
        $this->is_logged_in();
    }

    function index() {
        $data['userlevel'] = $this->session->userdata('user_level');
        $data['users'] = $this->users_model->list_users();
        $data['companies'] = $this->companies_model->list_companies();
        $data['newsletters'] = $this->newsletter_model->list_newsletters();
        $data['main'] = '/user/logged_in_area';

        $data['body'] = '/newsletters/main';
        $this->load->vars($data);
        $this->load->view('main_template');
    }

    function edit($id) {
        $data['userlevel'] = $this->session->userdata('user_level');
        $data['users'] = $this->users_model->list_users();
        $data['companies'] = $this->companies_model->list_companies();
        $data['newsletter'] = $this->newsletter_model->get_newsletter($id);
        foreach ($data['newsletter'] as $row):
            $data['company_id'] = $row->company_id;
            $data['title'] = $row->newsletter_title;
            $data['newsletter_date'] = $row->newsletter_date;
            $data['filename'] = $row->filename;
            $data['content'] = $row->content;
            $data['newsletter_id'] = $row->newsletter_id;
        endforeach;

        //convert date to human readable
        $datestring = " %d/%m/%Y ";
        $time = $data['newsletter_date'];
        $data['humandate'] = mdate($datestring, $time);


        $data['main'] = '/user/logged_in_area';

        $data['body'] = '/newsletters/edit';
        $this->load->vars($data);
        $this->load->view('main_template');
    }

    function update_newsletter() {
        $this->form_validation->set_rules('title', 'title', 'trim');
        
        if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
            echo "validation error";
        } else { // passed validation proceed to post success logic
            
            $id = $this->uri->segment(3);
            $this->newsletter_model->edit_newsletter($id);


            $this->upload_image($id);


            redirect("newsletters");
        }
    }

    function submit_newsletter() {
        $this->form_validation->set_rules('title', 'Title', 'trim|max_length[255]|required');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
            echo "validation error";
        } else { // passed validation proceed to post success logic
            if ($this->newsletter_model->add_newsletter()) { // the information has therefore been successfully saved in the db
//now process the image
// run insert model to write data to db
//upload file
//retrieve uploaded file
                $this->upload_image();





                redirect('/newsletters');   // or whatever logic needs to occur
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        }
    }

    function upload_image($id = 0) {

        $this->Gallery_model->do_newsletter_upload();

        $bucket = "laworldnewsletters";

        if (!empty($_FILES) && $_FILES['file']['error'] != 4) {

            $fileName = $_FILES['file']['name'];
            $tmpName = $_FILES['file']['tmp_name'];
            $filelocation = $fileName;

            $thefile = file_get_contents($tmpName, true);

            //add filename into database
            //get blog id
            if ($id == 0) {
                $blog_id = mysql_insert_id();
            } else {
                $blog_id = $id;
            }
            $this->newsletter_model->add_file($fileName, $blog_id);
            //move the file

            if ($this->s3->putObject($thefile, $bucket, $filelocation, S3:: ACL_PUBLIC_READ)) {
                //echo "We successfully uploaded your file.";
                $this->session->set_flashdata('message', 'Newsletter Added and file uploaded successfully');
            } else {
                //echo "Something went wrong while uploading your file... sorry.";
                $this->session->set_flashdata('message', 'Newsletter Added, but your file did not upload');
            }


//delete files from server
            $this->gallery_path = "./images/temp";
            $mydir = $this->gallery_path . '/';

            $d = dir($mydir);
            while ($entry = $d->read()) {
                if ($entry != "." && $entry != "..") {
                    unlink($mydir . $entry);
                }
            }
            $d->close();
        } else {

            $this->session->set_flashdata('message', 'News Added');
        }
    }

    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            $this->session->set_flashdata('conf_msg', "You need to log in");
            redirect('user/login');
        }
    }

}