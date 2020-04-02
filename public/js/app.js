/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  "use strict"; // Not closing cart dropdown on click inside

  $('.cart-dropdown.dropdown-menu').on("click.bs.dropdown", function () {
    return $('.dropdown.cart').one('hide.bs.dropdown', function () {
      return false;
    });
  }); // Login form submit

  $('#login-modal .form-signin .btn-lg').click(function (e) {
    e.preventDefault();
    $('.error-username').text('');
    $('.error-password').text('');
    axios({
      method: 'post',
      url: '/login',
      data: {
        username: $('.lg-username').val(),
        password: $('.lg-password').val()
      }
    }).then(function () {
      location.reload();
    })["catch"](function (error) {
      var errors = error.response.data.errors;

      _.forOwn(errors, function (value, key) {
        value.forEach(function (el) {
          var err = document.createElement('div');
          err.textContent = el;
          document.querySelector(".form-signin .error-login").appendChild(err);
        });
      });
    });
  }); // Sign up form submit

  $('#signup-modal .form-signup .btn-signup').click(function (e) {
    e.preventDefault();
    $('.error-username').text('');
    $('.error-phone').text('');
    $('.error-email').text('');
    $('.error-password').text('');
    axios({
      method: 'post',
      url: '/register',
      data: {
        username: $('.su-username').val(),
        phone: $('.su-phone').val(),
        email: $('.su-email').val(),
        password: $('.su-password').val(),
        password_confirmation: $('.su-password_confirmation').val()
      }
    }).then(function () {
      $('#signup-modal').modal('hide');
      $('#signup-modal').on('hidden.bs.modal', function () {
        $('#signup-success-modal').modal('show');
      });
    })["catch"](function (error) {
      var errors = error.response.data.errors;

      _.forOwn(errors, function (value, key) {
        value.forEach(function (el) {
          var err = document.createElement('div');

          if (el == 'Định dạng trường tên đăng nhập không hợp lệ.') {
            el = 'Tên đăng nhập chỉ gồm chữ và số, với ít nhất 1 chữ';
          }

          err.textContent = el;
          document.querySelector(".form-signup .error-".concat(key)).appendChild(err);
        });
      });
    });
  }); // Click "Dong y" to hide signup success modal

  $('#signup-success-modal .btn-ok').click(function (e) {
    e.preventDefault();
    $('#signup-success-modal').modal('hide');
  }); // Reload when close signup success modal

  $('#signup-success-modal').on('hidden.bs.modal', function () {
    location.reload();
  }); // Products Slick

  $(".noti-icon").click(function () {
    $(this).next(".noti").slideToggle( "medium");
  });

  $('.products-slick').each(function () {
    var $this = $(this),
        $nav = $this.attr('data-nav');
    $this.slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      infinite: true,
      speed: 300,
      dots: false,
      arrows: true,
      appendArrows: $nav ? $nav : false,
      responsive: [{
        breakpoint: 991,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      }, {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }]
    });
  }); // Products Widget Slick

  $('.products-widget-slick').each(function () {
    var $this = $(this),
        $nav = $this.attr('data-nav');
    $this.slick({
      infinite: true,
      autoplay: true,
      speed: 300,
      dots: false,
      arrows: true,
      appendArrows: $nav ? $nav : false
    });
  }); /////////////////////////////////////////
  // Product Main img Slick

  $('#product-main-img').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs'
  }); // Product imgs Slick

  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
    centerPadding: 0,
    vertical: true,
    asNavFor: '#product-main-img',
    responsive: [{
      breakpoint: 991,
      settings: {
        vertical: false,
        arrows: false,
        dots: true
      }
    }]
  }); // Hot deal slider homepage

  $('.hot-deal-wrapper').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: true,
    autoplay: true,
    speed: 300,
    infinite: true
  }); // Product img zoom

  var zoomMainProduct = document.getElementById('product-main-img');

  if (zoomMainProduct) {
    $('#product-main-img .product-preview').zoom();
  } /////////////////////////////////////////
  // Input number
  // $('.input-number').each(function () {
  //   var $this = $(this),
  //     $input = $this.find('input[type="number"]'),
  //     up = $this.find('.qty-up'),
  //     down = $this.find('.qty-down');
  //   down.on('click', function () {
  //     var value = parseInt($input.val()) - 1;
  //     value = value < 1 ? 1 : value;
  //     $input.val(value);
  //     $input.change();
  //     updatePriceSlider($this, value)
  //   })
  //   up.on('click', function () {
  //     var value = parseInt($input.val()) + 1;
  //     $input.val(value);
  //     $input.change();
  //     updatePriceSlider($this, value)
  //   })
  // });
  // var priceInputMax = document.getElementById('price-max'),
  //   priceInputMin = document.getElementById('price-min');
  // priceInputMax.addEventListener('change', function () {
  //   updatePriceSlider($(this).parent(), this.value)
  // });
  // priceInputMin.addEventListener('change', function () {
  //   updatePriceSlider($(this).parent(), this.value)
  // });
  // function updatePriceSlider(elem, value) {
  //   if (elem.hasClass('price-min')) {
  //     console.log('min')
  //     priceSlider.noUiSlider.set([value, null]);
  //   } else if (elem.hasClass('price-max')) {
  //     console.log('max')
  //     priceSlider.noUiSlider.set([null, value]);
  //   }
  // }
  // // Price Slider
  // var priceSlider = document.getElementById('price-slider');
  // if (priceSlider) {
  //   noUiSlider.create(priceSlider, {
  //     start: [1, 999],
  //     connect: true,
  //     step: 1,
  //     range: {
  //       'min': 1,
  //       'max': 999
  //     }
  //   });
  //   priceSlider.noUiSlider.on('update', function (values, handle) {
  //     var value = values[handle];
  //     handle ? priceInputMax.value = value : priceInputMin.value = value
  //   });
  // }

});

/***/ }),

/***/ "./resources/sass/styles.scss":
/*!************************************!*\
  !*** ./resources/sass/styles.scss ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!****************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/styles.scss ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/laoton/Desktop/thu/chuyen_de/Tbee/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/laoton/Desktop/thu/chuyen_de/Tbee/resources/sass/styles.scss */"./resources/sass/styles.scss");


/***/ })

/******/ });