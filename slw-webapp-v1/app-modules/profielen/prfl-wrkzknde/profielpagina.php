<?php
session_start();

// Protect the page: only logged-in users may access it
if (!isset($_SESSION['email'])) {
    header('Location: /inlogportaal');
    exit;
}

function e($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

$name        = e($_SESSION['name']);
$voorletters = e($_SESSION['voorletters'] ?? '');
$achternaam  = e($_SESSION['achternaam'] ?? '');
$email       = e($_SESSION['email']);
$dob         = e($_SESSION['geboortedatum'] ?? '');
$geslacht    = e($_SESSION['geslacht'] ?? '');
$straat      = e($_SESSION['straatnaam'] ?? '');
$huisnr      = e($_SESSION['huisnummer'] ?? '');
$postcode    = e($_SESSION['postcode'] ?? '');
$woonplaats  = e($_SESSION['woonplaats'] ?? '');
$telefoon    = e($_SESSION['telefoonnummer'] ?? '');
$bio         = e($_SESSION['bio'] ?? '');
$titel       = e($_SESSION['functie_titel'] ?? '');
$linkedin    = e($_SESSION['linkedin'] ?? '');
$foto        = e($_SESSION['profielfoto'] ?? '');
$created     = $_SESSION['created_at'] ?? '';
$initials    = mb_strtoupper(mb_substr($_SESSION['voorletters'] ?? $_SESSION['name'], 0, 1));

// Format member-since date
$memberSince = '';
if ($created) {
    $dt = new DateTime($created);
    $months = ['januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december'];
    $memberSince = $months[(int)$dt->format('n') - 1] . ' ' . $dt->format('Y');
}

// Format DOB for display
$dobDisplay = '';
if ($dob) {
    $dt = new DateTime($dob);
    $dobDisplay = $dt->format('d-m-Y');
}

// Full address
$adres = trim("$straat $huisnr");
if ($postcode || $woonplaats) {
    $adres .= ($adres ? ', ' : '') . trim("$postcode $woonplaats");
}
$adres = e($adres);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?> – SelectWorks Profiel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="/slw-webapp-v1/app-modules/profielen/prfl-wrkzknde/profile_style.css">
</head>
<body>

<!-- ===== Top bar ===== -->
<header class="topbar">
    <div class="topbar-inner">
        <a href="/" class="topbar-brand">
            <img src="/slw-webapp-v1/app-data/media/logos/Selectworks-type1-barebones2.png" alt="SelectWorks">
        </a>
        <div class="topbar-right">
            <span class="topbar-greeting">Hallo, <b><?php echo $name; ?></b></span>
            <span class="topbar-time" id="current_time"></span>
            <a href="/slw-webapp-v1/app-modules/inloggen/logout.php" class="btn-logout">Uitloggen</a>
        </div>
    </div>
</header>

<!-- ===== Cover + avatar ===== -->
<section class="profile-hero">
    <div class="cover-photo"></div>
    <div class="profile-hero-inner">
        <div class="avatar-wrapper">
            <?php if ($foto): ?>
                <img class="avatar"
                     src="/slw-webapp-v1/app-data/media/images/Profile images/<?php echo $foto; ?>"
                     alt="<?php echo $name; ?>"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <?php else: ?>
                <img class="avatar"
                     src="/slw-webapp-v1/app-data/media/images/Profile images/avatar-default-med.png"
                     alt="<?php echo $name; ?>"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <?php endif; ?>
            <span class="avatar-fallback" style="display:none;"><?php echo $initials; ?></span>
        </div>
        <div class="profile-identity">
            <h1 class="profile-name"><?php echo $name; ?></h1>
            <?php if ($titel): ?>
                <p class="profile-title"
                   data-field="functie_titel"
                   data-editable="true"
                   title="Klik om te bewerken"><?php echo $titel; ?></p>
            <?php else: ?>
                <p class="profile-title editable-placeholder"
                   data-field="functie_titel"
                   data-editable="true"
                   title="Klik om te bewerken">+ Functietitel toevoegen</p>
            <?php endif; ?>
            <p class="profile-handle"><?php echo $email; ?></p>
        </div>
    </div>
</section>

<!-- ===== Stats bar ===== -->
<div class="stats-bar">
    <div class="stats-bar-inner">
        <div class="stat-item"><span class="stat-value">0</span><span class="stat-label">Sollicitaties</span></div>
        <div class="stat-item"><span class="stat-value">0</span><span class="stat-label">Matches</span></div>
        <div class="stat-item"><span class="stat-value">0</span><span class="stat-label">Berichten</span></div>
        <div class="stat-item"><span class="stat-value">0</span><span class="stat-label">Connecties</span></div>
    </div>
</div>

<!-- ===== Tabs ===== -->
<nav class="profile-tabs">
    <div class="profile-tabs-inner">
        <button class="tab active" data-tab="overzicht">Overzicht</button>
        <button class="tab" data-tab="werkverleden">Werkverleden</button>
        <button class="tab" data-tab="doelen">Doelen</button>
        <button class="tab" data-tab="instellingen">Instellingen</button>
    </div>
</nav>

<!-- ===== Main content ===== -->
<main class="profile-main">

    <!-- Left sidebar -->
    <aside class="sidebar sidebar-left">

        <div class="card card-about">
            <h3 class="card-title">Over mij</h3>
            <?php if ($bio): ?>
                <p class="bio-text"
                   data-field="bio"
                   data-editable="true"
                   title="Klik om te bewerken"><?php echo nl2br($bio); ?></p>
            <?php else: ?>
                <p class="bio-text editable-placeholder"
                   data-field="bio"
                   data-editable="true"
                   title="Klik om te bewerken">Klik hier om een biografie toe te voegen...</p>
            <?php endif; ?>
        </div>

        <div class="card card-details">
            <h3 class="card-title">Gegevens</h3>
            <ul class="detail-list">
                <li><span class="detail-icon">&#9993;</span> <?php echo $email; ?></li>
                <?php if ($telefoon): ?>
                    <li><span class="detail-icon">&#128222;</span>
                        <span data-field="telefoonnummer" data-editable="true" title="Klik om te bewerken"><?php echo $telefoon; ?></span>
                    </li>
                <?php else: ?>
                    <li><span class="detail-icon">&#128222;</span>
                        <span class="editable-placeholder" data-field="telefoonnummer" data-editable="true" title="Klik om te bewerken">+ Telefoonnummer</span>
                    </li>
                <?php endif; ?>
                <?php if ($dobDisplay): ?>
                    <li><span class="detail-icon">&#128197;</span> <?php echo $dobDisplay; ?></li>
                <?php endif; ?>
                <li><span class="detail-icon">&#128205;</span>
                    <?php if ($woonplaats): ?>
                        <span data-field="woonplaats" data-editable="true" title="Klik om te bewerken"><?php echo $woonplaats; ?></span>
                    <?php else: ?>
                        <span class="editable-placeholder" data-field="woonplaats" data-editable="true" title="Klik om te bewerken">+ Woonplaats</span>
                    <?php endif; ?>
                </li>
                <?php if ($adres): ?>
                    <li><span class="detail-icon">&#127968;</span> <?php echo $adres; ?></li>
                <?php endif; ?>
                <?php if ($linkedin): ?>
                    <li><span class="detail-icon">&#128279;</span>
                        <a href="<?php echo $linkedin; ?>" target="_blank" rel="noopener">LinkedIn</a>
                    </li>
                <?php else: ?>
                    <li><span class="detail-icon">&#128279;</span>
                        <span class="editable-placeholder" data-field="linkedin" data-editable="true" title="Klik om te bewerken">+ LinkedIn URL</span>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <?php if ($memberSince): ?>
        <div class="card card-member-since">
            <p class="card-muted">Lid sinds <?php echo $memberSince; ?></p>
        </div>
        <?php endif; ?>

    </aside>

    <!-- Center feed -->
    <section class="feed">

        <!-- Tab: Overzicht -->
        <div class="tab-panel active" id="tab-overzicht">

            <div class="card card-post compose">
                <textarea class="compose-input" id="compose-input" placeholder="Deel een update of ervaring..." maxlength="2000"></textarea>
                <div class="compose-footer">
                    <span class="compose-counter"><span id="char-count">0</span>/2000</span>
                    <button class="btn-compose" id="btn-post" disabled>Plaatsen</button>
                </div>
            </div>

            <div id="status-feed"></div>
            <div id="feed-loader" class="feed-loader" style="display:none;">Laden...</div>
            <div id="feed-empty" class="card empty-state" style="display:none;">
                <p class="empty-icon">&#128172;</p>
                <h3>Nog geen updates</h3>
                <p>Deel je eerste statusupdate hierboven!</p>
            </div>

        </div>

        <!-- Tab: Werkverleden -->
        <div class="tab-panel" id="tab-werkverleden">
            <div class="card empty-state">
                <p class="empty-icon">&#128188;</p>
                <h3>Werkverleden</h3>
                <p>Je hebt nog geen werkervaring toegevoegd.</p>
                <button class="btn-action">Ervaring toevoegen</button>
            </div>
        </div>

        <!-- Tab: Doelen -->
        <div class="tab-panel" id="tab-doelen">
            <div class="card empty-state">
                <p class="empty-icon">&#127919;</p>
                <h3>Doelen</h3>
                <p>Beschrijf je korte- en langetermijndoelen.</p>
                <button class="btn-action">Doel toevoegen</button>
            </div>
        </div>

        <!-- Tab: Instellingen -->
        <div class="tab-panel" id="tab-instellingen">
            <div class="card">
                <h3 class="card-title">Persoonlijke gegevens</h3>
                <table class="settings-table">
                    <tr>
                        <td class="settings-label">Voorletters</td>
                        <td><span data-field="voorletters" data-editable="true" title="Klik om te bewerken"><?php echo $voorletters ?: '<em class="editable-placeholder">Niet ingevuld</em>'; ?></span></td>
                    </tr>
                    <tr>
                        <td class="settings-label">Achternaam</td>
                        <td><span data-field="achternaam" data-editable="true" title="Klik om te bewerken"><?php echo $achternaam ?: '<em class="editable-placeholder">Niet ingevuld</em>'; ?></span></td>
                    </tr>
                    <tr><td class="settings-label">E-mail</td><td><?php echo $email; ?></td></tr>
                    <tr><td class="settings-label">Geboortedatum</td><td><?php echo $dobDisplay ?: '—'; ?></td></tr>
                    <tr><td class="settings-label">Geslacht</td><td><?php echo ucfirst($geslacht) ?: '—'; ?></td></tr>
                    <tr><td class="settings-label">Adres</td><td><?php echo $adres ?: '—'; ?></td></tr>
                    <tr>
                        <td class="settings-label">Telefoon</td>
                        <td><span data-field="telefoonnummer" data-editable="true" title="Klik om te bewerken"><?php echo $telefoon ?: '<em class="editable-placeholder">Niet ingevuld</em>'; ?></span></td>
                    </tr>
                </table>
            </div>
            <div class="card">
                <h3 class="card-title">Accountinstellingen</h3>
                <ul class="settings-list">
                    <li><a href="#">Wachtwoord wijzigen</a></li>
                    <li><a href="#">Privacy-instellingen</a></li>
                    <li><a href="#">Meldingen</a></li>
                </ul>
            </div>
        </div>

    </section>

    <!-- Right sidebar -->
    <aside class="sidebar sidebar-right">
        <div class="card">
            <h3 class="card-title">Aanbevolen vacatures</h3>
            <p class="card-muted">Momenteel geen aanbevelingen.</p>
        </div>
        <div class="card">
            <h3 class="card-title">Suggesties</h3>
            <p class="card-muted">Vul je profiel aan om suggesties te ontvangen.</p>
        </div>
    </aside>

</main>

<!-- ===== Footer ===== -->
<footer class="site-footer">
    <p>
        <a href="/">Selectworks.nl</a> &middot; Alle rechten voorbehouden &copy;
        2018 – <?php echo date('Y'); ?> &middot;
        <a href="https://rapprecht.nl">J.M. Rapprecht</a>
    </p>
</footer>

<!-- ===== Tab switching, clock & inline editing ===== -->
<script>
/* --- Tabs ---------------------------------------------------------------- */
document.querySelectorAll('.tab').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.tab').forEach(function(b){ b.classList.remove('active'); });
        document.querySelectorAll('.tab-panel').forEach(function(p){ p.classList.remove('active'); });
        btn.classList.add('active');
        document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
    });
});

