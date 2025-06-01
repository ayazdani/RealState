<header class="header" role="banner">
    <div class="container">
        <nav class="nav">
            <div class="logo">
                <a href="/">Real Estate</a>
            </div>
            
            <button class="mobile-menu-toggle" aria-label="Toggle menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div class="nav-menu">
                <a href="#" data-tab="buy">Buy</a>
                <a href="#" data-tab="rent">Rent</a>
                <a href="#" data-tab="sold">Sold</a>
            </div>
        </nav>
    </div>
</header>
<div class="mobile-menu-overlay"></div>

<meta name="description" content="...">
<meta name="keywords" content="...">
<meta property="og:title" content="...">
<meta property="og:description" content="...">
<style>
.suggestion-box {
    position: absolute;
    background: white;
    border: 1px solid #ccc;
    max-height: 200px;
    overflow-y: auto;
    width: 100%;
    z-index: 1000;
}

.suggestion-box div {
    padding: 8px 10px;
    cursor: pointer;
}

.suggestion-box div:hover {
    background-color: #f0f0f0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('suburb-input');
    const suggestionBox = document.getElementById('suburb-suggestions');

    input.addEventListener('input', function () {
        const term = input.value.trim();

        if (term.length === 0) {
            suggestionBox.innerHTML = '';
            return;
        }

        fetch('get_suburbs.php?term=' + encodeURIComponent(term))
            .then(response => response.json())
            .then(data => {
                suggestionBox.innerHTML = '';
                if (data.length === 0) return;

                data.forEach(suburb => {
                    const div = document.createElement('div');
                    div.textContent = suburb;
                    div.addEventListener('click', function () {
                        input.value = suburb;
                        suggestionBox.innerHTML = '';
                    });
                    suggestionBox.appendChild(div);
                });
            });
    });

    document.addEventListener('click', function (e) {
        if (!suggestionBox.contains(e.target) && e.target !== input) {
            suggestionBox.innerHTML = '';
        }
    });
});
</script>
