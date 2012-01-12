<?php do_content_for("html_header") ?>
  <script type="text/javascript">
    if(navigator.platform.indexOf("iPhone") != -1 || navigator.platform == "iPad" || navigator.platform == "iPod") // includes "iPhone Simulator"
      document.write('<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">');
    else
      document.write('<meta name="viewport" content="target-densityDpi=150; user-scalable=0;">');

    if(navigator.platform == "iPad")
      document.write('<link rel="apple-touch-startup-image" href="/images/iphone-startup-ipad.png">');
    else
      document.write('<link rel="apple-touch-startup-image" href="/images/iphone-startup.png">');
  </script>

  <meta name="apple-mobile-web-app-capable" content="yes" >  
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="application-name" content="<?php echo str_replace('.', ' ', CONFIG::app_name) ?>"> 
  <meta name="application-url" content="/post/browse">

  <link rel="apple-touch-icon" href="/images/iphone-icon.png">
  <style type="text/css">
    /* iPhone tends to highlight things oddly, sometimes even highlighting the
     * entire page on swipe.  Turn tap highlighting off. */
    * { -webkit-tap-highlight-color: rgba(0,0,0,0); }
  </style>
<?php end_content_for() ?>

<div id="sizing-body">

<div id="debug2" style="position: fixed; bottom: 100px; background-color: #000;"></div>

<div id="post-browser" class="post-browser" style="display: none;">
  <a style="display: none;" class="browser-thumb-hover-overlay" href="#" tabindex="-1">
    <img src="about:blank" alt="">
  </a>

  <div class="post-browser-posts-container">
    <div class="post-browser-scroller">
      <ul class="post-browser-posts"></ul>
    </div>
    <div class="post-browser-no-results" style="position: absolute; bottom: 0; width: 100%; display: none; text-align: center; font-size: 200%;">No search results.</div>
  </div>

  <div class="browser-bottom-bar">
    <form action="#" class="tags-form" method="get" style="display: inline;">
      <input class="post-browser-tags-form" name="tags" size="20" type="search" autocapitalize="off" autocorrect="off">
      <input style="display: none;" type="submit">
    </form>
  </div>
</div>

