<?php

namespace App\Repositories\TrainTrack;

use App\Repositories\BaseRepository;
use App\Models\TrainTrack\Program;

class ProgramRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Program::class;
    }

    public function create(array $input)
    {

        if (!isset($input['course_id'])) {
            // Handle the missing 'course_id' key error here
        }
        $data=[];
		// $data['program_id']=$input['program_id'];
        $data['course_id']=$input['course_id'];
        $data['department_id']=$input['department_id'];
        $data['trainer']=$input['trainer'];
        $data['start_date']=$input['start_date'];
        $data['end_date']=$input['end_date'];
		$item=$this->model();
		$item=new $item($data);
	    $item->save();

        // $data = [
        //     // 'program_id' => $input['program_id'],
        //     'course_id' => $input['course_id'],
        //     'department_id' => $input['department_id'],
        //     'trainer' => $input['trainer'],
        //     'start_date' => $input['start_date'],
        //     'end_date' => $input['end_date'],
        // ];
    
        // $program = $this->model->create($data);
    
        // return $program;
    }

    public function update(Program $model, array $input)
    {
        // $data=[];
		// $data['program_id']=$input['program_id'];
        // $data['course_id']=$input['course_id'];
        // $data['department_id']=$input['department_id'];
        // $data['trainer']=$input['trainer'];
        // $data['start_date']=$input['start_date'];
        // $data['end_date']=$input['end_date'];
		// return $model->update($data);

        $data = [
            // 'program_id' => $input['program_id'],
            'course_id' => $input['course_id'],
            'department_id' => $input['department_id'],
            'trainer' => $input['trainer'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
        ];
    
        $model->update($data);
    
        return $model;
    }

    public function getForDataTable($search = '', $order_by = 'course_id', $sort = 'asc', $trashed = false, $per_page = 3)
    {
        $dataTableQuery = $this->model()->query();
        $dataTableQuery->with('course');

        if (!empty($search)) {
            $search = '%' . strtolower($search) . '%';
            $dataTableQuery->where(function ($query) use ($search) {
                $query->where('course.course_id', 'LIKE', $search)
                    ->orWhere('course.title', 'LIKE', $search)
                    ->orWhere('course.description', 'LIKE', $search)
                    ->orWhere('course.duration', 'LIKE', $search)
                    ->orWhereHas('programs', function ($query) use ($search) {
                        $query->where('program_id', 'LIKE', $search);
                    })
                    ->orWhere('programs.trainer', 'LIKE', $search);
            });
        }
    
        $dataTableQuery->orderBy($order_by, $sort);
        
    
        return $dataTableQuery->paginate(10);
    }
    

    //to come back to it later when needed
    public function pluck($column = 'title', $key = 'program_id')
    {
        return $this->model->query()
            ->join('courses', 'programs.course_id', '=', 'courses.course_id')
            ->orderBy($column)
            ->pluck($column, $key);
    }

}
