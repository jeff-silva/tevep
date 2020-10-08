export default class User {

	_loading = false;

	constructor(attributes={}) {
		attributes = Object.assign([], attributes);
		for(var i in attributes) { this[i] = attributes[i]; }
	}

}