var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$('.showModal').on('click', function () {

    route = $(this).data('route');
    title = $(this).data('title');
    id = $(this).data('id');

    method = $(this).data('method');
    methodtitle = $(this).data('method-title');

    if (methodtitle == undefined) {
        title = (id == undefined ? 'Add ' : 'Edit ') + title; //if id =undefined, id = add else = edit
    } else {
        title = methodtitle + ' Form';
    }
    if (method == undefined) {
        method = id == undefined ? 'create' : id + '/edit';
    } else { method = id + '/' + method; }

    $.get("/" + route + '/' + method,
    {
        fid: $(this).data('faculty-id'),
        uuid: $(this).data('uuid'),
        inputname: $(this).data('input-name'),
        routename: $(this).data('route-name'),
    },
    
    function (data, status) {
        $('#showModal').find('#modal-title')[0].innerHTML = title;
        $('#showModal').find('#modal-body')[0].innerHTML = data;
        $('#showModal').modal();

    });

    // For Moving

});

/** Question Modal **/
$('.showQuestion').on('click', function () { 
    route = $(this).data('route');
    title = $(this).data('title');
    id = $(this).data('id');

    method = $(this).data('method');
    methodtitle = $(this).data('method-title');

    if (methodtitle == undefined) {
        title = (id == undefined ? 'Add ' : 'Edit ') + title; //if id =undefined, id = add else = edit
    } else {
        title = methodtitle + ' Form';
    }
    if (method == undefined) {
        method = id == undefined ? 'create' : id + '/edit';
    } else { method = id + '/' + method; }

    $.get("/" + route + '/' + method,
        {
            inputname: $(this).data('input-name'),
            routename: $(this).data('route-name'),
        },
        function (data, status) { 
            $('#showQuestion').find('#modal-title')[0].innerHTML = title;
            $('#showQuestion').find('#modal-body')[0].innerHTML = data;
            $('#showQuestion').modal();

            $(document).ready(function (e) {
                // $('input[type=text],textarea[type=text]').keyup(function () {
                //     $(this).val($(this).val().toUpperCase());
                // });

                $('.number').bind('keypress', function (e) {
                    return !(e.which != 8 && e.which != 0 &&
                        (e.which < 48 || e.which > 57) && e.which != 46);
                });
            });

        });

    // For Moving
});

/** Scale Modal **/
$('.showScale').on('click', function () { 
    route = $(this).data('route');
    title = $(this).data('title');
    id = $(this).data('id');

    method = $(this).data('method');
    methodtitle = $(this).data('method-title');

    if (methodtitle == undefined) {
        title = (id == undefined ? 'Add ' : 'Edit ') + title; //if id =undefined, id = add else = edit
    } else {
        title = methodtitle + ' Form';
    }
    if (method == undefined) {
        method = id == undefined ? 'create' : id + '/edit';
    } else { method = id + '/' + method; }

    $.get("/" + route + '/' + method,
        {
            inputname: $(this).data('input-name'),
            routename: $(this).data('route-name'),
        },
        function (data, status) { 
            $('#showScale').find('#modal-title')[0].innerHTML = title;
            $('#showScale').find('#modal-body')[0].innerHTML = data;
            $('#showScale').modal();

            $(document).ready(function (e) {
                // $('input[type=text],textarea[type=text]').keyup(function () {
                //     $(this).val($(this).val().toUpperCase());
                // });

                $('.number').bind('keypress', function (e) {
                    return !(e.which != 8 && e.which != 0 &&
                        (e.which < 48 || e.which > 57) && e.which != 46);
                });
            });

        });

    // For Moving
});

/** ScheduleModal **/
$('.showSchedule').on('click', function () { 
    //console.log('test');
    route = $(this).data('route');
    title = $(this).data('title');
    id = $(this).data('id');
    //console.log(route);
    method = $(this).data('method');
    methodtitle = $(this).data('method-title');

    if (methodtitle == undefined) {
        title = (id == undefined ? 'Add ' : 'Edit ') + title; //if id =undefined, id = add else = edit
    } else {
        title = methodtitle + ' Form';
    }
    if (method == undefined) {
        method = id == undefined ? 'create' : id + '/edit';
    } else { method = id + '/' + method; }

    $.get("/" + route + '/' + method,
        {
            inputname: $(this).data('input-name'),
            routename: $(this).data('route-name'),
        },
        function (data, status) { 
            $('#showSchedule').find('#modal-title')[0].innerHTML = title;
            $('#showSchedule').find('#modal-body')[0].innerHTML = data;
            $('#showSchedule').modal();

            $(document).ready(function (e) {
                // $('input[type=text],textarea[type=text]').keyup(function () {
                //     $(this).val($(this).val().toUpperCase());
                // });

                $('.number').bind('keypress', function (e) {
                    return !(e.which != 8 && e.which != 0 &&
                        (e.which < 48 || e.which > 57) && e.which != 46);
                });
            });

        });

    // For Moving
});

