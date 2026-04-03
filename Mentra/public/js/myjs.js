const swiper = new Swiper(".swiper-slider", {
    // Optional parameters
    centeredSlides: true,
    slidesPerView: 1,
    grabCursor: true,
    freeMode: false,
    loop: true,
    mousewheel: false,
    keyboard: {
        enabled: true
    },

    // Enabled autoplay mode
    autoplay: {
        delay: 3000,
        disableOnInteraction: false
    },

    // If we need pagination
    pagination: {
        el: ".swiper-pagination",
        dynamicBullets: false,
        clickable: true

    },

    // If we need navigation
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },

    // Responsive breakpoints
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 0
        },
        1024: {
            slidesPerView: 4.25,
            spaceBetween: 0
        }
    }
});





// stop wtah
let startBtn = document.getElementById('start');
let stopBtn = document.getElementById('stop');
let resetBtn = document.getElementById('reset');

let hour = 00;
let minute = 00;
let second = 00;
let count = 00;

startBtn.addEventListener('click', function () {
    timer = true;
    stopWatch();
});

stopBtn.addEventListener('click', function () {
    timer = false;
});

resetBtn.addEventListener('click', function () {
    timer = false;
    hour = 0;
    minute = 0;
    second = 0;
    count = 0;
    document.getElementById('hr').innerHTML = "00";
    document.getElementById('min').innerHTML = "00";
    document.getElementById('sec').innerHTML = "00";
    document.getElementById('count').innerHTML = "00";
});

function stopWatch() {
    if (timer) {
        count++;

        if (count == 100) {
            second++;
            count = 0;
        }

        if (second == 60) {
            minute++;
            second = 0;
        }

        if (minute == 60) {
            hour++;
            minute = 0;
            second = 0;
        }

        let hrString = hour;
        let minString = minute;
        let secString = second;
        let countString = count;

        if (hour < 10) {
            hrString = "0" + hrString;
        }

        if (minute < 10) {
            minString = "0" + minString;
        }

        if (second < 10) {
            secString = "0" + secString;
        }

        if (count < 10) {
            countString = "0" + countString;
        }

        document.getElementById('hr').innerHTML = hrString;
        document.getElementById('min').innerHTML = minString;
        document.getElementById('sec').innerHTML = secString;
        document.getElementById('count').innerHTML = countString;
        setTimeout(stopWatch, 10);
    }
}








