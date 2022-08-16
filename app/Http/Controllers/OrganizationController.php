<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\County;
use App\Models\Organization;
use App\Models\OrganizationCategory;
use App\Models\OrganizationDocuments;
use App\Models\OrganizationDocumentTypes;
use App\Models\OrganizationFocusArea;
use App\Models\OrganizationSelecetdCategory;
use App\Models\OrganizationSelecetdFocusGroup;
use App\Models\OrganizationSelecetdSustainableGoal;
use App\Models\SustainableGoal;
use Illuminate\Http\Request;


class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('organization.index', [
            'organizations' => Organization::getOrganizations(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organization.create', [
            'countries' => Country::where('active', 1)->pluck('country_name', 'id'),
            'counties' => County::where('active', 1)->pluck('county_name', 'id'),
            'categories' => OrganizationCategory::where('active', 1)->pluck('category_name', 'id'),
            'focus_areas' => OrganizationFocusArea::where('active', 1)->pluck('focus_area_name', 'id'),
            'sdgs' => SustainableGoal::where('active', 1)->pluck('sdg_name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Organization::RULES);
        $organization = new Organization();
        $organization_id = Organization::updateOrganization($organization, $request);
        return redirect('organization/' . $organization_id . '/edit')->with('success', 'Organization created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        return view('organization.show', [
            'organization' => Organization::organizationByID($organization->id),
            'organization_documents' => OrganizationDocuments::getOrganizationDocuments($organization->id),
            'selected_categories' => OrganizationSelecetdCategory::leftJoin('organization_categories', 'organization_selecetd_categories.category', '=', 'organization_categories.id')
                ->where('organization', $organization->id)
                ->pluck('category_name'),
            'selected_focus_areas' => OrganizationSelecetdFocusGroup::leftJoin('organization_focus_areas', 'organization_selecetd_focus_groups.focus_group', '=', 'organization_focus_areas.id')
                ->where('organization', $organization->id)
                ->pluck('focus_area_name'),
            'selected_sdgs' => OrganizationSelecetdSustainableGoal::leftJoin('sustainable_goals', 'organization_selecetd_sustainable_goals.sustainable_goal', '=', 'sustainable_goals.id')
                ->where('organization', $organization->id)
                ->pluck('sdg_name'),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        return view('organization.edit', [
            'countries' => Country::where('active', 1)->pluck('country_name', 'id'),
            'counties' => County::where('active', 1)->pluck('county_name', 'id'),
            'categories' => OrganizationCategory::where('active', 1)->pluck('category_name', 'id'),
            'focus_areas' => OrganizationFocusArea::where('active', 1)->pluck('focus_area_name', 'id'),
            'sdgs' => SustainableGoal::where('active', 1)->pluck('sdg_name', 'id'),
            'organization' => Organization::organizationByID($organization->id),
            'selected_categories' => OrganizationSelecetdCategory::where('organization', $organization->id)->pluck('category')->toArray(),
            'selected_focus_areas' => OrganizationSelecetdFocusGroup::where('organization', $organization->id)->pluck('focus_group')->toArray(),
            'selected_sdgs' => OrganizationSelecetdSustainableGoal::where('organization', $organization->id)->pluck('sustainable_goal')->toArray(),
            'organization_document_types' => OrganizationDocumentTypes::where('active', 1)->pluck('document_type_name', 'id'),
            'organization_documents' => OrganizationDocuments::getOrganizationDocuments($organization->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        $this->validate($request, Organization::RULES);
        $organization_id = Organization::updateOrganization($organization, $request);
        return redirect('organization/' . $organization_id . '/edit')->with('success', 'Organization Edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();
        return back()->with('success', 'Organization successfully deleted!');
    }
}
