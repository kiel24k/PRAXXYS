<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class ApiController extends Controller
{
    public function allProductList(Request $request)
    {
        $prod = Product::orderBy('id', 'asc')->get();
        return response()->json($prod);
    }
    public function productCategory(Request $request)
    {
        $productList = Product::where('category', $request->category)
            ->orderBy('id', 'asc')
            ->get();
        return response()->json($productList);
    }

    public function productSearch(Request $request, $search)
    {
        $product = new Product();
        if ($request->search) {
            return response()->json(
                $product::where('Name', 'like', '%' . $search . '%')
                    ->orWhere('Description', 'like', '%' . $search . '%')
                    ->orderBy('id', 'asc')
                    ->get()
            );
        } else {
            return response()->json(
                $product::orderBy('id', 'asc')
                    ->get()
            );
        }
    }
    public function removeProduct($id)
    {
        $product = new Product();
        $product::findOrFail($id)->delete();
        return response()->json($product);
    }
    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required', 'unique:products', 'max:255',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required', 'mimes:png,jpg,gif,jpeg', 'size:5000',
            'date' => 'required',
            'time' => 'required'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->date = $request->date;
        $product->time = $request->time;

        $image = $request->file('image');
        $fileName = $image->hashName();
        $request->image->move(public_path('uploads'), $fileName);
        $product->image = $fileName;
        $product->save();
        return response()->json("dsd");
    }

    public function updateProductView($id)
    {
        $getData = Product::findOrFail($id);
        $haha = response()->json($getData);
        return  Inertia::render('Update', ['haha' => $haha]);
        // return Inertia::render('Update', ['message' => $message]);
    }
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required', 'unique:products', 'max:255',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required', 'mimes:png,jpg,gif,jpeg', 'size:5000',
            'date' => 'required',
            'time' => 'required'
        ]);
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->date = $request->date;
        $product->time = $request->time;


        if ($request->hasFile('image')) {
            $filePath = "uploads/" . $product->image;
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $image = $request->file('image');
            $fileName = $image->hashName();
            $image->move(public_path('uploads'), $fileName);
            $product->image = $fileName;
        }
        $product->update();
        return response()->json($product);
    }

    public function test($video)
    {
        $res = response()->json($video);
        return Inertia::render('Video', ['res' => $res]);
    }
}
