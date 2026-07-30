<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.service.servicelisting', compact('services'));
    }

    public function create()
    {
        return view('admin.service.addservice');
    }

    public function store(Request $request)
    {
        $serviceTitles = $request->service_title ?? [];
        $timelineTitles = $request->timeline_title ?? [];
        $budgets = $request->budget ?? [];

        // Clean the input titles and budgets (removing empty values)
        $serviceData = [];
        foreach ($serviceTitles as $title) {
            if (!empty(trim(strip_tags($title)))) {
                $serviceData[] = $title;
            }
        }

        $timelineData = [];
        foreach ($timelineTitles as $title) {
            if (!empty(trim(strip_tags($title)))) {
                $timelineData[] = $title;
            }
        }

        $budgetData = [];
        foreach ($budgets as $budget) {
            if (!empty(trim($budget))) {
                $budgetData[] = $budget;
            }
        }

        // Create the service record and store the data
        $service = new Service();
        $service->service_title = json_encode($serviceData);  // Save as JSON
        $service->timeline_title = json_encode($timelineData);  // Save as JSON
        $service->budget = json_encode($budgetData);  // Save as JSON
        $service->save();

        return redirect()->route('service.index')->with('success', 'Service Added Successfully');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $service->service_title = json_decode($service->service_title, true);  // Decoding into array
    $service->timeline_title = json_decode($service->timeline_title, true);  // Decoding into array
    $service->budget = json_decode($service->budget, true);
        return view('admin.service.editservice', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $post = Service::findOrFail($id);

        // Get the updated data from the request
        $serviceTitles = $request->service_title ?? [];
        $timelineTitles = $request->timeline_title ?? [];
        $budgets = $request->budget ?? [];

        // Clean the input titles and budgets (removing empty values)
        $serviceData = [];
        foreach ($serviceTitles as $title) {
            if (!empty(trim(strip_tags($title)))) {
                $serviceData[] = $title;
            }
        }

        $timelineData = [];
        foreach ($timelineTitles as $title) {
            if (!empty(trim(strip_tags($title)))) {
                $timelineData[] = $title;
            }
        }

        $budgetData = [];
        foreach ($budgets as $budget) {
            if (!empty(trim($budget))) {
                $budgetData[] = $budget;
            }
        }

        // Update the service fields
        $post->service_title = json_encode($serviceData);  // Save as JSON
        $post->timeline_title = json_encode($timelineData);  // Save as JSON
        $post->budget = json_encode($budgetData);  // Save as JSON
        $post->save();

        return redirect()->route('service.index')->with('success', 'Service Updated Successfully');
    }

    public function destroy($id)
    {
        $data = Service::findOrFail($id);

        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'Service Has Been Deleted Successfully');
        }

        return redirect()->back()->with('error', 'Service Not Found');
    }
}
