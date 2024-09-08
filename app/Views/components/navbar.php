<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="#">FerreToolsApp</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                $modulos = include __DIR__ . '/../../Config/Modulos.php';
                
                $jwt = $_COOKIE['jwt'] ?? null;
                $rolUsuario = null;

                if ($jwt) {
                    try {
                        $decoded = \Firebase\JWT\JWT::decode($jwt, new \Firebase\JWT\Key($_ENV['JWT_SECRET'], 'HS256'));
                        $rolUsuario = $decoded->rol;
                    } catch (Exception $e) {
                        header('Location: /login');
                        exit;
                    }
                }

                if ($rolUsuario) {
                    foreach ($modulos as $moduloPadre) {
                        if (in_array($rolUsuario, $moduloPadre['roles'])) {
                            if ($moduloPadre['nombre'] === 'Inicio') {
                                echo '<li class="nav-item">';
                                echo '<a class="nav-link" href="/home">';
                                echo '<i class="' . $moduloPadre['icono'] . ' me-2"></i>' . $moduloPadre['nombre'];
                                echo '</a>';
                                echo '</li>';
                            } else {
                                echo '<li class="nav-item dropdown">';
                                echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $moduloPadre['nombre'] . '</a>';
                                
                                // Módulos hijos
                                if (!empty($moduloPadre['hijos'])) {
                                    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                                    foreach ($moduloPadre['hijos'] as $moduloHijo) {
                                        if (in_array($rolUsuario, $moduloHijo['roles'])) {
                                            echo '<li><a class="dropdown-item" href="' . $moduloHijo['ruta'] . '">';
                                            echo '<div class="dropdown-item-content">';
                                            echo '<i class="' . $moduloHijo['icono'] . ' me-2"></i>';
                                            echo '<span>' . $moduloHijo['nombre'] . '</span>';
                                            echo '</div>';
                                            echo '</a></li>';
                                        }
                                    }
                                    echo '</ul>';
                                }
                                echo '</li>';
                            }
                        }
                    }
                } else {
                    header('Location: /login');
                    exit;
                }
                ?>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form action="/logout" method="GET">
                        <button class="btn btn-danger" type="submit">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