<div id="post-content" style="width: 100%;">
  <!-- Make sure the image is cropped to the viewport.  This happens already for most browsers,
       since body is overflow: hidden, but iPhone's browser doesn't handle that correctly. -->
  <div style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; overflow: hidden;" class="image-container">
    <div class="blacklisted-message disable-selection" style="display: none; text-align: center; margin-top: 5em;">
      <div style="font-size: 250%;">
        Image hidden
      </div>
      <div style="margin-top: 1em; font-size: 150%;">
        This post is not displayed due to your account settings.
      </div>
      <div style="margin-top: 1em; font-size: 150%;">
        <a href="#" class="show-blacklisted" style="border: 1px solid #FFF; padding: 0.25em;">Double-click here to display the image</a>
      </div>
    </div>
    <div class="image-box"></div>

    <div class="image-navigator disable-selection" style="display: none;">
      <div class="image-navigator-box">
        <div class="navigator-cursor" style="position: absolute; top: 0; left: 0;"></div>
        <img class="image-navigator-img">
      </div>
    </div>
    <div class="frame-editor-popup-container disable-selection" style="position: absolute; right: 0;">
      <div class="frame-editor-popup" style="display: none;">
        <div class="frame-editor-popup-box frame-editor-nw"><div class="frame-editor-popup-div"><img></div></div>
        <div class="frame-editor-popup-box frame-editor-ne"><div class="frame-editor-popup-div"><img></div></div>
        <div class="frame-editor-popup-box frame-editor-sw"><div class="frame-editor-popup-div"><img></div></div>
        <div class="frame-editor-popup-box frame-editor-se"><div class="frame-editor-popup-div"><img></div></div>
      </div>
    </div>

    <div class="vote-popup-expand" style="display: none;"></div>
    <div id="vote-popup-container" class="vote-popup-container vote-popup-hidden" style="display: none;">
      <?php echo vote_widget(User::$current, "vote-popup") ?>
    </div>
    <div class="vote-popup-flash" style="display: none;"><div class="flash-item"></div></div>
  </div>

  <div class="post-info" style="display: none;">
    <ul class="post-info-right-edge" style="float: right; text-align: right;">
      <li style="margin-top: 1px; margin-right: 1px;">
        <img style="cursor: pointer;" class="toggle-zoom zoom-icon-in" src="/images/icon-zoom-in.png" width="20" height="20">
        <img style="cursor: pointer;" class="toggle-zoom zoom-icon-out" src="/images/icon-zoom-out.png" width="20" height="20">
        <img style="" class="zoom-icon-none" src="/images/icon-zoom-none.png">
      </li>
      <li>
        <img style="margin-top: 1px; margin-right: 1px; cursor: pointer;" class="flag-button member-only" src="/images/icon-flag.png" width="20" height="20">
      </li>
      <li>
        <img style="margin-top: 1px; margin-right: 1px; cursor: pointer;" class="post-delete moderator-only" src="/images/icon-delete.png" width="20" height="20">
      </li>
    </ul>

    <div style="padding: 0.5em;">
      <div>
        Post #<a href="#" class="post-id-link"><span class="post-id"></span></a>
        <span style="background-color: #000; margin-left: 0.25em; padding: 0 0.5em;" class="post-dimensions"></span>
        <span style="background-color: #000; margin-left: 0.25em; padding: 0 0.5em;" class="post-rating"></span>
        <span style="background-color: #000; margin-left: 0.25em; padding: 0 0.5em;" class="post-hidden">Hidden</span>
      </div>
    <div class="pool-info"></div>
    <div>Posted <span class="posted-at"></span><span class="posted-by"> ago by <a href="#"></a></span></div>
    <div id="vote-container" class="vote-container">Score: <span class="post-score"></span> <?php echo vote_widget(User::$current) ?> <span class="vote-desc"></span></div>
    <div class="post-frames">
      Frames: <div class="post-frame-list"></div>
    </div>

    <div class="post-source">Source: <a href="#"></a><span></span></div>

    <div class="status-deleted"> 
      This post was deleted.
      <span class="by-container">By: <a href="#" class="by"></a></span>
      Reason: <span class="reason"></span>.
      <a href="#" class="post-undelete moderator-only" style="border: 1px solid #FFF; padding: 0px 2px;">undelete</a>
    </div>
    <div class="download-links">Download:
      <a href="#" class="download-image"><span class="download-image-desc"></span></a>
      <a href="#" class="download-jpeg"><span class="download-jpeg-desc"></span></a>
      <a href="#" class="download-png"><span class="download-png-desc"></span></a>
    </div>
    <div class="parent-post">
      This post has a <a href="#">parent post</a><span class="reparent-post advanced-editing"><a href="#"> (make this post the parent)</a></span>.
    </div>
    <div class="child-posts">This post has <a href="#">child posts</a>.</div>
    <div class="flagged-info">
      <span class="flagged-by-box">Flagged by <a href="#" class="by"></a>.</span>
      Reason: <span class="reason"></span>.
      <a href="#" style="border: 1px solid #FFF; padding: 0px 2px;" class="post-unflag">?</a>
    </div>
    <div class="status-pending">This post is pending moderator approval.
      <span class="pending-reason-box">Reason: <span class="pending-reason"></span></span>
      <a href="#" class="post-approve" style="border: 1px solid #FFF; padding: 0px 2px;">?</a>
    </div>
    <div class="status-held">
      This post is held from the index by the poster.
      <span class="activate-post">
        <a href="#">(activate it)</a>
      </span>
    </div>

    <div class="post-tags-box" style="background-color: #003;"><span class="post-tags color-tag-types"></span>
      <span class="member-only" style="float: right"><a href="#" style="font-style: italic; margin: 0 0.5em;" class="show-tag-edit">edit</a></span>
    </div>

    <div class="post-edit" style="margin-top: 0.5em;">
      <form class="post-edit-main">
        <input style="display: none;" type="submit" value="dummy">

        <textarea style="overflow: hidden; width: 100%; resize: none;" class="edit-tags edit-item" name="tags" rows="1" spellcheck="false" autocapitalize="off" autocorrect="off"></textarea>

        <table style="margin: 0">
          <tr>
            <td><label for="edit-questionable">Rating</label></td>
            <td>
              <span style="white-space: nowrap;">
                <input id="edit-explicit" class="edit-explicit edit-item" name="rating" tabindex="1" type="radio" value="Explicit" checked="checked">
                <label for="edit-explicit">Explicit</label>
              </span>
              <span style="white-space: nowrap;">
                <input id="edit-questionable" class="edit-questionable edit-item" name="rating" tabindex="2" type="radio" value="Questionable">
                <label for="edit-questionable">Questionable</label>
              </span>
              <span style="white-space: nowrap;">
                <input id="edit-safe" class="edit-safe edit-item" name="rating" tabindex="3" type="radio" value="Safe">
                <label for="edit-safe">Safe</label>
              </span>
            </td>
          </tr>

          <tr>
            <td><label for="edit-shown-in-index">Shown in index</label></td>
            <td><input id="edit-shown-in-index" class="edit-shown-in-index edit-item" name="is_shown_in_index" type="checkbox"></td>
          </tr>

          <tr>
            <td><label for="edit-parent">Parent Post</label></td>
            <td><input id="edit-parent" class="edit-parent edit-item" style="" name="parent_id" size="10" tabindex="4" type="text"></td>
          </tr>

          <tr>
            <td><label for="edit-source">Source</label></td>
            <td><input id="edit-source" class="edit-source edit-item" style="width: 100%;" name="source" tabindex="9" type="text" value=""></td>
          </tr>
        </table>
      </form>

      <div class="frame-editor" style="display: none">
        <table class="frame-list" style="margin: 0.5em 0;" cellspacing=0 cellpadding=0><tbody></tbody></table>
        <a href="#" class="frame-editor-add">Add a frame</a>
      </div>

      <div style="background-color: #003; font-size: 125%;">
        <div style="float: right;">
          <a href="#" class="edit-cancel">Cancel</a>
          <a href="#" class="edit-save">Save</a>
        </div>
        <div class="advanced-editing">
          <a href="#" class="edit-frames-button">Frames</a>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>

