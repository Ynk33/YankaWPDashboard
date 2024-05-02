<?php

// Register this Widget;
YF_Messages_Widget::register();

/**
 * A custom widget to display the message sent via the Contact form.
 */
class YF_Messages_Widget extends YF_Widget {
  /**
   * The ID of this widget.
   */
  protected static $id = 'yf_messages_widget';

  /**
   * The title of this widget.
   */
  protected static $title = 'New Messages';

  /**
   * The class name of this widget.
   */
  protected static $className = 'YF_Messages_Widget';

  /**
   * The messages to display.
   * @var array
   */
  private static $messages;
  /**
   * The number of messages.
   * @var int
   */
  private static $count;

  /**
   * Sets up this widget.
   */
  protected static function setup() {
    // Fetch the pending comments.
    self::$messages = get_comments([
      'post_id' => null,
      'status' => 0
    ]);

    // Count the comments
    self::$count = count(self::$messages);
  }

  /**
   * Render this widget.
   */
  public static function render() {
    ?>

      <div>
        You have <strong><?php echo self::$count; ?></strong> new messages.
      </div>

      <?php if (self::$count > 0) : ?>
      <table class="yf-messages-table wp-list-table widefat fixed striped table-view-list comments">
        <thead>
          <tr>
            <th class="yf-messages-author">Author</th>
            <th class="yf-messages-date">Date</th>
            <th class="yf-messages-message">Message</th>
          </tr>
        </thead>
        <?php $i = 0; foreach (self::$messages as $message) : ?>
          <tr class="yf-messages-row <?php echo ($i % 2 == 0 ? 'even' : 'odd'); ?>">
            <td>
              <strong><?php echo $message->comment_author; ?></strong>
            </td>

            <td><?php echo date(get_option( 'date_format' ), strtotime($message->comment_date)); ?></td>

            <td><div class="yf-messages-content"><?php echo $message->comment_content; ?><div></td>
          </tr>
        <?php $i++; endforeach; ?>
      </table>

      <a href="<?php echo admin_url('/edit-comments.php?comment_status=moderated'); ?>" class="button">Manage</a>
      <?php endif; ?>

    <?php
  }
}