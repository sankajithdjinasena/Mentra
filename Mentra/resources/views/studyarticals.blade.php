@extends('layouts.web')

@section('content')
    <title>Mentra | Study Articals</title>

    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">

    <section class=" container sec  wow fadeInDown row">
        <div class="col-md-6">
             <main class="container">
        <section class="hero">
            <h2>Discover Knowledge In Real-Time</h2>
            <p>Access study-focused articles and textbooks directly from Wikipedia & Wikibooks instantly.</p>
            
            <div class="search-container">
                <div class="search-box">
                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" id="searchInput" placeholder="Search for a study topic (e.g., Quantum Mechanics)..." autocomplete="off">
                    <select id="searchSource" class="source-dropdown">
                        <option value="wikipedia">Articles (Wikipedia)</option>
                        <option value="wikibooks">Books (Wikibooks)</option>
                    </select>
                </div>
            </div>
        </section>

        <section id="resultsSection" class="results-grid hidden">
            <!-- Results will be injected here via JavaScript -->
        </section>
        
        <div id="loadingIndicator" class="loading hidden">
            <div class="spinner"></div>
            <p>Fetching knowledge...</p>
        </div>
    </main>
        </div>
        <div class="col-md-6"><h2>Articles on Mentra</h2>
        <p>Here are some useful articles that will help you improve focus and stay productive while studying</p>
        @auth
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addArticleModal" style="width: 190px;">
                    + Add Article
                </button>
            </div>
        @endauth
        <ul class="article-list">
            @foreach ($articles as $article)
                <li>
                    <a href="{{ $article['url'] }}" target="_blank">{{ $article['title'] }}</a>
                </li>
            @endforeach
        </ul></div>
      
    
    
    
    </section>


   

    @auth
<div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="addArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('articles.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="addArticleModalLabel">Add New Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="title">Article Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter article name" required>
                </div>

                <div class="form-group mb-3">
                    <label for="url">Article URL</label>
                    <textarea name="url" class="form-control" rows="3" placeholder="Enter article URL..." required></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" style="width: 190px;">Submit Article</button>
            </div>
        </form>
    </div>
</div>
@endauth
@endsection




<style>


/* Hero & Search Section */
.hero {
    text-align: left;
    margin-bottom: 40px;
}


.search-container {
    background: rgba(255, 255, 255, 0.05);
    padding: 10px;
    border-radius: 15px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.search-box {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 5px 15px;
}

.search-icon {
    color: #94a3b8;
}

#searchInput {
    flex: 1;
    background: transparent;
    border: 1px gray solid;
    color: black;
    padding: 10px;
    outline: none;
    font-size: 1rem;
}

.source-dropdown {
    background: #1e293b;
    color: white;
    border: 1px solid #475569;
    padding: 8px 12px;
    border-radius: 8px;
    cursor: pointer;
}

/* Real-time Results Grid */
.results-grid {
    display: grid;
    gap: 20px;
    margin-top: 30px;
    max-height: 600px;
    overflow-y: auto;
    padding-right: 10px;
}

.results-grid::-webkit-scrollbar {
    width: 6px;
}
.results-grid::-webkit-scrollbar-thumb {
    background: #475569;
    border-radius: 10px;
}

/* Result Cards */
.card {
    background: #1e293b;
    border-radius: 12px;
    padding: 20px;
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: transform 0.3s ease, border-color 0.3s ease;
    animation: fadeInUp 0.5s ease forwards;
}

.card:hover {
    transform: translateY(-5px);
    border-color: #6366f1;
}

.card h3 {
    font-size: 1.2rem;
    color: #f1f5f9;
    margin: 10px 0;
}

.card p {
    font-size: 0.9rem;
    color: #94a3b8;
    line-height: 1.5;
}

.tag {
    font-size: 0.7rem;
    text-transform: uppercase;
    background: rgba(99, 102, 241, 0.2);
    color: #818cf8;
    padding: 4px 10px;
    border-radius: 20px;
    font-weight: 600;
}

.read-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 15px;
    color: #60a5fa;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
}

/* Article List (Sidebar) */
.article-list {
    list-style: none;
    padding: 0;
}

