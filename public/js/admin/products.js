$(document).ready(function() {
    $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, 'asc']],
        ajax: {
            url: "/admin/products/list",
            type: "GET"
        },
        columns: [
            { data: 'title'},
            { data: 'description'},
            { data: 'categories',
                orderable: false,
                searchable: false,
                render: function(data, type, full, meta) {
                    var categoryNames = data.map(function(category) {
                        return category.title;
                    }).join(', ');
                    return categoryNames;
                }
            },
            { data: 'price'},
            { data: 'quantity'},
            { data: 'status' },
            {
                data: 'id' ,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <a class="btn btn-info btn-sm edit-product" href="/admin/products/edit/${row.id}">Edit</a>
                        <button class="btn btn-danger btn-sm delete-product" data-id="${row.id}">Delete</button>
                    `;
                }
            }
        ],
    });

    $("#product-form").on("submit", function (e) {
        e.preventDefault();
        $(".validation").html("")
        $.ajax({
            type: "post",
            url: "/admin/products/store",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "title" : $("#title").val(),
                "description" : $("#description").val(),
                "categories" : $("#categories").val(),
                "price" : $("#price").val(),
                "qty" : $("#qty").val(),
                "status" : $("#status").val(),
            },
            success: function (response) {
                location.href = "/admin/products"
            },
            error: function (xhr, status, error) {
                if(xhr.status == 422){
                    var errors = xhr.responseJSON.errors;

                    for (const key in errors) {
                    $('#'+key+'-error').text(errors[key][0]);

                    }
                }

                if(xhr.status == 401){
                    $('#message-error').text(xhr.responseJSON.message);
                }
            }
        });
     })

    $("#product-edit-form").on("submit", function (e) {
        e.preventDefault();
        $(".validation").html("")
        id = $(this).attr("data-id")
        console.log(id);
        $.ajax({
            type: "post",
            url: "/admin/products/update/"+id,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "title" : $("#title").val(),
                "description" : $("#description").val(),
                "categories" : $("#categories").val(),
                "price" : $("#price").val(),
                "qty" : $("#qty").val(),
                "status" : $("#status").val(),
            },
            success: function (response) {
                location.href = "/admin/products"
            },
            error: function (xhr, status, error) {
                if(xhr.status == 422){
                    var errors = xhr.responseJSON.errors;

                    for (const key in errors) {
                    $('#'+key+'-error').text(errors[key][0]);

                    }
                }

                if(xhr.status == 401){
                    $('#message-error').text(xhr.responseJSON.message);
                }
            }
        });
     })
});
