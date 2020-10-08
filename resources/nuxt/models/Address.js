export default class Address {

	id = 0;
	name = "";
	ref = "";
	ref_id = "";
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
	_loading = false;

	constructor(attributes={}) {
		attributes = Object.assign({"id":0,"name":"","ref":"","ref_id":"","lat":"","lng":"","route":"","number":"","complement":"","zipcode":"","district":"","city":"","state":"","st":"","country":"","co":""}, attributes);
		for(var i in attributes) { this[i] = attributes[i]; }
	}

}