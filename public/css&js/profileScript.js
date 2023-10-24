$(document).ready(function () {
    
    $("#fEditUser").submit(function (e) {
        var nameInput = $("#name").val();
        var telephoneInput = $("#tele").val();

        var nameRegex = /^[A-Za-z\s'-\.]{2,50}$/;
        var telephoneRegex = /^(\+212\d{9})*$/;

        if (!nameRegex.test(nameInput)) {
            e.preventDefault(); // Prevent form submission
            $("#name").next().removeClass("d-none");
        } else {
            $("#name").next().addClass("d-none");
        }

        if (!telephoneRegex.test(telephoneInput)) {
            $("#tele").next().removeClass("d-none");
            e.preventDefault(); // Prevent form submission
        } else {
            $("#tele").next().addClass("d-none");
        }
    });

    $("#fAddPc").submit(function (e) {
        var nameInput = $("#nameCompt").val();
        var originInput = $("#Origine").val();
        var PriceInput = $("#Price").val();

        var nameRegex = /^[A-Za-z\s'-]{2,50}$/;
        var PriceRegex = /^\d+(\.\d{1,2})?$/;

        if (!nameRegex.test(nameInput)) {
            e.preventDefault(); // Prevent form submission
            $("#nameCompt").next().removeClass("d-none");
        } else {
            $("#nameCompt").next().addClass("d-none");
        }

        if (!nameRegex.test(originInput)) {
            e.preventDefault(); // Prevent form submission
            $("#Origine").next().removeClass("d-none");
        } else {
            $("#Origine").next().addClass("d-none");
        }

        if (!PriceRegex.test(PriceInput)) {
            e.preventDefault(); // Prevent form submission
            $("#Price").next().removeClass("d-none");
        } else {
            $("#Price").next().addClass("d-none");
        }

        if ($("#imagePc").val() != "") {
            // alert($("#imagePc").val())
            $("#msgRequired").addClass("d-none");
            var fileInput = $("#imagePc")[0];
            var fileSize = fileInput.files[0].size; // Get the size of the selected file in bytes
            var maxSize = 10 * 1024 * 1024; // 10MB in bytes
            if (fileSize > maxSize) {
                e.preventDefault(); // Prevent form submission
                $("#msgSize").removeClass("hidden");
                // $("#image").val("");
            } else {
                $("#msgSize").addClass("hidden");
            }
        } else {
            e.preventDefault(); // Prevent form submission
            $("#msgRequired").removeClass("d-none");
        }
    });

    $("#feditPc").submit(function (e) {
        var nameInput = $("#nameComptEdit").val();
        var originInput = $("#OrigineEdit").val();
        var PriceInput = $("#PriceEdit").val();

        var nameRegex = /^[A-Za-z\s'-\.]{2,50}$/;
        var PriceRegex = /^\d+(\.\d{1,2})?$/;

        if (!nameRegex.test(nameInput)) {
            e.preventDefault(); // Prevent form submission
            $("#nameComptEdit").next().removeClass("d-none");
        } else {
            $("#nameComptEdit").next().addClass("d-none");
        }

        if (!nameRegex.test(originInput)) {
            e.preventDefault(); // Prevent form submission
            $("#OrigineEdit").next().removeClass("d-none");
        } else {
            $("#OrigineEdit").next().addClass("d-none");
        }

        if (!PriceRegex.test(PriceInput)) {
            e.preventDefault(); // Prevent form submission
            $("#PriceEdit").next().removeClass("d-none");
        } else {
            $("#PriceEdit").next().addClass("d-none");
        }

        var fileInput = $("#imagePcEdit")[0];
        var fileSize = fileInput.files[0].size; // Get the size of the selected file in bytes
        var maxSize = 10 * 1024 * 1024; // 10MB in bytes
        if (fileSize > maxSize) {
            e.preventDefault(); // Prevent form submission
            $("#msgSizeEdit").removeClass("hidden");
            // $("#image").val("");
        } else {
            $("#msgSizeEdit").addClass("hidden");
        }
    });

    $("#fEditImgProfile").submit(function (e) {
        if ($("#imageUserEdit").val() != "") {
            $("#msgRequiredEditProfile").addClass("d-none");
            var fileInput = $("#imageUserEdit")[0];
            var fileSize = fileInput.files[0].size; // Get the size of the selected file in bytes
            var maxSize = 10 * 1024 * 1024; // 10MB in bytes
            if (fileSize > maxSize) {
                e.preventDefault(); // Prevent form submission
                $("#msgSizeEditProfile").removeClass("hidden");
                // $("#image").val("");
            } else {
                $("#msgSizeEditProfile").addClass("hidden");
            }
        } else {
            e.preventDefault(); // Prevent form submission
            $("#msgRequiredEditProfile").removeClass("d-none");
        }
    });
});