.article-list li {
    background: rgba(255, 255, 255, 0.03);
    margin-bottom: 10px;
    border-radius: 8px;
    transition: background 0.2s;
}

.article-list li:hover {
    background: rgba(255, 255, 255, 0.08);
}

.article-list a {
    display: block;
    padding: 12px 15px;
    color: #cbd5e1;
    text-decoration: none;
    border-left: 3px solid #10b981;
}

/* Loading & Utils */
.hidden { display: none !important; }

.loading {
    text-align: center;
    padding: 40px;
}



    </style>





<script>
    document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const searchSource = document.getElementById('searchSource');
    const resultsSection = document.getElementById('resultsSection');
    const loadingIndicator = document.getElementById('loadingIndicator');

    let debounceTimer;

    // Listen for input changes to search in real-time
    searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        const query = searchInput.value.trim();
        
        if (query.length < 2) {
            resultsSection.innerHTML = '';
            resultsSection.classList.add('hidden');
            return;
        }

        // Debounce to prevent too many API calls
        debounceTimer = setTimeout(() => {
            performSearch(query, searchSource.value);
        }, 500);
    });

    // Re-search when the source changes
    searchSource.addEventListener('change', () => {
        const query = searchInput.value.trim();
        if (query.length >= 2) {
            performSearch(query, searchSource.value);
        }
    });

    async function performSearch(query, source) {
        // Show loading
        resultsSection.classList.add('hidden');
        loadingIndicator.classList.remove('hidden');
        resultsSection.innerHTML = '';

        // Determine domain
        const domain = source === 'wikipedia' ? 'en.wikipedia.org' : 'en.wikibooks.org';
        const sourceLabel = source === 'wikipedia' ? 'Wikipedia Article' : 'Wikibook';
        
        // MediaWiki Action API endpoint
        const endpoint = `https://${domain}/w/api.php?action=query&list=search&prop=info&inprop=url&utf8=&format=json&origin=*&srlimit=12&srsearch=${encodeURIComponent(query)}`;

        try {
            const response = await fetch(endpoint);
            const data = await response.json();
            const results = data.query.search;

            // Hide loading
            loadingIndicator.classList.add('hidden');
            resultsSection.classList.remove('hidden');

            if (results.length === 0) {
                resultsSection.innerHTML = `
                    <div class="no-results">
                        <p>No study resources found for "${query}" on ${sourceLabel}. Try another search term!</p>
                    </div>
                `;
                // Make the grid full width for no results
                resultsSection.style.gridTemplateColumns = '1fr';
                return;
            }

            // Restore grid layout
            resultsSection.style.gridTemplateColumns = 'repeat(auto-fill, minmax(300px, 1fr))';

            // Generate HTML for results
            results.forEach((article, index) => {
                // Generate URL depending on source
                // Mediawiki Action API usually doesn't return canonical url in search directly without extra query, 
                // but we know the structure: https://en.wikipedia.org/wiki/Title
                const articleUrl = `https://${domain}/wiki/${encodeURIComponent(article.title.replace(/ /g, '_'))}`;
                
                // Clean HTML tags from snippet
                const snippet = article.snippet.replace(/(<([^>]+)>)/gi, "");

                const cardHTML = `
                    <div class="card" style="animation-delay: ${index * 0.05}s">
                        <div class="meta">
                            <span class="tag">${sourceLabel}</span>
                        </div>
                        <h3>${article.title}</h3>
                        <p>${snippet}...</p>
                        <a href="${articleUrl}" target="_blank" rel="noopener noreferrer" class="read-btn">
                            Read on ${sourceLabel.split(' ')[0]}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                `;
                resultsSection.insertAdjacentHTML('beforeend', cardHTML);
            });

        } catch (error) {
            console.error('Error fetching data:', error);
            loadingIndicator.classList.add('hidden');
            resultsSection.classList.remove('hidden');
            resultsSection.innerHTML = `
                <div class="no-results" style="border-color: #ef4444; color: #f8fafc;">
                    <p>Failed to fetch data. Please check your connection and try again.</p>
                </div>
            `;
            resultsSection.style.gridTemplateColumns = '1fr';
        }
    }
});

    </script>