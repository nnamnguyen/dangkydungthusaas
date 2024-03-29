$(document).ready(function () {
    lenInput = $(".row4 input").length;
    for (let i = 0; i < lenInput; i++) {
        $(".row4 input:nth(" + i + ")").focusout(function () {
            if ($(".row4 input:nth(" + i + ")").val() == '') {
                $(".row4 small:nth(" + i + ")").css({ 'display': 'inline' });
            }
            else {
                $(".row4 small:nth(" + i + ")").css({ 'display': 'none' });
            }
        });
        $(".row4 input:nth(" + i + ")").focus(function () {
            $(".row4 small:nth(" + i + ")").css({ 'display': 'none' });
        });
    }
    $('.dangkydungthu').click(function (e) {
        e.preventDefault();
        isEmpty = false;
        for (let i = 0; i < lenInput; i++) {
            getValueInput = $(".row4 input:nth(" + i + ")").val();
            if (getValueInput == '') {
                isEmpty = true;
                break;
            }
        }
        if (isEmpty == false) {
            $.ajax({
                type: "POST",
                url: "./api-php/insertdata.php",
                data: {
                    'name': $(".row4 input#name").val(),
                    'email': $(".row4 input#email").val(),
                    'company': $(".row4 input#company").val(),
                    'phone': $(".row4 input#phone").val(),
                    // 'domain': $(".row4 input#domain").val(),
                },
                caches: false,
                success: function (result) {
                    if(result == 'error'){
                        alert("Đăng ký không thành công!");
                    }
                    else{
                        //insertdata thanh cong, tien hanh tao deployment
                        $.ajax({
                            type: "POST",
                            url: "./api-php/deployment.php",
                            data: {
                                'id_lead': result,
                            },
                            caches: false,
                            success: function (kq) {
                                //tao deployment thanh cong, tien hanh lay external ip va luu va database
                                $.ajax({
                                    type: "POST",
                                    url: "./api-php/getip.php",
                                    data: {
                                        'id_lead_same': result,
                                    },
                                    caches: false,
                                    success: function (kq2) {//thanh cong thi chuyen qua man hinh admis
                                        if(kq2 == 'error'){
                                            alert("Tạo tài khoản không thành công!")
                                        }
                                        else{
                                            // alert(kq2);      
                                            window.location.href = "./pageadmin/index.php"; 
                                        }  
                                        // alert(kq2);                       
                                    }
                                })                               
                            }
                        })
                    }
                }
            });
        }
        else {
            for (let i = 0; i < lenInput; i++) {
                if ($(".row4 input:nth(" + i + ")").val() == '') {
                    $(".row4 small:nth(" + i + ")").css({ 'display': 'inline' });
                }
            }
        }
    });
});