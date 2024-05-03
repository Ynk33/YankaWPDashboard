<?php

// Register this Widget.
YF_Check_Galleries_Widget::register();

/**
 * Widget to verify that the galleries are properly configured.
 */
class YF_Check_Galleries_Widget extends YF_Widget {
  /**
   * The ID of this widget.
   */
  protected static $id = 'yf_check_galleries_widget';

  /**
   * The title of this widget.
   */
  protected static $title = 'Highlights & Galleries Verification';

  /**
   * The class name of this widget.
   */
  protected static $className = 'YF_Check_Galleries_Widget';

  /**
   * The context of this widget (normal, side, column3, column4).
   */
  protected static $context = 'normal';

  /**
   * Render this widget.
   */
  public static function render() {

    $highlightsTagID = get_term_by( 'name', 'highlights', 'post_tag' )->term_id;

    $highlights = get_posts( [
      "post_type" => "gallery",
      "tag" => "highlights",
    ]);
    $galleries = get_posts( [
      "post_type" => "gallery",
      "tag__not_in" => [$highlightsTagID],
    ] );

    $errors = [];
    $warnings = [];
    $fixes = [];

    if ( count ($highlights ) == 0 ) {
      $errors[] = "You don't seem to have any Highlights gallery.";
    }

    if ( count ($galleries ) == 0 ) {
      $warnings[] = "You don't seem to have any gallery to display.";
      $fixes[] = "Try to add a new Gallery.";
    }

    ?>


    <?php if ( count( $errors ) > 0 ) : ?>
      <h2><span class="yf-check-galleries-message error">Errors</span></h2>
      <?php foreach ( $errors as $error ) : ?>
        <p><b><?php echo $error; ?></b></p>
      <?php endforeach; ?>
    <?php endif; ?>


    <?php if ( count( $warnings ) > 0 ) : ?>
      <h2><span class="yf-check-galleries-message warning">Warnings</span></h2>
      <?php foreach ( $warnings as $warning ) : ?>
        <p><b><?php echo $warning; ?></b></p>
      <?php endforeach; ?>
    <?php endif; ?>


    <?php if ( count( $fixes ) > 0 ) : ?>
      <div class="yf-check-galleries-advices">
        <h3><span class="yf-check-galleries-message info">Advices</span></h3>
        <?php foreach ( $fixes as $fix ) : ?>
          <p><b><?php echo $fix; ?></b></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>



    <?php if ( count( $warnings ) == 0 && count ( $errors ) == 0 ) : ?>

      <p><i>If any misconfiguration is detected, it will be displayed here.</i></p>
      <hr/>

      <p>Everything seems to be well configured. <span class="yf-check-galleries-message ok">You are all good!</span></p>

    <?php else: ?>
      
      <div class="yf-check-galleries centered">
        <?php if ( count ($fixes) > 0 ) : ?><p>Try to follow the "Advices".</p><?php else: ?><hr/><?php endif; ?>
        <p><b>If you have any trouble, contact your administrator immediately.</b></p>
        </div>

    <?php endif; ?>

    <?php
  }
}