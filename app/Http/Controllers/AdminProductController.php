<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function edit(Product $product)
    {
        return view('admin.product_edit', [
            'product' => $product
        ]);
    }

    public function update(Product $product, Request $request)
    {
        $input = $request->validate([
            'name' => 'string|required',
            'price' => 'string|required',
            'stock' => 'integer|nullable',
            'cover' => 'file|nullable',
            'description' => 'string|nullable',
        ]);

        if (isset($input['cover']) && $input['cover']->isValid()) {
            Storage::disk('public')->delete($product->cover ?? '');
            $file = $input['cover'];
            $path = $file->store('products', 'public');
            $input['cover'] = $path;
        }

        $product->fill($input);
        $product->save();
        return Redirect::route('admin.products');
    }

    public function create()
    {
        return view('admin.product_create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'string|required',
            'price' => 'string|required',
            'stock' => 'integer|nullable',
            'cover' => 'file|nullable',
            'description' => 'string|nullable',
        ]);

        $input['slug'] = Str::slug($input['name']);

        if (isset($input['cover']) && $input['cover']->isValid()) {
            $file = $input['cover'];
            $path = $file->store('products');
            $input['cover'] = $path;
        }

        Product::create($input);
        return Redirect::route('admin.products');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->cover ?? '');
        $product->delete();
        return Redirect::route('admin.products');
    }

    public function destroyImage(Product $product)
    {
        Storage::disk('public')->delete($product->cover ?? '');
        $product->cover = null;
        $product->save();
        return Redirect::back();
    }
}
