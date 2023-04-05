<?php
namespace App\Repositories\Disciplinary;

use App\Repositories\BaseRepository;
use App\Models\AlertSystem\DisciplinaryAction;
use Auth;

class DisplinaryActionRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Department::class;
    }

    	public function create(array $input)
	{
		//$user = Auth::user();

		//if (! $user->can('recreational.create'))
		//{

		//throw new GeneralException(__('exceptions-app.frontend.not_auth'));

		//}
		$data=[];
		$data['department_name']=$input['department_name'];
		$data['department_name']=$input['department_name'];
		$data['department_name']=$input['department_name'];
		$data['department_name']=$input['department_name'];
		$item=$this->model();
		$item=new $item($data);
		//$item->owner_organisation_id=$user->organisation_id;
        $item->save();
        
	}

	public function update(Department $model, array $input)
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
		$data['department_name']=$input['department_name'];
		return $model->update($data);
	}

	public function getForDataTable($search = '', $order_by = '', $sort = 'asc', $trashed = false)
    {

	//   \Barryvdh\Debugbar\Facade::info('Department getForDataTable : "' . $search . '"');
       // $user = Auth::user();
        $dataTableQuery = $this->model->query()
						       ->select(['departments.id', 'departments.department_name']);
         if (!empty($search)) {
            $search = '%' . strtolower($search) . '%' ;
            $dataTableQuery->where(function ($query) use ($search) {
                $query->where('id','ILIKE',  $search )
				       ->orWhere('department_name','ILIKE',  $search );
            });
        }


        if ($trashed == "true") {
            return $dataTableQuery->onlyTrashed();
        }
        return $dataTableQuery ;
    }
	   
    public function pluck($column = 'department_name', $key = 'id')
    {
        return $this->model->query()
            ->orderBy($column)
            ->pluck($column, $key);
    }
}

?>