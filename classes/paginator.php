<?php

$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");

class Paginator
{

    private $_db;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;

    private $_types;
    private $_vars;

    public function __construct()
    {
        $this->_db = new Database();
    }
    public function constructor($query_filter, $types, $vars)
    {

       
        $this->_query = $query_filter;
        $this->_types = $types;
        $this->_vars = $vars;
        
    }

    public function getData($limit = 10, $page = 1)
    {

        $this->_limit   = mysqli_real_escape_string($this->_db->link, $limit);
        $this->_page    =  mysqli_real_escape_string($this->_db->link,$page);



        $rs = $this->_db->p_statement($this->_query, $this->_types,   $this->_vars );
        $this->_total = $rs ? $rs->num_rows : 0;

        if ($this->_limit == 'all') {
            $query      = $this->_query;
        } else {
            $query      = $this->_query . " LIMIT " . (($this->_page - 1) * $this->_limit) . ", $this->_limit";
        }

       
        $results             = $this->_db->p_statement($query, $this->_types,   $this->_vars );
       
        // print_r($results);
       

        $result         = new stdClass();
        $result->page   = $this->_page;
        $result->limit  = $this->_limit;
        $result->total  = $this->_total;
        $result->data   = $results;

        return $result;
    }

    public function createLinksAjax($links, $list_class)
    {
       
        if ($this->_limit == 'all') {
            return '';
        }

        $links =  mysqli_real_escape_string($this->_db->link, $links);

        $last       = ceil($this->_total / $this->_limit);

        $start      = (($this->_page - $links) > 0) ? $this->_page - $links : 1;
        $end        = (($this->_page + $links) < $last) ? $this->_page + $links : $last;

        $html       = '<ul class="' . $list_class . '">';

        $class      = ($this->_page == 1) ? "disabled" : "";
        $html       .= '<li class="page-item ' . $class . '"><a class="page-link link-ajax" href="' . $this->_limit . '&' . ($this->_page - 1) . '">&laquo;</a></li>';

        if ($start > 1) {
            $html   .= '<li class="page-item"><a class="page-link link-ajax" href="' . $this->_limit . '&1">1</a></li>';
            $html   .= '<li class="page-item disabled"><span>...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class  = ($this->_page == $i) ? "active" : "";
            $html   .= '<li class="page-item ' . $class . '"><a class="page-link link-ajax" href="' . $this->_limit . '&' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html   .= '<li class="page-item disabled"><span>...</span></li>';
            $html   .= '<li class="page-item"><a class="page-link link-ajax" href="' . $this->_limit . '&' . $last . '">' . $last . '</a></li>';
        }

        $class      = ($this->_page == $last) ? "disabled" : "";
        $html       .= '<li class="page-item ' . $class . '"><a class="page-link link-ajax" href="' . $this->_limit . '&' . ($this->_page + 1) . '">&raquo;</a></li>';

        $html       .= '</ul>';

        return $html;
    }


    public function createLinks($links, $list_class)
    {
       
        if ($this->_limit == 'all') {
            return '';
        }
        $links =  mysqli_real_escape_string($this->_db->link, $links);

        $last       = ceil($this->_total / $this->_limit);

        $start      = (($this->_page - $links) > 0) ? $this->_page - $links : 1;
        $end        = (($this->_page + $links) < $last) ? $this->_page + $links : $last;

        $html       = '<ul class="' . $list_class . '">';

        $class      = ($this->_page == 1) ? "disabled" : "";
        $html       .= '<li class="page-item ' . $class . '"><a class="page-link" href="?limit=' . $this->_limit . '&page=' . ($this->_page - 1) . '">&laquo;</a></li>';

        if ($start > 1) {
            $html   .= '<li class="page-item"><a class="page-link" href="' . $this->_limit . '&1">1</a></li>';
            $html   .= '<li class="page-item disabled"><span>...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class  = ($this->_page == $i) ? "active" : "";
            $html   .= '<li class="page-item ' . $class . '"><a class="page-link" href="?limit=' . $this->_limit . '&&page=' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html   .= '<li class="page-item disabled"><span>...</span></li>';
            $html   .= '<li class="page-item"><a class="page-link" href="?limit=' . $this->_limit . '&&page=' . $last . '">' . $last . '</a></li>';
        }

        $class      = ($this->_page == $last) ? "disabled" : "";
        $html       .= '<li class="page-item ' . $class . '"><a class="page-link" href="?limit=' . $this->_limit . '&&page=' . ($this->_page + 1) . '">&raquo;</a></li>';

        $html       .= '</ul>';

        return $html;
    }
}
