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
            grecaptcha.reset();
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

    function load_unseen_notification() {
      var view = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
      $.ajax({
        type: "post",
        url: "../api/notification/getnotification",
        data: {
          view: view
        },
        cache: false,
        success: function success(data) {
          if (data.unseen_notification > 0) {
            $('.new-notification-list').html(data.notification);
            $('#num_unread_notification').html(data.unseen_notification);
          } else {}

          console.log(data, "noti");
        },
        error: function error(xhr, status, _error4) {
          console.error(xhr);
        }
      });
    }

    function load_seen_notification() {
      $.ajax({
        type: "post",
        url: "../api/notification/getseennotification",
        data: {
          num_notification: 3,
          offset: 0
        },
        cache: false,
        success: function success(data) {
          if (data.get_notification === "successful") {
            $('.list-notification').html(data.notification);
          }

          console.log(data, "noti_seen");
        },
        error: function error(xhr, status, _error5) {
          console.error(xhr);
        }
      });
    }

    load_seen_notification();
    load_unseen_notification();
    $('.dropdown-notification').on('shown.bs.dropdown', function () {
      // do something...
      load_seen_notification();
      load_unseen_notification('yes');
    });
    $('.dropdown-notification').on('hidden.bs.dropdown', function () {
      // do something...
      $('#num_unread_notification').html(0);
      $('.new-notification-list').html('<a href="#" class="d-flex list-group-item list-group-item-action border-0 text-small">Không có thông báo</a>');
    }); // load_new_notification();

    function load_new_notification() {
      load_unseen_notification();
      setTimeout(load_new_notification, 10000);
    }
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

    function select2_ajax(selector, dropdownParent, urlAjax, dataAjax, processResultsAjax, placeholder) {
      var select2 = $(selector).select2({
        theme: 'bootstrap-5',
        language: "vi",
        dropdownParent: dropdownParent,
        ajax: {
          url: urlAjax,
          type: "post",
          dataType: 'json',
          delay: 250,
          data: dataAjax,
          processResults: processResultsAjax,
          cache: true
        },
        placeholder: placeholder,
        minimumInputLength: 0 // templateResult: formatRepo,
        // templateSelection: formatRepoSelection

      }).on("select2:close", function (e) {// validation select2
        // $(this).valid();
      });
      return select2;
    }

    function placeholder(limit) {
      var placeholder = "";

      for (var i = 0; i < limit; i++) {
        placeholder += "<div class=\"col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 pt-md-0\">\n                <div class=\"card card-tutor\">\n                    <div class=\" card-img-top img-teacher text-center\">\n                        <svg class=\"bd-placeholder-img card-img-top\" width=\"100%\" height=\"180\" xmlns=\"http://www.w3.org/2000/svg\" role=\"img\" aria-label=\"Placeholder\" preserveAspectRatio=\"xMidYMid slice\" focusable=\"false\">\n                            <title>Placeholder</title>\n                            <rect width=\"100%\" height=\"100%\" fill=\"#868e96\"></rect>\n                        </svg>\n                    </div>\n                    <div class=\"card-body\">\n                        <h5 class=\"card-title placeholder-glow\">\n                            <span class=\"placeholder col-6\"></span>\n                        </h5>\n                        <p class=\"card-text placeholder-glow\">\n                            <span class=\"placeholder col-7\"></span>\n                            <span class=\"placeholder col-4\"></span>\n                            <span class=\"placeholder col-4\"></span>\n                            <span class=\"placeholder col-6\"></span>\n                            <span class=\"placeholder col-8\"></span>\n                        </p>\n                        <div class=\"d-flex align-items-center justify-content-between pt-1 position-absolute\" style=\"bottom: 1rem;\">\n                            <div class=\"d-flex flex-row\">\n                                <a href=\"#\" class=\"mx-1 social-list-item text-center border-primary text-primary disabled placeholder\"></a>\n                                <a href=\"#\" class=\"mx-1 social-list-item text-center border-info text-info disabled placeholder\"></a>\n                            </div>\n                            <!-- <div class=\"btn btn-primary\">\u0110\u0103ng k\xFD</div> -->\n                        </div>\n                    </div>\n                </div>\n            </div>";
      }

      return placeholder;
    }

    select2_ajax('.js-data-province-filter-ajax', null, '../api/tutor/getcurrentplacetutor', function (params) {
      var query = {
        q: params.term,
        num: !params.term && 'all'
      }; // Query parameters will be ?search=[term]&type=public

      return query;
    }, function (data, params) {
      console.log(data); // Transforms the top-level key of the response object from 'items' to 'results'

      return {
        results: data
      };
    }, 'Gõ chữ bất kì để tìm Tỉnh/Thành Phố'); // page_data();

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
    });
    $("#select_province").on('change', function () {
      filer_data();
    }); // lọc dữ liệu

    function filer_data() {
      var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      if (!document.querySelector("#tutors .row")) return false;
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
      var province = get_filter_str("#select_province option:selected"); // console.log(status, token, "get value ")

      console.log(province, "prov");
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
          province: province,
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
      var _this = this;

      var data = "";
      $(className).each(function (i, val) {
        // console.log($(this).length)
        if (i === $(_this).length - 1) data += $(val).val();else data += $(val).val() + ', '; // console.log($(val).val(), "val")
      });
      return data.trim();
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
      offset += 3;
      responseNotification && $.ajax({
        type: "post",
        url: "../api/notification/getnotificationmore",
        data: {
          numNotification: numNotification,
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

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*****************************************!*\
  !*** ./resources/js/schedule_tutors.js ***!
  \*****************************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

(function () {
  var hasFirstFilter = true; // biến toàn cục dùng để kiểm tra load thứ lần đầu tiên

  var th_id = null; // biến toàn cục dùng để lưu id

  var container_schedule = null; // biến toàn cục dùng để lưu nơi chứa thông tin dạy kèm

  var td_day = null; // biến toàn cục dùng để lưu thư trước khi update mục địch trả về trạng thái thứ còn trống khi đã cập nhật thứ khác

  var td_time = null; // biến toàn cục dùng để lưu thời gian trước khi update  mục địch trả về trạng thái thời gian còn trống khi đã cập nhật thời gian khác

  var td_topic_name = null; // biến toàn cục dùng để lưu chủ đề trước khi update  mục địch trả về trạng thái chủ đề còn trống khi đã cập nhật chủ đề khác

  $(document).ready(function () {
    filer_data_tutoringSchedule();
    $(".form-select").on('change', function (e) {
      filer_data_tutoringSchedule();
    });

    function page_paginator() {
      $(".link-ajax").off().on('click', function (e) {
        e.preventDefault();
        filer_data_tutoringSchedule(e);
      });
    } // lọc dữ liệu


    function filer_data_tutoringSchedule() {
      var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      if (!document.querySelector("#tutoring-schedule")) return false;
      $("#tutoring-schedule").html("<div class=\"spinner-border text-primary d-flex mx-auto\" role=\"status\">\n                        <span class=\"sr-only\">Loading...</span>\n                    </div>");
      var params = new Proxy(new URLSearchParams(window.location.search), {
        get: function get(searchParams, prop) {
          return searchParams.get(prop);
        }
      }); // get uid param
      // dùng để lấy lịch dạy của một user duy nhất

      var uid = params.uid; // "some_value"

      var url = $(e === null || e === void 0 ? void 0 : e.target).attr('href') ? $(e.target).attr('href') : "3&1"; // check có thẻ a chưa 

      var _url$split = url.split("&"),
          _url$split2 = _slicedToArray(_url$split, 2),
          limit = _url$split2[0],
          page = _url$split2[1];

      console.log(limit, page, url);
      var day = null;

      if (hasFirstFilter) {
        if ($("#dayofweek option[value=\"".concat(new Date().getDay(), "\"]")).prop("selected", true).length === 0) day = 8; // không có ngày thứ 8 mục đích là trả về "không có lịch dạy hôm nay."

        hasFirstFilter = false;
      } //    console.log($(`#dayofweek option[value="${ 3}"]`).prop("selected", true), "dayofweek");


      if (!hasFirstFilter) {
        day = $("#dayofweek").val();
      }

      var subjectTopic = $("#subject-topic").val();
      var startTime = $("#time-start").val();
      var endTime = $("#time-end").val();
      console.log([day, subjectTopic, startTime, endTime], "get value ");
      $.ajax({
        type: "post",
        url: "../api/scheduletutor/schedule_tutor",
        data: {
          day: day,
          subjectTopic: subjectTopic,
          startTime: startTime,
          endTime: endTime,
          uid: uid,
          limit: limit,
          page: page
        },
        cache: false,
        success: function success(data) {
          var _$;

          (_$ = $("#tutoring-schedule")) === null || _$ === void 0 ? void 0 : _$.html(data);
          page_paginator();
          OnchangeSelectDoW();
          console.log(data);
          /**/

          onClickBtnEdit();
          /* */

          onClickUpdateSchedule();
          /* */

          /* */

          onClickDeleteSchedule();
          /* */

          console.log($(".container-schedule"), "container-schedule");
        },
        error: function error(xhr, status, _error) {
          console.error(xhr);
        }
      });
    }

    function onClickUpdateSchedule() {
      $(".btn-modal-save").off().on('click', function (e) {
        var main_body_modal = $(e.target).closest(".modal-footer").prev(".modal-body");
        var dayofweek = $(main_body_modal).find("select").eq(0).val();
        var time = $(main_body_modal).find("select").eq(1).val();
        var subjecttopic = $(main_body_modal).find("select").eq(2).val();
        /* Update lịch dạy ở đây */
        // console.log([td_day ,dayofweek , $(td_time).attr("data-value") , time , td_topic_name , subjecttopic])
        // if(td_day !== dayofweek || $(td_time).attr("data-value") !== time || td_topic_name !== subjecttopic)

        updateScheduleTutor(th_id, dayofweek, time, subjecttopic, $(td_day).attr("data-value"), $(td_time).attr("data-value"));
        /* */
      });
    }

    function onClickDeleteSchedule() {
      $(".delete-schedule").off().on('click', function (e) {
        if (confirm("Bạn có chắn chắn muốn xoá?") === false) return 0;
        var container_schedule = $(e.target).closest(".container-schedule");
        var th_id = container_schedule.children(".th-id").attr("data-value");
        $(container_schedule).remove();
        /* Xoá lịch dạy ở đây */

        $.ajax({
          type: "post",
          url: "../api/scheduletutor/deleteschudule",
          data: {
            id: th_id
          },
          cache: false,
          success: function success(data) {
            if (data.action === "success") {
              $(container_schedule).remove();
              Toastify({
                text: "Xoá thành công!",
                duration: 5000,
                close: true,
                gravity: "top",
                // `top` or `bottom`
                position: "right",
                // `left`, `center` or `right`
                stopOnFocus: true,
                // Prevents dismissing of toast on hover
                style: {
                  background: "linear-gradient(to right, #C73866, #FE676E)"
                },
                onClick: function onClick() {} // Callback after click

              }).showToast();
            } // console.log($(td_options).html());
            // page_paginator();


            console.log(data);
          },
          error: function error(xhr, status, _error2) {
            console.error(xhr);
          }
        });
        /* */
      });
    }

    function referenceDataFromTableToModal(e) {
      container_schedule = $(e.target).closest(".container-schedule");
      th_id = container_schedule.children(".th-id").attr("data-value");
      td_day = container_schedule.children(".td-day");
      td_time = container_schedule.children(".td-time");
      td_topic_name = container_schedule.children(".td-topic-name");
    }

    function onClickBtnEdit() {
      $(".edit-schedule").off().on('click', function (e) {
        referenceDataFromTableToModal(e);
        getDaySchedule(e);
        var id_modal = $(e.target).attr("data-bs-target"); // $(id_modal).find(`select option[value="${-1}"]`).eq(0).prop("selected", true); // select teaching day in modal

        $(id_modal).find("select").eq(1).html("<option value=\"0\">-- Bu\u1ED5i h\u1ECDc --</option> <option value=\"".concat($(td_time).attr("data-value"), "\" selected> ").concat($(td_time).text(), " </option>")); // select teaching time in modal

        $(id_modal).find("select").eq(2).val($(td_topic_name).attr("data-value")); // select teaching subject topic in modal
      });
    }

    function updateScheduleTutor(id, dayofweek, time, subject_topic, dayofweek_prev, time_prev) {
      $.ajax({
        type: "post",
        url: "../api/scheduletutor/updateschedule",
        data: {
          id: id,
          dayofweek: dayofweek,
          time: time,
          subject_topic: subject_topic,
          dayofweek_prev: dayofweek_prev,
          time_prev: time_prev
        },
        cache: false,
        success: function success(data) {
          var td_options = $(container_schedule).children(".td-options"); // console.log($(td_options).html());
          // $(container_schedule).html(`${data} <td scope="row" class="text-start td-options">${$(td_options).html()}</td>`);
          // page_paginator();

          _toConsumableArray(data).forEach(function (row) {
            $(td_day).attr("data-value", row.dayofweekId);
            $(td_day).text(row.day);
            $(td_time).attr("data-value", row.timeId);
            $(td_time).text(row.time);
            $(td_topic_name).attr("data-value", row.subject_topicId);
            $(td_topic_name).text(row.topicName);
          });

          if (data) {
            Toastify({
              text: "S\u1EEDa th\xE0nh c\xF4ng.",
              duration: 3000,
              close: true,
              gravity: "top",
              // `top` or `bottom`
              position: "right",
              // `left`, `center` or `right`
              stopOnFocus: true,
              // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #C73866, #FE676E)"
              },
              onClick: function onClick() {} // Callback after click

            }).showToast();
          }

          console.log(data);
        },
        error: function error(xhr, status, _error3) {
          console.error(xhr);
        }
      });
    }

    function OnchangeSelectDoW() {
      $(".teaching-day").off().on('change', function (e) {
        getTimeFromDay(e);
      });
    }

    function getTimeFromDay(e) {
      var dayofweek = $(e.target).val();
      var index = $(".teaching-day").index(e.target);
      $.ajax({
        type: "post",
        url: "../api/time/getTimeFromDay",
        data: {
          dayofweek: dayofweek
        },
        cache: false,
        success: function success(data) {
          $(".teaching-time").eq(index).html(data);
          console.log(data);
        },
        error: function error(xhr, status, _error4) {
          console.error(xhr);
        }
      });
    }

    function getDaySchedule(e) {
      var id_modal = $(e.target).attr("data-bs-target");
      var dayofweek = $(id_modal).find("select").eq(0);
      console.log($(td_day).attr("data-value"), "td day");
      $.ajax({
        type: "post",
        url: "../api/day/getdayschedule",
        data: {
          action: "getDay"
        },
        cache: false,
        success: function success(data) {
          dayofweek.html(data);
          $(dayofweek).children("option[value=\"".concat($(td_day).attr("data-value"), "\"]")).prop("selected", true); // When we click the edit button, we can select a data value.

          console.log(data);
        },
        error: function error(xhr, status, _error5) {
          console.error(xhr);
        }
      });
    }
  });
})();
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!***************************************!*\
  !*** ./resources/js/schedule_user.js ***!
  \***************************************/
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

(function () {
  var hasFirstFilter = true; // biến toàn cục dùng để kiểm tra load thứ lần đầu tiên

  var th_id = null; // biến toàn cục dùng để lưu id

  var container_schedule = null; // biến toàn cục dùng để lưu nơi chứa thông tin dạy kèm

  var td_day = null; // biến toàn cục dùng để lưu thư trước khi update mục địch trả về trạng thái thứ còn trống khi đã cập nhật thứ khác

  var td_time = null; // biến toàn cục dùng để lưu thời gian trước khi update  mục địch trả về trạng thái thời gian còn trống khi đã cập nhật thời gian khác

  var td_topic_name = null; // biến toàn cục dùng để lưu chủ đề trước khi update  mục địch trả về trạng thái chủ đề còn trống khi đã cập nhật chủ đề khác

  $(document).ready(function () {
    filer_data_user_schedule();
    $(".form-select").on('change', function (e) {
      filer_data_user_schedule();
    });

    function page_paginator() {
      $(".link-ajax").on('click', function (e) {
        e.preventDefault();
        filer_data_user_schedule(e);
      });
    } // lọc dữ liệu


    function filer_data_user_schedule() {
      var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      if (!document.querySelector("#user-schedule")) return false;
      $("#user-schedule").html("<div class=\"spinner-border text-primary d-flex mx-auto\" role=\"status\">\n                        <span class=\"sr-only\">Loading...</span>\n                    </div>");
      var params = new Proxy(new URLSearchParams(window.location.search), {
        get: function get(searchParams, prop) {
          return searchParams.get(prop);
        }
      }); // get uid param
      // dùng để lấy lịch dạy của một user duy nhất

      var tuid = params.tuid; // "some_value"

      var subid = params.subid;
      var url = $(e === null || e === void 0 ? void 0 : e.target).attr('href') ? $(e.target).attr('href') : "3&1"; // check có thẻ a chưa

      var _url$split = url.split("&"),
          _url$split2 = _slicedToArray(_url$split, 2),
          limit = _url$split2[0],
          page = _url$split2[1];

      console.log(limit, page, url, subid, "params");
      var day = null; // có nhiệm vụ xem lịch học khi chọn ở trang gia sư đã đăng ký

      if (params.day) {
        day = params.day;
      } else {
        if (hasFirstFilter) {
          if ($("#dayofweek option[value=\"".concat(new Date().getDay(), "\"]")).prop("selected", true).length === 0) day = 8; // không có ngày thứ 8 mục đích là trả về "không có lịch dạy hôm nay."

          hasFirstFilter = false;
        } //    console.log($(`#dayofweek option[value="${ 3}"]`).prop("selected", true), "dayofweek");


        if (!hasFirstFilter) {
          day = $("#dayofweek").val();
        }
      }

      var subjectTopic = undefined; // áp dụng vừa lọc và tạo thông báo

      if (subid) {
        subjectTopic = subid;
      } else {
        subjectTopic = $("#subject-topic").val();
      }

      var startTime = $("#time-start").val();
      var endTime = $("#time-end").val();
      console.log([day, subjectTopic, startTime, endTime], "get value ");
      $.ajax({
        type: "post",
        url: "../api/scheduleuser/schedule_user",
        data: {
          day: day,
          subjectTopic: subjectTopic,
          startTime: startTime,
          endTime: endTime,
          tuid: tuid,
          limit: limit,
          page: page
        },
        cache: false,
        success: function success(data) {
          $("#user-schedule").html(data);
          page_paginator();
          console.log(data);
          /**/

          /* */
        },
        error: function error(xhr, status, _error) {
          console.error(xhr);
        }
      });
    }
  });
})();
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*********************************!*\
  !*** ./resources/js/profile.js ***!
  \*********************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

(function () {
  Dropzone.autoDiscover = false; // Dropzone.discover();

  var dropzoneProfile;
  var basic;
  $(document).ready(function () {
    var _teaching_form_update;

    var src_img = $("#my-image").prop("src");
    var tuid = $("#tuid").val();
    var data = new URL("./tutor_details?id=".concat(tuid), window.location.href); // When the avatar changes, reattach the src_img. variable.

    $("#my-image").on('load', function (e) {
      // console.log(e.target.src)
      src_img = e.target.src;
    });
    console.log(data); //

    var option = {
      "width": 360,
      "height": 360,
      "data": data.href,
      "image": src_img,
      "margin": 20,
      "qrOptions": {
        "typeNumber": "0",
        "mode": "Byte",
        "errorCorrectionLevel": "M"
      },
      "imageOptions": {
        "hideBackgroundDots": true,
        "imageSize": 0.6,
        "margin": 10
      },
      "dotsOptions": {
        "type": "classy",
        "color": "#45b8ac"
      },
      "backgroundOptions": {
        "color": "#ffffff"
      },
      "dotsOptionsHelper": {
        "colorType": {
          "single": true,
          "gradient": false
        }
      },
      "cornersSquareOptions": {
        "type": "extra-rounded",
        "color": "#038f7e"
      },
      "cornersSquareOptionsHelper": {
        "colorType": {
          "single": true,
          "gradient": false
        }
      },
      "cornersDotOptions": {
        "color": "#038f81",
        "gradient": null
      },
      "cornersDotOptionsHelper": {
        "colorType": {
          "single": true,
          "gradient": false
        }
      },
      "backgroundOptionsHelper": {
        "colorType": {
          "single": true,
          "gradient": false
        }
      }
    };
    var QRModalEl = document.getElementById('QRModal');
    QRModalEl === null || QRModalEl === void 0 ? void 0 : QRModalEl.addEventListener('shown.bs.modal', function (event) {
      option.image = src_img;
      qrCode.update(option);
    });
    var qrCode = new QRCodeStyling(option);
    qrCode.append(document.getElementById("canvas"));
    $("#download").on('click', function (e) {
      qrCode.download({
        name: "qr-tutor",
        extension: "png"
      });
    }); // Dropzone
    // dropzone

    if (document.querySelector("div#profile")) {
      dropzoneProfile = new Dropzone("div#profile", {
        // Configuration options go here
        paramName: "file",
        // The name that will be used to transfer the file
        maxFilesize: 2,
        // MB
        maxFiles: 1,
        acceptedFiles: ".png,.jpg,.jpeg",
        autoProcessQueue: false,
        addRemoveLinks: true,
        uploadMultiple: true,
        // Dịch sang tiếng Việt
        dictDefaultMessage: "Kéo và thả file (có thể click) vào đây để upload<br>Ngoài ra bạn có thể chụp ảnh màn hình và dán vào trang web",
        dictFallbackMessage: "Trình duyệt của bạn không hỗ trợ kéo và thả upload file.",
        dictFallbackText: "Vui lòng sử dụng biểu mẫu dự phòng bên dưới để tải lên các file của bạn như ngày xưa.",
        dictFileTooBig: "File quá lớn ({{filesize}}MiB). Tối đa filesize: {{maxFilesize}}MiB.",
        dictInvalidFileType: "Bạn không thể tải lên các file thuộc loại này (chú ý đến đuôi file).",
        dictResponseError: "Máy chủ đã phản hồi với {{statusCode}} code.",
        dictCancelUpload: "Huỷ bỏ upload",
        dictUploadCanceled: "Upload đã huỷ bỏ.",
        dictCancelUploadConfirmation: "Bạn có chắc chắn muốn hủy upload này không?",
        dictRemoveFile: "Xoá file",
        dictRemoveFileConfirmation: null,
        dictMaxFilesExceeded: "Bạn không thể tải lên bất kỳ tệp nào nữa.",
        init: function init() {
          var upload = this; // Restrict to 1 file uploaded

          upload.on("addedfile", function (file) {
            if (upload.files[1] != null) {
              upload.removeFile(upload.files[0]);
            }

            basic.croppie('bind', {
              url: URL.createObjectURL(file) // points: [77, 469, 280, 739]

            });
            console.log(URL.createObjectURL(file));
          }); // If validation passes, process queue and add insurance

          $("#save-change-picture").on("click", function (e) {
            e.preventDefault(); // upload.processQueue();
            // console.log(upload.files[0].dataURL, "upload")

            basic.croppie('result', {
              type: 'blob',
              size: 'viewport',
              format: 'jpeg'
            }).then(function (image) {
              // html is div (overflow hidden)
              // with img positioned inside.
              var formData = new FormData();
              formData.append("file[]", image, "image.jpg"); // console.log(event.target.result)

              $.ajax({
                type: "post",
                url: "profile",
                contentType: false,
                processData: false,
                data: formData,
                cache: false,
                success: function success(data) {
                  if (data.action === "success") {
                    $("img.avatar").each(function (i, img) {
                      img.src = "../public/images/" + data.fileName;
                    });
                    Toastify({
                      text: "Đổi ảnh đại diện thành công!",
                      duration: 5000,
                      close: true,
                      gravity: "top",
                      // `top` or `bottom`
                      position: "right",
                      // `left`, `center` or `right`
                      stopOnFocus: true,
                      // Prevents dismissing of toast on hover
                      style: {
                        background: "linear-gradient(to right, #56C596, #7BE495)"
                      },
                      onClick: function onClick() {}
                    });
                  }

                  console.log(data, "profile");
                },
                error: function error(xhr, status, _error) {
                  console.error(xhr);
                }
              });
            });
          });
        }
      });
    }

    document.onpaste = function (event) {
      var items = (event.clipboardData || event.originalEvent.clipboardData).items;
      items.forEach(function (item) {
        if (item.kind === 'file') {
          // adds the file to your dropzone instance
          dropzoneProfile.addFile(item.getAsFile());
        }
      });
    };

    basic = $('#demo-basic').croppie({
      enableExif: true,
      viewport: {
        width: 320,
        height: 320,
        type: 'square'
      },
      boundary: {
        width: 720,
        height: 360
      },
      showZoomer: true,
      mouseWheelZoom: 'ctrl'
    });
    $('#change-picture').on('shown.bs.modal', function () {
      basic.croppie('bind', {
        url: src_img // points: [77, 469, 280, 739]

      });
    }); //on button click

    $("#provinces-update") && $.ajax({
      type: "get",
      url: "https://vapi.vnappmob.com/api/province/",
      cache: false,
      success: function success(data) {
        // if(data !== '0')
        var ObjProvinces = Object.assign({}, data); // copy to new obj

        var provinces = _toConsumableArray(Object.values(ObjProvinces)); // convert to array


        var data_province_default = $("#provinces-update").attr("data-name"); // create many options of select

        var optionOfSelect = "<option value=\"0\">--Ch\u1ECDn t\u1EC9nh--</option>";
        provinces[0].map(function (val, idx) {
          optionOfSelect += "<option value=\"".concat(val.province_id, "\" ").concat(val.province_name === data_province_default && 'selected', ">").concat(val.province_name, "</option>"); // console.log()
        });
        console.log(provinces);
        $("#provinces-update").html("<select id = \"province\" name=\"province\" class=\"form-select\" >".concat(optionOfSelect, "</select>")); // join option into select

        onLoadDistrict();
        console.log(data, "data");
      },
      error: function error(xhr, status, _error2) {
        console.log(xhr, _error2, status, "Lỗi");
      }
    });
    $("#provinces-update").on('change', function (e) {
      select2District(e);
    });

    function select2District(e) {
      $('.js-data-districts-ajax-update').select2('destroy');
      $('.js-data-districts-ajax-update').select2({
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
      }).on("select2:close", function (e) {// validation select2
        // $(this).valid();
      });
    }

    function onLoadDistrict() {
      var districts_update = $('.js-data-districts-ajax-update');
      var province_id = $("#province").find(":selected").val();
      $('.js-data-districts-ajax-update').select2({
        theme: 'bootstrap-5',
        language: "vi",
        multiple: true,
        ajax: {
          url: "https://vapi.vnappmob.com/api/province/district/".concat(province_id),
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
      });
      console.log(province_id);
      $.ajax({
        type: 'GET',
        url: "https://vapi.vnappmob.com/api/province/district/".concat(province_id)
      }).then(function (data) {
        var _districts_update$att;

        // create the option and append to Select2
        var data_district_tutor = (_districts_update$att = districts_update.attr("data-district-name")) === null || _districts_update$att === void 0 ? void 0 : _districts_update$att.split(", ");
        console.log(data_district_tutor, "data_district_tutor");
        data.results.map(function (district_ajax) {
          // console.log(data_district_tutor[i], district_ajax.district_name,  "data_district_tutor[i]")
          if (data_district_tutor.find(function (district_tutor) {
            return district_tutor === district_ajax.district_name;
          })) {
            var _option = new Option(district_ajax.district_name, district_ajax.district_id, true, true);

            districts_update.append(_option).trigger('change');
          }
        });
        console.log(data, "data-select2"); // manually trigger the `select2:select` event

        districts_update.trigger({
          type: 'select2:select',
          params: {
            data: data.results
          }
        });
      });
    }

    var teaching_form_update = $('.js-data-teaching-form-ajax-update');
    teaching_form_update.select2({
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

    }).on("select2:close", function (e) {// validation select2
      // $(this).valid();
    });
    /* */

    var last_element_update;
    $("input[type='text']").on('change', function (e) {
      console.log($(e.target).offset().top);
      last_element_update = $(e.target).offset().top - 50;
    });
    $("input[type='checkbox']").on('change', function (e) {
      console.log($(e.target).offset().top);
      last_element_update = $(e.target).offset().top - 50;
    });
    $("select").on('change', function (e) {
      console.log($(e.target).offset().top);
      last_element_update = $(e.target).offset().top - 50;
    });
    /* */

    var value_default_teaching_form = (_teaching_form_update = teaching_form_update.attr("data-teaching-form")) === null || _teaching_form_update === void 0 ? void 0 : _teaching_form_update.split(", ");
    console.log(value_default_teaching_form);
    teaching_form_update.val(value_default_teaching_form).trigger('change');
    var arr_del_teaching_time = [],
        arr_add_teaching_time = [];
    $("#tutor-form-update").on('submit', function (e) {
      e.preventDefault();
      var token = $("#token").val();
      var currentPhone = $("#current-phone-number").val();
      var currentEmail = $("#current-email").val();
      var currentAddress = $("#current-address").val();
      var currentProvince = $("#province option:selected").text();
      var districts = "";
      var teachingForm = "";
      var linkFace = $("#face").val();
      var linkTwit = $("#twit").val();
      $('.js-data-districts-ajax-update').select2('data').map(function (val, i, arr) {
        if (arr.length - 1 === i) {
          districts += val.text;
        } else {
          districts += val.text + ", ";
        }
      });
      $('.js-data-teaching-form-ajax-update').select2('data').map(function (val, i, arr) {
        if (arr.length - 1 === i) {
          teachingForm += val.id;
        } else {
          teachingForm += val.id + ", ";
        }
      });
      arr_add_teaching_time = [];
      arr_del_teaching_time = [];
      /* Kiểm tra có timeId không nếu có thêm vào mảng xoá time */

      if (Sunday_del.length > 0) {
        arr_del_teaching_time.push(Sunday_del);
      }

      if (Monday_del.length > 0) {
        arr_del_teaching_time.push(Monday_del);
      }

      if (Tuesday_del.length > 0) {
        arr_del_teaching_time.push(Tuesday_del);
      }

      if (Wednesday_del.length > 0) {
        arr_del_teaching_time.push(Wednesday_del);
      }

      if (Thursday_del.length > 0) {
        arr_del_teaching_time.push(Thursday_del);
      }

      if (Friday_del.length > 0) {
        arr_del_teaching_time.push(Friday_del);
      }

      if (Saturday_del.length > 0) {
        arr_del_teaching_time.push(Saturday_del);
      }
      /* Kiểm tra có timeId không nếu có thêm vào mảng thêm time */


      if (Sunday_add.length > 0) {
        arr_add_teaching_time.push(Sunday_add);
      }

      if (Monday_add.length > 0) {
        arr_add_teaching_time.push(Monday_add);
      }

      if (Tuesday_add.length > 0) {
        arr_add_teaching_time.push(Tuesday_add);
      }

      if (Wednesday_add.length > 0) {
        arr_add_teaching_time.push(Wednesday_add);
      }

      if (Thursday_add.length > 0) {
        arr_add_teaching_time.push(Thursday_add);
      }

      if (Friday_add.length > 0) {
        arr_add_teaching_time.push(Friday_add);
      }

      if (Saturday_add.length > 0) {
        arr_add_teaching_time.push(Saturday_add);
      }

      console.log(arr_del_teaching_time, arr_add_teaching_time);
      $.ajax({
        type: "post",
        url: "../api/tutor/updateinfotutor",
        data: {
          token: token,
          currentPhone: currentPhone,
          currentEmail: currentEmail,
          currentAddress: currentAddress,
          currentProvince: currentProvince,
          districts: districts,
          teachingForm: teachingForm,
          linkFace: linkFace,
          linkTwit: linkTwit,
          arr_add_teaching_time: arr_add_teaching_time,
          arr_del_teaching_time: arr_del_teaching_time
        },
        cache: false,
        success: function success(data) {
          if (data.update === "successful") {
            window.location.reload();
            localStorage.setItem("scrollpos", last_element_update);
            console.log(last_element_update, "scrollpos");
          }

          console.log(data);
        },
        error: function error(xhr, status, _error3) {
          console.error(xhr);
        }
      });
    }); // 

    var Sunday_del = [],
        Monday_del = [],
        Tuesday_del = [],
        Wednesday_del = [],
        Thursday_del = [],
        Friday_del = [],
        Saturday_del = []; // chọn tất cả thẻ input có type = checkbox, name = teaching_time[]
    // không bị disabled và đã checked

    $("input[type='checkbox'][name='teaching_time[]']:not(:disabled):checked").on("change", function (e) {
      if ($(e.target).prop("checked")) {
        if ($(e.target).attr("data-day-id") === "0") {
          var index = Sunday_del.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (index > -1) {
            Sunday_del.splice(index, 1); // 2nd parameter means remove one item only
          }
        } else if ($(e.target).attr("data-day-id") === "1") {
          var _index = Monday_del.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (_index > -1) {
            Monday_del.splice(_index, 1); // 2nd parameter means remove one item only
          }
        } else if ($(e.target).attr("data-day-id") === "2") {
          var _index2 = Tuesday_del.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (_index2 > -1) {
            Tuesday_del.splice(_index2, 1); // 2nd parameter means remove one item only
          }
        } else if ($(e.target).attr("data-day-id") === "3") {
          var _index3 = Wednesday_del.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (_index3 > -1) {
            Wednesday_del.splice(_index3, 1); // 2nd parameter means remove one item only
          }
        } else if ($(e.target).attr("data-day-id") === "4") {
          var _index4 = Thursday_del.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (_index4 > -1) {
            Thursday_del.splice(_index4, 1); // 2nd parameter means remove one item only
          }
        } else if ($(e.target).attr("data-day-id") === "5") {
          var _index5 = Friday_del.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (_index5 > -1) {
            Friday_del.splice(_index5, 1); // 2nd parameter means remove one item only
          }
        } else if ($(e.target).attr("data-day-id") === "6") {
          var _index6 = Saturday_del.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (_index6 > -1) {
            Saturday_del.splice(_index6, 1); // 2nd parameter means remove one item only
          }
        }
      } else {
        if ($(e.target).attr("data-day-id") === "0" && Sunday_del.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Sunday_del.push({
            dayId: 0,
            timeId: e.target.value
          });
        } else if ($(e.target).attr("data-day-id") === "1" && Monday_del.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Monday_del.push({
            dayId: 1,
            timeId: e.target.value
          });
        } else if ($(e.target).attr("data-day-id") === "2" && Tuesday_del.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Tuesday_del.push({
            dayId: 2,
            timeId: e.target.value
          });
        } else if ($(e.target).attr("data-day-id") === "3" && Wednesday_del.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Wednesday_del.push({
            dayId: 3,
            timeId: e.target.value
          });
        } else if ($(e.target).attr("data-day-id") === "4" && Thursday_del.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Thursday_del.push({
            dayId: 4,
            timeId: e.target.value
          });
        } else if ($(e.target).attr("data-day-id") === "5" && Friday_del.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Friday_del.push({
            dayId: 5,
            timeId: e.target.value
          });
        } else if ($(e.target).attr("data-day-id") === "6" && Saturday_del.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Saturday_del.push({
            dayId: 6,
            timeId: e.target.value
          });
        }
      } // console.log(Sunday_del, Monday_del, Tuesday_del, Wednesday_del, Thursday_del,
      //      Friday_del, Saturday_del, Sunday_del)

    });
    var Sunday_add = [],
        Monday_add = [],
        Tuesday_add = [];
    Wednesday_add = [], Thursday_add = [], Friday_add = [], Saturday_add = []; // chọn tất cả thẻ input có type = checkbox, name = teaching_time[]
    // không bị disabled và đã checked

    $("input[type='checkbox'][name='teaching_time[]']:not(:disabled):not(:checked)").on("change", function (e) {
      console.log(e.target.value, "not checked");

      if (!$(e.target).prop("checked")) {
        if ($(e.target).attr("data-day-id") === "0") {
          var index = Sunday_add.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (index > -1) {
            Sunday_add.splice(index, 1); // 2nd parameter means remove one item only
          }
        } else if ($(e.target).attr("data-day-id") === "1") {
          var _index7 = Monday_add.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (_index7 > -1) {
            Monday_add.splice(_index7, 1); // 2nd parameter means remove one item only
          }
        } else if ($(e.target).attr("data-day-id") === "2") {
          var _index8 = Tuesday_add.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (_index8 > -1) {
            Tuesday_add.splice(_index8, 1); // 2nd parameter means remove one item only
          }
        } else if ($(e.target).attr("data-day-id") === "3") {
          var _index9 = Wednesday_add.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (_index9 > -1) {
            Wednesday_add.splice(_index9, 1); // 2nd parameter means remove one item only
          }
        } else if ($(e.target).attr("data-day-id") === "4") {
          var _index10 = Thursday_add.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (_index10 > -1) {
            Thursday_add.splice(_index10, 1); // 2nd parameter means remove one item only
          }
        } else if ($(e.target).attr("data-day-id") === "5") {
          var _index11 = Friday_add.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (_index11 > -1) {
            Friday_add.splice(_index11, 1); // 2nd parameter means remove one item only
          }
        } else if ($(e.target).attr("data-day-id") === "6") {
          var _index12 = Saturday_add.findIndex(function (val) {
            return e.target.value === val.timeId;
          });

          if (_index12 > -1) {
            Saturday_add.splice(_index12, 1); // 2nd parameter means remove one item only
          }
        }
      } else {
        if ($(e.target).attr("data-day-id") === "0" && Sunday_add.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Sunday_add.push({
            dayId: 0,
            timeId: e.target.value
          });
        } else if ($(e.target).attr("data-day-id") === "1" && Monday_add.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Monday_add.push({
            dayId: 1,
            timeId: e.target.value
          });
        } else if ($(e.target).attr("data-day-id") === "2" && Tuesday_add.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Tuesday_add.push({
            dayId: 2,
            timeId: e.target.value
          });
        } else if ($(e.target).attr("data-day-id") === "3" && Wednesday_add.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Wednesday_add.push({
            dayId: 3,
            timeId: e.target.value
          });
        } else if ($(e.target).attr("data-day-id") === "4" && Thursday_add.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Thursday_add.push({
            dayId: 4,
            timeId: e.target.value
          });
        } else if ($(e.target).attr("data-day-id") === "5" && Friday_add.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Friday_add.push({
            dayId: 5,
            timeId: e.target.value
          });
        } else if ($(e.target).attr("data-day-id") === "6" && Saturday_add.findIndex(function (val) {
          return e.target.value === val.timeId;
        }) < 0) {
          Saturday_add.push({
            dayId: 6,
            timeId: e.target.value
          });
        }
      }

      console.log(Sunday_add, Monday_add, Tuesday_add, Wednesday_add, Thursday_add, Friday_add, Saturday_add);
    });
  }); // paste into dropzone
  //
})();
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*******************************************!*\
  !*** ./resources/js/registered_tutors.js ***!
  \*******************************************/
(function () {
  $(document).ready(function () {
    var _review_modal, _review_modal2;

    OnClickApprovalRegisterUser(); // click để duyệt người dùng đăng ký

    function onChangeActionRadio() {
      $(".form-check-input[type=\"radio\"]").off().on('change', function (e) {
        // disable input checkbox khi thay đổi
        if (e.currentTarget.checked) {
          $(e.currentTarget).closest(".modal-content").find(".btn-register-add-del") // Tìm nơi chứa select thêm lịch dạy cho người dùng
          .text($(e.currentTarget).next(".form-check-label").text());
          $(e.currentTarget).closest(".modal-content").find(".btn-register-add-del").attr("data-action", $(e.currentTarget).attr("data-action")); // và disable nó 
        }
      });
    }

    function onChangeShowTopic(event_approval) {
      $(".show-topic-register").off().on('change', function () {
        getSubjectRegisterUser(event_approval);
      });
    }

    function OnClickApprovalRegisterUser() {
      $(".register-unregister-tutor").on('click', function (e) {
        getSubjectRegisterUser(e);
        onChangeShowTopic(e);
        onChangeActionRadio();
        onClickAddOrDel(e);
      });
    }

    function onClickAddOrDel(event_approval) {
      $(".btn-register-add-del").off().on('click', function (e) {
        if (confirm("Bạn có chắn chắn muốn " + $(e.target).text().trim()) === true) addOrDelRegisterTutor(event_approval, e);
      });
    }

    function getSubjectRegisterUser(e) {
      var tuId = $(e.currentTarget).attr("data-id");
      var id_approval = $(e.currentTarget).attr("data-bs-target");
      var subject = $(id_approval).find(".teaching-subject");
      var status = $(id_approval).find(".show-topic-register.form-check-input").prop("checked") ? 1 : 0; // trạng thái đã duyệt môn học hay chưa

      console.log([tuId, id_approval, subject, status]);
      $.ajax({
        type: "post",
        url: "../api/teachingsubject/getsubjecttutor",
        data: {
          tuId: tuId,
          status: status
        },
        cache: false,
        success: function success(data) {
          subject.html(data);
          console.log(data);
        },
        error: function error(xhr, status, _error) {
          console.error(xhr);
        }
      });
    }

    function addOrDelRegisterTutor(event_approval, event_target) {
      var id_modal = $(event_approval.currentTarget).attr("data-bs-target");
      var tuId = $(event_approval.currentTarget).attr("data-id");
      var action = $(event_target.currentTarget).attr("data-action");
      var topicId = $(id_modal).find("select").val();
      console.log([action, tuId, topicId]);
      $.ajax({
        type: "post",
        url: "../api/registertutor/addordeleteregistertutor",
        data: {
          tuId: tuId,
          action: action,
          topicId: topicId
        },
        cache: false,
        success: function success(data) {
          if (data.added === 'added') {
            alert("M\xF4n h\u1ECDc ".concat(data.topicName, " \u0111\xE3 \u0111\u0103ng k\xFD r\u1ED3i. H\xE3y ch\u1ECDn m\xF4n h\u1ECDc kh\xE1c."));
          }

          if (data.insert === 'successful') {
            alert("\u0110\u0103ng k\xFD m\xF4n h\u1ECDc ".concat(data.topicName, " th\xE0nh c\xF4ng. H\xE3y ch\u1EDD gia s\u01B0 li\xEAn h\u1EC7 v\u1EDBi b\u1EA1n."));
            getSubjectRegisterUser(event_approval); // refresh topic when insert success
            // When inserting the topic success, include a badge containing the topic name.

            $("#topic-register").append("<span class=\"subject-span m-l-10 fw-500 badge bg-secondary data-id=\"".concat(data.topicId, "\">").concat(data.topicName, "</span>"));
          } else if (data["delete"] === 'successful') {
            alert("Hu\u1EF7 \u0111\u0103ng k\xFD m\xF4n h\u1ECDc ".concat(data.topicName, " th\xE0nh c\xF4ng."));
            getSubjectRegisterUser(event_approval); // refresh topic when delete success

            $("ul li span[data-id=" + data.topicId + "]").remove();
          } else if (data["delete"] === 'fail') {
            alert(data.message);
          }

          console.log(data, "insert3");
        },
        error: function error(xhr, status, _error2) {
          console.error(xhr);
        }
      });
    }

    var review_modal = document.getElementById('review');
    var tuid, review_modal;
    (_review_modal = review_modal) === null || _review_modal === void 0 ? void 0 : _review_modal.addEventListener('shown.bs.modal', function (event) {
      console.log(event.relatedTarget);
      tuid = $(event.relatedTarget).attr("data-id");
      review_modal = $(event.target);
    });
    $(".btn-add-review").on('click', function (e) {
      var star_review = $(review_modal).find("input[type='radio'][name='rating']:checked").val();
      var text_rating = $(review_modal).find("#text-rating").val(); // console.log(star_review, tuid, text_rating)

      $.ajax({
        type: "post",
        url: "../api/review/addreviewtutor",
        data: {
          tuid: tuid,
          star_review: star_review,
          text_rating: text_rating
        },
        cache: false,
        success: function success(data) {
          if (data.add === "successful") {
            Toastify({
              text: data.message,
              duration: 5000,
              close: true,
              gravity: "top",
              // `top` or `bottom`
              position: "right",
              // `left`, `center` or `right`
              stopOnFocus: true,
              // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #56C596, #7BE495)"
              },
              onClick: function onClick() {} // Callback after click

            }).showToast();
          } else {
            Toastify({
              text: data.message,
              duration: 5000,
              close: true,
              gravity: "top",
              // `top` or `bottom`
              position: "right",
              // `left`, `center` or `right`
              stopOnFocus: true,
              // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #F082AC, #b91c1c)"
              },
              onClick: function onClick() {} // Callback after click

            }).showToast();
          }

          console.log(data, "add review");
        },
        error: function error(xhr, status, _error3) {
          console.error(xhr);
        }
      });
    });
    (_review_modal2 = review_modal) === null || _review_modal2 === void 0 ? void 0 : _review_modal2.addEventListener('hidden.bs.modal', function (event) {
      $(event.target).find("input[type='radio'][name='rating']:checked").prop("checked", false);
      $(event.target).find("#text-rating").val('');
    });
  });
})();
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!******************************************!*\
  !*** ./resources/js/registered_users.js ***!
  \******************************************/
(function () {
  $(document).ready(function () {
    OnClickApprovalRegisterUser(); // click để duyệt người dùng đăng ký

    OnchangeSelectDoW(); // khi thứ thay đổi (được chọn)

    $(".allow-schedule.form-check-input").on('change', function (e) {
      // disable input checkbox khi thay đổi
      if (!e.currentTarget.checked) {
        $(e.currentTarget).closest(".modal-content").find("select:not(.teaching-subject)").prop("disabled", true); // Tìm nơi chứa select thêm lịch dạy cho người dùng
        // và disable nó 
      } else {
        $(e.currentTarget).closest(".modal-content").find("select").prop("disabled", false);
      }
    }); //

    function onChangeTopic(event_approval) {
      $(".teaching-subject").off().on('change', function (event_target) {
        getIdRegisterUser(event_approval, event_target);
      });
    } //
    // thay đổi hiển thị môn học duyệt hay chưa


    function onChangeStatusApproval(event_approval) {
      $(".show-status-topic").off().on('change', function () {
        getSubjectRegisterUser(event_approval);
      });
    } //


    function OnchangeSelectDoW() {
      $(".teaching-day").on('change', function (e) {
        getTimeFromDay(e);
      });
    }

    function onChangeFlexSwitch() {
      $(".allow-schedule.form-check-input").each(function (i, select) {
        // disable input checkbox khi thay đổi
        console.log(select);

        if (!$(select).prop("checked")) {
          $(select).closest(".modal-content").find("select:not(.teaching-subject)").prop("disabled", true); // Tìm nơi chứa select thêm lịch dạy cho người dùng
          // và disable nó 
        } else {
          $(select).closest(".modal-content").find("select").prop("disabled", false);
        }
      });
    }

    function OnClickApprovalRegisterUser() {
      $(".approval-register-user").on('click', function (e) {
        onLoadSwitch(e);
        getDaySchedule(e);
        getSubjectRegisterUser(e);
        getStatusRegisterUser(e);
        onChangeFlexSwitch(e);
        onChangeTopic(e);
        onChangeStatusApproval(e);
        onClickSave(e);
      });
    }

    var approval_register_model = document.getElementById('approval-register');
    approval_register_model === null || approval_register_model === void 0 ? void 0 : approval_register_model.addEventListener('shown.bs.modal', function (e) {
      onClickSave(e);
    });

    function onClickSave(event_approval) {
      $(".btn-save").off().on('click', function () {
        addSchedule(event_approval);
      });
    }

    function onLoadSwitch(e) {
      var id_modal = $(e.currentTarget).attr("data-bs-target");
      var data_allow_schedule = $(e.currentTarget).attr("data-allow-schedule");
      var data_show_status_topic = $(e.currentTarget).attr("data-show-status-topic");
      var switch_status_allow_schedule = $(id_modal).find(".allow-schedule.form-check-input");
      var switch_status_show_status_topic = $(id_modal).find(".show-status-topic.form-check-input");
      Number.parseInt(data_allow_schedule) === 1 && $(switch_status_allow_schedule).attr("checked", true);
      Number.parseInt(data_show_status_topic) === 1 && $(switch_status_show_status_topic).attr("checked", true); // console.log( data_show_status_topic === "1", data_allow_schedule, id_modal," switch_status, id_modal")
    }

    function getStatusRegisterUser(e) {
      var id_modal = $(e.currentTarget).attr("data-bs-target");
      var switch_status = $(id_modal).find(".allow-schedule.form-check-input");
      var id = $(e.currentTarget).attr("data-id"); // console.log(switch_status, id_modal)

      if (!$(switch_status).prop("checked")) {
        $(switch_status).closest(".modal-content").find("select:not(.teaching-subject)").prop("disabled", true); // Tìm nơi chứa select thêm lịch dạy cho người dùng
        // và disable nó 
      } else {
        $(switch_status).closest(".modal-content").find("select").prop("disabled", false);
      }

      $.ajax({
        type: "post",
        url: "../api/registeruser/getstatusregisteruser",
        data: {
          id: id
        },
        cache: false,
        success: function success(data) {
          $(switch_status).prop("checked", data.status === 1 ? true : false);
          console.log(data, "dât");
        },
        error: function error(xhr, status, _error) {
          console.error(xhr);
        }
      });
    }

    function getIdRegisterUser(event_approval, event_target) {
      var id_modal = $(event_approval.currentTarget).attr("data-bs-target");
      var id_register = $(id_modal).find(".id-register");
      var id = $(event_approval.currentTarget).attr("data-id");
      var topicId = $(event_target.currentTarget).val();
      var status = $(id_modal).find(".show-status-topic").prop("checked") ? 1 : 0; // trạng thái đã duyệt môn học hay chưa
      // console.log(id, topicId, "id")

      console.log(id_register, "id_register");
      $.ajax({
        type: "post",
        url: "../api/registeruser/getregisteridbytopicid",
        data: {
          id: id,
          topicId: topicId,
          status: status
        },
        cache: false,
        success: function success(data) {
          if (data.registerId) {
            $(id_register).html("@id: " + data.registerId);
            $(id_register).attr("data-id", data.registerId);
          } else $(id_register).html("@id: không có");

          console.log(data, "dât2");
        },
        error: function error(xhr, status, _error2) {
          console.error(xhr);
        }
      });
    }

    function getTimeFromDay(e) {
      var dayofweek = $(e.currentTarget).val();
      var index = $(".teaching-day").index(e.currentTarget);
      $.ajax({
        type: "post",
        url: "../api/time/getTimeFromDay",
        data: {
          dayofweek: dayofweek
        },
        cache: false,
        success: function success(data) {
          $(".teaching-time").eq(index).html(data);
          console.log(data);
        },
        error: function error(xhr, status, _error3) {
          console.error(xhr);
        }
      });
    }

    function getDaySchedule(e) {
      var id_modal = $(e.currentTarget).attr("data-bs-target");
      var dayofweek = $(id_modal).find("select").eq(0);
      $.ajax({
        type: "post",
        url: "../api/day/getdayschedule",
        data: {
          action: "getDay"
        },
        cache: false,
        success: function success(data) {
          dayofweek.html(data);
          console.log(data);
        },
        error: function error(xhr, status, _error4) {
          console.error(xhr);
        }
      });
    }

    function getSubjectRegisterUser(e) {
      var userId = $(e.currentTarget).attr("data-id");
      var id_approval = $(e.currentTarget).attr("data-bs-target");
      var subject = $(id_approval).find("select").eq(2);
      var status = $(id_approval).find(".show-status-topic").prop("checked") ? 1 : 0; // trạng thái đã duyệt môn học hay chưa

      console.log(status);
      $.ajax({
        type: "post",
        url: "../api/registeruser/getsubjectregisteruser",
        data: {
          userId: userId,
          status: status
        },
        cache: false,
        success: function success(data) {
          subject.html(data);
          console.log(data);
        },
        error: function error(xhr, status, _error5) {
          console.error(xhr);
        }
      });
    }

    function addSchedule(event_approval) {
      var id_modal = $(event_approval.relatedTarget).attr("data-bs-target");
      var id = $(id_modal).find(".id-register").attr("data-id");
      var status = $(id_modal).find("input[type=\"checkbox\"]").prop("checked") ? 1 : 0;
      var DoW_id = $(id_modal).find("select").eq(0).val();
      var timeId = $(id_modal).find("select").eq(1).val();
      var topicId = $(id_modal).find("select").eq(2).val();
      console.log($(id_modal).find("select"));
      console.log([id, status, DoW_id, timeId, topicId]);
      $.ajax({
        type: "post",
        url: "../api/scheduleuser/addscheduleuser",
        data: {
          id: id,
          status: status,
          DoW_id: DoW_id,
          topicId: topicId,
          timeId: timeId
        },
        cache: false,
        success: function success(data) {
          // if (data.registerId) {
          //     $(id_register).html("@id: " + data.registerId);
          //     $(id_register).attr("data-id", data.registerId);
          // } else $(id_register).html("@id: không có");
          if (data.status === '1') {
            $(id_modal).closest(".job-box").addClass("bg-approval"); // 

            Toastify({
              text: "Duy\u1EC7t th\xE0nh c\xF4ng. B\u1EA1n \u0111\xE3 duy\u1EC7t th\xE0nh c\xF4ng m\xF4n ".concat($(id_modal).find("select option:selected").eq(2).text()),
              duration: 3000,
              close: true,
              gravity: "top",
              // `top` or `bottom`
              position: "right",
              // `left`, `center` or `right`
              stopOnFocus: true,
              // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #C73866, #FE676E)"
              },
              onClick: function onClick() {} // Callback after click

            }).showToast();
          } else if (data.status === '0') {
            $(id_modal).closest(".job-box").removeClass("bg-approval"); // 

            Toastify({
              text: "Hu\u1EF7 duy\u1EC7t th\xE0nh c\xF4ng.",
              duration: 3000,
              close: true,
              gravity: "top",
              // `top` or `bottom`
              position: "right",
              // `left`, `center` or `right`
              stopOnFocus: true,
              // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #C73866, #FE676E)"
              },
              onClick: function onClick() {} // Callback after click

            }).showToast();
          }

          if (data.action === "successful") {
            $(event_approval.relatedTarget).closest(".job-box").find(".subject-span").each(function (i, span) {
              if ($(span).attr("data-id") === topicId) {
                $(span).toggleClass("bg-cerulean");
                $(span).toggleClass("bg-secondary");
              }
            }); //

            Toastify({
              text: data.message,
              duration: 3000,
              close: true,
              gravity: "top",
              // `top` or `bottom`
              position: "right",
              // `left`, `center` or `right`
              stopOnFocus: true,
              // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #C73866, #FE676E)"
              },
              onClick: function onClick() {} // Callback after click

            }).showToast();
          } else if (data.action === "fail") {
            //
            Toastify({
              text: data.message,
              duration: 3000,
              close: true,
              gravity: "top",
              // `top` or `bottom`
              position: "right",
              // `left`, `center` or `right`
              stopOnFocus: true,
              // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #C73866, #FE676E)"
              },
              onClick: function onClick() {} // Callback after click

            }).showToast();
          }

          console.log(data, "update2");
        },
        error: function error(xhr, status, _error6) {
          console.error(xhr);
        }
      });
    }
  });
})();
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!**************************************!*\
  !*** ./resources/js/saved_tutors.js ***!
  \**************************************/
