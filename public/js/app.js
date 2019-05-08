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
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./components/order.js */ "./resources/js/components/order.js");

/***/ }),

/***/ "./resources/js/components/order.js":
/*!******************************************!*\
  !*** ./resources/js/components/order.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Order =
/*#__PURE__*/
function () {
  function Order(order) {
    var _this = this;

    _classCallCheck(this, Order);

    this.order = order;
    this.saveOrderButton = document.querySelectorAll('.order__served-button');
    this.saveOrderButton.forEach(function (button) {
      button.addEventListener('click', function (event) {
        _this.update(button.getAttribute('order_id'), button.getAttribute('role'));
      });
    });
    this.orderNotReadyButton = document.querySelectorAll('.order__notReady');
    this.orderNotReadyButton.forEach(function (button) {
      button.addEventListener('click', function (event) {
        _this.changeButton(button);
      });
    });
    this.getOrders();
  }

  _createClass(Order, [{
    key: "update",
    value: function update(order, role) {
      fetch('/order/ready', {
        method: 'post',
        credentials: "same-origin",
        mode: 'cors',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
        },
        body: JSON.stringify({
          orderId: order,
          role: role
        })
      }).then(function (res) {
        return res.json();
      }).then(function (data) {
        return console.log(data);
      }).catch(function (error) {
        return console.log(error);
      });
    }
  }, {
    key: "changeButton",
    value: function changeButton(button) {
      button.classList.remove('order__notReady');
      button.classList.add('order__ready');
    }
  }, {
    key: "getOrders",
    value: function getOrders() {
      setInterval(function () {
        var section = document.getElementsByClassName('section')[0];
        var orderContainer = document.getElementsByClassName('order__container');
        var table = document.getElementsByClassName('order__tableNr');
        var name = document.getElementsByClassName('user__name');
        var email = document.getElementsByClassName('user__email');
        fetch('/order/json').then(function (response) {
          return response.json();
        }).then(function (json) {
          console.log(json);

          if (json.length > orderContainer.length) {
            var container = document.createElement("div");
            container.classList = 'order__container';

            var _table = document.createElement("order__table");

            _table.classList = 'order__table';
            var tableText = document.createTextNode("Tafel");

            _table.appendChild(tableText);

            var tableNr = document.createElement('span');
            tableNr.classList = 'order__tableNr';
            tableNr.textContent = json[json.length - 1].table.table_nr;

            _table.appendChild(tableNr);

            var orderField = document.createElement('div');
            orderField.classList = 'order__field';
            orderProducts = document.createElement('div');
            orderProducts.classList = 'order__products';
            console.log('products');

            for (var i = 0; i < json[json.length - 1].products.length; i++) {
              orderProduct = document.createElement('div');
              orderProduct.classList = 'order__product';
              orderProducts.appendChild(orderProduct);
              productName = document.createElement('div');
              productName.classList = 'order__product-name';
              productName.textContent = json[json.length - 1].products[i].name;
              productAmount = document.createElement('div');
              productAmount.classList = 'order__product-amount';
              productAmount.textContent = 1;
              orderProduct.appendChild(productName);
              orderProduct.appendChild(productAmount);
            }

            var orderServed = document.createElement('div');
            orderServed.classList = 'order__served';
            var orderServedText = document.createElement('h3');
            orderServedText.textContent = 'Klaar om te serveren?';
            var orderServedButton = document.createElement('button');
            orderServedButton.classList = 'order__served-button order__notReady';
            orderServedButton.setAttribute('order_id', json[json.length - 1].id);
            orderServedButton.setAttribute('role', 'kok'); //fix this

            orderServedButton.textContent = 'Klaar';
            orderServed.appendChild(orderServedText);
            orderServed.appendChild(orderServedButton);
            orderField.appendChild(orderProducts);
            orderField.appendChild(orderServed);
            container.appendChild(_table);
            container.appendChild(orderField);
            section.appendChild(container);
          } else {
            for (var _i = 0; _i < json.length; _i++) {
              table[_i].textContent = json[_i].table.table_nr;
            }
          }
        });
      }, 2000);
    }
  }]);

  return Order;
}();

new Order();

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! D:\Xammp\htdocs\competa\personal-sprint\PHP\Bestelling-opnemen\applicatie\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! D:\Xammp\htdocs\competa\personal-sprint\PHP\Bestelling-opnemen\applicatie\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });