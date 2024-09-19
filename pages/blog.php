<style>
    body {
        background: linear-gradient(45deg, #1a0000, #330000);
        color: #fff;
        font-family: 'Arial', sans-serif;
    }

    h2 {
        text-align: center;
        color: #ff4d4d;
        text-shadow: 0 0 10px #800000;
        font-size: 3em;
        margin-bottom: 30px;
    }

    .post-container {
        background: rgba(51, 0, 0, 0.7);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 0 20px rgba(255, 77, 77, 0.5);
        transition: all 0.3s ease;
    }

    .post-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(255, 77, 77, 0.8);
    }

    h4 {
        color: #ff6666;
        text-shadow: 0 0 5px #cc0000;
        border-bottom: 2px solid #ff6666;
        padding-bottom: 10px;
    }

    .post-content {
        font-size: 1.1em;
        line-height: 1.6;
    }

    .post-image {
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(255, 77, 77, 0.7);
        transition: all 0.3s ease;
    }

    .post-image:hover {
        transform: scale(1.05);
    }

    .btn-read-more {
        background: linear-gradient(45deg, #800000, #ff4d4d);
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        text-transform: uppercase;
        font-weight: bold;
        transition: all 0.3s ease;
        box-shadow: 0 0 10px rgba(255, 77, 77, 0.5);
    }

    .btn-read-more:hover {
        background: linear-gradient(45deg, #ff4d4d, #800000);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 77, 77, 0.8);
    }

    @keyframes flicker {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
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
</style>

<div class="flame-effect"></div>

<h2>Blog</h2>

<div class="container">
    <?php 
    $posts = get_posts();
    foreach($posts as $post) {
    ?>
    <div class="post-container">
        <h4><?= $post->title ?></h4>
        <div class="row">
            <div class="col-md-8">
                <div class="post-content">
                    <?= substr(nl2br($post->content), 0, 1200) ?>...
                </div>
            </div>
            <div class="col-md-4">
                <img src="<?= $post->image ?>" class="img-fluid post-image" alt="<?= $post->title ?>">
                <br/><br/>
                <a class="btn btn-read-more" href="index.php?page=post&id=<?= $post->id ?>">Lire l'article complet</a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>