</div>

<script type="text/javascript">
var debug;

document.observe("dom:loaded", function()
{
  debug = new NewDebug();

  InitAdvancedEditing();
  InitializeFullScreenBrowserHandlers();
  Post.init_blacklisted();

  var normalize_hash = function(h)
  {
    // Normalize:
    // post_id-frame/search
    var path = h.get("");
    if(path != null)
    {
      var post_id = path.split("/", 1)[0];
      h.set("", null);
      if(post_id != "")
      {
        var post_id_parts = post_id.split("-");
        if(post_id_parts[1] == 'F')
          post_id_parts[1] = -1;
        h.set("post-id", post_id_parts[0]);
        h.set("post-frame", post_id_parts[1]);
      }
      if(path.substr(post_id.length, 1) == "/")
        h.set("tags", path.substr(post_id.length + 1));
    }

    // Validate parameters.
    var post_id = h.get("post-id");
    if(post_id != null && isNaN(parseInt(post_id)))
      h.set("post-id", null);
    return h;
  }

  var denormalize_hash = function(h)
  {
    // Denormalize; the input will always be normalized.
    var str = "";

    var post_id = h.get("post-id");
    var post_frame = h.get("post-frame");
    if(post_id != null)
    {
      str += post_id;
      if(post_frame == -1)
        str += "-F";
      else if(post_frame != null)
        str += "-" + post_frame;

      h.set("post-id", null);
      h.set("post-frame", null);
    }
    var tags = h.get("tags");
    if(tags != null)
    {
      str += "/" + tags;
      h.set("tags", null);
    }

    h.set("", str);
    return h;
  }

  UrlHash.set_normalize(normalize_hash, denormalize_hash);

  function initialize_browser()
  {
    var view = new BrowserView($("post-content"));
    var thumbnail_view = new ThumbnailView($("post-browser"), view);
    $("post-browser").show();
    new WindowTitleHandler();
    new PostLoader();

    new InputHandler();

    var container = $("post-browser");
    var update = function()
    {
      container.down(".tags-form").tags.value = UrlHash.get("tags") || "";
    }

    update();

    container.down(".tags-form").observe("submit", function(e)
    {
      e.stop();

      var tags_element = container.down(".tags-form").tags;
      tags_element.blur();

      var tags = tags_element.value;
      document.fire("viewer:perform-search", {tags: tags, results_mode: "jump-to-first"});
    });

    UrlHash.observe("tags", function() {
      update();
    });
    document.observe("viewer:focus-tag-box", function(e) {
      thumbnail_view.show_thumb_bar(true);
      container.down(".tags-form").tags.focus();
      container.down(".tags-form").tags.select();
      return true;
    });
  }

  if(AndroidDetectWindowSize.required())
  {
    /* We need to figure out the window size.  Do this before starting up the browser,
     * to speed it up. */
    var trigger_initialization = function(e)
    {
      document.stopObserving("resize", trigger_initialization);
      initialize_browser.defer();
    }
    document.observe("resize", trigger_initialization);

    /* This will always fire resize at least once. */
    new AndroidDetectWindowSize();
  }
  else
  {
    /* Normal initialization. */
    initialize_browser();
  }
}.bindAsEventListener(null));
</script>

