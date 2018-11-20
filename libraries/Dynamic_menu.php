<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Dynamic_menu {

    private $ci;                // for CodeIgniter Super Global Reference.
    
    // for menu_b3
    // private $id_menu        = 'class="collapse navbar-collapse" id="navbar-collapse-1"'; 
    private $id_menu        = 'class="navbar-collapse collapse" id="defaultmenu"';
    private $class_menu     = 'class="nav navbar-nav"';
    private $class_parent   = 'class="dropdown-toggle" data-toggle="dropdown"';    
    private $class_mainmenu = 'class="dropdown"';
    private $class_menuhead = 'class="dropdown-menu"';
    private $class_menumore = 'class="dropdown-submenu"';       
    

    // --------------------------------------------------------------------

    /**
     * PHP5        Constructor
     *
     */
    function __construct()
    {
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
    }

    // --------------------------------------------------------------------

    /**
     * build_menu($table, $type)
     *
     * Description:
     *
     * builds the Dynaminc dropdown menu
     * $table allows for passing in a MySQL table name for different menu tables.
     * $type is for the type of menu to display ie; topmenu, mainmenu, sidebar menu
     * or a footer menu.
     *
     * @param    string    the MySQL database table name.
     * @param    string    the type of menu to display.
     * @return    string    $html_out using CodeIgniter achor tags.
     */
    function build_menu($table = 'dyn_menu', $menuOrder = 1)
    {
        $menu = array();
        $userid = (int)$this->ci->session->userdata('user_id');
        // use active record database to get the menu.
        /*SELECT * FROM (`DYN_MENU`)
         JOIN `GROUP_CRUD` ON `GROUP_CRUD`.`MENU_ID` = `DYN_MENU`.`ID`
         JOIN `USERS_GROUPS` ON `USERS_GROUPS`.`GROUP_ID` = `GROUP_CRUD`.`GROUP_ID`
         WHERE `DYN_MENU`.`DYN_GROUP_ID` = 1
         AND USERS_GROUPS.USER_ID = 1
         group by Dyn_menu.id
         ORDER BY `DYN_MENU`.`id` ASC
         */
        $this->word_num = 1;
        $this->ci->db->select($table . '.id as id, '. $table . '.title as title, '. $table . '.link_type as link_type, '.$table . '.page_id as page_id, '.$table . '.module_name as module_name, '
                            .$table . '.url as url, '.$table . '.uri as uri, '.$table . '.position as position, '.$table . '.target as target, '.$table . '.parent_id as parent_id, '
                            .$table . '.dyn_group_id as dyn_group_id, '
                            .$table . '.is_parent as is_parent, group_crud.menu_visible as show_menu, '.$table . '.dtitle as dtitle, '.$table . '.font_class as font_class, '.$table . '.font_icon as font_icon');

        $this->ci->db->from($table);
        $this->ci->db->join('group_crud', 'group_crud.menu_id = ' . $table . '.id');
        $this->ci->db->join('users_groups', 'users_groups.group_id = group_crud.group_id', 'left');
        $this->ci->db->where($table . '.dyn_group_id',$menuOrder);
        $this->ci->db->where('users_groups.user_id', $userid);
        $this->ci->db->group_by($table . '.id');
        $this->ci->db->order_by($table . '.position','asc');
        $this->ci->db->order_by($table . '.title','asc');
        
        $query = $this->ci->db->get();
        

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

                $pos += 1;
            }
        }
        $query->free_result();    // The $query result object will no longer be available
        //var_dump($menu);

        // initial header, setting nav bar    
        $html_out = "";    
        //$html_out  = "\t".'<div '.$this->id_menu.'>'."\n";
        //$html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";

        // loop for checking all the main menus
        for ($i = 1; $i <= count($menu); $i++)
        {
            if($menu[$i]['show'] && $menu[$i]['parent'] == 0)
            {                
                if (is_array($menu[$i]))    // must be by construction but let's keep the errors home
                {                    
                    if($menu[$i]['is_parent'] == TRUE)
                    {
                        $html_out .= "\t\t\t".'<li '.$this->class_mainmenu.'>'.anchor('#', '<span class="'.$menu[$i]['font_class'].' '.$menu[$i]['font_icon'].'"> '.$menu[$i]['title'].' <i class="fa fa-angle-down"></i></span>',$this->class_parent);                        
                    }
                    else
                    {                       
                        $html_out .= "\t\t\t\t".'<li ' .$this->class_mainmenu.'>'.anchor($menu[$i]['url'], '<span class="'.$menu[$i]['font_class'].' '.$menu[$i]['font_icon'].'"> '.$menu[$i]['title'].' <i class="fa fa-angle-down"></i></span>',$this->class_parent);                        
                    }

                    // loop through and build all the child submenus.                    
                    $html_out .= $this->get_childs($menu, $i);
                    $html_out .= '</li>'."\n";                    
                }
                else
                {
                    exit (sprintf('menu nr %s must be an array', $i));
                }
            }            
        }
        //$html_out .= "\t\t".'</ul>' . "\n";           

        return $html_out;
    }


    function get_childs($menu, $parent_menu_pos)
    {
        $has_subcats = FALSE;
        $html_out  = '';        
        $html_out .= "\t\t\t\t\t".'<ul '.$this->class_menuhead.'>'."\n";

        for ($i = 1; $i <= count($menu); $i++)
        {
            if ($menu[$i]['show'] && $menu[$i]['parent'] == $menu[$parent_menu_pos]['id'])    // are we allowed to see this menu?
            {
                $has_subcats = TRUE;

                if ($menu[$i]['is_parent'] == TRUE)
                {
                    $html_out .= "\t\t\t\t\t\t".'<li '.$this->class_menumore.'>'.anchor("#", '<span class="'.$menu[$i]['font_class'].' '.$menu[$i]['font_icon'].'"> '.$menu[$i]['title'].'</span>');                                        
                }
                else
                {
                    $html_out .= "\t\t\t\t\t\t".'<li>'.anchor($menu[$i]['url'], '<span class="'.$menu[$i]['font_class'].' '.$menu[$i]['font_icon'].'"> '.$menu[$i]['title'].'</span>');                    
                }

                // Recurse call to get more child submenus.                
                $html_out .= $this->get_childs($menu, $i);
                $html_out .= '</li>' . "\n";
            }
        }

        $html_out .= "\t\t\t\t\t".'</ul>' . "\n";               

        return ($has_subcats) ? $html_out : FALSE;
    }
}
// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.

// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */  