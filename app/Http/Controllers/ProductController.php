<?php

namespace App\Http\Controllers;

use App\Product;
use App\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $sections = Section::all();
        return view('products.products',compact('products','sections'));
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

        $this->validate($request,[
           'product_name' => 'required|max:255|unique:products,product_name',
        ],[
           'product_name.required' => 'يرجي إدخال اسم المنتج',
           'product_name.unique' => 'اسم المنتج مستخدم مسبقا',
        ]);

        $input = $request->all();

        $b_exists = Product::where('product_name','=',$input['product_name'])->exists();

        if($b_exists){
            session()->flash('Error', 'خطأ المنتج مسجل مسبقا');
            return redirect('/products');
             }else{
                Product::create([
                    'product_name' => $request->product_name,
                    'section_id' => $request->section_id,
                    'description' => $request->description,
                ]);
                session()->flash('Add', 'تم اضافة المنتج بنجاح ');
                return redirect('/products');
             }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'product_name' => 'required|max:255|unique:sections,section_name,'.$id,
        ],[

            'product_name.required' =>'يرجي ادخال اسم المنتج',
            'product_name.unique' =>'اسم المنتج مسجل مسبقا',
        ]);

        $id = Section::where('section_name', $request->section_name)->first()->id;

        $Product = Product::findOrFail($request->id);
 
        $Product->update([
        'product_name' => $request->product_name,
        'description' => $request->description,
        'section_id' => $id,
        ]);
 
        session()->flash('Edit', 'تم تعديل المنتج بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Product::findOrFail($request->id)->delete();
        session()->flash('delete','تم حذف المنتج بنجاح');
        return redirect('/products');
    }
}
