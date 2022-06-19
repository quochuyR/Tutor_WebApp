/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return generator._invoke = function (innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; }(innerFn, self, context), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; this._invoke = function (method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); }; } function maybeInvokeDelegate(delegate, context) { var method = delegate.iterator[context.method]; if (undefined === method) { if (context.delegate = null, "throw" === context.method) { if (delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method)) return ContinueSentinel; context.method = "throw", context.arg = new TypeError("The iterator does not provide a 'throw' method"); } return ContinueSentinel; } var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) { if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; } return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, define(Gp, "constructor", GeneratorFunctionPrototype), define(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (object) { var keys = []; for (var key in object) { keys.push(key); } return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) { "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); } }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

(function () {
  $(document).ready(function () {
    var urlProvince = "https://vapi.vnappmob.com/api/province/";
    var DOMprovinces = document.querySelector("#provinces");
    var DOMDistricts = document.querySelector("#districts");
    var optionOfSelectt = "<option  value=\"0\">--Ch\u1ECDn huy\u1EC7n--</option>";
    if (DOMDistricts) DOMDistricts.innerHTML = "<select  id=\"districts\" value=\"0\" name=\"districts[]\" class=\"mx-2 form-select\" >".concat(optionOfSelectt, "</select>");

    function isEmptyObj(obj) {
      return Object.keys(obj).length === 0;
    } // fetch api


    function postData() {
      return _postData.apply(this, arguments);
    }

    function _postData() {
      _postData = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
        var url,
            method,
            data,
            response,
            _args = arguments;
        return _regeneratorRuntime().wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                url = _args.length > 0 && _args[0] !== undefined ? _args[0] : '';
                method = _args.length > 1 ? _args[1] : undefined;
                data = _args.length > 2 ? _args[2] : undefined;
                _context.next = 5;
                return fetch(url, {
                  method: method,
                  cache: 'no-cache',
                  mode: 'cors',
                  headers: {
                    "Access-Control-Allow-Origin": "*",
                    'Content-Type': 'application/json'
                  },
                  credentials: 'same-origin',
                  redirect: 'follow',
                  body: isEmptyObj(data) ? undefined : JSON.stringify(data)
                });

              case 5:
                response = _context.sent;
                return _context.abrupt("return", response.json());

              case 7:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }));
      return _postData.apply(this, arguments);
    }

    DOMprovinces && $.ajax({
      type: "get",
      url: urlProvince,
      cache: false,
      success: function success(data) {
        // if(data !== '0')
        var ObjProvinces = Object.assign({}, data); // copy to new obj

        var provinces = _toConsumableArray(Object.values(ObjProvinces)); // convert to array
        // create many options of select


        var optionOfSelect = "<option value=\"0\">--Ch\u1ECDn t\u1EC9nh--</option>";
        provinces[0].map(function (val, idx) {
          optionOfSelect += "<option value=\"".concat(val.province_id, "\">").concat(val.province_name, "</option>"); // console.log()
        });
        console.log(provinces);
        DOMprovinces.innerHTML = "<select id = \"province\" name=\"province\" class=\"form-select\" >".concat(optionOfSelect, "</select>"); // join option into select

        console.log(data, "data");
      },
      error: function error(xhr, status, _error) {
        console.log(xhr, _error, status, "Lỗi");
      }
    }); // District 

    DOMprovinces === null || DOMprovinces === void 0 ? void 0 : DOMprovinces.addEventListener('change', function (e) {
      // $(".js-data-districts-ajax option[value='']")?.remove();
      select2District(e);
    });

    function select2District(e) {
      $('.js-data-districts-ajax').select2({
        theme: 'bootstrap-5',
        language: "vi",
        multiple: true,
        ajax: {
          url: "https://vapi.vnappmob.com/api/province/district/".concat(e.target.value),
          type: "get",
          dataType: 'json',
          delay: 250,
          data: function data(params) {
            return {
              term: params.term
            };
          },
          processResults: function processResults(data, params) {
            params.term = params.term ? params.term : 'all';
            console.log(params); // Transforms the top-level key of the response object from 'items' to 'results'

            return {
              results: $.map(data.results, function (val) {
                // console.log(val.district_name.toUpperCase().includes(params.term.toUpperCase()), "pấm")
                if (params.term === 'all') {
                  return {
                    id: val.district_id,
                    text: val.district_name
                  };
                }

                if (val.district_name.toUpperCase().includes(params.term.toUpperCase())) {
                  return {
                    id: val.district_id,
                    text: val.district_name
                  };
                }
              })
            };
          },
          cache: true
        },
        placeholder: 'Gõ chữ bất kì để tìm huyện'
      }).on("select2:close", function (e) {
        // validation select2
        $(this).valid();
      });
    } //
    // 


    $('.js-data-subjects-ajax').select2({
      theme: 'bootstrap-5',
      language: "vi",
      ajax: {
        url: '../api/subjecttopic/getsubjecttopicbyquery',
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function data(params) {
          var query = {
            q: params.term,
            num: !params.term && 'all'
          }; // Query parameters will be ?search=[term]&type=public

          return query;
        },
        processResults: function processResults(data, params) {
          // Transforms the top-level key of the response object from 'items' to 'results'
          return {
            results: data
          };
        },
        cache: true
      },
      placeholder: 'Gõ chữ bất kì để tìm chủ đề',
      minimumInputLength: 0 // templateResult: formatRepo,
      // templateSelection: formatRepoSelection

    }).on("select2:close", function (e) {
      // validation select2
      $(this).valid();
    });
    $('.js-data-teaching-form-ajax').select2({
      theme: 'bootstrap-5',
      language: "vi",
      multiple: true,
      data: [{
        id: 0,
        text: "Trực tuyến (Online)"
      }, {
        id: 1,
        text: "Gặp mặt (Offline)"
      }],
      placeholder: 'Gõ chữ bất kì để tìm hình thức dạy' // templateResult: formatRepo,
      // templateSelection: formatRepoSelection

    }).on("select2:close", function (e) {
      // validation select2
      $(this).valid();
    });
    $(".signin-form").validate({
      ignore: [],
      rules: {
        "username": {
          required: true,
          minlength: 5
        },
        "password": {
          required: true,
          minlength: 5
        }
      },
      messages: {
        "username": "Tài khoản ít nhất 5 ký tự.",
        "password": "Mật khẩu ít nhất 5 ký tự."
      },
      errorPlacement: function errorPlacement(label, element) {
        if (label) label.insertBefore($(element).parent()).addClass('mb-2 text-danger');
      },
      submitHandler: function submitHandler(form) {
        // submitRegisterForm();
        // form.submit();
        var response = grecaptcha.getResponse(); //recaptcha failed validation
        // if (response.length == 0) {
        //   $('#recaptcha-error').show();
        //   return false;
        // }
        //   //recaptcha passed validation
        // else {
        //   $('#recaptcha-error').hide();
        //   return true;
        // }
      }
    }); // Đăng nhập

    window.recaptchaCallback = function () {
      if (grecaptcha.getResponse() !== "") {
        $("#recaptcha-error").text("");
        return true;
      }
    };

    $(".signin-form").on('submit', function (e) {
      e.preventDefault();
      var $form = $(e.target);

      if (grecaptcha.getResponse() == "") {
        $("#recaptcha-error").text("Bạn chưa chọn recaptcha.");
        return false;
      }

      if (!$form.valid()) return false;
      var token = $("#token").val();
      var username = $("#username-field").val();
      var password = $("#password-field").val();
      var remember = $("#remember-me").prop("checked");
      console.log(username, remember, password);
      $.ajax({
        type: "post",
        url: "../pages/login",
        data: {
          token: token,
          username: username,
          password: password,
          remember: remember,
          "g-recaptcha-response": grecaptcha.getResponse()
        },
        cache: false,
        success: function success(data) {
          // if(data !== '0')
          // grecaptcha.reset();
          // $('#staticBackdrop').modal('hide'); // Tự nhiên cái màn đen che mất tiêu thấy ghét xoá luôn :))
          // $("#signup-signin").removeClass("d-block").addClass("d-none"); // đăng nhập xong ẩn đăng kí/đăng nhập
          // $("#login").replaceWith(data);
          logout(); // khi đăng nhập xong mới hiện logout nên để logout ở đây
          // console.log(data, "data")
          // console.log($("#username-field").val(), "Tài khoản")
          // if (window.location.pathname.includes("tutor_details"))

          if (data.login === 'fail-user-pass') {
            $("#error-login").html("<div class=\"alert alert-danger\" role=\"alert\">\n                                        <span class=\"el-alert__title\">".concat(data.message, "</span>\n                                    </div>"));
            grecaptcha.reset();
          } else if (data.login === "fail-user-verification") {
            $("#error-login").html("<div class=\"alert alert-danger\" role=\"alert\">\n                                      <span class=\"el-alert__title\">".concat(data.message, "</span>\n                                  </div>"));
          } else if (data.login === "successful") {
            window.location = data.url;
          }

          console.log(data);
        },
        error: function error(xhr, status, _error2) {
          console.log(xhr, _error2, status, "Lỗi");
        }
      });
    }); // Đăng xuất

    function logout() {
      $(".logout").on('click', function (e) {
        e.preventDefault();
        clearForm(); //clear không thôi người ta thấy username and password

        console.log($(".logout").attr("href-action"), "$(\".logout\").attr(\"href\")");
        $.ajax({
          type: "post",
          url: "../inc/header",
          data: {
            action: $(".logout").attr("href-action")
          },
          cache: false,
          success: function success(data) {
            // if(data !== '0')
            clearForm(); //clear không thôi người ta thấy username and password

            $('#staticBackdrop').modal('hide'); // Tự nhiên cái màn đen che mất tiêu thấy ghét xoá luôn :))

            $("#login").removeClass("d-flex justify-content-center align-items-center").addClass("d-none"); // đăng xuất thì ẩn đăng nhập thành công

            $("#signup-signin").replaceWith(data);
            if (window.location.pathname.includes("saved_tutors")) location.href = "../pages/list_tutor";else location.reload();
            console.log(data, "data");
          },
          error: function error(xhr, status, _error3) {
            console.log(xhr, _error3, status, "Lỗi");
          }
        });
      });
    }

    function clearForm() {
      $("#username-field").val('');
      $("#password-field").val('');
    }

    logout();
  }); // validation form
})();
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!********************************!*\
  !*** ./resources/js/scroll.js ***!
  \********************************/