(function () {
  $(document).ready(function () {
    $(".unsave-tutor").on('click', function (e) {
      e.preventDefault();
      var tutorId = $(e.currentTarget).attr("data-href");
      console.log(tutorId, $(e.currentTarget).attr("data-href"));
      $.ajax({
        type: "post",
        url: "../api/savedtutor/unsaved_tutors",
        data: {
          tutorId: tutorId
        },
        cache: false,
        success: function success(data) {
          // $("#save-tutor").replaceWith(data);
          if (data["delete"] === "successful") $(e.target).closest(".job-box").remove();
          console.log(data, "data");
        },
        error: function error(xhr, status, _error) {
          console.log(xhr, _error, status, "Lỗi");
        }
      });
    });
  });
})();
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!********************************!*\
  !*** ./resources/js/signup.js ***!
  \********************************/
(function () {
  $(document).ready(function () {
    $.validator.addMethod('phoneVI', function (value) {
      return /^(84|0[3|5|7|8|9])+([0-9]{8})$/.test(value);
    });
    $.validator.addMethod('Password', function (value) {
      return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,100}$/.test(value);
    });
    $("#signup-form").validate({
      ignore: [],
      rules: {
        "first_name": {
          required: true,
          minlength: 5
        },
        "last_name": {
          required: true,
          minlength: 2
        },
        "email": {
          required: true,
          email: true,
          remote: {
            url: "../api/validation/checkunique",
            type: "post",
            data: {
              value: function value() {
                return $("#email").val();
              },
              column: function column() {
                return 'email';
              }
            }
          }
        },
        "phone": {
          required: true,
          phoneVI: true,
          rangelength: [10, 10],
          remote: {
            url: "../api/validation/checkunique",
            type: "post",
            data: {
              value: function value() {
                return $("#phone_number").val();
              },
              column: function column() {
                return 'phonenumber';
              }
            }
          }
        },
        "username": {
          required: true,
          minlength: 5,
          remote: {
            url: "../api/validation/checkunique",
            type: "post",
            data: {
              value: function value() {
                return $("#username").val();
              },
              column: function column() {
                return 'username';
              }
            }
          }
        },
        "pass": {
          required: true,
          Password: true
        },
        "repass": {
          required: true,
          minlength: 5,
          equalTo: '#pass'
        }
      },
      messages: {
        first_name: "Họ từ 5 kí tự trở lên.",
        last_name: "Tên từ 2 kí tự trở lên.",
        email: {
          required: "Vui lòng nhập email.",
          email: "Email sai định dạng",
          remote: $.validator.format("{0} đã tồn tại.")
        },
        phone: {
          required: "Vui lòng nhập số điện thoại",
          phoneVI: "Đầu số điện thoại phải là 03, 05, 07, 08, 09.",
          rangelength: "Số điện thoại phải đủ 10 kí tự.",
          remote: $.validator.format("{0} đã tồn tại.")
        },
        username: {
          required: "Vui lòng nhập tài khoản.",
          minlength: "Phải nhập từ 5 kí tự trở lên.",
          remote: $.validator.format("{0} đã tồn tại.")
        },
        pass: "Mật khẩu phải chứa từ 10 kí tự, ít nhất 1 kí tự viết hoa, thường, số, kí tự đặc biệt.",
        repass: "Mật khẩu nhập lại không đúng."
      },
      errorPlacement: function errorPlacement(label, element) {
        label.insertAfter($(element).parent()).addClass('mb-2 text-danger');
      },
      success: function success(label, element) {},
      submitHandler: function submitHandler(form) {
        // submitRegisterForm();
        // form.submit();
        console.log("1huy2k");
      }
    });
    $("#signup-form").on('submit', function (e) {
      e.preventDefault();
      var $form = $(e.target);
      if (!$form.valid()) return false;
      var token = $("#token").val();
      var first_name = $("#first_name").val();
      var last_name = $("#last_name").val();
      var email = $("#email").val();
      var phone_number = $("#phone_number").val();
      var username = $("#username").val();
      var password = $("#pass").val();
      console.log(first_name, last_name, email, phone_number, username, password); // add loading

      $("#main-container").append("<div class=\"loading\">\n                                            <div class=\"spinner-grow text-light d-flex mx-auto\" style=\"width: 3rem; height: 3rem;\" role=\"status\">\n                                                <span class=\"visually-hidden\">Loading...</span>\n                                            </div>\n                                        </div>");
      $.ajax({
        type: "post",
        url: "../api/appuser/signup",
        data: {
          token: token,
          first_name: first_name,
          last_name: last_name,
          email: email,
          phone_number: phone_number,
          username: username,
          password: password
        },
        cache: false,
        success: function success(data) {
          if (data.sign_up === "successful") {
            var _$;

            (_$ = $(".loading")) === null || _$ === void 0 ? void 0 : _$.remove();

            if (confirm("Vui lòng kiểm tra email của bạn để kích hoạt tài khoản của bạn trước khi đăng nhập.") === true) {
              Toastify({
                text: "Đăng kí tài khoản thành công.",
                duration: 5000,
                close: true,
                gravity: "top",
                // `top` or `bottom`
                position: "right",
                // `left`, `center` or `right`
                stopOnFocus: true,
                // Prevents dismissing of toast on hover
                style: {
                  background: "linear-gradient(to right, #56C596, #7BE495)"
                },
                onClick: function onClick() {} // Callback after click

              }).showToast();
              new Promise(function (res) {
                return setTimeout(res, 1000);
              }).then(function () {
                window.location.href = data.url;
              });
            }
          }

          if (data.sign_up === "fail") {
            Toastify({
              text: "Tài khoản đã tồn tại!",
              duration: 5000,
              close: true,
              gravity: "top",
              // `top` or `bottom`
              position: "right",
              // `left`, `center` or `right`
              stopOnFocus: true,
              // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #F082AC, #b91c1c)"
              },
              onClick: function onClick() {} // Callback after click

            }).showToast();
          }

          console.log(data);
        },
        error: function error(xhr, status, _error) {
          console.log(xhr, _error, status, "Lỗi");
        }
      });
    });
  });
})();
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!***************************************!*\
  !*** ./resources/js/tutor_details.js ***!
  \***************************************/
