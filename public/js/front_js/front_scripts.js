$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /* $("#sort").on('change',function() {
        this.form.submit();
    }); */

    $("#sort").on('change', function () {
        //alert("Test");
        var sort = $(this).val();
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occassion = get_filter('occassion');
        //alert(sort);
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                fit: fit,
                occassion: occassion,
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter_products').html(data);
            }
        });
    });


    $(".fabric").on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occassion = get_filter('occassion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                fit: fit,
                occassion: occassion,
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter_products').html(data);
            }
        });
    });

    $(".sleeve").on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occassion = get_filter('occassion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                fit: fit,
                occassion: occassion,
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter_products').html(data);
            }
        });
    });

    $(".pattern").on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occassion = get_filter('occassion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                fit: fit,
                occassion: occassion,
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter_products').html(data);
            }
        });
    });

    $(".fit").on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occassion = get_filter('occassion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                fit: fit,
                occassion: occassion,
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter_products').html(data);
            }
        });
    });

    $(".occassion").on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occassion = get_filter('occassion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                fit: fit,
                occassion: occassion,
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter_products').html(data);
            }
        });
    });

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;
    }

    $("#getPrice").change(function () {
        var size = $(this).val();
        var product_id = $(this).attr("product_id");
        $.ajax({
            url: '/get-product-price',
            type: "POST",
            data: {
                size: size,
                product_id: product_id
            },
            success: function (resp) {
                //alert(resp)
                $('.getAttrPrice').html("$" + resp + "");
            }
        });
    });




    $('.ajxValuClass').click(function (e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.AjaxInputNum').focusin(function () {
        $(this).data('oldValue', $(this).val());
    });
    $('.AjaxInputNum').change(function () {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".ajxValuClass[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".ajxValuClass[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".AjaxInputNum").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


});
