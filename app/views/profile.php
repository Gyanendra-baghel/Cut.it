<main>
    <section class="profile-section">
        <h2>User Profile</h2>
        <div>
            <label for="username">Username:</label>
            <p id="username"><?= $username ?></p>
        </div>
        <div>
            <label for="email">Email:</label>
            <p id="email"><?= $email ?></p>
        </div>
    </section>
    <section class="center-middle">
        <h2>Your Shortened URLs</h2>
        <?php if ($result->rowCount() > 0) : ?>
            <table>
                <tr>
                    <th>Full URL</th>
                    <th>Shortened URL</th>
                    <th>Click Count</th>
                </tr>
                <?php foreach ($result as $row) : ?>
                    <tr>
                        <td><?= $row['fullurl']; ?></td>
                        <td><a href="/<?= $row['shorturl']; ?>"><?= $row['shorturl']; ?></a></td>
                        <td><?php echo $row['clicks']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>No shortened URLs yet.</p>
        <?php endif; ?>
        <button class="btn"><a href="/">+ Short Url (Add More)</a></button>
    </section>
</main>