<?php
// algoritmos/a_estrella.php
include 'grafo.php';

// Heurística (distancia estimada al objetivo)
$heuristica = [
    'A' => 4, 'B' => 3, 'C' => 2,
    'D' => 6, 'E' => 1, 'F' => 0
];

function aEstrella($inicio, $objetivo) {
    global $grafo, $heuristica;
    $abiertos = [[$inicio, 0]];
    $cerrados = [];
    $costos = [$inicio => 0];
    $caminos = [$inicio => [$inicio]];

    while (!empty($abiertos)) {
        usort($abiertos, function($a, $b) {
            global $heuristica;
            return ($a[1] + $heuristica[$a[0]]) <=> ($b[1] + $heuristica[$b[0]]);
        });

        list($nodo, $costoActual) = array_shift($abiertos);

        if ($nodo == $objetivo) {
            return $caminos[$nodo];
        }

        $cerrados[] = $nodo;

        foreach ($grafo[$nodo] as $vecino => $costo) {
            $nuevoCosto = $costoActual + $costo;

            if (!in_array($vecino, $cerrados) && (!isset($costos[$vecino]) || $nuevoCosto < $costos[$vecino])) {
                $costos[$vecino] = $nuevoCosto;
                $abiertos[] = [$vecino, $nuevoCosto];
                $caminos[$vecino] = array_merge($caminos[$nodo], [$vecino]);
            }
        }
    }

    return null;
}
