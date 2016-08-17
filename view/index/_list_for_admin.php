
<div class="comment-tabs">
    <div class="tab-content">
        <div class="tab-pane active" id="comments-logout">
            <ul class="media-list">
                <?php foreach ($feedBacks as $feedBack): ?>
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

                                    <a class="btn glyphicon glyphicon-trash" onclick="removeFeedback(this);"></a>
                                    <a class="btn glyphicon glyphicon-edit" data-toggle="modal" data-target="#editFeedBackModal" onclick="editFeedback(this);"></a>

                                    <?php if ($feedBack['status'] == 'reviewing' || $feedBack['status'] == 'declined'): ?>
                                        <a class="btn btn-default" onclick="acceptFeedback(this);">Accept</a>
                                    <?php else: ?>
                                        <a class="btn btn-default" onclick="declineFeedback(this);">Decline</a>
                                    <?php endif; ?>
                                </h4>
                                <div class="feedback-email-text"><?=$feedBack['email']?></div>
                                <ul class="media-date text-uppercase reviews list-inline">
                                    <li class="dd feedback-email"><?=$feedBack['updated']?></li>
                                </ul>
                                <?php if ($feedBack['modified']): ?>
                                    <span class="modified-status">[modified by admin]</span>
                                <?php endif; ?>
                                <?php if ($feedBack['status'] == 'accepted'): ?>
                                    <span class="modified-status">[accepted]</span>
                                <?php endif; ?>
                                <?php if ($feedBack['status'] == 'declined'): ?>
                                    <span class="modified-status">[declined]</span>
                                <?php endif; ?>
                                <p class="feedback-comment feedback-email"><?=$feedBack['comment']?></p>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
