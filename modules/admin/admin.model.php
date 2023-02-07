<?php
class AdminModel
{
    private $db;

    function __construct()
    {
        $this->db = $GLOBALS["db"];
    }
}