/* --- Clock --------------------------------------------------------------- */
(function tick() {
    var d = new Date();
    var pad = function(n){ return n < 10 ? '0'+n : n; };
    document.getElementById('current_time').textContent =
        pad(d.getHours()) + ':' + pad(d.getMinutes()) + ':' + pad(d.getSeconds());
    setTimeout(tick, 1000);
})();

/* --- Inline editing ------------------------------------------------------ */
document.querySelectorAll('[data-editable="true"]').forEach(function(el) {
    el.classList.add('editable');
    el.addEventListener('click', startEdit);
});

function startEdit(e) {
    var el = e.currentTarget;
    if (el.classList.contains('editing')) return;

    var field = el.dataset.field;
    var isPlaceholder = el.classList.contains('editable-placeholder');
    var currentVal = isPlaceholder ? '' : el.textContent.trim();
    var isMultiline = field === 'bio';

    el.classList.add('editing');

    // Build the edit UI
    var wrapper = document.createElement('div');
    wrapper.className = 'inline-edit-wrap';

    var input;
    if (isMultiline) {
        input = document.createElement('textarea');
        input.className = 'inline-edit-input';
        input.rows = 4;
    } else {
        input = document.createElement('input');
        input.type = 'text';
        input.className = 'inline-edit-input';
    }
    input.value = currentVal;

    var actions = document.createElement('div');
    actions.className = 'inline-edit-actions';

    var saveBtn = document.createElement('button');
    saveBtn.className = 'inline-save';
    saveBtn.textContent = '✓ Opslaan';

    var cancelBtn = document.createElement('button');
    cancelBtn.className = 'inline-cancel';
    cancelBtn.textContent = 'Annuleren';

    actions.appendChild(saveBtn);
    actions.appendChild(cancelBtn);
    wrapper.appendChild(input);
    wrapper.appendChild(actions);

    // Replace content
    var originalHTML = el.innerHTML;
    el.innerHTML = '';
    el.appendChild(wrapper);

    input.focus();
    if (!isMultiline) input.select();

    // Save handler
    function save() {
        var newVal = input.value.trim();
        saveBtn.disabled = true;
        saveBtn.textContent = '...';

        fetch('/profiel-update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ field: field, value: newVal })
        })
        .then(function(r) {
            return r.text().then(function(txt) {
                try { return JSON.parse(txt); }
                catch(e) { return { ok: false, error: 'Server gaf ongeldig antwoord: ' + txt.substring(0, 100) }; }
            });
        })
        .then(function(data) {
            if (data.ok) {
                el.classList.remove('editing', 'editable-placeholder');
                if (newVal === '') {
                    el.classList.add('editable-placeholder');
                    el.innerHTML = getPlaceholder(field);
                } else {
                    el.innerHTML = field === 'bio' ? newVal.replace(/\n/g, '<br>') : escapeHtml(newVal);
                }
                // Update name in header if first/last name changed
                if (field === 'voorletters' || field === 'achternaam') {
                    updateNameDisplay();
                }
                showToast('Opgeslagen!');
            } else {
                showToast(data.error || 'Fout bij opslaan', true);
                cancel();
            }
        })
        .catch(function(err) {
            showToast('Netwerkfout: ' + err.message, true);
            cancel();
        });
    }

    // Cancel handler
    function cancel() {
        input.blur();
        el.classList.remove('editing');
        el.innerHTML = originalHTML;
        if (window.getSelection) window.getSelection().removeAllRanges();
    }

    saveBtn.addEventListener('click', function(ev) { ev.stopPropagation(); save(); });
    cancelBtn.addEventListener('click', function(ev) { ev.stopPropagation(); cancel(); });

    // Keyboard shortcuts
    input.addEventListener('keydown', function(ev) {
        if (ev.key === 'Escape') cancel();
        if (ev.key === 'Enter' && !isMultiline) { ev.preventDefault(); save(); }
        if (ev.key === 'Enter' && ev.ctrlKey && isMultiline) { ev.preventDefault(); save(); }
    });
}

