<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{  
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const PAGE_SIZE = 25;
    const MESSAGE_INSERT_SUCCESS = 'Succesfully saved.';
    const MESSAGE_UPDATE_SUCCESS = 'Succesfully updated.';
    const MESSAGE_FAILED = 'Error occured.';
    const MESSAGE_DELETE_SUCCESS = 'Succesfully Deleted.';
    const MESSAGE_NOT_FOUND = 'Not Found';   
}
