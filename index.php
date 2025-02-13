<?php
// index.php
include 'algoritmos/bfs.php';
include 'algoritmos/dfs.php';
include 'algoritmos/a_estrella.php';

$inicio = 'A';
$objetivo = 'F';

echo "<h2>Búsqueda Informada (A*)</h2>";
$caminoAEstrella = aEstrella($inicio, $objetivo);
echo $caminoAEstrella ? implode(' -> ', $caminoAEstrella) : "No se encontró un camino.";
