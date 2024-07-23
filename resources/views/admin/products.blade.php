<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side Navbar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
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
            <a href="{{ route('logout') }}" class="list-group-item list-group-item-action">Log Out</a>
        </div>
    </div>

    <div class="content">
        <div class="container">

            <h2>Products</h2>
            <div>
                <a class="btn btn-info btn-sm add-product" href="{{ route('products.create') }}" >Add Product</a>
            </div>
            <table id="products-table" class="table table-responsive">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Categories</th>
                        <th>Price</th>
                        <th>QTY</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('/js/admin/products.js')}}"></script>
</body>

</html>
