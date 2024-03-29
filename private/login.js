// استماع لحدث تقديم النموذج
$("#login-form").submit(function (event) {
    event.preventDefault(); // منع تقديم النموذج بشكل افتراضي

    // جمع بيانات البريد الإلكتروني وكلمة المرور من النموذج
    const email = $("#login_form_email").val();
    const password = $("#login_form_password").val();
    $("#btn_login").html(
        '<i class="fa-solid fa-spinner fa-spin" style="color: #63E6BE;"></i>'
    );
    $("#btn_login").prop("disabled", true);

    // إرسال طلب POST إلى API باستخدام AJAX
    $.ajax({
        url: "/api/login",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            email: email,
            password: password,
        }),
        success: function (data) {
            //console.log(data.message);

            Swal.fire({
                position: "center",
                icon: "success",
                text: "You have logged in successfully. Please wait...",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            }).then((result) => {
                $("#btn_login").prop("disabled", false);
                $("#btn_login").html("Login");
                $("#login-form")[0].reset();
            });
        },
        error: function (xhr, textStatus, errorThrown) {
            Swal.fire({
                position: "center",
                icon: "error",
                text: JSON.parse(xhr.responseText).message,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            }).then((result) => {
                $("#btn_login").prop("disabled", false);
                $("#btn_login").html("Login");
                $("#login-form")[0].reset();
            });
            //console.error(JSON.parse(xhr.responseText).message); // عرض رسالة خطأ تسجيل الدخول
        },
    });
});
