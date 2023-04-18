<?php 

class Loginmodel extends CI_MODEL
{
    public function isvalidate($username,$password)
    {
       $q= $this->db->where(['username'=>$username,'pass'=>$password])
                    ->get('user');      
       

                    if($q->num_rows())
                    {
                        return $q->row()->id;
                    }else{
                        return false;
                    }
    }


    public function articlelist($limit,$offset)
    {
        $id=$this->session->userdata('id');
        $q=$this->db->select('article_title,id,article_body,user_id,image_article')
                    ->from('articles')
                    ->where('user_id',$id)
                    ->limit($limit,$offset)
                    ->get();       
                    return $q->result();
    }

    public function num_rows()
    {
        $id=$this->session->userdata('id');
        $q=$this->db->select('article_title,id,article_body,user_id')
                    ->from('articles')
                    ->where('user_id',$id)
                    ->get();       
                    return $q->num_rows();
    }

    public function add_user($array)
    {
        $insert= $this->db->insert('user',$array);
        return $insert;
    }

    
    public function add_articles($array)
    {
        return $this->db->insert('articles',$array);
    }

    public function del_articles($id){
        return $this->db->delete('articles',['id'=>$id]);
    }

    public function find_articles($articleid){
        $q=$this->db->Select()
                    ->where('id',$articleid)
                    ->get('articles');
                    return $q->row();
                    
    }

    public function update_articles($articleid,$article){

        
        $update = $this->db->where('id',$articleid)
                        ->update('articles',$article);

        return $update;
    }

    public function customerlist($limit,$offset){
        $q= $this->db->order_by('id','asc')
        ->limit($limit,$offset)
        ->select('id,username,email,pno,image_user,status,remarks')
        ->get('user')
        ->result_array();  
        return $q;
        
    }

    public function user_num_rows()
    {
        $q=$this->db->order_by('id','asc')
                    ->get('user');
                    return $q->num_rows();
    }

    public function del_user($id){
        return $this->db->delete('user',['id'=>$id]);
    }

    public function find_user($userid){
        $q=$this->db->Select()
        ->where('id',$userid)
        ->get('user');
        return $q->row();
    }

    public function update_user($userid,$user){
       
        $update = $this->db->where('id',$userid)
                           ->update('user',$user);

        return $update;
    }


    public function asc_order($limit,$offset){
        $q= $this->db->order_by('username','asc')
        ->limit($limit,$offset)
        ->select('id,username,email,pno,image_user,status,remarks')
        ->get('user')
        ->result_array();  
        return $q;
    }

    public function desc_order($limit,$offset){
        $q= $this->db->order_by('username','desc')
        ->limit($limit,$offset)
        ->select('id,username,email,pno,image_user,status,remarks')
        ->get('user')
        ->result_array();  
        return $q;
    }

    public function search_username($keyword){
    
        $q = $this->db->select()
                      ->from('user')
                      ->like('username',$keyword)
                      ->get();
                      return $q->result_array();

    }
    public function search_userid($keyword){

        
        $q = $this->db->select()
                      ->from('user')
                      ->like('id',$keyword)
                      ->get();
                      return $q->result_array();

    }
    public function search_usermail($keyword){
  
        $q = $this->db->select()
                      ->from('user')
                      ->like('email',$keyword)
                      ->get();
                      return $q->result_array();

    }
    public function search_usercontact($keyword){
              
        $q = $this->db->select()
                      ->from('user')
                      ->like('pno',$keyword)
                      ->get();
                      return $q->result_array();

    }


    public function ar_asc_order($limit,$offset){
        $id=$this->session->userdata('id');
        $q=$this->db->select('article_title,id,article_body,user_id,image_article')
                    ->order_by('article_title','asc')
                    ->from('articles')
                    ->where('user_id',$id)
                    ->limit($limit,$offset)
                    ->get();       
                    return $q->result();
    }

    public function ar_desc_order($limit,$offset){
        $id=$this->session->userdata('id');
        $q=$this->db->select('article_title,id,article_body,user_id,image_article')
                    ->order_by('article_title','desc')
                    ->from('articles')
                    ->where('user_id',$id)
                    ->limit($limit,$offset)
                    ->get();       
                    return $q->result();
    }

    public function search_article($keyword){
            // $this->db->select();
        
            $q = $this->db->select()
                          ->from('articles')
                          ->like('id',$keyword)
                          ->or_like('article_title',$keyword)
                          ->get();
            return $q->result();

    }

    public function user_status($userid,$userstatus){
        
        $q = $this->db->where('id',$userid)
                      ->update('user',$userstatus);
        if($q){
            echo "1";
        }
        else{
            echo "0";
        }
    }

    public function filter_user($filter){
      
        $q = $this->db->select()
                      ->from('user')
                      ->where('status',$filter)
                      ->get();
        return $q->result_array();
    }

}

?>