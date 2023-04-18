<?php 
class Admin extends MY_controller
{

    public function register()
{
 
    $this->load->view('admin/register');
}

public function registeruser()
{
    $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
    if($this->form_validation->run('register_rules'))
    {
        $post= $this->input->post();
        // echo "<pre>";
        // print_r($post);
        // exit;
        
        $this->load->model('Loginmodel');
        if($this->Loginmodel->add_user($post)){
            $this->session->set_flashdata('msg','Account created Successfully!!!.');
            $this->session->set_flashdata('msg_class','alert-success');
        }
    }else
    {
        // $this->session->set_flashdata('msg','Could not Register, Please try again.');
        // $this->session->set_flashdata('msg_class','alert-danger');
        $this->load->view('Admin/register');
    }
    $this->load->view('admin/login');
    }


    public function login(){
        
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

        if($this->form_validation->run('login_rules'))
        {
            $uname = $this->input->post('uname');
            $pass = $this->input->post('pass');
            $this->load->model('loginmodel');
            $login_id=$this->loginmodel->isvalidate($uname,$pass);

            if($login_id)
           {

            // $this->load->library('session');
            $this->session->set_userdata('id',$login_id);
            return redirect('index.php/Admin/home');

           }
           else
           {
            $this->session->set_flashdata('msg','Invalid Username/Password.');
            $this->session->set_flashdata('msg_class','alert-danger');
            // $this->session->set_flashdata('Login_failed','Invalid Username/Password.');
            return redirect('index.php/Admin/login');
           }
        }else{
            $this->load->view('Admin/login');

        }

        
    }

    public function logout(){
        $this->session->unset_userdata('id');

            return redirect('index.php/admin/login');
    }


    public function home(){
        $this->load->view('admin/home');
    }


    
    public function welcome()
        {
            if(! $this->session->userdata('id') ){
             return redirect('index.php/admin/login');
            }else{
            $this->load->model('loginmodel');
            $config=[
                'base_url'=>base_url('index.php/admin/welcome'),
                'per_page'=>3,
                'total_rows'=> $this->loginmodel->num_rows(),
                'full_tag_open'=>'<ul class="pagination">',
                'full_tag_close'=>'</ul>',
                'next_tag_open' => '<li>',
                'next_tag_close' => '</li>',
                'prev_tag_open' => '<li>',
                'prev_tag_close' => '</li>',
                'num_tag_open' => '<li>',
                'num_tag_close' => '</li>',
                'cur_tag_open' => '<li class="active"><a>',
                'cur_tag_close' => '</a></li>',
            ];

            $this->pagination->initialize($config);

            $articles=$this->loginmodel->articlelist($config['per_page'],$this->uri->segment(3));
            $this->load->view('admin/dashboard',['articles'=>$articles]);
        }
    }



public function uservalidation(){
    $config=[
        'upload_path'=>'./upload/',
        'allowed_types'=>'gif|jpg|png|jpeg',
    ];

    $this->load->library('upload',$config);
    $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
    if($this->form_validation->run('add_article_rules') && $this->upload->do_upload())
    {
        $post= $this->input->post();
        $data= $this->upload->data();
        // echo "<pre>";
        // print_r($data);
        $image_path= base_url("upload/".$data['raw_name'].$data['file_ext']);
        $post['image_article']=$image_path;
        $this->load->model('Loginmodel');
        if($this->Loginmodel->add_articles($post))
        {
            $this->session->set_flashdata('msg','Data Entered Successfully!!!.');
            $this->session->set_flashdata('msg_class','alert-success');
        }else{
            $this->session->set_flashdata('msg','Could not Enter the data.');
            $this->session->set_flashdata('msg_class','alert-danger');
            // $this->load->view('admin/add_article');
        }
        return redirect('index.php/Admin/welcome');

    }else{
        $upload_error=$this->upload->display_errors();
        $this->load->view('admin/add_article',compact('upload_error'));
    }
}

public function addarticle(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
                }else{
    $this->load->view('admin/add_article');
}}

public function editarticles($id){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
                }else{
                    $config=[
                        'upload_path'=>'./upload/',
                        'allowed_types'=>'gif|jpg|png|jpeg',
                    ];          
 
    $this->load->model('Loginmodel');
    $articles=$this->Loginmodel->find_articles($id);

    if($this->input->post()){
        $this->load->library('upload',$config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        if($this->form_validation->run('add_article_rules') && $this->upload->do_upload())
        {
            $post= $this->input->post(); 
            $data= $this->upload->data();
            $image_path= base_url("upload/".$data['raw_name'].$data['file_ext']);
            print_r($image_path);
            $post['image_article']=$image_path; 
            if($this->Loginmodel->update_articles($id,$post))
            {
                $this->session->set_flashdata('msg','Data Updated Successfully!!!.');
                $this->session->set_flashdata('msg_class','alert-success');
            }else{
                $this->session->set_flashdata('msg','Could not Update data.');
                $this->session->set_flashdata('msg_class','alert-danger');
                // $this->load->view('admin/add_article');
            }
            return redirect('index.php/Admin/welcome');
        }
    }
    
    $this->load->view('admin/edit_article',['articles'=>$articles]);
}}


