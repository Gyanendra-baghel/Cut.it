<main>
    <p class="heading">Welcome to Cut.it</p>
    <p class="sub-heading">Shorten your long URLs and make them easy to share!</p>
    <section class="form-section">
        <h2>Shorten Your URL</h2>
        <form id="shortenForm" action="/" method="post">
            <label for="originalUrl">Enter your long URL:</label>
            <input type="url" id="originalUrl" name="originalUrl" placeholder="https://example.com">
            <input type="text" id="originalUrl" name="shortUrl" placeholder="favorite-link">
            <?php if ($isLogin) : ?>
                <button type="submit">Shorten</button>
            <?php else : ?>
                <button><a href="/_signup">Signup & Shorten</a></button>
            <?php endif; ?>
        </form>
    </section>
</main>