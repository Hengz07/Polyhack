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