function getPlaceholder(field) {
    var map = {
        'bio': 'Klik hier om een biografie toe te voegen...',
        'functie_titel': '+ Functietitel toevoegen',
        'telefoonnummer': '+ Telefoonnummer',
        'woonplaats': '+ Woonplaats',
        'linkedin': '+ LinkedIn URL',
        'voorletters': '<em class="editable-placeholder">Niet ingevuld</em>',
        'achternaam': '<em class="editable-placeholder">Niet ingevuld</em>'
    };
    return map[field] || '+ Invullen';
}

function updateNameDisplay() {
    // Re-read from the page's editable fields
    var v = '', a = '';
    document.querySelectorAll('[data-field="voorletters"]').forEach(function(el) {
        if (!el.classList.contains('editable-placeholder') && !el.classList.contains('editing')) v = el.textContent.trim();
    });
    document.querySelectorAll('[data-field="achternaam"]').forEach(function(el) {
        if (!el.classList.contains('editable-placeholder') && !el.classList.contains('editing')) a = el.textContent.trim();
    });
    var full = (v + ' ' + a).trim();
    if (full) {
        document.querySelectorAll('.profile-name').forEach(function(n){ n.textContent = full; });
        document.querySelectorAll('.topbar-greeting b').forEach(function(n){ n.textContent = full; });
    }
}

