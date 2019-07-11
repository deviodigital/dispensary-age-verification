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
  'use strict';
  $.ageCheck = function (options) {
    const settings = $.extend({
      minAge: 18,
      redirectTo: '',
      redirectOnFail: '',
      title: 'Age Verification',
      copy: 'You must be [age] years old to enter.',
      btnYes: 'YES',
      btnNo: 'NO',
      successTitle: 'Success!',
      successText: 'You are now being redirected back to the site...',
      failTitle: 'Sorry',
      failText: 'You are not old enough to view this site...',
      cookieDays: 30,
      adminDebug: ''
    }, options);

    const _this = {
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
        let html = '';
        html += '<div class="wpd-av-overlay"></div>';
        html += '<div class="wpd-av">';
    		if (settings.imgLogo != '') {
    		html += '<img src="' + settings.imgLogo + '" alt="' + settings.title + '" />';
    		}
        html += `<h2>${settings.title}</h2>`;
        html += `<p>${copy.replace('[age]', `<strong>${settings.minAge}</strong>`)}`; + '</p>';
        html += `<p><button class="no">${settings.btnNo}</button><button class="yes">${settings.btnYes}</button></p></div></div>`;
        $('body').append(html);

        $('.wpd-av-overlay').animate({
          opacity: 1,
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
        _this.age = Math.abs(Date.now() - 1970);
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
        const successMsg = `<h2>${settings.successTitle}</h2><p>${settings.successText}</p>`;
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
        const underAgeMsg = `<h2>${settings.failTitle}</h2><p>${settings.failText}</p>`;
        $('.wpd-av').html(underAgeMsg);
        if (settings.redirectOnFail !== '') {
          setTimeout(() => {
            window.location.replace(settings.redirectOnFail);
          }, 2000);
        }
      },
    }; // end _this

    // Check for cookie and reture false if it's set.
    var cookiereader = readCookie('age-verification');
    if (cookiereader) {
      if (settings.adminDebug != '') {
        eraseCookie('age-verification');
      } else {
        return false;
      }
    }

    // Create pop up.
    _this.buildHtml();

    // Successful "YES" button click.
    $('.wpd-av button.yes').on('click', () => {
      createCookie('age-verification', 'true', settings.cookieDays);
      _this.handleSuccess();
    });

    // Successful "NO" button click.
    $('.wpd-av button.no').on('click', () => {
      _this.handleUnderAge();
    });

    $(window).resize(() => {
      _this.reCenter($('.wpd-av'));
      setTimeout(() => {
        _this.reCenter($('.wpd-av'));
      }, 500);
    });
  };
}(jQuery));
