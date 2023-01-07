<?php

namespace App\Controllers\Api;

use App\Models\PasienModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Home1 extends ResourceController
{
    use ResponseTrait;

    public function show($id_pasien = null)
    {
        $model = new PasienModel();
        $data = $model->find($id_pasien);

        return $this->respond($data);
    }
}
