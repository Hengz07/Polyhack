var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$('#showQuestion').on('shown.bs.modal', function () {
    $(".selCategory").select2({
        placeholder: "Select Category",     
        ajax: {
            url: "/ewp/select2/lookups/category",
            type: "post",   
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term, // search term 
                };
            },
            processResults: function (response) {
                return {
                    results: $.map(response, function (item) {
                        return {
                            text:(item.code + ' - ' + item.text),
                            id: (item.code + '-' + item.text)
                        }
                    })
                };
            },
            cache: true
        }
    }).on('change', function (response) {   
    });
 }); 

//  $('#showSummary').on('shown.bs.modal', function () {

// }); 