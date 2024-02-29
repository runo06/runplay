<style>
    .busqueda {
    display: flex;
    align-items: center;
}

form {
    display: flex;
    align-items: center;
}

label {
    margin-right: 10px;
    color: #333; /* Color del texto del label */
}

input[type="text"] {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 8px 12px;
    font-size: 16px;
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}
</style>


<nav class="nav-container">
        <div class="busqueda">
            <form action="" method="get">
                <input type="text" name="q" placeholder="Buscar..." required>
                <button type="submit">Buscar</button>
            </form>
        </div>
</nav>