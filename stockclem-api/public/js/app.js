
// API Documentation JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the documentation
    initializeDocumentation();
});

function initializeDocumentation() {
    // Initialize all components
    initializeSidebar();
    initializeSearch();
    initializeCopyButtons();
    initializeEndpointToggle();
    initializeTooltips();
    generateAllResources();
    
    // Highlight syntax after everything is loaded
    if (typeof Prism !== 'undefined') {
        Prism.highlightAll();
    }
}

// Sidebar Navigation
function initializeSidebar() {
    const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
    const resourceSections = document.querySelectorAll('.resource-section');
    
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all links
            sidebarLinks.forEach(l => l.classList.remove('active'));
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Hide all sections
            resourceSections.forEach(section => {
                section.style.display = 'none';
            });
            
            // Show target section
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.style.display = 'block';
                targetSection.classList.add('fade-in');
                
                // Scroll to top of section
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
}

// Search Functionality
function initializeSearch() {
    const searchInput = document.getElementById('searchInput');
    const endpointCards = document.querySelectorAll('.endpoint-card');
    const resourceSections = document.querySelectorAll('.resource-section');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        if (searchTerm === '') {
            // Show all endpoints and reset to default view
            endpointCards.forEach(card => {
                card.style.display = 'block';
                removeHighlight(card);
            });
            resetToDefaultView();
            return;
        }
        
        let hasResults = false;
        
        // Show all sections when searching
        resourceSections.forEach(section => {
            section.style.display = 'block';
        });
        
        endpointCards.forEach(card => {
            const method = card.dataset.method;
            const endpoint = card.dataset.endpoint;
            const cardText = card.textContent.toLowerCase();
            
            if (cardText.includes(searchTerm) || 
                method.includes(searchTerm) || 
                endpoint.includes(searchTerm)) {
                card.style.display = 'block';
                highlightSearchTerm(card, searchTerm);
                hasResults = true;
            } else {
                card.style.display = 'none';
                removeHighlight(card);
            }
        });
        
        // Show "no results" message if needed
        if (!hasResults) {
            showNoResultsMessage();
        } else {
            hideNoResultsMessage();
        }
    });
}

function highlightSearchTerm(element, term) {
    // Simple highlight implementation
    const walker = document.createTreeWalker(
        element,
        NodeFilter.SHOW_TEXT,
        null,
        false
    );
    
    const textNodes = [];
    let node;
    
    while (node = walker.nextNode()) {
        if (node.textContent.toLowerCase().includes(term)) {
            textNodes.push(node);
        }
    }
    
    textNodes.forEach(textNode => {
        const text = textNode.textContent;
        const regex = new RegExp(`(${term})`, 'gi');
        const highlightedText = text.replace(regex, '<span class="search-highlight">$1</span>');
        
        if (highlightedText !== text) {
            const wrapper = document.createElement('span');
            wrapper.innerHTML = highlightedText;
            textNode.parentNode.replaceChild(wrapper, textNode);
        }
    });
}

function removeHighlight(element) {
    const highlights = element.querySelectorAll('.search-highlight');
    highlights.forEach(highlight => {
        highlight.outerHTML = highlight.innerHTML;
    });
}

function resetToDefaultView() {
    // Hide all sections except the first one
    const resourceSections = document.querySelectorAll('.resource-section');
    resourceSections.forEach((section, index) => {
        section.style.display = index === 0 ? 'block' : 'none';
    });
    
    // Reset active sidebar link
    const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
    sidebarLinks.forEach((link, index) => {
        link.classList.toggle('active', index === 0);
    });
}

function showNoResultsMessage() {
    let noResultsMsg = document.getElementById('no-results-message');
    if (!noResultsMsg) {
        noResultsMsg = document.createElement('div');
        noResultsMsg.id = 'no-results-message';
        noResultsMsg.className = 'alert alert-info text-center my-4';
        noResultsMsg.innerHTML = `
            <i class="fas fa-search me-2"></i>
            No se encontraron endpoints que coincidan con tu búsqueda.
        `;
        document.getElementById('api-content').appendChild(noResultsMsg);
    }
    noResultsMsg.style.display = 'block';
}

function hideNoResultsMessage() {
    const noResultsMsg = document.getElementById('no-results-message');
    if (noResultsMsg) {
        noResultsMsg.style.display = 'none';
    }
}

