<?php
namespace App\Repositories\AlertSystem;

use App\Repositories\BaseRepository;
use App\Models\AlertSystem\WorkStatus;
use Auth;

class WorkStatusRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return WorkStatus::class;
    }

    	public function create(array $input)
	{
		//$user = Auth::user();

		//if (! $user->can('recreational.create'))
		//{

		//throw new GeneralException(__('exceptions-app.frontend.not_auth'));

		//}
		$data=[];
		$data['work_status_name']=$input['work_status_name'];
		$item=$this->model();
		$item=new $item($data);
		//$item->owner_organisation_id=$user->organisation_id;
        $item->save();
        
	}

	public function update(Customer $model, array $input)
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
		$data['work_status_name']=$input['work_status_name'];
		return $model->update($data);
	}

	public function getForDataTable($search = '', $order_by = 'id', $sort = 'asc', $trashed = false, $per_page = 3)
{
    $dataTableQuery = $this->model->query();

    if (!empty($search)) {
        $search = '%' . strtolower($search) . '%';
        $dataTableQuery->where(function ($query) use ($search) {
            $query->where('id', 'LIKE', $search)
                ->orWhere('work_status_name', 'LIKE', $search);
        });
    }

    $dataTableQuery->orderBy($order_by, $sort);

    return $dataTableQuery->paginate($per_page);
}


    
	   
    public function pluck($column = 'work_status_name', $key = 'id')
    {
        return $this->model->query()
            ->orderBy($column)
            ->pluck($column, $key);
    }
}

?>