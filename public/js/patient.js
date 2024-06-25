/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/patient.js ***!
  \*********************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }
$(document).ready(function () {
  var patientId = null;
  var applicationCode = null;
  var browserAgent = getBrowserAgent();
  var latitude = 0;
  var longitude = 0;

  //for contries -state relation
  $('.countries').change(function () {
    var selectedOption = $(this).find('option:selected');
    var country_id = selectedOption.val();
    var country_name = selectedOption.data('country-name');
    if (country_name) {
      $.ajax({
        url: '/get-states/' + country_name,
        type: 'GET',
        dataType: 'json',
        success: function success(data) {
          $('.states').empty();
          $('.states').append('<option value="">--Select--</option>');
          $.each(data, function (key, value) {
            $('.states').append('<option value="' + value.id + '">' + value.state_name + '</option>');
          });
        }
      });
    } else {
      $('.states').empty();
      $('.states').append('<option value="">--Select--</option>');
    }
  });

  //for contries -state relation within step 2
  $('.relationship_countries').change(function () {
    var selectedOption = $(this).find('option:selected');
    var country_id = selectedOption.val();
    var country_name = selectedOption.data('country-name');
    if (country_name) {
      $.ajax({
        url: '/get-states/' + country_name,
        type: 'GET',
        dataType: 'json',
        success: function success(data) {
          $('.relationship_states').empty();
          $('.relationship_states').append('<option value="">--Select--</option>');
          $.each(data, function (key, value) {
            $('.relationship_states').append('<option value="' + value.id + '">' + value.state_name + '</option>');
          });
        }
      });
    } else {
      $('.relationship_states').empty();
      $('.relationship_states').append('<option value="">--Select--</option>');
    }
  });

  //patient registration details  section 1
  document.getElementById('continueButton').addEventListener('click', /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
    var _document$getElementB, _document$querySelect, _document$querySelect2, _document$getElementB2, _document$getElementB3;
    var data, csrfToken;
    return _regeneratorRuntime().wrap(function _callee$(_context) {
      while (1) switch (_context.prev = _context.next) {
        case 0:
          data = {
            firstName: document.getElementById('first-name').value,
            middleName: (_document$getElementB = document.getElementById('middle-name').value) !== null && _document$getElementB !== void 0 ? _document$getElementB : "",
            lastName: document.getElementById('last-name').value,
            email: document.getElementById('email_step1').value,
            dateOfBirth: document.getElementById('date_of_birth').value,
            gender: (_document$querySelect = (_document$querySelect2 = document.querySelector('input[name="gender"]:checked')) === null || _document$querySelect2 === void 0 ? void 0 : _document$querySelect2.value) !== null && _document$querySelect !== void 0 ? _document$querySelect : '',
            country: (_document$getElementB2 = document.getElementById('countries').value) !== null && _document$getElementB2 !== void 0 ? _document$getElementB2 : '',
            state: (_document$getElementB3 = document.getElementById('states').value) !== null && _document$getElementB3 !== void 0 ? _document$getElementB3 : '',
            city: document.getElementById('city').value,
            postalCode: document.getElementById('postal_code').value,
            streetAddress: document.getElementById('street_address').value
          };
          $('.error-message').text('');
          _context.next = 4;
          return checkConnection();
        case 4:
          if (_context.sent) {
            _context.next = 7;
            break;
          }
          alert("Internet connection lost! Please reconnect and try again.");
          return _context.abrupt("return");
        case 7:
          if (data.firstName && data.lastName && data.dateOfBirth && data.city && data.postalCode && data.streetAddress) {
            // Get CSRF token from the page's meta tag
            csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Add CSRF token to the headers of the AJAX request
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': csrfToken
              }
            });
            $.ajax({
              url: '/save-patients-details-form',
              type: 'POST',
              dataType: 'json',
              data: data,
              success: function success(response) {
                patientId = response.id;
                document.getElementById("patientId").value = patientId;
              },
              error: function error(xhr) {
                // Handle error response
                if (xhr.status === 422) {
                  var errors = xhr.responseJSON.errors;
                  $.each(errors, function (key, value) {
                    $('#' + key + '-error').text(value[0]);
                  });
                }
              }
            });
          }
        case 8:
        case "end":
          return _context.stop();
      }
    }, _callee);
  })));

  //contact parties section 2

  document.getElementById('continueButtonStep2').addEventListener('click', /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
    var _document$querySelect3, _document$querySelect4, _document$querySelect5, _document$querySelect6, _document$getElementB4, _document$getElementB5, _document$getElementB6, _document$getElementB7, _document$getElementB8, _document$getElementB9, _document$getElementB10, _document$getElementB11, _document$getElementB12, _document$getElementB13, _document$getElementB14;
    var data, csrfToken;
    return _regeneratorRuntime().wrap(function _callee2$(_context2) {
      while (1) switch (_context2.prev = _context2.next) {
        case 0:
          // console.log(document.getElementById('first-name').value);
          data = {
            relationship_to_patient: document.getElementById('relationship_to_patient').value,
            relationship_email: document.getElementById('relationship_email').value,
            relationship_phone_number: document.getElementById('relationship_phone_number').value,
            relationship_preferred_mode_of_communication: (_document$querySelect3 = (_document$querySelect4 = document.querySelector('input[name="relationship_preferred_mode_of_communication"]:checked')) === null || _document$querySelect4 === void 0 ? void 0 : _document$querySelect4.value) !== null && _document$querySelect3 !== void 0 ? _document$querySelect3 : '',
            relationship_preferred_contact_time: (_document$querySelect5 = (_document$querySelect6 = document.querySelector('input[name="relationship_preferred_contact_time"]:checked')) === null || _document$querySelect6 === void 0 ? void 0 : _document$querySelect6.value) !== null && _document$querySelect5 !== void 0 ? _document$querySelect5 : '',
            relationship_first_name: (_document$getElementB4 = document.getElementById('relationship_first_name').value) !== null && _document$getElementB4 !== void 0 ? _document$getElementB4 : '',
            relationship_last_name: (_document$getElementB5 = document.getElementById('relationship_last_name').value) !== null && _document$getElementB5 !== void 0 ? _document$getElementB5 : '',
            relationship_npi: (_document$getElementB6 = document.getElementById('relationship_npi').value) !== null && _document$getElementB6 !== void 0 ? _document$getElementB6 : '',
            relationship_street_address: (_document$getElementB7 = document.getElementById('relationship_street_address').value) !== null && _document$getElementB7 !== void 0 ? _document$getElementB7 : '',
            relationship_city: (_document$getElementB8 = document.getElementById('relationship_city').value) !== null && _document$getElementB8 !== void 0 ? _document$getElementB8 : '',
            relationship_postal_code: (_document$getElementB9 = document.getElementById('relationship_postal_code').value) !== null && _document$getElementB9 !== void 0 ? _document$getElementB9 : '',
            relationship_countries: (_document$getElementB10 = document.getElementById('relationship_countries').value) !== null && _document$getElementB10 !== void 0 ? _document$getElementB10 : '',
            relationship_states: (_document$getElementB11 = document.getElementById('relationship_states').value) !== null && _document$getElementB11 !== void 0 ? _document$getElementB11 : '',
            relationship_institution: (_document$getElementB12 = document.getElementById('relationship_institution').value) !== null && _document$getElementB12 !== void 0 ? _document$getElementB12 : '',
            relationship_fax_no: (_document$getElementB13 = document.getElementById('relationship_fax_no').value) !== null && _document$getElementB13 !== void 0 ? _document$getElementB13 : '',
            relationship_other: (_document$getElementB14 = document.getElementById('relationship_other').value) !== null && _document$getElementB14 !== void 0 ? _document$getElementB14 : ''
          };
          data.patientId = patientId;

          // Check internet connection before proceeding
          _context2.next = 4;
          return checkConnection();
        case 4:
          if (_context2.sent) {
            _context2.next = 7;
            break;
          }
          alert("Internet connection lost! Please reconnect and try again.");
          return _context2.abrupt("return");
        case 7:
          csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Add CSRF token to the headers of the AJAX request
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': csrfToken
            }
          });
          $.ajax({
            url: '/save-contact-party-form',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function success(response) {},
            error: function error(xhr, status, _error) {
              // Handle error response
              console.error(_error);
            }
          });
        case 10:
        case "end":
          return _context2.stop();
      }
    }, _callee2);
  })));

  //patient physician  section 3

  document.getElementById('continueButtonStep3').addEventListener('click', /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee3() {
    var _document$getElementB15, _document$getElementB16, _document$getElementB17, _document$getElementB18, _document$getElementB19, _document$getElementB20, _document$getElementB21, _document$getElementB22, _document$getElementB23, _document$getElementB24;
    var data, csrfToken;
    return _regeneratorRuntime().wrap(function _callee3$(_context3) {
      while (1) switch (_context3.prev = _context3.next) {
        case 0:
          // console.log(document.getElementById('first-name').value);
          data = {
            firstName: (_document$getElementB15 = document.getElementById('first-name-step3').value) !== null && _document$getElementB15 !== void 0 ? _document$getElementB15 : '',
            lastName: (_document$getElementB16 = document.getElementById('last-name-step3').value) !== null && _document$getElementB16 !== void 0 ? _document$getElementB16 : '',
            institution: (_document$getElementB17 = document.getElementById('institution').value) !== null && _document$getElementB17 !== void 0 ? _document$getElementB17 : '',
            country: (_document$getElementB18 = document.getElementById('countries-step3').value) !== null && _document$getElementB18 !== void 0 ? _document$getElementB18 : '',
            state: (_document$getElementB19 = document.getElementById('states-step3').value) !== null && _document$getElementB19 !== void 0 ? _document$getElementB19 : '',
            city: (_document$getElementB20 = document.getElementById('city-step3').value) !== null && _document$getElementB20 !== void 0 ? _document$getElementB20 : '',
            postalCode: (_document$getElementB21 = document.getElementById('postal_code_step3').value) !== null && _document$getElementB21 !== void 0 ? _document$getElementB21 : '',
            streetAddress: (_document$getElementB22 = document.getElementById('street_address_step3').value) !== null && _document$getElementB22 !== void 0 ? _document$getElementB22 : '',
            email: (_document$getElementB23 = document.getElementById('email_step3').value) !== null && _document$getElementB23 !== void 0 ? _document$getElementB23 : '',
            phone_number: (_document$getElementB24 = document.getElementById('phone_number_step3').value) !== null && _document$getElementB24 !== void 0 ? _document$getElementB24 : ''
          };
          data.patientId = patientId;

          // Check internet connection before proceeding
          _context3.next = 4;
          return checkConnection();
        case 4:
          if (_context3.sent) {
            _context3.next = 7;
            break;
          }
          alert("Internet connection lost! Please reconnect and try again.");
          return _context3.abrupt("return");
        case 7:
          // Get CSRF token from the page's meta tag
          csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Add CSRF token to the headers of the AJAX request
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': csrfToken
            }
          });
          $.ajax({
            url: '/save-patients-physician-form',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function success(response) {},
            error: function error(xhr, status, _error2) {
              console.error(_error2);
            }
          });
        case 10:
        case "end":
          return _context3.stop();
      }
    }, _callee3);
  })));

  //primary concerns  section 4

  document.getElementById('continueButtonStep4').addEventListener('click', /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee4() {
    var _document$getElementB25, _document$querySelect7, _document$querySelect8, _document$getElementB26, _document$getElementB27;
    var data, csrfToken;
    return _regeneratorRuntime().wrap(function _callee4$(_context4) {
      while (1) switch (_context4.prev = _context4.next) {
        case 0:
          // console.log(document.getElementById('first-name').value);
          data = {
            primary_diagnosis: (_document$getElementB25 = document.getElementById('primary_diagnosis').value) !== null && _document$getElementB25 !== void 0 ? _document$getElementB25 : '',
            treated_before: (_document$querySelect7 = (_document$querySelect8 = document.querySelector('input[name="treated_before"]:checked')) === null || _document$querySelect8 === void 0 ? void 0 : _document$querySelect8.value) !== null && _document$querySelect7 !== void 0 ? _document$querySelect7 : '',
            surgery_description: (_document$getElementB26 = document.getElementById('surgery_description').value) !== null && _document$getElementB26 !== void 0 ? _document$getElementB26 : '',
            request_description: (_document$getElementB27 = document.getElementById('request_description').value) !== null && _document$getElementB27 !== void 0 ? _document$getElementB27 : ''
          };
          data.patientId = patientId;

          // Check internet connection before proceeding
          _context4.next = 4;
          return checkConnection();
        case 4:
          if (_context4.sent) {
            _context4.next = 7;
            break;
          }
          alert("Internet connection lost! Please reconnect and try again.");
          return _context4.abrupt("return");
        case 7:
          // Get CSRF token from the page's meta tag
          csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Add CSRF token to the headers of the AJAX request
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': csrfToken
            }
          });
          $.ajax({
            url: '/save-primary-concerns-form',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function success(response) {},
            error: function error(xhr, status, _error3) {
              console.error(_error3);
            }
          });
        case 10:
        case "end":
          return _context4.stop();
      }
    }, _callee4);
  })));
  function getBrowserAgent() {
    return navigator.userAgent;
  }

  //   $('#email_step1').on('blur', function() {
  //     var email = $(this).val();
  //     if (email === '') {
  //         $('#email-check-result').text('');
  //         return;
  //     }
  //     // Get CSRF token from the page's meta tag
  //     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  //     // Add CSRF token to the headers of the AJAX request
  //     $.ajaxSetup({
  //         headers: {
  //             'X-CSRF-TOKEN': csrfToken
  //         }
  //     });
  //     $.ajax({
  //         url: '/check-email',
  //         type: 'POST',
  //         data: {
  //             email: email,
  //         },
  //         success: function(response) {
  //             if (response.exists) {
  //                 $('#email-check-result')
  //                 .text('Email already exists')
  //                 .addClass('form__error-text');
  //                 $('#continueButton').prop('disabled', true);
  //             } else {
  //                 $('#email-check-result')
  //                 .text('')
  //                 .removeClass('form__error-text'); // Remove the class if not exists
  //                 $('#continueButton').prop('disabled', false);
  //             }
  //         }
  //     });
  // });
  function checkConnection() {
    return _checkConnection.apply(this, arguments);
  } // Usage example
  function _checkConnection() {
    _checkConnection = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee5() {
      var response;
      return _regeneratorRuntime().wrap(function _callee5$(_context5) {
        while (1) switch (_context5.prev = _context5.next) {
          case 0:
            _context5.prev = 0;
            _context5.next = 3;
            return fetch('https://www.google.com/generate_204', {
              mode: 'no-cors'
            });
          case 3:
            response = _context5.sent;
            return _context5.abrupt("return", true);
          case 7:
            _context5.prev = 7;
            _context5.t0 = _context5["catch"](0);
            return _context5.abrupt("return", false);
          case 10:
          case "end":
            return _context5.stop();
        }
      }, _callee5, null, [[0, 7]]);
    }));
    return _checkConnection.apply(this, arguments);
  }
  checkConnection().then(function (isConnected) {
    if (isConnected) {
      console.log('Internet is working');
    } else {
      console.log('No internet connection');
    }
  });
});
/******/ })()
;