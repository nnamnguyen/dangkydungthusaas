$(document).ready(function () {
    var endDatetime = $("p#end_datetime").text();
    var countDownDate = new Date(endDatetime).getTime();
    var days = 0;
    var hours = 0;
    var minutes = 0;
    var seconds = 0;
    var x = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        days = Math.floor(distance / (1000 * 60 * 60 * 24));
        hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        seconds = Math.floor((distance % (1000 * 60)) / 1000);
        $('#days').text(days);
        $('#hours').text(hours);
        $('#minutes').text(minutes);
        $('#seconds').text(seconds);

        // If the count down is over, write some text 
        // if (distance < 0) {
        //     clearInterval(x);
        //     document.getElementById("demo").innerHTML = "EXPIRED";
        // }
    }, 1000);
    $('#linktomysite').click(function (e) {
        // e.preventDefault();
        aLink = $('#linktomysite').text();
        location.href = '//' + aLink;
    });
    $('.ngungsudung').click(function (e) {
        e.preventDefault();
        var Id_lead = $(".ngungsudung").attr("data-id");
        $.ajax({
            type: "POST",
            url: "../api-php/stopdeployment.php",
            data: {
                'id_lead': Id_lead,
            },
            caches: false,
            success: function (kq) {
                if(kq == 'success'){
                    alert('Ngừng sử dụng thành công!');
                    window.location.href = "../pageadmin/index.php";
                }
                else{
                    alert("Thao tác không thành công!");
                }                           
            }
        })
    });
    $('.giahan').click(function (e) {
        e.preventDefault();
        var Id_lead_giahan = $(".giahan").attr("data-id");
        $.ajax({
            type: "POST",
            url: "../api-php/extenddeployment.php",
            data: {
                'id_lead': Id_lead_giahan,
            },
            caches: false,
            success: function (kq) {
                if(kq == 'success'){
                    alert('Đang xử lý! Nhấn OK để chờ quá trình!');
                    window.location.href = "../pageadmin/index.php";
                    $.ajax({
                        type: "POST",
                        url: "../api-php/getip.php",
                        data: {
                            'id_lead_same': Id_lead_giahan,
                        },
                        caches: false,
                        success: function (kq2) {//thanh cong thi chuyen qua man hinh admis
                            if(kq2 == 'error'){
                                alert("Gia hạn không thành công!")
                            }
                            else{
                                // alert(kq2);      
                                // window.location.href = "./pageadmin/admis.php"; 
                                alert("Gia hạn thành công!")
                            }  
                            // alert(kq2);                       
                        }
                    })
                }
                else{
                    alert("Gia hạn không thành công!");
                }                           
            }
        })
    });
    $('.btnrollback').click(function (e) {
        e.preventDefault();
        window.location.href = "../pageadmin/index.php";
    });
});