/*
 * The Dispensary Age Verification plugin utilizes
 * the following open source javascript plugin.
 *
 * Thanks Michael!
 *
 * Plugin: ageCheck.js
 * Description: A simple plugin to verify user's age. Uses sessionStorage API to store if user is verified - only kept until browser is closed.
 * Options can be passed for easy customization.
 * Author: Michael Soriano
 * Author's website: http://fearlessflyer.com
 *
 */
(function ($) {
  $.ageCheck = function (options) {
    const settings = $.extend({
      minAge: 21,
      redirectTo: '',
      redirectOnFail: '',
      title: 'Age Verification',
      copy: 'This Website requires you to be [age] years or older to enter. Please enter your Date of Birth in the fields below in order to continue:',
    }, options);


    const _this = {
      month: '',
      day: '',
      year: '',
      age: '',
      errors: [],
      setValues() {
        const month = $('.wpd-av .month').val();
        const day = $('.wpd-av .day').val();
        _this.month = month;
        _this.day = day.replace(/^0+/, ''); // remove leading zero
        _this.year = $('.wpd-av .year').val();
      },
      validate() {
        _this.errors = [];
        if (/^([0-9]|[12]\d|3[0-1])$/.test(_this.day) === false) {
          _this.errors.push('Day is invalid or empty');
        }
        if (/^(19|20)\d{2}$/.test(_this.year) === false) {
          _this.errors.push('Year is invalid or empty');
        }
        _this.clearErrors();
        _this.displayErrors();
        return _this.errors.length < 1;
      },
      clearErrors() {
        $('.errors').html('');
      },
      displayErrors() {
        let html = '<ul>';
        for (let i = 0; i < _this.errors.length; i++) {
          html += `<li><span>x</span>${_this.errors[i]}</li>`;
        }
        html += '</ul>';
        setTimeout(() => {
          $('.wpd-av .errors').html(html);
        }, 200);
      },
      reCenter(b) {
        b.css('top', `${Math.max(0, (($(window).height() - (b.outerHeight() + 150)) / 2))}px`);
        b.css('left', `${Math.max(0, (($(window).width() - b.outerWidth()) / 2))}px`);
      },
      buildHtml() {
        const copy = settings.copy;
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        let html = '';
        html += '<div class="wpd-av-overlay"></div>';
        html += '<div class="wpd-av">';
		if (settings.imgLogo != '') {
		html += '<img src="' + settings.imgLogo + '" alt="' + settings.title + '" />';
		}
        html += `<h2>${settings.title}</h2>`;
        html += `<p>${copy.replace('[age]', `<strong>${settings.minAge}</strong>`)}`; +'</p>';
        html += '<div class="errors"></div>';
        html += '<div class="fields"><select class="month">';
        for (let i = 0; i < months.length; i++) {
          html += `<option value="${i}">${months[i]}</option>`;
        }
        html += '</select>';
        html += '<input class="day" maxlength="2" placeholder="01" />';
        html += '<input class="year" maxlength="4" placeholder="1989"/>';
        html += '<button>Submit</button></div></div>';

        $('body').append(html);

        $('.wpd-av-overlay').animate({
          opacity: 0.8,
        }, 500, () => {
          _this.reCenter($('.wpd-av'));
          $('.wpd-av').css({
            opacity: 1,
          });
        });

        $('.wpd-av .day, .wpd-av .year').focus(function () {
          $(this).removeAttr('placeholder');
        });
      },
      setAge() {
        _this.age = '';
        const birthday = new Date(_this.year, _this.month, _this.day);
        const ageDifMs = Date.now() - birthday.getTime();
        const ageDate = new Date(ageDifMs); // miliseconds from epoch
        _this.age = Math.abs(ageDate.getUTCFullYear() - 1970);
      },
      setSessionStorage(key, val) {
        try {
          sessionStorage.setItem(key, val);
          return true;
        } catch (e) {
          return false;
        }
      },
      handleSuccess() {
        const successMsg = '<h3>Success!</h3><p>You are now being redirected back to the site...</p>';
        $('.wpd-av').html(successMsg);
        setTimeout(() => {
          $('.wpd-av').animate({
            top: '-350px',
          }, 200, () => {
            $('.wpd-av-overlay').animate({
              opacity: '0',
            }, 500, () => {
              if (settings.redirectTo !== '') {
                window.location.replace(settings.redirectTo);
              } else {
                $('.wpd-av-overlay, .wpd-av').remove();
              }
            });
          });
        }, 2000);
      },
      handleUnderAge() {
        const underAgeMsg = '<h3>Sorry, you are not old enough to view this site...</h3>';
        $('.wpd-av').html(underAgeMsg);
        if (settings.redirectOnFail !== '') {
          setTimeout(() => {
            window.location.replace(settings.redirectOnFail);
          }, 2000);
        }
      },
    }; // end _this

    if (sessionStorage.getItem('ageVerified') === 'true') {
      return false;
    }

    _this.buildHtml();

    $('.wpd-av button').on('click', () => {
      _this.setValues();
      if (_this.validate() === true) {
        _this.setAge();

        if (_this.age >= settings.minAge) {
          if (!_this.setSessionStorage('ageVerified', 'true')) {
            console.log('sessionStorage not supported by your browser');
          }
          _this.handleSuccess();
        } else {
          _this.handleUnderAge();
        }
      }
    });

    $(window).resize(() => {
      _this.reCenter($('.wpd-av'));
      setTimeout(() => {
        _this.reCenter($('.wpd-av'));
      }, 500);
    });
  };
}(jQuery));