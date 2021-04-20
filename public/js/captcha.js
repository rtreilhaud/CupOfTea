
grecaptcha.ready(() => {

    grecaptcha.execute('6LduebEaAAAAALyF6AKUZxeRmfddZkpn5yU9uyjV', {action: 'homepage'})
    .then((token) => {
        document.getElementById('recaptchaResponse').value = token
    });
  });