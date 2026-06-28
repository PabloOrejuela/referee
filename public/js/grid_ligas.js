document.addEventListener('DOMContentLoaded', function () {
    var provinciaSelect = document.getElementById('provinciaSelect');
    var torneosGrid = document.getElementById('torneosGrid');

    if (!provinciaSelect || !torneosGrid) {
        return;
    }

    function clearGrid() {
        torneosGrid.innerHTML = '';
    }

    function renderLigas(ligas) {
        clearGrid();

        if (!Array.isArray(ligas) || ligas.length === 0) {
            var emptyCol = document.createElement('div');
            emptyCol.className = 'col';
            emptyCol.innerHTML = `
                <div class="card liga-card h-100 shadow-sm border-0">
                    <div class="card-body p-4">
                        <p class="text-muted mb-0">No se encontraron ligas para la provincia seleccionada.</p>
                    </div>
                </div>`;
            torneosGrid.appendChild(emptyCol);
            return;
        }

        ligas.forEach(function (liga) {
            var col = document.createElement('div');
            col.className = 'col';

            var card = document.createElement('div');
            card.className = 'card liga-card h-100 shadow-sm border-0';

            var header = document.createElement('div');
            header.className = 'liga-card-header text-white d-flex align-items-center px-4';
            header.innerHTML = '<div class="liga-title flex-grow-1">' + escapeHtml(liga.nombre_liga) + '</div>' +
                '<span class="liga-flag"></span>';

            var body = document.createElement('div');
            body.className = 'card-body d-flex flex-column justify-content-between p-4';

            var infoRow = document.createElement('div');
            infoRow.className = 'd-flex align-items-center gap-3 mb-3';

            var logoWrapper = document.createElement('div');
            logoWrapper.className = 'liga-logo rounded-3 shadow-sm bg-white d-flex align-items-center justify-content-center';
            logoWrapper.innerHTML = '<span class="liga-logo-text">' + escapeHtml((liga.nombre_liga || '').substring(0, 4).toUpperCase()) + '</span>';

            var meta = document.createElement('div');
            meta.className = 'liga-meta';
            meta.innerHTML = '<h5 class="card-title mb-1">' + escapeHtml(liga.nombre_liga) + '</h5>' +
                '<p class="text-muted mb-1">Provincia: ' + escapeHtml(liga.provincia || 'N/A') + '</p>';

            infoRow.appendChild(logoWrapper);
            infoRow.appendChild(meta);

            var footerLink = document.createElement('a');
            footerLink.className = 'liga-favorite-link text-decoration-none fw-semibold text-primary';
            footerLink.href = '#';
            footerLink.innerHTML = '<i class="bi bi-star me-2"></i>Ver detalles';

            body.appendChild(infoRow);
            body.appendChild(footerLink);

            card.appendChild(header);
            card.appendChild(body);
            col.appendChild(card);
            torneosGrid.appendChild(col);
        });
    }

    function escapeHtml(text) {
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function loadLigas(provinciaId) {
        var url = window.location.origin + window.location.pathname.replace(/\/$/, '') + '/provincia/' + encodeURIComponent(provinciaId);

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Error al obtener ligas');
                }
                return response.json();
            })
            .then(function (data) {
                renderLigas(data);
            })
            .catch(function () {
                clearGrid();
                var errorCol = document.createElement('div');
                errorCol.className = 'col';
                errorCol.innerHTML = `
                    <div class="card liga-card h-100 shadow-sm border-0">
                        <div class="card-body p-4">
                            <p class="text-danger mb-0">Ocurrió un error al cargar las ligas. Intenta de nuevo.</p>
                        </div>
                    </div>`;
                torneosGrid.appendChild(errorCol);
            });
    }

    provinciaSelect.addEventListener('change', function () {
        var provinciaId = this.value;
        if (!provinciaId) {
            clearGrid();
            return;
        }
        loadLigas(provinciaId);
    });
});
