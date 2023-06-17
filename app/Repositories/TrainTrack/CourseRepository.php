<?php
namespace App\Repositories\TrainTrack;

use App\Repositories\BaseRepository;
use App\Models\TrainTrack\Course;
use Auth;

class CourseRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Course::class;
    }

    	public function create(array $input)
	{
		//$user = Auth::user();

		//if (! $user->can('recreational.create'))
		//{

		//throw new GeneralException(__('exceptions-app.frontend.not_auth'));

		//}
		$data=[];
		$data['title']=$input['title'];
        $data['description']=$input['description'];
        $data['duration']=$input['duration'];
		$item=$this->model();
		$item=new $item($data);
		//$item->owner_organisation_id=$user->organisation_id;
        $item->save();
        
	}

	public function update(Course $model, array $input)
	{

	//$user = Auth::user();
	//if (! $user->can('recreational.edit'))
	//{
	//throw new GeneralException(__('exceptions-app.frontend.not_auth'));
	//}
	//	if ($user->organisation_id !== $model->owner_organisation_id)
	//	{
		//	throw  new GeneralException('No privallaged');


	
		//}
		$data=[];
		$data['title']=$input['title'];
        $data['description']=$input['description'];
        $data['duration']=$input['duration'];
		return $model->update($data);
	}

	public function getForDataTable($search = '', $order_by = 'course_id', $sort = 'asc', $trashed = false, $per_page = 3)
{
    $dataTableQuery = $this->model->query();

    // dd($dataTableQuery->get());

    if (!empty($search)) {
        $search = '%' . strtolower($search) . '%';
        $dataTableQuery->where(function ($query) use ($search) {
            $query->where('course_id', 'LIKE', $search)
                ->orWhere('title', 'LIKE', $search)
                ->orWhere('description', 'LIKE', $search)
                ->orWhere('duration', 'LIKE', $search);
        });
    }

    $dataTableQuery->orderBy($order_by, $sort);

    return $dataTableQuery->paginate(10);
}

    
	   
    public function pluck($column = 'title', $key = 'course_id')
    {
        return $this->model->query()
            ->orderBy($column)
            ->pluck($column, $key);
    }
}

?>