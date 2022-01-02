<?php

namespace App\Http\Controllers;

//use DB;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\SaveProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $portfolio = [
        //     ['title' => 'Proyecto #1'],
        //     ['title' => 'Proyecto #2'],
        //     ['title' => 'Proyecto #3'],
        //     ['title' => 'Proyecto #4'],
        // ];
        //$portfolio = DB::table('products')->get();
        //$products = Product::latest()->paginate(2);

        return view('products.index', [
            'products' => Product::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create', [
            'product' => new Product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProductRequest $request)
    {

        Product::create( $request->validated() );

        return redirect()->route('products.index')->with('status', 'El producto fue creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, SaveProductRequest $request)
    {
        $product->update( $request->validated() );

        return redirect()->route('products.show', $product)->with('status', 'El producto fue actualizado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('status', 'El producto fue eliminado con exito.');
    }
}