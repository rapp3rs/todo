# todo
technical exam

# files:

- .htaccess
- index.php
- login.php
- logout.php
- todo.php
- user.php

- todo_index.txt    -   index used for the id of the todo (default value = 1)
- todo.txt          -   list of todo (format: id, todo, user_id)

# functions:

* /login
	* POST
	* username,password
* /logout
	* GET
* /todo
	* GET
* /todo/?id=todo_id
	* GET
* /todo/
	* POST
	* todo
* /todo/?id=todo_id&todo=todo
	* PATCH
* /todo/?id=todo_id
	* DELETE
