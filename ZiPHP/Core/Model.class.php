<?php
class Model extends Mysqli{
    private $sql;
    private $result;

    public function __construct (){
        global $CONFIG;
        $dbconf=$CONFIG['db'];
        parent::mysqli($dbconf['db_host'],$dbconf['db_user'],
            $dbconf['db_passwd'],$dbconf['db_database']);
        if(mysqli_connect_errno())
            die("Connect error: (".mysqli_connect_errno().")"
                .mysqli_connect_error());
        $this->query("set names {$dbconf['db_charset']}");
    }

    public function query($sql) {
        $this->result = parent::query($sql);
        if($this->errno)
            die("Query error: (\"$this->errno\") $this->error");
        return $this->result;
    }

    public function execute_dml($sql) {
        $this->sql=$sql;
        $this->query($sql);
    }

    public function execute_dql($sql) {
        $this->sql=$sql;
        $resule = $this->query($sql);
        $store = array();
        while($store[] = $resule->fetch_assoc())
            ;
        array_pop($store);
        $resule->close();
        return $store;
    }

    public function __desctruct(){
        $this->close();
    }
};
