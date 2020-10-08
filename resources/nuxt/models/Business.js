export default class Business {

	user_id = "";
	parent = "";
	name = "";
	description = "";
	photo = "";
	virtual = "";
	type = "";
	type_name = "";
	category = "";
	price = 0;
	promo = 0;
	gallery = [];
	lat = "";
	lng = "";
	route = "";
	number = "";
	complement = "";
	zipcode = "";
	district = "";
	city = "";
	state = "";
	st = "";
	country = "";
	co = "";
	created_at = "2020-08-24T03:34:43.562049Z";
	updated_at = "2020-08-24T03:34:43.562589Z";
	type_photo = "";
	category_name = "";
	category_photo = "";
	_loading = false;

	constructor(attributes={}) {
		attributes = Object.assign({"user_id":"","parent":"","name":"","description":"","photo":"","virtual":"","type":"","type_name":"","category":"","price":0,"promo":0,"gallery":[],"lat":"","lng":"","route":"","number":"","complement":"","zipcode":"","district":"","city":"","state":"","st":"","country":"","co":"","created_at":"2020-08-24T03:34:43.563005Z","updated_at":"2020-08-24T03:34:43.563149Z","type_photo":"","category_name":"","category_photo":""}, attributes);
		for(var i in attributes) { this[i] = attributes[i]; }
	}

	save(options=[]) {
		return new Promise((resolve, reject) => {
			let _delete = () => {
				this._loading = true;
				let post = {attributes:this, class:'Business', method:'save', arguments:([].slice.call(arguments))};
				window.$nuxt.$axios.post('/api/call/', post).then((resp) => {
					this._loading = false;
					resolve(resp);
				}).catch((a, b, c, d, e) => { reject(a, b, c, d, e); });
			};
			_delete();
		});
	}

	remove() {
		return new Promise((resolve, reject) => {
			let _delete = () => {
				this._loading = true;
				let post = {attributes:this, class:'Business', method:'remove', arguments:([].slice.call(arguments))};
				window.$nuxt.$axios.post('/api/call/', post).then((resp) => {
					this._loading = false;
					resolve(resp);
				}).catch((a, b, c, d, e) => { reject(a, b, c, d, e); });
			};
			window.$nuxt.$swal({title: 'Confirmação', html: `Tem certeza que deseja deletar ${this.name}?`, }).then((resp) => {
				if (resp.value) { _delete(); }
			});
		});
	}

	search(params=[]) {
		return new Promise((resolve, reject) => {
			let _delete = () => {
				this._loading = true;
				let post = {attributes:this, class:'Business', method:'search', arguments:([].slice.call(arguments))};
				window.$nuxt.$axios.post('/api/call/', post).then((resp) => {
					this._loading = false;
					resolve(resp);
				}).catch((a, b, c, d, e) => { reject(a, b, c, d, e); });
			};
			_delete();
		});
	}

	types() {
		return new Promise((resolve, reject) => {
			let _delete = () => {
				this._loading = true;
				let post = {attributes:this, class:'Business', method:'types', arguments:([].slice.call(arguments))};
				window.$nuxt.$axios.post('/api/call/', post).then((resp) => {
					this._loading = false;
					resolve(resp);
				}).catch((a, b, c, d, e) => { reject(a, b, c, d, e); });
			};
			_delete();
		});
	}

	categories() {
		return new Promise((resolve, reject) => {
			let _delete = () => {
				this._loading = true;
				let post = {attributes:this, class:'Business', method:'categories', arguments:([].slice.call(arguments))};
				window.$nuxt.$axios.post('/api/call/', post).then((resp) => {
					this._loading = false;
					resolve(resp);
				}).catch((a, b, c, d, e) => { reject(a, b, c, d, e); });
			};
			_delete();
		});
	}

}