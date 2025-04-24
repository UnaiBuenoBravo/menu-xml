<?php
$xml = simplexml_load_file('data/menu.xml') or die("Error: No se pudo cargar el XML.");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carta del Restaurante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container py-5">
        <h1 class="titulo-principal">Carta del Restaurante</h1>
        <div class="row">
            <?php foreach ($xml->plato as $plato): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="plato-nombre"><?= $plato->nombre ?> <span class="badge bg-secondary"><?= $plato['tipo'] ?></span></h5>
                            <p class="descripcion"><?= $plato->descripcion ?></p>
                            <p class="precio"><strong>Precio:</strong> <?= $plato->precio ?> €</p>
                            <p class="calorias"><strong>Calorías:</strong> <?= $plato->calorias ?> kcal</p>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ($plato->ingredientes->categoria as $item): ?>
                                    <span class="badge rounded-pill etiqueta">
                                        <i class="fa <?= iconFromCategory((string)$item) ?>"></i> <?= ucfirst($item) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

<?php
function iconFromCategory($category) {
    $icons = [
        "vegano" => "fa-leaf",
        "sin gluten" => "fa-ban",
        "carne" => "fa-drumstick-bite",
        "lacteo" => "fa-cheese",
        "Destacado" => "fa-star",
        "picante" => "fa-pepper-hot"
    ];
    return $icons[strtolower($category)] ?? "fa-utensils";
}
?>
