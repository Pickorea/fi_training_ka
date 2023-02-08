<?php
namespace App\Repositories\AlertSystem;

use App\Repositories\BaseRepository;
use App\Models\AlertSystem\Qualification;
use Auth;

class QualificationRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Qualification::class;
    }

    	public function create(array $input)
	{
		//$user = Auth::user();

		//if (! $user->can('recreational.create'))
		//{

		//throw new GeneralException(__('exceptions-app.frontend.not_auth'));

		//}
		$data=[];
		$data['qualification_name']=$input['qualification_name'];
		
		$item=$this->model();
		$item=new $item($data);
		//$item->owner_organisation_id=$user->organisation_id;
        $item->save();
        
	}

	public function update(Qualification $model, array $input)
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
        $data['qualification_name']=$input['qualification_name'];
		
		return $model->update($data);
	}

	public function getForDataTable($search = '', $order_by = '', $sort = 'asc', $trashed = false)
    {

	//   \Barryvdh\Debugbar\Facade::info('Qualification getForDataTable : "' . $search . '"');
       // $user = Auth::user();
        $dataTableQuery = $this->model->query()					
                       ->select(['id', 'qualification_name']);
         if (!empty($search)) {
            $search = '%' . strtolower($search) . '%' ;
            $dataTableQuery->where(function ($query) use ($search) {
                $query->where('id','ILIKE',  $search )
                    ->orWhere('qualification_name','ILIKE',  $search );
            });
        }


        if ($trashed == "true") {
            return $dataTableQuery->onlyTrashed();
        }
        return $dataTableQuery ;
    }
	   
    public function pluck($column = 'qualification_name', $key = 'id')
    {
        return $this->model->query()
            ->orderBy($column)
            ->pluck($column, $key);
    }
}

?>