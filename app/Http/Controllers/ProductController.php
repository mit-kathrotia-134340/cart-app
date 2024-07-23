<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function list(Request $request)
    {

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $columns = [
            'title',
            'description',
            'price',
            'status',
            'quantity',
        ];
        $orderColumn = $columns[$request->order[0]['column']];
        $orderDirection = $request->order[0]['dir'];

        $products = Product::with('categories:title');
        $totalRecords = $products->count();

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $products->where(function ($query) use ($search, $columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
        }

        $totalRecordsFiltered = $products->count();

        if ($request->has('order')) {
            $products->orderBy($orderColumn, $orderDirection);
        }


        $products->skip($start)->take($length);

        $data = $products->get();

        $response = [
            'draw' => $request->draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecordsFiltered,
            'data' => $data,
        ];

        return response()->json($response);
    }

    public function create()
    {
        $categories = DB::table('categories')->select(['id', 'title'])->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->qty,
            'status' => $request->status,
        ]);

        $product->categories()->attach($request->categories);

        return response()->json([
            'status' => true,
            'message'=> 'Success!'
        ]);
    }
    public function edit(Request $request, $id)
    {
        $product = Product::find([
            'id' => $id
        ])->first();
        $categories = DB::table('categories')->select(['id', 'title'])->get();


        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->qty,
            'status' => $request->status,
        ]);


        $product->categories()->sync($request->categories);

        return response()->json([
            'status' => true,
            'message'=> 'Product updated successfully!',
        ]);
    }
}
