

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Your feedback</h4>
            </div>
            <div class="modal-body">
                <li class="media">
                    <div class="media-body">
                        <div class="well well-lg">
                            <h4 class="media-heading text-uppercase reviews" id="modal-head"></h4>
                            <ul class="media-date text-uppercase reviews list-inline">
                                <li class="dd" id="modal-date"></li>
                            </ul>
                            <p class="media-comment" id="modal-comment"></p>
                        </div>
                    </div>
                </li>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /Modal content-->

    </div>
</div>
<!-- /Modal -->

<!-- Login Modal -->
<div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Your feedback</h4>
            </div>
            <div class="modal-body">
                <form name="User" action="<?=$request->home()?>/login?redirect_url=<?=$request->getFullUrl()?>" method="POST" enctype="multipart/form-data">
                    <div id="comment-name" class="form-row form-group">
                        <input type="text" placeholder="Name (required)" name="User[name]" id="name"/>
                    </div>

                    <div id="comment-email" class="form-row form-group">
                        <input type="text" placeholder="Password (required)" name="User[pass]" id="email"/>
                    </div>

                    <input type="submit" class="btn btn-default get-left" name="User[submit]" value="Login" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /Modal content-->

    </div>
</div>
<!-- /Login Modal -->

<!-- Edit Feedback Modal -->
<div class="modal fade" id="editFeedBackModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Your feedback</h4>
            </div>
            <div class="modal-body">
                <form name="feedback" action="" method="POST" enctype="multipart/form-data">
                    <input id="id" type="hidden" name="Edit_Feedback[id]"/>
                    
                    <div id="comment-name" class="form-row form-group">
                        <input type="text" placeholder="Name (required)" name="Edit_Feedback[name]" id="name"/>
                    </div>

                    <div id="comment-email" class="form-row form-group">
                        <input type="email" placeholder="Email (required)" name="Edit_Feedback[email]" id="email"/>
                    </div>

                    <div class="form-row form-group align-left">
                        <label for="img">Image</label>
                        <input type="file" placeholder="image" name="Edit_Feedback[image]" id="img" />
                    </div>

                    <div id="comment-message" class="form-row form-group">
                        <textarea name="Edit_Feedback[comment]" placeholder="Message" id="comment" ></textarea>
                    </div>

                    <input type="submit" class="btn btn-info get-left" name="User[submit]" value="Update Feedback" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /Modal content-->

    </div>
</div>
<!-- /Edit Feedback Modal -->