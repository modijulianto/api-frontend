<?php

namespace App\Models;

use CodeIgniter\Model;

class M_WS extends Model
{
    public function getToken()
    {
        $url = "http://localhost:8080/Auth/login";

        $loginInfo = [
            'username' => 'modijulianto',
            'password' => '123456'
        ];
        $data = http_build_query($loginInfo);

        $context_options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Content-Length: " . strlen($data) . "\r\n",
                'content' => $data
            ]
        ];

        $context = stream_context_create($context_options);
        $result = @file_get_contents($url, false, $context);

        if ($result) {
            $json = json_decode($result);
            $token = $json->token;
            return $token;
        }

        return $result;
    }

    public function getEmployees()
    {
        $token = $this->getToken();

        $url = "http://localhost:8080/Employees";

        $context_options = [
            'http' => [
                'method' => 'GET',
                'header' => "Authorization: Bearer " . $token
            ]
        ];

        $context = stream_context_create($context_options);
        $result = @file_get_contents($url, false, $context);

        return $result;
    }

    public function createEmployee($data)
    {
        $token = $this->getToken();

        $url = "http://localhost:8080/Employees";

        $data = json_encode($data, JSON_FORCE_OBJECT);

        $context_options = [
            'http' => [
                'method' => 'POST',
                'header' => "Authorization: Bearer " . $token . "\r\n" .
                    "Content-Type: application/json\r\n" .
                    "Content-Length: " . strlen($data),
                'content' => $data
            ]
        ];

        $context = stream_context_create($context_options);
        $result = @file_get_contents($url, false, $context);

        return $result;
    }

    public function getEmployee($emp_no)
    {
        $token = $this->getToken();

        $url = "http://localhost:8080/Employees/" . $emp_no;

        $context_options = [
            'http' => [
                'method' => 'GET',
                'header' => "Authorization: Bearer " . $token
            ]
        ];

        $context = stream_context_create($context_options);
        $result = @file_get_contents($url, false, $context);

        return $result;
    }

    public function updateEmployee($emp_no, $data)
    {
        $token = $this->getToken();

        $url = "http://localhost:8080/Employees/" . $emp_no;

        $data = json_encode($data, JSON_FORCE_OBJECT);

        $context_options = [
            'http' => [
                'method' => 'PUT',
                'header' => "Authorization: Bearer " . $token . "\r\n" .
                    "Content-Type: application/json\r\n" .
                    "Content-Length: " . strlen($data),
                'content' => $data
            ]
        ];

        $context = stream_context_create($context_options);
        $result = @file_get_contents($url, false, $context);

        return $result;
    }

    public function deleteEmployee($emp_no)
    {
        $token = $this->getToken();

        $url = "http://localhost:8080/Employees/" . $emp_no;

        $context_options = [
            'http' => [
                'method' => 'DELETE',
                'header' => "Authorization: Bearer " . $token
            ]
        ];

        $context = stream_context_create($context_options);
        $result = @file_get_contents($url, false, $context);

        return $result;
    }
}