// Copy to Clipboard Functionality
function initializeCopyButtons() {
    const copyButtons = document.querySelectorAll('.copy-btn');
    
    copyButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const url = this.dataset.url;
            copyToClipboard(url, this);
        });
    });
}

function copyToClipboard(text, button) {
    navigator.clipboard.writeText(text).then(function() {
        showCopySuccess(button);
    }).catch(function(err) {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            showCopySuccess(button);
        } catch (err) {
            console.error('Error copying to clipboard:', err);
        }
        
        document.body.removeChild(textArea);
    });
}

function showCopySuccess(button) {
    const originalHTML = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check"></i>';
    button.classList.add('copied');
    
    setTimeout(() => {
        button.innerHTML = originalHTML;
        button.classList.remove('copied');
    }, 2000);
}

// Endpoint Toggle Functionality
function initializeEndpointToggle() {
    const toggleHeaders = document.querySelectorAll('.endpoint-header');
    
    toggleHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const targetId = this.dataset.bsTarget;
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                const isExpanded = targetElement.classList.contains('show');
                
                if (!isExpanded) {
                    // Highlight code when expanding
                    setTimeout(() => {
                        if (typeof Prism !== 'undefined') {
                            Prism.highlightAllUnder(targetElement);
                        }
                    }, 300);
                }
            }
        });
    });
}

// Initialize Tooltips
function initializeTooltips() {
    if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
}

// Generate All Resources
function generateAllResources() {
    const resources = [
        { 
            name: 'category', 
            icon: 'fas fa-tags', 
            description: 'Gestión de categorías en el sistema',
            examples: {
                single: { name: 'Categoría Principal', description: 'Descripción de la categoría' },
                list: [{ id: 1, name: 'Categoría Principal', description: 'Descripción de la categoría' }]
            }
        },
        { 
            name: 'entry', 
            icon: 'fas fa-file-alt', 
            description: 'Gestión de entradas en el sistema',
            examples: {
                single: { title: 'Nueva Entrada', content: 'Contenido de la entrada' },
                list: [{ id: 1, title: 'Nueva Entrada', content: 'Contenido de la entrada' }]
            }
        },
        { 
            name: 'issue', 
            icon: 'fas fa-exclamation-triangle', 
            description: 'Gestión de problemas reportados',
            examples: {
                single: { title: 'Problema reportado', status: 'open', priority: 'high' },
                list: [{ id: 1, title: 'Problema reportado', status: 'open', priority: 'high' }]
            }
        },
        { 
            name: 'person', 
            icon: 'fas fa-user', 
            description: 'Gestión de personas en el sistema',
            examples: {
                single: { name: 'Juan Pérez', email: 'juan@example.com', phone: '123-456-7890' },
                list: [{ id: 1, name: 'Juan Pérez', email: 'juan@example.com', phone: '123-456-7890' }]
            }
        },
        { 
            name: 'presentation', 
            icon: 'fas fa-presentation', 
            description: 'Gestión de presentaciones',
            examples: {
                single: { title: 'Mi Presentación', slides: 15, duration: '30 minutos' },
                list: [{ id: 1, title: 'Mi Presentación', slides: 15, duration: '30 minutos' }]
            }
        }
    ];
    
    resources.forEach(resource => {
        generateResourceSection(resource);
    });
}

