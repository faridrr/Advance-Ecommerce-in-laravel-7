<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::getAllProduct();
        // return $products;
        return view('backend.product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::get();
        $category = Category::where('is_parent', 1)->get();
        // return $category;
        return view('backend.product.create')->with('categories', $category)->with('brands', $brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'var_blue' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'var_red' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'var_white' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'var_pink' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'var_yellow' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'var_orange' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'var_green' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'size' => 'nullable',
            'stock' => "nullable|numeric",
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'price_customize' => 'nullable|numeric',
            'discount' => 'nullable|numeric'
        ]);

        $data = $request->all();
        if(!isset($data->stock)){
            $data['stock'] = 1000;
        }
        if(!isset($data->discount)){
            $data['discount'] = 0;
        }
        if ($request->var_blue) {

            $imageBlue = time() . '-blue.' . $request->var_blue->extension();
            $request->var_blue->move(public_path('variations'), $imageBlue);
            $data['var_blue'] = $imageBlue;

        }
        if ($request->var_red) {
            $imageRed = time() . '-red.' . $request->var_red->extension();
            $request->var_red->move(public_path('variations'), $imageRed);
            $data['var_red'] = $imageRed;

        }
        if ($request->var_white) {
            $imageWhite = time() . '-white.' . $request->var_white->extension();
            $request->var_white->move(public_path('variations'), $imageWhite);
            $data['var_white'] = $imageWhite;


        }
        if ($request->var_pink) {
            $imagePink = time() . '-pink.' . $request->var_pink->extension();
            $request->var_pink->move(public_path('variations'), $imagePink);
            $data['var_pink'] = $imagePink;

        }
        if ($request->var_yellow) {
            $imageYellow = time() . '-yellow.' . $request->var_yellow->extension();
            $request->var_yellow->move(public_path('variations'), $imageYellow);
            $data['var_yellow'] = $imageYellow;

        }
        if ($request->var_orange) {
            $imageOrange = time() . '-orange.' . $request->var_orange->extension();
            $request->var_orange->move(public_path('variations'), $imageOrange);
            $data['var_orange'] = $imageOrange;

        }
        if ($request->var_green) {
            $imageGreen = time() . '-green.' . $request->var_green->extension();
            $request->var_green->move(public_path('variations'), $imageGreen);
            $data['var_green'] = $imageGreen;

        }


        $slug = Str::slug($request->title);
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $data['slug'] = $slug;
        $data['is_featured'] = $request->input('is_featured', 0);
        $size = $request->input('size');
        if ($size) {
            $data['size'] = implode(',', $size);
        } else {
            $data['size'] = '';
        }
        // return $size;
        // return $data;
        $status = Product::create($data);
        if ($status) {
            request()->session()->flash('success', 'Product Successfully added');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::get();
        $product = Product::findOrFail($id);
        $category = Category::where('is_parent', 1)->get();
        $items = Product::where('id', $id)->get();
        // return $items;
        return view('backend.product.edit')->with('product', $product)
            ->with('brands', $brand)
            ->with('categories', $category)->with('items', $items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'var_blue' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'var_red' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'var_white' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'var_pink' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'var_yellow' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'var_orange' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'var_green' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'size' => 'nullable',
            'stock' => "nullable|numeric",
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'price_customize' => 'nullable|numeric',
            'discount' => 'nullable|numeric'
        ]);

        $product = Product::findOrFail($id);


        $data = $request->all();


        $data['is_featured'] = $request->input('is_featured', 0);
        $size = $request->input('size');
        if ($size) {
            $data['size'] = implode(',', $size);
        } else {
            $data['size'] = '';
        }
        // return $data;
        $status = $product->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Product Successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $status = $product->delete();

        if ($status) {
            request()->session()->flash('success', 'Product successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting product');
        }
        return redirect()->route('product.index');
    }

    public function stats()
    {

        $tops = Cart::select('product_id')->where('order_id', '!=', null)->with('Product')->with('order')
            ->groupBy('product_id')->orderBy('product_id', 'DESC')->get();

        return view('backend.product.stats')->with('tops' , $tops)->with('status', '');

    }

    public function search(Request $request){


          $tops = Cart::select('product_id')->with('order');

        if($request->start_at){
            $tops = $tops->where('updated_at', '>=', $request->start_at);
        }
        if($request->end_at){
            $tops = $tops->where('updated_at', '<=', $request->end_at);
        }
        if($request->status){
            $tops =  $tops->where('status', $request->status);
        }
        $tops = $tops->where('order_id', '!=', null)->with('Product')->with('order')
            ->groupBy('product_id')->orderBy('product_id', 'DESC')->get();

        return view('backend.product.stats')->with('tops' , $tops)->with('status', '')->with('status', $request->status)->with('start_at', $request->start_at)->with('end_at', $request->end_at);;
    }
}
