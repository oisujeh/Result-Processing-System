jQuery(function ($) {
    $.getJSON('bootstrap/js/countries.json', function (json) {
        var select = $('#countries');
        var codes = $('#codes');
        $.each(json, function (k, v) {
            //console.log(json);
            //console.log(v['name']);
            var option = $('<option />');
            var option2 = $('<option />');
            option.attr('value', v['name'])
				  .html(v['name'])
				  .appendTo(select);

            option2.attr('value', v['code'])
			  .html(v['code'])
			  .appendTo(codes);
        });
    });
});


jQuery(function ($) {
    $.getJSON('https://www.quickairtime.com/webservices/api.php?cmd=11', function (json) {
        var select = $('#icountries');
        var codes = $('#codes');
        $.each(json.MESSAGE, function (k, v) {
            //console.log(json);
            //console.log(v['name']);
            var option = $('<option />');
            var option2 = $('<option />');
            option.attr('value', v['ID'])
				  .html(v['COUNTRY'])
				  .appendTo(select);

            option2.attr('value', v['code'])
			  .html(v['code'])
			  .appendTo(codes);
        });
    });
});



$("#operators").change(function () {
    var operator = this.value;
    var countryid = $('#icountries').val();
    //alert(end);
    // var firstDropVal = $('#pick').val();

    var amountlist = $('#amountlist');
    $.getJSON('../home/getProducts/' + countryid, function (json) {
        var selector = $('<select id="amount" class="form-control" name="product_id"/>');
        //currencydiv.clear();
        var elemet = $('#amount');
        var c = true;
        elemet.remove();
        $.each(json, function (k, v) {

            if (v['LOCAL_LOWER_BOUND'] != null) {
                //currencydiv.text(v['CURRENCY']);

                if (v['OPERATOR_ID'] == operator) {

                    if (c) {

                        amountlist.append("<input type='text' id='amount' class='form-control' required value='" + v['LOCAL_LOWER_BOUND'] + " to " + v['LOCAL_UPPER_BOUND'] + "' name='amount'>");
                        amountlist.append("<input type='hidden' id='product_id' class='form-control' required  value='" + v['PRODUCT_ID'] + "' name='product_id'>");
                        c = false;
                    }

                }
                //amountdiv.val(v['LOCAL_LOWER_BOUND'] + " to " + v['LOCAL_UPPER_BOUND'])

            }

            else {

                if (v['OPERATOR_ID'] == operator) {
                    amountlist.append(

                   selector.append("<option value='" + v['PRODUCT_ID'] + "'>" + v['LOCAL_FACE_VALUE'] + "</option>")

                    );
                }
            }


        });
    });

});








function refreshCountry(passValue) {
    //do something in this function with the value
    window.location = "../home/index?country=" + passValue;
}

$(function () {
           $("#set").click(function () {
               $.ajax({
                   url: "/Admin/_Settings",
                   type: "POST",
                   data: $("#form").serialize(), //if you need to post Model data, use this
                   datatype: "json",
                   success: function (result) {
                       //$("#partial").html(result);
                       alert(result);
                       location.reload();
                   }
               });
           });
       });

        $(function () {
           $("#set1").click(function () {
               $.ajax({
                   url: "/Admin/_Settings2",
                   type: "POST",
                   data: $("#form").serialize(), //if you need to post Model data, use this
                   datatype: "json",
                   success: function (result) {
                       //$("#partial").html(result);
                       alert(result);
                       location.reload();
                   }
               });
           });
       });

       



       //jQuery(function ($) {
       //    $.getJSON('/admin/loadblock', function (json) {
       //        var select = $('#currentblock');
       //        select.empty();
       //        $.each(json, function (k, v) {
       //            //console.log(json);
       //            //console.log(v['name']);
       //            var option = $('<option />');
               
       //            option.attr('value', v['id'])
       //                  .html(v['blockname'])
       //                  .appendTo(select);

       //        });
       //    });
       //});

       //jQuery(function ($) {
       //    $.getJSON('/admin/loadclass', function (json) {
       //        var select = $('#currentclass');
       //        select.empty();
       //        $.each(json, function (k, v) {
       //            //console.log(json);
       //            //console.log(v['name']);
       //            var option = $('<option />');

       //            option.attr('value', v['classid'])
       //                  .html(v['class'])
       //                  .appendTo(select);

       //        });
       //    });
       //});


       //jQuery(function ($) {
       //    $.getJSON('/admin/loadterm', function (json) {
       //        var select = $('#currentterm');
       //        select.empty();
       //        $.each(json, function (k, v) {
       //            //console.log(json);
       //            //console.log(v['name']);
       //            var option = $('<option />');

       //            option.attr('value', v['termid'])
       //                  .html(v['term'])
       //                  .appendTo(select);

       //        });
       //    });
       //});

       //jQuery(function ($) {
       //    $.getJSON('/admin/loadsession', function (json) {
       //        var select = $('#currentsession');
       //        select.empty();
       //        $.each(json, function (k, v) {
       //            //console.log(json);
       //            //console.log(v['name']);
       //            var option = $('<option />');

       //            option.attr('value', v['sessionid'])
       //                  .html(v['session'])
       //                  .appendTo(select);

       //        });
       //    });
       //});

        //$(document).ready(function () {
        //    var ecurrency_name = $('#ecurrency_name').val;
        //    $('#ecurrency_account_label').html(ecurrency_name);
        //});

   
        //$('#ecurrency_name').change(function () {
        //    var ecurrencyname = this.value;
        //    var label_payable_in_naira = $('#label_payable_in_naira');
        //    var label2 = $('#payable_in_Naira');
        //    var label3 = $('#amount_buying');
        //    if (ecurrencyname != null || ecurrencyname != "0" || ecurrencyname != 0) {

        //        label_payable_in_naira.text("Amount in " + ecurrencyname);
        //        $.getJSON('/memberarea/loadamount?ecurrencyname=' + ecurrencyname, function (json) {

        //            //label.text(json.ecurrency_name + " Account");
        //            if (label3.val() != null || label3.val() != "" || label3.val() != 0) {
        //                label2.val(json.we_buy * label3.val());
        //            }
                    


        //        });
        //    }
