<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\UserProjectResource;
use App\Services\Interface\ExportServiceInterface;
use App\Models\Category;
use App\Models\Log;
use App\Models\Role;
use App\Models\User;
use App\Models\UserProject;
use App\Services\ExcelService;
use App\Services\PdfService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Excel;

class ReportController extends Controller
{
    protected $printer = ExportServiceInterface::class;
    public function index(Request $request) {
        $userId = $request->get('user_id');
        if(auth()->user()->role_id === Role::IS_ADMIN) {
            $employees = Cache::remember('employees', 60*10, function() use ($userId) {
                return EmployeeResource::collection(
                    User::get()
                );
            });
            $key = collect($employees)->search(function($employee) use ($userId) {
                return $employee['id'] === $userId;
            });
            if ($key) unset($employees[$key]);
            return $employees;
        } else {
            return auth()->user();
        }
    }

    public function userClients(Request $request) {
        try {
            $userId = $request->get('user_id');
            if(auth()->user()->id !== $userId && auth()->user()->role_id !== Role::IS_ADMIN ) {
                throw new Exception('You are not authorized');
            }
            return  UserProjectResource::collection(
                UserProject::where('user_id', $userId)->with('project.client')->get()
            );
        } catch(\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function projectCategory(Request $request) {
        $projectId = $request->get('project_id');
        return CategoryResource::collection(
            Category::whereHas('categoryProject', function(Builder $query) use ($projectId) {
                $query->where('project_id',$projectId);
            })->get()
        );
    }

    public function generateReport(Request $request) {
           return Log::report($request);
    }

    public function download(Request $request) {
        $printer = resolve(PdfService::class);

        if($request->get('type') == 'excel') {
            $printer = resolve(ExcelService::class);
        } elseif($request->get('type') == 'pdf') {
            $printer = resolve(PDFService::class);
        }

        // $printer->setData($data);
        $printer->setData(request('data'));
        $printer->generate();
    }
}