function generateResourceSection(resource) {
    const section = document.getElementById(resource.name);
    if (!section) return;
    
    const endpoints = [
        { method: 'GET', path: `/${resource.name}`, action: 'index', description: `Listar todos los ${resource.name}s` },
        { method: 'GET', path: `/${resource.name}/{id}`, action: 'show', description: `Obtener ${resource.name} específico` },
        { method: 'POST', path: `/${resource.name}`, action: 'store', description: `Crear nuevo ${resource.name}` },
        { method: 'PUT', path: `/${resource.name}/{id}`, action: 'update', description: `Actualizar ${resource.name}` },
        { method: 'DELETE', path: `/${resource.name}/{id}`, action: 'destroy', description: `Eliminar ${resource.name}` }
    ];
    
    let endpointsHTML = '';
    
    endpoints.forEach((endpoint, index) => {
        const badgeClass = getBadgeClass(endpoint.method);
        const collapseId = `${resource.name}-${endpoint.action}`;
        
        endpointsHTML += `
            <div class="endpoint-card mb-3" data-method="${endpoint.method.toLowerCase()}" data-endpoint="${resource.name}">
                <div class="card">
                    <div class="card-header endpoint-header" data-bs-toggle="collapse" data-bs-target="#${collapseId}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge ${badgeClass} method-badge">${endpoint.method}</span>
                                <span class="endpoint-path">${endpoint.path}</span>
                                <span class="text-muted ms-2">${endpoint.description}</span>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-outline-secondary copy-btn" data-url="http://127.0.0.1:8000/api${endpoint.path}">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="${collapseId}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Request Example:</h6>
                                    <pre><code class="language-bash">${generateRequestExample(endpoint, resource)}</code></pre>
                                </div>
                                <div class="col-md-6">
                                    <h6>Response Example:</h6>
                                    <pre><code class="language-json">${generateResponseExample(endpoint, resource)}</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
    
    section.innerHTML = `
        <div class="resource-header mb-4">
            <h2 class="resource-title">
                <i class="${resource.icon} text-primary me-2"></i>${resource.name.charAt(0).toUpperCase() + resource.name.slice(1)}
            </h2>
            <p class="text-muted">${resource.description}</p>
        </div>
        ${endpointsHTML}
    `;
    
    // Reinitialize copy buttons for new elements
    const newCopyButtons = section.querySelectorAll('.copy-btn');
    newCopyButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const url = this.dataset.url;
            copyToClipboard(url, this);
        });
    });
}

function getBadgeClass(method) {
    const badges = {
        'GET': 'bg-success',
        'POST': 'bg-primary',
        'PUT': 'bg-warning',
        'DELETE': 'bg-danger'
    };
    return badges[method] || 'bg-secondary';
}

function generateRequestExample(endpoint, resource) {
    const baseUrl = `/api${endpoint.path}`;
    
    switch (endpoint.method) {
        case 'GET':
            if (endpoint.action === 'show') {
                return `GET ${baseUrl.replace('{id}', '1')}\nContent-Type: application/json`;
            }
            return `GET ${baseUrl}\nContent-Type: application/json`;
        
        case 'POST':
            const postData = JSON.stringify(resource.examples.single, null, 2);
            return `POST ${baseUrl}\nContent-Type: application/json\n\n${postData}`;
        
        case 'PUT':
            const putData = JSON.stringify(resource.examples.single, null, 2);
            return `PUT ${baseUrl.replace('{id}', '1')}\nContent-Type: application/json\n\n${putData}`;
        
        case 'DELETE':
            return `DELETE ${baseUrl.replace('{id}', '1')}`;
        
        default:
            return `${endpoint.method} ${baseUrl}\nContent-Type: application/json`;
    }
}

function generateResponseExample(endpoint, resource) {
    switch (endpoint.action) {
        case 'index':
            return JSON.stringify({
                data: resource.examples.list
            }, null, 2);
        
        case 'show':
            return JSON.stringify({
                data: { id: 1, ...resource.examples.single, created_at: "2024-01-01T00:00:00Z" }
            }, null, 2);
        
        case 'store':
            return JSON.stringify({
                data: { id: 2, ...resource.examples.single, created_at: "2024-01-01T00:00:00Z" }
            }, null, 2);
        
        case 'update':
            return JSON.stringify({
                data: { id: 1, ...resource.examples.single, updated_at: "2024-01-01T00:00:00Z" }
            }, null, 2);
        
        case 'destroy':
            return JSON.stringify({
                message: `${resource.name.charAt(0).toUpperCase() + resource.name.slice(1)} eliminado exitosamente`
            }, null, 2);
        
        default:
            return '{}';
    }
}

// Utility Functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Mobile Menu Toggle (if needed)
function initializeMobileMenu() {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
        
        // Close sidebar when clicking outside
        document.addEventListener('click', function(e) {
            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        });
    }
}

// Smooth scrolling for anchor links
function initializeSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Initialize additional features
document.addEventListener('DOMContentLoaded', function() {
    initializeMobileMenu();
    initializeSmoothScrolling();
});

// Export functions for potential external use
window.APIDocumentation = {
    initializeDocumentation,
    copyToClipboard,
    generateResourceSection,
    highlightSearchTerm,
    removeHighlight
};