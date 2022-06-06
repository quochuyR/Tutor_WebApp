<?php
namespace Classes;
use stdClass;
use Library\Database;
$filepath  = realpath(dirname(__FILE__));

include_once($filepath."../../lib/database.php");

class Paginator
{

    private $_db;
    private int $_limit;
    private int $_page;
    private string $_query;
    private int $_total;

    private string $_types;
    private array $_vars;

    public function __construct()
    {
        $this->_db = new Database();
    }

    public function constructor(string $query_filter, string $types, array $vars)
    {      
        $this->_query = $query_filter;
        $this->_types = $types;
        $this->_vars = $vars;      
    }

    /**
     * Hàm có nhiệm vụ lấy dữ liệu phần trang
     * @param int $limit giới hạn số lượng dữ liệu hiển thị (mặc định là 10)
     * @param int $page thứ tự phân trang (trang 1, 2, 3 ... Mặc định là 1)
     * @return object dữ liệu phân trang (page, limit, total, data)
     */
    public function getData(int $limit = 10, int $page = 1): object
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

     /**
     * Hàm có nhiệm vụ tạo đoạn html hiển thị ra file html sử dụng ajax
     * @param int $links số lượng link hiển thị (mặc định là 3)
     * @param string $list_class tên class của thẻ ul phần trang (sử dụng với bootstrap,...)
     * @return string chuỗi chứa đoạn html 
     */
    public function createLinksAjax(int $links = 3, string $list_class): string
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


    /**
     * Hàm có nhiệm vụ tạo đoạn html hiển thị ra file html không sử dụng ajax
     * @param int $links số lượng link hiển thị (mặc định là 3)
     * @param string $list_class tên class của thẻ ul phần trang (sử dụng với bootstrap,...)
     * @return string chuỗi chứa đoạn html 
     */
    public function createLinks(int $links, string $list_class): string
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
