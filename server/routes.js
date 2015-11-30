
/* ========================================================== 
Internal App Modules/Packages Required
============================================================ */
var todoRoutes = require('./routes/transfer-routes.js');	//Exchange routes Change a lot of stuff here.


module.exports = function(app) {

	/*================================================================
	ROUTES
	=================================================================*/
	app.post('/api/todos', todoRoutes.createTodo);
	app.get('/api/todos', todoRoutes.getTodos);
	app.put('/api/todos/:todo_id', todoRoutes.updateTodo);
	app.delete('/api/todos/:todo_id', todoRoutes.deleteTodo);


};