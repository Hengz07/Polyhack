$(document).ready(function () {

    $('.sa-warning1').click(function (e) {
        
        route   = $(this).data('route');
        id      = $(this).data('id');
        adopted = $(this).data('adopted');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#remove').attr('action', (adopted == undefined ?'':'../../')+route + "/" + id).submit();
            }
        })
    });
});

//datatable delete function
$(document).on( "click",".datatable-delete", function(e) { //logic here 
    e.stopImmediatePropagation();
    var uuid  = $(this).data('uuid');
    var route = $(this).data('route');
    var tablename = $(this).data('table-name');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: route,
                type:"DELETE",
                data:{
                    _token: CSRF_TOKEN,
                    // uuid: uuid
                },
                success:function(response){
                    Swal.fire({
                        title : response.title,
                        text  : response.message,
                        icon  : response.status
                    }).then(function(){
                        $('#' + tablename ).DataTable().ajax.reload();//datatable refresh
                    });
                },
                error: function(error) {
                    $('#' + tablename).DataTable().ajax.reload();//datatable refresh
                }
            });
        }
    })
});
