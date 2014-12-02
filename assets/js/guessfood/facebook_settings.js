/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var FacebookController = {
    appid: null,
    user_authenticated: false,
    checkAlreadyLogedIn: function() {
        FB.getLoginStatus(function(res) {
            var response = res;
            if (res.status === 'connected')
            {
                FacebookController.user_authenticated = true;

                setTimeout(function() {
                    FB.api('/me', function(response) {
                        DataActionController.facebookLogin(response);
//                        console.log(response);
//
//                        FB.api(
//                                "/me/friends",
//                                function(response) {
//                                    if (response && !response.error) {
//                                         console.log(response);
//                                        /* handle the result */
//                                    }
//                                }
//                        );

//                                   EventHandler.disableAjaxmask();
                    });
                }, 1000);

                console.log('Connected to Facebook ');
            }
            else if (res.status === 'not_authorized') {
                FacebookController.Login();
                console.log('not authorized');
//                         EventHandler.disableAjaxmask();
            }
            else if (res.status === 'unknown' || !res.authResponse) {
                FacebookController.Login();
                console.log('user not logged in');
//                         EventHandler.disableAjaxmask();
            }
            else {
                FacebookController.user_authenticated = true;
                console.log('user  logged in 1');
//                         EventHandler.disableAjaxmask();
            }

        });


    },
    initialize: function() {
        this.appid = '815996528459114';// 815345745190859 live, 815996528459114 test
        window.fbAsyncInit = function() {
            FB.init({
                appId: FacebookController.appid,
                status: true,
                cookie: true,
                xfbml: true,
                oauth: true
            });
            
//             FacebookController.checkAlreadyLogedIn();
        };
    },
    Login: function()
    {
        FB.login(function(response) {
            if (response.authResponse)
            {
                setTimeout(function() {
                    FB.api('/me', function(response) {
//                        console.log(response);
                        DataActionController.facebookLogin(response);
                    });
                }, 500);
//                  
                console.log('user Logged In 2');
            } else {
                DataActionController.disableAjaxmask();
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {
            scope: 'email,user_friends'
        });

    },
    Logout: function()
    {
        FB.logout(function() {
            document.location.reload();
        });
    },
    facebookShareDialog: function(imgurl, link) {
        if (!link)
            link = 'http://www.guessfood.com';
        FB.ui(
                {
                    method: 'feed',
                    name: 'Share your creativity',
                    link: link,
                    picture: imgurl,
                    caption: 'See my creativity!',
                    description: 'Express your creativity and use canvas to draw whatever you want to. Rate this drawing now.', message: 'This is me!'
                });
    }


};

window.FacebookController = FacebookController;
