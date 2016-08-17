
<div class="comment-tabs">
    <div class="tab-content">
        <div class="tab-pane active" id="comments-logout">
            <ul class="media-list">
                <?php foreach ($feedBacks as $feedBack): ?>
                    <?php if ($feedBack['status'] == 'accepted'): ?>
                    <li class="media">
                        <?php if ($feedBack['image']): ?>
                            <a class="pull-left" href="#">
                                <img width="140" height="140" class="media-object img-circle" src="<?=$feedBack['image']?>" alt="image">
                            </a>
                        <?php endif; ?>
                        <div class="media-body">
                            <div class="well well-lg">
                                <span class="feedback-id" style="display:none;"><?=$feedBack['id']?></span>
                                <h4 class="media-heading text-uppercase reviews">
                                    <span class="feedback-name"><?=$feedBack['name']?></span>
                                </h4>
                                <div class="feedback-email-text"><?=$feedBack['email']?></div>
                                <ul class="media-date text-uppercase reviews list-inline">
                                    <li class="dd feedback-email"><?=$feedBack['updated']?></li>
                                </ul>
                                <?php if ($feedBack['modified']): ?>
                                    <span class="modified-status">[modified by admin]</span>
                                <?php endif; ?>
                                <p class="feedback-comment feedback-email"><?=$feedBack['comment']?></p>
                            </div>
                        </div>
                    </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