function escapeHtml(t) {
    var d = document.createElement('div');
    d.textContent = t;
    return d.innerHTML;
}

/* --- Toast notification -------------------------------------------------- */
function showToast(msg, isError) {
    var t = document.createElement('div');
    t.className = 'toast' + (isError ? ' toast-error' : '');
    t.textContent = msg;
    document.body.appendChild(t);
    requestAnimationFrame(function(){ t.classList.add('show'); });
    setTimeout(function(){ t.classList.remove('show'); setTimeout(function(){ t.remove(); }, 300); }, 2500);
}
/* --- Status Updates ------------------------------------------------------ */
(function() {
    var feed      = document.getElementById('status-feed');
    var loader    = document.getElementById('feed-loader');
    var emptyMsg  = document.getElementById('feed-empty');
    var input     = document.getElementById('compose-input');
    var postBtn   = document.getElementById('btn-post');
    var charCount = document.getElementById('char-count');
    var page      = 1;
    var loading   = false;
    var hasMore   = true;

    // Character counter + enable/disable button
    input.addEventListener('input', function() {
        var len = input.value.trim().length;
        charCount.textContent = len;
        postBtn.disabled = (len === 0);
    });

    // Post a new status
    postBtn.addEventListener('click', function() {
        var text = input.value.trim();
        if (!text) return;
        postBtn.disabled = true;
        postBtn.textContent = '...';

        fetch('/status-updates', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'create', inhoud: text })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            postBtn.textContent = 'Plaatsen';
            if (data.ok) {
                input.value = '';
                charCount.textContent = '0';
                postBtn.disabled = true;
                emptyMsg.style.display = 'none';
                feed.insertBefore(buildPostCard(data.post), feed.firstChild);
                showToast('Update geplaatst!');
            } else {
                showToast(data.error || 'Plaatsen mislukt', true);
                postBtn.disabled = false;
            }
        })
        .catch(function(err) {
            postBtn.textContent = 'Plaatsen';
            postBtn.disabled = false;
            showToast('Netwerkfout: ' + err.message, true);
        });
    });

    // Ctrl+Enter to post
    input.addEventListener('keydown', function(ev) {
        if (ev.key === 'Enter' && ev.ctrlKey) {
            ev.preventDefault();
            if (!postBtn.disabled) postBtn.click();
        }
    });

    // Build a post card DOM element
    function buildPostCard(post) {
        var card = document.createElement('div');
        card.className = 'card card-post status-card';
        card.dataset.postId = post.id;

        var header = document.createElement('div');
        header.className = 'post-header';

        var authorWrap = document.createElement('div');
        authorWrap.className = 'post-author-wrap';

        var miniAvatar = document.createElement('div');
        miniAvatar.className = 'post-avatar-mini';
        miniAvatar.textContent = (post.naam || '?').charAt(0).toUpperCase();

        var authorInfo = document.createElement('div');
        var authorName = document.createElement('span');
        authorName.className = 'post-author';
        authorName.textContent = post.naam;
        var dateSpan = document.createElement('span');
        dateSpan.className = 'post-date';
        dateSpan.textContent = timeAgo(post.created_at);
        authorInfo.appendChild(authorName);
        authorInfo.appendChild(dateSpan);

        authorWrap.appendChild(miniAvatar);
        authorWrap.appendChild(authorInfo);
        header.appendChild(authorWrap);

        // Delete button
        var delBtn = document.createElement('button');
        delBtn.className = 'post-delete';
        delBtn.title = 'Verwijderen';
        delBtn.innerHTML = '&times;';
        delBtn.addEventListener('click', function() { deletePost(post.id, card); });
        header.appendChild(delBtn);

        var body = document.createElement('p');
        body.className = 'post-body';
        body.innerHTML = escapeHtml(post.inhoud).replace(/\n/g, '<br>');

        card.appendChild(header);
        card.appendChild(body);
        return card;
    }

    // Delete a status update
    function deletePost(id, cardEl) {
        if (!confirm('Weet je zeker dat je deze update wilt verwijderen?')) return;
        fetch('/status-updates', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'delete', id: id })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.ok) {
                cardEl.style.transition = 'opacity 0.3s, transform 0.3s';
                cardEl.style.opacity = '0';
                cardEl.style.transform = 'translateY(-10px)';
                setTimeout(function() {
                    cardEl.remove();
                    if (!feed.children.length) emptyMsg.style.display = '';
                }, 300);
                showToast('Update verwijderd');
            } else {
                showToast(data.error || 'Verwijderen mislukt', true);
            }
        })
        .catch(function(err) { showToast('Netwerkfout', true); });
    }

    // Load posts from server
    function loadPosts() {
        if (loading || !hasMore) return;
        loading = true;
        loader.style.display = '';

        fetch('/status-updates?page=' + page)
        .then(function(r) { return r.json(); })
        .then(function(data) {
            loader.style.display = 'none';
            loading = false;
            if (data.ok) {
                data.posts.forEach(function(p) {
                    feed.appendChild(buildPostCard(p));
                });
                hasMore = data.hasMore;
                page++;
                if (!data.posts.length && page === 2) {
                    emptyMsg.style.display = '';
                }
            }
        })
        .catch(function() {
            loader.style.display = 'none';
            loading = false;
        });
    }

    // Infinite scroll
    window.addEventListener('scroll', function() {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 300) {
            loadPosts();
        }
    });

    // Relative time
    function timeAgo(dateStr) {
        var now = new Date();
        var then = new Date(dateStr.replace(' ', 'T'));
        var diff = Math.floor((now - then) / 1000);
        if (diff < 60) return 'Zojuist';
        if (diff < 3600) return Math.floor(diff / 60) + ' min geleden';
        if (diff < 86400) return Math.floor(diff / 3600) + ' uur geleden';
        if (diff < 604800) return Math.floor(diff / 86400) + ' dagen geleden';
        return then.toLocaleDateString('nl-NL', { day: 'numeric', month: 'short', year: 'numeric' });
    }

    // Initial load
    loadPosts();
})();

</script>

</body>
</html>
