<?php


/**
 * 为了节约系统资源，有时需要确保系统中某个类只有唯一一个实例，
 * 当这个唯一实例创建成功之后，我们无法再创建一个同类型的其他对象，
 * 所有的操作都只能基于这个唯一实例。
 * 为了确保对象的唯一性，我们可以通过单例模式来实现，这就是单例模式的动机所在
 *
 * 单例模式
 * 一个类只有一个对象
 *
 * 私有的静态成员变量，保存当前实例
 * 私有的构造函数，阻止类外部实例化
 * 私有的__clone()函数，阻止外部克隆
 * 公有的静态方法，获得当前实例
 */

class Db{
    private $host; //主机
    private $user; //用户名
    private $pwd;  //密码
    private $dbname; //数据库名
    private $charset; //数据库编码
    protected $tb_prefix; //表前缀
    private  $conn; //保存当前对象
    private static  $instance;

    //用私有的构造函数阻止在类的外部实例化
    private function __construct($config){

            $this->init($config);
            $this->connect();
        /* self::$conn = mysqli_connect($this->host, $this->user,$this->pwd,$this->dbname);*/
    }

    //阻止克隆
    private function __clone(){}

    //初始化配置信息

    private  function  init($config){
        $this->host = isset($config['host']) ? $config['host'] : '' ;
        $this->user = isset($config['user']) ? $config['user'] : '' ;
        $this->pwd = isset($config['pwd']) ? $config['pwd'] : '' ;
        $this->dbname =  isset($config['dbname']) ? $config['dbname'] : '' ;
        $this->tb_prefix = isset($config['tb_prefix']) ? $config['tb_prefix'] : '' ;
        $this->charset = isset($config['charset']) ? $config['charset'] : '' ;
    }

    //入口
    public static function mysql_con($config){
        if(!self::$instance instanceof self){
            return self::$instance = new Db($config);
        }
        return self::$instance;
    }

    //连接数据库

    private   function  connect(){
        /* self::$conn = mysqli_connect($this->host, $this->user,$this->pwd,$this->dbname);*/
       $this->conn = mysqli_connect($this->host, $this->user,$this->pwd,$this->dbname) or die('数据库连接失败'.mysqli_connect_error($this->conn));
    }

    //设置编码
    private  function setCharset(){
        mysqli_set_charset($this->conn,$this->charset);
    }

    //执行函数
    private  function  query($sql){
        $res = mysqli_query($this->conn,$sql);
        if(!$res){
            echo "数据库查询失败<br />";
            echo "错误代码".mysqli_errno($this->conn).'<br />';
            echo "错误信息".mysqli_error($this->conn).'<br />';
            echo "错误的sql语句".$sql.'<br />';
            die();
        }
        return $res;
    }


    /**
     * 查询多条数据
     * @param $table   [表名]
     * @param string $ele  [查询元素]
     * @param null $where  [条件]
     * @param string $fetch_type [获取的数据类型 array assoc row]
     * @return array  [结果集]
     */
    public  function select_all($table,$ele='*',$where=null,$fetch_type = 'array'){
        $sql = "SELECT {$ele} FROM {$table}{$where}";
        $res = $this->query($sql);
        $fetch_types = ['array','assoc','row'];
        !in_array($fetch_type,$fetch_types) ? $fetch_type = 'array' :$fetch_type;
        $mysql_fetch = "mysqli_fetch_".$fetch_type;
        if($res && mysqli_num_rows($res) >0){
            while ($result = $mysql_fetch($res)){
                $info[] = $result;
            }
        }
        return  $info;
    }

    /**
     * 查询单条记录
     * @param $table   [表名]
     * @param string $ele  [查询元素]
     * @param null $where  [条件]
     * @param string $fetch_type  [获取的数据类型 array assoc row]
     * @return mixed|null  [结果集]
     */
    public function find_all($table,$ele='*',$where=null,$fetch_type = 'array'){
        $res = $this->select_all($table,$ele,$where,$fetch_type);
        return empty($res) ? null :$res[0];
    }


    /**
     * 新增记录
     * @param $table  [表名]
     * @param  array $arr   [数组]
     * @return mixed
     */
    public function add($table,$arr){
        $data = $this->setdata($arr);
        $sql = "INSERT INTO $table ($data[0]) VALUES ($data[1])";
        $res = $this->query($sql);
        return $this->returncode($res);
    }

    /**
     * 修改记录
     * @param $table [表名]
     * @param $arr  [数组]
     * @param $where [条件]
     * @return mixed
     */
    public function  edit($table,$arr,$where){
        $str = "";
        foreach ($arr as $k => $v){
            $str .= "`{$k}`='{$v}',";
        }
        $str = rtrim($str,',');
        $sql = "UPDATE {$table} SET {$str} {$where}";
       
        $res = mysqli_query($this->conn,$sql);
        return $this->returncode($res);

    }

    /**\
     * 删除数据
     * @return mixed
     * param table where
     * table 表名
     * where 条件
     */
    public  function  del($table,$where){
        $sql = "DELETE FROM {$table} {$where}";
        $res = $this->query($sql);
        return $this->returncode($res);
    }

    /**
     * 把数组处理成字符串
     * @param   array $arr [数组]
     * @return   mixed
     */
    public  function  setdata($arr){
        $key = '';
        $value = '';
        foreach ($arr as $k => $v){
            $key .= "`$k`,";
            $value .= "'$v',";
        }
        $data['0'] = rtrim($key,',');
        $data['1'] = rtrim($value,',');
        return $data;
    }



    /**
     * 返回的消息
     * @param $res
     * @return mixed
     */
    public  function  returncode($res){
        if($res){
            $ins['code'] = 1;
            $ins['msg'] ='操作成功';
        }else{
            $ins['code'] = 0;
            $ins['msg'] ='操作失败';
        }
        return $ins;
    }

}








