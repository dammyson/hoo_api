<?php

namespace App\Services\Resident;

use App\Models\Groups;
use App\Services\BaseServiceInterface;

class InfoService implements BaseServiceInterface
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function run()
    {
       $res = Groups::findorfail($this->id);
       return $res; 
    }
}