<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentación de la API</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->x  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Prism CSS para resaltar código -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">

    <!-- Tu CSS personalizado -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-code me-2"></i>
                Documentación de la API
            </a>
            <div class="navbar-text text-light">
                <small>Base URL: <code class="text-warning">http://127.0.0.1:8000/api/</code></small>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 col-md-4 sidebar">
                <div class="sticky-top pt-3">
                    <!-- Search -->
                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" id="searchInput" placeholder="Buscar endpoints...">
                        </div>
                    </div>

                    <!-- Resources Menu -->
                    <div class="resources-menu">
                        <h6 class="text-muted text-uppercase fw-bold mb-3">
                            <i class="fas fa-folder-open me-2"></i>Recursos
                        </h6>
                        <ul class="nav flex-column">
                            <li class="nav-item" data-resource="article">
                                <a class="nav-link active" href="#article">
                                    <i class="fas fa-newspaper me-2"></i>Article
                                </a>
                            </li>
                            <li class="nav-item" data-resource="category">
                                <a class="nav-link" href="#category">
                                    <i class="fas fa-tags me-2"></i>Category
                                </a>
                            </li>
                            <li class="nav-item" data-resource="entry">
                                <a class="nav-link" href="#entry">
                                    <i class="fas fa-file-alt me-2"></i>Entry

                                </a>
                            </li>
                            <li class="nav-item" data-resource="issue">
                                <a class="nav-link" href="#issue">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Issue
                                </a>
                            </li>
                            <li class="nav-item" data-resource="person">
                                <a class="nav-link" href="#person">
                                    <i class="fas fa-user me-2"></i>Person
                                </a>
                            </li>
                            <li class="nav-item" data-resource="presentation">
                                <a class="nav-link" href="#presentation">
                                    <i class="fas fa-user me-2"></i>Presentation
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9 col-md-8 main-content">
                <div class="py-4">
                    <!-- Welcome Section -->
                    <div class="welcome-section mb-5">
                        <h1 class="display-5 fw-bold text-dark mb-3">API Documentation</h1>
                        <p class="lead text-muted">
                            Documentación completa de los endpoints REST disponibles en la API.
                            Utiliza el menú lateral para navegar entre los diferentes recursos.
                        </p>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>URL Base:</strong> <code>http://127.0.0.1:8000/api/</code>
                        </div>
                    </div>

                    <!-- API Resources -->
                    <div id="api-content">
                        <!-- Article Resource -->
                        <div class="resource-section" id="article" data-resource="article">
                            <div class="resource-header mb-4">
                                <h2 class="resource-title">
                                    <i class="fas fa-newspaper text-primary me-2"></i>Article
                                </h2>
                                <p class="text-muted">Gestión de artículos en el sistema</p>
                            </div>

                            <!-- GET Index -->
                            <div class="endpoint-card mb-3" data-method="get" data-endpoint="article">
                                <div class="card">
                                    <div class="card-header endpoint-header" data-bs-toggle="collapse" data-bs-target="#article-index">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge bg-success method-badge">GET</span>
                                                <span class="endpoint-path">/article</span>
                                                <span class="text-muted ms-2">Listar todos los artículos</span>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-outline-secondary copy-btn" data-url="http://127.0.0.1:8000/api/article">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                                <i class="fas fa-chevron-down toggle-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse" id="article-index">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Request Example:</h6>
                                                    <pre><code class="language-bash">GET /api/article
Content-Type: application/json</code></pre>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Response Example:</h6>
                                                    <pre><code class="language-json">{
  "data": [
    {
      "id": 1,
      "title": "Título del artículo",
      "content": "Contenido...",
      "created_at": "2024-01-01T00:00:00Z"
    }
  ]
}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- GET Show -->
                            <div class="endpoint-card mb-3" data-method="get" data-endpoint="article/{id}">
                                <div class="card">
                                    <div class="card-header endpoint-header" data-bs-toggle="collapse" data-bs-target="#article-show">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge bg-success method-badge">GET</span>
                                                <span class="endpoint-path">/article/{id}</span>
                                                <span class="text-muted ms-2">Obtener artículo específico</span>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-outline-secondary copy-btn" data-url="http://127.0.0.1:8000/api/article/{id}">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                                <i class="fas fa-chevron-down toggle-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse" id="article-show">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Request Example:</h6>
                                                    <pre><code class="language-bash">GET /api/article/1
