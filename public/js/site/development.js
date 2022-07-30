$.validator.addMethod("valid_email", function (value, element) {
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid email");

// Phone number eg. (+91)9876543210
$.validator.addMethod("valid_number", function (value, element) {
    if (/^(?:[+]9)?[0-9]+$/.test(value)) {
        return true;
    } else {
        return false;
    }

}, "Please enter a valid phone number.");

// Phone number eg. +919876543210
$.validator.addMethod("valid_site_number", function (value, element) {
    if (/^(?:[+]9)?[0-9]+$/.test(value)) {

        if ($("#phone_no").val().charAt(0) == '0') {
            return false;
        }
        if ($("#phone_no").val().substring(0, 3) == '966') {
            return false;
        }
        return true;
    } else {
        return false;
    }
}, "Please enter a valid phone number.");

// Minimum 8 digit,small+capital letter,number,specialcharacter
$.validator.addMethod("valid_password", function (value, element) {
    // if (/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(value)) {
    if (/^.{8,}$/.test(value)) {    // Minimum 8 characters only
        return true;
    } else {
        return false;
    }
});

// Alphabet or number
$.validator.addMethod("valid_coupon_code", function (value, element) {
    if (/^[a-zA-Z0-9]+$/.test(value)) {
        return true;
    } else {
        return false;
    }
});

// Integer and decimal
$.validator.addMethod("valid_amount", function (value, element) {
    if (/^[1-9]\d*(\.\d+)?$/.test(value)) {
        return true;
    } else {
        return false;
    }
});

// US phone number validation
$.validator.addMethod("valid_us_phone_number", function (value, element) {
    if (value) {
        if (/^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/.test(value)) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
});

// Valid 5 digit number
$.validator.addMethod("valid_5_digit_number", function (value, element) {
    if (value) {
        if (/^[0-9]{5}$/.test(value)) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
});

// Positive number
$.validator.addMethod("valid_positive_number", function (value, element) {
    if (value) {
        if (/^[0-9]+$/.test(value)) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
});


var overallErrorMessage = '';
var pleaseFillOneField = 'You missed 1 field. It has been highlighted.';
var pleaseFillMoreFieldFirst = 'You have missed ';
var pleaseFillMoreFieldLast = ' fields. Please fill before submitted.';
var successMessage = 'Success';
var errorMessage = 'Error';
var warningMessage = 'Warning';
var infoMessage = 'Info';
var btnSubmitting = 'Submitting...';
var btnUpdating = 'Updating...';
var thankYouMessage = 'Thank You';
var formSuccessMessage = 'Form has been submitted successfully. We will get back to you soon.';
var somethingWrongMessage = 'Something went wrong, please try again later.';
var labelSelect = 'Select';
var serviceProviderDateMessage = 'Please select services, service provider, booking date first.';

function checkUserAuth(ele)
{


    const player2_clicked_user_id= $(ele).attr('value');

    const flag=$("#user-login-check").val();
    var websiteLink = $('#website_link').val();
    const leagueid=$("#leagueid").val();
    var loginUrl = websiteLink + '/login-new';



    if (flag==""){
        alert("you are requested to please login first..");
        window.open(loginUrl,'_self')
    }
    else{
        $.get('/check-partner/'+leagueid, function (data) {
            if (data!=1)
            {
                alert("Looks like you have already added another partner. Please wait for your partner to decline your request or wait for the 5 day window to expire before adding another partner.");
            }
            else{
                $("#need-partner-hide").removeClass("d-block");
                $("#need-partner-hide").addClass("d-none");
                $.get('/add_selected_player/'+player2_clicked_user_id+'/'+leagueid,function (data) {

                    $("#checkoutBtn").removeClass('d-block');
                    $("#checkoutBtn").addClass('d-none');
                    // $("#team_name").val(data[0].title);
                    $("#player_2_name").val(data[0].player1_name);
                    $("#player_2_email").val(data[0].player1_email);
                    $("#selected-player-flag").val(data[0].team_id);
                    $("#leagueSignupModal").modal('show');
                })
            }
        })

    }
}

// $(document).ready(function () {
//     $("#check-league-status").click(function () {
//         alert("isnide")
//         const val=$("#league-status-text").text();
//         alert(val);
//     })
// })

$(document).ready(function () {
    $("#player-one-red-minus").click(function () {
        const leagueid=$("#league_id").text();
        $.get('/playertwo-checkout-status/'+leagueid,function (data) {
            if (data==1){
                Swal.fire({
                    title: 'Are you sure you would like to remove yourself from the list? By doing so, this will cancel any current requests to add another partner from this list?',
                    showDenyButton: true,  showCancelButton: true,
                    confirmButtonText: `Confirm`,
                    denyButtonText: `Cancel`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        $.get('/before-player-two-checkout/'+leagueid,function (data) {
                            location.reload(true);
                        })
                    } else {
                        Swal.fire('there is some error in processing..', '', 'info')
                    }
                });
            }else{
                Swal.fire({
                    title: 'Are you sure you would like to remove yourself from the list? By doing so, this will cancel any current requests to add another partner from this list?',
                    showDenyButton: true,  showCancelButton: true,
                    confirmButtonText: `Confirm`,
                    denyButtonText: `Cancel`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        $.get('/before-player-two-checkout/'+leagueid,function (data) {
                            location.reload(true);
                        })
                    } else{
                        Swal.fire('there is some error in processing..', '', 'info')
                    }
                });
            }
        })

    })
})
$(document).ready(function () {
    var websiteLink = $('#website_link').val();

    var selectedUserIds = [];

    /* Pickleball Court Form */
    $("#pickleballCourtForm").validate({
        ignore: ":hidden",
        debug: false,
        rules: {
            court_name: {
                required: true,
            },
            state_id: {
                required: true,
            },
            city: {
                required: true,
            },
            zip: {
                valid_5_digit_number: true,
            },
            number_of_courts: {
                valid_positive_number: true,
            },
        },
        messages: {
            court_name: {
                required: "Please enter court name.",
            },
            state_id: {
                required: "Please select state.",
            },
            city: {
                required: "Please enter city.",
            },
            zip: {
                valid_5_digit_number: "Please enter valid 5 digit zip code.",
            },
            number_of_courts: {
                valid_positive_number: "Please enter valid number of courts.",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            $('.preloader').show();
            var pickleballCourtSubmitUrl = websiteLink + '/ajax-pickleball-court-submit';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: pickleballCourtSubmitUrl,
                method: 'POST',
                data: $('#pickleballCourtForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.type == 'success') {
                        $('#pickleballCourtForm')[0].reset();
                        $('#pickleballCourtModal').modal('hide');
                        $("#home_court").html(response.options);
                        $('#home_court-error').hide();
                        $('.preloader').hide();
                    } else if (response.type == 'validation') {
                        $('.preloader').hide();
                        toastr.error(response.message, errorMessage + '!');
                    } else {
                        $('.preloader').hide();
                        toastr.error(response.message, response.title + '!');
                    }
                }
            });
        }
    });

    /* Account Registration Form */
    $("#userRegistrationForm").validate({
        ignore: [],
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: true,
                valid_email: true
            },
            phone_no: {
                required: true,
            },
            password: {
                required: true,
                valid_password: true,
            },
            confirm_password: {
                required: true,
                valid_password: true,
                equalTo: "#password"
            },
            gender: {
                required: true,
            },
            day: {
                required: true,
            },
            month: {
                required: true,
            },
            year: {
                required: true,
            },
            player_rating: {
                required: true,
            },
            home_court: {
                required: true,
            },
            address_line_1: {
                required: true,
            },
            // address_line_2: {
            //     required: true,
            // },
            city: {
                required: true,
            },
            state: {
                required: true,
            },
            zip: {
                required: true,
                valid_5_digit_number: true,
            },
            // how_did_you_find_us: {
            //     required: true
            // },
            'availability[]': {
                required: true
            },
            agree: {
                required: true
            },
            // is_waiver_signed: {
            //     required: true
            // },
        },
        messages: {
            first_name: {
                required: "Please enter first name.",
            },
            last_name: {
                required: "Please enter last name.",
            },
            email: {
                required: "Please enter email.",
            },
            phone_no: {
                required: "Please enter phone.",
            },
            password: {
                required: "Please enter password.",
                valid_password: "Minimum 8 characters."
            },
            confirm_password: {
                required: "Please enter confirm password.",
                valid_password: "Minimum 8 characters.",
                equalTo: "Password should be same as create password.",
            },
            gender: {
                required: "Please select gender.",
            },
            day: {
                required: "Please select day.",
            },
            month: {
                required: "Please select month.",
            },
            year: {
                required: "Please select year.",
            },
            player_rating: {
                required: "Please select player rating.",
            },
            home_court: {
                required: "Please select preferred home court.",
            },
            address_line_1: {
                required: "Please enter address line 1.",
            },
            // address_line_2: {
            //     required: "Please enter address line 2.",
            // },
            city: {
                required: "Please enter city.",
            },
            state: {
                required: "Please select state.",
            },
            zip: {
                required: "Please enter zip.",
                valid_5_digit_number: "Please enter valid 5 digit zip code.",
            },
            // how_did_you_find_us: {
            //     required: "Please enter how did you find us.",
            // },
            'availability[]': {
                required: "Please select availability.",
            },
            agree: {
                required: "Please accept our Terms of Use.",
            },
            // is_waiver_signed: {
            //     required: "Please accept Waiver.",
            // },
        },
        errorPlacement: function (error, element) {
            if ($(element).attr('id') == 'agree') {
                error.insertAfter($(element).parents('div#leagueAgree'));
            } else if ($(element).attr('class') == 'form-check-input available error-checkbox error') {
                error.insertAfter($(element).parents('div#availability'));
            } else if ($(element).attr('id') == 'home_court') {
                error.insertAfter($(element).insertAfter('div#home-court-div'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            $('.preloader').show();
            var registrationSubmitUrl = websiteLink + '/ajax-registration-submit';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: registrationSubmitUrl,
                method: 'POST',
                data: $('#userRegistrationForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.type == 'success') {
                        $('#userRegistrationForm')[0].reset();
                        window.location.href = websiteLink + '/thank-you/' + response.loginId;
                    } else if (response.type == 'validation') {
                        $('.preloader').hide();
                        toastr.error(response.message, errorMessage + '!');
                    } else {
                        $('.preloader').hide();
                        toastr.error(response.message, response.title + '!');
                    }
                }
            });
        }
    });

    /* User Login Form */
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                valid_email: true
            },
            password: {
                required: true,
            }
        },
        messages: {
            email: {
                required: "Please enter email.",
                valid_email: "Please enter valid email.",
            },
            password: {
                required: "Please enter password.",
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            $('.preloader').show();
            var loginSubmitUrl = websiteLink + '/ajax-login-submit';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: loginSubmitUrl,
                method: 'POST',
                data: $('#loginForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.type == 'success') {
                        $('#loginForm')[0].reset();
                        $('#loginModal').modal('toggle');

                        if (response.redirectTo == '') {
                            window.location.href = websiteLink + '/users/profile';
                        } else {
                            window.location.href = websiteLink + '/users/join-a-league';
                        }
                    } else if (response.type == 'validation') {
                        $('.preloader').hide();
                        toastr.error(response.message, errorMessage + '!');
                    } else {
                        $('.preloader').hide();
                        toastr.error(response.message, errorMessage + '!');
                    }
                }
            });
        }
    });

    /* Edit Profile Form */
    $("#editProfileForm").validate({
        ignore: [],
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: true,
                valid_email: true
            },
            // phone_no: {
            //     required: true,
            // },
            // preferred_level: {
            //     required: true,
            // },
            preferred_home_court: {
                required: true,
            },
            playing_region: {
                required: true,
            },
            day: {
                required: true,
            },
            month: {
                required: true,
            },
            year: {
                required: true,
            },
        },
        messages: {
            first_name: {
                required: "Please enter first name.",
            },
            last_name: {
                required: "Please enter last name.",
            },
            email: {
                required: "Please enter email.",
            },
            // phone_no: {
            //     required: "Please enter phone number.",
            // },
            // preferred_level: {
            //     required: "Please select league division.",
            // },
            preferred_home_court: {
                required: "Please select preferred home court.",
            },
            playing_region: {
                required: "Please select playing region.",
            },
            day: {
                required: "Please select day.",
            },
            month: {
                required: "Please select month.",
            },
            year: {
                required: "Please select year.",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    /* Forgot Password Form */
    $("#forgotPasswordForm").validate({
        rules: {
            email: {
                required: true,
                valid_email: true,
            },
        },
        messages: {
            email: {
                required: "Please enter email.",
                valid_email: "Please enter valid email."
            },
        },
        errorClass: 'error',
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            $('.preloader').show();
            var forgotPasswordSubmitUrl = websiteLink + '/ajax-forgot-password-submit';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: forgotPasswordSubmitUrl,
                method: 'POST',
                data: $('#forgotPasswordForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    $('.preloader').hide();
                    ajax_check = false;
                    if (response.type == 'success') {
                        $('#forgotPasswordForm')[0].reset();
                        toastr.success(response.message, successMessage + '!');

                        $('#forgotPasswordModal').modal('hide');
                        $('#loginModal').modal('hide');
                        $('#resetPasswordModal').modal('show');
                    } else if (response.type == 'validation') {
                        toastr.error(response.message, errorMessage + '!');
                    } else {
                        toastr.error(response.message, errorMessage + '!');
                    }
                }
            });
        }
    });

    /* Reset Password Form */
    $("#resetPasswordForm").validate({
        rules: {
            otp: {
                required: true,
            },
            password: {
                required: true,
                valid_password: true,
            },
            confirm_password: {
                required: true,
                valid_password: true,
                equalTo: "#reset_password"
            }
        },
        messages: {
            otp: {
                required: "Please enter OTP.",
            },
            password: {
                required: "Please enter new password.",
                valid_password: "Minimum 8 characters."
            },
            confirm_password: {
                required: "Please enter confirm password.",
                valid_password: "Minimum 8 characters.",
                equalTo: "Password should match in both fields.",
            },
        },
        errorClass: 'error',
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            $('.preloader').show();
            var changePasswordSubmitUrl = websiteLink + '/ajax-reset-password-submit';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: changePasswordSubmitUrl,
                method: 'POST',
                data: $('#resetPasswordForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    $('.preloader').hide();
                    if (response.type == 'success') {
                        $('#resetPasswordForm')[0].reset();
                        toastr.success(response.message, successMessage + '!');

                        $('#forgotPasswordModal').modal('hide');
                        $('#loginModal').modal('show');
                        $('#resetPasswordModal').modal('hide');
                    } else if (response.type == 'validation') {
                        $('.preloader').hide();
                        toastr.error(response.message, errorMessage + '!');
                    } else {
                        $('.preloader').hide();
                        toastr.error(response.message, errorMessage + '!');
                    }
                }
            });
        }
    });

    /* Change Password Form */
    $("#changePasswordForm").validate({
        rules: {
            current_password: {
                required: true,
            },
            password: {
                required: true,
                valid_password: true,
            },
            confirm_password: {
                required: true,
                valid_password: true,
                equalTo: "#password"
            }
        },
        messages: {
            current_password: {
                required: "Please enter current password.",
            },
            password: {
                required: "Please enter new password.",
                valid_password: "Minimum 8 characters."
            },
            confirm_password: {
                required: "Please enter confirm password.",
                valid_password: "Minimum 8 characters.",
                equalTo: "Password should match in both fields.",
            },
        },
        errorClass: 'error',
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            $('.preloader').show();
            var changePasswordSubmitUrl = websiteLink + '/users/ajax-change-password-submit';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: changePasswordSubmitUrl,
                method: 'POST',
                data: {
                    current_password: $('#current_password').val(),
                    password: $('#password').val(),
                    confirm_password: $('#confirm_password').val(),
                },
                dataType: 'json',
                success: function (response) {
                    $('.preloader').hide();
                    ajax_check = false;
                    if (response.type == 'success') {
                        $('#changePasswordForm')[0].reset();
                        toastr.success(response.message, successMessage + '!');
                        setTimeout(function () {
                            window.location.href = websiteLink + '/users/profile';
                        }, 2000);
                    } else if (response.type == 'validation') {
                        toastr.error(response.message, errorMessage + '!');
                    } else {
                        toastr.error(response.message, errorMessage + '!');
                    }
                }
            });
        }
    });

    // Contact form
    $("#contactForm").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                valid_email: true,
            },
            message: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Please enter name.",
            },
            email: {
                required: "Please enter email.",
                valid_email: "Please enter valid email.",
            },
            message: {
                required: "Please enter message.",
            }
        },
        errorClass: 'error',
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            $('.preloader').show();
            var contactSubmitUrl = websiteLink + '/ajax-contact-submit';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: contactSubmitUrl,
                method: 'POST',
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    message: $('#message').val(),
                },
                dataType: 'json',
                success: function (response) {
                    $('.preloader').hide();
                    if (response.type == 'success') {
                        $('#contactForm')[0].reset();
                        toastr.success(formSuccessMessage, thankYouMessage + '!');
                    } else {
                        toastr.error(somethingWrongMessage, errorMessage + '!');
                    }
                }
            });
        }
    });

    /* League Registration */
    $("#leagueSignupForm").validate({
        rules: {
            team_name: "required",
            player_1_name: "required",
            player_2_name: "required",
            player_2_email: "required",
            signup_agree: "required",

        },
        messages: {
            team_name: "team name is required",
            player_1_name: "player 1 name is required",
            player_2_name: "player 2 name is required",
            player_2_email: "email is required",
            signup_agree: "it is required",
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(element.parents('.form-group'));
            } else { // This is the default behavior
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var websiteLink = $('#website_link').val();
            var teamsUrl = websiteLink + '/add-teams';
            var playertwoReplaceUrl = websiteLink + '/replace_player_two';
            const flag=$("#selected-player-flag").val();
            if (flag!=""){
                $.ajax({
                    url: playertwoReplaceUrl,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#leagueSignupForm').serialize(),
                    dataType: 'json',
                    success: function (response) {

                        $("#leagueSignupModal").modal('hide');
                        $('#leagueSignupForm')[0].reset();

                    }
                });

            }else{
                $.ajax({
                    url: teamsUrl,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#leagueSignupForm').serialize(),
                    dataType: 'json',
                    success: function (response) {

                        $("#leagueSignupModal").modal('hide');
                        $('#leagueSignupForm')[0].reset();
                        window.location.href = '/player-one-confirmation/' + response.teamid;
                        // $('#modal-alert').removeClass('d-none');
                        // $('#modal-alert').addClass('d-block');
                        // $('#pickleballCourtModal').modal('hide');
                    }
                });
            }

        }

    });


    // Hide Login modal, open forgot password modal
    $(document).on('click', '#openForgotPasswordModal', function () {
        $('#loginModal').modal('hide');
        $('#resetPasswordModal').modal('hide');
        $('#forgotPasswordModal').modal('show');
    });

    // Hide forgot password modal, open login modal
    $(document).on('click', '#openLoginModal', function () {
        $('#forgotPasswordModal').modal('hide');
        $('#resetPasswordModal').modal('hide');
        $('#loginModal').modal('show');
    });


    // Start :: Select / Deselect all in city league page
    var totalCheckboxCount = $('input[type=checkbox]').length;
    totalCheckboxCount = totalCheckboxCount - 1;
    $('.selectDeselectAll').click(function () {
        if ($(this).is(':checked')) {
            $('.individualCheckboxes').prop('checked', true);
            // set user ids
            $('.individualCheckboxes').each(function () {
                selectedUserIds.push($(this).val());
            });
        } else {
            $('.individualCheckboxes').prop('checked', false);
            selectedUserIds = [];
        }
    });
    $('.individualCheckboxes').click(function () {
        if ($(this).prop('checked') == true) {
            selectedUserIds.push($(this).val());

            // If total checkbox (except top checkbox) == all checked checkbox then "Check" the Top checkbox
            var totalCheckedCheckbox = $('input[type=checkbox]:checked').length;
            if (totalCheckedCheckbox == totalCheckboxCount) {
                $('.selectDeselectAll').prop('checked', true);
            }
        } else {
            const index = selectedUserIds.indexOf($(this).val());
            if (index > -1) {
                selectedUserIds.splice(index, 1);   // 2nd parameter means remove one item only
            }
            // select/deselect checkbox un-check
            $('.selectDeselectAll').prop('checked', false);
        }
    });
    // End :: Select / Deselect all in city league page

    // Date of birth in edit profile
    $('#dob').datepicker({
        format: 'mm-dd-yyyy',
        weekStart: 1,
        autoclose: true,
        todayHighlight: true,
        endDate: '-18Y',
    });
    $('#dob').bind('keypress', function (e) {
        e.preventDefault();
    });

    $('.holder-inner :input[type=text], .holder-inner :input[type=email], .holder-inner :input[type=password], .holder-inner textarea').focus(function () {
        $(this).prev("label").addClass('hide');
    }).blur(function () {
        if ($(this).val() == '') {
            $(this).prev('label').removeClass('hide');
        }
    });

    $('.holder-inner select').change(function () {
        if ($(this).attr('id') == 'home_court') {
            if ($(this).val() != '') {
                $('#pref-home-court').addClass('hide');
            } else {
                $('#pref-home-court').removeClass('hide');
            }
        } else {
            if ($(this).val() != '') {
                $(this).prev('label').addClass('hide');
            } else {
                $(this).prev('label').removeClass('hide');
            }
        }
    });

    $(document).ready(function () {
        const player2PassedId=$("#player2id").val();

        if(player2PassedId!=""){
            const leagueid=$("#leagueid").val();

            $("#regBtn").removeClass("d-block");
            $("#regBtn").addClass("d-none");
            $("#checkoutBtn").removeClass("d-none");
            $("#checkoutBtn").addClass("d-block");
            $.get('/check-player2/'+leagueid+'/'+player2PassedId, function (data) {
                console.log(data);

                if (data == 1) {
                    alert("date for registration has passed..")
                } else if (data == 2) {
                    alert("you are requested to please register first..");
                    window.location.href = '/login-new';
                } else {
                    const location = $('#label_location').text();
                    const gender = $('#label_gender').text();
                    const rating = $('#label_rating').text();
                    const age = $('#label_age').text();

                    const currentYear = new Date().getFullYear();
                    const currentAge = currentYear - data.user[0].dob.split('-')[0];

                    if (location != data.user[0].city) {
                        alert("Looks like your address does not correspond to the location for this league. You may proceed but please be aware that you will be required to play league matches within the confines of this league's location prior to participating.")
                    } else if (data.user[0].gender != gender) {
                        alert("Looks like your gender does not qualify you for this league. Please register for a league that caters to your gender.")
                    } else if (currentAge < age) {
                        alert("Looks like your age does not qualify you for this league. Please register for a league that caters to your age");
                    } else if (data.user[0].player_rating < rating) {
                        alert("Looks like your player rating is above or beyond the suggested rating for this league. You may proceed but please be aware of this prior to participating.")
                    } else {
                        $("#team_name").val(data.players.title);
                        $("#player_1_name").val(data.players.player1_name);
                        $("#player_2_name").val(data.players.player2_name);
                        $("#player_2_email").val(data.players.player2_email);
                        $("#leagueSignupModal").modal('show');
                    }
                }
            }).fail(function () {
                console.log("its not player 2 request..")
            })
        }

    })

    $('#register-for-league').click(function () {
        const lastLeagueId = $("#leagueid").val();
        $("#regBtn").removeClass("d-none");
        $("#regBtn").addClass("d-block");
        $("#checkoutBtn").removeClass("d-block");
        $("#checkoutBtn").addClass("d-none");
        $.get('/check-user/' + lastLeagueId, function (data) {
            if (data == 1) {
                alert("date for registration has passed..");
            } else if (data == 2) {
                alert("you are requested to please register/login first..");
                window.location.href = '/login-new';
            }
            else if(data==3){
                alert("Looks like you are already registered for this league.");
            }
            else {
                const location = $('#label_location').text();
                const gender = $('#label_gender').text();
                const rating = $('#label_rating').text();
                const age = $('#label_age').text();

                const currentYear = new Date().getFullYear();
                const currentAge = currentYear - data[0].dob.split('-')[0];

                if (location != data[0].city) {
                    alert("Looks like your address does not correspond to the location for this league. You may proceed but please be aware that you will be required to play league matches within the confines of this league's location prior to participating.")
                } else if (data[0].gender != gender) {
                    alert("Looks like your gender does not qualify you for this league. Please register for a league that caters to your gender.")
                } else if (currentAge < age) {
                    alert("Looks like your age does not qualify you for this league. Please register for a league that caters to your age");
                } else if (data[0].player_rating < rating) {
                    alert("Looks like your player rating is above or beyond the suggested rating for this league. You may proceed but please be aware of this prior to participating.")
                } else {
                    $("#leagueSignupModal").modal('show');
                }
            }
        })
    });

    // Need partner popup open (on League registration popup)
    $('#need-partner').click(function () {
        $("#leagueSignupModal").modal('hide');
        $("#needPartnerModal").modal('toggle');
    });

});

