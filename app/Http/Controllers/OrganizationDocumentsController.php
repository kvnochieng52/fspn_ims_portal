<?php

namespace App\Http\Controllers;

use App\Models\OrganizationDocuments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrganizationDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'document' => 'required',
            'upload_document' => 'mimes:doc,pdf,docx,png,jpg,jpeg|required',
        ]);

        $org_document = new OrganizationDocuments();
        $org_document->organization_id = $request->input('organization_id');
        $org_document->document_type_id = $request->input('document');
        $org_document->serial_no = $request->input('serial_no');
        $org_document->description = $request->input('description');
        $org_document->active = 1;
        $org_document->created_by = Auth::user()->id;
        $org_document->updated_by = Auth::user()->id;

        if ($request->hasFile('upload_document') && $request->file('upload_document')->isValid()) {
            $upload_document_file = $request->file('upload_document');
            $upload_document_file_name = Str::random(30) . '.' . $upload_document_file->getClientOriginalExtension();
            $upload_document_file->move('uploads/org_document/', $upload_document_file_name);
            $org_document->document_upload = 'uploads/org_document/' . $upload_document_file_name;
        }

        $org_document->save();

        return back()->with('success', 'Document Successfully uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrganizationDocuments  $organizationDocuments
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationDocuments $organizationDocuments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrganizationDocuments  $organizationDocuments
     * @return \Illuminate\Http\Response
     */
    public function edit(OrganizationDocuments $organizationDocuments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrganizationDocuments  $organizationDocuments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrganizationDocuments $organizationDocuments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrganizationDocuments  $organizationDocuments
     * @return \Illuminate\Http\Response
     */


    public function delete_document($doc_id)
    {
        OrganizationDocuments::where('id', $doc_id)->delete();
        return back()->with('success', 'Document Deleted');
    }
    public function destroy(OrganizationDocuments $organizationDocuments)
    {
        $organizationDocuments->delete();
        return back()->with('success', 'Document Successfully uploaded');
    }
}
