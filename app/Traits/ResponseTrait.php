<?php
namespace App\Traits;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\JsonResponse;

trait ResponseTrait {

    protected $success = true;
    protected $message = '';
    protected $status = 200;
    protected $data = null;
    protected $response = [];
    protected $errors = [];


    /**
     * @return JsonResponse
     */
    public function apiResponse()
    {
        $this->response['success'] = $this->success;
        $this->response['message'] = $this->message;
        $this->response['status'] = $this->status;
        $this->response['data'] = $this->data;
        if(count($this->errors) > 0) {
            $this->response['errors'] = $this->errors;
        }
        return response()->json($this->response, 200);
    }
}
