<?php

namespace App\Http\Controllers\AlertSystem;

use App\Http\Controllers\Controller;
use App\Repositories\AlertSystem\DepartmentRepository;
use App\Repositories\AlertSystem\VacancyRepository;
use App\Repositories\AlertSystem\JobTitleRepository;
use App\Repositories\AlertSystem\JobDescriptionRepository;
use App\Models\AlertSystem\JobTitle;
use App\Models\AlertSystem\JobDescription;

use App\Exports\AlertSystem\ExportJobTitleListTable;
use Maatwebsite\Excel\Facades\Excel;

use DataTables;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class JobTitleController extends Controller
{
    private $departments;
    private $jobtitiles;
    private $vacancy;
    private $jobdescription;

    public function __construct(
        DepartmentRepository $departments,
        JobTitleRepository $jobtitiles,
        VacancyRepository $vacancy,
        JobDescriptionRepository $jobdescription
    ) {
        $this->departments = $departments;
        $this->jobtitiles = $jobtitiles;
        $this->vacancy = $vacancy;
        $this->jobdescription = $jobdescription;
    }

    public function getJobTitlesByDepartment($department_id)
    {
        $jobTitles = JobTitle::select('id', 'name')
            ->where('department_id', $department_id)
            ->get()
            ->toArray();

        return response()->json(['data' => $jobTitles]);
    }

    public function getDataTables(Request $request)
    {
        $search = $request->get('search', '');
        $order_by = $request->get('order_by', 'id');
        $sort = $request->get('sort', 'asc');

        $data = $this->jobtitiles->getForDataTable($search, $order_by, $sort);

        // Transform the data to match the desired structure
        $transformedData = [];
        foreach ($data as $item) {
            $transformedData[] = [
                'id' => $item->id,
                'job_title' => [
                    'id' => $item->id,
                    'name' => $item->job_title_name,
                ],
                'department_name' => $item->department_name,
            ];
        }

        return response()->json(['data' => $transformedData]);
    }

/**
 * Export job titles to Excel file.
 *
 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
 */
public function exportToExcel()
{
    // Create an instance of the ExportJobTitleListTable class
    $exporter = new ExportJobTitleListTable($this->jobtitiles);

    // Call the exportToExcel method of the exporter to generate the Excel file
    return $exporter->exportToExcel();
}



    public function index()
    {
        return view('alertsystems.jobtitle.index');
    }

    public function create()
    {
        if (!Auth::user()->can('hr.create')) {
            abort(403, 'Unauthorized action.');
        }

        $departments = $this->departments->pluck();

        return view('alertsystems.jobtitle.create')
            ->withDepartments($departments);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            if (!Auth::user()->can('hr.store')) {
                abort(403, 'Unauthorized action.');
            }

            // Get all the inputs from the form submission
            $input = $request->all();

            // Create a new job title with the input
            $jobTitle = $this->jobtitiles->create($input);

            // Get the job descriptions from the input
            $jobDescriptions = $request->input('description', []);
            $descriptions = [];

            // Loop through each job description and create an array of JobDescription objects
            foreach ($jobDescriptions as $key => $jobDescription) {
                $descriptions[] = new JobDescription([
                    'description' => $jobDescription,
                    'job_title_id' => $jobTitle->id,
                ]);
            }

            // Save the descriptions in the job title
            $jobTitle->jobdescription()->saveMany($descriptions);

            DB::commit();
            return redirect()->route('jobtitle.index');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        if (!Auth::user()->can('hr.show')) {
            abort(403, 'Unauthorized action.');
        }

        $jobtitle = $this->jobtitiles->getById($id);
        $jobdescriptions = $jobtitle->jobdescription;

        return view('alertsystems.jobtitle.show', compact('jobtitle', 'jobdescriptions'));
    }

    public function edit($id)
    {
        if (!Auth::user()->can('hr.edit')) {
            abort(403, 'Unauthorized action.');
        }

        $jobTitle = $this->jobtitiles->getById($id);
        $departments = $this->departments->pluck();

        return view('alertsystems.jobtitle.edit')
            ->withJobtitle($jobTitle)
            ->withDepartments($departments);
    }

    public function update(Request $request, $id)
    {
        $jobtitle = JobTitle::findOrFail($id);
        $jobtitle->name = $request->name;
        $jobtitle->department_id = $request->department_id;
        $jobtitle->save();

        $jobdescriptions = $request->description;
        $jobdescriptionsToUpdate = [];
        $jobdescriptionsToCreate = [];

        foreach ($jobdescriptions as $key => $jobdescription) {
            if (isset($jobdescription['id'])) {
                // Job description already exists, add to update array
                $jobdescriptionsToUpdate[$key] = $jobdescription;
            } else {
                // Job description is new, add to create array
                $jobdescriptionsToCreate[$key] = $jobdescription;
            }
        }

        // Update existing job descriptions
        foreach ($jobdescriptionsToUpdate as $key => $jobdescription) {
            $jd = JobDescription::findOrFail($jobdescription['id']);
            $jd->description = $jobdescription['description'];
            $jd->save();
        }

        // Create new job descriptions
        foreach ($jobdescriptionsToCreate as $key => $jobdescription) {
            $jd = new JobDescription;
            $jd->job_title_id = $jobtitle->id;
            $jd->description = $jobdescription['description'];
            $jd->save();

            // Update job description array with new ID
            $jobdescriptions[$key]['id'] = $jd->id;
        }

        // Delete removed job descriptions
        $jobdescriptionsToRemove = $jobtitle->jobdescription->pluck('id')->diff(collect($jobdescriptions)->pluck('id')->filter());
        JobDescription::whereIn('id', $jobdescriptionsToRemove)->delete();

        return redirect()->route('jobtitle.index');
    }

    public function destroy($id)
    {
        return redirect()->route('/education')->with('exception', 'Operation failed!');
    }
}
