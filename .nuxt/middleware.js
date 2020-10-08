const middleware = {}

middleware['auth'] = require('..\\resources\\nuxt\\middleware\\auth.js')
middleware['auth'] = middleware['auth'].default || middleware['auth']

export default middleware
