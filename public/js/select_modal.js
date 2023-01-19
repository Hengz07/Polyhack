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

window.onload = function(){
    $("#selFilterSession").select2({
        placeholder: "- Pilih Sesi -",     
        ajax: {
            url: "/ewp/select2/session",
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
                            text: item.session,
                        }
                    })
                };
            },
            cache: true
        }
    }).on('change', function (response) {
    });                 

    $("#selFilterSemester").select2({
        placeholder: "- Pilih Semester -",     
        ajax: {
            url: "/ewp/select2/semester",
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
                            text: item.semester,
                        }
                    })
                };
            },
            cache: true
        }
    }).on('change', function (response) {
    });          

    $("#selFilterFaculty").select2({
        placeholder: "- Pilih Fakulti -",     
        ajax: {
            url: "/ewp/select2/faculty",
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
                            text: item.faculty,
                        }
                    })
                };
            },
            cache: true
        }
    }).on('change', function (response) {
    });

    $("#selFilterStatus").select2({
        placeholder: "- Pilih Status -",     
        ajax: {
            url: "/ewp/select2/status",
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
                            text: item.status,
                        }
                    })
                };
            },
            cache: true
    }
    }).on('change', function (response) {
    });

    $("#selFilterOfficer").select2({
        placeholder: "- Pilih Pegawai -",     
        ajax: {
            url: "/ewp/select2/officer",
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
                            text: item.officer,
                        }
                    })
                };
            },
            cache: true
        }
    }).on('change', function (response) {
    });
};

$('#showOfficer').on('shown.bs.modal', function () {
    $(".selModalOfficer").select2({
        placeholder: "- Select Officer -",     
        ajax: {
            url: "/ewp/select2/modalOfficer",
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
                            text:(item.text),
                            id: (item.id)
                        }
                    })
                };
            },
            cache: true
        }
    }).on('change', function (response) {   
    });
 }); 