<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\EmployeeReport;
use App\Models\FinancialReport;
use App\Models\QualificationCourse;
use App\Models\Report;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    use GeneralTrait;
    public function searchFinancialReport(Request $request)
    {
        $searchTerm = $request->input('search');
        if (!$searchTerm) {
            return  $this->returnError(500, 'Please provide a search term');
        }
        $searchTerms = explode(' ', $searchTerm);
        $financialReportsQuery = FinancialReport::query();
        foreach ($searchTerms as $term) {
            $financialReportsQuery->where(function ($query) use ($term) {
                $query->where('teacherName', 'LIKE', '%' . $term . '%')
                    ->orWhere('type', 'LIKE', '%' . $term . '%')
                    ->orWhere('value', 'LIKE', '%' . $term . '%')
                    ->orWhere('ProfitAmount', 'LIKE', '%' . $term . '%')
                    ->orWhere('profitRatio', 'LIKE', '%' . $term . '%');
            });
        }
        $financialReports = $financialReportsQuery->get();
        if ($financialReports->isEmpty()) {
            return $this->returnError(404, 'No financial reports found matching the search term');
        }
        return $this->returnData($financialReports, 200);
    }


    public function searchReport(Request $request)
    {
        $searchTerm = $request->input('search');
        if (!$searchTerm) {
            return  $this->returnError(500, 'Please provide a search term');
        }
        $searchTerms = explode(' ', $searchTerm);
        $reportsQuery = EmployeeReport::query();
        foreach ($searchTerms as $term) {
            $reportsQuery->where(function ($query) use ($term) {
                $query->where('nameEmployee', 'LIKE', '%' . $term . '%')
                    ->orWhere('operation', 'LIKE', '%' . $term . '%')
                    ->orWhere('name', 'LIKE', '%' . $term . '%')
                    ->orWhere('nameColumn', 'LIKE', '%' . $term . '%');
            });
        }
        $reports = $reportsQuery->get();
        if ($reports->isEmpty()) {
            return $this->returnError(404, 'No reports found matching the search term');
        }
        return $this->returnData($reports, 200);
    }


    public function searchCourse(Request $request)
    {
        $searchTerm = $request->input('search');
        if (!$searchTerm) {
            return  $this->returnError(400, 'Please provide a search term');
        }
        $searchTerms = explode(' ', $searchTerm);
        $coursesQuery = QualificationCourse::query();
        foreach ($searchTerms as $term) {
            $coursesQuery->where(function ($query) use ($term) {
                $query->where('name', 'LIKE', '%' . $term . '%')
                    ->orWhere('place', 'LIKE', '%' . $term . '%')
                    ->orWhere('price', 'LIKE', '%' . $term . '%')
                    ->orWhere('description', 'LIKE', '%' . $term . '%')
                    ->orWhere('date', 'LIKE', '%' . $term . '%');
            });
        }
        $courses = $coursesQuery->get();
        if ($courses->isEmpty()) {
            return  $this->returnError(404, 'No course found matching the search term');
        }
        return $this->returnData($courses, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