public function delarticles($id){
    
    if(! $this->session->userdata('id')){

        return redirect('index.php/admin/login');
        // die();
    

    }else{
    $id=$this->input->post('id');
    $this->load->model('Loginmodel'); 
    if($this->Loginmodel->del_articles($id))
    {
        $this->session->set_flashdata('msg','Deleted Successfully!!!.');
        $this->session->set_flashdata('msg_class','alert-success');
    }else{
        $this->session->set_flashdata('msg','Could not Delete, Please try again.');
        $this->session->set_flashdata('msg_class','alert-danger');
  
    }
    return redirect('index.php/Admin/welcome');    
    }}


  
public function customer(){

    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
    }else{
        $this->load->model('loginmodel');
        $config=[
                'base_url'=>base_url('index.php/admin/customer'),
                'per_page'=>3,
                'total_rows'=> $this->loginmodel->user_num_rows(),
                'full_tag_open'=>'<ul class="pagination">',
                'full_tag_close'=>'</ul>',
                'next_tag_open' => '<li>',
                'next_tag_close' => '</li>',
                'prev_tag_open' => '<li>',
                'prev_tag_close' => '</li>',
                'num_tag_open' => '<li>',
                'num_tag_close' => '</li>',
                'cur_tag_open' => '<li class="active"><a>',
                'cur_tag_close' => '</a></li>',
                ];
        
                $this->pagination->initialize($config);
                $users=$this->loginmodel->customerlist($config['per_page'],$this->uri->segment(3));
                $this->load->view('admin/customer',['users'=>$users]);
    }
}

public function addcustomer(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
                }else{
    $this->load->view('admin/add_user');
}}

public function registercustomer(){
    
        $config=[
            'upload_path'=>'./upload/',
            'allowed_types'=>'gif|jpg|png|jpeg',
        ];
    
        $this->load->library('upload',$config);
    $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
    if($this->form_validation->run('register_rules') && $this->upload->do_upload())
    {
        $post= $this->input->post();
        $data= $this->upload->data();
        // echo "<pre>";
        // print_r($data);
        $image_path= base_url("upload/".$data['raw_name'].$data['file_ext']);
        // print_r($image_path);
        // exit;
        $post['image_user']=$image_path;
    
        $this->load->model('Loginmodel');
        if($this->Loginmodel->add_user($post)){
            $this->session->set_flashdata('msg','Account created Successfully!!!.');
            $this->session->set_flashdata('msg_class','alert-success');
        }else{
            $this->session->set_flashdata('msg','Could not Enter the data.');
            $this->session->set_flashdata('msg_class','alert-danger');
            // $this->load->view('admin/add_article');
        }
        return redirect('index.php/Admin/customer');

    }else{
        $upload_error=$this->upload->display_errors();
        $this->load->view('admin/add_user',compact('upload_error'));
    }
}


public function deluser($id){
    if(! $this->session->userdata('id')){

        return redirect('index.php/admin/login');
        // die();
    

    }else{
    // $id= $this->input->post('id');
    $this->load->model('Loginmodel');
    if($this->Loginmodel->del_user($id))
    {
        $this->session->set_flashdata('msg','Deleted Successfully!!!.');
        $this->session->set_flashdata('msg_class','alert-success');
    }else{
        $this->session->set_flashdata('msg','Could not Delete, Please try again.');
        $this->session->set_flashdata('msg_class','alert-danger');
        // $this->load->view('admin/add_article');
    }
        return redirect('index.php/Admin/customer');
}}

public function edituser($id){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
                }else{
                    $config=[
                        'upload_path'=>'./upload/',
                        'allowed_types'=>'gif|jpg|png|jpeg',
                    ];          
 
    $this->load->model('Loginmodel');
    $users=$this->Loginmodel->find_user($id);

    if($this->input->post()){
        $this->load->library('upload',$config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        $this->form_validation->set_rules('username','username','required|alpha_numeric_spaces');
        $this->form_validation->set_rules('firstname','firstname','required|alpha_numeric_spaces');
        $this->form_validation->set_rules('lastname','lastname','required|alpha_numeric_spaces');
        $this->form_validation->set_rules('pno','pno','required|regex_match[/^[6-9][0-9]{9}$/]');
        // $u =$this->upload->do_upload();
        if($this->form_validation->run() && $this->upload->do_upload())
        {
            $post= $this->input->post(); 
            $data= $this->upload->data();
            $image_path= base_url("upload/".$data['raw_name'].$data['file_ext']);
            $post['image_user']=$image_path; 
            if($this->Loginmodel->update_user($id,$post))
            {
                $this->session->set_flashdata('msg','Data Updated Successfully!!!.');
                $this->session->set_flashdata('msg_class','alert-success');
            }else{
                $this->session->set_flashdata('msg','Could not Update data.');
                $this->session->set_flashdata('msg_class','alert-danger');
                // $this->load->view('admin/add_article');
            }
            return redirect('index.php/Admin/customer');
        }
    }
    // $upload_error=$this->upload->display_errors();
    $this->load->view('admin/edit_user',['users'=>$users]);
}}

