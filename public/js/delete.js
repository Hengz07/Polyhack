$(document).ready(function () {

    $('.sa-warning').click(function (e) {
        
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
               
                $('#remove').attr('action', (adopted == undefined ?'':'../../')+route+ "/" + id).submit();
            }
        })
    });
   
});
