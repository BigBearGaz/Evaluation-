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

    .post-container, .comments-container, .comment-form {
        background: rgba(51, 0, 0, 0.7);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 0 20px rgba(255, 77, 77, 0.5);
        transition: all 0.3s ease;
    }

    .post-container:hover, .comments-container:hover, .comment-form:hover {
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

    .btn-read-more, .btn {
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

    .btn-read-more:hover, .btn:hover {
        background: linear-gradient(45deg, #ff4d4d, #800000);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 77, 77, 0.8);
    }

    blockquote {
        background: rgba(255, 102, 102, 0.1);
        border-left: 5px solid #ff6666;
        margin: 20px auto;
        padding: 10px;
    }

    .input-field input,
    .input-field textarea {
        color: #fff;
        border-bottom: 1px solid #ff6666;
    }

    .input-field input:focus,
    .input-field textarea:focus {
        border-bottom: 1px solid #ff4d4d;
    }

    .input-field label {
      color: #ff6666; 
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

<body>
<div class="flame-effect"></div>

<?php
$post = get_post();
if($post == false){
    header("Location:index.php?page=error");
}else{
?>
<div class="container post-container">
    <img src="<?= $post->image ?>" class="post-image img-fluid mb-3" alt="<?= $post->title ?>">
    <h2 class="text-center mb-3"><?= $post->title ?></h2>
    <h6 class="text-center mb-3">Par <?= $post->name ?> le <?= date("d/m/Y à H:i", strtotime($post->date)) ?></h6>
    <p class="post-content mt-3"><?= $post->content ?></p>
</div>
<?php
}
?>

<hr>

<div class="container comments-container">
<h4 class="mb-5">Commentaires</h4>

<?php 
$responses = get_comments();
foreach($responses as $response){
?>
<blockquote>
   <strong><?= $response->name ?> (<?=date("d/m/Y", strtotime($response->date))?>)</strong>
   <p><?= nl2br($response->comment);?></p>
</blockquote>
<?php
}
?>
</div>

<div class="container comment-form">
<h4>Commenter:</h4>

<?php 
if(isset($_POST['submit'])){
   $name = htmlspecialchars(trim($_POST['name']));
   $email = htmlspecialchars(trim($_POST['email']));
   $comment = htmlspecialchars(trim($_POST['comment']));
   $errors = [];

   if(empty($name) || empty($email) || empty($comment)){
       $errors['empty'] = "Tous les champs n'ont pas été remplis";
   }else{
       if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
           $errors['email'] = "L'adresse mail n'est pas valide";
       }
   }

   if(!empty($errors)){
       echo '<div class="card red"><div class="card-content white-text">';
       foreach($errors as $error){
           echo $error.'<br>';
       }
       echo '</div></div>';
   }else{
       comment($name,$email,$comment);
       echo '<div class="card green"><div class="card-content white-text">Commentaire ajouté!</div></div>';
   }
}
?>

<form method="post">
   <div class="input-field col s12 m6">
       <input type="text" name="name" id="name" required/>
       <label for="name">Nom de l'auteur</label>
   </div>
   <div class="input-field col s12 m6">
       <input type="email" name="email" id="email" required/>
       <label for="email">Adresse email</label>
   </div>
   <div class="input-field col s12">
       <textarea name="comment" id="comment" class="materialize-textarea" required></textarea>
       <label for="comment">Commentaires</label>
   </div>
   <button type="submit" name="submit" class="btn waves-effect mt-3">
       Commenter ce post   
   </button>
</form>

</div>

</body>