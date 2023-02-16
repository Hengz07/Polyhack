var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
window.onload = function(){
    // console.log( "ready!" );
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
                            id: item.id, 
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
                            id: item.id,
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
                            id: item.id,
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
                            id: item.id,
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
                            id: item.id, 
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