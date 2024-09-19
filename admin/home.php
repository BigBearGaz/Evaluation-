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

    .card {
        background: rgba(51, 0, 0, 0.7);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(255, 77, 77, 0.5);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(255, 77, 77, 0.8);
    }

    .card-img-top {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .card-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        color: #ff6666;
        font-size: 1.5em;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 1em;
        line-height: 1.4;
        margin-bottom: 15px;
        flex-grow: 1;
    }

    .btn {
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
    }

    .btn:hover {
        background: linear-gradient(45deg, #ff4d4d, #800000);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 77, 77, 0.8);
    }

    .modal-content {
        background: rgba(51, 0, 0, 0.9);
        color: #fff;
        border-radius: 15px;
    }

    .modal-header, .modal-footer {
        border: none;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.1);
        border: none;
        color: #fff;
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
    <?php 
    require_once('functions.php');
    ?>
    <h1 class="mb-4">Page d'accueil</h1>
    <div class="row">
        <div class="col-12 mb-4">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addPostModal">
                Ajouter un nouveau post
            </button>
        </div>

        <!-- Modal pour ajouter un nouveau post -->
        <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPostModalLabel">Ajouter un nouveau post</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="add_post.php" method="POST">
                        <div class="modal-body">
                            <input type="text" name="title" placeholder="Titre" class="form-control mb-3" required>
                            <textarea name="content" placeholder="Contenu" class="form-control mb-3" required></textarea>
                            <input type="text" name="image" placeholder="URL de l'image" class="form-control mb-3">
                            <input type="text" name="writer" placeholder="Auteur" class="form-control mb-3" required>
                        </div>
                        <div class="modal-footer">
                            <button type="file" name="file" class="btn">Add image</button>
                            <button type="button" class="btn" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn">Ajouter le post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="post-grid">
            <?php
            $posts = get_posts();
            foreach($posts as $post): ?>
                <div class="card">
                    <img src="<?= $post->image ?>" class="card-img-top" alt="<?= $post->title ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post->title ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Le <?= date("d/m/Y à H:i",strtotime($post->date)); ?> par <?= $post->name ?></h6>
                        <p class="card-text"><?= substr(nl2br($post->content),0,200); ?>...</p>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editModal<?= $post->id ?>">Modifier</button>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $post->id ?>">Supprimer</button>
                        </div>
                    </div>
                </div>

                <!-- Modal pour modifier l'article -->
                <div class="modal fade" id="editModal<?= $post->id ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $post->id ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel<?= $post->id ?>">Modifier l'article</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="update_post.php" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $post->id ?>">
                                    <input type="text" name="title" placeholder="Titre" value="<?= htmlspecialchars($post->title) ?>" class="form-control mb-3">
                                    <textarea name="content" placeholder="Contenu" class="form-control mb-3"><?= htmlspecialchars($post->content) ?></textarea>
                                    <input type="text" name="image" placeholder="URL de l'image" value="<?= htmlspecialchars($post->image) ?>" class="form-control mb-3">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn">Enregistrer les modifications</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal pour supprimer l'article -->
                <div class="modal fade" id="deleteModal<?= $post->id ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $post->id ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel<?= $post->id ?>">Confirmer la suppression</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer le post "<?= htmlspecialchars($post->title) ?>" ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">Annuler</button>
                                <form action="delete_post.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $post->id ?>">
                                    <button type="submit" class="btn">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>