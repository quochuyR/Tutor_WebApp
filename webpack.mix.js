const mix = require('laravel-mix');

mix.js(['resources/js/main.js',
    'resources/js/scroll.js',
    'resources/js/utilities.js',
    'resources/js/schedule_tutors.js',
    'resources/js/schedule_user.js',
    'resources/js/profile.js',
    'resources/js/registered_tutors.js',
    'resources/js/registered_users.js',
    'resources/js/saved_tutors.js',
    'resources/js/signup.js',
    'resources/js/tutor_details.js',
    'resources/js/tutor_registration_form.js'], 'public/js')
    .styles(['resources/css/style.css',
        'resources/css/404/main.css',
        'resources/css/footer/main.css',
        'resources/css/login/main.css',
        'resources/css/material-icon/main.css',
        'resources/css/navbar/main.css',
        'resources/css/register_schedule_tutors/main.css',
        'resources/css/saved_tutors/main.css',
        'resources/css/schedule_tutors/main.css',
        'resources/css/signup/main.css',
        'resources/css/teacher_list/main.css',
        'resources/css/TrangChu/main.css',
        'resources/css/tutor_registration_form/main.css',
        'resources/css/user_detail/main.css',
        'resources/css/utilities/main.css'], 'public/css/main.css')
        .setPublicPath('public');

 if (mix.inProduction()) {
     mix.version();
 }