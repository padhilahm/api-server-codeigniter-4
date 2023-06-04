<?php

namespace App\Controllers\Api;

use App\Models\OtentikasiModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class OtentikasiController extends BaseController
{
    use ResponseTrait;
    public function create()
    {
        $validation =  \Config\Services::validation();
        $rules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => '{field} tidak valid'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
        }

        $otentikasiModel = new OtentikasiModel();
        $data = $otentikasiModel->where('email', $this->request->getVar('email'))->first();
        if (!$data) {
            return $this->fail('Username atau Password salah 1');
        }

        if ($data->password != md5($this->request->getVar('password'))) {
            return $this->fail('Username atau Password salah 2');
        }

        helper('jwt');
        $response = [
            'status' => 200,
            'message' => 'Berhasil login',
            'data' => [
                'id' => $data->id,
                'email' => $data->email,
                'token' => createJWT($data->email)
            ]
        ];
        return $this->respond($response, 200);
    }

    public function validToken()
    {
        return $this->respond(['status' => 200, 'message' => 'Token valid']);
    }
}
