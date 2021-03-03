import Vue from 'vue';

// https://github.com/Akryum/v-tooltip
import VTooltip from 'v-tooltip'
Vue.use(VTooltip);

// https://github.com/avil13/vue-sweetalert2
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);

// https://vuejs-tips.github.io/vue-the-mask/
import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask);


Vue.prototype.$log = function() {
	for(var i in arguments) {
		console.log(arguments[i]);
	}
};

Vue.prototype.$env = {
	NODE_ENV: process.env.NODE_ENV,
	APP_NAME: process.env.APP_NAME,
	APP_DESCRIPTION: process.env.APP_DESCRIPTION,
	APP_VERSION: (require('../../../package.json').version || '0.0.0'),
	APP_COLOR: (process.env.APP_COLOR || false),
	APP_LANG: (process.env.APP_LANG || false),
};

Vue.prototype.$copy = function(text) {
	return new Promise((resolve, reject) => {
		if (text.nodeType) {
			text = text.innerText;
		}
	
		let ta = Object.assign(document.createElement('textarea'), {
			style: {position:"fixed", top:-1000},
			value: text,
		});
	
		document.body.appendChild(ta);
		ta.focus();
		ta.select();
		let bool = document.execCommand('copy');
		document.body.removeChild(ta);
		
		if (bool) resolve(text);
		else reject('Erro ao copiar');
	});
};

// Filters

import moment from 'moment';

Vue.filter('date', function(value, format='DD/MM/YYYY') {
	let d = moment(value);
	return d.isValid()? d.format(format): '';
});

Vue.filter('time', function(value, format='hh:mm') {
	let d = moment(value);
	return d.isValid()? d.format(format): '';
});

Vue.filter('datetime', function(value, format='DD/MM/YYYY à\\s hh:mm') {
	let d = moment(value);
	return d.isValid()? d.format(format): '';
});


Vue.filter('linkWhatsapp', function(number, text='') {
	number = (number||'').replace(/[^0-9]/g, '');
	text = encodeURI(text);
	return `https://api.whatsapp.com/send?phone=${number}&text=${text}`;
});

// Directives



// Redirect
// https://auth.nuxtjs.org/api/auth/#onredirecthandler