<?php
class  DemoController extends BaseController
{
    public $model;
    function __construct ($control, $action)
    {
        // Tải thư viện
        $this->logger = new Logger();
        $this->caching = new Caching();

        // Tải model
        $this->model = new Model();

        // Thực hiện action
        parent::__construct($control, $action);
    }

    function index()
    {
        //
        $result = $this->model->findAll();
        echo 'tra ve json '.json_encode($result)."<br>";

        //
        $this->logger->write('demo log');

        //
        $this->caching->cacheTable('demo',['demo']);
    }
}
?>