// Select all links with hashes
$('#buttonClickScroll').click(function (event) {
  // On-page links
  if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
    // Figure out element to scroll to
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']'); // Does a scroll target exist?

    if (target.length) {
      // Only prevent default if animation is actually gonna happen
      event.preventDefault();
      $('html, body').animate({
        scrollTop: target.offset().top
      }, 1000, function () {
        // Callback after animation
        // Must change focus!
        var $target = $(target);
        $target.focus();

        if ($target.is(":focus")) {
          // Checking if the target was focused
          return false;
        } else {
          $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable

          $target.focus(); // Set focus again
        }

        ;
      });
    }
  }
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!***********************************!*\
  !*** ./resources/js/utilities.js ***!
  \***********************************/
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

(function () {
  // URL province api
  var offset = 0,
      numNotification = 2,
      responseNotification = true;
  $(document).ready(function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    }); // Thêm sự kiện click cho checkbox mục đích để xoá và thêm vào filter

    function onChangeCheckbox() {
      $("input[type=checkbox].checkbox-filter ").each(function (i, checkbox) {
        checkbox.addEventListener('click', function (e) {
          addAndRemoveFilter(e);
        });
      });
    }

    ;
    onChangeCheckbox(); // Gọi thẳng ở đây luôn vì cho lần đầu nó load mấy cái checkbox
    // Nhấn để thêm vào chỗ "lọc theo"

    $(".category").each(function (i, child) {
      if (child.nodeName === 'LI') {
        child.addEventListener('click', function (e) {
          addAndRemoveFilter(e); // console.log(current, "class");

          $(".subject-active").each(function (i, li) {
            // console.log(li.className, "li.className")
            if (li !== e.currentTarget) {
              if (li.className.includes("subject-active")) {
                var _$, _$2;

                li.className = li.className.replace(" subject-active", "");
                (_$ = $("div[data-category=\"".concat(li.getAttribute("subject-id"), "\""))) === null || _$ === void 0 ? void 0 : _$.remove();
                (_$2 = $("div[value=\"".concat(li.getAttribute("value"), "\""))) === null || _$2 === void 0 ? void 0 : _$2.remove(); // console.log(e.target.getAttribute("value"))
                // console.log(document.querySelector(`div[value="${e.currentTarget.getAttribute("value")}"`))
              }
            }
          });
          if (!e.currentTarget.className.includes("subject-active")) $(e.currentTarget).addClass(" subject-active"); // if($(".subject-active").length <= 0)
          //     $(`li[value="Tất cả"]`).addClass(" subject-active");
          // console.log(e.currentTarget.className.includes("subject-active"))
        });
      }
    });

    function addAndRemoveFilter(e) {
      var DIVFilter = document.querySelector("#filter");

      var listFilter = _toConsumableArray(DIVFilter.children); // console.log(listFilter.filter(val => {
      //     return val.getAttribute("value") === e.currentTarget.getAttribute("value")
      // }).length);
      // console.log(e.currentTarget.parentNode.getAttribute("data-category"))
      // Thêm filter môn học (việc lọc để tránh thêm trùng)


      if (listFilter.filter(function (val) {
        return val.getAttribute("value") === e.currentTarget.getAttribute("value");
      }).length <= 0 && e.currentTarget.getAttribute("type") !== 'checkbox') {
        DIVFilter.innerHTML += "<div class=\"green-label green-label-filter font-weight-bold p-0 px-1 mx-sm-1 mx-0 my-sm-0 my-2\" value=\"".concat(e.currentTarget.getAttribute("value"), "\">").concat(e.currentTarget.getAttribute("value"), " <span\n            class=\"px-1 close \" >&times;</span> </div>");
      } // Thêm filter của checkbox (việc lọc để tránh thêm trùng)
      else if (listFilter.filter(function (val) {
        return val.getAttribute("data-value") === e.currentTarget.parentNode.firstChild.nodeValue;
      }).length <= 0 && e.currentTarget.getAttribute("type") === 'checkbox' && e.currentTarget.checked) {
        DIVFilter.innerHTML += "<div class=\"green-label green-label-filter font-weight-bold p-0 px-1 mx-sm-1 mx-0 my-sm-0 my-2\"  data-category=\"".concat(e.currentTarget.parentNode.getAttribute("data-category"), "\" data-value=\"").concat(e.currentTarget.parentNode.firstChild.nodeValue, "\">").concat(e.currentTarget.parentNode.firstChild.nodeValue, " <span\n            class=\"px-1 close \" >&times;</span> </div>");
      } // Xoá khi checkbox checked bằng flase


      if ($(e.currentTarget).attr("type") === 'checkbox' && e.currentTarget.checked === false) {
        var _$3;

        (_$3 = $("div[data-value=\"".concat(e.currentTarget.parentNode.firstChild.nodeValue, "\""))) === null || _$3 === void 0 ? void 0 : _$3.remove();
      }

      $(".close").off().on('click', function (e) {
        var checkBoxValue = $(e.currentTarget.parentNode).attr("data-value"); // let LiValue = e.currentTarget.parentNode.getAttribute("value");

        var checkBoxReset = $("label[data-value=\"".concat(checkBoxValue, "\"]")); // console.log(checkBoxReset);
        // var current = document.querySelectorAll(".subject-active");
        // [...current].map(li => {
        //     if (li.getAttribute("value") === LiValue) {
        //         li.className = li.className.replace("subject-active", "")
        //     }
        // })
        // xoá checked khi xoá filter

        console.log(); // if (checkBoxReset[0]?.firstElementChild.nodeName === 'INPUT') {
        //     checkBoxReset[0].firstElementChild.checked = false;
        // }

        $(checkBoxReset).children("input[type='checkbox']").prop("checked", false); // console.log($(".category").first(), "123456");
        // Xoá hết thì thêm background xanh cho li Tất cả :))

        e.currentTarget.parentNode.remove(); // xoá khi click vào dấu x
        // khi xoá filter thì cập nhật lại gia sư
        //     $(`li[value="Tất cả"]`).addClass(" subject-active");
        // if (e.currentTarget.parentNode.("value") ) {
        //     e.currentTarget.parentNode.remove();

        filer_data(); // }
        // console.log($(".subject-active").length, "length")

        if ($("#filter").children().length <= 1) {
          $(".category").each(function (i, items) {
            if ($(items).attr("value") === "Tất cả") {
              $(items).addClass("subject-active");
            } else {
              $(items).removeClass("subject-active");
            }
          });
        }
      }); // onChangeCheckbox();  // Cái này dùng đề refresh các chủ đề khi click và môn học
    }

    if (checkMobile(/iPhone|iPad|iPod|Android/i)) {
      $(".text-sub").each(function (i, li) {
        li.textContent = li.textContent.substring(0, 103) + "...";
      });
    }

    function checkMobile(reg) {
      var isMobile = reg.test(navigator.userAgent);

      if (isMobile) {
        return true;
      }

      return false;
    }

    function placeholder(limit) {
      var placeholder = "";

      for (var i = 0; i < limit; i++) {
        placeholder += "<div class=\"col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 pt-md-0\">\n                <div class=\"card card-tutor\">\n                    <div class=\" card-img-top img-teacher text-center\">\n                        <svg class=\"bd-placeholder-img card-img-top\" width=\"100%\" height=\"180\" xmlns=\"http://www.w3.org/2000/svg\" role=\"img\" aria-label=\"Placeholder\" preserveAspectRatio=\"xMidYMid slice\" focusable=\"false\">\n                            <title>Placeholder</title>\n                            <rect width=\"100%\" height=\"100%\" fill=\"#868e96\"></rect>\n                        </svg>\n                    </div>\n                    <div class=\"card-body\">\n                        <h5 class=\"card-title placeholder-glow\">\n                            <span class=\"placeholder col-6\"></span>\n                        </h5>\n                        <p class=\"card-text placeholder-glow\">\n                            <span class=\"placeholder col-7\"></span>\n                            <span class=\"placeholder col-4\"></span>\n                            <span class=\"placeholder col-4\"></span>\n                            <span class=\"placeholder col-6\"></span>\n                            <span class=\"placeholder col-8\"></span>\n                        </p>\n                        <div class=\"d-flex align-items-center justify-content-between pt-1 position-absolute\" style=\"bottom: 1rem;\">\n                            <div class=\"d-flex flex-row\">\n                                <a href=\"#\" class=\"mx-1 social-list-item text-center border-primary text-primary disabled placeholder\"></a>\n                                <a href=\"#\" class=\"mx-1 social-list-item text-center border-info text-info disabled placeholder\"></a>\n                            </div>\n                            <!-- <div class=\"btn btn-primary\">\u0110\u0103ng k\xFD</div> -->\n                        </div>\n                    </div>\n                </div>\n            </div>";
      }

      return placeholder;
    } // page_data();


    filer_data();
    page_paginator();
    $("#filter-subject li").on('click', function (e) {
      // thêm subject filter
      $.ajax({
        type: "post",
        url: "../api/subjecttopic/topicfilter",
        data: {
          subject: $(e.currentTarget).attr('subject-id') // lấy giá trị của thuộc tính subject-id

        },
        cache: false,
        success: function success(data) {
          console.log(data, "chủ đề");
          $(".topic-container").html(data); // Thêm đoạn html vào id topic (response từ ajax)

          onChangeCheckbox(); // Cái này dùng đề refresh các chủ đề khi click và môn học

          $(".topic").on('click', function (e) {
            // Để ở đây cũng chủ yếu là để refresh các checkbox của 
            // chủ đề khi mới thêm vào (cập nhật lại DOM)
            filer_data(); // gọi hàm thực thi filter
          });
          filer_data();
        },
        error: function error(xhr, status, _error) {
          console.error(xhr);
        }
      });
    });
    $(".checkbox-filter").on('click', function () {
      // filter khi all checkbox bị click
      filer_data();
    }); // lọc dữ liệu

    function filer_data() {
      var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      var url = $(e === null || e === void 0 ? void 0 : e.currentTarget).attr('href') ? $(e.currentTarget).attr('href') : "9&1"; // check có thẻ a chưa 

      var _url$split = url.split("&"),
          _url$split2 = _slicedToArray(_url$split, 2),
          limit = _url$split2[0],
          page = _url$split2[1];

      var placeholder_tutor = placeholder(limit);
      $("#tutors .row").html(placeholder_tutor);
      console.log(limit, page, url);
      var token = $("#token").val();
      var subject = $(".category.subject-active").attr("subject-id");
      var topic = get_filter_arr(".topic:checked");
      var status = get_filter_str(".teachingForm:checked");
      var sex = get_filter_arr(".sex:checked");
      var type = get_filter_arr(".type:checked");
      console.log(status, token, "get value ");
      $.ajax({
        type: "post",
        url: "../api/tutor/listtutors",
        data: {
          token: token,
          subject: subject,
          topic: topic,
          status: status,
          sex: sex,
          type: type,
          limit: limit,
          page: page
        },
        cache: false,
        success: function success(data) {
          var _document$querySelect;

          $("#tutors .row").html(data);
          (_document$querySelect = document.querySelector('#top-filter')) === null || _document$querySelect === void 0 ? void 0 : _document$querySelect.scrollIntoView({
            behavior: "smooth",
            block: 'nearest',
            inline: 'start'
          });
          page_paginator(); // console.log(data)
        },
        error: function error(xhr, status, _error2) {
          console.error(xhr);
        }
      });
    }

    function page_paginator() {
      $(".link-ajax").off().on('click', function (e) {
        e.preventDefault();
        filer_data(e);
      });
    } // Lưu gia sư
    // dữ liệu trả về sẽ như thế này Toán, Vật lý, Hoá,


    function get_filter_str(className) {
      var data = "";

      if ($(className).length === 1) {
        return $(className).val() + ",";
      } else if ($(className).length > 1) {
        $(className).each(function (i, val) {
          data += $(val).val() + ', '; // console.log($(val).val(), "val")
        });
        return data.trim();
      }

      return;
    }

    function get_filter_arr(className) {
      var data = [];
      $(className).each(function (i, val) {
        data.push($(val).val()); // console.log($(val).val(), "val")
      });
      return data;
    }

    $("#more-notification").on('click', function (e) {
      offset += 2; // thêm subject filter

      responseNotification && $.ajax({
        type: "post",
        url: "../api/notification/getnotificationmore",
        data: {
          numNotification: numNotification,
          // lấy giá trị của thuộc tính subject-id
          offset: offset
        },
        cache: false,
        success: function success(data) {
          var _document$querySelect2;

          console.log(data, "thông báo");

          if (!data) {
            responseNotification = false;
            return;
          }

          $(".list-notification").last().append(data);
          (_document$querySelect2 = document.querySelector('#end-notification')) === null || _document$querySelect2 === void 0 ? void 0 : _document$querySelect2.scrollIntoView({
            behavior: "smooth",
            block: 'nearest',
            inline: 'start'
          });
        },
        error: function error(xhr, status, _error3) {
          console.error(xhr);
        }
      });
    });
  });

  (function ($) {
    "use strict";

    $('nav .dropdown').hover(function () {
      var $this = $(this);
      $this.addClass('show');
      $this.find('> a').attr('aria-expanded', true);
      $this.find('.dropdown-menu').addClass('show');
    }, function () {
      var $this = $(this);
      $this.removeClass('show');
      $this.find('> a').attr('aria-expanded', false);
      $this.find('.dropdown-menu').removeClass('show');
    });
  })(jQuery);

  (function ($) {
    "use strict";

    $(".toggle-password").click(function () {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));

      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  })(jQuery); // Xem hình ảnh lớn và rõ hơn


  $("img:not(.avatar)").on('click', function (e) {
    var DIVShowImg = $(".img-float");
    var Img = $(".img-float>img");
    DIVShowImg.removeClass("d-none");
    console.log(Img);
    console.log(e.target);
    $(Img).prop("src", $(e.target).prop("src"));
    $('body').css("overflow-y", "hidden");
    $(".img-float").off().on('click', function (e) {
      $(e.currentTarget).addClass('d-none');
      $('body').css("overflow-y", "scroll");
    });
  });
})();
})();

/******/ })()
;