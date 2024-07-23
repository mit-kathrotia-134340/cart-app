$(document).ready(function() {
    $('#categories-table').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, 'asc']],
        ajax: {
            url: "/admin/categories/list",
            type: "GET"
        },
        columns: [
            { data: 'title'},
            { data: 'description'},
            { data: 'image'},
            { data: 'status' },
            {
                data: 'id' ,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <a class="btn btn-info btn-sm edit-category" href="/admin/categories/edit/${row.id}">Edit</a>
                        <button class="btn btn-danger btn-sm delete-category" data-id="${row.id}">Delete</button>
                    `;
                }
            }
        ],
    });

    $("#category-form").on("submit", function (e) {
        e.preventDefault();
        $(".validation").html("")
        $.ajax({
            type: "post",
            url: "/admin/categories/store",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "title" : $("#title").val(),
                "description" : $("#description").val(),
                "status" : $("#status").val(),
            },
            success: function (response) {
                location.href = "/admin/categories"
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

    $("#category-edit-form").on("submit", function (e) {
        e.preventDefault();
        $(".validation").html("")
        id = $(this).attr("data-id")
        console.log(id);
        $.ajax({
            type: "post",
            url: "/admin/categories/update/"+id,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "title" : $("#title").val(),
                "description" : $("#description").val(),
                "status" : $("#status").val(),
            },
            success: function (response) {
                location.href = "/admin/categories"
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