//});


        //$('#ecurrency_name').change(function () {
        //    var ecurrencyname = this.value;
        //    var label = $('#ecurrency_account_label');
        //    var label2 = $('#payable_in_Naira');
        //    var label3 = $('#amount_buying');
        //    if (ecurrencyname == "NGN") {

        //        $.getJSON('/memberarea/loadamount?ecurrencyname=' + ecurrencyname, function (json) {

        //            //label.text(json.ecurrency_name + " Account");
        //            if (label3.val() != null || label3.val() != "" || label3.val() != 0) {
        //                label2.val(json[1].we_buy * json[0].we_buy * label3.val());
        //            }



        //        });
        //    }
        //    else {
        //        $.getJSON('/memberarea/loadamount?ecurrencyname=' + ecurrencyname, function (json) {

        //            //label.text(json.ecurrency_name + " Account");
        //            if (label3.val() != null || label3.val() != "" || label3.val() != 0) {
        //                label2.val(json[1].we_sell * json[0].we_sell * label3.val());
        //            }



        //        });
        //    }
        //});


        $("#amount_buying").on("input",function (e) {
            var amount = this.value;
            //var ecurrencyname = $("#ecurrency_name").val();
            var label2 = $('#payable_in_Naira');

           

                $.getJSON('/memberarea/loadamount?ecurrencyname=NGN', function (json) {
                    //alert(json.we_buy * amount);
                    label2.val(json[0].we_sell * json[1].we_sell * amount);
                });
           
           

        });

        $("#payable_in_Naira").on("input", function (e) {
            var amount = this.value;
            var ecurrencyname = $("#ecurrency_name").val();
            var label2 = $('#amount_buying');

                 $.getJSON('/memberarea/loadamount?ecurrencyname=NGN', function (json) {
                    //alert(json.we_buy * amount);
                    label2.val((amount/(json[1].we_sell * json[0].we_sell)).toFixed(8));
                });
          
           

        });














        //$('#ecurrency_name2').change(function () {
        //    var ecurrencyname = this.value;
        //    var label = $('#ecurrency_account_label2');
        //    var label_payable_in_naira = $('#label_payable_in_naira2');
        //    var label2 = $('#payable_in_Naira2');
        //    var label3 = $('#amount_selling');
        //    if (ecurrencyname != null || ecurrencyname != "0" || ecurrencyname != 0) {

        //        label_payable_in_naira.text("Amount in " + ecurrencyname);
        //        $.getJSON('/memberarea/loadamount?ecurrencyname=' + ecurrencyname, function (json) {

        //            //label.text(json.ecurrency_name + " Account");
        //            if (label3.val() != null || label3.val() != "" || label3.val() != 0) {
        //                label2.val(json.we_buy * label3.val());
        //            }



        //        });
        //    }
        //});

        $("#amount_selling").on("input", function (e) {
            var amount = this.value;
            //var ecurrencyname = $("#ecurrency_name2").val();
            var label2 = $('#payable_in_Naira2');

            $.getJSON('/memberarea/loadamount?ecurrencyname=NGN', function (json) {
                //alert(json.we_buy * amount);
                label2.val((json[1].we_buy * json[0].we_sell) * amount);
            });

        });


        $("#payable_in_Naira2").on("input", function (e) {
            var amount = this.value;
            //var ecurrencyname = $("#ecurrency_name2").val();
            var label2 = $('#amount_selling');

            $.getJSON('/memberarea/loadamount?ecurrencyname=NGN', function (json) {
                //alert(json.we_buy * amount);
                label2.val((amount / (json[1].we_buy * json[0].we_buy)).toFixed(8));
            });

        });


        $(document).ready(function () {

            $.getJSON("https://www.bitstamp.net/api/v2/ticker/btcusd", function (json) {
                var ask = json.ask;
                $.ajax({
                    url: '/home/updateUsdRate',
                    type: 'POST',
                    data: { usdrate: ask },
                    success: function (ask) {
                        //alert("Current USD Rate: " + ask);
                        console.log("Current USD Rate " + ask);
                    }
                });
            });
        });






       $(document).ready(function () {
           $('[data-toggle="tooltip"]').tooltip();
       });
       $(document).ready(function () {
           $('[data-toggle1="tooltip"]').tooltip();
       });
