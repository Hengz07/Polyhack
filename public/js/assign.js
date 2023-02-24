var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function() {
    $(function() {
        $('.chk-box').click(function() {
            $('.chk_box_sub').prop('checked',this.checked);
        });
    });
    
    $(function() {
        $('#saveall').click(function() {
            var checks = $("input[class='chk_box_sub']:checked"); 
            // console.log(checks.val());

            if(checks.length > 0){
                var selectId = [];
                for(var i=0; i<checks.length; i++){
                    selectId.push($(checks[i]).val());
                    // console.log (selectId);
                }
                
                $.get("/ewp/assign/create",
                {
                    inputname: $(this).data('selectId'),
                    routename: $(this).data('route-name'),
                },
                function (data, status) {  
                    // $('#sid').val('i');
                    $('#showOfficer').find('#modal-title')[0].innerHTML = 'Select Officer';
                    $('#showOfficer').find('#modal-body')[0].innerHTML = data;
                    $('#showOfficer').modal();
                    document.getElementById("sid").value = selectId;
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select student!',
                })
            }
        })
    })

    $(function(){
        $(".selFilterSession").select2({ 
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
                                id: item.id, 
                            } 
                        }) 
                    }; 
                }, 
                cache: true 
            } 
        }).on('change', function (response) {   
        })

        $(".selFilterSemester").select2({ 
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
        })     

        $(".selFilterFaculty").select2({
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
        })

        $(".selFilterStatus").select2({
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
        })

        $(".selFilterOfficer").select2({
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
                                uuid:item.uuid, 
                                text: item.officer, 
                            } 
                        }) 
                    }; 
                }, 
                cache: true 
            }
        }) 
    })
});


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


//SPECIFIC RECORD JS
 function myFunction() {
    var Rujuk = document.getElementById("Rujuk");
    var statcat = document.getElementById("statcat");

    var refercheckbox = document.getElementsByName("refer[]");
    // console.log(refercheckbox);
    
    if (Rujuk.checked == true){
        statcat.style.display = "block";
    } else {
        statcat.style.display = "none";
        refercheckbox.check = false;
    }
}