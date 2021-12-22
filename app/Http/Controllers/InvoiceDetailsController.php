<?php

namespace App\Http\Controllers;

use App\InvoiceDetails;
use App\Invoice;
use App\InvoiceAttachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class InvoiceDetailsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvoiceDetails  $invoiceDetails
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceDetails $invoiceDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoiceDetails  $invoiceDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice  = Invoice::where('id',$id)->first();
        $invoiceDetails = InvoiceDetails::where('id_Invoice',$id)->get();
        $invoiceAttachments = InvoiceAttachments::where('invoice_id',$id)->get();
        return view('invoices.invoice_details',compact('invoice','invoiceDetails','invoiceAttachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceDetails  $invoiceDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceDetails $invoiceDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceDetails  $invoiceDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoice = InvoiceAttachments::findOrFail($request->id_file);
        $invoice->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function open_file($invoice_number,$file_name)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);
    }

    public function get_file($invoice_number,$file_name)

    {
        $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->download($contents);
    }
}
