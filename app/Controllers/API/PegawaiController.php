<?php

namespace App\Controllers\API;

use App\Models\PegawaiModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class PegawaiController extends BaseController
{
    use ResponseTrait;
    protected $pegawaiModel;

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        $data = $this->pegawaiModel->orderBy('nama', 'ASC')->findAll();

        return $this->respond($data, 200);
    }

    public function show($id)
    {
        $data = $this->pegawaiModel->find($id);
        if ($data) {
            return $this->respond($data, 200);
        }
        return $this->failNotFound("No Data Found with id $id");
    }

    public function create()
    {
        // $data = [
        //     'nama' => $this->request->getPost('nama'),
        //     'email' => $this->request->getPost('email'),
        // ];

        $data = $this->request->getPost();

        $this->pegawaiModel->save($data);

        if ($this->pegawaiModel->errors()) {
            $response = [
                'status' => 400,
                'error' => $this->pegawaiModel->errors(),
                'messages' => [
                    'error' => 'Data not saved'
                ]
            ];

            return $this->respond($response, 400);
        }

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];

        return $this->respond($response, 201);
    }

    public function update($id)
    {
        $isExist = $this->pegawaiModel->find($id);
        if (!$isExist) {
            return $this->failNotFound("No Data Found with id $id");
        }

        $data = $this->request->getRawInput();

        $this->pegawaiModel->update($id, $data);

        if ($this->pegawaiModel->errors()) {
            $response = [
                'status' => 400,
                'error' => $this->pegawaiModel->errors(),
                'messages' => [
                    'error' => 'Data not saved'
                ]
            ];

            return $this->respond($response, 400);
        }

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];

        return $this->respond($response, 200);
    }

    public function delete($id)
    {
        if (!$this->pegawaiModel->find($id)) {
            return $this->failNotFound("No Data Found with id $id");
        }

        $this->pegawaiModel->delete($id);
        if ($this->pegawaiModel->db->affectedRows() === 0) {
            return $this->fail('Data not deleted with id ' . $id);
        }

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data Deleted'
            ]
        ];
        return $this->respondDeleted($response, 200);
    }
}
