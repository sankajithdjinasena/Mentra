@extends('layouts.web')

@section('content')

    <style>
        :root {
            --primary: #28a745;
            --primary-hover: #4caf50;
            --dark: #043504;
            --surface: #ffffff;
            --surface-soft: #f4fff4;
            --text: #113011;
            --text-muted: #4f6d4f;
            --border: #d9efd9;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .page-shell {
            width: min(1150px, 92%);
            margin: 28px auto 40px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 22px;
            padding: 14px 18px;
            border-radius: 14px;
            background: var(--dark);
            color: #fff;
        }

        .topbar h1 {
            font-family: "Merienda", serif;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .topbar a {
            text-decoration: none;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.45);
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 0.92rem;
            transition: 0.2s ease;
        }

        .topbar a:hover {
            background: #fff;
            color: var(--dark);
        }

        .section {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 8px 28px rgba(4, 53, 4, 0.08);
            padding: 22px;
        }

        .section + .section {
            margin-top: 22px;
        }

        .section h2 {
            font-family: "Merienda", serif;
            color: var(--dark);
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .section p.desc {
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .todo-grid {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .todo-card {
            min-height: 50px;
            border: 1px solid #cde9ce;
            border-radius: 16px;
            padding: 14px;
            background: var(--surface-soft);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            transition: box-shadow 0.2s ease;
        }

        .todo-card.active {
            box-shadow: 0 8px 22px rgba(4, 53, 4, 0.12);
        }

        .todo-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            text-align: left;
            min-width: 220px;
        }

        .todo-card h3 {
            font-size: 1rem;
            margin: 0;
        }

        .todo-card small {
            color: var(--text-muted);
        }

        .todo-actions {
            display: flex;
            flex-wrap: nowrap;
            gap: 8px;
            margin-top: 0;
            justify-content: flex-end;
        }

        .action-pill {
            border: 1px solid var(--primary);
            color: var(--primary);
            border-radius: 999px;
            padding: 3px 10px;
            font-size: 0.8rem;
            font-weight: 700;
            font-family: "Lato", sans-serif;
            background: transparent;
            cursor: pointer;
        }

        .action-pill:hover {
            background: #ebf8ec;
        }

        .action-pill.primary {
            background: var(--primary);
            color: #fff;
        }

        .action-pill.primary:hover {
            background: var(--primary-hover);
        }

        .todo-card.add {
            border-style: dashed;
            background: #f0fff1;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--dark);
            flex-direction: column;
            min-height: 80px;
            gap: 8px;
        }

        .todo-card.add .plus {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: grid;
            place-items: center;
            font-size: 1.6rem;
            line-height: 1;
            margin: 0;
            flex-shrink: 0;
        }

        .todo-card.add strong {
            font-size: 0.95rem;
            font-weight: 700;
        }

        .todo-expand {
            display: none;
            width: 100%;
            margin-top: 14px;
            padding-top: 12px;
            border-top: 1px dashed #b7deb9;
        }

        .todo-expand-row {
            width: 100%;
        }

        .todo-expand-row + .todo-expand-row {
            margin-top: 10px;
        }

        .todo-timer-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .timer {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 0;
            font-weight: 800;
            flex-wrap: wrap;
        }

        .timer span {
            background: #ebf8ec;
            border: 1px solid #cde9ce;
            border-radius: 10px;
            padding: 10px 12px;
            min-width: 54px;
            text-align: center;
        }

        .timer .timer-label {
            color: var(--text-muted);
            border: 0px;
            font-size: 0.82rem;
            font-weight: 700;
            margin-left: -2px;
            margin-right: 4px;
            background: transparent;
        }

        .timer-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .timer-btn {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1px solid var(--primary);
            background: #ebf8ec;
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s ease;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.08);
        }

        .timer-btn:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-1px);
        }

        .timer-btn svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        .timer-btn.stop {
            border-color: #d46b6b;
            background: #fff0f0;
            color: #d46b6b;
        }

        .timer-btn.stop:hover {
            background: #d46b6b;
            color: #fff;
        }

        .timer-btn.reset {
            border-color: #6c757d;
            background: #f4f6f8;
            color: #6c757d;
        }

        .timer-btn.reset:hover {
            background: #6c757d;
            color: #fff;
        }

        .music-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .music-select {
            width: 100%;
            border: 1px solid #b8dcba;
            border-radius: 10px;
            padding: 8px 10px;
            margin-bottom: 10px;
            font-family: "Nunito", sans-serif;
            color: var(--text);
            background: #fff;
        }

        .spotify-embed {
            width: 100%;

            border: 0;
            border-radius: 12px;
        }

        .todo-card.active .todo-expand {
            display: block;
        }

        .calendar-shell {
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .calendar-head {
            background: var(--dark);
            color: #fff;
            padding: 12px 16px;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
        }

        .calendar-week,
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }

        .calendar-week div {
            background: #eef8ee;
            text-align: center;
            padding: 10px;
            font-weight: 700;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }

        .calendar-grid div {
            height: 82px;
            border-right: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            background: #fff;
        }

        .calendar-grid div:nth-child(7n) {
            border-right: none;
        }

        .stats-layout {
            display: grid;
            grid-template-columns: 1.15fr 1fr;
            gap: 14px;
        }

        .panel {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 14px;
            background: #fff;
        }

        .panel h4 {
            margin-bottom: 12px;
            color: var(--dark);
        }

        .fake-bars {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            height: 160px;
        }

        .fake-bars div {
            flex: 1;
            border-radius: 8px 8px 0 0;
            background: linear-gradient(180deg, var(--primary-hover), var(--primary));
        }

        .line-chart {
            height: 160px;
            border-radius: 12px;
            border: 1px dashed #b9dbbb;
            background:
                linear-gradient(135deg, rgba(40, 167, 69, 0.14), rgba(4, 53, 4, 0.06));
        }

        .badges {
            margin-top: 14px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .badge-item {
            border-radius: 10px;
            border: 1px solid #cae6cc;
            background: #f2fbf2;
            text-align: center;
            padding: 10px 8px;
            font-weight: 700;
            color: var(--dark);
            font-size: 0.86rem;
        }

        @media (max-width: 880px) {
            .stats-layout {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

<section class="container sec">
    <main class="page-shell">
        <section class="section">
            <h2>1) ToDo</h2>
            <p class="desc">Static preview of rounded-square todo cards with actions and add-item block.</p>
            <div class="todo-grid">
                <article class="todo-card" data-todo-card>
                    <div class="todo-main">
                        <h3>Review Biology Chapter 5</h3>
                    </div>
                    <div class="todo-actions">
                        <button type="button" class="action-pill">Edit</button>
                        <button type="button" class="action-pill">Mark as done</button>
                        <button type="button" class="action-pill primary" data-toggle-do>Start</button>
                    </div>
                    <div class="todo-expand">
                        <div class="todo-expand-row">
                            <div class="todo-timer-row">
                                <div class="timer">
                                    <span id="hr">00</span>
                                    <span class="timer-label">Hr</span>
                                    <span id="min">00</span>
                                    <span class="timer-label">Min</span>
                                    <span id="sec">00</span>
                                    <span class="timer-label">Sec</span>
                                    <span id="count">00</span>
                                </div>
                                <div class="timer-actions">
                                    <button type="button" class="timer-btn start" id="start" aria-label="Start timer" title="Start">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"></path></svg>
                                    </button>
                                    <button type="button" class="timer-btn stop" id="stop" aria-label="Stop timer" title="Stop">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6h12v12H6z"></path></svg>
                                    </button>
                                    <button type="button" class="timer-btn reset" id="reset" aria-label="Reset timer" title="Reset">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17.65 6.35A7.95 7.95 0 0 0 12 4V1L7 6l5 5V7a5 5 0 1 1-5 5H5a7 7 0 1 0 12.65-5.65z"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="todo-expand-row">
                            <label class="music-label" for="music-1">Choose music</label>
                            <select id="music-1" class="music-select" data-music-select>
                                <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DX8NTLI2TtZa6?utm_source=generator">Lofi Beats</option>
                                <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DX3PFzdbtx1Us?utm_source=generator">Peaceful Piano</option>
                                <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DWWQRwui0ExPn?utm_source=generator">Focus Flow</option>
                            </select>
                        </div>
                        <div class="todo-expand-row">
                            <iframe class="spotify-embed" data-spotify-frame
                                src="https://open.spotify.com/embed/playlist/37i9dQZF1DX8NTLI2TtZa6?utm_source=generator"
                                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                                loading="lazy"></iframe>
                        </div>
                    </div>
                </article>

                <article class="todo-card" data-todo-card>
                    <div class="todo-main">
                        <h3>Practice Algebra (30 questions)</h3>
                    </div>
                    <div class="todo-actions">
                        <button type="button" class="action-pill">Edit</button>
                        <button type="button" class="action-pill">Mark as done</button>
                        <button type="button" class="action-pill primary" data-toggle-do>Start</button>
                    </div>
                    <div class="todo-expand">
                        <div class="todo-expand-row">
                            <div class="timer">
                                <span>00h</span>
                                <span>00m</span>
                                <span>00s</span>
                            </div>
                        </div>
                        <div class="todo-expand-row">
                            <label class="music-label" for="music-2">Choose music</label>
                            <select id="music-2" class="music-select" data-music-select>
                                <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DX8NTLI2TtZa6?utm_source=generator">Lofi Beats</option>
                                <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DX3PFzdbtx1Us?utm_source=generator">Peaceful Piano</option>
                                <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DWWQRwui0ExPn?utm_source=generator">Focus Flow</option>
                            </select>
                        </div>
                        <div class="todo-expand-row">
                            <iframe class="spotify-embed" data-spotify-frame
                                src="https://open.spotify.com/embed/playlist/37i9dQZF1DX8NTLI2TtZa6?utm_source=generator"
                                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                                loading="lazy"></iframe>
                        </div>
                    </div>
                </article>

                <article class="todo-card" data-todo-card>
                    <div class="todo-main">
                        <h3>Write Chemistry Summary Notes</h3>
                    </div>
                    <div class="todo-actions">
                        <button type="button" class="action-pill">Edit</button>
                        <button type="button" class="action-pill">Mark as done</button>
                        <button type="button" class="action-pill primary" data-toggle-do>Start</button>
                    </div>
                    <div class="todo-expand">
                        <div class="todo-expand-row">
                            <div class="timer">
                                <span>00h</span>
                                <span>00m</span>
                                <span>00s</span>
                            </div>
                        </div>
                        <div class="todo-expand-row">
                            <label class="music-label" for="music-3">Choose music</label>
                            <select id="music-3" class="music-select" data-music-select>
                                <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DX8NTLI2TtZa6?utm_source=generator">Lofi Beats</option>
                                <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DX3PFzdbtx1Us?utm_source=generator">Peaceful Piano</option>
                                <option value="https://open.spotify.com/embed/playlist/37i9dQZF1DWWQRwui0ExPn?utm_source=generator">Focus Flow</option>
                            </select>
                        </div>
                        <div class="todo-expand-row">
                            <iframe class="spotify-embed" data-spotify-frame
                                src="https://open.spotify.com/embed/playlist/37i9dQZF1DX8NTLI2TtZa6?utm_source=generator"
                                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                                loading="lazy"></iframe>
                        </div>
                    </div>
                </article>

                <article class="todo-card add">
                    <div class="plus">+</div>
                    <strong>Add To-do</strong>
                </article>
            </div>
        </section>

        <section class="section">
            <h2>2) Calendar view</h2>
            <p class="desc">Generic blank calendar layout (intentionally non-functional for later development).</p>
            <div class="calendar-shell">
                <div class="calendar-head">
                    <span>April 2026</span>
                    <span>Month View</span>
                </div>
                <div class="calendar-week">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="calendar-grid">
                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>3) Stats</h2>
            <p class="desc">Static blend of study-info feel (timer/actions) and study-progress feel (charts/badges).</p>
            <div class="stats-layout">
                <article class="panel">
                    <h4>Study Session Snapshot</h4>
                    <div class="timer">
                        <span>02h</span>
                        <span>14m</span>
                        <span>09s</span>
                    </div>
                    <div class="fake-bars">
                        <div style="height: 38%;"></div>
                        <div style="height: 55%;"></div>
                        <div style="height: 48%;"></div>
                        <div style="height: 72%;"></div>
                        <div style="height: 63%;"></div>
                        <div style="height: 82%;"></div>
                        <div style="height: 57%;"></div>
                    </div>
                </article>

                <article class="panel">
                    <h4>Monthly Trend + Badges</h4>
                    <div class="line-chart"></div>
                    <div class="badges">
                        <div class="badge-item">7-Day Focus</div>
                        <div class="badge-item">20h Milestone</div>
                        <div class="badge-item">Consistency Star</div>
                    </div>
                </article>
            </div>
        </section>
    </main>

    <script>
        document.querySelectorAll('[data-todo-card]').forEach((card) => {
            const doToggle = card.querySelector('[data-toggle-do]');
            const musicSelect = card.querySelector('[data-music-select]');
            const spotifyFrame = card.querySelector('[data-spotify-frame]');

            if (musicSelect && spotifyFrame) {
                spotifyFrame.src = musicSelect.value;
                musicSelect.addEventListener('change', function() {
                    spotifyFrame.src = this.value;
                });
            }

            if (doToggle) {
                doToggle.addEventListener('click', function() {
                    const isActive = card.classList.toggle('active');
                    doToggle.textContent = isActive ? 'Pause' : 'Start';
                });
            }
        });
    </script>
</section>
