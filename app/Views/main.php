<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>To-Do List</title>
    <link rel="stylesheet" href="/styles/login.css">
</head>
<body>
    <h1>To-Do List</h1>

    <form id="todoForm">
        <input type="text" id="taskInput" name="task" placeholder="Escribe una tarea..." required />
        <button type="submit">Agregar</button>
    </form>

    <ul id="taskList">
        <!-- Aquí van las tareas -->
    </ul>
</body>
</html>