Content-Type: application/json</code></pre>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Response Example:</h6>
                                                    <pre><code class="language-json">{
  "data": {
    "id": 1,
    "title": "Título del artículo",
    "content": "Contenido completo...",
    "created_at": "2024-01-01T00:00:00Z"
  }
}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- POST Store -->
                            <div class="endpoint-card mb-3" data-method="post" data-endpoint="article">
                                <div class="card">
                                    <div class="card-header endpoint-header" data-bs-toggle="collapse" data-bs-target="#article-store">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge bg-primary method-badge">POST</span>
                                                <span class="endpoint-path">/article</span>
                                                <span class="text-muted ms-2">Crear nuevo artículo</span>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-outline-secondary copy-btn" data-url="http://127.0.0.1:8000/api/article">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                                <i class="fas fa-chevron-down toggle-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse" id="article-store">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Request Example:</h6>
                                                    <pre><code class="language-bash">POST /api/article
Content-Type: application/json

{
  "title": "Nuevo artículo",
  "content": "Contenido del artículo"
}</code></pre>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Response Example:</h6>
                                                    <pre><code class="language-json">{
  "data": {
    "id": 2,
    "title": "Nuevo artículo",
    "content": "Contenido del artículo",
    "created_at": "2024-01-01T00:00:00Z"
  }
}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PUT Update -->
                            <div class="endpoint-card mb-3" data-method="put" data-endpoint="article/{id}">
                                <div class="card">
                                    <div class="card-header endpoint-header" data-bs-toggle="collapse" data-bs-target="#article-update">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge bg-warning method-badge">PUT</span>
                                                <span class="endpoint-path">/article/{id}</span>
                                                <span class="text-muted ms-2">Actualizar artículo</span>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-outline-secondary copy-btn" data-url="http://127.0.0.1:8000/api/article/{id}">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                                <i class="fas fa-chevron-down toggle-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse" id="article-update">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Request Example:</h6>
                                                    <pre><code class="language-bash">PUT /api/article/1
Content-Type: application/json

{
  "title": "Artículo actualizado",
  "content": "Nuevo contenido"
}</code></pre>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Response Example:</h6>
                                                    <pre><code class="language-json">{
  "data": {
    "id": 1,
    "title": "Artículo actualizado",
    "content": "Nuevo contenido",
    "updated_at": "2024-01-01T00:00:00Z"
  }
}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DELETE Destroy -->
                            <div class="endpoint-card mb-3" data-method="delete" data-endpoint="article/{id}">
                                <div class="card">
                                    <div class="card-header endpoint-header" data-bs-toggle="collapse" data-bs-target="#article-destroy">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge bg-danger method-badge">DELETE</span>
                                                <span class="endpoint-path">/article/{id}</span>
                                                <span class="text-muted ms-2">Eliminar artículo</span>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-outline-secondary copy-btn" data-url="http://127.0.0.1:8000/api/article/{id}">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                                <i class="fas fa-chevron-down toggle-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse" id="article-destroy">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Request Example:</h6>
                                                    <pre><code class="language-bash">DELETE /api/article/1</code></pre>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Response Example:</h6>
                                                    <pre><code class="language-json">{
  "message": "Artículo eliminado exitosamente"
}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Other resources would follow the same pattern -->
                        <!-- For brevity, I'll include placeholders for other resources -->
                        
                        <!-- Category Resource -->
                        <div class="resource-section" id="category" data-resource="category" style="display: none;">
                            <div class="resource-header mb-4">
                                <h2 class="resource-title">
                                    <i class="fas fa-tags text-primary me-2"></i>Category
                                </h2>
                                <p class="text-muted">Gestión de categorías en el sistema</p>
                            </div>
                            <!-- Similar endpoints structure for Category -->
                        </div>

                        <!-- entry Resource -->
                        <div class="resource-section" id="entry" data-resource="entry" style="display: none;">
                            <div class="resource-header mb-4">
                                <h2 class="resource-title">
                                    <i class="fas fa-file-alt text-primary me-2"></i>Entry
                                </h2>
                                <p class="text-muted">Gestión de entradas en el sistema</p>
                            </div>
                        </div>

                        <!-- Issue Resource -->
                        <div class="resource-section" id="issue" data-resource="issue" style="display: none;">
                            <div class="resource-header mb-4">
                                <h2 class="resource-title">
                                    <i class="fas fa-exclamation-triangle text-primary me-2"></i>Issue
                                </h2>
                                <p class="text-muted">Gestión de problemas reportados</p>
                            </div>
                        </div>

                        <!-- Person Resource -->
                        <div class="resource-section" id="person" data-resource="person" style="display: none;">
                            <div class="resource-header mb-4">
                                <h2 class="resource-title">
                                    <i class="fas fa-user text-primary me-2"></i>Person
                                </h2>
                                <p class="text-muted">Gestión de personas en el sistema</p>
                            </div>
                        </div>

                        <!-- Presentation Resource -->
                        <div class="resource-section" id="presentation" data-resource="presentation" style="display: none;">
                            <div class="resource-header mb-4">
                                <h2 class="resource-title">
                                    <i class="fas fa-presentation text-primary me-2"></i>Presentation
                                </h2>
                                <p class="text-muted">Gestión de presentaciones</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>