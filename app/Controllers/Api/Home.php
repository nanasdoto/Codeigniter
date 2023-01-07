<?php

namespace App\Controllers\Api;

use App\Models\TindakanModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Home extends ResourceController
{
    use ResponseTrait;

    public function show($id_tindakan = null)
    {
        $model = new TindakanModel();
        $data = $model->find($id_tindakan);

        return $this->respond($data);
    }
}