// Sweet alert render
function sweetalertMessageRender(target, message, type, confirm = false) {
    let options = {
        title: warningMessage,
        text: message,
        icon: type,
        type: type,
        confirmButtonColor: '#c8fe0a',
        cancelButtonColor: '#000000',
        showLoaderOnConfirm: true,
        animation: true,
        allowOutsideClick: false,
    };
    if (confirm) {
        options['showCancelButton'] = true;
        options['cancelButtonText'] = 'Cancel';
        options['confirmButtonText'] = 'Yes';
    }
    return Swal.fire(options).then((result) => {
        if (confirm == true && result.value) {
            $('.preloader').show();
            window.location.href = target.getAttribute('data-href');
        } else {
            return (false);
        }
    });
}

// Toggle password in registration
$('.toggle-password').click(function () {
    $(this).toggleClass('fa-eye fa-eye-slash');
    var input = $($(this).attr('toggle'));

    if (input.attr('type') == 'password') {
        input.attr('type', 'text');
    } else {
        input.attr('type', 'password');
    }
});

// Toggle confirm password in registration
$('.toggle-confirm-password').click(function () {
    $(this).toggleClass('fa-eye fa-eye-slash');
    var input = $($(this).attr('toggle'));

    if (input.attr('type') == 'password') {
        input.attr('type', 'text');
    } else {
        input.attr('type', 'password');
    }
});

$(".leage-leftsec h3").click(function () {
    $(this).next().slideToggle();

});

$(".league-togglebutton").click(function () {
    $(this).next().slideToggle();
    $(this).toggleClass('active');

});
