(function ($) {
    "use strict";
    $(document).ready(function () {

        var Toast = Swal.mixin({
            toast: true,
            position: 'bottom-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        var phoneRules = {
            digits: true,
            required: true,
            minlength: 10,
            maxlength: 10,
            IL_phone: true,
        };
        var signup_profile_rules = {
            // therapist
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            gender: {
                required: true,
            },
            country: {
                required: true,
            },
            phone: phoneRules,
            email: {
                required: true,
                email: true
            },
            license_area: {
                required: true,
            },
            favorite_area: {
                required: true,
            },
            languages: {
                required: true,
            },
            position_type: {
                required: true,
            },
            // family
            patient_name: {
                required: true,
            },
            city: {
                required: true,
            },
            dependency: {
                required: true,
            },
            living_inhouse: {
                required: true,
            },
            nursing_status: {
                required: true,
            },
            contact_person: {
                required: true,
            },
            contact_phone: phoneRules,
            contact_mail: {
                required: true,
            },
            confirm: {
                required: true,
            }
        };

        var forms = {
            'sogo-signup-form': {
                rules: signup_profile_rules,
                action: 'sogo_signup',
                redirect_after: 2500,
                validate_buy_phone: true,
            },
            'sogo-profile-form': {
                rules: signup_profile_rules,
                action: 'sogo_update_profile',
                redirect_after: 2500
            },
            'sogo-signin-form': {
                rules: {
                    // username: {
                    //     required: true,
                    // },
                    // password: {
                    //     required: true,
                    // }
                    phone: phoneRules,
                },
                action: 'sogo_signin',
                redirect_after: 2500,
                validate_buy_phone: true,
            },
            'sogo-resetpassword-form': {
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                action: 'sogo_reset_password',
                redirect_after: 2500
            },
            'front-page-form': {
                rules: {
                    full_name: {
                        required: true,
                    },
                    phone: phoneRules,
                    gender: {
                        required: true,
                    },
                    nursing_status: {
                        required: true,
                    },
                    personal_status: {
                        required: true,
                    },
                    national_insurance_eligibility: {
                        required: true,
                    },
                },
                action: 'sogo_contact_frontpage',
                redirect: sogoc.thank_you_page,
                redirect_after: 2500
            }
        };

        $('input[type="checkbox"]').on('input', function () {
            var $this = $(this);
            if ($this.is(':checked')) {
                $this.prev().val('true');
            } else {
                $this.prev().val('false');
            }
        });

        $('input[type="file"]').on('change', function (e) {

            var reader = new FileReader();
            reader.onload = function () {
                var dataURL = reader.result;
                var output = document.getElementById('avatar-img');
                output.src = dataURL;
            };
            reader.readAsDataURL($(this).prop('files')[0]);

        });

        // Set validator messages
        var messages = {
            he: {
                required: "השדה הזה הינו שדה חובה",
                remote: "נא לתקן שדה זה",
                email: "נא למלא כתובת דוא\"ל חוקית",
                url: "נא למלא כתובת אינטרנט חוקית",
                date: "נא למלא תאריך חוקי",
                dateISO: "נא למלא תאריך חוקי (ISO)",
                number: "נא למלא מספר",
                digits: "נא למלא רק מספרים",
                creditcard: "נא למלא מספר כרטיס אשראי חוקי",
                equalTo: "נא למלא את אותו ערך שוב",
                extension: "נא למלא ערך עם סיומת חוקית",
                maxlength: $.validator.format(".נא לא למלא יותר מ- {0} תווים"),
                minlength: $.validator.format("נא למלא לפחות {0} תווים"),
                rangelength: $.validator.format("נא למלא ערך בין {0} ל- {1} תווים"),
                range: $.validator.format("נא למלא ערך בין {0} ל- {1}"),
                max: $.validator.format("נא למלא ערך קטן או שווה ל- {0}"),
                min: $.validator.format("נא למלא ערך גדול או שווה ל- {0}"),
                IL_phone: 'מספר הטלפון אינו תקין',
            },
            en: {
                required: "This field is required.",
                remote: "Please fix this field.",
                email: "Please enter a valid email address.",
                url: "Please enter a valid URL.",
                date: "Please enter a valid date.",
                dateISO: "Please enter a valid date (ISO).",
                number: "Please enter a valid number.",
                digits: "Please enter only digits.",
                equalTo: "Please enter the same value again.",
                maxlength: $.validator.format("Please enter no more than {0} characters."),
                minlength: $.validator.format("Please enter at least {0} characters."),
                rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
                range: $.validator.format("Please enter a value between {0} and {1}."),
                max: $.validator.format("Please enter a value less than or equal to {0}."),
                min: $.validator.format("Please enter a value greater than or equal to {0}."),
                step: $.validator.format("Please enter a multiple of {0}."),
                IL_phone: 'Phone number is not valid',
            },
            ru: {
                required: "Это поле необходимо заполнить.",
                remote: "Пожалуйста, введите правильное значение.",
                email: "Пожалуйста, введите корректный адрес электронной почты.",
                url: "Пожалуйста, введите корректный URL.",
                date: "Пожалуйста, введите корректную дату.",
                dateISO: "Пожалуйста, введите корректную дату в формате ISO.",
                number: "Пожалуйста, введите число.",
                digits: "Пожалуйста, вводите только цифры.",
                creditcard: "Пожалуйста, введите правильный номер кредитной карты.",
                equalTo: "Пожалуйста, введите такое же значение ещё раз.",
                extension: "Пожалуйста, выберите файл с правильным расширением.",
                maxlength: $.validator.format("Пожалуйста, введите не больше {0} символов."),
                minlength: $.validator.format("Пожалуйста, введите не меньше {0} символов."),
                rangelength: $.validator.format("Пожалуйста, введите значение длиной от {0} до {1} символов."),
                range: $.validator.format("Пожалуйста, введите число от {0} до {1}."),
                max: $.validator.format("Пожалуйста, введите число, меньшее или равное {0}."),
                min: $.validator.format("Пожалуйста, введите число, большее или равное {0}."),
                IL_phone: 'Номер телефона недействителен',
            }
        };

        // Set forms defaults
        $.validator.setDefaults({
            errorClass: 'is-invalid',
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });

        $.validator.messages = messages[sogoc.locale];

        $.validator.addMethod('IL_phone', function (value, element) {
            var regex = new RegExp(/^0(5[^8]|[2-4]|[8-9]|7[0-9])[0-9]{7}$/i);
            return this.optional(element) || regex.test(value);
        }, messages[sogoc.locale ? sogoc.locale : 'he'].IL_phone);


        // Validate all forms
        $.each(forms, function (formId, params) {

            $('#' + formId).validate({
                rules: params.rules,
                submitHandler: function (form) {

                    if (params.validate_buy_phone) {
                        var code = $(form).find('input[name="code"]').val();
                        if (!code || code === '') {
                            var phone = $(form).find('input[name="phone"]').val();
                            validateByPhone(phone, formId);
                            return;
                        }
                    }

                    $(form).find('button[type=submit]').addClass('submit').attr('disabled', true);
                    // process data
                    var data = new FormData;
                    if (!params.action) {
                        console.log('No action declared');
                        return false
                    }
                    data.append("action", params.action);
                    // collect files
                    var $fileInputs = $(form).find('input[type="file"]');
                    $.each($fileInputs, function (i, e) {
                        if (e.files[0]) {
                            data.append(e.name, e.files[0])
                        }
                    });
                    // collect inputs
                    var serializedData = {};
                    $.each($(form).serializeArray(), function () {
                        if (serializedData[this.name]) {
                            return;
                        }
                        serializedData[this.name] = this.value;
                    });
                    $.each(serializedData, function (name, value) {
                        data.append(name, value)
                    });
                    // for (var pair of data.entries()) {
                    //     console.log(pair[0] + ', ' + pair[1]);
                    // }
                    // return;
                    // end process data

                    $.ajax({
                        type: 'POST',
                        url: sogo.ajaxurl,
                        data: data,
                        processData: false, // Don't process the files
                        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                        success: function (res) {
                            if (res.success) {
                                Toast.fire({
                                    icon: 'success',
                                    title: res.data
                                });
                                setTimeout(function () {
                                    if (params.redirect) {
                                        window.location.href = params.redirect;
                                    } else {
                                        window.location.reload();
                                    }
                                }, params.redirect_after ? params.redirect_after : 0);
                                return;
                            }
                            $(form).find('button[type=submit]').removeClass('submit').attr('disabled', false);
                            Toast.fire({
                                icon: 'error',
                                title: res.data
                            });
                        }
                    });
                }
            });


        });

        var $validateModal = $('#validate-user-modal');

        function validateByPhone(phone, formId) {
            $.ajax({
                type: 'POST',
                url: sogo.ajaxurl,
                async: false,
                data: {
                    action: 'sogo_set_validate_buy_phone',
                    phone: phone,
                },
                success: function (res) {
                    if (res.success) {
                        $validateModal.append('<input type="hidden" name="form" value="' + formId + '"/>');
                        $validateModal.append('<input type="hidden" name="phone" value="' + phone + '"/>');
                        $validateModal.modal('toggle');
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: res.data
                        });
                    }
                }
            });
        }

        $('#js-send-code-again').on('click', function () {
            var $this = $(this);
            $.ajax({
                type: 'POST',
                url: sogo.ajaxurl,
                data: {
                    action: 'sogo_send_code_again',
                    phone: $validateModal.find('input[name="phone"]').val(),
                },
                success: function (res) {
                    if (res.success) {
                        Toast.fire({
                            icon: 'success',
                            title: res.data
                        });
                        $this.attr('disabled', true)
                    }
                }
            });
        });

        $validateModal.validate({
            rules: {
                code: {
                    required: true,
                    minlength: 4,
                    maxlength: 4,
                    digits: true,
                }
            },
            submitHandler: function (form) {
                var formToSubmit = $('#' + $(form).find('input[name="form"]').val());
                var code = $(form).find('input[name="code"]').val();
                formToSubmit.append('<input type="hidden" name="code" value="' + code + '"/>');
                $validateModal.modal('toggle');
                formToSubmit.submit();
                return false;
            }
        })
    });
})(jQuery);
