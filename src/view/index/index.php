<?php include '_modals.php'; ?>

<div class="page-header">
    <h3 class="reviews">Create your task<?=$request->isLoggedIn() ? ', ' . $request->getUser()->name : ''?></h3>

    <?php if ($request->isLoggedIn()): ?>
        <div class="logout">
            <a class="btn btn-default btn-circle text-uppercase pull-right" type="button" href="#" onclick="logout();">
                <span class="glyphicon glyphicon-off"></span> Logout
            </a>
        </div>
    <?php else: ?>
        <div class="login">
            <button class="btn btn-default btn-circle text-uppercase pull-right" type="button" data-toggle="modal" data-target="#loginModal" >
                <span class="glyphicon glyphicon-on"></span> Login
            </button>
        </div>
    <?php endif; ?>

    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Sort by
            <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <?php foreach ($sorts as $sort): ?>
                <li><a href="?sort=<?=$sort['key'] ?>"><?=$sort['text']?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>


<?php

$flashes = $request->getFlashes();
foreach ($flashes as $flash) {
    $status = key($flash);
    $message = $flash[$status];
    render('helpers/flash_block', ['status' => $status, 'message' => $message]);
}
?>

<?php
if ($request->isUserAdmin()) {
    render('index/_list_for_admin', ['feedBacks' => $feedBacks]);
} else {
    render('index/_list_for_user', ['feedBacks' => $feedBacks]);
}
?>

<div id='form'>
    <div class="row">
        <div class="col-md-12">

            <form name="feedback" action="" method="POST" id="commentform" enctype="multipart/form-data">
                <div id="comment-name" class="form-row form-group">
                    <?php if (!empty($errors['name'])): ?>
                        <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?=$errors['name']?>
                        </div>
                    <?php endif;?>
                    <input type="text" placeholder="Name (required)" name="Feedback[name]" id="name" value="<?=@$postData['name']?>"/>
                </div>

                <div id="comment-email" class="form-row form-group">
                    <?php if (!empty($errors['email'])): ?>
                        <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?=$errors['email']?>
                        </div>
                    <?php endif;?>
                    <input type="email" placeholder="Email (required)" name="Feedback[email]" id="email" value="<?=@$postData['email']?>"/>
                </div>

                <div class="form-row form-group align-left">
                    <label for="img">Image</label>
                    <input type="file" placeholder="image" name="Feedback[image]"  id="img" />
                </div>

                <div id="comment-message" class="form-row form-group">
                    <textarea name="Feedback[comment]" placeholder="Message" id="comment" ><?=@$postData['comment']?></textarea>
                </div>

                <a href="#" class="pull-left"><input type="submit" name="Feedback[submit]" id="commentSubmit" value="Submit Task" /></a>
            </form>

            <button type="button" class="btn btn-info preview" data-toggle="modal" data-target="#myModal" onclick="fillModal();">Preview</button>

        </div>
    </div>
</div>
