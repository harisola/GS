<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_rights_model extends MY_Model{

	function get_rights($table = 'dyn_menu', $menuOrder = 1)
	{        
		$menu = array();
        $userid = (int)$this->session->userdata('user_id');
        
        $this->db->select($table . '.id as id, '. $table . '.title as title, '. $table . '.link_type as link_type, '.$table . '.page_id as page_id, '.$table . '.module_name as module_name, '
                            .$table . '.url as url, '.$table . '.uri as uri, '.$table . '.position as position, '.$table . '.target as target, '.$table . '.parent_id as parent_id, '
                            .$table . '.dyn_group_id as dyn_group_id, '
                            .$table . '.page_header_big_words as page_header_big_words, '
                            .$table . '.page_header_small_words as page_header_small_words, '
                            . 'group_crud.can_create as can_create, group_crud.can_read as can_read, group_crud.can_update as can_update, group_crud.can_delete as can_delete, group_crud.can_approve as can_approve, group_crud.can_print as can_print, group_crud.can_export as can_export, '
                            .$table . '.is_parent as is_parent, group_crud.menu_visible as show_menu, '.$table . '.dtitle as dtitle, '.$table . '.font_class as font_class, '.$table . '.font_icon as font_icon');

        $this->db->from($table);
        $this->db->join('group_crud', 'group_crud.menu_id = ' . $table . '.id');
        $this->db->join('users_groups', 'users_groups.group_id = group_crud.group_id', 'left');
        $this->db->where($table . '.dyn_group_id',$menuOrder);
        $this->db->where('users_groups.user_id', $userid);
        $this->db->group_by($table . '.id');
        $this->db->order_by($table . '.position','asc');
        $this->db->order_by($table . '.title','asc');
        
        $query = $this->db->get();
        

        if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`
            // font_class, font_icon
            $pos = 1;
            foreach ($query->result() as $row)
            {                   
                $menu[$pos]['id']         = $row->id;
                $menu[$pos]['title']      = $row->dtitle;
                $menu[$pos]['link']       = $row->link_type;
                $menu[$pos]['page']       = $row->page_id;
                $menu[$pos]['module']     = $row->module_name;
                $menu[$pos]['url']        = $row->url;
                $menu[$pos]['uri']        = $row->uri;
                $menu[$pos]['dyn_group']  = $row->dyn_group_id;
                $menu[$pos]['position']   = $row->position;
                $menu[$pos]['target']     = $row->target;
                $menu[$pos]['parent']     = $row->parent_id;
                $menu[$pos]['is_parent']  = $row->is_parent;
                $menu[$pos]['show']       = $row->show_menu;
                $menu[$pos]['font_class'] = $row->font_class;
                $menu[$pos]['font_icon']  = $row->font_icon;

                $menu[$pos]['can_create'] = $row->can_create;
                $menu[$pos]['can_read'] = $row->can_read;
                $menu[$pos]['can_update'] = $row->can_update;
                $menu[$pos]['can_delete'] = $row->can_delete;
                $menu[$pos]['can_approve'] = $row->can_approve;
                $menu[$pos]['can_print'] = $row->can_print;
                $menu[$pos]['can_export'] = $row->can_export;

                $menu[$pos]['page_header_big_words'] = $row->page_header_big_words;
                $menu[$pos]['page_header_small_words'] = $row->page_header_small_words;


                $pos += 1;
            }
        }
        $query->free_result();    // The $query result object will no longer be available
        return $menu;
	}
}