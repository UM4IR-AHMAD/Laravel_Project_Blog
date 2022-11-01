const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            keyframes:{
                hide:{
                    // 'to' : {
                    //     // opacity:0,
                    //     width:0,
                    //     visibility:'hidden',
                    //     height: 0,
                    //  }


                    '0%':{
                        opacity: 1,
                        visibility: 'visible',
                    },
                    '100%':{
                        opacity: 0,
                        visibility: 'hidden',
                        height: 0,
                    }
                    
                },
                hidee: {
                    'to':{opacity:0}
                  }
            },
            animation:{
                hide: 'hide 5s ease 5s forwards',
                hidee: 'hidee 2s linear forwards',
                spin: 'spin 5s linear 10s 1'
            },
            backgroundImage: {
                'hero': "url('http://ishtiaq.sandbox.etdevs.com/blogger/wp-content/uploads/sites/30/2021/09/blogger_53.jpg')",
            },
            width: {
                'maximum': '1920px',
            },
            screens: {
                'full-screen' : '1920px',
                'xxs' : '430px',
            },
            
        },
    },


    plugins: [
        require('@tailwindcss/forms'),
        // require('@tailwindcss-plugins/pagination')({}),
        // require('@tailwindcss/line-clamp'),

    ],
};
