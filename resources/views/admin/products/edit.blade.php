<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Side Navbar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding-top: 48px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
            width: 250px;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .list-group-item {
            border: none;
            background-color: transparent;
            cursor: pointer;
        }

        .list-group-item:hover {
            background-color: #e9ecef;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h3 class="sidebar-heading">CartApp Management System</h3>
        <div class="list-group list-group-flush text-center">

            <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action active">Products</a>
            <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action">Categories</a>
        </div>
    </div>

    <div class="content">
        <div class="container">

            <h2>Edit Product</h2>
            <form id="product-edit-form" method="POST" data-id="{{ $product->id }}">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" required value="{{ $product->title ?? '' }}">
                    <p for="title" class="validation text-danger" id="title-error"></p>

                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" required>{{ $product->description ?? '' }}</textarea>
                    <p for="description" class="validation text-danger" id="description-error"></p>

                </div>

                <div class="form-group">
                    <label for="categories">Categories:</label>
                    <select id="categories" name="categories[]" class="form-control select2" multiple="multiple" required>
                        @foreach ($categories ?? [] as $category)
                            @if (in_array($category->id, $product->categories->pluck('id')->toArray()))
                            <option value="{{ $category->id }}" selected>{{ $category->title }}</option>

                            @else

                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endif
                        @endforeach
                    </select>
                    <p for="categories" class="validation text-danger" id="categories-error"></p>

                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" class="form-control" required value="{{ $product->price }}">
                    <p for="price" class="validation text-danger" id="price-error"></p>

                </div>

                <div class="form-group">
                    <label for="qty">QTY:</label>
                    <input type="number" id="qty" name="qty" class="form-control" required value="{{ $product->quantity ?? '' }}">
                    <p for="qty" class="validation text-danger" id="qty-error"></p>

                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <p for="status" class="validation text-danger" id="status-error"></p>

                </div>

                <div class="form-group">
                    <!-- Your action buttons (e.g., submit) -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script src="{{asset('/js/admin/products.js')}}"></script>
</body>

</html>
