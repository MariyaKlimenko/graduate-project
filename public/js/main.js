webpackJsonp([2],{

/***/ 36:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(37);


/***/ }),

/***/ 37:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__app_js__ = __webpack_require__(38);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__user_user_js__ = __webpack_require__(39);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__user_all_js__ = __webpack_require__(40);




$(function () {
    __WEBPACK_IMPORTED_MODULE_0__app_js__["a" /* default */].init();
    __WEBPACK_IMPORTED_MODULE_1__user_user_js__["a" /* default */].init();
    __WEBPACK_IMPORTED_MODULE_2__user_all_js__["a" /* default */].init();
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),

/***/ 38:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {
/* harmony default export */ __webpack_exports__["a"] = ({
    bindEvents: function bindEvents() {
        var body = $('body');

        body.on('click', '#logout-button', function () {
            $('#logout-form').submit();
        });
    },
    init: function init() {
        this.bindEvents();
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),

/***/ 39:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {
/* harmony default export */ __webpack_exports__["a"] = ({
    bindEvents: function bindEvents() {
        var body = $('body');

        body.on('click', '#submit-create-user-button', function () {
            $('#create-user-form').submit();
        });
    },
    init: function init() {
        this.bindEvents();
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),

/***/ 40:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {
/* harmony default export */ __webpack_exports__["a"] = ({
    bindEvents: function bindEvents() {
        var body = $('body');

        $('#all-users-datatable').DataTable({
            columnDefs: [{
                "targets": [0],
                "visible": false,
                "searchable": false
            }],
            processing: true,
            serverSide: true,
            ajax: '/users/getDataTableData',
            columns: [{ data: 'id', name: 'users.id' }, { data: 'surname', name: 'users.surname' }, { data: 'name', name: 'users.name' }, { data: 'info.department', name: 'info.department' }, { data: 'info.position', name: 'info.position' }, { data: 'info.updated_at', name: 'info.updated_at' }]
        });
    },
    init: function init() {
        this.bindEvents();
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ })

},[36]);