(function () {
  $(document).ready(function () {
    onClickToShowModalRegister();

    function onClickToShowModalRegister() {
      $(".btn-register-show").on('click', function (e) {
        getSubjectRegisterUser(e);
        onClickToAddRegister();
      });
    }

    function onClickToAddRegister() {
      $(".btn-register-add").on('click', function (e) {
        addRegisterTutor(e);
      });
    }

    function getSubjectRegisterUser(e) {
      var params = new Proxy(new URLSearchParams(window.location.search), {
        get: function get(searchParams, prop) {
          return searchParams.get(prop);
        }
      }); // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"

      var tuId = params.id; // "some_value"

      var id_approval = $(e.currentTarget).attr("data-bs-target");
      var subject = $(id_approval).find(".teaching-subject");
      var status = 0; // trạng thái đã duyệt môn học hay chưa
      // console.log([tuId, id_approval, subject, status])

      $.ajax({
        type: "post",
        url: "../api/teachingsubject/getsubjecttutor",
        data: {
          tuId: tuId,
          status: status
        },
        cache: false,
        success: function success(data) {
          subject.html(data);
          console.log(data);
        },
        error: function error(xhr, status, _error) {
          console.error(xhr);
        }
      });
    }

    function addRegisterTutor(e) {
      var params = new Proxy(new URLSearchParams(window.location.search), {
        get: function get(searchParams, prop) {
          return searchParams.get(prop);
        }
      }); // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"

      var tuId = params.id; // "some_value"

      var action = 1;
      var topicId = $(e.currentTarget).closest(".modal-content").find("select");
      console.log([action, tuId, topicId, e.currentTarget]);
      $.ajax({
        type: "post",
        url: "../api/registertutor/addordeleteregistertutor",
        data: {
          tuId: tuId,
          action: action,
          topicId: $(topicId).val()
        },
        cache: false,
        success: function success(data) {
          if (data.insert === 'successful') {
            alert("\u0110\u0103ng k\xFD m\xF4n h\u1ECDc ".concat(data.topicName, " th\xE0nh c\xF4ng. H\xE3y ch\u1EDD gia s\u01B0 li\xEAn h\u1EC7 v\u1EDBi b\u1EA1n."));
            window.location.href = "./registered_tutors";
          }

          console.log(data, "insert3");
        },
        error: function error(xhr, status, _error2) {
          console.error(xhr);
        }
      });
    }
    /* Lưu gia sư */


    $("#save-tutor").on('click', function (e) {
      var params = new Proxy(new URLSearchParams(window.location.search), {
        get: function get(searchParams, prop) {
          return searchParams.get(prop);
        }
      }); // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"

      var tutorId = params.id; // "some_value"

      console.log(tutorId, "save-tutor");
      $.ajax({
        type: "post",
        url: "../api/savedtutor/savetutor",
        data: {
          tutorId: tutorId
        },
        cache: false,
        success: function success(data) {
          if (data.insert !== "fail") $("#save-tutor").text(data.data);else {
            Toastify({
              text: "Lưu không thành công. Bạn đã lưu gia sư này rồi!",
              duration: 5000,
              close: true,
              gravity: "top",
              // `top` or `bottom`
              position: "right",
              // `left`, `center` or `right`
              stopOnFocus: true,
              // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #C73866, #FE676E)"
              },
              onClick: function onClick() {} // Callback after click

            }).showToast();
          }
          console.log(data, "data");
        },
        error: function error(xhr, status, _error3) {
          console.log(xhr, _error3, status, "Lỗi");
        }
      });
    });
  });
})();
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*************************************************!*\
  !*** ./resources/js/tutor_registration_form.js ***!
  \*************************************************/