//jQuery(function ($) {

//    try {
//        Dropzone.autoDiscover = false;
//        $(".dropzone").dropzone({
//            paramName: "file", // The name that will be used to transfer the file
//            maxFilesize: 2.5, // MB
//            maxFiles: 100,
//            acceptedFiles: "image/png, image/gif, image/jpg, image/jpeg",

//            addRemoveLinks: true,
//        });



//    } catch (e) {
//        alert('Dropzone.js does not support older browsers!');
//    }



//});


    
                           //$(function () {
                           //    $('#settings').load('/shared/_Settings');
                           //});
//$(function () {
//    $('#result').load('/inbox/_MessageDropdown');
//});


      
       function onDeleteClick(e) {

           var adminNo = e.target.id;
           var flag = confirm('Are you sure you want to delete ' + adminNo + ' permanently?');
           if (flag) {
               $.ajax({
                   url: '/ManageStudent/DeleteAJAX',
                   type: 'POST',
                   data: { adminNo: adminNo },
                   dataType: 'json',
                   success: function (result) { alert(result); $("#" + adminNo).parent().parent().remove(); },
                   error: function () { alert('Error!'); }
               });
           }
           return false;
       }

       $(document).ready(function () {
           $('#btnExport').click(function () {

               window.location.href = '/ManageStudent/ExportStudent';
               return false;
           });
       });

       $(document).ready(function () {
           $('#btnWORD').click(function () {

               window.location.href = '/ManageStudent/Prepare?id=Word';
               return false;
           });

           $('#btnPDF').click(function () {
               window.location.href = '/ManageStudent/Prepare?id=PDF';
               return false;
           });

           $('#btnImage').click(function () {
               window.location.href = '/ManageStudent/Prepare?id=Image';
               return false;
           });

           $('#btnAdd').click(function () {
               window.location.href = '/ManageStudent/AddStudent';
               return false;
           });
       });

       $(document).ready(function () {
           $('#btnExportr').click(function () {

               window.location.href = '/Result/ExportExcel';
               return false;
           });
       });

       $(document).ready(function () {
           $('#btnWORDr').click(function () {

               window.location.href = '/Result/ReportSheet?id=Word';
               return false;
           });

           $('#btnPDFr').click(function () {
               window.location.href = '/Result/ReportSheet?id=PDF';
               return false;
           });

           $('#btnImager').click(function () {
               window.location.href = '/Result/ReportSheet?id=Image';
               return false;
           });

           $('#btnP4P').click(function () {
               window.location.href = '/Result/Prepare4Print';
               return false;
           });
       });


                         $(document).ready(function () {
            
                             // 1st replace first column header text with checkbox
 
                             $("#checkableGrid th").each(function () {               
                                 if ($.trim($(this).text().toString().toLowerCase()) === "{checkall}") {
                                     $(this).text('');
                                     $("<input/>", { type: "checkbox", id: "cbSelectAll", value: "" }).appendTo($(this));
                                     $(this).append("<span> All</span>");
                                 }
                             });
 
                             //2nd click event for header checkbox for select /deselect all
                             $("#cbSelectAll").click( function () {
                                 var ischecked = this.checked;
                                 $('#checkableGrid').find("input:checkbox").each(function () {
                                     this.checked = ischecked;
                                 });
                             });
 
 
                             //3rd click event for checkbox of each row
                             $("input[name='ids']").click(function () {
                                 var totalRows = $("#checkableGrid td :checkbox").length;
                                 var checked = $("#checkableGrid td :checkbox:checked").length;
 
                                 if (checked == totalRows) {
                                     $("#checkableGrid").find("input:checkbox").each(function () {
                                         this.checked = true;
                                     });
                                 }
                                 else {
                                     $("#cbSelectAll").removeAttr("checked");
                                 }
                             });
 
                         });
       