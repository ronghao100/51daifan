<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_page {
    /**
     * @author :leanhunter<heww@live.com>
     * @create:2011-9-23
     * 本分页类专为三段式CI分页缩写，即site_url('control/function/2');
     */

    /**
     * config
     */
    public $part=2;//控制数字列表当前页前后链接数量
    public $totalpage=0;//总页数
    public $url='';//url地址,不含分页所在的段,形如：'control/function'
    public $total=0;//总条数
    public $perpage=5;//每页条数
    public $nowindex=1;//当前页
    public $seg=3;//页码参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
    public $next_page='下一页';//下一页
    public $pre_page='上一页';//上一页
    public $first_page='首页';//首页
    public $last_page='末页';//尾页
    /**
     * constructor构造函数
     *
     * @param $params=array()
     */
    public function __construct($params = array())
    {
        if (count($params) > 0)
        {
            $this->initialize($params);
        }
        log_message('debug', "MyPage Class Initialized");
    }

    function initialize($params)
    {
        if (count($params) > 0)
        {
            $this->total=isset($params['total']) ? intval($params['total']) : 0;//总条数
            $this->perpage=isset($params['perpage']) ? intval($params['perpage']) : 5;//每页条数
            $this->nowindex=isset($params['nowindex']) ? intval($params['nowindex']) : 1;//当前页
            $this->url=isset($params['url']) ? $params['url'] : '';//url地址,不含分页所在的段,形如：'control/function'
            $this->part=isset($params['part']) ? $params['part'] : 2;//控制数字列表当前页前后链接数量
            $this->seg=isset($params['seg']) ? $params['seg'] : 3;//页码参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
            $this->next_page=isset($params['next_page']) ? $params['next_page'] : '下一页>';
            $this->pre_page=isset($params['pre_page']) ? $params['pre_page'] : '<上一页';
            $this->first_page=isset($params['first_page']) ? $params['first_page'] : '首页';
            $this->last_page=isset($params['last_page']) ? $params['last_page'] : '末页';
        }
        $this->totalpage=ceil( $this->total / $this->perpage);//总页数
        $this->_myset_url($this->url);//设置链接地址
    }

    /**
     * 获取显示"下一页"的代码
     *
     * @param string $style
     * @return string
     */
    function next_page($style='pg_next')
    {
        if($this->nowindex < $this->totalpage){
            return $this->_get_link($this->_get_url($this->nowindex + 1), $this->next_page, $style);
        }
        return '<span class="'.$style.'">'.$this->next_page.'</span>';
    }

    /**
     * 获取显示“上一页”的代码
     *
     * @param string $style
     * @return string
     */
    function pre_page($style='pg_pre')
    {
        if($this->nowindex > 1){
            return $this->_get_link($this->_get_url($this->nowindex-1),$this->pre_page,$style);
        }
        return '<span class="'.$style.'">'.$this->pre_page.'</span>';
    }

    /**
     * 获取显示“首页”的代码
     *
     * @param string $style
     * @return string
     */
    function first_page($style='pg_first')
    {
        if($this->nowindex == 1){
            return '<span class="'.$style.'">'.$this->first_page.'</span>';
        }
        return $this->_get_link($this->_get_url(1),$this->first_page,$style);
    }

    /**
     * 获取显示“尾页”的代码
     *
     * @param string $style
     * @return string
     */
    function last_page($style='pg_last')
    {
        if($this->nowindex == $this->totalpage){
            return '<span class="'.$style.'">'.$this->last_page.'</span>';
        }
        return $this->_get_link($this->_get_url($this->totalpage),$this->last_page,$style);
    }
    /**
     * 获取显示“当前页”的代码
     *
     * @param string $style
     * @param string $nowindex_style
     * @return string
     */
    function nowbar($style='pg_link',$nowindex_style='pg_curr')
    {
        $plus=$this->part;
        $begin=1;
        $end=$this->totalpage;

        if ($this->nowindex > $plus) {
            $begin=$this->nowindex-$plus;
            $end = $this->nowindex + $plus;
            if ($end > $this->totalpage) {
                $begin= ($begin - $end + $this->totalpage>0) ? ($begin - $end + $this->totalpage) : 1;
                $end = $this->totalpage;
            }
        } else {
            $begin=1;
            $end = $begin + 2*$plus;
            $end = $end > $this->totalpage ? $this->totalpage : $end;
        }
        $out='';
        for($i = $begin;$i <= $end; $i++)
        {
            if($i != $this->nowindex){
                $out.= $this->_get_link($this->_get_url($i),$i,$style);
            }else{
                $out.= '<span class="'.$nowindex_style.'">'.$i.'</span>';
            }

        }

        return $out;
    }
    /**
     * 获取显示跳转按钮的代码
     *
     * @return string
     */
    function select()
    {
        $out='<select name="pagelect" class="pg_select">';
        for($i=1;$i <= $this->totalpage;$i++)
        {
            if($i==$this->nowindex){
                $out.='<option value="'.$i.'" selected>'.$i.'</option>';
            }else{
                $out.='<option value="'.$i.'">'.$i.'</option>';
            }
        }
        $out.='</select>';
        return $out;
    }
    /**
     * 控制分页显示风格
     *
     * @param int $mode
     * @return string
     */
    function show($mode=1)
    {
        switch ($mode)
        {
            case 1://上一页 1 2 3 4 5 下一页 第x页
                return $this->pre_page().$this->nowbar().$this->next_page();
                break;
            case 2://首页 上一页 1 2 3 4 5 下一页  末页 第x页
                return $this->first_page().$this->pre_page().$this->nowbar().$this->next_page().$this->last_page().'&nbsp;第'.$this->select().'页';
                break;
            case 3://上一页 1 2 3 4 5 下一页
                return $this->pre_page().$this->nowbar().$this->next_page();
                break;
            default://上一页 1 2 3 4 5 下一页  第x页
                return $this->pre_page().$this->nowbar().$this->next_page().'&nbsp;第'.$this->select().'页';
                break;
        }
    }
    /*----------------private function (私有方法)-----------------------------------------------------------*/

    /**
     * 设置url头地址
     * @param: String $url
     * @return boolean
     */
    public function _myset_url($url)
    {
        $CI=&get_instance();
        $CI->load->helper('url');
        if (empty($url)) {//如果$url为空，要用uri_string()函数取uri段
            $cururl='';
            $cururl=uri_string();
            $segementarray=explode("/",$cururl);
            $c=0;
            for ($i=0; $i < sizeof($segementarray); $i++) {
                if ($segementarray[$i] && $c < $this->seg-1) {//取uri_string()的seg-1段
                    $url=$url.'/'.$segementarray[$i];
                    $c++;
                }
            }
        }
        $this->url=site_url($url);
    }

    /**
     * 为指定的页面返回地址值
     *
     * @param int $pagenum
     * @return string $url
     */
    function _get_url($pagenum=1)
    {
        if(substr($this->url,-1)=='/'){
            return $this->url.$pagenum;
        }
        return $this->url.'/'.$pagenum;
    }

    /**
     * 获取链接地址
     */
    function _get_link($url,$text,$style=''){
        $style=$style?'class="'.$style.'"':'';
        return '<a '.$style.' href="'.$url.'">'.$text.'</a>';
    }

}
?>