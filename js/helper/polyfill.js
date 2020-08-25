(function() {
	String.prototype.number_format = function() {
		var number = (this + '').replace(/[^0-9+\-Ee.]/g, ''),
			data = number.split('.') || number.split(','),
			z = data[0].split('').reverse(),
			d = data[1] ? data[1].split('').reverse() : '';

		for (var i = 0; i < z.length; i++) {
			var index = (i + 1) * 3;

			if ( index < z.length ) {
				z.splice(index + i, 0, ' ');
			}
		}

		for (var i = 0; i < d.length; i++) {
			var index = (i + 1) * 3;

			if ( index < d.length + 3 ) {
				d.splice(index + i, 0, ' ');
			}
		}

		if ( d ) {
			return [z.reverse().join(''), d.reverse().join('')].join('. ');
		}else{
			return z.reverse().join('');
		}
    }

    if ( !String.prototype.trim ) {
	    String.prototype.trim = function() {
	      	return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
	    };
	}
	if (!Array.prototype.isArray) {
		Array.prototype.isArray = function(arg) {
		    return Object.prototype.toString.call(arg) === '[object Array]';
		};
	}
	if (!Array.prototype.reduce) {
		Array.prototype.reduce = function(callback/*, initialValue*/) {
		    'use strict';
		    if (this == null) {
		      	throw new TypeError('Array.prototype.reduce called on null or undefined');
		    }
		    if (typeof callback !== 'function') {
		      	throw new TypeError(callback + ' is not a function');
		    }

		    var t = Object(this), len = t.length >>> 0, k = 0, value;

		    if (arguments.length >= 2) {
		      	value = arguments[1];
		    } else {
		      	while (k < len && ! (k in t)) {
		        	k++; 
		      	}
		      	if (k >= len) {
		        	throw new TypeError('Reduce of empty array with no initial value');
		      	}
		      	value = t[k++];
		    }
		    for (; k < len; k++) {
		      	if (k in t) {
		        	value = callback(value, t[k], k, t);
		      	}
		    }
		    return value;
		};
	}

    if (!Object.keys) {
        Object.keys = (function() {
            'use strict';
            var hasOwnProperty = Object.prototype.hasOwnProperty,
                hasDontEnumBug = !({ toString: null }).propertyIsEnumerable('toString'),
                dontEnums = [
                    'toString',
                    'toLocaleString',
                    'valueOf',
                    'hasOwnProperty',
                    'isPrototypeOf',
                    'propertyIsEnumerable',
                    'constructor'
                ],
                dontEnumsLength = dontEnums.length;
    
            return function(obj) {
                if (typeof obj !== 'object' && (typeof obj !== 'function' || obj === null)) {
                    throw new TypeError('Object.keys called on non-object');
                }
    
                var result = [], prop, i;
    
                for (prop in obj) {
                    if (hasOwnProperty.call(obj, prop)) {
                        result.push(prop);
                    }
                }
    
                if (hasDontEnumBug) {
                    for (i = 0; i < dontEnumsLength; i++) {
                        if (hasOwnProperty.call(obj, dontEnums[i])) {
                            result.push(dontEnums[i]);
                        }
                    }
                }
                return result;
            };
        }());
    }
})();