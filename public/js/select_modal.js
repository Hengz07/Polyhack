$('#showModal').on('shown.bs.modal', function () {
    $(".selCategory").select2({
        placeholder: "Select Category", 
        ajax: {
            url: "/select2/Lookups/category",
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
                            text: item.text,
                            id: item.code
                        }
                    })
                };
            },
            cache: true
        }
    }).on('change', function (response) {   
    });
 });


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