public function asc(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
    }
    else
    {
        $this->load->model('Loginmodel');
        $config=[
            'base_url'=>base_url('index.php/admin/asc'),
            'per_page'=>3,
            'total_rows'=> $this->Loginmodel->user_num_rows(),
            'full_tag_open'=>'<ul class="pagination">',
            'full_tag_close'=>'</ul>',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'cur_tag_open' => '<li class="active"><a>',
            'cur_tag_close' => '</a></li>',
        ];

        $this->pagination->initialize($config);
        $users=$this->Loginmodel->asc_order($config['per_page'],$this->uri->segment(3));
        $this->load->view('admin/customer',['users'=>$users]);
    }
}

public function desc(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
    }
    else
    {
        $this->load->model('Loginmodel');
        $config=[
            'base_url'=>base_url('index.php/admin/desc'),
            'per_page'=>3,
            'total_rows'=> $this->Loginmodel->user_num_rows(),
            'full_tag_open'=>'<ul class="pagination">',
            'full_tag_close'=>'</ul>',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'cur_tag_open' => '<li class="active"><a>',
            'cur_tag_close' => '</a></li>',
        ];

        $this->pagination->initialize($config);
        $users=$this->Loginmodel->desc_order($config['per_page'],$this->uri->segment(3));

        $this->load->view('admin/customer',['users'=>$users]);

    }
}

public function searchkeyword(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
    }
    else
    {
    $keyword = $this->input->post('keyword');
    $data=array();
    $this->load->model('Loginmodel');
    $data['users']= $this->Loginmodel->search_username($keyword);
    $this->load->view('admin/customer',$data);
}}
public function searchidkeyword(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
    }
    else
    {
    $keyword = $this->input->post('keyword');
    $data=array();
    $this->load->model('Loginmodel');
    $data['users']= $this->Loginmodel->search_userid($keyword);
    $this->load->view('admin/customer',$data);
}}
public function searchmailkeyword(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
    }
    else
    {
    $keyword = $this->input->post('keyword');
    $data=array();
    $this->load->model('Loginmodel');
    $data['users']= $this->Loginmodel->search_usermail($keyword);
    $this->load->view('admin/customer',$data);
}}
public function searchcontactkeyword(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
    }
    else
    {
    $keyword = $this->input->post('keyword');
    $data=array();
    $this->load->model('Loginmodel');
    $data['users']= $this->Loginmodel->search_usercontact($keyword);
    $this->load->view('admin/customer',$data);
}}

public function arasc(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
    }
    else
    {
        $this->load->model('Loginmodel');
        $config=[
            'base_url'=>base_url('index.php/admin/arasc'),
            'per_page'=>3,
            'total_rows'=> $this->Loginmodel->num_rows(),
            'full_tag_open'=>'<ul class="pagination">',
            'full_tag_close'=>'</ul>',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'cur_tag_open' => '<li class="active"><a>',
            'cur_tag_close' => '</a></li>',
        ];

        $this->pagination->initialize($config);
        $articles=$this->Loginmodel->ar_asc_order($config['per_page'],$this->uri->segment(3));
        $this->load->view('admin/dashboard',['articles'=>$articles]);
    }
}

public function ardesc(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
    }
    else
    {
        $this->load->model('Loginmodel');
        $config=[
            'base_url'=>base_url('index.php/admin/ardesc'),
            'per_page'=>3,
            'total_rows'=> $this->Loginmodel->num_rows(),
            'full_tag_open'=>'<ul class="pagination">',
            'full_tag_close'=>'</ul>',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'cur_tag_open' => '<li class="active"><a>',
            'cur_tag_close' => '</a></li>',
        ];

        $this->pagination->initialize($config);
        $articles=$this->Loginmodel->ar_desc_order($config['per_page'],$this->uri->segment(3));

        $this->load->view('admin/dashboard',['articles'=>$articles]);

    }
}

public function artsearchkeyword(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
    }
    else
    {
    $keyword = $this->input->post('keyword');
    $data=array();
    $this->load->model('Loginmodel');
    $data['articles']= $this->Loginmodel->search_article($keyword);
    $this->load->view('admin/dashboard',$data);
}}

public function userstatus(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
    }
    else
    {
        $id=$this->input->post('id');
        $post = $this->input->post();
        $this->load->model('Loginmodel');
        $state=$this->Loginmodel->user_status($id,$post);
        if($state)
        {
        $this->session->set_flashdata('msg','Status Updated Successfully!!!.');
        $this->session->set_flashdata('msg_class','alert-success');
    }else{
        $this->session->set_flashdata('msg','Could not Update Status.');
        $this->session->set_flashdata('msg_class','alert-danger');
        // $this->load->view('admin/add_article');
    }
    
    return redirect('index.php/admin/customer');
}}

public function statusOption(){
    if(! $this->session->userdata('id') ){
        return redirect('index.php/admin/login');
    }
    else
    {
        $filter = $this->input->post('filter');
        $data=array();
        $this->load->model('Loginmodel');
        $data['users']= $this->Loginmodel->filter_user($filter);
        $this->load->view('admin/customer',$data);
}}

}

?>