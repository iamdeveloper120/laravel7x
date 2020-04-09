<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class FallbackController extends Controller
{
    use ResponseTrait;
    public function page404()
    {
        $this->status = 404;
        $this->message = 'Page Not Found. If error persists, contact info@website.com';
        return $this->apiResponse();
    }
}