(function () {
    var Util,
      __bind = function (fn, me) {
        return function () {
          return fn.apply(me, arguments);
        };
      };

    Util = (function () {
      function Util() {}

      Util.prototype.extend = function (custom, defaults) {
        var key, value;
        for (key in custom) {
          value = custom[key];
          if (value != null) {
            defaults[key] = value;
          }
        }
        return defaults;
      };

      Util.prototype.isMobile = function (agent) {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
          agent
        );
      };

      return Util;
    })();

    this.WOW = (function () {
      WOW.prototype.defaults = {
        boxClass: "wow",
        animateClass: "animated",
        offset: 0,
        mobile: true
      };

      function WOW(options) {
        if (options == null) {
          options = {};
        }
        this.scrollCallback = __bind(this.scrollCallback, this);
        this.scrollHandler = __bind(this.scrollHandler, this);
        this.start = __bind(this.start, this);
        this.scrolled = true;
        this.config = this.util().extend(options, this.defaults);
      }

      WOW.prototype.init = function () {
        var _ref;
        this.element = window.document.documentElement;
        if (
          (_ref = document.readyState) === "interactive" ||
          _ref === "complete"
        ) {
          return this.start();
        } else {
          return document.addEventListener("DOMContentLoaded", this.start);
        }
      };

      WOW.prototype.start = function () {
        var box, _i, _len, _ref;
        this.boxes = this.element.getElementsByClassName(this.config.boxClass);
        if (this.boxes.length) {
          if (this.disabled()) {
            return this.resetStyle();
          } else {
            _ref = this.boxes;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
              box = _ref[_i];
              this.applyStyle(box, true);
            }
            window.addEventListener("scroll", this.scrollHandler, false);
            window.addEventListener("resize", this.scrollHandler, false);
            return (this.interval = setInterval(this.scrollCallback, 50));
          }
        }
      };

      WOW.prototype.stop = function () {
        window.removeEventListener("scroll", this.scrollHandler, false);
        window.removeEventListener("resize", this.scrollHandler, false);
        if (this.interval != null) {
          return clearInterval(this.interval);
        }
      };

      WOW.prototype.show = function (box) {
        this.applyStyle(box);
        return (box.className =
          "" + box.className + " " + this.config.animateClass);
      };

      WOW.prototype.applyStyle = function (box, hidden) {
        var delay, duration, iteration;
        duration = box.getAttribute("data-wow-duration");
        delay = box.getAttribute("data-wow-delay");
        iteration = box.getAttribute("data-wow-iteration");
        return box.setAttribute(
          "style",
          this.customStyle(hidden, duration, delay, iteration)
        );
      };

      WOW.prototype.resetStyle = function () {
        var box, _i, _len, _ref, _results;
        _ref = this.boxes;
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          box = _ref[_i];
          _results.push(box.setAttribute("style", "visibility: visible;"));
        }
        return _results;
      };

      WOW.prototype.customStyle = function (hidden, duration, delay, iteration) {
        var style;
        style = hidden
          ? "visibility: hidden; -webkit-animation-name: none; -moz-animation-name: none; animation-name: none;"
          : "visibility: visible;";
        if (duration) {
          style +=
            "-webkit-animation-duration: " +
            duration +
            "; -moz-animation-duration: " +
            duration +
            "; animation-duration: " +
            duration +
            ";";
        }
        if (delay) {
          style +=
            "-webkit-animation-delay: " +
            delay +
            "; -moz-animation-delay: " +
            delay +
            "; animation-delay: " +
            delay +
            ";";
        }
        if (iteration) {
          style +=
            "-webkit-animation-iteration-count: " +
            iteration +
            "; -moz-animation-iteration-count: " +
            iteration +
            "; animation-iteration-count: " +
            iteration +
            ";";
        }
        return style;
      };

      WOW.prototype.scrollHandler = function () {
        return (this.scrolled = true);
      };

      WOW.prototype.scrollCallback = function () {
        var box;
        if (this.scrolled) {
          this.scrolled = false;
          this.boxes = function () {
            var _i, _len, _ref, _results;
            _ref = this.boxes;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
              box = _ref[_i];
              if (!box) {
                continue;
              }
              if (this.isVisible(box)) {
                this.show(box);
                continue;
              }
              _results.push(box);
            }
            return _results;
          }.call(this);
          if (!this.boxes.length) {
            return this.stop();
          }
        }
      };

      WOW.prototype.offsetTop = function (element) {
        var top;
        top = element.offsetTop;
        while ((element = element.offsetParent)) {
          top += element.offsetTop;
        }
        return top;
      };

      WOW.prototype.isVisible = function (box) {
        var bottom, offset, top, viewBottom, viewTop;
        offset = box.getAttribute("data-wow-offset") || this.config.offset;
        viewTop = window.pageYOffset;
        viewBottom = viewTop + this.element.clientHeight - offset;
        top = this.offsetTop(box);
        bottom = top + box.clientHeight;
        return top <= viewBottom && bottom >= viewTop;
      };

      WOW.prototype.util = function () {
        return this._util || (this._util = new Util());
      };

      WOW.prototype.disabled = function () {
        return !this.config.mobile && this.util().isMobile(navigator.userAgent);
      };

      return WOW;
    })();
  }.call(this));

  wow = new WOW({
    animateClass: "animated",
    offset: 100
  });
  wow.init();




