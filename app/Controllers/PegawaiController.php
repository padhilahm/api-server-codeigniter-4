<?php

namespace App\Controllers;

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
        // $client = \Config\Services::curlrequest();
        // $url = 'http://localhost:8080/api/pegawai';
        // $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9ycGhhLmNhc3BlckBtaWxsZXIuY29tIiwiaWF0IjoxNjg1NzA1MTYyLCJleHAiOjE2ODU3MDg3NjJ9.VrTFATKd1oHa_bUJXbk1uBgum5SeBGVRycZDgJvTXys";
        // $headers = [
        //     'Authorization' => 'Bearer ' . $token
        // ];
        // $response = $client->request('GET', $url, ['headers' => $headers]);
        // print_r($response);

        $client = \Config\Services::curlrequest();

        $response = $client->request('GET', 'http://localhost:8080/api/pegawai', [
            'auth' => ['user', 'pass'],
        ]);
        print_r($response);
    }

    public function show($id)
    {
    }

    public function create()
    {
    }

    public function update($id)
    {
    }

    public function delete($id)
    {
    }
}
