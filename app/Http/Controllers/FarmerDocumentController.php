<?php

namespace App\Http\Controllers;

use App\Models\FarmerDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FarmerDocumentController extends Controller
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

        $farmer_document = new FarmerDocument();
        $farmer_document->farmer_id = $request->input('farmer_id');
        $farmer_document->document_type_id = $request->input('document');
        $farmer_document->serial_no = $request->input('serial_no');
        $farmer_document->description = $request->input('description');
        $farmer_document->active = 1;
        $farmer_document->created_by = Auth::user()->id;
        $farmer_document->updated_by = Auth::user()->id;

        if ($request->hasFile('upload_document') && $request->file('upload_document')->isValid()) {
            $upload_document_file = $request->file('upload_document');
            $upload_document_file_name = Str::random(30) . '.' . $upload_document_file->getClientOriginalExtension();
            $upload_document_file->move('uploads/upload_documents/', $upload_document_file_name);
            $farmer_document->document_upload = 'uploads/upload_documents/' . $upload_document_file_name;
        }

        $farmer_document->save();

        return back()->with('success', 'Document Successfully uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FarmerDocument  $farmerDocument
     * @return \Illuminate\Http\Response
     */
    public function show(FarmerDocument $farmerDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FarmerDocument  $farmerDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(FarmerDocument $farmerDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FarmerDocument  $farmerDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FarmerDocument $farmerDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FarmerDocument  $farmerDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(FarmerDocument $farmerDocument)
    {
        //
    }
}
