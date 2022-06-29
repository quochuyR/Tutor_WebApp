const mix = require('laravel-mix');
const argv = require('minimist')(process.argv.slice(2));

const src = {
    user: {
        js: ['resources/js/main.js',
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
            'resources/js/tutor_registration_form.js'
        ],
        css: ['resources/css/style.css',
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
            'resources/css/utilities/main.css'
        ]
    },
    admin: {
        js: ['admin/resources/js/modules/image_viewer.js',
            'admin/resources/js/main.js',
            'admin/resources/js/carousel.js',
            'admin/resources/js/managersubjects.js',
            'admin/resources/js/page_editpost.js',
            'admin/resources/js/topicmanager.js',
            'admin/resources/js/tutormanagers.js'
        ],
        css: ['admin/resources/css/carousel_post/main.css',
            'admin/resources/css/material-icon/main.css',
            'admin/resources/css/print/print.css',
            'admin/resources/css/sliderbar/main.css',
            'admin/resources/css/user_detail/main.css',
            'admin/resources/css/utilities/main.css',
            'admin/resources/css/style.css',
        ]
    }
}

const dest = {
    user: {
        js: 'public/js',
        css: 'public/css'
    },
    admin: {
        js: 'public/js',
        css: 'public/css'
    }

}

// For User
if (argv.user) {
    mix.js(src.user.js, `${dest.user.js}/app.js`) // Output: public/js/app.js
        .styles(src.user.css, `${dest.user.css}/app.css`) // Output: public/css/app.css


}
// For Admin
else if (argv.admin) {
    mix.js(src.admin.js, `${dest.admin.js}/admin.js`) // Output: public/js/admin.js
        .styles(src.admin.css, `${dest.admin.css}/admin.css`) // Output: public/css/admin.css


}
// Both
else {
    mix.js(src.user.js, `${dest.user.js}/app.js`)

    .styles(src.user.css, `${dest.user.css}/app.css`)
        .js(src.admin.js, `${dest.admin.js}/admin.js`)
        .styles(src.admin.css, `${dest.admin.css}/admin.css`)


}
mix.setPublicPath('public')


// }
// mix.js(, 'public/js')
//     .styles(, 'public/css/main.css')
//      setPublicPath('public');
if (mix.inProduction()) {

    mix.version();
}