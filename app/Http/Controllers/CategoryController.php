<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function list(Request $request)
    {

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $columns = [
            'title',
            'description',
            'image',
            'status',
        ];
        $orderColumn = $columns[$request->order[0]['column']];
        $orderDirection = $request->order[0]['dir'];

        $categories = Category::query();
        $totalRecords = $categories->count();

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $categories->where(function ($query) use ($search, $columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
        }

        $totalRecordsFiltered = $categories->count();

        if ($request->has('order')) {
            $categories->orderBy($orderColumn, $orderDirection);
        }


        $categories->skip($start)->take($length);

        $data = $categories->get();

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
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $category = Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image ?? fake()->filePath(),
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message'=> 'Success!'
        ]);
    }
    public function edit(Request $request, $id)
    {
        $category = Category::find([
            'id' => $id
        ])->first();


        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image ?? fake()->filePath(),
            'status' => $request->status,
        ]);


        return response()->json([
            'status' => true,
            'message'=> 'Product updated successfully!',
        ]);
    }
}