(function () {
  var MyEditor;
  Dropzone.autoDiscover = false;
  var dropzoneCertificate;
  $(document).ready(function () {
    document.querySelector('#editor') && DecoupledEditor.create(document.querySelector('#editor'), {
      placeholder: 'Nhấn vào đây và hãy viết mô tả chi tiết nhất về kiến thức của bạn!',
      ckfinder: {
        uploadUrl: "../editor/uploadImages.php"
      }
    }).then(function (editor) {
      var toolbarContainer = document.querySelector('#toolbar-container');
      toolbarContainer.appendChild(editor.ui.view.toolbar.element);
      MyEditor = editor;
    })["catch"](function (error) {
      console.error(error);
    }); // dành cho select
    // Dropzone
    //  Dropzone.discover();

    if (document.querySelector("div#certificate")) {
      dropzoneCertificate = new Dropzone("div#certificate", {
        // Configuration options go here
        url: "../api/tutor/tutor_register",
        paramName: "file",
        // The name that will be used to transfer the file
        parallelUploads: 10,
        maxFilesize: 2,
        // MB
        maxFiles: 10,
        acceptedFiles: ".png,.jpg,.jpeg",
        autoProcessQueue: false,
        addRemoveLinks: true,
        uploadMultiple: true,
        // Dịch sang tiếng Việt
        dictDefaultMessage: "Kéo và thả file (có thể click) vào đây để upload <br>Ngoài ra bạn có thể chụp ảnh màn hình và dán vào trang web",
        dictFallbackMessage: "Trình duyệt của bạn không hỗ trợ kéo và thả upload file.",
        dictFallbackText: "Vui lòng sử dụng biểu mẫu dự phòng bên dưới để tải lên các file của bạn như ngày xưa.",
        dictFileTooBig: "File quá lớn ({{filesize}}MiB). Tối đa filesize: {{maxFilesize}}MiB.",
        dictInvalidFileType: "Bạn không thể tải lên các file thuộc loại này (chú ý đến đuôi file).",
        dictResponseError: "Máy chủ đã phản hồi với {{statusCode}} code.",
        dictCancelUpload: "Huỷ bỏ upload",
        dictUploadCanceled: "Upload đã huỷ bỏ.",
        dictCancelUploadConfirmation: "Bạn có chắc chắn muốn hủy upload này không?",
        dictRemoveFile: "Xoá file",
        dictRemoveFileConfirmation: null,
        dictMaxFilesExceeded: "Bạn không thể tải lên bất kỳ tệp nào nữa.",
        init: function init() {
          var upload = this;
          $("#upload-certificate").on("click", function (e) {
            e.preventDefault();
            if (confirm("Bạn đã chắc chắn chưa? Vì bạn chỉ thêm ảnh bằng cấp được 1 lần.") === true) upload.processQueue();
          });
          this.on("addedfile", function (file) {
            var _$;

            (_$ = $("#certificate_dropzone-error")) === null || _$ === void 0 ? void 0 : _$.remove();
          });
        },
        accept: function accept(file, done) {
          if (file.size === 0) {
            done("Không có file nào. Vui lòng upload file.");
          } else {
            done();
          }
        }
      });
    }
  }); // paste into dropzone

  document.onpaste = function (event) {
    var items = (event.clipboardData || event.originalEvent.clipboardData).items;
    items.forEach(function (item) {
      if (item.kind === 'file') {
        // adds the file to your dropzone instance
        dropzoneCertificate.addFile(item.getAsFile());
      }
    });
  }; //


  $.validator.addMethod("validOrNah", function (value, element) {
    console.log($(element)[0].selectedIndex, "element");

    if ($(element)[0].selectedIndex === 0) {
      return false;
    } else {}

    return true;
  }); // dành cho checkbox
  // dành cho ckeditor

  $.validator.addMethod("ck_editor", function (value, element) {
    var content_length = MyEditor.getData().trim().length; // console.log(element)

    return content_length > 0;
  }, "Vui lòng thêm nội dung mô tả."); // dành cho dropzone

  $.validator.addMethod("dropzone_validation", function (value, element) {
    var is_exists_file = dropzoneCertificate.files.length; // console.log(is_exists_file)

    return is_exists_file > 0;
  }, "Vui lòng thêm ảnh bằng cấp.");
  $("#register-form").validate({
    ignore: [],
    rules: {
      "current-phone-number": {
        required: true,
        rangelength: [10, 10]
      },
      "current-email": {
        required: true,
        email: true
      },
      "current-address": {
        required: true,
        minlength: 5
      },
      "subject": {
        required: true
      },
      "province": {
        validOrNah: true
      },
      "districts[]": {
        required: true // minlength: 1

      },
      "collage": {
        required: true,
        minlength: 5
      },
      "graduate-year": {
        required: true,
        digits: true
      },
      "teaching-form[]": {
        required: true,
        minlength: 1
      },
      "editor": {
        ck_editor: true
      },
      "teaching_time[]": {
        required: true
      },
      "certificate_dropzone": {
        dropzone_validation: true
      }
    },
    messages: {
      "current-phone-number": "Số điện thoại phải đủ 10 kí tự.",
      "current-email": "Email sai định dạng.",
      "current-address": "Địa chỉ nhiều hơn 5 kí tự.",
      "subject": "Vui lòng chọn môn học.",
      "province": "Vui lòng chọn tỉnh/thành phố.",
      "districts[]": "Vui lòng chọn huyện/thị xã.",
      "collage": "Trường phải ít nhất 5 kí tự",
      "graduate-year": "Năm tốt nghiệp không được trống và phải là số",
      "teaching-form[]": "Vui lòng chọn hình thức dạy.",
      "teaching_time[]": "Vui lòng chọn ít nhất một buổi dạy."
    },
    errorPlacement: function errorPlacement(label, element) {
      if ($(element).hasClass('select2bs5')) {
        label.insertAfter($(element).next(".select2-container")).addClass('mt-2 text-danger');
      } else if ($(element).is(":checkbox")) {
        label.insertAfter($(element).closest(".form-group").children(".error-checkbox")).addClass('mt-2 text-danger');
      } else {
        label.insertAfter(element).addClass('mt-2 text-danger');
      }
    },
    success: function success(label, element) {},
    submitHandler: function submitHandler(form) {
      // submitRegisterForm();
      // form.submit();
      console.log("1huy2k");
    }
  }); // function submitRegisterForm() {

  $("#register-form").on('submit', function (e) {
    e.preventDefault();
    var $form = $(e.target);
    console.log(dropzoneCertificate);
    if (!$form.valid()) return false; // 

    var token = $("#token").val();
    var currentPhone = $("#current-phone-number").val();
    var currentEmail = $("#current-email").val();
    var currentAddress = $("#current-address").val();
    var currentJob = $("#job").val();
    var currentProvince = $("#province option:selected").text();
    var currentCollage = $("#collage").val();
    var graduateYear = $("#graduate-year").val();
    var districts = "";
    var teachingForm = "";
    var subjects = [];
    var linkFace = $("#face").val();
    var linkTwit = $("#twit").val();
    var description = MyEditor.getData();
    var Sunday = {
      dayId: "0",
      timeId: []
    },
        Monday = {
      dayId: "1",
      timeId: []
    },
        Tuesday = {
      dayId: "2",
      timeId: []
    },
        Wednesday = {
      dayId: "3",
      timeId: []
    },
        Thursday = {
      dayId: "4",
      timeId: []
    },
        Friday = {
      dayId: "5",
      timeId: []
    },
        Saturday = {
      dayId: "6",
      timeId: []
    }; // teaching time

    $("#0").find("input[type='checkbox']:checked").each(function (i, elem) {
      Sunday.timeId.push($(elem).val());
    });
    $("#1").find("input[type='checkbox']:checked").each(function (i, elem) {
      Monday.timeId.push($(elem).val());
    });
    $("#2").find("input[type='checkbox']:checked").each(function (i, elem) {
      Tuesday.timeId.push($(elem).val());
    });
    $("#3").find("input[type='checkbox']:checked").each(function (i, elem) {
      Wednesday.timeId.push($(elem).val());
    });
    $("#4").find("input[type='checkbox']:checked").each(function (i, elem) {
      Thursday.timeId.push($(elem).val());
    });
    $("#5").find("input[type='checkbox']:checked").each(function (i, elem) {
      Friday.timeId.push($(elem).val());
    });
    $("#6").find("input[type='checkbox']:checked").each(function (i, elem) {
      Saturday.timeId.push($(elem).val());
    }); // select2

    $('.js-data-subjects-ajax').select2('data').map(function (val) {
      subjects.push({
        id: val.id,
        "subject": val.text
      });
    });
    $('.js-data-districts-ajax').select2('data').map(function (val, i, arr) {
      if (arr.length - 1 === i) {
        districts += val.text;
      } else {
        districts += val.text + ", ";
      }
    });
    $('.js-data-teaching-form-ajax').select2('data').map(function (val, i, arr) {
      if (arr.length - 1 === i) {
        teachingForm += val.id;
      } else {
        teachingForm += val.id + ", ";
      }
    });
    console.log(teachingForm);
    $.ajax({
      type: "post",
      url: "../api/tutor/tutor_register",
      data: {
        token: token,
        currentPhone: currentPhone,
        currentEmail: currentEmail,
        currentAddress: currentAddress,
        currentJob: currentJob,
        currentProvince: currentProvince,
        currentCollage: currentCollage,
        graduateYear: graduateYear,
        districts: districts,
        teachingForm: teachingForm,
        subjects: subjects,
        linkFace: linkFace,
        linkTwit: linkTwit,
        description: description,
        Sunday: Sunday.timeId.length > 0 && Sunday,
        Monday: Monday.timeId.length > 0 && Monday,
        Tuesday: Tuesday.timeId.length > 0 && Tuesday,
        Wednesday: Wednesday.timeId.length > 0 && Wednesday,
        Thursday: Thursday.timeId.length > 0 && Thursday,
        Friday: Friday.timeId.length > 0 && Friday,
        Saturday: Saturday.timeId.length > 0 && Saturday
      },
      cache: false,
      success: function success(data) {
        // if(data !== '0')
        if (data.author === 'isTutor') {
          Toastify({
            text: "Bạn đã là gia sư rồi!",
            duration: 5000,
            close: true,
            gravity: "top",
            // `top` or `bottom`
            position: "right",
            // `left`, `center` or `right`
            stopOnFocus: true,
            // Prevents dismissing of toast on hover
            style: {
              background: "linear-gradient(to right, #C73866, #FE676E)"
            },
            onClick: function onClick() {} // Callback after click

          }).showToast();
        }

        if (data.insert === 'successful') {
          Toastify({
            text: "Đăng kí thành công. Bạn hãy chờ duyệt nhé!",
            duration: 5000,
            close: true,
            gravity: "top",
            // `top` or `bottom`
            position: "right",
            // `left`, `center` or `right`
            stopOnFocus: true,
            // Prevents dismissing of toast on hover
            style: {
              background: "linear-gradient(to right, #56C596, #7BE495)"
            },
            onClick: function onClick() {} // Callback after click

          }).showToast();
        } else if (data.insert === 'fail') {
          Toastify({
            text: "Đăng kí không thành công. Bạn đã đăng kí rồi!",
            duration: 5000,
            close: true,
            gravity: "top",
            // `top` or `bottom`
            position: "right",
            // `left`, `center` or `right`
            stopOnFocus: true,
            // Prevents dismissing of toast on hover
            style: {
              background: "linear-gradient(to right, #C73866, #FE676E)"
            },
            onClick: function onClick() {} // Callback after click

          }).showToast();
        }

        console.log(data);
        console.log("1huy2k3");
      },
      error: function error(xhr, status, _error) {
        console.log(xhr, _error, status, "Lỗi");
      }
    });
  }); // }
})();
})();

/******/ })()
;