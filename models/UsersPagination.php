<?php

class UsersPagination extends Users
{

    /**
     * constructor
     */
    public function __construct($page = 1, $pageSize = 5)
    {
        parent::__construct();
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->totalRecords = count($this->data);
        $this->totalPages = ceil($this->totalRecords / $this->pageSize);
    }

    /**
     * paginate use this after order
     */
    public function paginate()
    {
        //users are in $this->data
        $start = ($this->page - 1) * $this->pageSize;
        $end = $start + $this->pageSize;
        $this->data = array_slice($this->data, $start, $end);
    }
}
