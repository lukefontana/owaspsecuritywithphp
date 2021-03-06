<?php

namespace security\Models\Corporate;

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'public/init.php';

use \security\Models\SessionInitializers;

class DestroySessionCorporate
{
    private $errors = [];
    public $success = [];
    private $init;
    public function __construct(SessionInitializers $init)
    {
        $this->init = $init;
    }
    public function destroySession()
    {
        $this->init->destroySession();
        return ["loggedout" => "Successfully ended user session."];
    }
}
