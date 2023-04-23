<?php
namespace App\Controller;
use App\Crud\GenericCrud;

class GenericController {
    private $crud;
    private $table;

    const ALLOWED_TABLES = [
        'chassis',
        'cpus',
        'cpu_cooler',
        'gpus',
        'motherboards',
        'psus',
        'rams',
        'hdds',
        'ssds',
        
    ];

    public function __construct() {
        $this->crud = new GenericCrud();
    }

    private function create($data) {
        return $this->crud->create($this->table, $data);
    }

    private function read($id) {
        return $this->crud->read($this->table, $id);
    }

    private function getAll() {
        return $this->crud->getAll($this->table);
    }

    private function update($id, $data) {
        return $this->crud->update($this->table, $id, $data);
    }

    private function delete($id) {
        return $this->crud->delete($this->table, $id);
    }

    public function handleRequest($uri, $requestMethod) {
        $response = [
            'status' => 'error',
            'message' => 'Invalid request',
            'http_code' => 400
        ];

        $path = trim(parse_url($uri, PHP_URL_PATH), '/');
        $id = null;
        $tableName = null;

        if (preg_match('/^(\w+)(?:\/(\d+))?$/', $path, $matches)) {
            $tableName = $matches[1];
            $id = isset($matches[2]) ? $matches[2] : null;
        }

        if ($tableName && in_array($tableName, self::ALLOWED_TABLES)) {
            $this->table = $tableName;
    
            switch ($requestMethod) {
                case 'GET':
                    if ($id) {
                        $data = $this->read($id);
                        if (!empty($data)) {
                            $response = [
                                'status' => 'success',
                                'data' => $data,
                                'http_code' => 200
                            ];
                        } else {
                            $response['message'] = 'No data found';
                            $response['http_code'] = 404;
                        }
                    } else {
                        $data = $this->getAll();
                        if (!empty($data)) {
                            $response = [
                                'status' => 'success',
                                'data' => $data,
                                'http_code' => 200
                            ];
                        } else {
                            $response['message'] = 'No data found';
                            $response['http_code'] = 404;
                        }
                    }
                    break;
                case 'POST':
                    $data = json_decode(file_get_contents('php://input'), true);
                    if ($this->create($data)) {
                        $response = [
                            'status' => 'success',
                            'message' => "{$this->table} created",
                            'http_code' => 200
                        ];
                    }
                    break;
                case 'PUT':
                    if ($id) {
                        $data = json_decode(file_get_contents('php://input'), true);
                        if ($this->update($id, $data)) {
                            $response = [
                                'status' => 'success',
                                'message' => "{$this->table} updated",
                                'http_code' => 200
                            ];
                        }
                    }
                    break;
                case 'DELETE':
                    if ($id) {
                        if ($this->delete($id)) {
                            $response = [
                                'status' => 'success',
                                'message' => "{$this->table} deleted",
                                'http_code' => 200
                            ];
                        }
                    }
                    break;
            }
        } else {
            $response['message'] = 'Invalid table name';
            $response['http_code'] = 400;
        }

        return $response;
    }
}