$('.showReport').on('click', function () { 
    route = $(this).data('route');
    title = $(this).data('title');
    id = $(this).data('id');

    method = $(this).data('method');
    methodtitle = $(this).data('method-title');

    if (methodtitle == undefined) {
        title = 'Verification'; //if id =undefined, id = add else = edit
    } else {
        title = methodtitle + ' Form';
    }
    if (method == undefined) {
        method = 'create';
    } else { method = id + '/' + method; }

    $.get("/" + route + '/' + method,
        {
            inputname: $(this).data('input-name'),
            routename: $(this).data('route-name'),
        },
        function (data, status) { 
            $('#showReport').find('#modal-title')[0].innerHTML = title;
            $('#showReport').find('#modal-body')[0].innerHTML = data;
            $('#showReport').modal();

            $(document).ready(function (e) {
                // $('input[type=text],textarea[type=text]').keyup(function () {
                //     $(this).val($(this).val().toUpperCase());
                // });

                $('.number').bind('keypress', function (e) {
                    return !(e.which != 8 && e.which != 0 &&
                        (e.which < 48 || e.which > 57) && e.which != 46);
                });
            });

        });

    // For Moving
});

$('.showSaringanInfo').on('click', function () { 
    route = $(this).data('route');
    title = $(this).data('title');
    id = $(this).data('id');

    method = $(this).data('method');
    methodtitle = $(this).data('method-title');

    if (methodtitle == undefined) {
        title = 'Report'; //if id =undefined, id = add else = edit
    } else {
        title = methodtitle + ' Information';
    }
    if (method == undefined) {
        method = 'information';
    } else { method = id + '/' + method; }

    $.get("/" + route + '/' + method,
        {
            inputname: $(this).data('input-name'),
            routename: $(this).data('route-name'),
        },
        function (data, status) { 
            $('#showSaringanInfo').find('#modal-title')[0].innerHTML = title;
            $('#showSaringanInfo').find('#modal-body')[0].innerHTML = data;
            $('#showSaringanInfo').modal();

            $(document).ready(function (e) {
                // $('input[type=text],textarea[type=text]').keyup(function () {
                //     $(this).val($(this).val().toUpperCase());
                // });

                $('.number').bind('keypress', function (e) {
                    return !(e.which != 8 && e.which != 0 &&
                        (e.which < 48 || e.which > 57) && e.which != 46);
                });
            });

        });

    // For Moving
});

$('.showOfficer').on('click', function () { 
    route = $(this).data('route');
    title = $(this).data('title');
    id = $(this).data('id');

    method = $(this).data('method');
    methodtitle = $(this).data('method-title');

    if (methodtitle == undefined) {
        title = 'Select'; //if id =undefined, id = add else = edit
    } else {
        title = methodtitle + ' Officer';
    }
    if (method == undefined) {
        method = 'create';
    } else { method = id + '/' + method; }

    $.get("/" + route + '/' + method,
        {
            inputname: $(this).data('input-name'),
            routename: $(this).data('route-name'),
        },
        function (data, status) { 
            $('#showOfficer').find('#modal-title')[0].innerHTML = title;
            $('#showOfficer').find('#modal-body')[0].innerHTML = data;
            $('#showOfficer').modal();

            $(document).ready(function (e) {
                // $('input[type=text],textarea[type=text]').keyup(function () {
                //     $(this).val($(this).val().toUpperCase());
                // });

                $('.number').bind('keypress', function (e) {
                    return !(e.which != 8 && e.which != 0 &&
                        (e.which < 48 || e.which > 57) && e.which != 46);
                });
            });

        });

    // For Moving
});

$('.showSummary').on('click', function () { 
    
    

    route = $(this).data('route');
    title = $(this).data('title');
    id = $(this).data('id');

    method = $(this).data('method');
    methodtitle = $(this).data('method-title');

    if(methodtitle == undefined){
        title  = (id == undefined ?'Add ':'Edit ')+title;
    } else {
        title = methodtitle + ' Form';
    } 
    
    if(method == undefined){
        method = id == undefined ? 'create': id + '/edit';
    } else {
        method = id +'/'+ method;
    }

    $.get("/" + route + '/' + method,
        {
            inputname: $(this).data('input-name'),
            routename: $(this).data('route-name'),
        },
        function (data, status) { 
            $('#showSummary').find('#modal-title')[0].innerHTML = title;
            $('#showSummary').find('#modal-body')[0].innerHTML = data;
            $('#showSummary').modal();

            $(document).ready(function (e) {
                // $('input[type=text],textarea[type=text]').keyup(function () {
                //     $(this).val($(this).val().toUpperCase());
                // });

                $('.number').bind('keypress', function (e) {
                    return !(e.which != 8 && e.which != 0 &&
                        (e.which < 48 || e.which > 57) && e.which != 46);
                });
            });

        });
    // For Moving
});

$('.showIntervention').on('click', function () { 
    route = $(this).data('route');
    title = $(this).data('title');
    id = $(this).data('id');

    method = $(this).data('method');
    methodtitle = $(this).data('method-title');

    if (methodtitle == undefined) {
        title = 'Survey'; //if id =undefined, id = add else = edit
    } else {
        title = methodtitle + ' Answers';
    }
    if (method == undefined) {
        method = 'answers';
    } else { method = id + '/' + method; }

    $.get("/" + route + '/' + method,
        {
            inputname: $(this).data('input-name'),
            routename: $(this).data('route-name'),
        },
        function (data, status) { 
            $('#showAnswers').find('#modal-title')[0].innerHTML = title;
            $('#showAnswers').find('#modal-body')[0].innerHTML = data;
            $('#showAnswers').modal();

            $(document).ready(function (e) {
                // $('input[type=text],textarea[type=text]').keyup(function () {
                //     $(this).val($(this).val().toUpperCase());
                // });

                $('.number').bind('keypress', function (e) {
                    return !(e.which != 8 && e.which != 0 &&
                        (e.which < 48 || e.which > 57) && e.which != 46);
                });
            });

        });

    // For Moving
});