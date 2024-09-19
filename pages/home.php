<style>
    body {
        background: linear-gradient(45deg, #1a0000, #330000);
        color: #fff;
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #ff4d4d;
        text-shadow: 0 0 10px #800000;
        font-size: 3em;
        margin-bottom: 30px;
    }

    .post-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
    }

    .post-card {
        background: rgba(51, 0, 0, 0.7);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(255, 77, 77, 0.5);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(255, 77, 77, 0.8);
    }

    .post-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .post-content {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .post-title {
        color: #ff6666;
        font-size: 1.5em;
        margin-bottom: 10px;
    }

    .post-excerpt {
        font-size: 1em;
        line-height: 1.4;
        margin-bottom: 15px;
        flex-grow: 1;
    }

    .post-meta {
        font-size: 0.9em;
        color: #ff9999;
        margin-bottom: 15px;
    }

    .btn-read-more {
        background: linear-gradient(45deg, #800000, #ff4d4d);
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: bold;
        transition: all 0.3s ease;
        display: inline-block;
        align-self: flex-start;
    }

    .btn-read-more:hover {
        background: linear-gradient(45deg, #ff4d4d, #800000);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 77, 77, 0.8);
    }

    .flame-effect {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
        background: 
            radial-gradient(ellipse at top, rgba(255, 77, 77, 0.3), transparent 70%),
            radial-gradient(ellipse at bottom, rgba(128, 0, 0, 0.3), transparent 70%);
        animation: flicker 5s infinite alternate;
    }

    @keyframes flicker {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
</style>

<div class="flame-effect"></div>

<div class="container">
    <h1>Mon Blog</h1>

    <div class="post-grid">
        <?php 
        $posts = get_posts();
        foreach($posts as $post) {
        ?>
        <article class="post-card">
            <img src="./admin/<?= $post->image ?>" class="post-image" alt="<?= $post->title ?>">
            <div class="post-content">
                <h2 class="post-title"><?= $post->title ?></h2>
                <div class="post-meta">
                    <span><i class="fas fa-user"></i> <?= $post->name ?></span>
                    <span><i class="fas fa-calendar"></i> <?= date("d/m/Y", strtotime($post->date)) ?></span>
                </div>
                <p class="post-excerpt"><?= substr(strip_tags($post->content), 0, 100) ?>...</p>
                <a class="btn-read-more" href="index.php?page=post&id=<?= $post->id ?>">Lire l'article</a>
            </div>
        </article>
        <?php
        }
        ?>
    </div>
</div>