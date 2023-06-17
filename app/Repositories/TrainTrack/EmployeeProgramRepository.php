<?php

namespace App\Repositories\TrainTrack;

use App\Repositories\BaseRepository;
use App\Models\TrainTrack\EmployeeProgram;

class EmployeeProgramRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return EmployeeProgram::class;
    }

    public function create(array $input)
    {
        $employeeProgram = $this->model->create($input);
        return $employeeProgram;
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update(EmployeeProgram $model, array $input)
    {
        $model->update($input);
        return $model;
    }
}
