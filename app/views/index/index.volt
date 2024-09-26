<div class="page-header">
    <img src="<?php echo $this->url->get('img/phalcon-framework.png')?>" alt="">
    <h1>Congratulations!</h1>
</div>

<p>You're now flying with Phalcon. Great things are about to happen!</p>

<p>This page is located at <code>views/index/index.phtml</code></p>



<p><a href="#" onClick="logInWithFacebook()">Log In with the JavaScript SDK</a></p>


<script>
    window.fbAsyncInit = function() {
      FB.init({
        appId  : '783772599918930',
        cookie : true,
        xfbml  : true,
        version: 'v17.0'
      });

      FB.AppEvents.logPageView();

    };

    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "https://connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script>

<script>
  logInWithFacebook = function() {
    FB.login(function(response) {
        console.log(response);
        // return;
      if (response.authResponse) {
        alert('You are logged in & cookie set!');
        // Now you can redirect the user or do an AJAX request to
        // a PHP script that grabs the signed request from the cookie.
        window.top.location.href = '/fb?accessToken=' + response.authResponse.accessToken;
      } else {
        alert('User cancelled login or did not fully authorize.');
      }
    });
    return false;
  };
</script>