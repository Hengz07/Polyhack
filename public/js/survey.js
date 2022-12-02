$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    });

    var qCounting = 21;
    function pilih(i){
        var inputs = document.getElementById("formsubmit").elements;
        count=0;
        for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type == 'radio' && inputs[i].checked) {
                count++;
                document.getElementById("count").innerHTML =  count;
            }
        }
        // document.getElementById("totals").innerHTML =  qCounting;
    // console.log(count +'-'+qCounting);
    if(count == 21 )
    
    $("#submit").removeAttr("disabled");
    }
    
    $(document).ready(function(e) {


    $('#formsubmit').on('submit' , function(e){

    e.preventDefault();
    var data = $('#formsubmit').serializeArray();
    var id = "{{ $uuid }}";
    submitformSwal(data,id);
    });
    });

    function submitformSwal(datas,ids){
        swal.fire({
                title: "Simpan",
                text: "Maklumat yang diberikan adalah sulit",
                icon: "warning",
                buttons: true,
                closeOnConfirm: true,
                })
                .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        url: "/ewp/survey/save",
                        method:"POST",
                        dataType: "json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "q": JSON.stringify(datas),
                            "id": ids,
                            },
                        success: function(data){   
                            $("#formsubmit")[0].reset();
                            swal.fire('Terima Kasih ,Maklumat Disimpan');
                            readProducts();
                        }
                    });
                }
                });
                }
                function readProducts(){
                window.location.href="/ewp/dashboards/staff_dash";	
                }